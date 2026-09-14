@extends('layouts.customer')

@section('title', 'Reward - SAÉ CAFE ROJEL')
@section('mobile_title', 'Reward')

@section('content')

<style>
/* =========================================================
   PAGE
========================================================= */

.reward-page {
    width: 100%;
    display: grid;
    gap: 18px;
}


/* =========================================================
   HEADER
========================================================= */

.reward-head {
    display: flex;
    align-items: flex-end;
}

.reward-head h1 {
    margin: 0;
    color: #171311;
    font-size: 28px;
    line-height: 1.2;
    font-weight: 700;
    letter-spacing: -.03em;
}

.reward-head p {
    margin: 6px 0 0;
    color: #8B796B;
    font-size: 11px;
}


/* =========================================================
   SUMMARY
========================================================= */

.reward-summary {
    display: grid;

    grid-template-columns:
        minmax(260px, .9fr) minmax(0, 1.1fr);

    gap: 14px;

    width: 100%;
}


/* =========================================================
   POINT CARD
========================================================= */

.reward-balance {
    position: relative;

    min-height: 130px;

    padding: 20px;

    overflow: hidden;

    border: 1px solid #E9DCCF;
    border-radius: 14px;

    background: #FBF2E5;
}

.reward-balance::after {
    content: '🎁';

    position: absolute;

    right: 28px;
    top: 50%;

    transform: translateY(-50%);

    font-size: 52px;
}

.reward-balance-label {
    color: #6F5D50;
    font-size: 10px;
}

.reward-balance-point {
    margin-top: 7px;

    display: flex;
    align-items: baseline;

    gap: 6px;
}

.reward-balance-point strong {
    color: #4B2D1C;

    font-size: 32px;
    line-height: 1;

    font-weight: 700;
}

.reward-balance-point span {
    color: #6F5D50;
    font-size: 12px;
}

.reward-balance-rule {
    margin-top: 8px;

    color: #766457;

    font-size: 9px;
}


/* =========================================================
   RIGHT SIDE
========================================================= */

.reward-summary-right {
    display: grid;

    grid-template-rows:
        auto auto;

    gap: 10px;

    min-width: 0;
}


/* =========================================================
   STAT CARDS
========================================================= */

.reward-stat-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 10px;
}

.reward-stat-card {
    min-height: 60px;

    display: flex;
    align-items: center;

    gap: 10px;

    padding: 12px 14px;

    border: 1px solid #E9DED1;
    border-radius: 11px;

    background: #FFFDF9;
}

.reward-stat-icon {
    width: 30px;
    height: 30px;

    display: grid;
    place-items: center;

    flex-shrink: 0;

    border-radius: 50%;

    background: #F4E6D4;

    color: #7A4A28;

    font-size: 14px;
}

.reward-stat-label {
    color: #827265;
    font-size: 8px;
}

.reward-stat-value {
    margin-top: 2px;

    color: #33261F;

    font-size: 12px;
    font-weight: 700;
}


/* =========================================================
   TABS
========================================================= */

.reward-tabs {
    display: grid;

    grid-template-columns:
        1fr 1fr;

    gap: 4px;

    min-height: 38px;

    padding: 3px;

    border: 1px solid #E5D8CB;
    border-radius: 8px;

    background: #FFFDF9;
}

.reward-tab {
    display: flex;

    align-items: center;
    justify-content: center;

    gap: 6px;

    border: 0;
    border-radius: 6px;

    background: transparent;

    color: #6F5D50;

    font-size: 9px;

    font-weight: 600;

    cursor: pointer;

    transition:
        background-color .2s ease,
        color .2s ease;
}

.reward-tab.active {
    background: #4B2D1C;
    color: #FFFFFF;
}


/* =========================================================
   TAB CONTENT
========================================================= */

.reward-tab-content {
    display: none;
}

.reward-tab-content.active {
    display: block;
}


/* =========================================================
   REWARD SECTION
========================================================= */

.reward-section {
    width: 100%;

    padding: 18px;

    border: 1px solid #E9DED1;
    border-radius: 14px;

    background: #FFFDF9;
}

.reward-section-head {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 10px;

    margin-bottom: 14px;
}

.reward-section-title {
    margin: 0;

    color: #171311;

    font-size: 15px;
    font-weight: 700;
}


/* =========================================================
   REWARD GRID
========================================================= */

.reward-grid-all {
    width: 100%;

    display: grid;

    grid-template-columns:
        repeat(auto-fill, minmax(165px, 1fr));

    gap: 14px;
}


/* =========================================================
   REWARD CARD
========================================================= */

