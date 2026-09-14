@extends('layouts.staff')

@section('title', 'Dashboard Staff - SAÉ CAFE ROJEL')

@section('content')

<style>
/* =========================================================
       DASHBOARD
    ========================================================== */

.staff-dashboard {
    width: 100%;
    min-width: 0;
}


/* =========================================================
       PAGE HEADER
    ========================================================== */

.staff-page-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;

    gap: 18px;

    margin-bottom: 20px;
}


.staff-page-eyebrow {
    color: #8D745E;

    font-size: 11px;
    line-height: 16px;

    font-weight: 700;

    letter-spacing: .08em;

    text-transform: uppercase;
}


.staff-page-title {
    margin: 4px 0 0;

    color: #171717;

    font-size: 28px;
    line-height: 36px;

    font-weight: 700;
}


.staff-page-subtitle {
    margin: 6px 0 0;

    color: #7B6A5D;

    font-size: 13px;
    line-height: 19px;
}


/* =========================================================
       BUTTON
    ========================================================== */

.staff-primary-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-height: 44px;

    padding: 11px 16px;

    border-radius: 12px;

    background: #4A2E1F;

    color: #FFFFFF;

    font-size: 13px;
    font-weight: 600;

    text-decoration: none;

    white-space: nowrap;

    transition:
        background-color .2s ease,
        transform .2s ease;
}


.staff-primary-button:hover {
    background: #5B3927;
}


.staff-primary-button:active {
    transform: translateY(1px);
}


/* =========================================================
       KPI
    ========================================================== */

.staff-kpis {
    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 14px;

    margin-bottom: 20px;
}


.staff-kpi-card {
    min-width: 0;

    padding: 18px;

    background: #FFFFFF;

    border:
        1px solid #EADFD1;

    border-radius: 16px;

    box-shadow:
        0 6px 20px rgba(48, 31, 21, .04);
}


.staff-kpi-label {
    color: #8A7667;

    font-size: 12px;
    line-height: 17px;
}


.staff-kpi-value {
    margin-top: 6px;

    color: #171717;

    font-size: 28px;
    line-height: 34px;

    font-weight: 700;
}


.staff-kpi-caption {
    margin-top: 2px;

    color: #9A8779;

    font-size: 11px;
    line-height: 16px;
}


/* =========================================================
       MAIN GRID
    ========================================================== */

.staff-dashboard-grid {
    display: grid;

    grid-template-columns:
        minmax(0, 1.5fr) minmax(280px, .8fr);

    gap: 16px;
}


/* =========================================================
       PANEL
    ========================================================== */

.staff-panel {
    min-width: 0;

    overflow: hidden;

    background: #FFFFFF;

    border:
        1px solid #EADFD1;

    border-radius: 16px;

    box-shadow:
        0 8px 24px rgba(48, 31, 21, .04);
}


.staff-panel-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 12px;

    padding: 16px 18px;

    background: #4A2E1F;

    color: #FFFFFF;
}


.staff-panel-title {
    color: #FFFFFF;

    font-size: 15px;
    line-height: 20px;

    font-weight: 700;
}


.staff-panel-subtitle {
    margin-top: 2px;

    color: rgba(255, 255, 255, .72);

    font-size: 10px;
    line-height: 15px;
}


.staff-panel-link {
    color: #FFFFFF;

    font-size: 11px;
    font-weight: 600;

    text-decoration: none;

    white-space: nowrap;
}


.staff-panel-link:hover {
    text-decoration: underline;
}


/* =========================================================
       TABLE
    ========================================================== */

.staff-table-wrap {
    width: 100%;

    overflow-x: auto;
}


.staff-table {
    width: 100%;

    min-width: 620px;

    border-collapse: collapse;

    font-size: 12px;
}


.staff-table thead {
    background: #F7F3ED;

    color: #7B6A5D;
}


.staff-table th {
    padding: 11px 12px;

    text-align: left;

    font-size: 11px;

    font-weight: 600;

    white-space: nowrap;
}


