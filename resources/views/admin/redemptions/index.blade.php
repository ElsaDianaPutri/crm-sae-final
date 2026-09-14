@extends('layouts.admin')

@section('title', 'Redemption Management - SAE CAFE ROJEL CRM')

@section('content')

<style>
/*
    |--------------------------------------------------------------------------
    | REDEMPTION MANAGEMENT
    | Unified Responsive Layout
    |--------------------------------------------------------------------------
    */

.redemption-page {
    width: 100%;
    min-width: 0;
}

/*
    |--------------------------------------------------------------------------
    | HEADER
    |--------------------------------------------------------------------------
    */

.redemption-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
}

/*
    |--------------------------------------------------------------------------
    | FILTER
    |--------------------------------------------------------------------------
    */

.redemption-filter {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 100px;
    align-items: center;
    gap: 12px;
    width: 100%;
}

.redemption-search-input {
    width: 100%;
    height: 48px;

    border: 1px solid #e5e7eb;
    border-radius: 12px;

    background: #ffffff;

    padding: 0 16px;

    font-size: 14px;
    color: #111827;

    outline: none;

    transition: 0.2s ease;
}

.redemption-search-input::placeholder {
    color: #9ca3af;
}

.redemption-search-input:focus {
    border-color: #4A2E1F;

    box-shadow:
        0 0 0 3px rgba(74, 46, 31, 0.08);
}

.redemption-search-button {
    width: 100%;
    height: 48px;

    border: 0;
    border-radius: 12px;

    background: #4A2E1F;
    color: #ffffff;

    font-size: 14px;
    font-weight: 600;

    cursor: pointer;

    transition: 0.2s ease;
}

.redemption-search-button:hover {
    background: #3A2117;
}

/*
    |--------------------------------------------------------------------------
    | LIST
    |--------------------------------------------------------------------------
    */

.redemption-list-wrapper {
    width: 100%;
    min-width: 0;

    overflow: hidden;

    border: 1px solid #e5ddd5;
    border-radius: 18px;

    background: #ffffff;

    box-shadow:
        0 2px 10px rgba(52, 34, 23, 0.05);
}

/*
    |--------------------------------------------------------------------------
    | DESKTOP HEADER
    |--------------------------------------------------------------------------
    */

.redemption-list-header {
    display: grid;

    grid-template-columns:
        1.15fr 1.2fr 1.15fr 0.7fr 0.9fr 1fr;

    align-items: center;

    gap: 14px;

    padding: 15px 18px;

    background: #4A2E1F;

    color: #ffffff;

    font-size: 12px;
    line-height: 16px;
    font-weight: 700;
}

/*
    |--------------------------------------------------------------------------
    | ROW
    |--------------------------------------------------------------------------
    */

.redemption-row {
    display: grid;

    grid-template-columns:
        1.15fr 1.2fr 1.15fr 0.7fr 0.9fr 1fr;

    align-items: center;

    gap: 14px;

    min-width: 0;

    padding: 16px 18px;

    border-top: 1px solid #f0ece8;

    background: #ffffff;

    transition: background 0.2s ease;
}

.redemption-row:hover {
    background: #fcfaf8;
}

.redemption-field {
    min-width: 0;
}

.redemption-label {
    display: none;

    margin-bottom: 2px;

    color: #9ca3af;

    font-size: 10px;
    line-height: 14px;

    font-weight: 600;

    letter-spacing: 0.04em;

    text-transform: uppercase;
}

.redemption-value {
    min-width: 0;

    color: #374151;

    font-size: 13px;
    line-height: 18px;

    overflow-wrap: anywhere;
}

.redemption-code {
    color: #4A2E1F;
    font-weight: 700;
}

.redemption-customer {
    color: #111827;
    font-weight: 600;
}

.redemption-subvalue {
    margin-top: 2px;

    color: #9ca3af;

    font-size: 11px;
    line-height: 15px;
}

.redemption-point {
    color: #b91c1c;
    font-weight: 700;
}

