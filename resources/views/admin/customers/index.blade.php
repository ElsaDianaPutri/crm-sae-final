@extends('layouts.admin')

@section('title', 'Customer Management')

@section('content')

<style>
/*
    |--------------------------------------------------------------------------
    | Customer Management - Unified Responsive Layout
    |--------------------------------------------------------------------------
    */

.customer-page {
    width: 100%;
    min-width: 0;
}

/*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

.customer-search-form {
    width: 100%;
}

.customer-search-input {
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

.customer-search-input::placeholder {
    color: #9ca3af;
}

.customer-search-input:focus {
    border-color: #4a2e1f;
    box-shadow: 0 0 0 3px rgba(74, 46, 31, 0.08);
}

/*
    |--------------------------------------------------------------------------
    | Customer List
    |--------------------------------------------------------------------------
    */

.customer-list-wrapper {
    width: 100%;
    min-width: 0;
    overflow: hidden;
    border: 1px solid #e5ddd5;
    border-radius: 18px;
    background: #ffffff;
    box-shadow: 0 2px 10px rgba(52, 34, 23, 0.05);
}

/*
    |--------------------------------------------------------------------------
    | Desktop Header
    |--------------------------------------------------------------------------
    */

.customer-list-header {
    display: grid;
    grid-template-columns:
        1fr 1.25fr 1.35fr 0.8fr 0.8fr;

    align-items: center;
    gap: 16px;

    min-width: 0;

    padding: 16px 20px;

    background: #4A2E1F;
    color: #ffffff;
    font-size: 13px;
    line-height: 18px;
    font-weight: 700;
}

/*
    |--------------------------------------------------------------------------
    | Customer Row
    |--------------------------------------------------------------------------
    */

.customer-row {
    display: grid;

    grid-template-columns:
        1fr 1.25fr 1.35fr 0.8fr 0.8fr;

    align-items: center;

    gap: 16px;

    min-width: 0;

    padding: 16px 20px;

    border-top: 1px solid #f0ece8;

    background: #ffffff;

    transition: background 0.2s ease;
}

.customer-row:hover {
    background: #fcfaf8;
}

/*
    |--------------------------------------------------------------------------
    | Customer Data
    |--------------------------------------------------------------------------
    */

.customer-field {
    min-width: 0;
}

.customer-label {
    display: none;
}

.customer-value {
    min-width: 0;
    color: #374151;
    font-size: 14px;
    line-height: 20px;
    overflow-wrap: anywhere;
}

.customer-name {
    color: #111827;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.2s ease;
}

.customer-name:hover {
    color: #4a2e1f;
}

/*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    */

.customer-status {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    width: fit-content;

    border-radius: 999px;

    padding: 5px 10px;

    font-size: 11px;
    line-height: 14px;
    font-weight: 600;
    white-space: nowrap;
}

.customer-status.active {
    background: #dcfce7;
    color: #15803d;
}

.customer-status.inactive {
    background: #fee2e2;
    color: #b91c1c;
}

/*
    |--------------------------------------------------------------------------
    | Empty State
    |--------------------------------------------------------------------------
    */

.customer-empty {
    padding: 48px 20px;
    text-align: center;
    color: #6b7280;
    font-size: 14px;
}

/*
    |--------------------------------------------------------------------------
    | Tablet
    |--------------------------------------------------------------------------
    */

@media (max-width: 1024px) {

    .customer-list-header {
        grid-template-columns:
            0.9fr 1.1fr 1.2fr 0.7fr 0.75fr;

        gap: 12px;

        padding: 14px 16px;
    }

    .customer-row {
        grid-template-columns:
            0.9fr 1.1fr 1.2fr 0.7fr 0.75fr;

        gap: 12px;

        padding: 14px 16px;
    }

    .customer-value {
        font-size: 13px;
    }
}

/*
    |--------------------------------------------------------------------------
    | Mobile
    |--------------------------------------------------------------------------
    */

@media (max-width: 767px) {

    .customer-list-wrapper {
        border: 0;
        background: transparent;
        box-shadow: none;

        overflow: visible;
    }

    /*
        Hide desktop header.
        The customer rows themselves become cards.
        */
    .customer-list-header {
        display: none;
    }

    /*
        One same customer markup,
        re-arranged with CSS.
        */
    .customer-row {
        display: grid;

        grid-template-columns:
            minmax(0, 1fr) auto;

        gap: 0;

        width: 100%;

        padding: 14px;

        margin-bottom: 10px;

        border: 1px solid #e5e7eb;
        border-radius: 16px;

        background: #ffffff;

        box-shadow: 0 2px 8px rgba(52, 34, 23, 0.04);
    }

    .customer-row:last-child {
        margin-bottom: 0;
    }

    /*
        Member Code
        */
    .customer-field.member-code {
        grid-column: 1;
        grid-row: 1;
    }

    /*
        Status
        */
    .customer-field.status {
        grid-column: 2;
        grid-row: 1;

        align-self: start;
        justify-self: end;
    }

    /*
        Name
        */
    .customer-field.name {
        grid-column: 1 / -1;
        grid-row: 2;

        margin-top: 14px;
    }

    /*
        Phone
        */
    .customer-field.phone {
        grid-column: 1;
        grid-row: 3;

        margin-top: 12px;
    }

    /*
        Point
        */
    .customer-field.point {
        grid-column: 2;
        grid-row: 3;

        margin-top: 12px;

        text-align: right;
    }

    /*
        Action
        */
    .customer-field.action {
        grid-column: 1 / -1;
        grid-row: 4;

        margin-top: 14px;
    }

    .customer-label {
        display: block;

        margin-bottom: 2px;

        color: #9ca3af;

        font-size: 10px;
        line-height: 14px;
        font-weight: 600;

        letter-spacing: 0.05em;

        text-transform: uppercase;
    }

    .customer-value {
        font-size: 13px;
        line-height: 18px;
    }

    .customer-name {
        font-size: 15px;
        line-height: 20px;
    }

    .customer-status {
        padding: 4px 9px;
        font-size: 10px;
        line-height: 13px;
    }

    .customer-detail-btn:hover {
        background: #3a2117;
    }

    .customer-detail-btn:active {
        transform: scale(0.99);
    }

    /*
        Empty state
        */
    .customer-empty {
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(52, 34, 23, 0.04);
    }
}

