@extends('layouts.customer')

@section('title', 'Profil - SAÉ CAFE ROJEL')
@section('mobile_title', 'Profil')

@section('content')

<style>
/* =========================================================
   PROFILE PAGE
========================================================= */

.profile-page {
    width: 100%;
    max-width: 1080px;

    margin: 0 auto;

    display: grid;
    gap: 18px;
}


/* =========================================================
   TITLE
========================================================= */

.profile-page-title {
    margin: 0;

    color: #171311;

    font-size: 26px;
    line-height: 1.2;

    font-weight: 700;

    letter-spacing: -.025em;
}


/* =========================================================
   TOP AREA
========================================================= */

.profile-top {
    display: grid;

    grid-template-columns:
        0.75fr 1.45fr;

    gap: 18px;

    align-items: stretch;
}


/* =========================================================
   PROFILE SUMMARY CARD
========================================================= */

.profile-summary {
    min-height: 300px;

    display: flex;

    flex-direction: column;

    padding: 20px;

    border-radius: 14px;

    background: #4B2D1C;

    color: #FFFFFF;
}

.profile-avatar {
    width: 56px;
    height: 56px;

    display: grid;

    place-items: center;

    flex-shrink: 0;

    border-radius: 50%;

    background: #FFF5EA;

    color: #8B5D37;

    font-size: 22px;

    font-weight: 700;
}

.profile-name {
    margin-top: 18px;

    color: #FFFFFF;

    font-size: 17px;

    line-height: 1.3;

    font-weight: 700;
}

.profile-member-label {
    margin-top: 5px;

    color: #DCCBC0;

    font-size: 9px;
}

.profile-member-code {
    margin-top: 7px;

    color: #FFFFFF;

    font-size: 12px;

    font-weight: 600;
}

.profile-summary-divider {
    width: 100%;

    height: 1px;

    margin: 14px 0 18px;

    background: rgba(255, 255, 255, .35);
}

.profile-summary-bottom {
    margin-top: auto;

    display: grid;

    grid-template-columns:
        1fr 1fr;

    gap: 12px;
}

.profile-summary-label {
    color: #DCCBC0;

    font-size: 9px;
}

.profile-summary-value {
    margin-top: 6px;

    color: #FFFFFF;

    font-size: 12px;

    font-weight: 700;
}

.profile-summary-value.point::before {
    content: "★";

    margin-right: 4px;

    color: #F1C87B;
}

.profile-status {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    width: fit-content;

    min-width: 45px;

    padding: 4px 9px;

    border-radius: 999px;

    background: #DDF6E8;

    color: #25834A;

    font-size: 7px;

    font-weight: 600;
}


/* =========================================================
   ACCOUNT INFORMATION
========================================================= */

.profile-info {
    min-width: 0;

    padding: 20px;

    border: 1px solid #E9DED1;

    border-radius: 14px;

    background: #FFFFFF;
}

.profile-info-title {
    margin: 0 0 14px;

    color: #171311;

    font-size: 17px;

    font-weight: 700;
}

.profile-info-list {
    display: grid;

    width: 100%;
}

.profile-info-row {
    display: grid;

    grid-template-columns:
        26px 175px minmax(0, 1fr);

    align-items: center;

    min-height: 52px;

    gap: 10px;

    border-bottom: 1px solid #EEE4DA;
}

.profile-info-row:last-child {
    border-bottom: 0;
}

.profile-info-icon {
    width: 22px;
    height: 22px;

    display: grid;

    place-items: center;

    color: #4B2D1C;
}

.profile-info-icon svg {
    width: 18px;
    height: 18px;

    display: block;
}

.profile-info-label {
    color: #251B16;

    font-size: 10px;

    font-weight: 600;
}

.profile-info-value {
    min-width: 0;

    color: #70645D;

    font-size: 10px;

    overflow: hidden;

    white-space: nowrap;

    text-overflow: ellipsis;
}


/* =========================================================
   MENU
========================================================= */

.profile-menu-section {
    display: grid;

    gap: 9px;
}

.profile-menu-title {
    margin: 0 0 2px 4px;

    color: #171311;

    font-size: 17px;

    font-weight: 700;
}

.profile-menu-list {
    overflow: hidden;

    border: 1px solid #E9DED1;

    border-radius: 12px;

    background: #FFFFFF;
}

.profile-menu-item {
    width: 100%;

    min-height: 52px;

    display: flex;

    align-items: center;

    gap: 11px;

    padding: 10px 16px;

    border: 0;

    background: #FFFFFF;

    color: #251B16;

    font: inherit;

    font-size: 10px;

    font-weight: 600;

    text-align: left;

    text-decoration: none;

    cursor: pointer;

    transition:
        background-color .2s ease;
}

.profile-menu-item+.profile-menu-item {
    border-top: 1px solid #EEE4DA;
}

.profile-menu-item:hover {
    background: #FCF7F1;
}