/*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

.redemption-status {
    display: inline-flex;

    width: fit-content;

    align-items: center;
    justify-content: center;

    border-radius: 999px;

    padding: 5px 10px;

    font-size: 10px;
    line-height: 13px;

    font-weight: 600;

    white-space: nowrap;
}

.redemption-status.success {
    background: #dcfce7;
    color: #15803d;
}

.redemption-status.pending {
    background: #fef3c7;
    color: #b45309;
}

.redemption-status.failed {
    background: #fee2e2;
    color: #b91c1c;
}

.redemption-status.default {
    background: #f3f4f6;
    color: #4b5563;
}

/*
    |--------------------------------------------------------------------------
    | EMPTY
    |--------------------------------------------------------------------------
    */

.redemption-empty {
    padding: 48px 20px;

    text-align: center;

    color: #6b7280;

    font-size: 14px;
}

/*
    |--------------------------------------------------------------------------
    | TABLET
    |--------------------------------------------------------------------------
    */

@media (max-width: 1024px) {

    .redemption-list-header {
        grid-template-columns:
            1fr 1.1fr 1fr 0.65fr 0.8fr 0.95fr;

        gap: 10px;

        padding: 14px;
    }

    .redemption-row {
        grid-template-columns:
            1fr 1.1fr 1fr 0.65fr 0.8fr 0.95fr;

        gap: 10px;

        padding: 14px;
    }

    .redemption-value {
        font-size: 12px;
    }
}

/*
    |--------------------------------------------------------------------------
    | MOBILE
    |--------------------------------------------------------------------------
    */

