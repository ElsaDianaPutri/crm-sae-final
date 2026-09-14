<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Redemption;
use App\Models\Reward;
use App\Models\Transaction;
use App\Services\RedemptionService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class StaffController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService,
        protected RedemptionService $redemptionService,
    ) {
    }

    public function dashboard()
    {
        return view('staff.dashboard', [
            'customersToday' => Customer::whereDate('created_at', today())->count(),
            'transactionsToday' => Transaction::whereDate('tanggal_transaksi', today())->count(),
            'pointsToday' => Transaction::whereDate('tanggal_transaksi', today())->sum('point_didapat'),
            'pendingRedemptions' => Redemption::where('status', 'pending')->count(),
            'recentTransactions' => Transaction::with('customer')->latest('tanggal_transaksi')->limit(8)->get(),
        ]);
    }

    public function customers(Request $request)
{
    $search = trim((string) $request->input('search', ''));

    $customers = Customer::query()
        ->when($search !== '', function ($q) use ($search) {

            $q->where(function ($inner) use ($search) {

                $inner
                    ->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nomor_hp', 'like', '%' . $search . '%')
                    ->orWhere('member_code', 'like', '%' . $search . '%')
                    ->orWhere('qr_code', 'like', '%' . $search . '%');

            });

        })
        ->latest()
        ->paginate(12)
        ->withQueryString();


    /*
    |--------------------------------------------------------------------------
    | AJAX / LIVE SEARCH
    |--------------------------------------------------------------------------
    */

    if ($request->ajax()) {

        return view(
            'staff.partials.customer-list',
            compact('customers')
        );
    }


    return view(
        'staff.customers',
        compact('customers')
    );
}

public function createCustomer()
{
    return view('staff.customer-create');
}

public function storeCustomer(Request $request)
{
    $validated = $request->validate([
        'nama' => [
            'required',
            'string',
            'max:100',
        ],

        'nomor_hp' => [
            'required',
            'string',
            'regex:/^08[0-9]{8,12}$/',
            'unique:users,username',
            'unique:customers,nomor_hp',
        ],

        'email' => [
            'nullable',
            'email',
            'max:255',
        ],

        'tanggal_lahir' => [
            'nullable',
            'date',
        ],

        'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
        ],
    ], [
        'nomor_hp.unique' =>
            'Nomor WhatsApp tersebut sudah terdaftar sebagai member.',

        'nomor_hp.regex' =>
            'Nomor WhatsApp harus diawali 08 dan berisi 10-14 digit.',

        'password.confirmed' =>
            'Konfirmasi password tidak cocok.',
    ]);

    try {

        $customer = DB::transaction(function () use ($validated) {

            $user = User::create([
                'username' => $validated['nomor_hp'],
                'password' => Hash::make($validated['password']),
                'role' => 'customer',
                'status' => 'aktif',
            ]);

            /*
             * Gunakan kode sementara yang pasti unik.
             * Setelah customer dibuat, database akan memberikan
             * id_customer secara otomatis.
             */
            $temporaryMemberCode = 'TMP-' . Str::uuid();

            $customer = Customer::create([
                'id_user' => $user->id_user,

                'member_code' => $temporaryMemberCode,

                'qr_code' =>
                    'SAE-QR-' . strtoupper(Str::random(12)),

                'nama' => $validated['nama'],

                'nomor_hp' => $validated['nomor_hp'],

                'email' =>
                    $validated['email'] ?? null,

                'tanggal_lahir' =>
                    $validated['tanggal_lahir'] ?? null,

                'tanggal_daftar' => now(),

                'saldo_point' => 0,

                'status_member' => 'aktif',
            ]);

            /*
             * Gunakan ID customer yang benar-benar diberikan
             * oleh database untuk membentuk member_code.
             */
            $customer->member_code =
                'SAE' . str_pad(
                    $customer->id_customer,
                    5,
                    '0',
                    STR_PAD_LEFT
                );

            $customer->save();

            return $customer;
        });

        return redirect()
            ->route('staff.customers')
            ->with(
                'success',
                "Member {$customer->nama} berhasil dibuat. " .
                "Member Code: {$customer->member_code}."
            );

    } catch (\Throwable $e) {

        Log::error('Gagal membuat customer dari staff', [
            'exception' => $e,
            'nomor_hp' => $validated['nomor_hp'] ?? null,
        ]);

        return back()
            ->withErrors([
                'customer' =>
                    'Customer gagal dibuat. Silakan coba lagi.'
            ])
            ->withInput();
    }
}

