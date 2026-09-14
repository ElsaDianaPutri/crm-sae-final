<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Services\RedemptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class StaffRedemptionController extends Controller
{
    public function rewards()
    {
        return response()->json([
            'data' => Reward::where('status', 'tersedia')
                ->where('stock', '>', 0)
                ->latest()
                ->get(),
        ]);
    }

    public function redeem(Request $request, RedemptionService $service)
    {
        $data = $request->validate([
            'redemption_code' => ['required', 'string'],
        ]);

        try {
            $redemption = $service->confirm(
                $data['redemption_code']
            );

            return response()->json([
                'message' => 'Redemption berhasil dikonfirmasi.',
                'data' => $redemption->load('customer', 'reward'),
            ]);

        } catch (RuntimeException $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 422);

        } catch (\Throwable $e) {

            Log::error('Gagal mengonfirmasi redemption', [
                'redemption_code' => $data['redemption_code'],
                'exception' => $e,
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan pada server.',
            ], 500);
        }
    }
}