.profile-menu-icon {
    width: 26px;
    height: 26px;

    display: grid;

    place-items: center;

    flex-shrink: 0;

    border-radius: 7px;

    background: #4B2D1C;

    color: #FFFFFF;
}

.profile-menu-icon svg {
    width: 15px;
    height: 15px;
}

.profile-menu-arrow {
    margin-left: auto;

    color: #4B2D1C;

    font-size: 22px;

    line-height: 1;
}

.profile-menu-item.logout {
    color: #C12E2E;
}

.profile-menu-item.logout .profile-menu-icon {
    background: #4B2D1C;

    color: #FFFFFF;
}


/* =========================================================
   RESPONSIVE - TABLET
========================================================= */

@media (max-width: 820px) {

    .profile-top {
        grid-template-columns:
            1fr;
    }

    .profile-summary {
        min-height: 240px;
    }

    .profile-info-row {
        grid-template-columns:
            26px 150px minmax(0, 1fr);
    }

}


/* =========================================================
   RESPONSIVE - MOBILE
========================================================= */

@media (max-width: 560px) {

    .profile-page {
        gap: 15px;
    }

    .profile-page-title {
        font-size: 23px;
    }


    /* SUMMARY */

    .profile-summary {
        min-height: 235px;

        padding: 17px;
    }

    .profile-avatar {
        width: 52px;
        height: 52px;

        font-size: 20px;
    }

    .profile-name {
        margin-top: 15px;

        font-size: 15px;
    }

    .profile-member-label {
        font-size: 8px;
    }

    .profile-member-code {
        font-size: 11px;
    }

    .profile-summary-divider {
        margin: 13px 0 15px;
    }

    .profile-summary-label {
        font-size: 8px;
    }

    .profile-summary-value {
        font-size: 11px;
    }


    /* INFO */

    .profile-info {
        padding: 15px;
    }

    .profile-info-title {
        font-size: 15px;

        margin-bottom: 8px;
    }

    .profile-info-row {
        grid-template-columns:
            25px 125px minmax(0, 1fr);

        min-height: 48px;

        gap: 8px;
    }

    .profile-info-label,
    .profile-info-value {
        font-size: 8px;
    }

    .profile-info-icon {
        width: 21px;
        height: 21px;
    }

    .profile-info-icon svg {
        width: 16px;
        height: 16px;
    }


    /* MENU */

    .profile-menu-title {
        font-size: 15px;
    }

    .profile-menu-item {
        min-height: 50px;

        padding: 9px 12px;

        font-size: 9px;
    }

    .profile-menu-icon {
        width: 25px;
        height: 25px;
    }

    .profile-menu-arrow {
        font-size: 20px;
    }

}


/* =========================================================
   VERY SMALL MOBILE
========================================================= */

@media (max-width: 380px) {

    .profile-info-row {
        grid-template-columns:
            23px 110px minmax(0, 1fr);

        gap: 6px;
    }

    .profile-info-label,
    .profile-info-value {
        font-size: 7.5px;
    }

}
</style>


