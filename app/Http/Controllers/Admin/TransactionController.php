<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi dan live search.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search', ''));

        $query = Transaction::query()
            ->with('customer');

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */
        if ($search !== '') {
            $query->where(function ($q) use ($search) {

                /*
                 * Cari berdasarkan kode transaksi
                 */
                $q->where(
                    'kode_transaksi',
                    'like',
                    '%' . $search . '%'
                );

                /*
                 * Cari berdasarkan data customer
                 */
                $q->orWhereHas('customer', function ($customerQuery) use ($search) {

                    $customerQuery
                        ->where(
                            'nama',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'member_code',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'nomor_hp',
                            'like',
                            '%' . $search . '%'
                        );

                });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */
        $transactions = $query
            ->orderByDesc('tanggal_transaksi')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | AJAX REQUEST
        |--------------------------------------------------------------------------
        |
        | Live search hanya mengembalikan HTML hasil transaksi.
        |
        */
        if ($request->ajax()) {
            return view(
                'admin.transactions.partials.results',
                compact('transactions')
            )->render();
        }

        /*
        |--------------------------------------------------------------------------
        | NORMAL REQUEST
        |--------------------------------------------------------------------------
        */
        return view(
            'admin.transactions.index',
            compact('transactions')
        );
    }
}