.staff-table td {
    padding: 12px;

    border-top:
        1px solid #F1ECE6;

    color: #4B443F;

    white-space: nowrap;
}


.staff-table tbody tr:hover {
    background: #FFFCF8;
}


.staff-code {
    color: #171717;

    font-weight: 600;
}


.staff-point {
    color: #15803D;

    font-weight: 700;
}


.staff-empty {
    padding: 30px 20px;

    color: #9A8779;

    text-align: center;

    font-size: 12px;
}


/* =========================================================
       QUICK ACTIONS
    ========================================================== */

.staff-actions {
    display: grid;

    gap: 10px;

    padding: 16px;
}


.staff-action {
    display: flex;
    align-items: center;

    gap: 12px;

    padding: 13px;

    background: #FFFFFF;

    border:
        1px solid #EADFD1;

    border-radius: 13px;

    color: #171717;

    text-decoration: none;

    transition:
        border-color .2s ease,
        background-color .2s ease;
}


.staff-action:hover {
    background: #FFF9F2;

    border-color: #DCC8B8;
}


.staff-action-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 38px;
    height: 38px;

    flex-shrink: 0;

    border-radius: 11px;

    background: #F7F3ED;

    color: #4A2E1F;
}


.staff-action-icon svg {
    width: 19px;
    height: 19px;
}


.staff-action-copy {
    min-width: 0;
}


.staff-action-title {
    color: #171717;

    font-size: 13px;
    line-height: 18px;

    font-weight: 600;
}


.staff-action-subtitle {
    margin-top: 2px;

    color: #8A7667;

    font-size: 10px;
    line-height: 15px;
}


/* =========================================================
       TABLET
    ========================================================== */

@media (max-width: 1024px) {

    .staff-dashboard-grid {
        grid-template-columns: 1fr;
    }

    .staff-kpis {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }
}


/* =========================================================
       MOBILE
    ========================================================== */

@media (max-width: 640px) {

    .staff-page-header {
        align-items: stretch;

        flex-direction: column;

        gap: 12px;

        margin-bottom: 16px;
    }


    .staff-page-title {
        font-size: 24px;

        line-height: 31px;
    }


    .staff-page-subtitle {
        font-size: 12px;
    }


    .staff-primary-button {
        width: 100%;
    }


    .staff-kpis {
        grid-template-columns: 1fr;

        gap: 10px;
    }


    .staff-kpi-card {
        padding: 15px;
    }


    .staff-kpi-value {
        font-size: 24px;
        line-height: 30px;
    }


    .staff-panel-header {
        padding: 14px 15px;
    }


    .staff-actions {
        padding: 14px;
    }

}
</style>


