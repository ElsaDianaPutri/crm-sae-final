<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Sae Cafe CRM')
    </title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    /* =========================
           SIDEBAR
        ========================= */

    .admin-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;

        width: 18rem;

        background: #0D0D0D;
        color: #fff;

        display: flex;
        flex-direction: column;

        z-index: 1000;

        transition: transform .3s ease;
    }

    .admin-sidebar.mobile-closed {
        transform: translateX(-100%);
    }

    @media (min-width: 1024px) {
        .admin-sidebar {
            transform: translateX(0) !important;
        }
    }

    @media (max-width: 1023px) {
        .admin-sidebar {
            transform: translateX(-100%);
        }

        .admin-sidebar.mobile-open {
            transform: translateX(0);
        }
    }

    .admin-overlay {
        display: none;
    }

    @media (max-width: 1023px) {
        .admin-overlay.active {
            display: block;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            z-index: 999;
        }
    }

    /* =========================================================
   ADMIN LAYOUT
   HEADER TETAP, CONTENT YANG SCROLL
========================================================= */

    html,
    body {
        width: 100%;
        height: 100%;

        margin: 0;
        padding: 0;

        overflow: hidden;

        overscroll-behavior: none;
    }

    body {
        background: #FFF9F2;
    }


    /* =========================================================
   MAIN AREA
========================================================= */

    .admin-main {
        min-height: 100vh;
        height: 100vh;

        margin-left: 18rem;

        display: flex;
        flex-direction: column;

        overflow: hidden;
    }


    /* =========================================================
   ADMIN HEADER
========================================================= */

    .admin-header {
        flex: 0 0 80px;

        height: 80px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 0 20px;

        background: #000000;
        color: #FFFFFF;

        z-index: 20;
    }


    /* =========================================================
   ADMIN CONTENT
========================================================= */

    .admin-content {
        flex: 1 1 auto;

        min-height: 0;

        overflow-y: auto;
        overflow-x: hidden;

        padding: 16px;

        overscroll-behavior: contain;

        -webkit-overflow-scrolling: touch;
    }


    /* =========================================================
   DESKTOP CONTENT
========================================================= */

    @media (min-width: 768px) {

        .admin-content {
            padding: 20px;
        }

    }


    /* =========================================================
   MOBILE
========================================================= */

    @media (max-width: 1023px) {

        .admin-main {
            margin-left: 0;
        }

    }


    /* =========================================================
   MOBILE HEADER
========================================================= */

    @media (max-width: 767px) {

        .admin-header {
            flex: 0 0 68px;

            height: 68px;

            padding: 0 16px;
        }

        .admin-content {
            padding: 14px;
        }

    }
    </style>
</head>

