<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Redemption;



class AdminDashboardController extends Controller
{


    public function index()
    {


        // Total member aktif

        $totalMember = Customer::where(
            'status_member',
            'aktif'
        )
        ->count();





        // Total transaksi

        $totalTransaksi = Transaction::count();





        // Total point yang pernah diberikan

        $totalPointDiberikan = Transaction::sum(
            'point_didapat'
        );





        // Total redeem

        $totalRedeem = Redemption::count();





        // Total point beredar

        $totalPointCustomer = Customer::sum(
            'saldo_point'
        );






        return ApiResponse::success(

            'Admin dashboard',

            [


                'total_member'=>$totalMember,


                'total_transaksi'=>$totalTransaksi,


                'total_point_diberikan'=>(int)$totalPointDiberikan,


                'total_redeem'=>$totalRedeem,


                'total_point_beredar'=>(int)$totalPointCustomer


            ]

        );


    }


}