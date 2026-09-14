@extends('layouts.customer')

@section('title', 'Transaksi - SAÉ CAFE ROJEL')
@section('mobile_title', 'Riwayat Transaksi')

@section('content')

@php
$grouped = $transactions->groupBy(
fn($t) => optional($t->tanggal_transaksi)->format('F Y')
);
@endphp

<style>
/* =========================================================
   TRANSACTION PAGE
========================================================= */

.transaction-page {
    width: 100%;
    display: grid;
    gap: 20px;
}


/* =========================================================
   HEADER
========================================================= */

.transaction-page-head {
    padding: 0 4px;
}

.transaction-eyebrow {
    display: flex;
    align-items: center;
    gap: 8px;

    margin-bottom: 5px;

    color: #9A6A46;

    font-size: 10px;
    font-weight: 700;

    letter-spacing: .06em;
    text-transform: uppercase;
}

.transaction-eyebrow::before {
    content: "";

    width: 28px;
    height: 1px;

    background: #A77A56;
}

.transaction-page-title {
    margin: 0;

    color: #171311;

    font-size: 28px;
    line-height: 1.2;

    font-weight: 700;

    letter-spacing: -.03em;
}

.transaction-page-subtitle {
    margin: 5px 0 0;

    color: #8B796B;

    font-size: 11px;

    line-height: 1.5;
}


/* =========================================================
   INFO
========================================================= */

.transaction-info {
    padding: 14px 16px;

    border-radius: 12px;

    background: #FFF2E3;

    color: #6F5D50;

    font-size: 10px;

    line-height: 1.5;
}


/* =========================================================
   MONTH
========================================================= */

.transaction-month-group {
    display: grid;

    gap: 10px;
}

.transaction-month {
    margin: 4px 0 1px;

    color: #4B2D1C;

    font-size: 14px;

    font-weight: 700;
}


/* =========================================================
   TRANSACTION LIST
========================================================= */

.transaction-list {
    display: grid;

    gap: 10px;
}


/* =========================================================
   TRANSACTION CARD
========================================================= */

.transaction-card {
    position: relative;
    overflow: hidden;

    display: grid;

    grid-template-columns:
        54px 145px minmax(160px, 1fr) 175px 110px;

    align-items: center;

    column-gap: 14px;

    min-height: 74px;

    padding: 10px 14px;

    border: 1px solid #E9DED1;

    border-radius: 10px;

    background: #FFFFFF;

    box-sizing: border-box;
}

.transaction-card::before {
    content: "";

    position: absolute;

    top: 0;
    left: 0;
    bottom: 0;

    width: 4px;

    background: #9A6A46;

    border-radius: 10px 0 0 10px;
}


/* =========================================================
   ICON
========================================================= */

.transaction-icon {
    width: 44px;
    height: 44px;

    display: grid;
    place-items: center;

    border-radius: 50%;

    background: #FBF2E5;

    color: #8A5A32;
}

.transaction-icon svg {
    width: 23px;
    height: 23px;

    display: block;
}


/* =========================================================
   DATE
========================================================= */

.transaction-date {
    color: #6F5D50;

    font-size: 9px;

    line-height: 1.45;
}


/* =========================================================
   MAIN DETAIL
========================================================= */

.transaction-main {
    min-width: 0;
}

.transaction-code {
    overflow: hidden;

    color: #201810;

    font-size: 10px;

    font-weight: 700;

    line-height: 1.4;

    white-space: nowrap;

    text-overflow: ellipsis;
}

.transaction-description {
    margin-top: 3px;

    color: #8B796B;

    font-size: 9px;

    line-height: 1.4;
}


/* =========================================================
   TOTAL
========================================================= */

.transaction-total {
    color: #33261F;

    font-size: 13px;

    font-weight: 700;

    white-space: nowrap;
}


/* =========================================================
   POINT
========================================================= */

.transaction-point {
    justify-self: end;

    min-width: 62px;

    padding: 6px 8px;

    border-radius: 999px;

    background: #EDF7EF;

    color: #2D7C49;

    font-size: 9px;

    font-weight: 700;

    text-align: center;

    white-space: nowrap;
}

.transaction-point.zero {
    background: #F2EEE8;

    color: #8B796B;
}


/* =========================================================
   EMPTY
========================================================= */

