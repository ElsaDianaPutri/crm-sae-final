<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Services\RedemptionService;
use Illuminate\Http\Request;

class RedemptionController extends Controller
{
    public function rewards()
    {
        return response()->json([
            'data' => Reward::where('status', 'tersedia')->where('stock', '>', 0)->latest()->get(),
        ]);
    }

   public function redeem(Request $request, RedemptionService $service)
{
    $data = $request->validate([
        'id_reward' => ['required', 'exists:rewards,id_reward'],
    ]);

    try {
        $redemption = $service->createPending(
            $request->user()->customer,
            Reward::findOrFail($data['id_reward'])
        );

        return response()->json([
            'message' => 'Redemption pending.',
            'data' => $redemption,
        ], 201);

    } catch (\RuntimeException $e) {

        return response()->json([
            'message' => $e->getMessage(),
        ], 422);

    } catch (\Throwable $e) {

        \Illuminate\Support\Facades\Log::error(
            'Gagal membuat redemption',
            [
                'user_id' => $request->user()->id,
                'id_reward' => $data['id_reward'],
                'exception' => $e,
            ]
        );

        return response()->json([
            'message' => 'Terjadi kesalahan pada server.',
        ], 500);
    }
}

    public function history(Request $request)
    {
        $data = $request->user()->customer->redemptions()->with('reward')->latest()->get();
        return response()->json(['data' => $data]);
    }
}