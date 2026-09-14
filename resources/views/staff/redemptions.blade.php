@extends('layouts.staff')

@section('title', 'Redemption - Staff')

@section('content')

<style>
/* =========================================================
       PAGE
    ========================================================== */

.staff-redemption-page {
    width: 100%;
    min-width: 0;
}

.staff-redemption-header {
    margin-bottom: 20px;
}

.staff-selected-redemption-customer {
    display: flex;

    align-items: center;
    justify-content: space-between;

    gap: 16px;

    margin-bottom: 18px;

    padding: 15px 16px;

    background: #FFF9F2;

    border: 1px solid #EADFD1;

    border-radius: 14px;
}

.staff-selected-redemption-label {
    color: #8D745E;

    font-size: 10px;

    font-weight: 700;

    letter-spacing: .06em;

    text-transform: uppercase;
}

.staff-selected-redemption-name {
    margin-top: 4px;

    color: #171717;

    font-size: 15px;

    font-weight: 600;
}

.staff-selected-redemption-meta {
    margin-top: 2px;

    color: #8A7667;

    font-size: 11px;

    line-height: 17px;
}

.staff-selected-redemption-clear {
    flex-shrink: 0;

    min-height: 34px;

    padding: 8px 11px;

    border: 1px solid #D9C9BB;

    border-radius: 9px;

    background: #FFFFFF;

    color: #4A2E1F;

    font-size: 11px;

    font-weight: 600;

    text-decoration: none;

    white-space: nowrap;
}

.staff-selected-redemption-clear:hover {
    background: #FFF9F2;

    border-color: #C9B3A1;
}

.staff-redemption-title {
    margin: 0;

    color: #171717;

    font-size: 26px;
    line-height: 34px;

    font-weight: 600;
}

.staff-redemption-subtitle {
    margin: 5px 0 0;

    color: #7F6D60;

    font-size: 13px;
    line-height: 19px;
}


/* =========================================================
       CONFIRM FORM
    ========================================================== */

.staff-redemption-form-card {
    margin-bottom: 18px;

    padding: 18px;

    background: #FFFFFF;

    border:
        1px solid #EADFD1;

    border-radius: 16px;

    box-shadow:
        0 8px 24px rgba(48, 31, 21, .04);
}

.staff-redemption-form {
    display: grid;

    grid-template-columns:
        minmax(0, 1fr) auto;

    gap: 10px;
}

.staff-redemption-input {
    width: 100%;

    min-height: 44px;

    padding: 12px 13px;

    border:
        1px solid #DDD2C8;

    border-radius: 11px;

    background: #FFFFFF;

    color: #171717;

    font-family: inherit;

    font-size: 13px;

    outline: none;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}

.staff-redemption-input:focus {
    border-color: #4A2E1F;

    box-shadow:
        0 0 0 3px rgba(74, 46, 31, .08);
}

.staff-redemption-input::placeholder {
    color: #A49487;
}

.staff-redemption-button {
    min-height: 44px;

    padding: 12px 18px;

    border: 0;

    border-radius: 11px;

    background: #4A2E1F;

    color: #FFFFFF;

    font-family: inherit;

    font-size: 13px;

    font-weight: 600;

    cursor: pointer;

    transition:
        background-color .2s ease;
}

.staff-redemption-button:hover {
    background: #5B3927;
}

.staff-redemption-help {
    margin: 9px 0 0;

    color: #968476;

    font-size: 11px;

    line-height: 16px;
}


/* =========================================================
       TABLE CARD
    ========================================================== */

.staff-redemption-table-card {
    width: 100%;

    overflow: hidden;

    background: #FFFFFF;

    border:
        1px solid #EADFD1;

    border-radius: 16px;

    box-shadow:
        0 8px 24px rgba(48, 31, 21, .04);
}

.staff-redemption-table-wrap {
    width: 100%;

    overflow-x: auto;
}

.staff-redemption-table {
    width: 100%;

    min-width: 820px;

    border-collapse: collapse;

    font-size: 12px;
}

.staff-redemption-table thead {
    background: #4A2E1F;

    color: #FFFFFF;
}

.staff-redemption-table th {
    padding: 13px 12px;

    text-align: left;

    font-size: 11px;

    font-weight: 600;

    white-space: nowrap;
}

.staff-redemption-table td {
    padding: 13px 12px;

    border-top:
        1px solid #F0ECE8;

    color: #4B443F;

    white-space: nowrap;
}

.staff-redemption-table tbody tr:hover {
    background: #FFFCF8;
}


/* =========================================================
       CODE
    ========================================================== */

