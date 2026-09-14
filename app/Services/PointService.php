<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\PointHistory;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class PointService
{
    public function calculatePoint($totalBelanja): int
    {
        $totalBelanja = (int) $totalBelanja;
        if ($totalBelanja <= 0) {
            throw new InvalidArgumentException('Total belanja harus lebih dari 0.');
        }
        return (int) floor($totalBelanja / 10000);
    }

    public function addPoint(Customer $customer, int $point, string $keterangan): void
    {
        if ($point < 0) {
            throw new InvalidArgumentException('Point tidak boleh negatif.');
        }

        DB::transaction(function () use ($customer, $point, $keterangan) {
            $locked = Customer::whereKey($customer->id_customer)->lockForUpdate()->firstOrFail();
            $locked->saldo_point += $point;
            $locked->save();

            if ($point > 0) {
                PointHistory::create([
                    'id_customer' => $locked->id_customer,
                    'point' => $point,
                    'type' => 'tambah',
                    'keterangan' => $keterangan,
                ]);
            }
        });
    }
}
