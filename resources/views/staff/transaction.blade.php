@extends('layouts.staff')

@section('title', 'Input Transaksi - Staff')

@section('content')

<style>
/* =========================================================
       PAGE
    ========================================================== */

.staff-transaction-page {
    width: 100%;
    max-width: 820px;
    margin: 0 auto;
}


/* =========================================================
       PAGE HEADER
    ========================================================== */

.staff-transaction-header {
    margin-bottom: 20px;
}

.staff-transaction-eyebrow {
    color: #8D745E;

    font-size: 11px;
    line-height: 16px;

    font-weight: 700;

    letter-spacing: .08em;

    text-transform: uppercase;
}

.staff-transaction-title {
    margin: 4px 0 0;

    color: #171717;

    font-size: 26px;
    line-height: 34px;

    font-weight: 600;
}

.staff-transaction-subtitle {
    margin: 6px 0 0;

    color: #7F6D60;

    font-size: 13px;
    line-height: 19px;
}


/* =========================================================
       MEMBER CARD
    ========================================================== */

.staff-transaction-card {
    background: #FFFFFF;

    border:
        1px solid #EADFD1;

    border-radius: 16px;

    box-shadow:
        0 8px 24px rgba(48, 31, 21, .04);

    overflow: hidden;
}


/* =========================================================
       SELECTED MEMBER
    ========================================================== */

.staff-selected-member {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 16px;

    padding: 20px;

    background: #FFF9F2;

    border-bottom:
        1px solid #EADFD1;
}

.staff-selected-member-info {
    min-width: 0;
}

.staff-selected-member-label {
    margin-bottom: 5px;

    color: #8D745E;

    font-size: 10px;

    font-weight: 700;

    letter-spacing: .06em;

    text-transform: uppercase;
}

.staff-selected-member-name {
    color: #171717;

    font-size: 20px;

    line-height: 27px;

    font-weight: 600;
}

.staff-selected-member-meta {
    margin-top: 3px;

    color: #8A7667;

    font-size: 12px;

    line-height: 18px;
}


/* =========================================================
       POINT SUMMARY
    ========================================================== */

.staff-transaction-summary {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 12px;

    padding: 18px 20px;
}

.staff-transaction-summary-card {
    padding: 14px;

    background: #F7F3ED;

    border:
        1px solid #EADFD1;

    border-radius: 12px;
}

.staff-transaction-summary-label {
    color: #8B7768;

    font-size: 11px;

    line-height: 16px;
}

.staff-transaction-summary-value {
    margin-top: 5px;

    color: #171717;

    font-size: 23px;

    line-height: 30px;

    font-weight: 700;
}

.staff-transaction-summary-value.small {
    font-size: 16px;

    line-height: 24px;
}


/* =========================================================
       FORM AREA
    ========================================================== */

.staff-transaction-form {
    padding: 0 20px 20px;
}

.staff-transaction-label {
    display: block;

    margin-bottom: 7px;

    color: #4B443F;

    font-size: 12px;

    font-weight: 600;
}


/* =========================================================
       MONEY INPUT
    ========================================================== */

.staff-transaction-money {
    display: flex;
    align-items: center;

    width: 100%;

    border:
        1px solid #DDD2C8;

    border-radius: 12px;

    background: #FFFFFF;

    overflow: hidden;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}

.staff-transaction-money:focus-within {
    border-color: #4A2E1F;

    box-shadow:
        0 0 0 3px rgba(74, 46, 31, .08);
}

.staff-transaction-money-prefix {
    display: flex;
    align-items: center;

    align-self: stretch;

    padding: 0 14px;

    background: #F7F3ED;

    border-right:
        1px solid #EADFD1;

    color: #7F6D60;

    font-size: 14px;

    font-weight: 600;
}

.staff-transaction-money-input {
    width: 100%;

    min-width: 0;

    border: 0;

    outline: 0;

    padding: 14px;

    background: transparent;

    color: #171717;

    font-family: inherit;

    font-size: 20px;

    line-height: 26px;

    font-weight: 600;
}

.staff-transaction-money-input::placeholder {
    color: #B1A399;
}


/* =========================================================
       POINT PREVIEW
    ========================================================== */

.staff-transaction-preview {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 12px;

    margin-top: 12px;

    padding: 13px 14px;

    background: #F0FDF4;

    border:
        1px solid #D1FAE5;

    border-radius: 12px;
}

.staff-transaction-preview-label {
    color: #4B6B58;

    font-size: 11px;

    line-height: 16px;
}

.staff-transaction-preview-value {
    color: #15803D;

    font-size: 15px;

    font-weight: 700;

    white-space: nowrap;
}


/* =========================================================
       HELPER
    ========================================================== */

.staff-transaction-helper {
    margin-top: 8px;

    color: #968476;

    font-size: 11px;

    line-height: 16px;
}


/* =========================================================
       SUBMIT
    ========================================================== */

.staff-transaction-submit {
    width: 100%;

    min-height: 46px;

    margin-top: 18px;

    border: 0;

    border-radius: 12px;

    background: #4A2E1F;

    color: #FFFFFF;

    font-family: inherit;

    font-size: 13px;

    font-weight: 600;

    cursor: pointer;

    transition:
        background-color .2s ease,
        transform .2s ease;
}

.staff-transaction-submit:hover {
    background: #5B3927;
}

.staff-transaction-submit:active {
    transform: translateY(1px);
}