.transaction-empty {
    padding: 20px;

    border: 1px solid #E9DED1;

    border-radius: 12px;

    background: #FFFDF9;

    color: #8B796B;

    font-size: 10px;

    text-align: center;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 1050px) {

    .transaction-card {
        grid-template-columns:
            48px 125px minmax(140px, 1fr) 135px 90px;

        column-gap: 10px;

        padding: 10px 12px;
    }

    .transaction-icon {
        width: 40px;
        height: 40px;
    }

    .transaction-icon svg {
        width: 21px;
        height: 21px;
    }

    .transaction-total {
        font-size: 12px;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 760px) {

    .transaction-page {
        gap: 16px;
    }

    .transaction-page-title {
        font-size: 24px;
    }

    .transaction-page-subtitle {
        font-size: 10px;
    }

    .transaction-info {
        font-size: 9px;
    }

    .transaction-month {
        font-size: 13px;
    }

    .transaction-card {
        grid-template-columns:
            42px minmax(0, 1fr) auto;

        grid-template-areas:
            "icon date point"
            "icon main total";

        column-gap: 10px;
        row-gap: 4px;

        min-height: 78px;

        padding: 11px 12px;
    }

    .transaction-icon {
        grid-area: icon;

        width: 38px;
        height: 38px;
    }

    .transaction-icon svg {
        width: 20px;
        height: 20px;
    }

    .transaction-date {
        grid-area: date;

        font-size: 8px;
    }

    .transaction-main {
        grid-area: main;
    }

    .transaction-code {
        font-size: 9px;
    }

    .transaction-description {
        font-size: 8px;
    }

    .transaction-total {
        grid-area: total;

        justify-self: end;

        font-size: 11px;
    }

    .transaction-point {
        grid-area: point;

        justify-self: end;

        min-width: auto;

        padding: 5px 7px;

        font-size: 8px;
    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px) {

    .transaction-page-title {
        font-size: 22px;
    }

    .transaction-eyebrow {
        font-size: 9px;
    }

    .transaction-eyebrow::before {
        width: 22px;
    }

    .transaction-page-subtitle {
        font-size: 9px;
    }

    .transaction-card {
        grid-template-columns:
            38px minmax(0, 1fr) auto;

        column-gap: 8px;

        padding: 10px;
    }

    .transaction-icon {
        width: 36px;
        height: 36px;
    }

    .transaction-icon svg {
        width: 18px;
        height: 18px;
    }

    .transaction-code {
        font-size: 8px;
    }

    .transaction-description {
        font-size: 7px;
    }

    .transaction-date {
        font-size: 7px;
    }

    .transaction-total {
        font-size: 10px;
    }

    .transaction-point {
        font-size: 7px;

        padding: 4px 6px;
    }

}


/* =========================================================
   VERY SMALL MOBILE
========================================================= */

@media (max-width: 360px) {

    .transaction-card {
        grid-template-columns:
            34px minmax(0, 1fr) auto;

        gap: 6px;
    }

    .transaction-icon {
        width: 32px;
        height: 32px;
    }

    .transaction-icon svg {
        width: 17px;
        height: 17px;
    }

}
</style>


<div class="transaction-page">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="transaction-page-head">


        <h1 class="transaction-page-title">
            Riwayat Transaksi
        </h1>

        <p class="transaction-page-subtitle">
            Lihat semua transaksi dan point yang kamu dapatkan.
        </p>

    </div>


    {{-- =====================================================
         INFO
    ====================================================== --}}

    <div class="transaction-info">
        Detail pembayaran ditampilkan sebagai pembayaran berhasil.
        Informasi sumber transaksi hanya tersedia untuk staff dan admin.
    </div>


    {{-- =====================================================
         TRANSACTIONS
    ====================================================== --}}

    @forelse($grouped as $month => $items)

    <section class="transaction-month-group">

        <div class="transaction-month">
            {{ $month }}
        </div>


        <div class="transaction-list">

            @foreach($items as $tx)

            <article class="transaction-card">


                {{-- ICON --}}

                <div class="transaction-icon">

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round" aria-hidden="true">
                        <circle cx="9" cy="20" r="1.5"></circle>

                        <circle cx="18" cy="20" r="1.5"></circle>

                        <path d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 1.9-1.4L21 8H6"></path>

                        <path d="M9 12h8"></path>

                    </svg>

                </div>


                {{-- DATE --}}

                <div class="transaction-date">

                    {{ optional($tx->tanggal_transaksi)->format('j F Y') }}

                    <span>•</span>

                    {{ optional($tx->tanggal_transaksi)->format('H:i') }}

                </div>


                {{-- MAIN --}}

                <div class="transaction-main">

                    <div class="transaction-code">
                        Transaksi #{{ $tx->kode_transaksi }}
                    </div>

                    <div class="transaction-description">
                        Pembelian • Berhasil
                    </div>

                </div>


                {{-- TOTAL --}}

                <div class="transaction-total">

                    Rp{{ number_format(
                                (int) $tx->total_belanja,
                                0,
                                ',',
                                '.'
                            ) }}

                </div>


                {{-- POINT --}}

                <div class="transaction-point {{ (int) $tx->point_didapat === 0 ? 'zero' : '' }}">

                    +{{ number_format(
                                (int) $tx->point_didapat,
                                0,
                                ',',
                                '.'
                            ) }}

                    Point

                </div>


            </article>

            @endforeach

        </div>

    </section>

    @empty

    <div class="transaction-empty">
        Belum ada transaksi.
    </div>

    @endforelse


</div>

@endsection