.staff-redemption-code {
    color: #171717;

    font-weight: 600;
}


/* =========================================================
       POINT DIGUNAKAN
    ========================================================== */

.staff-redemption-point {
    color: #B91C1C;

    font-weight: 700;
}


/* =========================================================
       STATUS
    ========================================================== */

.staff-redemption-status {
    display: inline-flex;

    align-items: center;

    justify-content: center;

    min-height: 26px;

    padding: 4px 9px;

    border-radius: 999px;

    font-size: 10px;

    font-weight: 600;

    text-transform: capitalize;
}

.staff-redemption-status.success {
    background: #DCFCE7;

    color: #15803D;
}

.staff-redemption-status.pending {
    background: #FEF3C7;

    color: #B45309;
}

.staff-redemption-status.failed {
    background: #FEE2E2;

    color: #B91C1C;
}


/* =========================================================
       OK BUTTON
    ========================================================== */

.staff-redemption-ok {
    min-height: 32px;

    padding: 6px 10px;

    border: 0;

    border-radius: 8px;

    background: #4A2E1F;

    color: #FFFFFF;

    font-family: inherit;

    font-size: 11px;

    font-weight: 600;

    cursor: pointer;
}

.staff-redemption-ok:hover {
    background: #5B3927;
}


/* =========================================================
       EMPTY
    ========================================================== */

.staff-redemption-empty {
    padding: 30px 20px !important;

    text-align: center;

    color: #9A8779 !important;
}


/* =========================================================
       PAGINATION
    ========================================================== */

.staff-redemption-pagination {
    margin-top: 16px;
}


/* =========================================================
       RESPONSIVE
    ========================================================== */

@media (max-width: 640px) {

    .staff-selected-redemption-customer {
        align-items: flex-start;

        flex-direction: column;
    }

    .staff-selected-redemption-clear {
        width: 100%;

        text-align: center;
    }

    .staff-redemption-title {
        font-size: 23px;

        line-height: 30px;
    }

    .staff-redemption-form {
        grid-template-columns: 1fr;
    }

    .staff-redemption-button {
        width: 100%;
    }

    .staff-redemption-form-card {
        padding: 15px;
    }

    .staff-redemption-table-card {
        border-radius: 14px;
    }

}
</style>