/*
    |--------------------------------------------------------------------------
    | Very Small Phones
    |--------------------------------------------------------------------------
    */

@media (max-width: 380px) {

    .customer-row {
        padding: 12px;
    }

    .customer-value {
        font-size: 12px;
    }

    .customer-name {
        font-size: 14px;
    }

    .customer-detail-btn {
        min-height: 40px;
        font-size: 12px;
    }
}
</style>


<div class="customer-page space-y-6">

    {{-- ======================================================
        PAGE HEADER
    ======================================================= --}}
    <div class="min-w-0">

        <h1 class="text-2xl font-semibold text-gray-900 sm:text-3xl">
            Customer Management
        </h1>

        <p class="mt-1 text-sm text-gray-500 sm:text-base">
            Kelola data member Saé Cafe
        </p>

    </div>


    {{-- ======================================================
        SEARCH
    ======================================================= --}}
    <div class="w-full rounded-2xl bg-white p-4 shadow-sm sm:p-5">

        <form id="customer-search-form" method="GET" action="{{ route('admin.customers.index') }}"
            class="customer-search-form">

            <label for="customer-search" class="sr-only">
                Cari customer
            </label>

            <input id="customer-search" type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari nama, nomor HP, atau member code..." class="customer-search-input" autocomplete="off">
        </form>

    </div>


    {{-- ======================================================
        CUSTOMER LIST
        SATU MARKUP UNTUK DESKTOP / TABLET / MOBILE
    ======================================================= --}}
    <div class="customer-list-wrapper">

        {{-- DESKTOP HEADER --}}
        <div class="customer-list-header">

            <div>
                Member Code
            </div>

            <div>
                Nama
            </div>

            <div>
                Nomor HP
            </div>

            <div>
                Point
            </div>

            <div>
                Status
            </div>

        </div>


        {{-- CUSTOMER ROWS --}}
        <div id="customer-list">
            @include('admin.customers.partials.list')
        </div>

        {{-- ======================================================
        PAGINATION
    ======================================================= --}}
        <div id="customer-pagination" class="w-full overflow-x-auto">
            {{ $customers->links() }}
        </div>

    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('customer-search-form');
        const input = document.getElementById('customer-search');
        const list = document.getElementById('customer-list');
        const pagination = document.getElementById('customer-pagination');

        if (!form || !input || !list || !pagination) {
            return;
        }

        let timer = null;
        let controller = null;

        function loadCustomers() {

            const url = new URL(form.action, window.location.origin);

            const search = input.value.trim();

            if (search !== '') {
                url.searchParams.set('search', search);
            }

            /*
            Batalkan request sebelumnya kalau user
            masih terus mengetik.
            */
            if (controller) {
                controller.abort();
            }

            controller = new AbortController();

            /*
            Sedikit tanda proses agar user tahu sistem sedang mencari.
            */
            list.style.opacity = '0.55';

            fetch(url.toString(), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    signal: controller.signal,
                })
                .then(response => {

                    if (!response.ok) {
                        throw new Error(
                            'Gagal mengambil data customer.'
                        );
                    }

                    return response.json();
                })
                .then(data => {

                    list.innerHTML = data.html;

                    pagination.innerHTML = data.pagination;

                })
                .catch(error => {

                    /*
                    AbortError tidak perlu ditampilkan karena
                    request memang sengaja dibatalkan saat user mengetik lagi.
                    */
                    if (error.name !== 'AbortError') {

                        console.error(error);

                        list.innerHTML = `
                    <div class="customer-empty">
                        Gagal memuat data customer.
                    </div>
                `;
                    }

                })
                .finally(() => {

                    list.style.opacity = '1';

                });
        }


        /*
        LIVE SEARCH
        Tunggu 450ms setelah user berhenti mengetik.
        */
        input.addEventListener('input', function() {

            clearTimeout(timer);

            timer = setTimeout(function() {
                loadCustomers();
            }, 450);

        });


        /*
        Enter tetap boleh digunakan,
        tetapi tidak wajib.
        */
        form.addEventListener('submit', function(event) {

            event.preventDefault();

            clearTimeout(timer);

            loadCustomers();

        });

    });
    </script>

    @endsection