<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * =========================================================
     * CUSTOMER DASHBOARD
     * =========================================================
     */
    public function dashboard(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | USER YANG SEDANG LOGIN
        |--------------------------------------------------------------------------
        */
        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | DATA CUSTOMER
        |--------------------------------------------------------------------------
        */
        $customer = $user->customer;

        if (!$customer) {
            abort(404, 'Data customer tidak ditemukan.');
        }

        /*
        |--------------------------------------------------------------------------
        | REWARD AKTIF
        |--------------------------------------------------------------------------
        */
        $rewards = Reward::where('status', 'tersedia')
            ->where('stock', '>', 0)
            ->withCount(['redemptions as successful_redemptions' => fn ($q) => $q->where('status', 'berhasil')])
            ->orderByDesc('successful_redemptions')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        $favoriteReward = $rewards->first();

        /*
        |--------------------------------------------------------------------------
        | RIWAYAT POINT
        |--------------------------------------------------------------------------
        */
        $pointHistory = $customer
            ->pointHistories()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE DASHBOARD
        |--------------------------------------------------------------------------
        */
        return view('customer.dashboard', [
            'user'         => $user,
            'customer'     => $customer,
            'rewards'      => $rewards,
            'pointHistory' => $pointHistory,
            'favoriteReward' => $favoriteReward,
        ]);
    }


    /**
     * =========================================================
     * CUSTOMER PROFILE
     * =========================================================
     */
    public function profile(Request $request)
    {
        $user = $request->user();

        $customer = $user->customer;

        if (!$customer) {
            abort(404, 'Data customer tidak ditemukan.');
        }

        return view('customer.profile', [
            'user'     => $user,
            'customer' => $customer,
        ]);
    }


    /**
     * =========================================================
     * HALAMAN UBAH PASSWORD
     * =========================================================
     */
    public function changePassword(Request $request)
    {
        $user = $request->user();

        return view('customer.change-password', [
            'user' => $user,
        ]);
    }


    /**
     * =========================================================
     * PROSES UBAH PASSWORD
     * =========================================================
     */
    public function updatePassword(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | USER YANG SEDANG LOGIN
        |--------------------------------------------------------------------------
        */
        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | VALIDASI PASSWORD
        |--------------------------------------------------------------------------
        */
        $request->validate(
            [
                'current_password' => [
                    'required',
                    function ($attribute, $value, $fail) use ($user) {

                        if (!Hash::check($value, $user->password)) {
                            $fail('Password saat ini salah.');
                        }
                    },
                ],

               'password' => [
    'required',
    'string',
    'min:8',
    'confirmed',
    'different:current_password',
],
            ],
            [
                'current_password.required' =>
                    'Password saat ini wajib diisi.',

                'password.required' =>
                    'Password baru wajib diisi.',

                'password.min' =>
                    'Password baru minimal 6 karakter.',

                'password.confirmed' =>
                    'Konfirmasi password tidak sama.',

                'password.different' =>
                    'Password baru harus berbeda dengan password lama.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PASSWORD BARU
        |--------------------------------------------------------------------------
        |
        | Password akan disimpan menggunakan Hash.
        |
        */
        $user->password = Hash::make(
            $request->password
        );

        $user->save();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT KE PROFILE
        |--------------------------------------------------------------------------
        |
        | Setelah password berhasil diubah, customer langsung
        | diarahkan ke halaman Profile.
        |
        */
        return redirect()
            ->route('customer.profile')
            ->with(
                'success',
                'Password berhasil diubah.'
            );
    }
}