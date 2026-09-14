@extends('layouts.customer')
@section('title','Beranda - SAÉ CAFE ROJEL')
@section('mobile_title','SAÉ CAFE ROJEL')
@section('content')
@php
$greeting = now()->hour < 11 ? 'Good Morning' : (now()->hour < 15 ? 'Good Afternoon' : (now()->hour < 19
            ? 'Good Evening' : 'Good Night' )); $name=$customer->nama ?? 'Customer';
            $memberCode = $customer->member_code ?? '-';
            $point = (int)($customer->saldo_point ?? 0);
            $favorites = $rewards ?? collect();
            @endphp
            <style>
            /* =========================================================
   CUSTOMER DASHBOARD
========================================================= */

            .customer-dashboard {
                display: grid;
                gap: 22px;
                width: 100%;
            }


            /* =========================================================
   GREETING
========================================================= */

            .customer-greeting {
                padding: 2px 4px 0;
            }

            .customer-greeting h1 {
                margin: 0;

                color: #171311;

                font-size: clamp(24px, 3vw, 32px);
                line-height: 1.2;

                font-weight: 700;
                letter-spacing: -.03em;
            }

            .customer-greeting p {
                margin: 6px 0 0;

                color: #8B796B;

                font-size: 11px;
                line-height: 1.5;
            }


            /* =========================================================
   TOP AREA
   DESKTOP:
   MEMBER 40% | REWARD 60%
========================================================= */

            .customer-top {
                display: grid;

                grid-template-columns:
                    minmax(0, 0.68fr) minmax(0, 1.32fr);

                gap: 20px;

                align-items: stretch;

                width: 100%;
            }


            /* =========================================================
   MEMBER AREA
========================================================= */

            .customer-member-area {
                display: grid;

                grid-template-rows: auto auto;

                gap: 10px;

                min-width: 0;

                align-content: start;
            }

            .customer-member-card {
                position: relative;

                min-height: 205px;

                overflow: hidden;

                padding: 18px 20px;

                border: 1px solid #E7D9C8;

                border-radius: 14px;

                background: #FBF3E8;

                color: #201810;
            }

            .customer-member-card::after {
                content: "";

                position: absolute;

                width: 180px;
                height: 180px;

                right: -60px;
                bottom: -72px;

                border-radius: 50%;

                background:
                    radial-gradient(circle,
                        rgba(161, 95, 34, .22),
                        transparent 68%);

                pointer-events: none;
            }

            .customer-member-label {
                color: #7F6C5D;

                font-size: 10px;

                text-transform: uppercase;

                letter-spacing: .07em;

                font-weight: 600;
            }

            .customer-member-code {
                margin-top: 5px;

                color: #201810;

                font-size: 13px;

                font-weight: 600;
            }

            .customer-member-point {
                margin-top: 20px;

                display: flex;

                align-items: baseline;

                gap: 7px;
            }

            .customer-member-point strong {
                color: #201810;

                font-size: 46px;

                line-height: 1;

                font-weight: 700;
            }

            .customer-member-point span {
                color: #7A634F;

                font-size: 15px;
            }

            .customer-member-help {
                margin-top: 15px;

                max-width: 185px;

                color: #7B6A5E;

                font-size: 10px;

                line-height: 1.55;
            }

            .customer-member-qr {
                position: absolute;

                top: 14px;
                right: 14px;

                width: 56px;
                height: 56px;

                padding: 5px;

                display: grid;
                place-items: center;

                border: 1px solid #DFD1C1;
                border-radius: 9px;

                background: #FFFFFF;

                cursor: pointer;

                z-index: 5;
            }

            .customer-member-qr svg {
                display: block;

                width: 100%;
                height: 100%;

                max-width: 100%;
                max-height: 100%;
            }


            .customer-member-coffee {
                position: absolute;

                right: 4px;
                bottom: -18px;

                width: 85px;

                height: auto;

                z-index: 2;
            }


            /* =========================================================
   POINT RULE
========================================================= */

            .customer-point-rule {
                min-height: 40px;

                display: flex;

                align-items: center;
                justify-content: space-between;

                padding: 0 14px;

                border-radius: 8px;

                background: #4B2D1C;

                color: #FFFFFF;

                font-size: 10px;

                font-weight: 600;
            }

            .customer-point-rule span {
                min-width: 0;
            }

            .customer-point-rule strong {
                flex-shrink: 0;

                color: #F0C87B;

                font-size: 21px;
            }


            /* =========================================================
   SECTION / REWARD
========================================================= */

            .customer-section {
                min-width: 0;
                width: 100%;
                padding: 18px;

                border: 0;
                border-radius: 0;

                background: transparent;
            }

            /* =========================================================
   ALIGN REWARD FAVORITE WITH MEMBER CARD
========================================================= */

            @media (min-width: 761px) {

                .customer-top {
                    align-items: start;
                }

                .customer-top>.customer-section {
                    position: relative;
                    top: -29px;
                }

            }

            .customer-section-head {
                display: flex;

                align-items: center;
                justify-content: space-between;

                gap: 10px;

                margin-bottom: 13px;
            }

            .customer-section-title {
                margin: 0;

                color: #171311;

                font-size: 15px;

                line-height: 1.25;

                font-weight: 700;
            }

            .customer-section-link {
                color: #6B432A;

                font-size: 10px;

                font-weight: 600;

                text-decoration: none;
            }

            .customer-see-all {
                display: inline-flex;

                align-items: center;
                justify-content: center;

                gap: 7px;

                min-height: 38px;

                padding: 8px 13px;

                border: 1px solid #4B2D1C;

                border-radius: 8px;

                background: #4B2D1C;

                color: #FFFFFF;

                font-size: 9px;

                font-weight: 700;

                white-space: nowrap;

                transition:
                    background-color .2s ease,
                    border-color .2s ease;
            }

            .customer-see-all:hover {
                background: #5B3927;

                border-color: #5B3927;
            }

            .customer-see-all span {
                font-size: 12px;

                line-height: 1;
            }


            /* =========================================================
   REWARD GRID
   DESKTOP = 4 COLUMNS
========================================================= */

            .customer-reward-grid {
                display: grid;

                grid-template-columns:
                    repeat(4, minmax(0, 1fr));

                gap: 10px;

                width: 100%;

                margin-top: 13px;
            }


            /* =========================================================
   REWARD CARD
========================================================= */

            .customer-reward-card {
                min-width: 0;

                display: flex;

                flex-direction: column;

                overflow: hidden;

                border: 1px solid #E9DED1;

                border-radius: 10px;

                background: #FFFFFF;
            }


            /* =========================================================
   REWARD IMAGE
========================================================= */

            .customer-reward-img {
                width: 100%;

                height: 108px;

                display: grid;

                place-items: center;

                overflow: hidden;

                background: #F7EEE2;
            }

            .customer-reward-img img {
                display: block;

                width: auto;
                height: auto;

                max-width: 88%;
                max-height: 92px;

                object-fit: contain;
            }

            .customer-reward-placeholder {
                font-size: 28px;
            }


            /* =========================================================
   REWARD BODY
========================================================= */

            .customer-reward-body {
                min-width: 0;

                flex: 1;

                display: flex;

                flex-direction: column;

                padding: 10px;
            }

            .customer-reward-name {
                overflow: hidden;

                min-height: 27px;

                color: #201810;

                font-size: 9px;

                line-height: 1.4;

                font-weight: 700;

                white-space: nowrap;

                text-overflow: ellipsis;
            }

            .customer-reward-point {
                margin-top: 4px;

                color: #806A59;

                font-size: 8px;

                line-height: 1.3;
            }

            .customer-reward-point b {
                color: #C9892C;
            }


            /* =========================================================
   REWARD BUTTON
========================================================= */

            .customer-reward-cta {
                display: flex;

                align-items: center;
                justify-content: center;

                width: 100%;

                min-height: 34px;

                box-sizing: border-box;

                margin-top: 9px;

                padding: 7px 6px;

                border: 0;

                border-radius: 6px;

                background: #4B2D1C;

                color: #FFFFFF;

                text-align: center;
                text-decoration: none;

                font-size: 8px;

                line-height: 1.2;

                font-weight: 700;

                cursor: pointer;
            }

            .customer-reward-cta:hover {
                background: #5B3927;
            }


            /* =========================================================
   DISABLED REWARD BUTTON
========================================================= */

            .customer-reward-cta-disabled,
            .customer-reward-cta:disabled {
                display: flex;

                align-items: center;
                justify-content: center;

                width: 100%;

                min-height: 34px;

                box-sizing: border-box;

                margin-top: 9px;

                padding: 7px 6px;

                border: 0;

                border-radius: 6px;

                background: #D8D8D8 !important;

                color: #8A8A8A !important;

                cursor: not-allowed;

                opacity: 1;

                text-align: center;

                font-size: 8px;

                line-height: 1.2;

                font-weight: 700;
            }


            /* =========================================================
   BOTTOM AREA
========================================================= */

            .customer-bottom {
                display: grid;

                grid-template-columns:
                    minmax(0, 1fr) 250px;

                gap: 18px;

                align-items: start;
            }


            /* =========================================================
   ACTIVITY
========================================================= */

            .customer-activity-list {
                width: 100%;

                margin-top: 13px;

                overflow: hidden;

                border: 1px solid #EEE2D6;

                border-radius: 10px;

                background: #FFFFFF;
            }

            .customer-activity-row {
                display: grid;

                grid-template-columns:
                    34px minmax(0, 1fr) auto;

                gap: 10px;

                align-items: center;

                min-height: 55px;

                padding: 10px 12px;

                background: #FFFFFF;
            }

            .customer-activity-row+.customer-activity-row {
                border-top: 1px solid #EEE7DF;
            }

            .customer-activity-icon {
                width: 34px;
                height: 34px;

                display: grid;
                place-items: center;

                flex-shrink: 0;

                border-radius: 50%;
            }

            .customer-activity-icon svg {
                width: 18px;
                height: 18px;
            }

            .customer-activity-icon.plus {
                background: #EDF7EF;

                color: #2D7C49;
            }

            .customer-activity-icon.minus {
                background: #F7EBDD;

                color: #8A5A32;
            }

            .customer-activity-main {
                min-width: 0;
            }

            .customer-activity-title {
                overflow: hidden;

                color: #251B16;

                font-size: 9px;

                font-weight: 600;

                white-space: nowrap;

                text-overflow: ellipsis;
            }

            .customer-activity-date {
                margin-top: 2px;

                color: #9A8C80;

                font-size: 8px;
            }

            .customer-activity-point {
                flex-shrink: 0;

                font-size: 9px;

                font-weight: 700;

                white-space: nowrap;
            }

            .customer-plus {
                color: #2D7C49;
            }

            .customer-minus {
                color: #B84444;
            }

            .customer-activity-empty {
                padding: 20px;

                color: #8B796B;

                font-size: 10px;
            }


            /* =========================================================
   ABOUT POINT
========================================================= */

            .customer-about {
                background: #FFF1DF;
            }

            .customer-about h3 {
                margin: 0;

                color: #171311;

                font-size: 14px;

                font-weight: 700;
            }

            .customer-about ul {
                display: grid;

                gap: 9px;

                margin: 12px 0 0;

                padding: 0;

                list-style: none;
            }

            .customer-about li {
                display: flex;

                gap: 7px;

                color: #6F5D50;

                font-size: 9px;

                line-height: 1.55;
            }

            .customer-about li::before {
                content: "✓";

                flex-shrink: 0;

                color: #8B642D;

                font-weight: 700;
            }


            /* =========================================================
   TABLET
   TOP MASIH BISA SIDE-BY-SIDE
========================================================= */

            @media (max-width: 900px) {

                .customer-top {
                    grid-template-columns:
                        minmax(0, 0.62fr) minmax(0, 1.38fr);

                    gap: 14px;
                }

                .customer-section {
                    padding: 14px;
                }

                .customer-reward-grid {
                    gap: 8px;
                }

                .customer-reward-img {
                    height: 100px;
                }

                .customer-reward-body {
                    padding: 8px;
                }

                .customer-reward-name {
                    font-size: 8px;
                }

                .customer-reward-point {
                    font-size: 8px;
                }

                .customer-reward-cta,
                .customer-reward-cta-disabled,
                .customer-reward-cta:disabled {
                    font-size: 7px;
                }

            }


            /* =========================================================
   MOBILE
   TOP MENJADI 1 KOLOM
   REWARD = 2 CARD / BARIS
========================================================= */

            @media (max-width: 760px) {

                .customer-top {
                    grid-template-columns: 1fr;

                    gap: 16px;
                }

                .customer-member-card {
                    min-height: 205px;
                }

                .customer-bottom {
                    grid-template-columns: 1fr;
                }

                .customer-about {
                    order: 2;
                }

                .customer-reward-grid {
                    grid-template-columns:
                        repeat(2, minmax(0, 1fr));

                    gap: 9px;
                }

                .customer-reward-img {
                    height: 110px;
                }

                .customer-reward-img img {
                    max-width: 82%;
                    max-height: 95px;
                }

            }


            /* =========================================================
   SMALL MOBILE
========================================================= */

            @media (max-width: 480px) {

                .customer-dashboard {
                    gap: 16px;
                }

                .customer-greeting {
                    padding: 0;
                }

                .customer-greeting h1 {
                    font-size: 24px;
                }

                .customer-greeting p {
                    font-size: 10px;
                }


                /* MEMBER */

                .customer-member-card {
                    min-height: 205px;

                    padding: 16px;
                }

                .customer-member-point {
                    margin-top: 18px;
                }

                .customer-member-point strong {
                    font-size: 42px;
                }

                .customer-member-qr {
                    width: 50px;
                    height: 50px;

                    top: 12px;
                    right: 12px;
                }

                .customer-member-coffee {
                    width: 100px;

                    bottom: -16px;
                }


                /* POINT RULE */

                .customer-point-rule {
                    min-height: 40px;

                    padding: 0 12px;

                    font-size: 9px;
                }

                .customer-point-rule strong {
                    font-size: 20px;
                }


                /* REWARD */

                .customer-section {
                    padding: 14px;
                }

                .customer-section-head {
                    gap: 8px;
                }

                .customer-section-title {
                    font-size: 14px;
                }

                .customer-see-all {
                    min-height: 36px;

                    padding: 7px 11px;

                    font-size: 8px;
                }

                .customer-reward-grid {
                    grid-template-columns:
                        repeat(2, minmax(0, 1fr));

                    gap: 9px;
                }

                .customer-reward-img {
                    height: 105px;
                }

                .customer-reward-img img {
                    max-width: 82%;
                    max-height: 90px;
                }

                .customer-reward-body {
                    padding: 8px;
                }

                .customer-reward-name {
                    min-height: 23px;

                    font-size: 8px;
                }

                .customer-reward-point {
                    font-size: 8px;
                }

                .customer-reward-cta,
                .customer-reward-cta-disabled,
                .customer-reward-cta:disabled {
                    min-height: 32px;

                    margin-top: 7px;

                    padding: 7px 5px;

                    font-size: 7px;
                }


                /* ACTIVITY */

                .customer-activity-row {
                    grid-template-columns:
                        30px minmax(0, 1fr) auto;

                    gap: 8px;

                    min-height: 55px;

                    padding: 9px 10px;
                }

                .customer-activity-icon {
                    width: 30px;
                    height: 30px;
                }

                .customer-activity-icon svg {
                    width: 16px;
                    height: 16px;
                }

                .customer-activity-title {
                    font-size: 8px;
                }

                .customer-activity-date {
                    font-size: 7px;
                }

                .customer-activity-point {
                    font-size: 8px;
                }

            }


            /* =========================================================
   VERY SMALL MOBILE
========================================================= */

            @media (max-width: 360px) {

                .customer-reward-grid {
                    gap: 7px;
                }

                .customer-reward-img {
                    height: 95px;
                }

                .customer-reward-img img {
                    max-width: 80%;
                    max-height: 82px;
                }

                .customer-reward-body {
                    padding: 7px;
                }

                .customer-reward-cta,
                .customer-reward-cta-disabled,
                .customer-reward-cta:disabled {
                    font-size: 6.5px;

                    padding-left: 4px;
                    padding-right: 4px;
                }

            }


            /* =========================================================
   MEMBER QR MODAL
========================================================= */

            .customer-qr-modal {
                width: min(420px, calc(100vw - 32px));

                max-width: 420px;

                max-height: 90vh;

                margin: auto;

                padding: 0;

                border: 0;

                border-radius: 20px;

                background: #FFFFFF;

                overflow: auto;

                box-shadow:
                    0 20px 60px rgba(0, 0, 0, .22);
            }

            .customer-qr-modal::backdrop {
                background: rgba(0, 0, 0, .55);
            }

            .customer-qr-modal-content {
                position: relative;

                padding: 24px 20px 28px;

                text-align: center;

                font-family: Poppins, Arial, sans-serif;
            }

            .customer-qr-modal-close {
                position: absolute;

                top: 16px;
                right: 16px;

                width: 36px;
                height: 36px;

                display: grid;

                place-items: center;

                border: 0;

                border-radius: 50%;

                background: #F3EEE7;

                color: #171311;

                font-size: 20px;

                line-height: 1;

                cursor: pointer;
            }

            .customer-qr-modal-brand {
                margin-top: 24px;

                color: #4B2D1C;

                font-size: 22px;

                font-weight: 700;

                line-height: 1.2;
            }

            .customer-qr-modal-subtitle {
                margin-top: 5px;

                color: #8B796B;

                font-size: 12px;
            }


            /* =========================================================
   QR BOX
========================================================= */

            .customer-qr-box {
                width: min(200px, 62vw);

                aspect-ratio: 1 / 1;

                display: grid;

                place-items: center;

                margin: 22px auto 20px;

                padding: 10px;

                border: 1px solid #E9DED1;

                border-radius: 14px;

                background: #FFFFFF;

                overflow: hidden;
            }

            .customer-qr-box svg {
                display: block;

                width: 100%;

                height: 100%;

                max-width: 100%;

                max-height: 100%;

                object-fit: contain;
            }


            /* =========================================================
   MEMBER INFO
========================================================= */

            .customer-qr-member-code {
                color: #4B2D1C;

                font-size: 28px;

                line-height: 1.2;

                font-weight: 700;

                letter-spacing: .04em;
            }

            .customer-qr-member-name {
                margin-top: 5px;

                color: #6F5D50;

                font-size: 13px;
            }

            .customer-qr-point {
                margin-top: 18px;

                padding: 13px;

                border-radius: 12px;

                background: #FBF2E6;

                color: #171311;

                font-size: 18px;
            }

            .customer-qr-description {
                margin-top: 14px;

                color: #8B796B;

                font-size: 11px;

                line-height: 1.6;
            }


            /* =========================================================
   QR MODAL - MOBILE
========================================================= */

            @media (max-width: 480px) {

                .customer-qr-modal {
                    width: calc(100vw - 24px);

                    max-height: 88vh;

                    border-radius: 18px;
                }

                .customer-qr-modal-content {
                    padding: 20px 14px 22px;
                }

                .customer-qr-modal-close {
                    top: 12px;

                    right: 12px;

                    width: 34px;

                    height: 34px;
                }

                .customer-qr-modal-brand {
                    margin-top: 24px;

                    font-size: 19px;
                }

                .customer-qr-modal-subtitle {
                    font-size: 11px;
                }

                .customer-qr-box {
                    width: min(170px, 52vw);

                    margin-top: 18px;

                    padding: 8px;
                }

                .customer-qr-member-code {
                    font-size: 23px;
                }

                .customer-qr-member-name {
                    font-size: 12px;
                }

                .customer-qr-point {
                    margin-top: 14px;

                    font-size: 16px;
                }

                .customer-qr-description {
                    font-size: 10px;
                }

            }


            /* =========================================================
   QR MODAL - VERY SMALL MOBILE
========================================================= */

            @media (max-width: 360px) {

                .customer-qr-box {
                    width: 145px;

                    padding: 7px;
                }

                .customer-qr-member-code {
                    font-size: 21px;
                }

            }
            </style>

            <div class="customer-dashboard">

                {{-- GREETING --}}
                <div class="customer-greeting">

                    <h1>
                        {{ $greeting }}, {{ $name }} 👋
                    </h1>

                    <p>
                        Selamat datang kembali di SAÉ Cafe!
                    </p>

                </div>


                {{-- TOP --}}
                <div class="customer-top">

                    {{-- MEMBER --}}
                    <section class="customer-member-area">

                        <div class="customer-member-card">

                            <div class="customer-member-label">
                                Member ID
                            </div>

                            <div class="customer-member-code">
                                {{ $memberCode }}
                            </div>

                            <div class="customer-member-point">

                                <strong>
                                    {{ number_format($point, 0, ',', '.') }}
                                </strong>

                                <span>
                                    POINT
                                </span>

                            </div>

                            <div class="customer-member-help">
                                Terus kumpulkan point dan
                                tukarkan dengan reward menarik.
                            </div>

                            <button type="button" class="customer-member-qr"
                                onclick="document.getElementById('customerQrModal').showModal()"
                                aria-label="Tampilkan QR Member">
                                {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                                ->size(100)
                                ->margin(1)
                                ->generate($customer->qr_code) !!}
                            </button>

                            <img class="customer-member-coffee" src="{{ asset('images/kopi.png') }}" alt="SAÉ Coffee"
                                onerror="this.style.display='none'">

                        </div>

                        <div class="customer-point-rule">

                            <span>
                                Setiap Rp 10.000 pembelanjaan
                                = 1 Point
                            </span>

                            <strong>
                                ★
                            </strong>

                        </div>

                    </section>


                    {{-- REWARD --}}
                    <section class="customer-section">

                        <div class="customer-section-head">

                            <h2 class="customer-section-title">
                                Reward Favorite
                            </h2>

                            <a class="customer-section-link customer-see-all" href="{{ route('customer.reward') }}">
                                Lihat Semua
                            </a>

                        </div>

                        <div class="customer-reward-grid">

                            @forelse($favorites as $reward)

                            <article class="customer-reward-card">

                                <div class="customer-reward-img">

                                    @if($reward->image_path)

                                    <img src="{{ '/storage/'.ltrim($reward->image_path, '/') }}"
                                        alt="{{ $reward->reward_name }}" onerror="
                                        this.style.display='none';
                                        this.nextElementSibling.style.display='block';
                                    ">

                                    @endif

                                    <div class="customer-reward-placeholder"
                                        style="{{ $reward->image_path ? 'display:none' : '' }}">
                                        🎁
                                    </div>

                                </div>

                                <div class="customer-reward-body">

                                    <div class="customer-reward-name">
                                        {{ $reward->reward_name }}
                                    </div>

                                    <div class="customer-reward-point">
                                        ★
                                        <b>
                                            {{ number_format((int)$reward->point_required, 0, ',', '.') }}
                                        </b>
                                        Point
                                    </div>

                                    @if((int) $customer->saldo_point >= (int) $reward->point_required)

                                    <a href="{{ route('customer.reward') }}" class="customer-reward-cta">
                                        Tukarkan Sekarang
                                    </a>

                                    @else

                                    <button type="button" class="customer-reward-cta customer-reward-cta-disabled"
                                        disabled>
                                        Tukarkan Sekarang
                                    </button>

                                    @endif
                                </div>

                            </article>

                            @empty

                            <div style="
                            grid-column:1/-1;
                            color:#8b796b;
                            font-size:10px;
                            padding:20px 0;
                        ">
                                Belum ada reward tersedia.
                            </div>

                            @endforelse

                        </div>

                    </section>

                </div>


                {{-- BOTTOM --}}
                <div class="customer-bottom">

                    {{-- ACTIVITY --}}
                    <section class="customer-section">

                        <div class="customer-section-head">

                            <h2 class="customer-section-title">
                                Aktivitas Terbaru
                            </h2>

                            <a class="customer-section-link customer-see-all"
                                href="{{ route('customer.transaction') }}">
                                Lihat Semua
                            </a>

                        </div>


                        <div class="customer-activity-list">

                            @forelse($pointHistory as $history)

                            @php
                            $isMinus = $history->type === 'kurang';
                            @endphp


                            <div class="customer-activity-row">


                                {{-- ICON --}}

                                <div class="
                    customer-activity-icon
                    {{ $isMinus ? 'minus' : 'plus' }}
                ">

                                    @if($isMinus)

                                    {{-- ICON REDEMPTION --}}

                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M20 12v8a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-8" />
                                        <path d="M2 7h20v5H2z" />
                                        <path d="M12 7v14" />
                                        <path d="M12 7H7.5a2.5 2.5 0 1 1 0-5C10 2 12 7 12 7Z" />
                                        <path d="M12 7h4.5a2.5 2.5 0 1 0 0-5C14 2 12 7 12 7Z" />
                                    </svg>

                                    @else

                                    {{-- ICON TRANSAKSI --}}

                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <rect x="5" y="3" width="14" height="18" rx="2" />
                                        <path d="M9 7h6" />
                                        <path d="M9 11h6" />
                                        <path d="M9 15h4" />
                                        <path d="M9 18h3" />
                                    </svg>

                                    @endif

                                </div>


                                {{-- DETAIL --}}

                                <div class="customer-activity-main">

                                    <div class="customer-activity-title">
                                        {{ $history->keterangan }}
                                    </div>

                                    <div class="customer-activity-date">
                                        {{ optional($history->created_at)->format('d F Y • H:i') }}
                                    </div>

                                </div>


                                {{-- POINT --}}

                                <div class="
                    customer-activity-point
                    {{ $isMinus ? 'customer-minus' : 'customer-plus' }}
                ">

                                    {{ $isMinus ? '-' : '+' }}

                                    {{ number_format(
                        (int) $history->point,
                        0,
                        ',',
                        '.'
                    ) }}

                                    Point

                                </div>

                            </div>

                            @empty

                            <div class="
                customer-activity-empty
            ">
                                Belum ada aktivitas point.
                            </div>

                            @endforelse

                        </div>

                    </section>


                    {{-- ABOUT --}}
                    <aside class="customer-section customer-about">

                        <h3>
                            Tentang Point
                        </h3>

                        <ul>

                            <li>
                                1 Point didapat dari setiap
                                pembelanjaan Rp10.000.
                            </li>

                            <li>
                                Point dapat ditukarkan dengan
                                berbagai reward menarik.
                            </li>

                            <li>
                                Point tidak dapat diuangkan.
                            </li>

                            <li>
                                QR Code reward hanya dapat
                                digunakan 1 kali.
                            </li>

                        </ul>

                    </aside>

                </div>

            </div>
            <dialog id="customerQrModal" class="customer-qr-modal">

                <div class="customer-qr-modal-content">

                    {{-- TOMBOL CLOSE --}}
                    <button type="button" class="customer-qr-modal-close"
                        onclick="document.getElementById('customerQrModal').close()" aria-label="Tutup">
                        ×
                    </button>


                    {{-- HEADER --}}
                    <div class="customer-qr-modal-brand">
                        SAÉ CAFE ROJEL
                    </div>

                    <div class="customer-qr-modal-subtitle">
                        MEMBER CARD
                    </div>


                    {{-- QR --}}
                    <div class="customer-qr-box">

                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                        ->size(180)
                        ->margin(1)
                        ->generate($customer->qr_code)
                        !!}

                    </div>


                    {{-- MEMBER CODE --}}
                    <div class="customer-qr-member-code">
                        {{ $memberCode }}
                    </div>

                    <div class="customer-qr-member-name">
                        {{ $name }}
                    </div>


                    {{-- POINT --}}
                    <div class="customer-qr-point">
                        <b>
                            {{ number_format($point,0,',','.') }} Point
                        </b>
                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="customer-qr-description">
                        Tunjukkan QR ini kepada kasir saat melakukan transaksi.
                    </div>

                </div>

            </dialog>
            @endsection