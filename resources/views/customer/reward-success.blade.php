@extends('layouts.customer')

@section('title', 'Penukaran Berhasil - SAE CAFE ROJEL')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    :root {
        --brown-dark: #3b2418;
        --brown: #4b2d1c;
        --brown-soft: #68432d;

        --cream: #f8f2e9;
        --cream-soft: #fffaf4;
        --white: #ffffff;

        --green: #3f7f4d;
        --green-soft: #edf5e9;

        --gold: #e2ad57;

        --text: #2d241f;
        --muted: #806f62;
        --border: #e7ddd2;
    }

    * {
        box-sizing: border-box;
    }

    .success-page {
        min-height: calc(100vh - 80px);

        padding: 45px 20px 60px;

        background:
            radial-gradient(
                circle at 50% 0%,
                rgba(217, 164, 65, .10),
                transparent 32%
            ),
            var(--cream);

        font-family: 'Poppins', sans-serif;

        color: var(--text);
    }


    /* =========================================================
       CONTAINER
       ========================================================= */

    .success-container {
        width: min(480px, 100%);
        margin: 0 auto;
    }


    /* =========================================================
       TOP HEADER
       ========================================================= */

    .success-header {
        display: flex;
        align-items: center;

        margin-bottom: 20px;

        color: var(--brown-dark);
    }

    .back-button {
        width: 40px;
        height: 40px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: 0;
        border-radius: 50%;

        background: transparent;

        color: var(--brown-dark);

        cursor: pointer;

        transition: .2s ease;
    }

    .back-button:hover {
        background: rgba(75, 45, 28, .08);
    }

    .back-button svg {
        width: 22px;
        height: 22px;
    }

    .success-header-title {
        flex: 1;

        margin-right: 40px;

        text-align: center;

        font-size: 18px;
        font-weight: 600;

        color: var(--brown-dark);
    }


    /* =========================================================
       SUCCESS CARD
       ========================================================= */

    .success-card {
        position: relative;

        padding: 32px 28px 30px;

        border-radius: 20px;

        background: var(--cream-soft);

        border: 1px solid var(--border);

        box-shadow:
            0 18px 45px rgba(75, 45, 28, .09);

        overflow: hidden;
    }


    /* =========================================================
       SUCCESS ICON
       ========================================================= */

    .success-icon-wrapper {
        width: 100px;
        height: 100px;

        margin: 0 auto 15px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: rgba(255,255,255,.85);

        box-shadow:
            0 0 0 10px rgba(255,255,255,.45);
    }

    .success-icon-circle {
        width: 58px;
        height: 58px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: var(--green);

        color: white;

        box-shadow:
            0 8px 20px rgba(63,127,77,.22);
    }

    .success-icon-circle svg {
        width: 34px;
        height: 34px;
    }


    /* =========================================================
       SUCCESS TITLE
       ========================================================= */

    .success-title {
        margin: 0;

        text-align: center;

        color: var(--text);

        font-size: 18px;
        line-height: 1.35;

        font-weight: 600;
    }

    .success-subtitle {
        margin: 7px 0 26px;

        text-align: center;

        color: var(--muted);

        font-size: 11px;
        line-height: 1.6;
    }


    /* =========================================================
       REWARD DETAIL
       ========================================================= */

    .reward-result {
        display: flex;
        align-items: center;
        gap: 14px;

        min-height: 64px;

        padding: 10px 13px;

        border: 1px solid var(--border);

        border-radius: 12px;

        background: white;
    }

    .reward-result-image {
        width: 50px;
        height: 50px;

        flex: 0 0 50px;

        display: flex;
        align-items: center;
        justify-content: center;

        overflow: hidden;

        border-radius: 9px;

        background: #f8eee1;
    }

    .reward-result-image img {
        width: 100%;
        height: 100%;

        object-fit: contain;
    }

    .reward-placeholder {
        font-size: 25px;
    }

    .reward-result-info {
        min-width: 0;
        flex: 1;
    }

    .reward-result-name {
        margin-bottom: 3px;

        color: var(--text);

        font-size: 13px;
        font-weight: 600;
    }

    .reward-result-label {
        color: var(--muted);

        font-size: 9px;
    }

    .reward-result-point {
        white-space: nowrap;

        color: #b32f2f;

        font-size: 15px;
        font-weight: 600;
    }


    /* =========================================================
       INFO ROW
       ========================================================= */

    .info-row {
        display: flex;
        align-items: center;
        justify-content: space-between;

        min-height: 50px;

        margin-top: 12px;
        padding: 0 15px;

        border: 1px solid var(--border);

        border-radius: 11px;

        background: white;
    }

    .info-label {
        color: var(--text);

        font-size: 11px;
        font-weight: 500;
    }

    .info-value {
        color: var(--text);

        font-size: 12px;
        font-weight: 500;

        text-align: right;
    }

    .info-value.point {
        font-size: 14px;
        font-weight: 600;
    }


    /* =========================================================
       THANK YOU BOX
       ========================================================= */

    .thank-you {
        display: flex;
        align-items: flex-start;
        gap: 12px;

        margin-top: 24px;
        padding: 13px 15px;

        border: 1px solid #eadfce;

        border-radius: 11px;

        background: #f8f1e8;
    }

    .thank-you-star {
        width: 25px;
        height: 25px;

        flex: 0 0 25px;

        display: flex;
        align-items: center;
        justify-content: center;

        color: var(--gold);

        font-size: 23px;
    }

    .thank-you-text {
        color: var(--text);

        font-size: 10px;
        line-height: 1.6;
    }

    .thank-you-text strong {
        font-weight: 600;
    }


    /* =========================================================
       BUTTONS
       ========================================================= */

    .success-actions {
        display: flex;
        flex-direction: column;

        gap: 10px;

        margin-top: 28px;
    }

    .btn-history,
    .btn-home {
        width: 100%;

        border-radius: 10px;

        font-family: inherit;

        font-size: 11px;
        font-weight: 600;

        cursor: pointer;

        transition: .2s ease;
    }

    .btn-history {
        height: 44px;

        border: 0;

        background: var(--brown);

        color: white;
    }

    .btn-history:hover {
        background: var(--brown-dark);

        transform: translateY(-1px);
    }

    .btn-home {
        height: 42px;

        border: 0;

        background: transparent;

        color: var(--brown);

        font-size: 12px;
    }

    .btn-home:hover {
        background: rgba(75,45,28,.06);
    }


    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 520px) {

        .success-page {
            padding: 25px 15px 40px;
        }

        .success-card {
            padding: 28px 18px 25px;
        }

        .success-header-title {
            font-size: 16px;
        }

        .reward-result-point {
            font-size: 13px;
        }
    }
