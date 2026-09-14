<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;


class StaffCustomerController extends Controller
{


    /**
     * Staff melihat semua member customer
     */
    public function index()
    {

        $customers = Customer::select(
            'id_customer',
            'nama',
            'nomor_hp',
            'member_code',
            'saldo_point',
            'status_member'
        )
        ->orderBy(
            'created_at',
            'desc'
        )
        ->get();



        return response()->json([

            'message'=>'Daftar customer member',

            'data'=>$customers

        ]);

    }





    /**
     * Staff scan QR member
     */
    public function check(Request $request)
    {


        $request->validate([

            'qr_code'=>'required|string',

        ]);



        $customer = Customer::where(
            'qr_code',
            $request->qr_code
        )
        ->first();



        if(!$customer)
        {

            return response()->json([

                'message'=>'Member tidak ditemukan'

            ],404);

        }




        return response()->json([

            'message'=>'Data member ditemukan',

            'data' => [
    'id_customer' => $customer->id_customer,
    'nama' => $customer->nama,
    'member_code' => $customer->member_code,
    'nomor_hp' => $customer->nomor_hp,
    'saldo_point' => $customer->saldo_point,
    'status_member' => $customer->status_member,
],

        ]);

    }
    
    /**
     * Staff melihat detail lengkap customer
     */
    public function detail(Request $request)
    {


        $request->validate([

            'qr_code'=>'required|exists:customers,qr_code'

        ]);



        $customer = Customer::where(
            'qr_code',
            $request->qr_code
        )
        ->first();



        if(!$customer)
        {

            return response()->json([

                'message'=>'Customer tidak ditemukan'

            ],404);

        }

        $transactions = $customer
            ->transactions()
            ->orderBy(
                'created_at',
                'desc'
            )
            ->limit(10)
            ->get();

        $pointHistory = $customer
            ->pointHistories()
            ->orderBy(
                'created_at',
                'desc'
            )
            ->limit(10)
            ->get();




        $redeems = $customer
            ->redemptions()
            ->with('reward')
            ->orderBy(
                'created_at',
                'desc'
            )
            ->limit(10)
            ->get();






        return response()->json([


            'message'=>'Detail customer',


            'data'=>[


                'customer'=>[

                    'nama'=>$customer->nama,

                    'member_code'=>$customer->member_code,

                    'nomor_hp'=>$customer->nomor_hp,

                    'saldo_point'=>$customer->saldo_point,

                    'status_member'=>$customer->status_member

                ],




                'transactions'=>$transactions->map(function($item){

                    return [

                        'kode_transaksi'=>$item->kode_transaksi,

                        'total_belanja'=>$item->total_belanja,

                        'point_didapat'=>$item->point_didapat,

                        'tanggal'=>$item->tanggal_transaksi

                    ];

                }),





                'point_history'=>$pointHistory->map(function($item){

                    return [

                        'point'=>$item->point,

                        'type'=>$item->type,

                        'keterangan'=>$item->keterangan,

                        'tanggal'=>$item->created_at

                    ];

                }),






                'redeems'=>$redeems->map(function($item){

                    return [

                        'reward'=>$item->reward->reward_name ?? null,

                        'point_used'=>$item->point_used,

                        'status'=>$item->status,

                        'tanggal'=>$item->redeem_date

                    ];

                })


            ]

        ]);
    }

        /**
 * Staff mencari customer
 */
public function search(Request $request)
{

    $request->validate([

        'keyword'=>'required|string'

    ]);



    $keyword = $request->keyword;



    $customers = Customer::where(
            'nomor_hp',
            'like',
            "%$keyword%"
        )
        ->orWhere(
            'member_code',
            'like',
            "%$keyword%"
        )
        ->orWhere(
            'nama',
            'like',
            "%$keyword%"
        )
        ->select(

            'id_customer',
            'nama',
            'nomor_hp',
            'member_code',
            'saldo_point',
            'status_member'

        )
        ->get();




    if($customers->count() == 0)
    {

        return response()->json([

            'message'=>'Customer tidak ditemukan'

        ],404);

    }



    return response()->json([

        'message'=>'Hasil pencarian customer',

        'data'=>$customers

    ]);

}

    }