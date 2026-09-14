<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class TransactionController extends Controller
{


    protected $transactionService;



    public function __construct(
        TransactionService $transactionService
    )
    {

        $this->transactionService = $transactionService;

    }





    /**
     * Membuat transaksi
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_customer'=>'required|exists:customers,id_customer',
            'kode_transaksi'=>'required|unique:transactions,kode_transaksi',
            'total_belanja'=>'required|integer|min:0'
        ]);

        if($validator->fails())
        {

            return response()->json([
                'message'=>'Validasi gagal',
                'errors'=>$validator->errors()
            ],422);
        }

        $customer = Customer::find(
            $request->id_customer
        );
        
        $transaction = $this->transactionService
            ->createManualTransaction(
                $customer,
                [
                    'kode_transaksi'=>$request->kode_transaksi,
                    'total_belanja'=>$request->total_belanja
                ]
            );

        return response()->json([
            'message'=>'Transaksi berhasil',
            'data'=>[
                'kode_transaksi'=>$transaction->kode_transaksi,
                'total_belanja'=>$transaction->total_belanja,
                'point_didapat'=>$transaction->point_didapat,
                'source'=>$transaction->source,
                'saldo_point'=>$customer->fresh()->saldo_point
            ]
        ],201);
    }
}