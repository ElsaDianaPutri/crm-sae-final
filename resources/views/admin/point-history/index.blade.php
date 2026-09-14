@extends('layouts.admin')

@section('title', 'Point History - SAE CAFE ROJEL CRM')

@section('content')

<style>
    .point-history-page {
        width: 100%;
        min-width: 0;
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    .point-history-filter {
        display: grid;

        grid-template-columns:
            minmax(0, 1fr) 180px 96px;

        gap: 12px;

        width: 100%;
    }

    .point-history-input,
    .point-history-select {
        width: 100%;
        height: 48px;

        border: 1px solid #E5E7EB;
        border-radius: 12px;

        background: #FFFFFF;

        padding: 0 15px;

        font-size: 14px;

        color: #111827;

        outline: none;
    }

    .point-history-input::placeholder {
        color: #9CA3AF;
    }

    .point-history-input:focus,
    .point-history-select:focus {
        border-color: #4A2E1F;

        box-shadow:
            0 0 0 3px rgba(74, 46, 31, 0.08);
    }

    .point-history-button {
        width: 100%;
        height: 48px;

        border: 0;
        border-radius: 12px;

        background: #4A2E1F;
        color: #FFFFFF;

        font-size: 14px;
        font-weight: 600;

        cursor: pointer;
    }

    /*
    |--------------------------------------------------------------------------
    | PANEL
    |--------------------------------------------------------------------------
    */

    .point-history-panel {
        width: 100%;
        min-width: 0;

        overflow: hidden;

        border: 1px solid #EADFD3;
        border-radius: 18px;

        background: #FFFFFF;

        box-shadow:
            0 2px 10px rgba(52, 34, 23, 0.04);
    }

    /*
    |--------------------------------------------------------------------------
    | DESKTOP HEADER
    |--------------------------------------------------------------------------
    */

    .point-history-header {
        display: grid;

        grid-template-columns:
            1.15fr 1fr 0.7fr 1.7fr 1fr;

        gap: 14px;

        align-items: center;

        padding: 15px 18px;

        background: #4A2E1F;
        color: #FFFFFF;

        font-size: 12px;
        font-weight: 700;
    }

    /*
    |--------------------------------------------------------------------------
    | ROW
    |--------------------------------------------------------------------------
    */

    .point-history-row {
        display: grid;

        grid-template-columns:
            1.15fr 1fr 0.7fr 1.7fr 1fr;

        gap: 14px;

        align-items: center;

        padding: 16px 18px;

        border-top: 1px solid #F0ECE8;

        background: #FFFFFF;
    }

    .point-history-field {
        min-width: 0;
    }

    .point-history-label {
        display: none;

        margin-bottom: 2px;

        color: #9CA3AF;

        font-size: 10px;

        font-weight: 600;

        text-transform: uppercase;
    }

    .point-history-value {
        min-width: 0;

        color: #374151;

        font-size: 13px;
        line-height: 18px;

        overflow-wrap: anywhere;
    }

    .point-history-customer {
        color: #111827;

        font-weight: 600;
    }

    .point-history-type {
        display: inline-flex;

        width: fit-content;

        padding: 5px 10px;

        border-radius: 999px;

        font-size: 10px;

        font-weight: 600;
    }

    .point-history-type.plus {
        background: #DCFCE7;
        color: #15803D;
    }

    .point-history-type.minus {
        background: #FEE2E2;
        color: #B91C1C;
    }

    .point-history-point.plus {
        color: #15803D;
        font-weight: 700;
    }

    .point-history-point.minus {
        color: #B91C1C;
        font-weight: 700;
    }

    .point-history-date {
        color: #6B7280;

        font-size: 12px;
    }

    .point-history-empty {
        padding: 48px 20px;

        text-align: center;

        color: #6B7280;

        font-size: 14px;
    }

    /*
    |--------------------------------------------------------------------------
    | MOBILE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 767px) {

        .point-history-filter {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .point-history-input,
        .point-history-select,
        .point-history-button {
            height: 46px;
        }

        .point-history-panel {
            border: 0;

            background: transparent;

            box-shadow: none;

            overflow: visible;
        }

        .point-history-header {
            display: none;
        }

        /*
        SAME ROW → MOBILE CARD
        */

        .point-history-row {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr) auto;

            gap: 0;

            margin-bottom: 10px;

            padding: 14px;

            border: 1px solid #E5E7EB;

            border-radius: 16px;

            background: #FFFFFF;

            box-shadow:
                0 2px 8px rgba(52, 34, 23, 0.04);
        }

        .point-history-field.customer {
            grid-column: 1;
            grid-row: 1;
        }

        .point-history-field.type {
            grid-column: 2;
            grid-row: 1;

            justify-self: end;
        }

        .point-history-field.point {
            grid-column: 1;
            grid-row: 2;

            margin-top: 12px;
        }

        .point-history-field.description {
            grid-column: 1 / -1;
            grid-row: 3;

            margin-top: 12px;
        }

        .point-history-field.date {
            grid-column: 2;
            grid-row: 2;

            margin-top: 12px;

            text-align: right;
        }

        .point-history-label {
            display: block;
        }

        .point-history-value {
            font-size: 13px;
        }

        .point-history-customer {
            font-size: 15px;
        }
    }
