@extends('layouts.staff')

@section('title', 'Member - Staff')

@section('content')

<style>
/* =========================================================
       PAGE
    ========================================================== */

.staff-member-page {
    width: 100%;
    min-width: 0;
}


/* =========================================================
       HEADER
    ========================================================== */

.staff-member-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;

    gap: 16px;

    margin-bottom: 20px;
}

.staff-member-title {
    margin: 0;

    color: #171717;

    font-size: 26px;
    line-height: 34px;

    font-weight: 600;
}

.staff-member-subtitle {
    margin: 5px 0 0;

    color: #7F6D60;

    font-size: 13px;
    line-height: 19px;
}


/* =========================================================
       ADD MEMBER BUTTON
    ========================================================== */

.staff-member-add-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-height: 42px;

    padding: 10px 15px;

    border-radius: 11px;

    background: #4A2E1F;

    color: #FFFFFF;

    font-family: inherit;

    font-size: 12px;
    font-weight: 600;

    text-decoration: none;

    white-space: nowrap;

    transition:
        background-color .2s ease,
        transform .2s ease;
}

.staff-member-add-button:hover {
    background: #5B3927;
}

.staff-member-add-button:active {
    transform: translateY(1px);
}


/* =========================================================
       SCAN BUTTON
    ========================================================== */

.staff-member-scan-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    min-height: 42px;

    padding: 10px 15px;

    border:
        1px solid #D9C9BB;

    border-radius: 11px;

    background: #FFFFFF;

    color: #4A2E1F;

    font-family: inherit;

    font-size: 12px;
    font-weight: 600;

    cursor: pointer;

    white-space: nowrap;

    transition:
        background-color .2s ease,
        border-color .2s ease;
}

.staff-member-scan-button:hover {
    background: #FFF9F2;

    border-color: #C9B3A1;
}


/* =========================================================
       SCANNER PANEL
    ========================================================== */

.staff-member-scan-panel {
    display: none;

    margin-bottom: 18px;

    padding: 18px;

    background: #FFFFFF;

    border:
        1px solid #EADFD1;

    border-radius: 16px;

    box-shadow:
        0 8px 24px rgba(48, 31, 21, .04);
}

.staff-member-scan-panel.open {
    display: block;
}

.staff-member-scan-header {
    display: flex;

    align-items: center;
    justify-content: space-between;

    gap: 12px;

    margin-bottom: 14px;
}

.staff-member-scan-title {
    margin: 0;

    color: #171717;

    font-size: 14px;

    font-weight: 600;
}

.staff-member-scan-header-actions {
    display: flex;

    align-items: center;

    gap: 8px;
}

.staff-member-scan-close {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    width: 36px;
    height: 36px;

    border: 0;

    border-radius: 9px;

    background: #F5F0EA;

    color: #7F6D60;

    font-size: 20px;

    line-height: 1;

    cursor: pointer;
}

.staff-member-scan-close:hover {
    background: #EDE4DB;
}


/* =========================================================
       SWITCH CAMERA
    ========================================================== */

.staff-member-camera-switch {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 7px;

    min-height: 36px;

    padding: 8px 12px;

    border:
        1px solid #D9C9BB;

    border-radius: 9px;

    background: #FFFFFF;

    color: #4A2E1F;

    font-family: inherit;

    font-size: 11px;

    font-weight: 600;

    cursor: pointer;

    white-space: nowrap;

    transition:
        background-color .2s ease,
        border-color .2s ease;
}

.staff-member-camera-switch:hover {
    background: #FFF9F2;

    border-color: #C9B3A1;
}

.staff-member-camera-switch:disabled {
    opacity: .45;

    cursor: not-allowed;
}


/* =========================================================
       CAMERA VIEW
    ========================================================== */

.staff-member-reader {
    width: 100%;

    max-width: 520px;

    margin: 0 auto;

    overflow: hidden;

    border-radius: 14px;

    background: #111;
}

#staffQrReader {
    width: 100%;
}

#staffQrReader video {
    width: 100% !important;

    height: auto !important;

    display: block;

    object-fit: cover;

    border-radius: 14px;
}


