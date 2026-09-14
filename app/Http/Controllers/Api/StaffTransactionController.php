<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use App\Models\Customer;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class StaffTransactionController extends Controller
{


    protected $transactionService;



    public function __construct(
        TransactionService $transactionService
    )
    {

        $this->transactionService = $transactionService;

    }





    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_customer'=>'required|exists:customers,id_customer',
            'kode_transaksi'=>'required|unique:transactions,kode_transaksi',
            'total_belanja'=>'required|integer|min:1'
        ]);

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

        try {
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

            $transaction = $this->transactionService
                ->createManualTransaction(
                    $customer,
                    [
                        'kode_transaksi'=>$request->kode_transaksi,
                        'total_belanja'=>$request->total_belanja
                    ]
                );

            return ApiResponse::success(
                'Transaksi berhasil',
                [
                    'kode_transaksi'=>$transaction->kode_transaksi,
                    'total_belanja'=>$transaction->total_belanja,
                    'point_didapat'=>$transaction->point_didapat,
                    'source'=>$transaction->source,
                    'saldo_point'=>$customer->fresh()->saldo_point
                ],
                201
            );

        }
        catch(\Exception $e)
        {
            return ApiResponse::error(
                $e->getMessage(),
                400
            );
        }
    }
}