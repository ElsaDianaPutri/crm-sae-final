@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

<style>
/*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    | Unified Responsive Layout
    |--------------------------------------------------------------------------
    */

.dashboard-page {
    width: 100%;
    min-width: 0;
}

/*
    |--------------------------------------------------------------------------
    | STATISTICS
    |--------------------------------------------------------------------------
    */

.dashboard-stats {
    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 16px;
}

.dashboard-stat-card {
    min-width: 0;

    border: 1px solid #EADFD3;
    border-radius: 18px;

    background: #ffffff;

    padding: 20px;

    box-shadow:
        0 2px 10px rgba(52, 34, 23, 0.04);
}

.dashboard-stat-label {
    color: #75665C;

    font-size: 13px;
    line-height: 18px;

    font-weight: 500;
}

.dashboard-stat-value {
    margin-top: 8px;

    color: #111827;

    font-size: 28px;
    line-height: 34px;

    font-weight: 700;
}

/*
    |--------------------------------------------------------------------------
    | MAIN GRID
    |--------------------------------------------------------------------------
    */

.dashboard-main-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 16px;

    align-items: stretch;
}

/*
    |--------------------------------------------------------------------------
    | SECONDARY GRID
    |--------------------------------------------------------------------------
    */

.dashboard-secondary-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 16px;
}

/*
    |--------------------------------------------------------------------------
    | PANEL
    |--------------------------------------------------------------------------
    */

.dashboard-panel {
    min-width: 0;

    overflow: hidden;

    border: 1px solid #EADFD3;
    border-radius: 18px;

    background: #ffffff;

    box-shadow:
        0 2px 10px rgba(52, 34, 23, 0.04);
}

.dashboard-panel-header {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 12px;

    padding: 18px 20px;

    background: #4A2E1F;

    border-bottom: 1px solid #4A2E1F;

    color: #ffffff;
}

.dashboard-panel-title {
    color: #ffffff;

    font-size: 15px;
    line-height: 20px;

    font-weight: 700;
}

.dashboard-panel-subtitle {
    margin-top: 2px;

    color: rgba(255, 255, 255, 0.72);

    font-size: 11px;
    line-height: 15px;
}

/*
    |--------------------------------------------------------------------------
    | LIST
    |--------------------------------------------------------------------------
    */

.dashboard-list {
    width: 100%;
}

.dashboard-list-item {
    display: grid;

    align-items: center;

    gap: 12px;

    min-width: 0;

    padding: 14px 20px;

    border-bottom: 1px solid #F3F0EC;
}

.dashboard-list-item:last-child {
    border-bottom: 0;
}

/*
    |--------------------------------------------------------------------------
    | TRANSACTION ITEM
    |--------------------------------------------------------------------------
    */

.dashboard-transaction-item {
    grid-template-columns:
        minmax(0, 1fr) auto;
}

.dashboard-list-main {
    min-width: 0;
}

.dashboard-list-title {
    color: #111827;

    font-size: 13px;
    line-height: 18px;

    font-weight: 600;

    overflow-wrap: anywhere;
}

.dashboard-list-meta {
    margin-top: 2px;

    color: #9CA3AF;

    font-size: 11px;
    line-height: 15px;
}

.dashboard-list-value {
    text-align: right;

    white-space: nowrap;
}

.dashboard-list-amount {
    color: #111827;

    font-size: 13px;
    line-height: 18px;

    font-weight: 700;
}

.dashboard-list-point {
    margin-top: 2px;

    color: #15803D;

    font-size: 11px;
    line-height: 15px;

    font-weight: 700;
}

/*
    |--------------------------------------------------------------------------
    | REDEMPTION
    |--------------------------------------------------------------------------
    */

.dashboard-redemption-item {
    grid-template-columns:
        minmax(0, 1fr) auto;
}

.dashboard-redemption-point {
    color: #B91C1C;

    font-size: 13px;
    line-height: 18px;

    font-weight: 700;
}

/*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

.dashboard-status {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    width: fit-content;

    margin-top: 5px;

    border-radius: 999px;

    padding: 4px 8px;

    font-size: 9px;
    line-height: 13px;

    font-weight: 600;
}

.dashboard-status.success {
    background: #DCFCE7;
    color: #15803D;
}

.dashboard-status.pending {
    background: #FEF3C7;
    color: #B45309;
}

.dashboard-status.failed {
    background: #FEE2E2;
    color: #B91C1C;
}

.dashboard-status.default {
    background: #F3F4F6;
    color: #4B5563;
}

/*
    |--------------------------------------------------------------------------
    | POINT ACTIVITY
    |--------------------------------------------------------------------------
    */

