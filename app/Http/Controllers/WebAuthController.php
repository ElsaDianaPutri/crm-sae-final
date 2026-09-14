<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WebAuthController extends Controller
{
    public function login()
    {
        return view('customer.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username atau nomor WhatsApp wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if (!$user || $user->status !== 'aktif' || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['username' => 'Username/nomor WhatsApp atau password salah.'])
                ->withInput($request->only('username'));
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'staff' => redirect()->route('staff.dashboard'),
            default => redirect()->route('customer.dashboard'),
        };
    }

    public function register()
    {
        return view('customer.register');
    }

    public function registerStore(Request $request, WhatsAppService $whatsApp)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'nomor_hp' => ['required', 'string', 'regex:/^08[0-9]{8,12}$/', 'unique:users,username', 'unique:customers,nomor_hp'],
            'email' => ['nullable', 'email', 'max:255'],
            'password' => [
    'required',
    'string',
    'min:8',
    'confirmed',
],
            'tanggal_lahir' => ['nullable', 'date'],
        ]);

        $otp = (string) random_int(100000, 999999);
        $request->session()->put('registration', [
            'nama' => $validated['nama'],
            'nomor_hp' => $validated['nomor_hp'],
            'email' => $validated['email'] ?? null,
            'password' => Hash::make($validated['password']),
            'otp_hash' => Hash::make($otp),
            'otp_expires_at' => now()->addMinutes(5)->timestamp,
            'attempts' => 0,
        ]);
        $request->session()->put('registration_otp_debug', app()->environment('local') ? $otp : null);
        $whatsApp->sendOtp($validated['nomor_hp'], $otp);

        return redirect()->route('register.verify')->with('success', 'Kode OTP telah dikirim ke WhatsApp.');
    }

    public function verifyRegistration(Request $request)
    {
        abort_unless($request->session()->has('registration'), 419, 'Sesi pendaftaran sudah kedaluwarsa.');
        return view('customer.register-otp', ['debugOtp' => $request->session()->get('registration_otp_debug')]);
    }

    public function verifyRegistrationStore(Request $request, WhatsAppService $whatsApp)
    {
        $request->validate(['otp' => ['required', 'digits:6']]);
        $registration = $request->session()->get('registration');

        if (!$registration) {
            return redirect()->route('register')->withErrors(['register' => 'Sesi pendaftaran sudah kedaluwarsa.']);
        }

        if (now()->timestamp > $registration['otp_expires_at']) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kedaluwarsa.']);
        }

        $registration['attempts'] = (int) ($registration['attempts'] ?? 0) + 1;
        if ($registration['attempts'] > 5) {
            $request->session()->forget(['registration', 'registration_otp_debug']);
            return redirect()->route('register')->withErrors(['register' => 'Batas percobaan OTP terlampaui. Silakan daftar kembali.']);
        }

        if (!Hash::check($request->otp, $registration['otp_hash'])) {
            $request->session()->put('registration', $registration);
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }

        $customer = DB::transaction(function () use ($registration) {
    $user = User::create([
        'username' => $registration['nomor_hp'],
        'password' => $registration['password'],
        'role' => 'customer',
        'status' => 'aktif',
    ]);

    /*
     * Gunakan kode sementara yang pasti unik.
     * UUID mencegah dua registrasi bersamaan
     * mendapatkan member_code sementara yang sama.
     */
    $temporaryMemberCode = 'TMP-' . Str::uuid();

    $customer = Customer::create([
        'id_user' => $user->id_user,
        'member_code' => $temporaryMemberCode,
        'qr_code' => 'SAE-QR-' . strtoupper(Str::random(12)),
        'nama' => $registration['nama'],
        'nomor_hp' => $registration['nomor_hp'],
        'email' => $registration['email'],
        'tanggal_daftar' => now(),
        'saldo_point' => 0,
        'status_member' => 'aktif',
    ]);

    /*
     * ID customer diberikan oleh database.
     * Kita gunakan ID tersebut untuk membentuk member_code.
     */
    $customer->member_code = 'SAE' . str_pad(
        $customer->id_customer,
        5,
        '0',
        STR_PAD_LEFT
    );

    $customer->save();

    return $customer;
});

        $request->session()->forget(['registration', 'registration_otp_debug']);
        $whatsApp->sendWelcome($customer->nomor_hp, $customer->nama, route('login'));

        return redirect()->route('login')->with('success', 'Selamat bergabung di SAE CAFE ROJEL. Akun member Anda sudah aktif.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}