@media (max-width: 767px) {

    .redemption-header {
        display: block;
    }

    .redemption-filter {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .redemption-search-input,
    .redemption-search-button {
        height: 46px;
    }

    .redemption-list-wrapper {
        border: 0;

        background: transparent;

        box-shadow: none;

        overflow: visible;
    }

    .redemption-list-header {
        display: none;
    }

    /*
        SAME ROW → MOBILE CARD
        */

    .redemption-row {
        display: grid;

        grid-template-columns:
            minmax(0, 1fr) auto;

        gap: 0;

        width: 100%;

        margin-bottom: 10px;

        padding: 14px;

        border: 1px solid #e5e7eb;
        border-radius: 16px;

        background: #ffffff;

        box-shadow:
            0 2px 8px rgba(52, 34, 23, 0.04);
    }

    .redemption-row:last-child {
        margin-bottom: 0;
    }

    /*
        CODE
        */

    .redemption-field.code {
        grid-column: 1;
        grid-row: 1;
    }

    /*
        STATUS
        */

    .redemption-field.status {
        grid-column: 2;
        grid-row: 1;

        justify-self: end;
    }

    /*
        CUSTOMER
        */

    .redemption-field.customer {
        grid-column: 1 / -1;
        grid-row: 2;

        margin-top: 12px;
    }

    /*
        REWARD
        */

    .redemption-field.reward {
        grid-column: 1 / -1;
        grid-row: 3;

        margin-top: 12px;
    }

    /*
        POINT
        */

    .redemption-field.point {
        grid-column: 1;
        grid-row: 4;

        margin-top: 12px;
    }

    /*
        DATE
        */

    .redemption-field.date {
        grid-column: 2;
        grid-row: 4;

        margin-top: 12px;

        text-align: right;
    }

    .redemption-label {
        display: block;
    }

    .redemption-value {
        font-size: 13px;
        line-height: 18px;
    }

    .redemption-customer {
        font-size: 15px;
    }

    .redemption-status {
        padding: 4px 9px;

        font-size: 10px;
        line-height: 14px;
    }

    .redemption-subvalue {
        font-size: 10px;
    }
}

/*
    |--------------------------------------------------------------------------
    | SMALL PHONE
    |--------------------------------------------------------------------------
    */

@media (max-width: 380px) {

    .redemption-row {
        padding: 12px;
    }

    .redemption-value {
        font-size: 12px;
    }

    .redemption-customer {
        font-size: 14px;
    }
}
</style>


<div class="redemption-page space-y-6">

    {{-- ======================================================
        HEADER
    ======================================================= --}}
    <div class="redemption-header">

        <div class="min-w-0">

            <h1 class="text-2xl font-semibold text-gray-900 sm:text-3xl">
                Redemption Management
            </h1>

            <p class="mt-1 text-sm text-gray-500 sm:text-base">
                Pantau reward yang diajukan dan yang sudah dikonfirmasi kasir.
            </p>

        </div>

    </div>


    {{-- ======================================================
        SEARCH + FILTER
    ======================================================= --}}
    <div class="w-full rounded-2xl bg-white p-4 shadow-sm sm:p-5">

        <form id="redemption-filter-form" method="GET" action="{{ route('admin.redemptions.index') }}"
            class="redemption-filter">

            <input id="redemption-search" type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari kode redemption / customer / reward..." autocomplete="off"
                class="redemption-search-input" aria-label="Cari redemption">

            <button type="submit" class="redemption-search-button">
                Cari
            </button>

        </form>

    </div>


    {{-- ======================================================
        REDEMPTION LIST
        SATU MARKUP RESPONSIVE
    ======================================================= --}}
    <div class="redemption-list-wrapper">

        {{-- DESKTOP HEADER --}}
        <div class="redemption-list-header">

            <div>Kode</div>
            <div>Customer</div>
            <div>Reward</div>
            <div>Point</div>
            <div>Status</div>
            <div>Tanggal</div>

        </div>


        {{-- HASIL --}}
        <div id="redemption-results" class="transition-opacity duration-200">

            @include(
            'admin.redemptions.partials.results'
            )

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function() {

    const form = document.getElementById(
        'redemption-filter-form'
    );

    const searchInput = document.getElementById(
        'redemption-search'
    );

    const results = document.getElementById(
        'redemption-results'
    );


    if (!form || !searchInput || !results) {
        return;
    }


    let timer = null;
    let controller = null;


    async function loadRedemptions(url = null) {
        const targetUrl = url ?
            new URL(
                url,
                window.location.origin
            ) :
            new URL(
                form.action,
                window.location.origin
            );


        if (!url) {

            targetUrl.search = '';

            const search =
                searchInput.value.trim();

            if (search !== '') {
                targetUrl.searchParams.set(
                    'search',
                    search
                );
            }

        }

        if (controller) {
            controller.abort();
        }

        controller =
            new AbortController();


        results.style.opacity = '0.5';


        try {

            const response =
                await fetch(
                    targetUrl.toString(), {
                        method: 'GET',

                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',

                            'Accept': 'text/html',
                        },

                        signal: controller.signal,
                    }
                );


            if (!response.ok) {

                throw new Error(
                    `HTTP ${response.status}`
                );

            }


            const html =
                await response.text();


            results.innerHTML =
                html;


            window.history.replaceState({},
                '',
                targetUrl.toString()
            );


        } catch (error) {

            if (
                error.name ===
                'AbortError'
            ) {
                return;
            }


            console.error(
                'Redemption live search error:',
                error
            );


            results.innerHTML = `
                <div class="redemption-empty">
                    Gagal memuat data redemption.
                </div>
            `;

        } finally {

            results.style.opacity = '1';

        }

    }


    /*
    |--------------------------------------------------------------------------
    | LIVE SEARCH
    |--------------------------------------------------------------------------
    */

    searchInput.addEventListener(
        'input',
        function() {

            clearTimeout(timer);

            timer = setTimeout(
                function() {

                    loadRedemptions();

                },
                450
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | SUBMIT
    |--------------------------------------------------------------------------
    */

    form.addEventListener(
        'submit',
        function(event) {

            event.preventDefault();

            clearTimeout(timer);

            loadRedemptions();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | PAGINATION
    |--------------------------------------------------------------------------
    */

    results.addEventListener(
        'click',
        function(event) {

            const link =
                event.target.closest('a');


            if (!link) {
                return;
            }


            const pagination =
                link.closest(
                    '#redemption-pagination'
                );


            if (!pagination) {
                return;
            }


            event.preventDefault();

            loadRedemptions(
                link.href
            );

        }
    );

});
</script>

@endsection