/* =========================================================
       SCAN MESSAGE
    ========================================================== */

.staff-member-scan-message {
    margin-top: 11px;

    color: #8D7B6D;

    font-size: 11px;

    line-height: 16px;

    text-align: center;
}


/* =========================================================
       SCAN RESULT
    ========================================================== */

.staff-scanned-member-card {
    display: none !important;
    visibility: visible;

    width: 100%;
    max-width: 520px;

    margin: 18px auto;

    padding: 16px;

    border: 1px solid #D1FAE5;

    border-radius: 14px;

    background: #F0FDF4;

    box-shadow:
        0 6px 18px rgba(48, 31, 21, .05);
}

.staff-scanned-member-label {
    margin-bottom: 4px;

    color: #4B6B58;

    font-size: 10px;

    font-weight: 700;

    letter-spacing: .06em;

    text-transform: uppercase;
}

.staff-scanned-member-name {
    color: #171717;

    font-size: 16px;

    line-height: 22px;

    font-weight: 600;
}

.staff-scanned-member-meta {
    margin-top: 4px;

    color: #6B5D53;

    font-size: 11px;

    line-height: 17px;
}

.staff-member-scan-actions {
    display: flex;

    gap: 8px;

    margin-top: 13px;
}

.staff-member-scan-action {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-height: 38px;

    padding: 8px 14px;

    border-radius: 9px;

    font-family: inherit;

    font-size: 11px;

    font-weight: 600;

    text-decoration: none;
}

.staff-member-scan-action.primary {
    background: #4A2E1F;

    color: #FFFFFF;
}

.staff-member-scan-action.secondary {
    background: #FFFFFF;

    color: #4A2E1F;

    border: 1px solid #D9C9BB;
}

@media (max-width: 640px) {

    .staff-scanned-member-card {
        margin: 14px 0;
    }

    .staff-member-scan-actions {
        flex-direction: column;
    }

    .staff-member-scan-action {
        width: 100%;
    }
}


.staff-member-scan-action.primary:hover {
    background: #5B3927;
}

.staff-member-scan-action.secondary:hover {
    background: #FFF9F2;

    border-color: #C9B3A1;
}


/* =========================================================
       SEARCH
    ========================================================== */

.staff-member-search-card {
    margin-bottom: 18px;

    padding: 18px;

    background: #FFFFFF;

    border:
        1px solid #EADFD1;

    border-radius: 16px;

    box-shadow:
        0 8px 24px rgba(48, 31, 21, .04);
}

.staff-member-search-form {
    display: grid;

    grid-template-columns:
        minmax(0, 1fr) auto;

    gap: 10px;
}

.staff-member-search-input {
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

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}

.staff-member-search-input:focus {
    border-color: #4A2E1F;

    box-shadow:
        0 0 0 3px rgba(74, 46, 31, .08);
}

.staff-member-search-input::placeholder {
    color: #A49487;
}

.staff-member-search-button {
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

    transition:
        background-color .2s ease;
}

.staff-member-search-button:hover {
    background: #5B3927;
}

.staff-member-search-help {
    margin: 9px 0 0;

    color: #968476;

    font-size: 11px;

    line-height: 16px;
}


/* =========================================================
       TABLE
    ========================================================== */

.staff-member-table-card {
    width: 100%;

    overflow: hidden;

    background: #FFFFFF;

    border:
        1px solid #EADFD1;

    border-radius: 16px;

    box-shadow:
        0 8px 24px rgba(48, 31, 21, .04);
}

.staff-member-table-wrap {
    width: 100%;

    overflow-x: auto;
}

.staff-member-table {
    width: 100%;

    min-width: 0;

    border-collapse: collapse;

    font-size: 12px;

    table-layout: auto;
}

.staff-member-table thead {
    background: #4A2E1F;

    color: #FFFFFF;
}

.staff-member-table th {
    padding: 13px 12px;

    text-align: center;

    font-size: 11px;

    font-weight: 600;

    white-space: nowrap;
}

.staff-member-table td {
    padding: 13px 12px;

    border-top:
        1px solid #F0ECE8;

    color: #4B443F;

    white-space: nowrap;

    text-align: center;

    vertical-align: middle;
}

