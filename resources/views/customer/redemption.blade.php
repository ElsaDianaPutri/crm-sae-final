@extends('layouts.customer')

@section('title', 'Redemption - SAÉ CAFE ROJEL')
@section('mobile_title', 'Redemption')

@section('content')

<style>
/* =========================================================
   REDEMPTION PAGE
========================================================= */

.redemption-page {
    width: 100%;
    max-width: 560px;
    margin: 0 auto;

    padding: 24px;

    text-align: center;

    background: #FFFDF9;

    border: 1px solid #E9DED1;
    border-radius: 18px;

    box-shadow: 0 10px 30px rgba(70, 45, 25, .05);
}


/* =========================================================
   HEADER
========================================================= */

.redemption-label {
    margin-top: 20px;

    color: #8B796B;

    font-size: 10px;

    letter-spacing: .1em;

    text-transform: uppercase;
}

.redemption-title {
    margin: 7px 0 4px;

    color: #4B2D1C;

    font-size: 24px;

    font-weight: 700;
}

.redemption-subtitle {
    margin: 0;

    color: #8B796B;

    font-size: 12px;
}


/* =========================================================
   QR CODE
========================================================= */

.redemption-qr {
    width: 180px;
    height: 180px;

    display: grid;
    place-items: center;

    margin: 22px auto 16px;

    padding: 8px;

    background: #FFFFFF;

    border: 1px solid #E9DED1;
    border-radius: 14px;

    overflow: hidden;
}

.redemption-qr svg {
    display: block;

    width: 100%;
    height: 100%;

    max-width: 164px;
    max-height: 164px;
}


/* =========================================================
   CODE
========================================================= */

.redemption-code-label {
    color: #8B796B;

    font-size: 11px;
}

.redemption-code {
    margin-top: 4px;

    color: #4B2D1C;

    font-size: 24px;

    font-weight: 700;

    letter-spacing: .08em;

    word-break: break-word;
}


/* =========================================================
   INFO CARDS
========================================================= */

.redemption-info {
    margin-top: 16px;

    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 10px;
}

.redemption-info-card {
    min-height: 72px;

    display: flex;

    flex-direction: column;

    align-items: center;
    justify-content: center;

    padding: 12px;

    border: 1px solid #E9DED1;

    border-radius: 12px;

    background: #FFFFFF;
}

.redemption-info-label {
    color: #8B796B;

    font-size: 10px;
}

.redemption-info-value {
    margin-top: 3px;

    color: #171311;

    font-size: 16px;

    font-weight: 700;
}


/* =========================================================
   BACK BUTTON
========================================================= */

.redemption-back {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 7px;

    width: 100%;

    min-height: 42px;

    margin-top: 16px;

    padding: 10px 16px;

    border-radius: 10px;

    background: #4B2D1C;

    color: #FFFFFF;

    font-size: 11px;

    font-weight: 700;

    text-decoration: none;

    transition:
        background-color .2s ease,
        transform .2s ease;
}

.redemption-back:hover {
    background: #5B3927;

    transform: translateY(-1px);
}


/* =========================================================
   NOTE
========================================================= */

.redemption-note {
    margin-top: 16px;

    padding: 12px;

    border-radius: 12px;

    background: #FFF4DF;

    color: #765C45;

    font-size: 11px;

    line-height: 1.6;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 600px) {

    .redemption-page {
        padding: 20px 16px;

        border-radius: 16px;
    }

    .redemption-title {
        font-size: 22px;
    }

    .redemption-qr {
        width: 155px;
        height: 155px;

        margin-top: 20px;

        padding: 7px;
    }

    .redemption-qr svg {
        max-width: 141px;
        max-height: 141px;
    }

    .redemption-code {
        font-size: 20px;

        letter-spacing: .06em;
    }

}


@media (max-width: 420px) {

    .redemption-page {
        padding: 18px 12px;
    }

    .redemption-qr {
        width: 135px;
        height: 135px;

        margin-top: 18px;

        padding: 6px;
    }

    .redemption-qr svg {
        max-width: 123px;
        max-height: 123px;
    }

    .redemption-code {
        font-size: 18px;
    }

    .redemption-info {
        gap: 8px;
    }

    .redemption-info-card {
        min-height: 68px;

        padding: 10px 6px;
    }

    .redemption-back {
        min-height: 40px;

        font-size: 10px;
    }

}
</style>


<div class="redemption-page">


    {{-- =====================================================
         BACK BUTTON
    ====================================================== --}}

    <div class="redemption-label">
        Tunjukkan ke Kasir
    </div>


    <h1 class="redemption-title">
        {{ $redemption->reward->reward_name }}
    </h1>


    <p class="redemption-subtitle">
        Redemption menunggu konfirmasi staff.
    </p>


    {{-- =====================================================
         QR CODE
    ====================================================== --}}

    <div class="redemption-qr">

        {!! base64_decode($svg) !!}

    </div>


    {{-- =====================================================
         REDEMPTION CODE
    ====================================================== --}}

    <div class="redemption-code-label">
        Kode Redemption
    </div>

    <div class="redemption-code">
        {{ $redemption->redemption_code }}
    </div>


    {{-- =====================================================
         INFO
    ====================================================== --}}

    <div class="redemption-info">


        <div class="redemption-info-card">

            <div class="redemption-info-label">
                Point Digunakan
            </div>

            <div class="redemption-info-value">
                {{ $redemption->point_used }}
            </div>

        </div>


        <div class="redemption-info-card">

            <div class="redemption-info-label">
                Status
            </div>

            <div class="redemption-info-value">
                {{ ucfirst($redemption->status) }}
            </div>

        </div>


    </div>


    {{-- =====================================================
         BACK TO REWARD
    ====================================================== --}}

    <a href="{{ route('customer.reward') }}" class="redemption-back">
        Kembali ke Reward
    </a>


    {{-- =====================================================
         NOTE
    ====================================================== --}}

    <div class="redemption-note">

        Point belum dipotong.
        Point akan berkurang setelah staff memindai
        dan mengonfirmasi QR ini.

    </div>


</div>

@endsection