.reward-box {
    min-width: 0;

    display: flex;
    flex-direction: column;

    overflow: hidden;

    border: 1px solid #E8DDD0;
    border-radius: 9px;

    background: #FFFFFF;
}

.reward-box-img {
    width: 100%;
    height: 145px;

    display: grid;
    place-items: center;

    overflow: hidden;

    background: #F8EFE4;
}

.reward-box-img img {
    width: auto;
    height: auto;

    max-width: 82%;
    max-height: 120px;

    object-fit: contain;

    padding: 6px;
}

.reward-box-placeholder {
    font-size: 40px;
}

.reward-box-body {
    display: flex;
    flex-direction: column;

    flex: 1;

    padding: 11px;
}

.reward-box-name {
    min-height: 28px;

    color: #201810;

    font-size: 10px;
    line-height: 1.35;

    font-weight: 700;
}

.reward-box-point {
    margin-top: 4px;

    color: #7D6B5C;

    font-size: 9px;
}

.reward-box-point span {
    color: #D39B4C;

    font-size: 12px;
}

.reward-box-actions {
    margin-top: auto;
    padding-top: 8px;
}

.btn-primary {
    width: 100%;

    padding: 9px 6px;

    border: 0;
    border-radius: 6px;

    background: #4B2D1C;
    color: #FFFFFF;

    font-size: 8px;
    font-weight: 700;

    cursor: pointer;
}

.btn-primary:hover:not(:disabled) {
    background: #5B3927;
}

.btn-primary:disabled {
    background: #D8D8D8;
    color: #8A8A8A;

    cursor: not-allowed;
}


/* =========================================================
   HISTORY
========================================================= */

.history-box {
    width: 100%;

    padding: 0;

    border: 0;
    border-radius: 0;

    background: transparent;
}

.history-head {
    margin-bottom: 10px;
}

.history-title {
    margin: 0;

    color: #171311;

    font-size: 15px;
    font-weight: 700;
}

.history-row {
    display: flex;

    align-items: center;
    justify-content: space-between;

    gap: 15px;

    min-height: 52px;

    padding: 9px 4px;

    border-bottom: 1px solid #EEE4DA;
}

.history-row:last-child {
    border-bottom: 0;
}

.history-main {
    min-width: 0;
}

.history-name {
    overflow: hidden;

    color: #251B16;

    font-size: 10px;
    font-weight: 600;

    white-space: nowrap;
    text-overflow: ellipsis;
}

.history-date {
    margin-top: 3px;

    color: #9A8C80;

    font-size: 8px;
}

.history-status {
    flex-shrink: 0;

    padding: 5px 8px;

    border-radius: 999px;

    font-size: 8px;
    font-weight: 600;
}

.history-status.pending {
    background: #FEF3C7;
    color: #A16207;
}

.history-status.done {
    background: #DCFCE7;
    color: #15803D;
}

.history-status.failed {
    background: #FEE2E2;
    color: #B91C1C;
}


/* =========================================================
   POINT HISTORY
========================================================= */

.history-month {
    margin-top: 18px;
    margin-bottom: 8px;

    color: #5A3926;

    font-size: 11px;

    font-weight: 700;
}

.history-month:first-child {
    margin-top: 0;
}

.history-list {
    display: grid;

    gap: 10px;

    width: 100%;
}

.history-activity-row {
    display: grid;

    grid-template-columns:
        42px 190px minmax(0, 1fr) auto;

    align-items: center;

    gap: 14px;

    min-height: 62px;

    padding: 9px 14px;

    border: 1px solid #E9DED1;

    border-radius: 8px;

    background: #FFFFFF;

    box-shadow: 0 1px 3px rgba(52, 34, 23, 0.03);
}



/* ICON */

.history-activity-icon {
    width: 36px;
    height: 36px;

    display: grid;

    place-items: center;

    border-radius: 50%;

    font-size: 16px;
}

.history-activity-icon.plus {
    background: #EEF8F1;
    color: #3E8A56;
}

.history-activity-icon.minus {
    background: #FFF0F0;
    color: #C94343;
}

.history-activity-icon.redeem {
    width: 36px;
    height: 36px;

    display: grid;
    place-items: center;

    border-radius: 50%;

    background: #F7EBDD;

    color: #8A5A32;
}

.history-activity-icon.redeem svg {
    width: 18px;
    height: 18px;
}


/* DATE */

.history-activity-date {
    color: #75665C;

    font-size: 9px;

    white-space: nowrap;
}

.history-activity-date span {
    margin: 0 3px;
}


/* MAIN */

.history-activity-main {
    min-width: 0;
}

