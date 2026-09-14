<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\PointHistory;
use App\Models\Redemption;
use App\Models\Reward;
use App\Services\RedemptionService;
use Illuminate\Http\Request;

class CustomerRewardController extends Controller
{
    public function index(Request $request)
    {
        $customer = $request->user()->customer;
        abort_unless($customer, 404, 'Data customer tidak ditemukan.');

        $rewards = Reward::where('status', 'tersedia')
            ->where('stock', '>', 0)
            ->latest()
            ->get();

        $pointHistory = $customer->pointHistories()->latest()->get();
        $redemptions = $customer->redemptions()
    ->with('reward')
    ->where('status', 'berhasil')
    ->latest('created_at')
    ->get();
        $totalPointDidapat = $pointHistory->where('type', 'tambah')->sum('point');
        $totalPointDigunakan = $pointHistory->where('type', 'kurang')->sum('point');

        return view('customer.reward', compact(
            'customer', 'rewards', 'pointHistory', 'totalPointDidapat', 'totalPointDigunakan', 'redemptions'
        ));
    }

    public function redemption(string $code)
    {
        $customer = request()->user()->customer;
        abort_unless($customer, 404, 'Data customer tidak ditemukan.');
        $redemption = Redemption::with('reward')->where('redemption_code', $code)->where('id_customer', $customer->id_customer)->firstOrFail();
        $svg = app(\App\Services\QrCodeService::class)->generate($redemption->redemption_code);
        return view('customer.redemption', compact('customer','redemption','svg'));
    }

    public function redeem(Request $request, RedemptionService $service)
    {
        $data = $request->validate(['id_reward' => ['required', 'exists:rewards,id_reward']]);
        $customer = $request->user()->customer;
        abort_unless($customer, 404, 'Data customer tidak ditemukan.');

        try {
            $redemption = $service->createPending($customer, Reward::findOrFail($data['id_reward']));
            return response()->json([
                'message' => 'Redemption dibuat. Tunjukkan QR ini ke kasir untuk konfirmasi.',
                'data' => [
                    'code' => $redemption->redemption_code,
                    'reward' => $redemption->reward()->first()?->reward_name,
                    'point_used' => $redemption->point_used,
                    'status' => $redemption->status,
                ],
            ]);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}