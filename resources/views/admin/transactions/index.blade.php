@extends('layouts.admin')

@section('title', 'Transaction Management - SAE CAFE ROJEL CRM')

@section('content')

<style>
/*
    |--------------------------------------------------------------------------
    | TRANSACTION MANAGEMENT
    | Unified Responsive Layout
    |--------------------------------------------------------------------------
    */

.transaction-page {
    width: 100%;
    min-width: 0;
}

/*
    |--------------------------------------------------------------------------
    | HEADER
    |--------------------------------------------------------------------------
    */

.transaction-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
}

/*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

.transaction-search-box {
    width: 100%;
}

.transaction-search-input {
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

.transaction-search-form {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
}

.transaction-search-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    flex: 0 0 96px;

    height: 48px;

    border: 0;
    border-radius: 12px;

    background: #4A2E1F;
    color: #ffffff;

    padding: 0 20px;

    font-size: 14px;
    line-height: 20px;
    font-weight: 600;

    cursor: pointer;

    transition:
        background 0.2s ease,
        transform 0.15s ease;
}

.transaction-search-button:hover {
    background: #3A2117;
}

.transaction-search-button:active {
    transform: scale(0.98);
}

.transaction-search-input::placeholder {
    color: #9ca3af;
}

.transaction-search-input:focus {
    border-color: #4A2E1F;

    box-shadow:
        0 0 0 3px rgba(74, 46, 31, 0.08);
}

/*
    |--------------------------------------------------------------------------
    | LIST WRAPPER
    |--------------------------------------------------------------------------
    */

.transaction-list-wrapper {
    width: 100%;
    min-width: 0;

    overflow: hidden;

    border: 1px solid #e5ddd5;
    border-radius: 18px;

    background: #ffffff;

    box-shadow:
        0 2px 10px rgba(52, 34, 23, 0.05);

    transition: opacity 0.2s ease;
}

/*
    |--------------------------------------------------------------------------
    | DESKTOP HEADER
    |--------------------------------------------------------------------------
    */

.transaction-list-header {
    display: grid;

    grid-template-columns:
        1.15fr 1.2fr 0.9fr 0.7fr 0.8fr 0.9fr 1fr;

    align-items: center;

    gap: 14px;

    min-width: 0;

    padding: 15px 18px;

    background: #4A2E1F;

    color: #ffffff;

    font-size: 12px;
    line-height: 16px;

    font-weight: 700;
}

/*
    |--------------------------------------------------------------------------
    | TRANSACTION ROW
    |--------------------------------------------------------------------------
    */

.transaction-row {
    display: grid;

    grid-template-columns:
        1.15fr 1.2fr 0.9fr 0.7fr 0.8fr 0.9fr 1fr;

    align-items: center;

    gap: 14px;

    min-width: 0;

    padding: 16px 18px;

    border-top: 1px solid #f0ece8;

    background: #ffffff;

    transition:
        background 0.2s ease;
}

.transaction-row:hover {
    background: #fcfaf8;
}

/*
    |--------------------------------------------------------------------------
    | FIELDS
    |--------------------------------------------------------------------------
    */

.transaction-field {
    min-width: 0;
}

.transaction-label {
    display: none;

    margin-bottom: 2px;

    color: #9ca3af;

    font-size: 10px;
    line-height: 14px;

    font-weight: 600;

    letter-spacing: 0.04em;

    text-transform: uppercase;
}

.transaction-value {
    min-width: 0;

    color: #374151;

    font-size: 13px;
    line-height: 18px;

    overflow-wrap: anywhere;
}

/*
    |--------------------------------------------------------------------------
    | CODE
    |--------------------------------------------------------------------------
    */

.transaction-code {
    color: #4A2E1F;
    font-weight: 700;
}

/*
    |--------------------------------------------------------------------------
    | CUSTOMER
    |--------------------------------------------------------------------------
    */

.transaction-customer {
    color: #111827;
    font-weight: 600;
}

/*
    |--------------------------------------------------------------------------
    | POINT
    |--------------------------------------------------------------------------
    */

.transaction-point {
    color: #15803d;
    font-weight: 700;
}

/*
    |--------------------------------------------------------------------------
    | SOURCE
    |--------------------------------------------------------------------------
    */

