<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Halaman riwayat transaksi customer
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil customer yang sedang login
        $customer = $user->customer ?? null;

        if (!$customer) {
            abort(404, 'Data customer tidak ditemukan.');
        }

        // Ambil semua transaksi milik customer
        $transactions = Transaction::where(
            'id_customer',
            $customer->id_customer
        )
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();

        return view(
            'customer.transaction',
            compact(
                'customer',
                'transactions'
            )
        );
    }
}