<div class="profile-page">


    {{-- =====================================================
         TITLE
    ====================================================== --}}

    <h1 class="profile-page-title">
        Profil
    </h1>


    {{-- =====================================================
         TOP
    ====================================================== --}}

    <div class="profile-top">


        {{-- =================================================
             PROFILE SUMMARY
        ================================================== --}}

        <section class="profile-summary">

            <div class="profile-avatar">
                {{ strtoupper(substr($customer->nama ?? 'C', 0, 1)) }}
            </div>


            <div class="profile-name">
                {{ $customer->nama ?? 'Customer' }}
            </div>


            <div class="profile-member-label">
                Member ID
            </div>


            <div class="profile-member-code">
                {{ $customer->member_code ?? '-' }}
            </div>


            <div class="profile-summary-divider"></div>


            <div class="profile-summary-bottom">

                <div>

                    <div class="profile-summary-label">
                        Saldo Point
                    </div>

                    <div class="profile-summary-value point">
                        {{ number_format(
                            (int) ($customer->saldo_point ?? 0),
                            0,
                            ',',
                            '.'
                        ) }}
                        Point
                    </div>

                </div>


                <div>

                    <div class="profile-summary-label">
                        Status Member
                    </div>

                    <div style="margin-top:6px">
                        <span class="profile-status">
                            Aktif
                        </span>
                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             ACCOUNT INFORMATION
        ================================================== --}}

        <section class="profile-info">

            <h2 class="profile-info-title">
                Informasi Akun
            </h2>


            <div class="profile-info-list">


                {{-- NAMA --}}

                <div class="profile-info-row">

                    <div class="profile-info-icon">

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="3"></circle>
                            <path d="M5 20c.8-3.3 3.1-5 7-5s6.2 1.7 7 5"></path>
                        </svg>

                    </div>

                    <div class="profile-info-label">
                        Nama Lengkap
                    </div>

                    <div class="profile-info-value">
                        {{ $customer->nama ?? '-' }}
                    </div>

                </div>


                {{-- NO HP --}}

                <div class="profile-info-row">

                    <div class="profile-info-icon">

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M6.5 3.5l3 3-2 2c1.2 2.8 3.2 4.8 6 6l2-2 3 3-1.7 2.1c-.7.9-2 1.2-3 .8C8.5 16 5 12.5 3.6 7.2c-.4-1 .0-2.3.8-3z">
                            </path>
                        </svg>

                    </div>

                    <div class="profile-info-label">
                        No. Hp
                    </div>

                    <div class="profile-info-value">
                        {{ $customer->nomor_hp ?? '-' }}
                    </div>

                </div>


                {{-- EMAIL --}}

                <div class="profile-info-row">

                    <div class="profile-info-icon">

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                            <path d="M3 7l9 6 9-6"></path>
                        </svg>

                    </div>

                    <div class="profile-info-label">
                        Email
                    </div>

                    <div class="profile-info-value">
                        {{ $customer->email ?? '-' }}
                    </div>

                </div>


                {{-- TANGGAL LAHIR --}}

                <div class="profile-info-row">

                    <div class="profile-info-icon">

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="4" y="5" width="16" height="15" rx="2"></rect>
                            <path d="M8 3v4"></path>
                            <path d="M16 3v4"></path>
                            <path d="M4 9h16"></path>
                        </svg>

                    </div>

                    <div class="profile-info-label">
                        Tanggal Lahir
                    </div>

                    <div class="profile-info-value">

                        {{ !empty($customer->tanggal_lahir)
                            ? \Carbon\Carbon::parse(
                                $customer->tanggal_lahir
                            )->format('d F Y')
                            : '-'
                        }}

                    </div>

                </div>


                {{-- TANGGAL BERGABUNG --}}

                <div class="profile-info-row">

                    <div class="profile-info-icon">

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="4" y="5" width="16" height="15" rx="2"></rect>
                            <path d="M8 3v4"></path>
                            <path d="M16 3v4"></path>
                            <path d="M4 9h16"></path>
                        </svg>

                    </div>

                    <div class="profile-info-label">
                        Tanggal Bergabung
                    </div>

                    <div class="profile-info-value">

                        {{ !empty($customer->tanggal_daftar)
                            ? \Carbon\Carbon::parse(
                                $customer->tanggal_daftar
                            )->format('d F Y')
                            : '-'
                        }}

                    </div>

                </div>


            </div>

        </section>

    </div>


    {{-- =====================================================
         MENU
    ====================================================== --}}

    <section class="profile-menu-section">

        <h2 class="profile-menu-title">
            Menu
        </h2>


        <div class="profile-menu-list">


            {{-- UBAH PASSWORD --}}

            <a href="{{ route('customer.password.edit') }}" class="profile-menu-item">

                <span class="profile-menu-icon">

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="5" y="10" width="14" height="10" rx="2"></rect>
                        <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                        <path d="M12 14v3"></path>
                    </svg>

                </span>

                <span>
                    Ubah Password
                </span>

                <span class="profile-menu-arrow">
                    ›
                </span>

            </a>


            {{-- RIWAYAT POINT --}}

            <a href="{{ route('customer.transaction') }}" class="profile-menu-item">

                <span class="profile-menu-icon">

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M6 3h12"></path>
                        <path d="M6 21h12"></path>
                        <path d="M8 3v4"></path>
                        <path d="M16 3v4"></path>
                        <rect x="7" y="7" width="10" height="10" rx="1"></rect>
                        <path d="M10 11h4"></path>
                        <path d="M10 14h3"></path>
                    </svg>

                </span>

                <span>
                    Riwayat Point
                </span>

                <span class="profile-menu-arrow">
                    ›
                </span>

            </a>


            {{-- RIWAYAT REDEEM --}}

            <a href="{{ route('customer.reward') }}?tab=history" class="profile-menu-item">

                <span class="profile-menu-icon">

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M20 12v8a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-8"></path>
                        <path d="M2 7h20v5H2z"></path>
                        <path d="M12 7v14"></path>
                        <path d="M12 7H7.5a2.5 2.5 0 1 1 0-5C10 2 12 7 12 7Z"></path>
                        <path d="M12 7h4.5a2.5 2.5 0 1 0 0-5C14 2 12 7 12 7Z"></path>
                    </svg>

                </span>

                <span>
                    Riwayat Penukaran
                </span>

                <span class="profile-menu-arrow">
                    ›
                </span>

            </a>


            {{-- LOGOUT --}}

            <button type="button" class="profile-menu-item logout" id="profileLogoutButton">
                <span class="profile-menu-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M10 17l5-5-5-5"></path>
                        <path d="M15 12H3"></path>
                        <path d="M21 4v16"></path>
                    </svg>
                </span>

                <span>
                    Keluar
                </span>

                <span class="profile-menu-arrow">
                    ›
                </span>
            </button>


        </div>

    </section>


</div>

@endsection