.transaction-source {
    color: #6b7280;

    font-size: 12px;

    font-weight: 600;

    text-transform: uppercase;
}

/*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

.transaction-status {
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

.transaction-status.success {
    background: #dcfce7;
    color: #15803d;
}

.transaction-status.pending {
    background: #fef3c7;
    color: #b45309;
}

.transaction-status.failed {
    background: #fee2e2;
    color: #b91c1c;
}

.transaction-status.default {
    background: #f3f4f6;
    color: #4b5563;
}

/*
    |--------------------------------------------------------------------------
    | EMPTY
    |--------------------------------------------------------------------------
    */

.transaction-empty {
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

    .transaction-list-header {
        grid-template-columns:
            1.1fr 1.25fr 0.9fr 0.7fr 0.8fr 0.85fr 0.9fr;

        gap: 10px;

        padding: 14px;
    }

    .transaction-row {
        grid-template-columns:
            1.1fr 1.25fr 0.9fr 0.7fr 0.8fr 0.85fr 0.9fr;

        gap: 10px;

        padding: 14px;
    }

    .transaction-value {
        font-size: 12px;
    }
}

/*
    |--------------------------------------------------------------------------
    | MOBILE
    |--------------------------------------------------------------------------
    */

@media (max-width: 767px) {

    .transaction-search-form {
        flex-direction: row;
        gap: 8px;
    }

    .transaction-search-button {
        flex: 0 0 82px;
        height: 46px;
        padding: 0 14px;
        font-size: 12px;
    }

    .transaction-header {
        display: block;
    }

    .transaction-search-input {
        height: 46px;
    }

    .transaction-list-wrapper {
        border: 0;

        background: transparent;

        box-shadow: none;

        overflow: visible;
    }

    /*
        Header tabel disembunyikan.
        BUKAN membuat markup baru.
        */

    .transaction-list-header {
        display: none;
    }

    /*
        Row yang sama berubah menjadi CARD.
        */

    .transaction-row {
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

    .transaction-row:last-child {
        margin-bottom: 0;
    }

    /*
        CODE
        */

    .transaction-field.code {
        grid-column: 1;
        grid-row: 1;
    }

    /*
        STATUS
        */

    .transaction-field.status {
        grid-column: 2;
        grid-row: 1;

        justify-self: end;
    }

    /*
        CUSTOMER
        */

    .transaction-field.customer {
        grid-column: 1 / -1;
        grid-row: 2;

        margin-top: 12px;
    }

    /*
        TOTAL
        */

    .transaction-field.total {
        grid-column: 1;
        grid-row: 3;

        margin-top: 12px;
    }

    /*
        POINT
        */

    .transaction-field.point {
        grid-column: 2;
        grid-row: 3;

        margin-top: 12px;

        text-align: right;
    }

    /*
        SOURCE
        */

    .transaction-field.source {
        grid-column: 1;
        grid-row: 4;

        margin-top: 10px;
    }

    /*
        DATE
        */

    .transaction-field.date {
        grid-column: 2;
        grid-row: 4;

        margin-top: 10px;

        text-align: right;
    }

    .transaction-label {
        display: block;
    }

    .transaction-value {
        font-size: 13px;
        line-height: 18px;
    }

    .transaction-code {
        font-size: 13px;
    }

    .transaction-customer {
        font-size: 15px;
    }

    .transaction-point {
        font-size: 14px;
    }

    .transaction-source {
        font-size: 11px;
    }

    .transaction-date {
        font-size: 11px;
        color: #6b7280;
    }

    .transaction-status {
        padding: 4px 9px;

        font-size: 10px;
        line-height: 14px;
    }

    /*
        Pagination tetap bisa digeser jika diperlukan.
        */

    #transaction-pagination {
        overflow-x: auto;
    }
}

/*
    |--------------------------------------------------------------------------
    | SMALL PHONE
    |--------------------------------------------------------------------------
    */

@media (max-width: 380px) {

    .transaction-row {
        padding: 12px;
    }

    .transaction-value {
        font-size: 12px;
    }

    .transaction-customer {
        font-size: 14px;
    }

    .transaction-date {
        font-size: 10px;
    }
}
</style>