.staff-transaction-submit:disabled {
    opacity: .55;

    cursor: not-allowed;
}


/* =========================================================
       RESPONSIVE
    ========================================================== */

@media (max-width: 640px) {

    .staff-transaction-page {
        max-width: none;
    }

    .staff-transaction-title {
        font-size: 23px;

        line-height: 30px;
    }

    .staff-selected-member {
        align-items: flex-start;

        flex-direction: column;

        padding: 16px;
    }

    .staff-selected-member-name {
        font-size: 18px;

        line-height: 25px;
    }

    .staff-transaction-summary {
        grid-template-columns: 1fr;

        padding: 15px 16px;
    }

    .staff-transaction-form {
        padding: 0 16px 16px;
    }

    .staff-transaction-money-input {
        font-size: 18px;
    }

}
</style>


<div class="staff-transaction-page">


    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="staff-transaction-header">

        <div class="staff-transaction-eyebrow">
            TRANSAKSI MEMBER
        </div>

        <h1 class="staff-transaction-title">
            Input Transaksi
        </h1>

        <p class="staff-transaction-subtitle">
            Masukkan total belanja member untuk menambahkan point.
        </p>

    </div>


    {{-- =====================================================
        MAIN CARD
    ====================================================== --}}

    <div class="staff-transaction-card">


        {{-- =================================================
            MEMBER
        ================================================== --}}

        <div class="staff-selected-member">

            <div class="staff-selected-member-info">

                <div class="staff-selected-member-label">
                    Member Dipilih
                </div>

                <div class="staff-selected-member-name">
                    {{ $customer->nama }}
                </div>

                <div class="staff-selected-member-meta">
                    {{ $customer->member_code }}
                    •
                    {{ $customer->nomor_hp }}
                </div>

            </div>

        </div>


        {{-- =================================================
            SUMMARY
        ================================================== --}}

        <div class="staff-transaction-summary">


            {{-- POINT SAAT INI --}}
            <div class="staff-transaction-summary-card">

                <div class="staff-transaction-summary-label">
                    Point Saat Ini
                </div>

                <div class="staff-transaction-summary-value">
                    {{ number_format($customer->saldo_point) }}
                </div>

            </div>


            {{-- KONVERSI --}}
            <div class="staff-transaction-summary-card">

                <div class="staff-transaction-summary-label">
                    Konversi Point
                </div>

                <div class="
                    staff-transaction-summary-value
                    small
                ">
                    Rp10.000 = 1 Point
                </div>

            </div>

        </div>


        {{-- =================================================
            FORM TRANSAKSI
        ================================================== --}}

        <form method="POST" action="{{ route('staff.transactions.store') }}" class="staff-transaction-form"
            id="staffTransactionForm">

            @csrf


            {{-- CUSTOMER --}}
            <input type="hidden" name="id_customer" value="{{ $customer->id_customer }}">


            {{-- TOTAL BELANJA --}}
            <label for="totalBelanja" class="staff-transaction-label">
                Total Belanja
            </label>


            <div class="staff-transaction-money">

                <span class="staff-transaction-money-prefix">
                    Rp
                </span>

                <input id="totalBelanja" type="text" name="total_belanja" inputmode="numeric" autocomplete="off"
                    value="{{ old('total_belanja') }}" placeholder="0" class="staff-transaction-money-input" required>

            </div>


            {{-- POINT PREVIEW --}}
            <div class="staff-transaction-preview">

                <span class="staff-transaction-preview-label">
                    Point yang akan didapat
                </span>

                <span id="pointPreview" class="staff-transaction-preview-value">
                    +0 Point
                </span>

            </div>


            <div class="staff-transaction-helper">
                Setiap Rp10.000 belanja mendapatkan 1 point.
            </div>


            {{-- SUBMIT --}}
            <button type="submit" id="submitTransaction" class="staff-transaction-submit" disabled>
                Simpan Transaksi & Tambahkan Point
            </button>

        </form>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function() {

    const input =
        document.getElementById('totalBelanja');

    const preview =
        document.getElementById('pointPreview');

    const submitButton =
        document.getElementById('submitTransaction');


    if (!input || !preview || !submitButton) {
        return;
    }


    function getNumericValue(value) {

        return parseInt(
            String(value).replace(/\D/g, ''),
            10
        ) || 0;
    }


    function formatNumber(number) {

        return new Intl.NumberFormat('id-ID')
            .format(number);
    }


    function updateTransactionPreview() {

        const total =
            getNumericValue(input.value);


        /*
        |--------------------------------------------------------------------------
        | POINT PREVIEW
        |--------------------------------------------------------------------------
        |
        | Rp10.000 = 1 Point
        |
        */

        const point =
            Math.floor(total / 10000);


        preview.textContent =
            `+${formatNumber(point)} Point`;


        submitButton.disabled =
            total < 1;
    }


    input.addEventListener(
        'input',
        function() {

            const numericValue =
                getNumericValue(input.value);


            input.value =
                numericValue > 0 ?
                formatNumber(numericValue) :
                '';


            updateTransactionPreview();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | BEFORE SUBMIT
    |--------------------------------------------------------------------------
    |
    | Controller menerima integer biasa,
    | bukan string "70.000".
    |
    */

    const form =
        document.getElementById('staffTransactionForm');


    form?.addEventListener(
        'submit',
        function() {

            const numericValue =
                getNumericValue(input.value);


            input.value =
                numericValue.toString();

        }
    );


    updateTransactionPreview();

});
</script>

@endsection