public function transactions(Request $request)
{
    $search = trim((string) $request->input('search', ''));
    $source = trim((string) $request->input('source', ''));

    $transactions = Transaction::query()
        ->with('customer')
        ->when($search !== '', function ($query) use ($search) {

            $query->where(function ($q) use ($search) {

                $q->where(
                    'kode_transaksi',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhereHas('customer', function ($customerQuery) use ($search) {

                    $customerQuery
                        ->where(
                            'nama',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'member_code',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'nomor_hp',
                            'like',
                            '%' . $search . '%'
                        );

                });

            });

        })
        ->when(
            in_array($source, ['manual', 'moka'], true),
            fn ($query) => $query->where('source', $source)
        )
        ->latest('tanggal_transaksi')
        ->paginate(15)
        ->withQueryString();

    if ($request->ajax()) {
        return view(
            'staff.partials.transaction-list',
            compact('transactions')
        );
    }

    return view(
        'staff.transactions',
        compact('transactions')
    );
}

    public function findCustomer(Request $request)
    {
        $data = $request->validate(['qr_code' => ['nullable', 'string'], 'keyword' => ['nullable', 'string']]);
        $keyword = $data['qr_code'] ?? $data['keyword'] ?? '';

        if ($keyword === '') {
            return back()->withErrors(['keyword' => 'Masukkan QR member, member code, nomor WhatsApp, atau nama.']);
        }

        $customer = Customer::where(fn ($q) => $q
            ->where('qr_code', $keyword)
            ->orWhere('member_code', $keyword)
            ->orWhere('nomor_hp', $keyword)
            ->orWhere('nama', 'like', "%{$keyword}%"))
            ->first();

        if (!$customer) {
            return back()->withErrors(['keyword' => 'Member tidak ditemukan.'])->withInput();
        }

        return redirect()->route(
    'staff.transactions.create',
    ['id_customer' => $customer->id_customer]
);
    }

    public function scanCustomer(Request $request)
{
    $data = $request->validate([
        'qr_code' => ['required', 'string'],
    ]);

    $customer = Customer::where(
        'qr_code',
        $data['qr_code']
    )->first();

    if (!$customer) {
        return response()->json([
            'message' => 'Member tidak ditemukan.',
        ], 404);
    }

    return response()->json([
        'message' => 'Data member ditemukan.',
        'data' => [
            'id_customer' => $customer->id_customer,
            'nama' => $customer->nama,
            'member_code' => $customer->member_code,
            'nomor_hp' => $customer->nomor_hp,
            'saldo_point' => $customer->saldo_point,
            'status_member' => $customer->status_member,
        ],
    ]);
}

    public function createTransaction(int $id_customer)
{
    $customer = Customer::findOrFail($id_customer);

    return view('staff.transaction', compact('customer'));
}

   public function storeTransaction(Request $request)
{
    $data = $request->validate([
        'id_customer' => [
            'required',
            'exists:customers,id_customer',
        ],
        'total_belanja' => [
            'required',
            'integer',
            'min:1',
        ],
    ]);

    try {
        $customer = Customer::findOrFail(
            $data['id_customer']
        );

        $transaction = $this->transactionService
            ->createManualTransaction(
                $customer,
                [
                    'total_belanja' =>
                        $data['total_belanja'],

                    'kode_transaksi' =>
                        'TRX-' .
                        now()->format('ymdHis') .
                        '-' .
                        strtoupper(Str::random(4)),
                ]
            );

        return redirect()
            ->route('staff.transactions')
            ->with(
                'success',
                "Transaksi {$transaction->kode_transaksi} " .
                "berhasil. Point +{$transaction->point_didapat}."
            );

    } catch (\RuntimeException $e) {

        return back()
            ->withErrors([
                'transaction' => $e->getMessage(),
            ])
            ->withInput();

    } catch (\Throwable $e) {

        Log::error(
            'Gagal membuat transaksi manual dari staff',
            [
                'id_customer' =>
                    $data['id_customer'] ?? null,

                'exception' => $e,
            ]
        );

        return back()
            ->withErrors([
                'transaction' =>
                    'Transaksi gagal diproses. Silakan coba lagi.',
            ])
            ->withInput();
    }
}

 public function redemptions(
    Request $request,
    RedemptionService $redemptionService
) {
    $customerId = $request->input('customer');

    $selectedCustomer = null;

    if ($customerId) {

        $selectedCustomer = Customer::find($customerId);

        if ($selectedCustomer) {
            $redemptionService->reconcilePending($selectedCustomer);
        }
    }

    $query = Redemption::with([
        'customer',
        'reward'
    ]);

    if ($customerId) {
        $query->where(
            'id_customer',
            $customerId
        );
    }

    $redemptions = $query
        ->orderByRaw("
            CASE
                WHEN status = 'pending' THEN 0
                ELSE 1
            END
        ")
        ->latest('created_at')
        ->paginate(12)
        ->withQueryString();

    /*
     * Redemption pending berikutnya
     * yang harus dikonfirmasi sesuai urutan dibuat.
     */
    $nextPendingRedemption = null;

    if ($customerId) {

        $nextPendingRedemption = Redemption::with([
                'customer',
                'reward'
            ])
            ->where('id_customer', $customerId)
            ->where('status', 'pending')
            ->orderBy('created_at')
            ->orderBy('id_redemption')
            ->first();
    }

    return view('staff.redemptions', [
        'redemptions' => $redemptions,
        'selectedCustomer' => $selectedCustomer,
        'nextPendingRedemption' => $nextPendingRedemption,
    ]);
}

public function confirmRedemption(Request $request)
{
    $data = $request->validate([
        'redemption_code' => ['required', 'string'],
    ]);

    try {
        /*
        |--------------------------------------------------------------------------
        | Ambil redemption
        |--------------------------------------------------------------------------
        */
        $redemption = Redemption::where(
            'redemption_code',
            $data['redemption_code']
        )->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Hanya redemption pending yang boleh dikonfirmasi
        |--------------------------------------------------------------------------
        */
        if ($redemption->status !== 'pending') {
            throw new \RuntimeException(
                'Redemption ini sudah tidak berstatus pending.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FIFO
        |--------------------------------------------------------------------------
        */
        $nextPending = Redemption::query()
            ->where('id_customer', $redemption->id_customer)
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->orderBy('redemption_code', 'asc')
            ->first();

        if (
            !$nextPending ||
            $nextPending->redemption_code !==
                $redemption->redemption_code
        ) {
            throw new \RuntimeException(
                'Redemption belum dapat dikonfirmasi. ' .
                'Selesaikan redemption sebelumnya terlebih dahulu.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Proses konfirmasi melalui service
        |--------------------------------------------------------------------------
        */
        $confirmed = $this->redemptionService->confirm(
            $redemption->redemption_code
        );

        return redirect()
            ->route('staff.redemptions', [
                'customer' => $redemption->id_customer,
            ])
            ->with(
                'success',
                "Redemption {$confirmed->redemption_code} berhasil dikonfirmasi."
            );

    } catch (\RuntimeException $e) {

        /*
        | Business error:
        | pesan aman untuk ditampilkan kepada staff.
        */
        return back()
            ->withErrors([
                'redemption_code' => $e->getMessage(),
            ])
            ->withInput();

    } catch (\Throwable $e) {

        /*
        | Unexpected error:
        | simpan detail untuk developer, jangan tampilkan
        | exception asli kepada user.
        */
        Log::error('Gagal mengonfirmasi redemption dari staff', [
            'redemption_code' => $data['redemption_code'] ?? null,
            'exception' => $e,
        ]);

        return back()
            ->withErrors([
                'redemption_code' =>
                    'Terjadi kesalahan saat mengonfirmasi redemption. Silakan coba lagi.',
            ])
            ->withInput();
    }
}

    public function cancelRedemption(Request $request)
{
    $data = $request->validate([
        'redemption_code' => ['required', 'string'],
    ]);

    try {
        $this->redemptionService->cancel(
            $data['redemption_code']
        );

        return back()->with(
            'success',
            'Redemption berhasil dibatalkan.'
        );

    } catch (\RuntimeException $e) {

        /*
        | Business error:
        | tetap aman ditampilkan kepada staff.
        */
        return back()
            ->withErrors([
                'redemption_code' => $e->getMessage(),
            ])
            ->withInput();

    } catch (\Throwable $e) {

        /*
        | Unexpected error:
        | detail disimpan di log.
        */
        Log::error('Gagal membatalkan redemption dari staff', [
            'redemption_code' => $data['redemption_code'] ?? null,
            'exception' => $e,
        ]);

        return back()
            ->withErrors([
                'redemption_code' =>
                    'Terjadi kesalahan saat membatalkan redemption. Silakan coba lagi.',
            ])
            ->withInput();
    }
}

    public function rewards(Request $request)
{
    $search = trim((string) $request->input('search', ''));

    $rewards = Reward::query()
        ->where('status', 'tersedia')
        ->where('stock', '>', 0)
        ->when($search !== '', function ($query) use ($search) {
            $query->where(function ($q) use ($search) {

                $q->where('reward_name', 'like', '%' . $search . '%')
                    ->orWhere('point_required', $search);

            });
        })
        ->latest()
        ->get();

    if ($request->ajax()) {
        return view(
            'staff.partials.reward-list',
            compact('rewards')
        );
    }

    return view(
        'staff.rewards',
        compact('rewards')
    );
}
}