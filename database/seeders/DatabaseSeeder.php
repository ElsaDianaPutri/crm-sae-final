<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['username' => 'adminsae'],
            ['password' => Hash::make('123456'), 'role' => 'admin', 'status' => 'aktif']
        );

        $staff = User::updateOrCreate(
            ['username' => 'staffsae'],
            ['password' => Hash::make('123456'), 'role' => 'staff', 'status' => 'aktif']
        );

        $customerUser = User::updateOrCreate(
            ['username' => '081234567801'],
            ['password' => Hash::make('123456'), 'role' => 'customer', 'status' => 'aktif']
        );

        Customer::updateOrCreate(
            ['id_user' => $customerUser->id_user],
            [
                'member_code' => 'SAE00001',
                'qr_code' => 'SAE-QR-DEMO01',
                'nama' => 'Budi Santoso',
                'nomor_hp' => '081234567801',
                'email' => 'budi@saecafe.test',
                'tanggal_lahir' => '2000-01-01',
                'tanggal_daftar' => now()->toDateString(),
                'saldo_point' => 100,
                'status_member' => 'aktif',
            ]
        );

        Reward::updateOrCreate(
            ['reward_name' => 'Free Coffee'],
            ['description' => 'Gratis satu cup coffee pilihan.', 'point_required' => 100, 'stock' => 10, 'status' => 'tersedia']
        );

        Reward::updateOrCreate(
            ['reward_name' => 'Diskon Rp25.000'],
            ['description' => 'Voucher potongan belanja.', 'point_required' => 250, 'stock' => 10, 'status' => 'tersedia']
        );
    }
}
