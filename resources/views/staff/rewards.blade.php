@extends('layouts.staff')

@section('title', 'Reward - Staff')

@section('content')

<style>
/* =========================================================
       PAGE
    ========================================================== */

.staff-reward-page {
    width: 100%;
    min-width: 0;
}

.staff-reward-header {
    margin-bottom: 20px;
}

.staff-reward-title {
    margin: 0;

    color: #171717;

    font-size: 26px;
    line-height: 34px;

    font-weight: 600;
}

.staff-reward-subtitle {
    margin: 5px 0 0;

    color: #7F6D60;

    font-size: 13px;
    line-height: 19px;
}

/* reward search */

.staff-reward-search {
    margin-bottom: 20px;
}

.staff-reward-search-input-wrap {
    position: relative;
}

.staff-reward-search-input {
    width: 100%;

    min-height: 44px;

    padding: 12px 14px 12px 42px;

    border: 1px solid #DDD2C8;
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

.staff-reward-search-input:focus {
    border-color: #4A2E1F;

    box-shadow:
        0 0 0 3px rgba(74, 46, 31, .08);
}

.staff-reward-search-input::placeholder {
    color: #A49487;
}

.staff-reward-search-icon {
    position: absolute;

    left: 14px;
    top: 50%;

    width: 18px;
    height: 18px;

    transform: translateY(-50%);

    color: #8D745E;

    pointer-events: none;
}




/* =========================================================
       GRID
    ========================================================== */

.staff-reward-grid {
    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 16px;
}

/* =========================================================
       CARD
    ========================================================== */

.staff-reward-card {
    min-width: 0;

    overflow: hidden;

    background: #FFFFFF;

    border:
        1px solid #EADFD1;

    border-radius: 16px;

    box-shadow:
        0 8px 24px rgba(48, 31, 21, .04);

    transition:
        transform .2s ease,
        box-shadow .2s ease;
}

.staff-reward-card:hover {
    transform: translateY(-2px);

    box-shadow:
        0 12px 28px rgba(48, 31, 21, .07);
}


/* =========================================================
       IMAGE
    ========================================================== */

.staff-reward-image {
    width: 100%;
    height: 150px;

    background: #F7F3ED;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: hidden;
}

.staff-reward-image img {
    width: 100%;
    height: 100%;

    object-fit: contain;
    object-position: center;

    display: block;
}

.staff-reward-no-image {
    color: #9A8779;

    font-size: 11px;
}


/* =========================================================
       BODY
    ========================================================== */

.staff-reward-body {
    padding: 16px;
}

.staff-reward-name {
    color: #171717;

    font-size: 15px;

    line-height: 20px;

    font-weight: 600;
}

.staff-reward-description {
    margin: 6px 0 14px;

    color: #7F6D60;

    font-size: 11px;

    line-height: 17px;
}


/* =========================================================
       META
    ========================================================== */

.staff-reward-meta {
    display: flex;

    align-items: center;
    justify-content: space-between;

    gap: 10px;

    padding-top: 12px;

    border-top:
        1px solid #F0ECE8;
}

.staff-reward-point {
    color: #4A2E1F;

    font-size: 12px;

    font-weight: 700;
}

.staff-reward-stock {
    color: #7F6D60;

    font-size: 11px;

    font-weight: 500;
}


/* =========================================================
       EMPTY
    ========================================================== */

.staff-reward-empty {
    padding: 30px 20px;

    background: #FFFFFF;

    border:
        1px solid #EADFD1;

    border-radius: 16px;

    color: #9A8779;

    font-size: 12px;
}


/* =========================================================
       RESPONSIVE
    ========================================================== */

@media (max-width: 1100px) {

    .staff-reward-grid {
        grid-template-columns:
            repeat(3, minmax(0, 1fr));
    }

}

@media (max-width: 850px) {

    .staff-reward-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

}

@media (max-width: 560px) {

    .staff-reward-grid {
        grid-template-columns: 1fr;
    }

    .staff-reward-image {
        height: 145px;
    }

}
</style>


<div class="staff-reward-page">


    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="staff-reward-header">

        <h1 class="staff-reward-title">
            Reward Tersedia
        </h1>

        <p class="staff-reward-subtitle">
            Lihat reward yang tersedia untuk ditukar oleh customer.
        </p>

    </div>

    {{-- =====================================================
        SEARCH REWARDS
    ====================================================== --}}

    <div class="staff-reward-search">

        <div class="staff-reward-search-input-wrap">

            <svg class="staff-reward-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="1.8">
                <circle cx="11" cy="11" r="6" />

                <path stroke-linecap="round" d="m16 16 4 4" />
            </svg>

            <input type="text" id="staffRewardSearch" name="search" value="{{ request('search') }}"
                placeholder="Cari nama reward atau point..." autocomplete="off" class="staff-reward-search-input">

        </div>

    </div>


    {{-- =====================================================
        REWARD GRID
    ====================================================== --}}

    <div id="staffRewardList" class="staff-reward-grid">
        @include(
        'staff.partials.reward-list',
        ['rewards' => $rewards]
        )
    </div>


</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const searchInput =
        document.getElementById('staffRewardSearch');

    const resultContainer =
        document.getElementById('staffRewardList');


    if (!searchInput || !resultContainer) {
        return;
    }


    let timer = null;


    async function loadRewards() {

        const search =
            searchInput.value.trim();


        const params =
            new URLSearchParams();


        if (search !== '') {
            params.set('search', search);
        }


        resultContainer.style.opacity = '0.5';


        try {

            const response = await fetch(
                `{{ route('staff.rewards') }}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html'
                    }
                }
            );


            if (!response.ok) {
                throw new Error(
                    `HTTP ${response.status}`
                );
            }


            const html =
                await response.text();


            resultContainer.innerHTML =
                html;


        } catch (error) {

            console.error(
                'Reward live search error:',
                error
            );


            resultContainer.innerHTML = `
                <div class="staff-reward-empty">
                    Gagal memuat reward.
                </div>
            `;

        } finally {

            resultContainer.style.opacity = '1';

        }

    }


    searchInput.addEventListener(
        'input',
        function() {

            clearTimeout(timer);

            timer = setTimeout(
                loadRewards,
                400
            );

        }
    );

});
</script>

@endsection