<body x-data="{ sidebarOpen: false }" class="m-0 bg-[#FFF9F2]">

    {{-- OVERLAY MOBILE --}}
    <div class="admin-overlay" :class="{ 'active': sidebarOpen }" @click="sidebarOpen = false"></div>


    {{-- SIDEBAR --}}
    <aside class="admin-sidebar" :class="{
            'mobile-open': sidebarOpen
        }">

        {{-- LOGO --}}
        <div class="relative px-8 py-7 border-b border-white/10">

            <div class="flex items-center gap-3">

                <img src="{{ asset('assets/images/sae-logo.jpg') }}" alt="SAÉ Cafe Rojel"
                    class="w-12 h-12 rounded-full object-cover">

                <div>
                    <h1 class="text-lg font-semibold">
                        SAÉ CAFE
                    </h1>

                    <p class="text-xs text-[#D8A45D]">
                        ROJEL CRM
                    </p>
                </div>

            </div>

            {{-- CLOSE MOBILE --}}
            <button type="button" @click="sidebarOpen = false" class="
                    absolute
                    top-6
                    right-6
                    text-3xl
                    leading-none
                    lg:hidden
                " aria-label="Tutup menu">
                ×
            </button>

        </div>


        {{-- MENU --}}
        <nav class="flex-1 px-5 py-8 space-y-2 overflow-y-auto">

            {{-- DASHBOARD --}}
            <a href="{{ route('admin.dashboard') }}" @click="sidebarOpen = false" class="
                    flex items-center gap-3
                    rounded-xl
                    px-5 py-3
                    text-white
                    transition
                    {{ request()->routeIs('admin.dashboard')
                        ? 'bg-[#4A2E1F]'
                        : 'hover:bg-white/10'
                    }}
                ">
                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.5 9.5V21h13V9.5" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.5 21v-6h5v6" />
                </svg>

                <span>Dashboard</span>
            </a>


            {{-- CUSTOMER --}}
            <a href="{{ route('admin.customers.index') }}" @click="sidebarOpen = false" class="
                    flex items-center gap-3
                    rounded-xl
                    px-5 py-3
                    text-white
                    transition
                    {{ request()->routeIs('admin.customers.*')
                        ? 'bg-[#4A2E1F]'
                        : 'hover:bg-white/10'
                    }}
                ">
                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="10" cy="7" r="3" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 21v-2a4 4 0 0 0-3-3.87" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 4.13a3 3 0 0 1 0 5.74" />
                </svg>

                <span>Customer</span>
            </a>


            {{-- REWARD --}}
            <a href="{{ route('admin.rewards.index') }}" @click="sidebarOpen = false" class="
                    flex items-center gap-3
                    rounded-xl
                    px-5 py-3
                    text-white
                    transition
                    {{ request()->routeIs('admin.rewards.*')
                        ? 'bg-[#4A2E1F]'
                        : 'hover:bg-white/10'
                    }}
                ">
                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="8" width="18" height="12" rx="2" />
                    <path d="M12 8v12" />
                    <path d="M3 12h18" />
                    <path
                        d="M7.5 8C6.12 8 5 6.88 5 5.5S6.12 3 7.5 3c2.25 0 4.5 5 4.5 5s2.25-5 4.5-5C17.88 3 19 4.12 19 5.5S17.88 8 16.5 8" />
                </svg>

                <span>Reward</span>
            </a>


            {{-- TRANSACTION --}}
            <a href="{{ route('admin.transactions.index') }}" @click="sidebarOpen = false" class="
                    flex items-center gap-3
                    rounded-xl
                    px-5 py-3
                    text-white
                    transition
                    {{ request()->routeIs('admin.transactions.*')
                        ? 'bg-[#4A2E1F]'
                        : 'hover:bg-white/10'
                    }}
                ">
                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 3h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" />
                    <path d="M8 7h8M8 11h8M8 15h5" />
                </svg>

                <span>Transaction</span>
            </a>


            {{-- REDEMPTION --}}
            <a href="{{ route('admin.redemptions.index') }}" @click="sidebarOpen = false" class="
                    flex items-center gap-3
                    rounded-xl
                    px-5 py-3
                    text-white
                    transition
                    {{ request()->routeIs('admin.redemptions.*')
                        ? 'bg-[#4A2E1F]'
                        : 'hover:bg-white/10'
                    }}
                ">
                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4z" />
                    <path d="M14 14h2v2h-2zM18 14h2v2h-2zM14 18h2v2h-2zM18 18h2v2h-2z" />
                </svg>

                <span>Redemption</span>
            </a>


            {{-- POINT HISTORY --}}
            <a href="{{ route('admin.point-history.index') }}" @click="sidebarOpen = false" class="
                    flex items-center gap-3
                    rounded-xl
                    px-5 py-3
                    text-white
                    transition
                    {{ request()->routeIs('admin.point-history.*')
                        ? 'bg-[#4A2E1F]'
                        : 'hover:bg-white/10'
                    }}
                ">
                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M3 12a9 9 0 1 0 3-6.7" />
                    <path d="M3 4v6h6" />
                    <path d="M12 7v5l3 2" />
                </svg>

                <span>Point History</span>
            </a>

        </nav>


        {{-- LOGOUT --}}
        <div class="p-5 border-t border-white/10">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="
                        w-full
                        py-3
                        rounded-xl
                        bg-white/10
                        hover:bg-white/20
                        transition
                    ">
                    Logout
                </button>

            </form>

        </div>

    </aside>


    {{-- ======================================================
        MAIN
    ======================================================= --}}
    <main class="admin-main">

        {{-- HEADER --}}
        <header class="admin-header">

            {{-- MOBILE BUTTON --}}
            <button type="button" @click="sidebarOpen = true" class="
                    lg:hidden
                    text-2xl
                " aria-label="Buka menu">
                ☰
            </button>


            {{-- TITLE --}}
            <div>

                <h2 class="
                        text-lg
                        md:text-xl
                        font-semibold
                    ">
                    SAÉ CAFE ROJEL
                </h2>

                <p class="text-xs text-gray-400">
                    Management Dashboard
                </p>

            </div>


            {{-- PROFILE --}}
            <div class="flex items-center gap-3">

                <div class="hidden md:block text-right">

                    <p class="font-medium">
                        Admin
                    </p>

                    <p class="text-xs text-gray-400">
                        Administrator
                    </p>

                </div>

                <div class="
                        w-10
                        h-10
                        rounded-full

                        bg-[#D8A45D]
                        text-black

                        flex
                        items-center
                        justify-center

                        font-semibold
                    ">
                    A
                </div>

            </div>

        </header>


        {{-- CONTENT --}}
        <section class="admin-content">

            {{-- SUCCESS --}}
            @if(session('success'))

            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition class="
                        mb-6
                        bg-green-100
                        border
                        border-green-200
                        text-green-700
                        px-5
                        py-3
                        rounded-xl
                        flex
                        items-center
                        justify-between
                        gap-3
                    ">

                <div class="flex items-center gap-3">

                    <span class="text-lg">
                        ✓
                    </span>

                    <p class="text-sm font-medium">
                        {{ session('success') }}
                    </p>

                </div>

                <button type="button" @click="show = false" class="text-green-700">
                    ✕
                </button>

            </div>

            @endif


            {{-- ERROR --}}
            @if(session('error'))

            <div class="
                        mb-6
                        bg-red-100
                        border
                        border-red-200
                        text-red-700
                        px-5
                        py-3
                        rounded-xl
                    ">
                {{ session('error') }}
            </div>

            @endif


            @yield('content')

        </section>

    </main>


    {{-- ======================================================
        FORCE SIDEBAR DESKTOP
    ======================================================= --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        const sidebar = document.querySelector('.admin-sidebar');

        if (!sidebar) {
            return;
        }

        function syncSidebar() {

            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('mobile-closed');
                sidebar.classList.add('mobile-open');
            } else {

                if (!document.body.__sidebarOpened) {
                    sidebar.classList.remove('mobile-open');
                }

            }

        }

        syncSidebar();

        window.addEventListener(
            'resize',
            syncSidebar
        );

    });
    </script>

</body>

</html>