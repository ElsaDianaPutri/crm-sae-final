<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redemption;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function transactions(Request $request)
    {
        $transactions = Transaction::with('customer')
            ->when($request->source, fn ($q, $source) => $q->where('source', $source))
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->latest('tanggal_transaksi')
            ->paginate(15)
            ->withQueryString();

        return view('admin.transactions.index', compact('transactions'));
    }

    public function redemptions(Request $request)
{
    $search = trim((string) $request->input('search', ''));

    $query = Redemption::query()
        ->with(['customer', 'reward']);

    if ($search !== '') {
        $query->where(function ($q) use ($search) {

            $q->where(
                'redemption_code',
                'like',
                '%' . $search . '%'
            );

            $q->orWhereHas('customer', function ($customerQuery) use ($search) {
                $customerQuery
                    ->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('member_code', 'like', '%' . $search . '%')
                    ->orWhere('nomor_hp', 'like', '%' . $search . '%');
            });

            $q->orWhereHas('reward', function ($rewardQuery) use ($search) {
                $rewardQuery->where(
                    'reward_name',
                    'like',
                    '%' . $search . '%'
                );
            });
        });
    }

    $redemptions = $query
        ->latest('created_at')
        ->paginate(10)
        ->withQueryString();

    if ($request->ajax()) {
        return view(
            'admin.redemptions.partials.results',
            compact('redemptions')
        )->render();
    }

    return view(
        'admin.redemptions.index',
        compact('redemptions')
    );
}
}