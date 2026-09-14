<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $staff = DB::table('users')->where('role', 'staff')->orderBy('id_user')->first();

        if ($staff) {
            DB::table('users')->where('id_user', $staff->id_user)->update([
                'username' => 'staffsae',
                'password' => Hash::make('123456'),
                'status' => 'aktif',
                'updated_at' => now(),
            ]);
            return;
        }

        DB::table('users')->insert([
            'username' => 'staffsae',
            'password' => Hash::make('123456'),
            'role' => 'staff',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('users')->where('username', 'staffsae')->where('role', 'staff')->delete();
    }
};