</style>


<main class="success-page">

    <div class="success-container">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="success-header">

            <button
                type="button"
                class="back-button"
                onclick="history.back()"
                aria-label="Kembali"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M15 18l-6-6 6-6"/>
                </svg>
            </button>

            <div class="success-header-title">
                Penukaran Berhasil!
            </div>

        </div>


        {{-- =====================================================
             SUCCESS CARD
        ====================================================== --}}

        <section class="success-card">


            {{-- ICON CHECK --}}
            <div class="success-icon-wrapper">

                <div class="success-icon-circle">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M5 12.5l4.2 4L19 7"/>
                    </svg>

                </div>

            </div>


            {{-- TITLE --}}
            <h1 class="success-title">
                Reward Berhasil<br>
                Digunakan!
            </h1>

            <p class="success-subtitle">
                Reward kamu berhasil ditukarkan menggunakan point.
            </p>


            {{-- =================================================
                 REWARD
            ================================================== --}}

            <div class="reward-result">

                <div class="reward-result-image">

                    @if(!empty($redeem['reward_image']))

                        <img
                            src="{{ asset($redeem['reward_image']) }}"
                            alt="{{ $redeem['reward_name'] }}"
                        >

                    @else

                        <span class="reward-placeholder">
                            🎁
                        </span>

                    @endif

                </div>


                <div class="reward-result-info">

                    <div class="reward-result-name">
                        {{ $redeem['reward_name'] }}
                    </div>

                    <div class="reward-result-label">
                        Penukaran / penggunaan point
                    </div>

                </div>


                <div class="reward-result-point">
                    -{{ number_format($redeem['point_used'], 0, ',', '.') }} Point
                </div>

            </div>


            {{-- =================================================
                 SISA POINT
            ================================================== --}}

            <div class="info-row">

                <span class="info-label">
                    Sisa Point Kamu
                </span>

                <span class="info-value point">
                    {{ number_format($redeem['remaining_point'], 0, ',', '.') }}
                    Point
                </span>

            </div>


            {{-- =================================================
                 TANGGAL
            ================================================== --}}

            <div class="info-row">

                <span class="info-label">
                    Digunakan Pada
                </span>

                <span class="info-value">
                    {{ $redeem['redeem_date'] }}
                </span>

            </div>


            {{-- =================================================
                 THANK YOU
            ================================================== --}}

            <div class="thank-you">

                <div class="thank-you-star">
                    ★
                </div>

                <div class="thank-you-text">

                    <strong>
                        Terima kasih!
                    </strong>

                    Silahkan nikmati reward favoritmu
                    di SAE Cafe.

                </div>

            </div>


            {{-- =================================================
                 ACTION BUTTON
            ================================================== --}}

            <div class="success-actions">

                <button
                    type="button"
                    class="btn-history"
                    onclick="window.location.href='{{ route('customer.reward') }}#point-content'"
                >
                    LIHAT RIWAYAT POINT
                </button>


                <button
                    type="button"
                    class="btn-home"
                    onclick="window.location.href='{{ route('customer.dashboard') }}'"
                >
                    KEMBALI KE BERANDA
                </button>

            </div>


        </section>

    </div>

</main>

@endsection