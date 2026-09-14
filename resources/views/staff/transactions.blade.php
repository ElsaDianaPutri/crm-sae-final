@extends('layouts.staff')

@section('title', 'Transaction - Staff')

@section('content')

<style>
.staff-transaction-history-page {
    width: 100%;
    min-width: 0;
}

.staff-transaction-history-header {
    margin-bottom: 20px;
}

.staff-transaction-history-title {
    margin: 0;

    color: #171717;

    font-size: 26px;
    line-height: 34px;

    font-weight: 600;
}

.staff-transaction-history-subtitle {
    margin: 5px 0 0;

    color: #7F6D60;

    font-size: 13px;
    line-height: 19px;
}


/* =========================================================
       SEARCH
    ========================================================== */

.staff-transaction-search-card {
    margin-bottom: 18px;

    padding: 18px;

    background: #FFFFFF;

    border:
        1px solid #EADFD1;

    border-radius: 16px;

    box-shadow:
        0 8px 24px rgba(48, 31, 21, .04);
}

.staff-transaction-search-form {
    display: grid;

    grid-template-columns:
        minmax(0, 1fr) auto;

    gap: 10px;
}

.staff-transaction-search-input {
    width: 100%;

    min-height: 44px;

    padding: 12px 14px;

    border:
        1px solid #DDD2C8;

    border-radius: 11px;

    background: #FFFFFF;

    color: #171717;

    font-family: inherit;

    font-size: 13px;

    outline: none;
}

.staff-transaction-search-input:focus {
    border-color: #4A2E1F;

    box-shadow:
        0 0 0 3px rgba(74, 46, 31, .08);
}

.staff-transaction-search-button {
    min-height: 44px;

    padding: 12px 18px;

    border: 0;

    border-radius: 11px;

    background: #4A2E1F;

    color: #FFFFFF;

    font-family: inherit;

    font-size: 13px;

    font-weight: 600;

    cursor: pointer;
}


/* =========================================================
       FILTER
    ========================================================== */

.staff-transaction-filter {
    display: flex;

    align-items: center;

    gap: 8px;

    margin-top: 10px;
}

.staff-transaction-filter button {
    padding: 7px 11px;

    border:
        1px solid #E0D5CB;

    border-radius: 999px;

    background: #FFFFFF;

    color: #7F6D60;

    font-family: inherit;

    font-size: 11px;

    cursor: pointer;
}

.staff-transaction-filter button.active {
    background: #4A2E1F;

    border-color: #4A2E1F;

    color: #FFFFFF;
}


/* =========================================================
       TABLE
    ========================================================== */

.staff-transaction-table-card {
    width: 100%;

    overflow: hidden;

    background: #FFFFFF;

    border:
        1px solid #EADFD1;

    border-radius: 16px;

    box-shadow:
        0 8px 24px rgba(48, 31, 21, .04);
}

.staff-transaction-table-wrap {
    width: 100%;

    overflow-x: auto;
}

.staff-transaction-table {
    width: 100%;

    min-width: 760px;

    border-collapse: collapse;

    font-size: 12px;
}

.staff-transaction-table thead {
    background: #4A2E1F;

    color: #FFFFFF;
}

.staff-transaction-table th {
    padding: 13px 12px;

    text-align: center;

    font-size: 11px;

    font-weight: 600;

    white-space: nowrap;
}

.staff-transaction-table td {
    padding: 13px 12px;

    border-top:
        1px solid #F0ECE8;

    color: #4B443F;

    text-align: center;

    vertical-align: middle;

    white-space: nowrap;
}

.staff-transaction-table tbody tr:hover {
    background: #FFFCF8;
}

.staff-transaction-code {
    color: #171717;

    font-weight: 600;
}

.staff-transaction-point {
    color: #15803D;

    font-weight: 700;
}

.staff-transaction-empty {
    padding: 30px 20px !important;

    color: #9A8779 !important;

    text-align: center;
}


/* =========================================================
       MOBILE
    ========================================================== */