<div class="staff-dashboard">


    {{-- =====================================================
        HEADER
    ====================================================== --}}
    <div class="staff-page-header">

        <div>

            <div class="staff-page-eyebrow">
                OPERASIONAL
            </div>

            <h1 class="staff-page-title">
                Halo, {{ auth()->user()->username }}
            </h1>

            <p class="staff-page-subtitle">
                Kelola member, transaksi, dan redemption dengan cepat.
            </p>

        </div>

    </div>


    {{-- =====================================================
        KPI
    ====================================================== --}}
    <div class="staff-kpis">

        {{-- MEMBER BARU --}}
        <div class="staff-kpi-card">

            <div class="staff-kpi-label">
                Member Baru
            </div>

            <div class="staff-kpi-value">
                {{ $customersToday }}
            </div>

            <div class="staff-kpi-caption">
                hari ini
            </div>

        </div>


        {{-- TRANSAKSI --}}
        <div class="staff-kpi-card">

            <div class="staff-kpi-label">
                Transaksi
            </div>

            <div class="staff-kpi-value">
                {{ $transactionsToday }}
            </div>

            <div class="staff-kpi-caption">
                hari ini
            </div>

        </div>


        {{-- POINT --}}
        <div class="staff-kpi-card">

            <div class="staff-kpi-label">
                Point Masuk
            </div>

            <div class="staff-kpi-value">
                +{{ $pointsToday }}
            </div>

            <div class="staff-kpi-caption">
                point hari ini
            </div>

        </div>


        {{-- REDEEM --}}
        <div class="staff-kpi-card">

            <div class="staff-kpi-label">
                Redeem Pending
            </div>

            <div class="staff-kpi-value">
                {{ $pendingRedemptions }}
            </div>

            <div class="staff-kpi-caption">
                perlu diproses
            </div>

        </div>

    </div>


    {{-- =====================================================
        CONTENT GRID
    ====================================================== --}}
    <div class="staff-dashboard-grid">


        {{-- =================================================
            TRANSAKSI TERBARU
        ================================================== --}}
        <section class="staff-panel">

            <div class="staff-panel-header">

                <div>

                    <h2 class="staff-panel-title">
                        Transaksi Terbaru
                    </h2>

                    <p class="staff-panel-subtitle">
                        Aktivitas transaksi terbaru
                    </p>

                </div>


                <a href="{{ route('staff.customers') }}" class="staff-panel-link">
                    Buat Transaksi
                </a>

            </div>


            <div class="staff-table-wrap">

                <table class="staff-table">
                    <tbody>

                        @forelse($recentTransactions as $transaction)

                        <tr>

                            <td class="staff-code">
                                {{ $transaction->kode_transaksi }}
                            </td>

                            <td>
                                {{ $transaction->customer->nama ?? '-' }}
                            </td>

                            <td>
                                Rp {{ number_format(
                                        $transaction->total_belanja,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                            </td>

                            <td class="staff-point">
                                +{{ $transaction->point_didapat }}
                            </td>

                            <td>
                                {{ $transaction->tanggal_transaksi?->format('d M H:i') }}
                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="staff-empty">
                                Belum ada transaksi.
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>


        {{-- =================================================
            OPERASIONAL
        ================================================== --}}
        <section class="staff-panel">

            <div class="staff-panel-header">

                <div>

                    <h2 class="staff-panel-title">
                        Operasional
                    </h2>

                    <p class="staff-panel-subtitle">
                        Akses cepat Staff
                    </p>

                </div>

            </div>


            <div class="staff-actions">


                {{-- CARI MEMBER --}}
                <a href="{{ route('staff.customers') }}" class="staff-action">

                    <div class="staff-action-icon">

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="11" cy="11" r="6" />

                            <path stroke-linecap="round" d="m16 16 4 4" />
                        </svg>

                    </div>


                    <div class="staff-action-copy">

                        <div class="staff-action-title">
                            Cari Member
                        </div>

                        <div class="staff-action-subtitle">
                            Cari member untuk transaksi
                        </div>

                    </div>

                </a>


                {{-- REDEMPTION --}}
                <a href="{{ route('staff.redemptions') }}" class="staff-action">

                    <div class="staff-action-icon">

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4z" />

                            <path d="M14 14h2v2h-2zM18 14h2v2h-2zM14 18h2v2h-2zM18 18h2v2h-2z" />
                        </svg>

                    </div>


                    <div class="staff-action-copy">

                        <div class="staff-action-title">
                            Proses Redemption
                        </div>

                        <div class="staff-action-subtitle">
                            Konfirmasi atau batalkan redeem
                        </div>

                    </div>

                </a>


                {{-- REWARD --}}
                <a href="{{ route('staff.rewards') }}" class="staff-action">

                    <div class="staff-action-icon">

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="3" y="8" width="18" height="12" rx="2" />

                            <path d="M12 8v12" />
                            <path d="M3 12h18" />

                            <path
                                d="M7.5 8C6.12 8 5 6.88 5 5.5S6.12 3 7.5 3c2.25 0 4.5 5 4.5 5s2.25-5 4.5-5C17.88 3 19 4.12 19 5.5S17.88 8 16.5 8" />

                        </svg>

                    </div>


                    <div class="staff-action-copy">

                        <div class="staff-action-title">
                            Lihat Reward
                        </div>

                        <div class="staff-action-subtitle">
                            Cek reward yang tersedia
                        </div>

                    </div>

                </a>

            </div>

        </section>


    </div>

</div>

@endsection