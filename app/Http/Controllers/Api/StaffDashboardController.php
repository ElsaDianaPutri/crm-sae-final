<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Redemption;
use Illuminate\Http\Request;
use Carbon\Carbon;



class StaffDashboardController extends Controller
{


    public function index()
    {


        $today = Carbon::today();



        // Total member aktif

        $totalMember = Customer::where(
            'status_member',
            'aktif'
        )
        ->count();




        // Transaksi hari ini

        $transaksiHariIni = Transaction::whereDate(
            'created_at',
            $today
        )
        ->count();





        // Total point yang diberikan hari ini

        $pointHariIni = Transaction::whereDate(
            'created_at',
            $today
        )
        ->sum('point_didapat');





        // Redeem hari ini

        $redeemHariIni = Redemption::whereDate(
            'created_at',
            $today
        )
        ->count();






        return response()->json([


            'message'=>'Dashboard staff',


            'data'=>[


                'total_member'=>$totalMember,


                'transaksi_hari_ini'=>$transaksiHariIni,


                'point_diberikan_hari_ini'=>(int)$pointHariIni,


                'redeem_hari_ini'=>$redeemHariIni


            ]


        ]);

    }



}