.history-activity-title {
    color: #251B16;

    font-size: 10px;

    font-weight: 600;

    line-height: 1.4;
}

.history-activity-description {
    margin-top: 3px;

    color: #75665C;

    font-size: 9px;

    line-height: 1.4;
}


/* POINT */

.history-activity-point {
    font-size: 11px;

    font-weight: 700;

    white-space: nowrap;
}

.history-activity-point.plus {
    color: #2F7D48;
}

.history-activity-point.minus {
    color: #B84444;
}


/* EMPTY */

.history-empty {
    padding: 25px 10px;

    color: #8B796B;

    text-align: center;

    font-size: 10px;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 900px) {

    .reward-summary {
        grid-template-columns: 1fr;
    }

    .reward-stat-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .reward-grid-all {
        grid-template-columns:
            repeat(3, minmax(0, 1fr));
    }

}


@media (max-width: 700px) {

    .reward-box-img {
        height: 125px;
    }

    .reward-box-img img {
        max-width: 75%;
        max-height: 105px;
    }

}


@media (max-width: 480px) {

    .reward-page {
        gap: 14px;
    }

    .reward-section,
    .history-box {
        padding: 12px;
    }

    .reward-grid-all {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 10px;
    }

    .reward-box-img {
        height: 110px;
    }

    .reward-box-img img {
        max-width: 84%;
        max-height: 95px;
        padding: 5px;
    }

    .reward-box-body {
        padding: 8px;
    }

    .reward-box-name {
        font-size: 9px;
        min-height: 24px;
    }

    .reward-box-point {
        font-size: 8px;
    }

    .reward-box-point span {
        font-size: 10px;
    }

    .btn-primary {
        padding: 8px 4px;
        font-size: 7px;
    }

}

@media (max-width: 700px) {

    /* ================================
       HISTORY MOBILE
    ================================= */

    .history-list {
        display: grid;
        gap: 10px;
    }

    .history-activity-row {
        display: grid;

        grid-template-columns:
            40px minmax(0, 1fr) 82px;

        grid-template-rows:
            auto auto;

        column-gap: 10px;
        row-gap: 3px;

        align-items: center;

        min-height: 86px;

        padding: 12px;

        border: 1px solid #E9DED1;
        border-radius: 10px;

        background: #FFFFFF;

        overflow: hidden;
    }


    /* ICON */
    .history-activity-icon {
        grid-column: 1;
        grid-row: 1 / span 2;

        width: 36px;
        height: 36px;

        display: grid;
        place-items: center;

        border-radius: 50%;

        justify-self: center;
    }


    /* DATE */
    .history-activity-date {
        grid-column: 2;
        grid-row: 1;

        min-width: 0;

        color: #75665C;

        font-size: 8px;

        line-height: 1.3;

        white-space: nowrap;
    }


    /* DETAIL */
    .history-activity-main {
        grid-column: 2;
        grid-row: 2;

        min-width: 0;

        overflow: hidden;
    }

    .history-activity-title {
        overflow: hidden;

        color: #251B16;

        font-size: 9px;

        line-height: 1.35;

        font-weight: 700;

        white-space: nowrap;

        text-overflow: ellipsis;
    }

    .history-activity-description {
        margin-top: 2px;

        overflow: hidden;

        color: #75665C;

        font-size: 8px;

        line-height: 1.3;

        white-space: nowrap;

        text-overflow: ellipsis;
    }


    /* POINT */
    .history-activity-point {
        grid-column: 3;
        grid-row: 1 / span 2;

        width: 82px;

        justify-self: end;
        align-self: center;

        text-align: right;

        font-size: 9px;

        line-height: 1.3;

        font-weight: 700;

        white-space: nowrap;
    }

}

@media (max-width: 480px) {

    .history-activity-row {
        grid-template-columns:
            36px minmax(0, 1fr) 76px;

        column-gap: 8px;

        min-height: 82px;

        padding: 10px;
    }

    .history-activity-icon {
        width: 34px;
        height: 34px;
    }

    .history-activity-point {
        width: 76px;

        font-size: 8px;
    }

    .history-activity-date {
        font-size: 7px;
    }

    .history-activity-title {
        font-size: 8px;
    }

    .history-activity-description {
        font-size: 7px;
    }

}
</style>