.staff-member-table tbody tr:hover {
    background: #FFFCF8;
}


/* =========================================================
       MEMBER
    ========================================================== */

.staff-member-name {
    color: #171717;

    font-size: 12px;

    font-weight: 600;
}

.staff-member-code {
    margin-top: 2px;

    color: #9A8779;

    font-size: 10px;
}


/* =========================================================
       POINT
    ========================================================== */

.staff-member-point {
    color: #171717;

    font-weight: 600;
}


/* =========================================================
       STATUS
    ========================================================== */

.staff-member-status {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-height: 26px;

    padding: 4px 9px;

    border-radius: 999px;

    font-size: 10px;

    font-weight: 600;

    text-transform: capitalize;
}

.staff-member-status.active {
    background: #DCFCE7;

    color: #15803D;
}

.staff-member-status.inactive {
    background: #FEE2E2;

    color: #B91C1C;
}


/* =========================================================
       TRANSACTION BUTTON
    ========================================================== */

.staff-member-transaction-button {
    min-height: 32px;

    padding: 6px 10px;

    border:
        1px solid #D9C9BB;

    border-radius: 9px;

    background: #FFFFFF;

    color: #4A2E1F;

    font-family: inherit;

    font-size: 11px;

    font-weight: 600;

    cursor: pointer;

    transition:
        background-color .2s ease,
        border-color .2s ease;
}

.staff-member-transaction-button:hover {
    background: #FFF9F2;

    border-color: #C9B3A1;
}


/* =========================================================
       EMPTY
    ========================================================== */

.staff-member-empty {
    padding: 30px 20px !important;

    text-align: center;

    color: #9A8779 !important;
}


/* =========================================================
       PAGINATION
    ========================================================== */

.staff-member-pagination {
    margin-top: 16px;
}


/* =========================================================
       RESPONSIVE
    ========================================================== */

@media (max-width: 800px) {

    .staff-member-header {
        align-items: stretch;

        flex-direction: column;
    }

    .staff-member-header-actions {
        width: 100%;
    }

    .staff-member-scan-button,
    .staff-member-add-button {
        flex: 1;
    }

}


@media (max-width: 640px) {

    .staff-member-title {
        font-size: 23px;

        line-height: 30px;
    }

    .staff-member-header-actions {
        display: grid !important;

        grid-template-columns: 1fr 1fr;

        gap: 8px;
    }

    .staff-member-scan-button,
    .staff-member-add-button {
        width: 100%;
    }

    .staff-member-scan-panel {
        padding: 14px;
    }

    .staff-member-scan-header {
        align-items: flex-start;
    }

    .staff-member-scan-header-actions {
        flex-shrink: 0;
    }

    .staff-member-camera-switch {
        font-size: 10px;

        padding: 8px 10px;
    }

    .staff-member-scan-actions {
        flex-direction: column;
    }

    .staff-member-scan-action {
        width: 100%;
    }

    .staff-member-search-form {
        grid-template-columns: 1fr;
    }

    .staff-member-search-button {
        width: 100%;
    }

    .staff-member-search-card {
        padding: 15px;
    }

    .staff-member-table-card {
        border-radius: 14px;
    }

    .staff-member-table {
        min-width: 650px;
    }

}

/* =========================================================
   SCAN RESULT PANEL
========================================================== */
.staff-scanned-member-card {
    display: none !important;
    width: 100%;
    max-width: 520px;
    margin: 18px auto;
    padding: 18px;
    border: 1px solid #D1FAE5;
    border-radius: 14px;
    background: #F0FDF4;
    box-shadow: 0 6px 18px rgba(48, 31, 21, .05);
}

.staff-scanned-member-label {
    margin-bottom: 5px;
    color: #4B6B58;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.staff-scanned-member-name {
    color: #171717;
    font-size: 20px;
    line-height: 28px;
    font-weight: 700;
}

.staff-scanned-member-meta {
    margin-top: 4px;
    color: #6B5D53;
    font-size: 12px;
    line-height: 18px;
}

