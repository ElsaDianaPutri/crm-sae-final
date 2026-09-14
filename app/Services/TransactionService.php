<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class TransactionService
{
    public function __construct(protected PointService $pointService)
    {
    }

    public function createManualTransaction(Customer $customer, array $data): Transaction
    {
        if ($customer->status_member !== 'aktif') {
            throw new RuntimeException('Customer tidak aktif.');
        }

        $total = (int) ($data['total_belanja'] ?? 0);
        if ($total <= 0) {
            throw new RuntimeException('Total belanja harus lebih dari 0.');
        }

        return DB::transaction(function () use ($customer, $data, $total) {
            $lockedCustomer = Customer::whereKey($customer->id_customer)->lockForUpdate()->firstOrFail();
            $point = $this->pointService->calculatePoint($total);

            $transaction = Transaction::create([
                'id_customer' => $lockedCustomer->id_customer,
                'kode_transaksi' => $data['kode_transaksi'],
                'tanggal_transaksi' => now(),
                'total_belanja' => $total,
                'point_didapat' => $point,
                'status' => 'selesai',
                'source' => 'manual',
                'external_transaction_id' => null,
            ]);

            // Karena point service mencatat history, transaksi tetap atomic di level DB.
            $lockedCustomer->saldo_point += $point;
            $lockedCustomer->save();
            if ($point > 0) {
                \App\Models\PointHistory::create([
                    'id_customer' => $lockedCustomer->id_customer,
                    'point' => $point,
                    'type' => 'tambah',
                    'keterangan' => 'Transaksi ' . $transaction->kode_transaksi,
                ]);
            }

            $transaction->duplicate = false;
            return $transaction;
        });
    }

  public function createMokaTransaction(Customer $customer, array $data): Transaction
{
    if ($customer->status_member !== 'aktif') {
        throw new RuntimeException('Customer tidak aktif.');
    }

    $total = (int) ($data['total_belanja'] ?? 0);
    $externalId = trim((string) ($data['external_transaction_id'] ?? ''));

    if ($total <= 0 || $externalId === '') {
        throw new RuntimeException('Data transaksi Moka tidak lengkap.');
    }

    return DB::transaction(function () use (
        $customer,
        $data,
        $total,
        $externalId
    ) {

        /*
         * Lock customer untuk mencegah perubahan saldo
         * berjalan bersamaan pada customer yang sama.
         */
        $lockedCustomer = Customer::whereKey(
            $customer->id_customer
        )
            ->lockForUpdate()
            ->firstOrFail();

        /*
         * Hitung point transaksi.
         */
        $point = $this->pointService->calculatePoint($total);

        /*
         * Coba memasukkan transaksi.
         *
         * Jika external_transaction_id sudah ada,
         * insert akan diabaikan oleh database.
         */
        $inserted = Transaction::insertOrIgnore([
            'id_customer' => $lockedCustomer->id_customer,
            'kode_transaksi' => $data['kode_transaksi'],
            'tanggal_transaksi' => now(),
            'total_belanja' => $total,
            'point_didapat' => $point,
            'status' => 'selesai',
            'source' => 'moka',
            'external_transaction_id' => $externalId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
         * Jika tidak berhasil insert, berarti transaksi
         * dengan external_transaction_id tersebut sudah ada.
         */
        if ($inserted === 0) {
            $existing = Transaction::where(
                'external_transaction_id',
                $externalId
            )->firstOrFail();

            $existing->duplicate = true;

            return $existing;
        }

        /*
         * Ambil transaksi yang baru dibuat.
         */
        $transaction = Transaction::where(
            'external_transaction_id',
            $externalId
        )->firstOrFail();

        /*
         * Tambahkan point hanya untuk transaksi baru.
         */
        $lockedCustomer->saldo_point += $point;
        $lockedCustomer->save();

        /*
         * Simpan riwayat point.
         */
        if ($point > 0) {
            \App\Models\PointHistory::create([
                'id_customer' => $lockedCustomer->id_customer,
                'point' => $point,
                'type' => 'tambah',
                'keterangan' => 'Transaksi Moka ' .
                    $transaction->kode_transaksi,
            ]);
        }

        $transaction->duplicate = false;

        return $transaction;
    });
}
}