<div class="reward-page">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="reward-head">

        <div>

            <h1>
                Reward
            </h1>

            <p>
                Tukarkan point dengan reward favorit Anda.
            </p>

        </div>

    </div>


    {{-- =====================================================
         SUMMARY
    ====================================================== --}}

    <div class="reward-summary">


        {{-- POINT CUSTOMER --}}
        <div class="reward-balance">

            <div class="reward-balance-label">
                Point Kamu Saat Ini
            </div>

            <div class="reward-balance-point">

                <strong>
                    {{ number_format((int) $customer->saldo_point, 0, ',', '.') }}
                </strong>

                <span>
                    Point
                </span>

            </div>

            <div class="reward-balance-rule">
                1 Point = Rp 10.000 pembelanjaan
            </div>

        </div>


        {{-- RIGHT SIDE --}}
        <div class="reward-summary-right">


            {{-- STATISTICS --}}
            <div class="reward-stat-grid">

                <div class="reward-stat-card">

                    <div class="reward-stat-icon">
                        ☆
                    </div>

                    <div>

                        <div class="reward-stat-label">
                            Total Point Didapat
                        </div>

                        <div class="reward-stat-value">
                            {{ number_format((int) ($totalPointDidapat ?? 0), 0, ',', '.') }}
                            Point
                        </div>

                    </div>

                </div>


                <div class="reward-stat-card">

                    <div class="reward-stat-icon">
                        🎁
                    </div>

                    <div>

                        <div class="reward-stat-label">
                            Total Point Digunakan
                        </div>

                        <div class="reward-stat-value">
                            {{ number_format((int) ($totalPointDigunakan ?? 0), 0, ',', '.') }}
                            Point
                        </div>

                    </div>

                </div>

            </div>


            {{-- TABS --}}
            <div class="reward-tabs" role="tablist">

                <button type="button" class="reward-tab" data-tab="reward">
                    🎁 Reward
                </button>
                <button type="button" class="reward-tab" data-tab="history">
                    ▤ Riwayat Penukaran
                </button>
            </div>

        </div>

    </div>


    {{-- =====================================================
         REWARD CONTENT
    ====================================================== --}}

    <section id="reward-list" class="reward-section reward-tab-content active">

        <div class="reward-section-head">

            <h2 class="reward-section-title">
                Reward Tersedia
            </h2>

        </div>


        <div class="reward-grid-all">

            @forelse($rewards as $reward)

            <article class="reward-box">


                <div class="reward-box-img">

                    @if($reward->image_path)

                    <img src="{{ '/storage/' . ltrim($reward->image_path, '/') }}" alt="{{ $reward->reward_name }}"
                        onerror="
                                    this.style.display='none';
                                    this.nextElementSibling.style.display='block';
                                ">

                    @endif

                    <div class="reward-box-placeholder" style="{{ $reward->image_path ? 'display:none' : '' }}">
                        🎁
                    </div>

                </div>


                <div class="reward-box-body">

                    <div class="reward-box-name">
                        {{ $reward->reward_name }}
                    </div>

                    <div class="reward-box-point">

                        <span>★</span>

                        {{ number_format((int) $reward->point_required, 0, ',', '.') }}
                        Point

                    </div>


                    <div class="reward-box-actions">

                        <form method="POST" action="{{ route('customer.reward.redeem') }}"
                            onsubmit="return redeemReward(event, this)">

                            @csrf

                            <input type="hidden" name="id_reward" value="{{ $reward->id_reward }}">

                            <button type="submit" class="btn-primary"
                                {{ (int) $customer->saldo_point < (int) $reward->point_required ? 'disabled' : '' }}>
                                Tukarkan Sekarang
                            </button>

                        </form>

                    </div>

                </div>

            </article>

            @empty

            <div style="
                        grid-column:1/-1;
                        color:#8B796B;
                        font-size:10px;
                        padding:25px 0;
                        text-align:center;
                    ">
                Belum ada reward tersedia.
            </div>

            @endforelse

        </div>

    </section>

    {{-- =====================================================
     HISTORY CONTENT
====================================================== --}}

    <section id="reward-history" class="history-box reward-tab-content">

        <div class="history-head">

            <h2 class="history-title">
                Riwayat Penukaran
            </h2>

        </div>


        @php
        /*
        * Riwayat yang ditampilkan DI SINI HANYA redemption.
        * Tidak menggunakan $pointHistory karena itu mencakup
        * transaksi pembelian juga.
        */
        $groupedRedemptions = $redemptions->groupBy(
        fn ($redemption) =>
        optional($redemption->created_at)->format('Y-m')
        );
        @endphp


        @forelse($groupedRedemptions as $month => $redemptionItems)

        @php
        $monthDate = \Carbon\Carbon::createFromFormat(
        'Y-m',
        $month
        );
        @endphp


        {{-- =========================
             NAMA BULAN
        ========================== --}}

        <div class="history-month">

            {{ $monthDate->translatedFormat('F Y') }}

        </div>


        {{-- =========================
             LIST REDEMPTION
        ========================== --}}

        <div class="history-list">

            @foreach($redemptionItems as $redemption)

            <div class="history-activity-row">


                {{-- ICON --}}

                <div class="history-activity-icon redeem">

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round" aria-hidden="true">
                        <path d="M20 12v8a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-8" />
                        <path d="M2 7h20v5H2z" />
                        <path d="M12 7v14" />
                        <path d="M12 7H7.5a2.5 2.5 0 1 1 0-5C10 2 12 7 12 7Z" />
                        <path d="M12 7h4.5a2.5 2.5 0 1 0 0-5C14 2 12 7 12 7Z" />
                    </svg>

                </div>


                {{-- TANGGAL --}}

                <div class="history-activity-date">

                    {{ optional($redemption->created_at)->format('j F Y') }}

                    <span>•</span>

                    {{ optional($redemption->created_at)->format('H:i') }}

                </div>


                {{-- DETAIL --}}

                <div class="history-activity-main">

                    <div class="history-activity-title">
                        Penukaran Reward
                    </div>

                    <div class="history-activity-description">

                        {{ $redemption->reward->reward_name ?? 'Reward' }}

                    </div>

                </div>


                {{-- POINT --}}

                <div class="history-activity-point minus">

                    -
                    {{ number_format(
                            (int) $redemption->point_used,
                            0,
                            ',',
                            '.'
                        ) }}

                    Point

                </div>

            </div>

            @endforeach

        </div>


        @empty

        <div class="history-empty">

            Belum ada riwayat penukaran.

        </div>

        @endforelse

    </section>