.staff-scanned-member-help {
    margin: 15px 0 12px;
    color: #7F6D60;
    font-size: 11px;
    line-height: 17px;
}

.staff-scanned-member-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.staff-scanned-member-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 42px;
    padding: 10px 14px;
    border-radius: 10px;
    font-family: inherit;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
}

.staff-scanned-member-action.primary {
    border: 0;
    background: #4A2E1F;
    color: #fff;
}

.staff-scanned-member-action.primary:hover {
    background: #5B3927;
}

.staff-scanned-member-action.secondary {
    border: 1px solid #D9C9BB;
    background: #fff;
    color: #4A2E1F;
}

.staff-scanned-member-action.secondary:hover {
    background: #FFF9F2;
    border-color: #C9B3A1;
}

.staff-scanned-member-close {
    width: 100%;
    min-height: 40px;
    margin-top: 10px;
    border: 0;
    border-radius: 10px;
    background: #F5F0EA;
    color: #6B5D53;
    font-family: inherit;
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
}

.staff-scanned-member-close:hover {
    background: #EDE4DB;
}

@media(max-width:640px) {
    .staff-scanned-member-card {
        margin: 14px 0;
    }

    .staff-scanned-member-actions {
        grid-template-columns: 1fr;
    }
}
</style>


<div class="staff-member-page">


    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="staff-member-header">

        <div>

            <h1 class="staff-member-title">
                Member Customer
            </h1>

            <p class="staff-member-subtitle">
                Cari member atau scan QR sebelum membuat transaksi.
            </p>

        </div>


        <div class="staff-member-header-actions" style="
                display:flex;
                gap:8px;
                flex-wrap:wrap;
            ">

            <button type="button" id="staffOpenScanner" class="staff-member-scan-button">

                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 7V5a1 1 0 0 1 1-1h2" />
                    <path d="M17 4h2a1 1 0 0 1 1 1v2" />
                    <path d="M20 17v2a1 1 0 0 1-1 1h-2" />
                    <path d="M7 20H5a1 1 0 0 1-1-1v-2" />
                    <path d="M8 12h8" />
                </svg>

                Scan QR Member

            </button>


            <a href="{{ route('staff.customers.create') }}" class="staff-member-add-button">
                + Tambah Member
            </a>

        </div>

    </div>


    {{-- =====================================================
        SCANNER PANEL
    ====================================================== --}}

    <div id="staffScannerPanel" class="staff-member-scan-panel">

        <div class="staff-member-scan-header">

            <h2 class="staff-member-scan-title">
                Scan QR Member
            </h2>


            <div class="staff-member-scan-header-actions">

                <button type="button" id="staffSwitchCamera" class="staff-member-camera-switch" disabled>

                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">
                        <path d="M7 7h10" />
                        <path d="M17 4l3 3-3 3" />
                        <path d="M17 17H7" />
                        <path d="M7 20l-3-3 3-3" />
                    </svg>

                    Putar Kamera

                </button>


                <button type="button" id="staffCloseScanner" class="staff-member-scan-close" aria-label="Tutup scanner">
                    ×
                </button>

            </div>

        </div>


        <div class="staff-member-reader">

            <div id="staffQrReader"></div>

        </div>


        <div id="staffScanMessage" class="staff-member-scan-message">
            Menyiapkan kamera...
        </div>

    </div>

    {{-- =====================================================
        HASIL SCAN MEMBER
    ====================================================== --}}
    <div id="staffScannedMemberCard" class="staff-scanned-member-card" style="display:none !important;"
        aria-hidden="true">

        <div class="staff-scanned-member-label">
            Member Ditemukan
        </div>

        <div id="staffScannedMemberName" class="staff-scanned-member-name">
            -
        </div>

        <div id="staffScannedMemberMeta" class="staff-scanned-member-meta">
            -
        </div>

        <div class="staff-scanned-member-help">
            Member berhasil ditemukan. Pilih tindakan untuk melanjutkan.
        </div>

        <div class="staff-scanned-member-actions">
            <a id="staffScannedMemberTransaction" href="#" class="staff-scanned-member-action primary">
                Transaction
            </a>

            <a id="staffScannedMemberRedeem" href="#" class="staff-scanned-member-action secondary">
                Lihat Redemption
            </a>
        </div>

        <button type="button" id="staffScannedMemberClose" class="staff-scanned-member-close">
            Tutup Hasil Scan
        </button>
    </div>

    {{-- =====================================================
        SEARCH
    ====================================================== --}}

    <div class="staff-member-search-card">

        <form id="staffMemberSearchForm" method="GET" action="{{ route('staff.customers') }}"
            class="staff-member-search-form">

            <input type="text" id="staffMemberSearch" name="search" value="{{ request('search') }}"
                placeholder="Cari nama, nomor WhatsApp, member code, atau QR..." autocomplete="off"
                class="staff-member-search-input">


            <button type="submit" class="staff-member-search-button">
                Cari
            </button>

        </form>


        <p class="staff-member-search-help">
            Gunakan nama, nomor WhatsApp, member code, atau QR code member.
        </p>

    </div>


    {{-- =====================================================
        TABLE MEMBER
    ====================================================== --}}

    <div class="staff-member-table-card">

        <div class="staff-member-table-wrap">

            <table class="staff-member-table">

                <thead>

                    <tr>

                        <th>
                            Member
                        </th>

                        <th>
                            WhatsApp
                        </th>

                        <th>
                            Point
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody id="staffCustomerList">

                    @include(
                    'staff.partials.customer-list',
                    ['customers' => $customers]
                    )

                </tbody>

            </table>

        </div>

    </div>


    {{-- =====================================================
        PAGINATION
    ====================================================== --}}

    <div class="staff-member-pagination">
        {{ $customers->links() }}
    </div>

