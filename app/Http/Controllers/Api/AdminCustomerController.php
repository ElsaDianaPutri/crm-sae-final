<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class AdminCustomerController extends Controller
{



    /**
     * Admin melihat semua customer member
     */
    public function index()
    {


        $customers = Customer::select(

            'id_customer',
            'nama',
            'nomor_hp',
            'member_code',
            'saldo_point',
            'status_member',
            'tanggal_daftar'

        )
        ->orderBy(
            'created_at',
            'desc'
        )
        ->get();





        return ApiResponse::success(

            'Daftar customer member',

            $customers

        );


    }








    /**
     * Admin melihat detail customer
     */
    public function detail(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_customer'
                    =>'required|exists:customers,id_customer'

            ]
        );

        if($validator->fails())
        {
            return ApiResponse::error(
                'Validasi gagal',
                422,
                [
                    'errors'=>$validator->errors()

                ]
            );
        }

        $customer = Customer::find(
            $request->id_customer
        );

        if(!$customer)
        {
            return ApiResponse::error(
                'Customer tidak ditemukan',
                404
            );
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

        return ApiResponse::success(
            'Detail customer',
            [
                'customer'=>[
                    'nama'=>$customer->nama,
                    'member_code'=>$customer->member_code,
                    'nomor_hp'=>$customer->nomor_hp,
                    'email'=>$customer->email,
                    'saldo_point'=>$customer->saldo_point,
                    'status_member'=>$customer->status_member,
                    'tanggal_daftar'=>$customer->tanggal_daftar
                ],
                
                'transactions'=>$transactions,
                'point_history'=>$pointHistory,
                'redeems'=>$redeems->map(function($item){
                    return [
                        'reward'=>$item->reward->reward_name ?? null,
                        'point_used'=>$item->point_used,
                        'status'=>$item->status,
                        'tanggal'=>$item->redeem_date
                    ];
                })
            ]
        );
    }
    /**
     * Admin update status member
     */
    public function updateStatus(
        Request $request,
        $id
    )
    {
        $validator = Validator::make(
            $request->all(),
            [
                'status_member'
                    =>'required|in:aktif,nonaktif'
            ]
        );

        if($validator->fails())
        {
            return ApiResponse::error(
                'Validasi gagal',
                422,
                [
                    'errors'=>$validator->errors()
                ]
            );
        }

        $customer = Customer::find($id);
        if(!$customer)
        {
            return ApiResponse::error(
                'Customer tidak ditemukan',
                404
            );
        }

        $customer->update([
            'status_member'=>$request->status_member
        ]);

        return ApiResponse::success(
            'Status member berhasil diperbarui',
            [
                'nama'=>$customer->nama,
                'status_member'=>$customer->status_member
            ]
        );
    }
}