<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\PointHistory;
use App\Models\Redemption;
use App\Models\Reward;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class RedemptionService
{
   public function createPending(Customer $customer, Reward $reward): Redemption
{
    return DB::transaction(function () use ($customer, $reward) {

        $customer = Customer::whereKey($customer->id_customer)
            ->lockForUpdate()
            ->firstOrFail();

        $reward = Reward::whereKey($reward->id_reward)
            ->lockForUpdate()
            ->firstOrFail();


        /* =====================================================
           CEK MEMBER
        ====================================================== */

        if ($customer->status_member !== 'aktif') {
            throw new RuntimeException(
                'Member tidak aktif.'
            );
        }


        /* =====================================================
           CEK REWARD
        ====================================================== */

        if (
            $reward->status !== 'tersedia' ||
            $reward->stock < 1
        ) {
            throw new RuntimeException(
                'Reward tidak tersedia.'
            );
        }


        /* =====================================================
           HITUNG POINT YANG SUDAH DICADANGKAN
           OLEH REDEMPTION PENDING
        ====================================================== */

        $pendingPoint = Redemption::where(
                'id_customer',
                $customer->id_customer
            )
            ->where('status', 'pending')
            ->sum('point_used');


        /*
         * Point yang masih benar-benar tersedia
         * untuk redemption baru.
         */
        $availablePoint =
            (int) $customer->saldo_point
            - (int) $pendingPoint;


        /* =====================================================
           CEK POINT TERSEDIA
        ====================================================== */

        if (
            $availablePoint <
            (int) $reward->point_required
        ) {

            throw new RuntimeException(
                'Point tidak mencukupi untuk redemption ini.'
            );
        }


        /* =====================================================
           BUAT REDEMPTION PENDING
        ====================================================== */

        return Redemption::create([

            'id_customer' =>
                $customer->id_customer,

            'id_reward' =>
                $reward->id_reward,

            'redeem_date' =>
                now(),

            'point_used' =>
                $reward->point_required,

            'status' =>
                'pending',

            'redemption_code' =>
                'RED-' .
                strtoupper(
                    Str::random(10)
                ),
        ]);
    });
}

public function reconcilePending(Customer $customer): void
{
    DB::transaction(function () use ($customer) {

        $customer = Customer::whereKey($customer->id_customer)
            ->lockForUpdate()
            ->firstOrFail();

        $pendingRedemptions = Redemption::where(
                'id_customer',
                $customer->id_customer
            )
            ->where('status', 'pending')
            ->orderBy('created_at')
            ->orderBy('id_redemption')
            ->lockForUpdate()
            ->get();


        $availablePoint = (int) $customer->saldo_point;


        foreach ($pendingRedemptions as $redemption) {

            $pointUsed = (int) $redemption->point_used;


            /*
             * Redemption yang masih bisa ditanggung
             * oleh point customer tetap pending.
             */
            if ($pointUsed <= $availablePoint) {

                $availablePoint -= $pointUsed;

                continue;
            }


            /*
             * Redemption berikutnya sudah tidak
             * memiliki point yang cukup.
             */
            $redemption->status = 'gagal';
            $redemption->save();
        }
    });
}

    public function confirm(string $code): Redemption
    {
        return DB::transaction(function () use ($code) {
            $redemption = Redemption::where('redemption_code', $code)
                ->lockForUpdate()
                ->with(['customer', 'reward'])
                ->firstOrFail();

            if ($redemption->status !== 'pending') {
                throw new RuntimeException('Redemption ini sudah diproses.');
            }

            $customer = Customer::whereKey($redemption->id_customer)->lockForUpdate()->firstOrFail();
            $reward = Reward::whereKey($redemption->id_reward)->lockForUpdate()->firstOrFail();

            if ($reward->status !== 'tersedia' || $reward->stock < 1) {
                throw new RuntimeException('Reward sudah tidak tersedia.');
            }

            if ($customer->saldo_point < $redemption->point_used) {
                throw new RuntimeException('Point customer tidak mencukupi.');
            }

            $customer->saldo_point -= $redemption->point_used;
            $customer->save();

            $reward->stock -= 1;
            if ($reward->stock === 0) {
                $reward->status = 'tidak_tersedia';
            }
            $reward->save();

            $redemption->status = 'berhasil';
            $redemption->redeem_date = now();
            $redemption->save();

            PointHistory::create([
                'id_customer' => $customer->id_customer,
                'point' => $redemption->point_used,
                'type' => 'kurang',
                'keterangan' => 'Redeem ' . $reward->reward_name,
            ]);

            return $redemption->fresh(['customer', 'reward']);
        });
    }

   public function cancel(string $code): Redemption
{
    return DB::transaction(function () use ($code) {

        $redemption = Redemption::where('redemption_code', $code)
            ->lockForUpdate()
            ->firstOrFail();

        if ($redemption->status !== 'pending') {
            throw new RuntimeException(
                'Redemption ini sudah diproses.'
            );
        }

        $redemption->status = 'gagal';
        $redemption->save();

        return $redemption->fresh([
            'customer',
            'reward'
        ]);
    });
}
}