<div class="transaction-page space-y-6">

    {{-- ======================================================
        HEADER
    ======================================================= --}}
    <div class="transaction-header">

        <div class="min-w-0">

            <h1 class="text-2xl font-semibold text-gray-900 sm:text-3xl">
                Transaction Management
            </h1>

            <p class="mt-1 text-sm text-gray-500 sm:text-base">
                Monitoring transaksi dan point yang diberikan kepada member.
            </p>

        </div>

    </div>


    {{-- ======================================================
    SEARCH TRANSACTION
======================================================= --}}
    <div class="transaction-search-box rounded-2xl bg-white p-4 shadow-sm sm:p-5">

        <form id="transaction-search-form" method="GET" action="{{ route('admin.transactions.index') }}"
            class="transaction-search-form">

            <input id="transaction-search" type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari kode transaksi / customer..." autocomplete="off" class="transaction-search-input"
                aria-label="Cari transaksi">

            <button type="submit" class="transaction-search-button">
                Cari
            </button>

        </form>

    </div>


    {{-- ======================================================
        TRANSACTION LIST
        SATU MARKUP RESPONSIVE
    ======================================================= --}}
    <div class="transaction-list-wrapper">

        {{-- DESKTOP HEADER --}}
        <div class="transaction-list-header">

            <div>Kode</div>
            <div>Customer</div>
            <div>Total</div>
            <div>Point</div>
            <div>Source</div>
            <div>Status</div>
            <div>Tanggal</div>

        </div>


        {{-- HASIL TRANSAKSI --}}
        <div id="transaction-results" class="transition-opacity duration-200">

            @include(
            'admin.transactions.partials.results'
            )

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function() {

    const form = document.getElementById(
        'transaction-search-form'
    );

    const input = document.getElementById(
        'transaction-search'
    );

    const results = document.getElementById(
        'transaction-results'
    );

    if (!form || !input || !results) {
        return;
    }


    let timer = null;
    let controller = null;


    /*
    |--------------------------------------------------------------------------
    | LOAD TRANSACTIONS
    |--------------------------------------------------------------------------
    */

    async function loadTransactions(url = null) {

        const targetUrl = url ?
            new URL(url, window.location.origin) :
            new URL(
                form.action,
                window.location.origin
            );


        /*
        Kalau bukan pagination,
        gunakan nilai input terbaru.
        */

        if (!url) {

            const search = input.value.trim();

            targetUrl.search = '';

            if (search !== '') {
                targetUrl.searchParams.set(
                    'search',
                    search
                );
            }
        }


        /*
        Batalkan request sebelumnya.
        */

        if (controller) {
            controller.abort();
        }

        controller = new AbortController();


        /*
        Loading visual.
        */

        results.style.opacity = '0.5';


        try {

            const response = await fetch(
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


            const html = await response.text();


            /*
            Ganti seluruh hasil transaksi
            termasuk pagination.
            */

            results.innerHTML = html;


            /*
            Update URL tanpa reload halaman.
            */

            window.history.replaceState({},
                '',
                targetUrl.toString()
            );


        } catch (error) {

            if (
                error.name === 'AbortError'
            ) {
                return;
            }


            console.error(
                'Transaction live search error:',
                error
            );


            results.innerHTML = `
                <div class="transaction-empty">
                    Gagal memuat data transaksi.
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

    input.addEventListener(
        'input',
        function() {

            clearTimeout(timer);

            timer = setTimeout(
                function() {

                    loadTransactions();

                },
                450
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | ENTER
    |--------------------------------------------------------------------------
    |
    | Enter tetap didukung, tetapi tidak wajib.
    |
    */

    form.addEventListener(
        'submit',
        function(event) {

            event.preventDefault();

            clearTimeout(timer);

            loadTransactions();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | PAGINATION AJAX
    |--------------------------------------------------------------------------
    |
    | Pagination yang berada di dalam results
    | tetap bisa diklik tanpa reload.
    |
    */

    results.addEventListener(
        'click',
        function(event) {

            const link =
                event.target.closest(
                    'a'
                );


            if (!link) {
                return;
            }


            /*
            Hanya intercept link pagination.
            */

            if (
                link.closest(
                    '#transaction-pagination'
                )
            ) {

                event.preventDefault();

                loadTransactions(
                    link.href
                );

            }

        }
    );

});
</script>

@endsection