@media (max-width: 640px) {

    .staff-transaction-history-title {
        font-size: 23px;

        line-height: 30px;
    }

    .staff-transaction-search-form {
        grid-template-columns: 1fr;
    }

    .staff-transaction-search-button {
        width: 100%;
    }

    .staff-transaction-filter {
        flex-wrap: wrap;
    }

    .staff-transaction-table {
        min-width: 760px;
    }
}
</style>


<div class="staff-transaction-history-page">


    {{-- HEADER --}}
    <div class="staff-transaction-history-header">

        <h1 class="staff-transaction-history-title">
            Riwayat Transaksi
        </h1>

        <p class="staff-transaction-history-subtitle">
            Lihat seluruh transaksi yang tercatat dari operasional Staff.
        </p>

    </div>


    {{-- SEARCH --}}
    <div class="staff-transaction-search-card">

        <form id="staffTransactionSearchForm" method="GET" action="{{ route('staff.transactions') }}"
            class="staff-transaction-search-form">

            <input id="staffTransactionSearch" type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari kode transaksi, nama customer, member code, atau nomor HP..." autocomplete="off"
                class="staff-transaction-search-input">

            <button type="submit" class="staff-transaction-search-button">
                Cari
            </button>

        </form>


        <div id="staffTransactionFilter" class="staff-transaction-filter">

            <button type="button" data-source="" class="{{ request('source', '') === ''
                    ? 'active'
                    : ''
                }}">
                Semua
            </button>

            <button type="button" data-source="manual" class="{{ request('source') === 'manual'
                    ? 'active'
                    : ''
                }}">
                Manual
            </button>

            <button type="button" data-source="moka" class="{{ request('source') === 'moka'
                    ? 'active'
                    : ''
                }}">
                Moka
            </button>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="staff-transaction-table-card">

        <div class="staff-transaction-table-wrap">

            <table class="staff-transaction-table">

                <thead>

                    <tr>

                        <th>
                            Kode
                        </th>

                        <th>
                            Customer
                        </th>

                        <th>
                            Total
                        </th>

                        <th>
                            Point
                        </th>

                        <th>
                            Source
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Waktu
                        </th>

                    </tr>

                </thead>


                <tbody id="staffTransactionList">

                    @include(
                    'staff.partials.transaction-list',
                    ['transactions' => $transactions]
                    )

                </tbody>

            </table>

        </div>

    </div>


    <div style="margin-top:16px">
        {{ $transactions->links() }}
    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function() {

    const input =
        document.getElementById('staffTransactionSearch');

    const form =
        document.getElementById('staffTransactionSearchForm');

    const list =
        document.getElementById('staffTransactionList');

    const filter =
        document.getElementById('staffTransactionFilter');


    if (!input || !form || !list || !filter) {
        return;
    }


    let timer = null;

    let currentSource = '';


    async function loadTransactions() {

        const params =
            new URLSearchParams();


        const search =
            input.value.trim();


        if (search !== '') {
            params.set('search', search);
        }


        if (currentSource !== '') {
            params.set('source', currentSource);
        }


        list.style.opacity = '0.5';


        try {

            const response = await fetch(
                `${form.action}?${params.toString()}`, {
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


            list.innerHTML =
                html;


        } catch (error) {

            console.error(
                'Transaction live search error:',
                error
            );


            list.innerHTML = `
                <tr>
                    <td
                        colspan="7"
                        class="staff-transaction-empty"
                    >
                        Gagal memuat transaksi.
                    </td>
                </tr>
            `;

        } finally {

            list.style.opacity = '1';

        }

    }


    input.addEventListener(
        'input',
        function() {

            clearTimeout(timer);

            timer = setTimeout(
                loadTransactions,
                400
            );

        }
    );


    form.addEventListener(
        'submit',
        function(event) {

            event.preventDefault();

            clearTimeout(timer);

            loadTransactions();

        }
    );


    filter
        .querySelectorAll('button')
        .forEach(button => {

            button.addEventListener(
                'click',
                function() {

                    currentSource =
                        this.dataset.source || '';


                    filter
                        .querySelectorAll('button')
                        .forEach(item => {

                            item.classList.remove(
                                'active'
                            );

                        });


                    this.classList.add(
                        'active'
                    );


                    loadTransactions();

                }
            );

        });

});
</script>

@endsection