.dashboard-point-item {
    grid-template-columns:
        auto minmax(0, 1fr) auto;
}

.dashboard-point-icon {
    display: flex;

    align-items: center;
    justify-content: center;

    width: 36px;
    height: 36px;

    border-radius: 12px;

    font-size: 15px;
}

.dashboard-point-icon.plus {
    background: #ECFDF5;
    color: #15803D;
}

.dashboard-point-icon.minus {
    background: #FEF2F2;
    color: #B91C1C;
}

.dashboard-point-value.plus {
    color: #15803D;
}

.dashboard-point-value.minus {
    color: #B91C1C;
}

.dashboard-point-value {
    font-size: 13px;
    line-height: 18px;

    font-weight: 700;

    white-space: nowrap;
}

/*
    |--------------------------------------------------------------------------
    | POPULAR REWARD
    |--------------------------------------------------------------------------
    */

.dashboard-popular-item {
    grid-template-columns:
        auto minmax(0, 1fr) auto;
}

.dashboard-rank {
    display: flex;

    align-items: center;
    justify-content: center;

    width: 32px;
    height: 32px;

    border-radius: 10px;

    background: #F9F5EF;

    color: #4A2E1F;

    font-size: 12px;
    font-weight: 700;
}

.dashboard-popular-count {
    color: #4A2E1F;

    font-size: 12px;
    line-height: 17px;

    font-weight: 700;

    white-space: nowrap;
}

/*
    |--------------------------------------------------------------------------
    | EMPTY
    |--------------------------------------------------------------------------
    */

.dashboard-empty {
    padding: 28px 20px;

    color: #9CA3AF;

    text-align: center;

    font-size: 12px;
}

/*
    |--------------------------------------------------------------------------
    | TABLET
    |--------------------------------------------------------------------------
    */

@media (max-width: 1024px) {

    .dashboard-stats {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .dashboard-main-grid {
        grid-template-columns: 1fr;
    }

    .dashboard-secondary-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }
}

/*
    |--------------------------------------------------------------------------
    | MOBILE
    |--------------------------------------------------------------------------
    */

@media (max-width: 767px) {

    .dashboard-stats {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 10px;
    }

    .dashboard-stat-card {
        padding: 15px;

        border-radius: 15px;
    }

    .dashboard-stat-label {
        font-size: 11px;
        line-height: 15px;
    }

    .dashboard-stat-value {
        margin-top: 6px;

        font-size: 23px;
        line-height: 28px;
    }

    .dashboard-main-grid,
    .dashboard-secondary-grid {
        grid-template-columns: 1fr;

        gap: 12px;
    }

    .dashboard-panel-header {
        padding: 15px 16px;
    }

    .dashboard-panel-title {
        font-size: 14px;
    }

    .dashboard-list-item {
        padding: 13px 16px;
    }

    .dashboard-list-title {
        font-size: 12px;
    }

    .dashboard-list-meta {
        font-size: 10px;
    }

    .dashboard-list-amount {
        font-size: 12px;
    }

    .dashboard-point-item {
        grid-template-columns:
            auto minmax(0, 1fr) auto;
    }
}

/*
    |--------------------------------------------------------------------------
    | VERY SMALL PHONE
    |--------------------------------------------------------------------------
    */

@media (max-width: 380px) {

    .dashboard-stats {
        gap: 8px;
    }

    .dashboard-stat-card {
        padding: 13px;
    }

    .dashboard-stat-label {
        font-size: 10px;
    }

    .dashboard-stat-value {
        font-size: 21px;
    }
}
</style>