</div>


<script>
document.addEventListener('DOMContentLoaded', function() {

    const tabs =
        document.querySelectorAll('.reward-tab');

    const contents =
        document.querySelectorAll('.reward-tab-content');


    tabs.forEach(function(tab) {

        tab.addEventListener('click', function() {

            const targetId =
                this.dataset.target;


            tabs.forEach(function(item) {

                item.classList.remove('active');

                item.setAttribute(
                    'aria-selected',
                    'false'
                );

            });


            contents.forEach(function(content) {

                content.classList.remove('active');

            });


            this.classList.add('active');

            this.setAttribute(
                'aria-selected',
                'true'
            );


            const target =
                document.getElementById(targetId);

            if (target) {

                target.classList.add('active');

            }

        });

    });

});


async function redeemReward(event, form) {

    event.preventDefault();

    const button =
        form.querySelector('button');

    button.disabled = true;


    try {

        const response =
            await fetch(
                form.action, {
                    method: 'POST',

                    headers: {
                        'X-CSRF-TOKEN': document
                            .querySelector(
                                'meta[name="csrf-token"]'
                            )
                            .content,

                        'Accept': 'application/json'
                    },

                    body: new FormData(form)
                }
            );


        const data =
            await response.json();


        if (!response.ok) {

            throw new Error(
                data.message ||
                'Redemption gagal'
            );

        }


        window.location.href =
            "{{ url('/customer/reward/redemption') }}/" +
            data.data.code;


    } catch (error) {

        alert(error.message);

        button.disabled = false;

    }


    return false;
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const tabs = document.querySelectorAll('.reward-tab');

    const rewardContent =
        document.getElementById('reward-list');

    const historyContent =
        document.getElementById('reward-history');


    function activateTab(tabName) {

        tabs.forEach(function(tab) {

            tab.classList.toggle(
                'active',
                tab.dataset.tab === tabName
            );

        });


        if (rewardContent) {
            rewardContent.classList.toggle(
                'active',
                tabName === 'reward'
            );
        }


        if (historyContent) {
            historyContent.classList.toggle(
                'active',
                tabName === 'history'
            );
        }

    }


    /* =============================================
       TAB DARI URL
    ============================================== */

    const params =
        new URLSearchParams(window.location.search);

    const requestedTab =
        params.get('tab');


    const initialTab =
        requestedTab === 'history' ?
        'history' :
        'reward';


    activateTab(initialTab);


    /* =============================================
       KLIK TAB
    ============================================== */

    tabs.forEach(function(tab) {

        tab.addEventListener(
            'click',
            function() {

                const tabName =
                    this.dataset.tab;

                activateTab(tabName);


                /* Update URL tanpa reload */

                const url =
                    new URL(window.location.href);


                if (tabName === 'history') {

                    url.searchParams.set(
                        'tab',
                        'history'
                    );

                } else {

                    url.searchParams.delete(
                        'tab'
                    );

                }


                window.history.replaceState({},
                    '',
                    url
                );

            }
        );

    });

});
</script>

@endsection