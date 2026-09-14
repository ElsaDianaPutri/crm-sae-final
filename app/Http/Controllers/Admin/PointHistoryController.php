<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\PointHistory;
use Illuminate\Http\Request;

class PointHistoryController extends Controller
{
    public function index(Request $request)
{
    $search = trim((string) $request->input('search', ''));
    $type = trim((string) $request->input('type', ''));

    $query = PointHistory::query()
        ->with('customer')
        ->when($search !== '', function ($query) use ($search) {

            $query->where(function ($q) use ($search) {

                $q->where(
                    'keterangan',
                    'like',
                    '%' . $search . '%'
                );

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

        })
        ->when(
            in_array($type, ['tambah', 'kurang'], true),
            fn ($query) => $query->where('type', $type)
        );

    $pointHistories = $query
        ->latest('created_at')
        ->paginate(15)
        ->withQueryString();


    /*
    |--------------------------------------------------------------------------
    | AJAX / LIVE SEARCH
    |--------------------------------------------------------------------------
    */
    if ($request->ajax()) {

        return view(
            'admin.point-history.partials.list',
            compact('pointHistories')
        );
    }


    return view(
        'admin.point-history.index',
        compact('pointHistories')
    );
}
}