<div class="dashboard-page space-y-6">

    {{-- ======================================================
        PAGE HEADER
    ======================================================= --}}
    <div>

        <h1 class="text-2xl font-semibold text-gray-900 md:text-3xl">
            Dashboard
        </h1>

        <p class="mt-1 text-sm text-[#75665C] md:text-base">
            Selamat datang di Saé Cafe Rojel CRM
        </p>

    </div>


    {{-- ======================================================
        STATISTICS
    ======================================================= --}}
    <div class="dashboard-stats">

        {{-- CUSTOMER --}}
        <div class="dashboard-stat-card">

            <p class="dashboard-stat-label">
                Total Customer
            </p>

            <p class="dashboard-stat-value">
                {{ $totalCustomer }}
            </p>

        </div>


        {{-- REWARD --}}
        <div class="dashboard-stat-card">

            <p class="dashboard-stat-label">
                Total Reward
            </p>

            <p class="dashboard-stat-value">
                {{ $totalReward }}
            </p>

        </div>


        {{-- TRANSACTION --}}
        <div class="dashboard-stat-card">

            <p class="dashboard-stat-label">
                Total Transaksi
            </p>

            <p class="dashboard-stat-value">
                {{ $totalTransaction }}
            </p>

        </div>


        {{-- REDEMPTION --}}
        <div class="dashboard-stat-card">

            <p class="dashboard-stat-label">
                Total Redemption
            </p>

            <p class="dashboard-stat-value">
                {{ $totalRedemption }}
            </p>

        </div>

    </div>


    {{-- ======================================================
        RECENT TRANSACTIONS + REDEMPTIONS
    ======================================================= --}}
    <div class="dashboard-main-grid">

        {{-- ==================================================
            TRANSAKSI TERBARU
        =================================================== --}}
        <section class="dashboard-panel">

            <div class="dashboard-panel-header">

                <div>
                    <h2 class="dashboard-panel-title">
                        Transaksi Terbaru
                    </h2>

                    <p class="dashboard-panel-subtitle">
                        5 transaksi terakhir
                    </p>
                </div>

                <a href="{{ route('admin.transactions.index') }}"
                    class="text-xs font-semibold text-white hover:underline">
                    Lihat Semua
                </a>
            </div>


            <div class="dashboard-list">

                @forelse($recentTransactions as $transaction)

                <div class="dashboard-list-item dashboard-transaction-item">

                    <div class="dashboard-list-main">

                        <p class="dashboard-list-title">
                            {{ $transaction->kode_transaksi }}
                        </p>

                        <p class="dashboard-list-meta">
                            {{ $transaction->customer->nama ?? '-' }}
                            ·
                            {{ $transaction->source
                                    ? strtoupper($transaction->source)
                                    : 'MANUAL'
                                }}
                        </p>

                    </div>


                    <div class="dashboard-list-value">

                        <p class="dashboard-list-amount">
                            Rp {{ number_format(
                                    $transaction->total_belanja,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                        </p>

                        <p class="dashboard-list-point">
                            +{{ number_format($transaction->point_didapat) }} Point
                        </p>

                    </div>

                </div>

                @empty

                <div class="dashboard-empty">
                    Belum ada transaksi.
                </div>

                @endforelse

            </div>

        </section>


        {{-- ==================================================
            REDEMPTION TERBARU
        =================================================== --}}
        <section class="dashboard-panel">

            <div class="dashboard-panel-header">

                <div>
                    <h2 class="dashboard-panel-title">
                        Redemption Terbaru
                    </h2>

                    <p class="dashboard-panel-subtitle">
                        5 redemption terakhir
                    </p>
                </div>

                <a href="{{ route('admin.redemptions.index') }}"
                    class="text-xs font-semibold text-white hover:underline">
                    Lihat Semua
                </a>
            </div>


            <div class="dashboard-list">

                @forelse($recentRedemptions as $redemption)

                <div class="dashboard-list-item dashboard-redemption-item">

                    <div class="dashboard-list-main">

                        <p class="dashboard-list-title">
                            {{ $redemption->reward->reward_name ?? '-' }}
                        </p>

                        <p class="dashboard-list-meta">
                            {{ $redemption->customer->nama ?? '-' }}
                        </p>


                        @php

                        $redemptionStatus =
                        strtolower(
                        trim(
                        (string) $redemption->status
                        )
                        );

                        $redemptionStatusClass =
                        match (true) {

                        in_array(
                        $redemptionStatus,
                        [
                        'berhasil',
                        'success',
                        'sukses',
                        'selesai',
                        'dikonfirmasi',
                        'confirmed'
                        ],
                        true
                        )
                        => 'success',

                        in_array(
                        $redemptionStatus,
                        [
                        'pending',
                        'menunggu',
                        'diajukan'
                        ],
                        true
                        )
                        => 'pending',

                        in_array(
                        $redemptionStatus,
                        [
                        'gagal',
                        'failed',
                        'dibatalkan',
                        'cancelled'
                        ],
                        true
                        )
                        => 'failed',

                        default
                        => 'default',
                        };

                        @endphp

                        <span class="dashboard-status {{ $redemptionStatusClass }}">
                            {{ ucfirst($redemption->status) }}
                        </span>

                    </div>


                    <div class="dashboard-list-value">

                        <p class="dashboard-redemption-point">
                            -{{ number_format($redemption->point_used) }}
                            Point
                        </p>

                        <p class="dashboard-list-meta">
                            {{ $redemption->created_at?->format('d M Y') }}
                        </p>

                    </div>

                </div>

                @empty

                <div class="dashboard-empty">
                    Belum ada redemption.
                </div>

                @endforelse

            </div>

        </section>

    </div>


    {{-- ======================================================
        POINT ACTIVITY + POPULAR REWARD
    ======================================================= --}}
    <div class="dashboard-secondary-grid">

        {{-- ==================================================
            AKTIVITAS POINT
        =================================================== --}}
        <section class="dashboard-panel">

            <div class="dashboard-panel-header">

                <div>
                    <h2 class="dashboard-panel-title">
                        Aktivitas Point
                    </h2>

                    <p class="dashboard-panel-subtitle">
                        Perubahan point terbaru
                    </p>
                </div>

                <a href="{{ route('admin.point-history.index') }}"
                    class="text-xs font-semibold text-white hover:underline">
                    Lihat Semua
                </a>

            </div>


            <div class="dashboard-list">

                @forelse($recentPointHistory as $history)

                @php
                $isPlus =
                $history->type === 'tambah';

                $pointCustomer =
                $pointCustomers->get(
                $history->id_customer
                );
                @endphp


                <div class="dashboard-list-item dashboard-point-item">

                    <div class="
                                dashboard-point-icon
                                {{ $isPlus ? 'plus' : 'minus' }}
                            ">
                        {{ $isPlus ? '+' : '−' }}
                    </div>


                    <div class="dashboard-list-main">

                        <p class="dashboard-list-title">

                            {{ $pointCustomer->nama ?? 'Customer' }}

                        </p>

                        <p class="dashboard-list-meta">

                            {{ $history->keterangan ?? 'Aktivitas point' }}

                        </p>

                    </div>


                    <div>

                        <p class="
                                    dashboard-point-value
                                    {{ $isPlus ? 'plus' : 'minus' }}
                                ">
                            {{ $isPlus ? '+' : '-' }}{{ number_format($history->point) }}
                        </p>

                    </div>

                </div>

                @empty

                <div class="dashboard-empty">
                    Belum ada aktivitas point.
                </div>

                @endforelse

            </div>

        </section>


        {{-- ==================================================
            REWARD TERPOPULER
        =================================================== --}}
        <section class="dashboard-panel">

            <div class="dashboard-panel-header">

                <div>
                    <h2 class="dashboard-panel-title">
                        Reward Terpopuler
                    </h2>

                    <p class="dashboard-panel-subtitle">
                        Berdasarkan jumlah redemption berhasil
                    </p>
                </div>

                <a href="{{ route('admin.rewards.index') }}"
                    class="text-xs font-semibold text-[#4A2E1F] hover:underline">
                    Lihat Reward
                </a>

            </div>


            <div class="dashboard-list">

                @forelse($popularRewards as $index => $popularReward)

                <div class="dashboard-list-item dashboard-popular-item">

                    <div class="dashboard-rank">
                        {{ $index + 1 }}
                    </div>


                    <div class="dashboard-list-main">

                        <p class="dashboard-list-title">
                            {{ $popularReward->reward->reward_name ?? '-' }}
                        </p>

                        <p class="dashboard-list-meta">
                            {{ $popularReward->reward->point_required ?? 0 }}
                            Point
                        </p>

                    </div>


                    <div>

                        <p class="dashboard-popular-count">
                            {{ $popularReward->redemption_count }}
                            × Redeem
                        </p>

                    </div>

                </div>

                @empty

                <div class="dashboard-empty">
                    Belum ada data redemption reward.
                </div>

                @endforelse

            </div>

        </section>

    </div>

</div>

@endsection