</style>


<div class="point-history-page space-y-6">

    {{-- ======================================================
        HEADER
    ======================================================= --}}
    <div>

        <h1 class="text-2xl font-semibold text-gray-900 md:text-3xl">
            Point History
        </h1>

        <p class="mt-1 text-sm text-[#75665C] md:text-base">
            Riwayat perubahan point seluruh customer.
        </p>

    </div>


    {{-- ======================================================
        SEARCH / FILTER
    ======================================================= --}}
    <div class="w-full rounded-2xl bg-white p-4 shadow-sm sm:p-5">

        <form id="pointHistorySearchForm" method="GET" action="{{ route('admin.point-history.index') }}"
            class="point-history-filter">

            <input type="text" id="pointHistorySearch" name="search" value="{{ request('search') }}"
                placeholder="Cari customer / member code / keterangan..." autocomplete="off"
                class="point-history-input">


            <select id="pointHistoryType" name="type" class="point-history-select">

                <option value="">
                    Semua Aktivitas
                </option>

                <option value="tambah" @selected(request('type')==='tambah' )>
                    Point Bertambah
                </option>

                <option value="kurang" @selected(request('type')==='kurang' )>
                    Point Berkurang
                </option>

            </select>


            <button type="submit" class="point-history-button">
                Cari
            </button>

        </form>

    </div>


    {{-- ======================================================
        LIST
    ======================================================= --}}
    <div class="point-history-panel">

        {{-- DESKTOP HEADER --}}
        <div class="point-history-header">

            <div>
                Customer
            </div>

            <div>
                Jenis
            </div>

            <div>
                Point
            </div>

            <div>
                Keterangan
            </div>

            <div>
                Tanggal
            </div>

        </div>
        <div id="pointHistoryList">

            @include(
            'admin.point-history.partials.list',
            ['pointHistories' => $pointHistories]
            )

        </div>




    </div>


    {{-- ======================================================
        PAGINATION
    ======================================================= --}}
    <div class="w-full overflow-x-auto">
        {{ $pointHistories->links() }}
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('pointHistorySearchForm');
        const searchInput = document.getElementById('pointHistorySearch');
        const typeSelect = document.getElementById('pointHistoryType');
        const resultContainer = document.getElementById('pointHistoryList');

        if (!form || !searchInput || !typeSelect || !resultContainer) {
            return;
        }

        let timer = null;


        async function loadPointHistory() {

            const search = searchInput.value.trim();
            const type = typeSelect.value;

            const params = new URLSearchParams();

            if (search !== '') {
                params.set('search', search);
            }

            if (type !== '') {
                params.set('type', type);
            }


            resultContainer.style.opacity = '0.5';

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


                const html = await response.text();

                resultContainer.innerHTML = html;

            } catch (error) {

                console.error(
                    'Point History live search error:',
                    error
                );

                resultContainer.innerHTML = `
                <div class="point-history-empty">
                    Gagal memuat data point.
                </div>
            `;

            } finally {

                resultContainer.style.opacity = '1';

            }

        }


        /*
        |--------------------------------------------------------------------------
        | LIVE SEARCH
        |--------------------------------------------------------------------------
        */

        searchInput.addEventListener('input', function() {

            clearTimeout(timer);

            timer = setTimeout(
                loadPointHistory,
                400
            );

        });


        /*
        |--------------------------------------------------------------------------
        | FILTER TYPE
        |--------------------------------------------------------------------------
        */

        typeSelect.addEventListener(
            'change',
            loadPointHistory
        );


        /*
        |--------------------------------------------------------------------------
        | BUTTON CARI
        |--------------------------------------------------------------------------
        |
        | Tetap berfungsi, tetapi tidak lagi wajib digunakan.
        |
        */

        form.addEventListener('submit', function(event) {

            event.preventDefault();

            clearTimeout(timer);

            loadPointHistory();

        });

    });
</script>

@endsection