<div class="staff-redemption-page">


    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="staff-redemption-header">

        <h1 class="staff-redemption-title">
            Konfirmasi Redemption
        </h1>

        <p class="staff-redemption-subtitle">
            Customer membuat redemption pending; staff mengonfirmasi
            setelah QR/kode diverifikasi.
        </p>

    </div>


    @if($selectedCustomer)

    <div style="
        margin-bottom:18px;
        padding:14px 16px;
        background:#FFF9F2;
        border:1px solid #EADFD1;
        border-radius:14px;
    ">

        <div style="
            font-size:10px;
            color:#8D745E;
            font-weight:700;
            text-transform:uppercase;
            letter-spacing:.06em;
        ">
            Customer dari Scan QR
        </div>

        <div style="
            margin-top:4px;
            font-size:15px;
            font-weight:600;
            color:#171717;
        ">
            {{ $selectedCustomer->nama }}
        </div>

        <div style="
            margin-top:2px;
            font-size:11px;
            color:#8A7667;
        ">
            {{ $selectedCustomer->member_code }}
            •
            {{ $selectedCustomer->nomor_hp }}
            •
            {{ number_format($selectedCustomer->saldo_point) }} Point
        </div>

    </div>

    @endif


    {{-- =====================================================
        FORM KONFIRMASI
    ====================================================== --}}

    <div class="staff-redemption-form-card">

        @if($selectedCustomer)

        <div class="staff-redemption-form-card">

            @if($nextPendingRedemption)

            <div style="
            margin-bottom:10px;
            color:#6B5D53;
            font-size:12px;
        ">
                Redemption berikutnya yang harus dikonfirmasi:
            </div>

            <div style="
            padding:12px 14px;
            margin-bottom:12px;
            background:#FFF9F2;
            border:1px solid #EADFD1;
            border-radius:11px;
        ">

                <div style="
                color:#171717;
                font-size:13px;
                font-weight:600;
            ">
                    {{ $nextPendingRedemption->redemption_code }}
                </div>

                <div style="
                margin-top:3px;
                color:#8A7667;
                font-size:11px;
            ">
                    {{ $nextPendingRedemption->reward->reward_name ?? '-' }}
                    •
                    {{ number_format($nextPendingRedemption->point_used) }} Point
                </div>

            </div>

            <form method="POST" action="{{ route('staff.redemptions.confirm') }}">
                @csrf

                <input type="hidden" name="redemption_code" value="{{ $nextPendingRedemption->redemption_code }}">

                <button type="submit" class="staff-redemption-button" style="width:100%;">
                    Konfirmasi Redemption Berikutnya
                </button>

            </form>

            <p class="staff-redemption-help">
                Redemption dikonfirmasi sesuai urutan dibuat.
            </p>

            @else

            <div style="
            color:#6B5D53;
            font-size:12px;
        ">
                Tidak ada redemption pending untuk customer ini.
            </div>

            @endif

        </div>

        @endif


        <p class="staff-redemption-help">
            Setelah dikonfirmasi, point customer dan stock reward
            akan dikurangi secara atomic.
        </p>

    </div>


    {{-- =====================================================
        TABLE REDEMPTION
    ====================================================== --}}
    @if($selectedCustomer)

    <div style="
        margin-bottom:10px;
        color:#171717;
        font-size:14px;
        font-weight:600;
    ">
        Redemption {{ $selectedCustomer->nama }}
    </div>

    @else

    <div style="
        margin-bottom:10px;
        color:#171717;
        font-size:14px;
        font-weight:600;
    ">
        Riwayat Redemption
    </div>

    @endif

    <div class="staff-redemption-table-card">

        <div class="staff-redemption-table-wrap">

            <table class="staff-redemption-table">

                <thead>

                    <tr>

                        <th>
                            Kode
                        </th>

                        <th>
                            Customer
                        </th>

                        <th>
                            Reward
                        </th>

                        <th>
                            Point Digunakan
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Waktu
                        </th>

                        @if($selectedCustomer)

                        <th>
                            Aksi
                        </th>

                        @endif

                    </tr>

                </thead>


                <tbody>

                    @forelse($redemptions as $redemption)

                    <tr>

                        {{-- KODE --}}
                        <td class="staff-redemption-code">
                            {{ $redemption->redemption_code ?? '-' }}
                        </td>

                        {{-- CUSTOMER --}}
                        <td>
                            {{ $redemption->customer->nama ?? '-' }}
                        </td>

                        {{-- REWARD --}}
                        <td>
                            {{ $redemption->reward->reward_name ?? '-' }}
                        </td>

                        {{-- POINT --}}
                        <td class="staff-redemption-point">
                            -{{ number_format($redemption->point_used) }}
                        </td>

                        {{-- STATUS --}}
                        <td>

                            @if($redemption->status === 'berhasil')

                            <span class="staff-redemption-status success">
                                Berhasil
                            </span>

                            @elseif($redemption->status === 'pending')

                            <span class="staff-redemption-status pending">
                                Pending
                            </span>

                            @else

                            <span class="staff-redemption-status failed">
                                {{ $redemption->status }}
                            </span>

                            @endif

                        </td>

                        {{-- WAKTU --}}
                        <td>
                            {{ $redemption->created_at?->format('d M H:i') ?? '-' }}
                        </td>

                        {{-- AKSI --}}
                        @if($selectedCustomer)

                        <td>

                            @if(
                            $redemption->status === 'pending' &&
                            $nextPendingRedemption &&
                            $redemption->redemption_code ===
                            $nextPendingRedemption->redemption_code
                            )

                            <form method="POST" action="{{ route('staff.redemptions.confirm') }}">
                                @csrf

                                <input type="hidden" name="redemption_code" value="{{ $redemption->redemption_code }}">

                                <button type="submit" class="staff-redemption-ok">
                                    Konfirmasi
                                </button>

                            </form>

                            @elseif($redemption->status === 'pending')

                            <span style="
                            color:#A49487;
                            font-size:10px;
                        ">
                                Menunggu giliran
                            </span>

                            @else

                            <span style="
                            color:#A49487;
                            font-size:10px;
                        ">
                                -
                            </span>

                            @endif

                        </td>

                        @endif

                    </tr>

                    @empty

                    <tr>

                        <td colspan="{{ $selectedCustomer ? 7 : 6 }}" class="staff-redemption-empty">

                            @if($selectedCustomer)

                            <div style="
                        font-weight:600;
                        color:#6B5D53;
                        margin-bottom:4px;
                    ">
                                Tidak ada redemption untuk
                                {{ $selectedCustomer->nama }}.
                            </div>

                            <div>
                                Customer ini belum memiliki redemption yang dapat ditampilkan.
                            </div>

                            @else

                            Belum ada redemption.

                            @endif

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =====================================================
        PAGINATION
    ====================================================== --}}

    <div class="staff-redemption-pagination">
        {{ $redemptions->links() }}
    </div>


</div>

@endsection