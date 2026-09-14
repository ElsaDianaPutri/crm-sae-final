<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use App\Models\Customer;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;



class MokaIntegrationController extends Controller
{


    protected $transactionService;



    public function __construct(
        TransactionService $transactionService
    )
    {

        $this->transactionService = $transactionService;

    }







    /**
     * Menerima transaksi dari Moka POS
     */
    public function transaction(Request $request)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'external_transaction_id'
                    =>'required',
                'member_code'
                    =>'required|exists:customers,member_code',
                'kode_transaksi'
                    =>'required',
                'total_belanja'
                    =>'required|integer|min:1'
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
        try {
            $customer = Customer::where(
                'member_code',
                $request->member_code
            )
            ->first();

            if(!$customer)
            {
                return ApiResponse::error(
                    'Customer tidak ditemukan',
                    404
                );
            }
            $transaction = $this->transactionService
                ->createMokaTransaction(
                    $customer,
                    [
                        'external_transaction_id'
                            =>$request->external_transaction_id,
                        'kode_transaksi'
                            =>$request->kode_transaksi,
                        'total_belanja'
                            =>$request->total_belanja
                    ]
                );
                
            return ApiResponse::success(
                'Transaksi Moka berhasil diproses',
                [
                    'kode_transaksi'
                        =>$transaction->kode_transaksi,
                    'source'
                        =>$transaction->source,
                    'total_belanja'
                        =>$transaction->total_belanja,
                    'point_didapat'
                        =>$transaction->point_didapat,
                    'duplicate'
                        =>$transaction->duplicate ?? false
                ],
                201
            );
        }
        catch (\Exception $e)
{
    Log::error('Gagal memproses transaksi Moka', [
        'external_transaction_id' => $request->external_transaction_id,
        'member_code' => $request->member_code,
        'exception' => $e,
    ]);
    return ApiResponse::error(
        'Terjadi kesalahan saat memproses transaksi Moka.',
        500
    );
}
    }
}