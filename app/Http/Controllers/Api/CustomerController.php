<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Services\QrCodeService;



class CustomerController extends Controller
{

protected $qrService;


public function __construct(
    QrCodeService $qrService
)
{

    $this->qrService = $qrService;

}

    public function profile(Request $request)
    {

        $user = $request->user();



        $customer = $user->customer;



        if(!$customer)
{

return ApiResponse::error(

    'Data customer tidak ditemukan',

    404

);

}



        return ApiResponse::success(

    'Profile customer',

    [

        'nama'=>$customer->nama,

        'member_code'=>$customer->member_code,

        'nomor_hp'=>$customer->nomor_hp,

        'email'=>$customer->email,

        'saldo_point'=>$customer->saldo_point,

        'status_member'=>$customer->status_member

    ]

);

    }

    public function memberCard(Request $request)
{

    $user = $request->user();


    $customer = $user->customer;


    if(!$customer)
    {

       return ApiResponse::error(

    'Data customer tidak ditemukan',

    404

);

    }



   return ApiResponse::success(

    'Member card customer',

    [

        'nama'=>$customer->nama,

        'member_code'=>$customer->member_code,

        'qr_code'=>$customer->qr_code,

        'saldo_point'=>$customer->saldo_point,

        'status_member'=>$customer->status_member

    ]

);

}
    
    public function pointHistory(Request $request)
{

    $user = $request->user();


    $customer = $user->customer;



    if(!$customer)
    {

        return ApiResponse::error(

    'Data customer tidak ditemukan',

    404

);
    }



    $history = $customer
        ->pointHistories()
        ->orderBy('created_at','desc')
        ->get();



    return ApiResponse::success(

    'Riwayat point customer',

    [

        'nama'=>$customer->nama,

        'member_code'=>$customer->member_code,

        'saldo_point'=>$customer->saldo_point,

        'history'=>$history->map(function($item){

            return [

                'point'=>$item->point,

                'type'=>$item->type,

                'keterangan'=>$item->keterangan,

                'tanggal'=>$item->created_at
                    ->format('d-m-Y H:i')

            ];

        })

    ]

);

}

}