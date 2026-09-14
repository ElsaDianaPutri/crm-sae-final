<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\PointHistory;
use App\Models\Redemption;
use App\Models\Reward;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | STATISTIK UTAMA
        |--------------------------------------------------------------------------
        */

        $totalCustomer = Customer::count();

        $totalReward = Reward::count();

        $totalTransaction = Transaction::count();

        $totalRedemption = Redemption::count();


        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI TERBARU
        |--------------------------------------------------------------------------
        */

        $recentTransactions = Transaction::query()
            ->with('customer')
            ->latest('tanggal_transaksi')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | REDEMPTION TERBARU
        |--------------------------------------------------------------------------
        */

        $recentRedemptions = Redemption::query()
            ->with(['customer', 'reward'])
            ->latest('created_at')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS POINT TERBARU
        |--------------------------------------------------------------------------
        */

        $recentPointHistory = PointHistory::query()
            ->latest('created_at')
            ->limit(5)
            ->get();

        /*
         * Ambil customer terkait tanpa bergantung pada
         * relasi customer() di PointHistory.
         */
        $pointCustomers = Customer::query()
            ->whereIn(
                'id_customer',
                $recentPointHistory
                    ->pluck('id_customer')
                    ->filter()
                    ->unique()
            )
            ->get()
            ->keyBy('id_customer');


        /*
        |--------------------------------------------------------------------------
        | REWARD TERPOPULER
        |--------------------------------------------------------------------------
        |
        | "Reward Favorite" = reward yang paling sering
        | benar-benar berhasil diredeem.
        |
        | Redemption gagal/dibatalkan tidak dihitung.
        |
        */

        $popularRewards = Redemption::query()
            ->select('id_reward')
            ->selectRaw('COUNT(*) as redemption_count')
            ->where('status', 'berhasil')
            ->groupBy('id_reward')
            ->orderByDesc('redemption_count')
            ->limit(5)
            ->with('reward')
            ->get();


        return view('admin.dashboard', compact(
            'totalCustomer',
            'totalReward',
            'totalTransaction',
            'totalRedemption',
            'recentTransactions',
            'recentRedemptions',
            'recentPointHistory',
            'pointCustomers',
            'popularRewards'
        ));
    }
}