</div>


{{-- =========================================================
     LIVE SEARCH + QR SCANNER
     Satu lifecycle JavaScript untuk mencegah event saling bentrok.
========================================================== --}}

<script>
document.addEventListener('DOMContentLoaded', function() {

    /* =========================================================
       LIVE SEARCH
    ========================================================== */

    const searchForm = document.getElementById('staffMemberSearchForm');
    const searchInput = document.getElementById('staffMemberSearch');
    const customerList = document.getElementById('staffCustomerList');

    let searchTimer = null;
    let searchController = null;

    async function loadCustomers() {
        if (!searchForm || !searchInput || !customerList) {
            return;
        }

        const search = searchInput.value.trim();
        const params = new URLSearchParams();

        if (search !== '') {
            params.set('search', search);
        }

        if (searchController) {
            searchController.abort();
        }

        searchController = new AbortController();
        customerList.style.opacity = '0.55';

        try {
            const response = await fetch(
                `${searchForm.action}?${params.toString()}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html'
                    },
                    signal: searchController.signal,
                    cache: 'no-store'
                }
            );

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const html = await response.text();

            // Hanya ganti isi tabel, tidak pernah mengganti halaman.
            customerList.innerHTML = html;
        } catch (error) {
            if (error.name === 'AbortError') {
                return;
            }

            console.error('Staff member live search error:', error);

            customerList.innerHTML = `
                <tr>
                    <td colspan="5" class="staff-member-empty">
                        Gagal memuat data member.
                    </td>
                </tr>
            `;
        } finally {
            customerList.style.opacity = '1';
        }
    }

    function scheduleSearch() {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(loadCustomers, 400);
    }

    if (searchForm && searchInput && customerList) {
        // Tombol / Enter tidak boleh melakukan GET browser ke halaman.
        searchForm.addEventListener('submit', function(event) {
            event.preventDefault();
            event.stopPropagation();
            clearTimeout(searchTimer);
            loadCustomers();
        });

        searchInput.addEventListener('input', function() {
            scheduleSearch();
        });
    }


    /* =========================================================
       QR SCANNER
    ========================================================== */

    const openButton = document.getElementById('staffOpenScanner');
    const closeButton = document.getElementById('staffCloseScanner');
    const switchButton = document.getElementById('staffSwitchCamera');
    const scannerPanel = document.getElementById('staffScannerPanel');
    const message = document.getElementById('staffScanMessage');
    const reader = document.getElementById('staffQrReader');

    const result = document.getElementById('staffScannedMemberCard');
    const resultName = document.getElementById('staffScannedMemberName');
    const resultMeta = document.getElementById('staffScannedMemberMeta');
    const resultTransaction = document.getElementById('staffScannedMemberTransaction');
    const resultRedeem = document.getElementById('staffScannedMemberRedeem');
    const resultClose = document.getElementById('staffScannedMemberClose');

    if (
        !openButton ||
        !closeButton ||
        !switchButton ||
        !scannerPanel ||
        !message ||
        !reader ||
        !result ||
        !resultName ||
        !resultMeta ||
        !resultTransaction ||
        !resultRedeem ||
        !resultClose
    ) {
        return;
    }

    if (typeof window.Html5Qrcode !== 'function') {
        openButton.disabled = true;
        message.textContent =
            'Scanner QR belum tersedia. Pastikan Vite sedang berjalan.';
        return;
    }

    let scanner = null;
    let cameras = [];
    let currentCameraIndex = 0;
    let scannerRunning = false;
    let scanProcessing = false;
    let scanLocked = false;

    function hideResult() {
        result.style.setProperty('display', 'none', 'important');
        result.setAttribute('aria-hidden', 'true');
        resultName.textContent = '-';
        resultMeta.textContent = '-';
    }

    function showResult(customer) {
        if (!customer || !customer.id_customer) {
            return false;
        }

        const customerId = String(customer.id_customer);

        resultName.textContent = customer.nama || '-';
        resultMeta.textContent =
            `${customer.member_code || '-'} • ` +
            `${customer.nomor_hp || '-'} • ` +
            `${Number(customer.saldo_point || 0).toLocaleString('id-ID')} Point`;

        // URL dipasang sebagai href nyata, bukan href="#" + click handler.
        resultTransaction.href =
            `{{ url('/staff/transactions/create') }}/${encodeURIComponent(customerId)}`;

        resultRedeem.href =
            `{{ route('staff.redemptions') }}?customer=${encodeURIComponent(customerId)}`;

        resultTransaction.removeAttribute('data-customer-id');
        resultRedeem.removeAttribute('data-customer-id');

        result.setAttribute('aria-hidden', 'false');
        result.style.setProperty('display', 'block', 'important');

        return true;
    }

    function findBackCameraIndex() {
        if (!cameras.length) {
            return 0;
        }

        const index = cameras.findIndex(function(camera) {
            const label = String(camera.label || '').toLowerCase();
            return (
                label.includes('back') ||
                label.includes('rear') ||
                label.includes('environment') ||
                label.includes('belakang')
            );
        });

        return index >= 0 ? index : 0;
    }

    async function stopCamera() {
        scannerRunning = false;

        const activeScanner = scanner;
        scanner = null;

        if (!activeScanner) {
            return;
        }

        try {
            await activeScanner.stop();
        } catch (error) {
            console.warn('Scanner stop:', error);
        }

        try {
            await activeScanner.clear();
        } catch (error) {
            console.warn('Scanner clear:', error);
        }
    }

    async function checkCustomer(qrCode) {
        if (scanProcessing || scanLocked) {
            return;
        }

        scanProcessing = true;
        scannerRunning = false;
        scanLocked = true;
        message.textContent = 'Memeriksa QR member...';

        try {
            const response = await fetch(
                "{{ route('staff.customer.scan') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            ?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({
                        qr_code: qrCode
                    }),
                    cache: 'no-store'
                }
            );

            let data = null;

            try {
                data = await response.json();
            } catch (error) {
                data = null;
            }

            if (!response.ok) {
                throw new Error(
                    data?.message ||
                    `Gagal memeriksa QR. HTTP ${response.status}`
                );
            }

            const customer = data?.data;

            if (!customer || !customer.id_customer) {
                throw new Error('Data member tidak ditemukan.');
            }

            if (!showResult(customer)) {
                throw new Error('Data member tidak dapat ditampilkan.');
            }

            message.textContent =
                'Member berhasil ditemukan. Pilih Transaction atau Lihat Redemption.';

            // Kamera boleh berhenti; hasil scan TETAP berada di DOM.
            await stopCamera();
        } catch (error) {
            scanLocked = false;
            scannerRunning = true;
            message.textContent =
                error.message || 'QR tidak dapat diproses.';
            console.error('QR member error:', error);
        } finally {
            scanProcessing = false;
        }
    }

    async function startWithCameraId(cameraId) {
        await stopCamera();

        scanner = new window.Html5Qrcode('staffQrReader');

        await scanner.start(
            cameraId, {
                fps: 10,
                qrbox: {
                    width: 230,
                    height: 230
                },
                aspectRatio: 1
            },
            async function(decodedText) {
                    if (!scannerRunning || scanProcessing || scanLocked) {
                        return;
                    }

                    await checkCustomer(decodedText);
                },
                function() {
                    // QR belum terbaca.
                }
        );

        scannerRunning = true;
        message.textContent = 'Arahkan kamera ke QR Code member.';
    }

    async function startScanner() {
        await stopCamera();

        hideResult();
        scanProcessing = false;
        scanLocked = false;
        message.textContent = 'Meminta akses kamera...';

        try {
            scanner = new window.Html5Qrcode('staffQrReader');

            await scanner.start({
                    facingMode: {
                        ideal: 'environment'
                    }
                }, {
                    fps: 10,
                    qrbox: {
                        width: 230,
                        height: 230
                    },
                    aspectRatio: 1
                },
                async function(decodedText) {
                        if (!scannerRunning || scanProcessing || scanLocked) {
                            return;
                        }

                        await checkCustomer(decodedText);
                    },
                    function() {
                        // QR belum terbaca.
                    }
            );

            scannerRunning = true;

            try {
                cameras = await window.Html5Qrcode.getCameras();
            } catch (error) {
                cameras = [];
            }

            switchButton.disabled = cameras.length < 2;
            message.textContent = 'Arahkan kamera ke QR Code member.';
            return;
        } catch (error) {
            console.warn('Kamera belakang tidak tersedia:', error);
            await stopCamera();
        }

        try {
            cameras = await window.Html5Qrcode.getCameras();

            if (!cameras.length) {
                throw new Error('Tidak ada kamera yang ditemukan.');
            }

            currentCameraIndex = findBackCameraIndex();
            switchButton.disabled = cameras.length < 2;

            await startWithCameraId(
                cameras[currentCameraIndex].id
            );
        } catch (error) {
            console.error('Camera error:', error);
            switchButton.disabled = true;
            message.textContent =
                'Kamera tidak ditemukan atau izin kamera belum diberikan.';
        }
    }

    openButton.addEventListener('click', async function(event) {
        event.preventDefault();
        event.stopPropagation();

        scannerPanel.classList.add('open');
        hideResult();
        await startScanner();
    });

    switchButton.addEventListener('click', async function(event) {
        event.preventDefault();
        event.stopPropagation();

        if (cameras.length < 2) {
            message.textContent =
                'Perangkat ini hanya memiliki satu kamera yang tersedia.';
            return;
        }

        currentCameraIndex =
            (currentCameraIndex + 1) % cameras.length;

        message.textContent = 'Mengganti kamera...';

        try {
            await startWithCameraId(cameras[currentCameraIndex].id);
        } catch (error) {
            console.error('Camera switch error:', error);
            message.textContent = 'Gagal mengganti kamera.';
        }
    });

    resultClose.addEventListener('click', async function(event) {
        event.preventDefault();
        event.stopPropagation();

        hideResult();
        scanLocked = false;
        scanProcessing = false;

        await stopCamera();
        scannerPanel.classList.remove('open');
        message.textContent = 'Arahkan kamera ke QR Code member.';
    });

    closeButton.addEventListener('click', async function(event) {
        event.preventDefault();
        event.stopPropagation();

        hideResult();
        await stopCamera();
        scannerPanel.classList.remove('open');

        scanProcessing = false;
        scanLocked = false;
        message.textContent = 'Arahkan kamera ke QR Code member.';
    });

    // Tidak ada handler klik khusus untuk Transaction/Redemption.
    // Keduanya adalah link GET biasa dari showResult().
});
</script>

@endsection