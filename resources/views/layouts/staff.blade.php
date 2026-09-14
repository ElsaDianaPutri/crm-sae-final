<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'SAÉ CAFE ROJEL CRM - Staff')
    </title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
    /* =====================================================
           GLOBAL
        ====================================================== */

    html,
    body {
        margin: 0;
        padding: 0;

        width: 100%;
        height: 100%;

        background: #F7F3ED;

        font-family: 'Poppins', sans-serif;

        overflow: hidden;

        overscroll-behavior: none;
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }


    /* =====================================================
           SIDEBAR
           SATU MARKUP UNTUK DESKTOP + MOBILE
        ====================================================== */

    .staff-sidebar {
        position: fixed;

        top: 0;
        left: 0;
        bottom: 0;

        width: 18rem;

        background: #0D0D0D;
        color: #FFFFFF;

        display: flex;
        flex-direction: column;

        z-index: 1000;

        transform: translateX(0);

        transition:
            transform .3s ease;
    }


    /* DESKTOP */

    @media (min-width: 1024px) {

        .staff-sidebar {
            transform: translateX(0) !important;
        }

    }


    /* MOBILE / TABLET */

    @media (max-width: 1023px) {

        .staff-sidebar {
            transform: translateX(-100%);
        }

        .staff-sidebar.mobile-open {
            transform: translateX(0);
        }

    }


    /* =====================================================
           OVERLAY
        ====================================================== */

    .staff-overlay {
        display: none;
    }

    @media (max-width: 1023px) {

        .staff-overlay.active {
            display: block;

            position: fixed;

            inset: 0;

            background:
                rgba(0, 0, 0, .5);

            z-index: 999;
        }

    }


    /* =====================================================
           SIDEBAR CLOSE
        ====================================================== */

    .staff-close {
        display: none;
    }

    @media (max-width: 1023px) {

        .staff-close {
            display: block;
        }

    }


    /* =====================================================
           MAIN
           TINGGI SATU VIEWPORT
        ====================================================== */

    .staff-main {
        width: calc(100% - 18rem);
        height: 100vh;

        margin-left: 18rem;

        display: flex;
        flex-direction: column;

        background: #F7F3ED;

        overflow: hidden;
    }


    /* =====================================================
           HEADER
           HEADER TIDAK IKUT SCROLL
        ====================================================== */

    .staff-header {
        flex: 0 0 5rem;

        width: 100%;
        height: 5rem;

        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 0 2rem;

        background: #000000;
        color: #FFFFFF;

        z-index: 50;
    }


    /* =====================================================
           HEADER LEFT
        ====================================================== */

    .staff-header-left {
        display: flex;
        align-items: center;

        gap: 12px;

        min-width: 0;
    }


    .staff-header-title {
        font-size: 1.25rem;
        line-height: 1.4;

        font-weight: 600;

        color: #FFFFFF;
    }


    .staff-header-subtitle {
        margin-top: 2px;

        font-size: .75rem;

        color: #9CA3AF;
    }


    /* =====================================================
           BURGER
        ====================================================== */

    .staff-menu-button {
        display: none;

        align-items: center;
        justify-content: center;

        width: 42px;
        height: 42px;

        flex-shrink: 0;

        border: 0;
        border-radius: 10px;

        background:
            rgba(255, 255, 255, .08);

        color: #FFFFFF;

        cursor: pointer;
    }


    .staff-menu-button:hover {
        background:
            rgba(255, 255, 255, .15);
    }


    .staff-menu-button svg {
        width: 22px;
        height: 22px;
    }


    @media (max-width: 1023px) {

        .staff-menu-button {
            display: inline-flex;
        }

    }


    /* =====================================================
           PROFILE
        ====================================================== */

    .staff-header-profile {
        flex-shrink: 0;

        text-align: right;
    }


    .staff-header-name {
        font-size: .9rem;

        font-weight: 600;

        color: #FFFFFF;
    }


    .staff-header-role {
        margin-top: 2px;

        font-size: .7rem;

        color: #9CA3AF;
    }


    /* =====================================================
           CONTENT
           SATU-SATUNYA BAGIAN YANG BOLEH SCROLL
        ====================================================== */

    .staff-content {
        flex: 1 1 auto;

        min-height: 0;
        min-width: 0;

        width: 100%;

        padding: 2rem 1.75rem 2.5rem;

        background: #F7F3ED;

        overflow-y: auto;
        overflow-x: hidden;

        overscroll-behavior-y: none;

        -webkit-overflow-scrolling: touch;
    }


    /* =====================================================
           FLASH
        ====================================================== */

    .staff-flash {
        margin-bottom: 1.5rem;

        padding: .8rem 1rem;

        border-radius: 12px;

        font-size: .8rem;
    }


    .staff-flash-success {
        background: #E9F7ED;

        color: #1F6B36;

        border:
            1px solid #CCEBD5;
    }


    .staff-flash-error {
        background: #FFF0F0;

        color: #A12727;

        border:
            1px solid #F0CACA;
    }


    /* =====================================================
           GLOBAL CARD
        ====================================================== */

    .card {
        background: #FFFFFF;

        border:
            1px solid #EADFD1;

        border-radius: 16px;

        box-shadow:
            0 10px 30px rgba(48, 31, 21, .05);
    }


    /* =====================================================
           TABLET
        ====================================================== */

    @media (max-width: 1023px) {

        .staff-main {
            width: 100%;

            margin-left: 0;
        }


        .staff-header {
            flex-basis: 4rem;

            height: 4rem;

            padding: 0 1rem;
        }


        .staff-content {
            padding:
                1.5rem 1.25rem 2rem;
        }

    }


    /* =====================================================
           MOBILE
        ====================================================== */

    @media (max-width: 640px) {

        .staff-sidebar {
            width: min(280px, 86vw);
        }


        .staff-header {
            flex-basis: 4rem;

            height: 4rem;

            padding: 0 .9rem;
        }


        .staff-header-profile {
            display: none;
        }


        .staff-header-title {
            font-size: 1rem;
        }


        .staff-header-subtitle {
            font-size: .65rem;
        }


        .staff-content {
            padding:
                1.25rem .9rem 1.75rem;
        }

    }


    /* =====================================================
           SCAN MEMBER MODAL
        ====================================================== */

    body.staff-scan-modal-open {
        overflow: hidden;
    }

    .staff-member-scan-modal {
        position: fixed;
        inset: 0;
        z-index: 5000;

        display: none;
        align-items: center;
        justify-content: center;

        padding: 20px;

        background: rgba(0, 0, 0, .62);
    }

    .staff-member-scan-modal.open {
        display: flex;
    }

    .staff-member-scan-modal-card {
        width: min(100%, 470px);

        padding: 24px;

        background: #FFFFFF;

        border-radius: 18px;

        box-shadow:
            0 25px 70px rgba(0, 0, 0, .30);
    }

    .staff-member-scan-modal-label {
        margin-bottom: 6px;

        color: #4B6B58;

        font-size: 11px;
        font-weight: 700;

        letter-spacing: .08em;
    }

    .staff-member-scan-modal-name {
        color: #171717;

        font-size: 21px;
        line-height: 28px;

        font-weight: 700;
    }

    .staff-member-scan-modal-meta {
        margin-top: 5px;

        color: #6B5D53;

        font-size: 12px;
        line-height: 18px;
    }

    .staff-member-scan-modal-text {
        margin-top: 18px;
        margin-bottom: 14px;

        color: #8D7B6D;

        font-size: 12px;
        line-height: 18px;
    }

    .staff-member-scan-modal-actions {
        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 10px;
    }

    .staff-member-scan-modal-action {
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

    .staff-member-scan-modal-action.primary {
        background: #4A2E1F;
        color: #FFFFFF;
    }

    .staff-member-scan-modal-action.secondary {
        background: #FFFFFF;
        color: #4A2E1F;
        border: 1px solid #D9C9BB;
    }

    .staff-member-scan-modal-close {
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

    @media (max-width: 640px) {

        .staff-member-scan-modal {
            padding: 14px;
        }

        .staff-member-scan-modal-card {
            padding: 20px;

            border-radius: 16px;
        }

        .staff-member-scan-modal-actions {
            grid-template-columns: 1fr;
        }

    }
    </style>


    @stack('styles')

</head>


<body>


    {{-- =====================================================
        MOBILE OVERLAY
    ====================================================== --}}

    <div id="staffOverlay" class="staff-overlay"></div>


    {{-- =====================================================
        SIDEBAR
    ====================================================== --}}

    <aside id="staffSidebar" class="staff-sidebar">

        {{-- BRAND --}}
        <div class="
                relative
                px-8
                py-7
                border-b
                border-white/10
            ">

            <div class="flex items-center gap-3">

                <img src="{{ asset('assets/images/sae-logo.jpg') }}" alt="SAÉ Cafe Rojel" class="
                        w-12
                        h-12
                        rounded-full
                        object-cover
                    ">

                <div>

                    <h1 class="text-lg font-semibold">
                        SAÉ CAFE
                    </h1>

                    <p class="text-xs text-[#D8A45D]">
                        ROJEL CRM • STAFF
                    </p>

                </div>

            </div>


            {{-- CLOSE MOBILE --}}
            <button id="staffClose" type="button" class="
                    staff-close
                    absolute
                    top-6
                    right-6
                    text-3xl
                    leading-none
                    text-white
                " aria-label="Tutup menu">
                ×
            </button>

        </div>


        {{-- MENU --}}
        <nav class="
                flex-1
                px-5
                py-8
                space-y-2
                overflow-y-auto
            ">

            {{-- DASHBOARD --}}
            <a href="{{ route('staff.dashboard') }}" class="
                    flex
                    items-center
                    gap-3
                    rounded-xl
                    px-5
                    py-3
                    text-white
                    transition
                    {{ request()->routeIs('staff.dashboard')
                        ? 'bg-[#4A2E1F]'
                        : 'hover:bg-white/10'
                    }}
                ">

                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="3" width="7" height="7" rx="1" />

                    <rect x="14" y="3" width="7" height="7" rx="1" />

                    <rect x="3" y="14" width="7" height="7" rx="1" />

                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>

                <span>
                    Dashboard
                </span>

            </a>


            {{-- MEMBER --}}
            <a href="{{ route('staff.customers') }}" class="
                    flex
                    items-center
                    gap-3
                    rounded-xl
                    px-5
                    py-3
                    text-white
                    transition
                    {{ request()->routeIs('staff.customers')
                        ? 'bg-[#4A2E1F]'
                        : 'hover:bg-white/10'
                    }}
                ">

                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M16 20v-1.5a4.5 4.5 0 0 0-4.5-4.5h-3A4.5 4.5 0 0 0 4 18.5V20" />

                    <circle cx="10" cy="7" r="3" />

                    <path d="M16 4.5a3 3 0 0 1 0 5.8" />

                    <path d="M17 14.3a4.5 4.5 0 0 1 3 4.2V20" />
                </svg>

                <span>
                    Member
                </span>

            </a>

            {{-- TRANSACTION --}}
            <a href="{{ route('staff.transactions') }}" class="
        flex
        items-center
        gap-3
        rounded-xl
        px-5
        py-3
        text-white
        transition
        {{ request()->routeIs('staff.transactions')
            ? 'bg-[#4A2E1F]'
            : 'hover:bg-white/10'
        }}
    ">
                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M5 4h14v16H5z" />

                    <path d="M8 8h8" />
                    <path d="M8 12h8" />
                    <path d="M8 16h5" />
                </svg>

                <span>
                    Transaction
                </span>
            </a>


            {{-- REWARD --}}
            <a href="{{ route('staff.rewards') }}" class="
                    flex
                    items-center
                    gap-3
                    rounded-xl
                    px-5
                    py-3
                    text-white
                    transition
                    {{ request()->routeIs('staff.rewards')
                        ? 'bg-[#4A2E1F]'
                        : 'hover:bg-white/10'
                    }}
                ">

                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M20 12v9H4v-9" />

                    <path d="M2 7h20v5H2z" />

                    <path d="M12 7v14" />

                    <path d="M12 7H7.5a2.5 2.5 0 1 1 0-5C10.5 2 12 7 12 7Z" />

                    <path d="M12 7h4.5a2.5 2.5 0 1 0 0-5C13.5 2 12 7 12 7Z" />
                </svg>

                <span>
                    Reward
                </span>

            </a>


            {{-- REDEEM --}}
            <a href="{{ route('staff.redemptions') }}" class="
                    flex
                    items-center
                    gap-3
                    rounded-xl
                    px-5
                    py-3
                    text-white
                    transition
                    {{ request()->routeIs('staff.redemptions')
                        ? 'bg-[#4A2E1F]'
                        : 'hover:bg-white/10'
                    }}
                ">

                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M5 4h14v16H5z" />

                    <path d="M8 8h8M8 12h8M8 16h5" />
                </svg>

                <span>
                    Redeem
                </span>

            </a>

        </nav>


        {{-- LOGOUT --}}
        <div class="
                p-5
                border-t
                border-white/10
            ">

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button type="submit" class="
                        w-full
                        py-3
                        rounded-xl
                        bg-white/10
                        hover:bg-white/20
                        transition
                        text-white
                    ">
                    Keluar
                </button>

            </form>

        </div>

    </aside>


    {{-- =====================================================
        MAIN
    ====================================================== --}}

    <main class="staff-main">


        {{-- =================================================
            HEADER
        ================================================== --}}

        <header class="staff-header">

            <div class="staff-header-left">

                {{-- BURGER MOBILE --}}
                <button id="staffMenu" type="button" class="staff-menu-button" aria-label="Buka menu">

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M4 6h16" />
                        <path d="M4 12h16" />
                        <path d="M4 18h16" />
                    </svg>

                </button>


                <div>

                    <div class="staff-header-title">
                        SAÉ CAFE ROJEL
                    </div>

                    <div class="staff-header-subtitle">
                        Operational Staff Dashboard
                    </div>

                </div>

            </div>


            {{-- PROFILE --}}
            <div class="staff-header-profile">

                <div class="staff-header-name">
                    {{ auth()->user()->username }}
                </div>

                <div class="staff-header-role">
                    Staff / Kasir
                </div>

            </div>

        </header>


        {{-- =================================================
            CONTENT
        ================================================== --}}

        <section class="staff-content">

            @if(session('success'))

            <div class="
                        staff-flash
                        staff-flash-success
                    ">
                ✓ {{ session('success') }}
            </div>

            @endif


            @if($errors->any())

            <div class="
                        staff-flash
                        staff-flash-error
                    ">
                {{ $errors->first() }}
            </div>

            @endif


            @yield('content')

        </section>

    </main>



    {{-- =====================================================
        MOBILE MENU
    ====================================================== --}}

    <script>
    (() => {

        const sidebar =
            document.getElementById('staffSidebar');

        const overlay =
            document.getElementById('staffOverlay');

        const menuButton =
            document.getElementById('staffMenu');

        const closeButton =
            document.getElementById('staffClose');


        function openSidebar() {

            sidebar?.classList.add(
                'mobile-open'
            );

            overlay?.classList.add(
                'active'
            );

            document.body.style.overflow =
                'hidden';
        }


        function closeSidebar() {

            sidebar?.classList.remove(
                'mobile-open'
            );

            overlay?.classList.remove(
                'active'
            );

            document.body.style.overflow =
                '';
        }


        menuButton?.addEventListener(
            'click',
            openSidebar
        );


        closeButton?.addEventListener(
            'click',
            closeSidebar
        );


        overlay?.addEventListener(
            'click',
            closeSidebar
        );


        document.addEventListener(
            'keydown',
            (event) => {

                if (event.key === 'Escape') {
                    closeSidebar();
                }

            }
        );


        window.addEventListener(
            'resize',
            () => {

                if (window.innerWidth >= 1024) {
                    closeSidebar();
                }

            }
        );

    })();
    </script>


    @stack('scripts')

</body>

</html>