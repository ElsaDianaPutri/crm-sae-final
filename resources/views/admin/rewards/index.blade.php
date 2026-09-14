@extends('layouts.admin')

@section('title', 'Reward Management')

@section('content')

<style>
/*
    |--------------------------------------------------------------------------
    | Reward Management - Unified Responsive Layout
    |--------------------------------------------------------------------------
    */

.reward-page {
    width: 100%;
    min-width: 0;
}

.reward-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
}

.reward-add-btn {
    flex: 0 0 auto;
}

.reward-summary {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
}

.reward-filter {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 220px 110px;
    align-items: center;
    gap: 12px;
}

.reward-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.reward-card {
    display: grid;
    grid-template-columns: 96px minmax(0, 1fr) auto;
    align-items: center;
    gap: 16px;
    width: 100%;
    min-width: 0;
    padding: 14px;
    border: 1px solid #e5ddd5;
    border-radius: 18px;
    background: #ffffff;
    box-shadow: 0 2px 10px rgba(52, 34, 23, 0.05);
}

.reward-image {
    width: 96px;
    height: 96px;
    flex-shrink: 0;
    overflow: hidden;
    border-radius: 14px;
    background: #f7efe5;
}

.reward-image img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.reward-main {
    min-width: 0;
}

.reward-title-row {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.reward-title {
    min-width: 0;
    flex: 1;
    margin: 0;
    color: #1f2937;
    font-size: 15px;
    line-height: 20px;
    font-weight: 700;
    overflow-wrap: anywhere;
}

.reward-status {
    flex-shrink: 0;
    white-space: nowrap;
    border-radius: 999px;
    padding: 4px 9px;
    font-size: 10px;
    line-height: 14px;
    font-weight: 600;
}

.reward-status.available {
    background: #dcfce7;
    color: #15803d;
}

.reward-status.unavailable {
    background: #fee2e2;
    color: #b91c1c;
}

.reward-description {
    margin-top: 6px;
    color: #6b7280;
    font-size: 12px;
    line-height: 17px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
}

.reward-meta {
    display: grid;
    grid-template-columns: repeat(2, minmax(90px, 1fr));
    gap: 10px;
    min-width: 210px;
}

.reward-meta-box {
    border-radius: 12px;
    background: #fbf7f2;
    padding: 10px 12px;
}

.reward-meta-label {
    margin: 0;
    color: #9ca3af;
    font-size: 10px;
    line-height: 14px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

.reward-meta-value {
    margin: 3px 0 0;
    font-size: 14px;
    line-height: 20px;
    font-weight: 700;
}

.reward-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
}

.reward-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 72px;
    border-radius: 12px;
    padding: 9px 12px;
    font-size: 12px;
    line-height: 16px;
    font-weight: 600;
    transition: 0.2s ease;
}

.reward-edit-btn {
    background: #4a2e1f;
    color: #ffffff;
}

.reward-edit-btn:hover {
    background: #3a2117;
}

.reward-delete-btn {
    border: 0;
    background: #ef4444;
    color: #ffffff;
    cursor: pointer;
}

.reward-delete-btn:hover {
    background: #dc2626;
}

.reward-empty {
    padding: 40px 20px;
    border: 1px solid #e5ddd5;
    border-radius: 18px;
    background: #ffffff;
    color: #6b7280;
    text-align: center;
    font-size: 14px;
}

/*
    |--------------------------------------------------------------------------
    | Tablet
    |--------------------------------------------------------------------------
    */

@media (max-width: 1024px) {
    .reward-summary {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .reward-filter {
        grid-template-columns: minmax(0, 1fr) 170px auto;
    }

    .reward-card {
        grid-template-columns: 84px minmax(0, 1fr);
        align-items: start;
    }

    .reward-image {
        width: 84px;
        height: 84px;
    }

    .reward-meta {
        grid-column: 2;
        min-width: 0;
    }

    .reward-actions {
        grid-column: 2;
    }
}

/*
    |--------------------------------------------------------------------------
    | Mobile
    |--------------------------------------------------------------------------
    */

@media (max-width: 767px) {
    .reward-header {
        flex-direction: column;
        gap: 12px;
    }

    .reward-add-btn {
        width: 100%;
    }

    .reward-summary {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .reward-filter {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .reward-filter>* {
        width: 100%;
    }

    .reward-card {
        grid-template-columns: 80px minmax(0, 1fr);
        align-items: start;
        gap: 12px;
        padding: 10px;
        border-radius: 16px;
    }

    .reward-image {
        width: 80px;
        height: 80px;
        border-radius: 12px;
    }

    .reward-title-row {
        gap: 6px;
    }

    .reward-title {
        font-size: 13px;
        line-height: 17px;
    }

    .reward-status {
        padding: 3px 7px;
        font-size: 9px;
        line-height: 13px;
    }

    .reward-description {
        margin-top: 5px;
        font-size: 11px;
        line-height: 15px;
    }

    .reward-meta {
        grid-column: 1 / -1;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        min-width: 0;
        gap: 8px;
    }

    .reward-meta-box {
        padding: 9px 10px;
    }

    .reward-meta-value {
        font-size: 13px;
        line-height: 18px;
    }

    .reward-actions {
        grid-column: 1 / -1;
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        width: 100%;
        gap: 8px;
    }

    .reward-action-btn {
        width: 100%;
        min-width: 0;
        padding: 9px 10px;
    }
}

/*
    |--------------------------------------------------------------------------
    | Very Small Phones
    |--------------------------------------------------------------------------
    */

@media (max-width: 380px) {
    .reward-card {
        grid-template-columns: 72px minmax(0, 1fr);
    }

    .reward-image {
        width: 72px;
        height: 72px;
    }

    .reward-title {
        font-size: 12px;
    }

    .reward-description {
        font-size: 10px;
    }
}
</style>


<div class="reward-page space-y-6">

    {{-- ======================================================
        HEADER
    ======================================================= --}}
    <div class="reward-header">

        <div class="min-w-0">
            <h1 class="text-2xl font-semibold text-gray-900 sm:text-3xl">
                Reward Management
            </h1>

            <p class="mt-1 text-sm text-gray-500 sm:text-base">
                Kelola hadiah dan penukaran point member Saé Cafe
            </p>
        </div>


        <a href="{{ route('admin.rewards.create') }}" class="
                reward-add-btn
                inline-flex
                items-center
                justify-center
                rounded-xl
                bg-[#4A2E1F]
                px-5
                py-3
                text-sm
                font-semibold
                text-white
                transition
                hover:bg-[#5B3927]
            ">
            + Tambah Reward
        </a>

    </div>


    {{-- ======================================================
        SUMMARY
    ======================================================= --}}
    <div class="reward-summary">

        <div class="rounded-2xl border border-[#EADFD2] bg-white
p-4 shadow-sm sm:p-5">
            <p class="text-sm text-gray-400">
                Total Reward
            </p>

            <p class="mt-2 text-2xl font-semibold text-gray-900">
                {{ $totalReward }}
            </p>
        </div>

        <div class="rounded-2xl border border-[#EADFD2] bg-white
p-4 shadow-sm sm:p-5">
            <p class="text-sm text-gray-400">
                Reward Tersedia
            </p>

            <p class="mt-2 text-2xl font-semibold text-gray-900">
                {{ $rewardTersedia }}
            </p>
        </div>


        <div class="rounded-2xl border border-[#EADFD2] bg-white
p-4 shadow-sm sm:p-5">
            <p class="text-sm text-gray-400">
                Tidak Tersedia
            </p>

            <p class="mt-2 text-2xl font-semibold text-gray-900">
                {{ $rewardTidakTersedia }}
            </p>
        </div>


        <div class="rounded-2xl border border-[#EADFD2] bg-white
p-4 shadow-sm sm:p-5">
            <p class="text-sm text-gray-400">
                Total Stock
            </p>

            <p class="mt-2 text-2xl font-semibold text-gray-900">
                {{ number_format($totalStock) }}
            </p>
        </div>

    </div>


    {{-- ======================================================
    SEARCH + FILTER
======================================================= --}}
    <div class="w-full rounded-2xl bg-white p-4 shadow-sm sm:p-5">

        <form id="reward-filter-form" method="GET" action="{{ route('admin.rewards.index') }}" class="reward-filter">

            {{-- SEARCH --}}
            <div class="min-w-0">
                <input id="reward-search" type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari reward..." autocomplete="off" class="
                    block
                    h-12
                    w-full
                    rounded-xl
                    border
                    border-gray-200
                    bg-white
                    px-4
                    text-sm
                    text-gray-900
                    outline-none
                    transition
                    placeholder:text-gray-400
                    focus:border-[#4A2E1F]
                    focus:ring-2
                    focus:ring-[#4A2E1F]/10
                ">
            </div>


            {{-- STATUS --}}
            <div class="min-w-0">
                <select id="reward-status" name="status" class="
                    block
                    h-12
                    w-full
                    rounded-xl
                    border
                    border-gray-200
                    bg-white
                    px-4
                    text-sm
                    text-gray-900
                    outline-none
                    transition
                    focus:border-[#4A2E1F]
                    focus:ring-2
                    focus:ring-[#4A2E1F]/10
                ">
                    <option value="">
                        Semua
                    </option>

                    <option value="tersedia" @selected(request('status')==='tersedia' )>
                        Tersedia
                    </option>

                    <option value="tidak_tersedia" @selected(request('status')==='tidak_tersedia' )>
                        Tidak Tersedia
                    </option>
                </select>
            </div>


            {{-- BUTTON --}}
            <div class="min-w-0">

                <button type="submit" class="
                    inline-flex
                    h-12
                    w-full
                    items-center
                    justify-center
                    rounded-xl
                    bg-[#4A2E1F]
                    px-6
                    text-sm
                    font-semibold
                    text-white
                    transition
                    hover:bg-[#3A2117]
                ">
                    Cari
                </button>

            </div>


            {{-- RESET --}}
            @if(request()->filled('search') || request()->filled('status'))

            <div class="min-w-0">

                <a href="{{ route('admin.rewards.index') }}" class="
                        inline-flex
                        h-12
                        w-full
                        items-center
                        justify-center
                        rounded-xl
                        border
                        border-gray-200
                        bg-white
                        px-6
                        text-sm
                        font-semibold
                        text-gray-700
                        transition
                        hover:bg-gray-50
                    ">
                    Reset
                </a>

            </div>

            @endif

        </form>


        {{-- HASIL FILTER --}}
        @if(request()->filled('search') || request()->filled('status'))

        <div class="mt-3 flex flex-col gap-1 text-xs text-gray-500 sm:flex-row sm:items-center sm:justify-between">

            <p>
                Menampilkan
                <span class="font-semibold text-gray-900">
                    {{ $rewards->total() }}
                </span>
                reward
            </p>

            <a href="{{ route('admin.rewards.index') }}" class="font-medium text-[#4A2E1F] hover:underline">
                Hapus filter
            </a>

        </div>

        @endif

    </div>


    {{-- ======================================================
        REWARD LIST
        SATU MARKUP UNTUK DESKTOP / TABLET / MOBILE
    ======================================================= --}}
    <div class="reward-list">

        @forelse($rewards as $reward)

        <article class="reward-card">

            {{-- IMAGE --}}
            <div class="reward-image">

                @if($reward->image_path)

                <img src="{{ asset('storage/' . $reward->image_path) }}" alt="{{ $reward->reward_name }}"
                    loading="lazy">

                @else

                <div class="flex h-full w-full items-center justify-center text-3xl">
                    🎁
                </div>

                @endif

            </div>


            {{-- MAIN INFORMATION --}}
            <div class="reward-main">

                <div class="reward-title-row">

                    <h2 class="reward-title">
                        {{ $reward->reward_name }}
                    </h2>


                    @if($reward->status === 'tersedia')

                    <span class="reward-status available">
                        Tersedia
                    </span>

                    @else

                    <span class="reward-status unavailable">
                        Tidak Tersedia
                    </span>

                    @endif

                </div>


                @if($reward->description)

                <p class="reward-description">
                    {{ $reward->description }}
                </p>

                @endif

            </div>


            {{-- POINT + STOCK --}}
            <div class="reward-meta">

                <div class="reward-meta-box">

                    <p class="reward-meta-label">
                        Point
                    </p>

                    <p class="reward-meta-value text-[#4A2E1F]">
                        {{ number_format($reward->point_required) }}
                    </p>

                </div>


                <div class="reward-meta-box">

                    <p class="reward-meta-label">
                        Stock
                    </p>

                    <p class="reward-meta-value text-gray-900">
                        {{ number_format($reward->stock) }}
                    </p>

                </div>

            </div>


            {{-- ACTIONS --}}
            <div class="reward-actions">

                <a href="{{ route('admin.rewards.edit', $reward->id_reward) }}"
                    class="reward-action-btn reward-edit-btn">
                    Edit
                </a>


                <form method="POST" action="{{ route('admin.rewards.destroy', $reward->id_reward) }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" onclick="return confirm('Hapus reward ini?')"
                        class="reward-action-btn reward-delete-btn">
                        Hapus
                    </button>
                </form>

            </div>

        </article>

        @empty

        <div class="reward-empty">
            Belum ada reward.
        </div>

        @endforelse

    </div>


    {{-- ======================================================
        PAGINATION
    ======================================================= --}}
    <div class="w-full overflow-x-auto">
        {{ $rewards->links() }}
    </div>

</div>


{{-- ==========================================================
    LIVE SEARCH
=========================================================== --}}
<script>
document.addEventListener('DOMContentLoaded', function() {

    const form = document.getElementById('reward-filter-form');
    const searchInput = document.getElementById('reward-search');
    const statusInput = document.getElementById('reward-status');

    if (!form || !searchInput || !statusInput) {
        return;
    }

    let timer = null;

    searchInput.addEventListener('input', function() {

        clearTimeout(timer);

        timer = setTimeout(function() {
            form.requestSubmit();
        }, 450);

    });


    statusInput.addEventListener('change', function() {
        form.requestSubmit();
    });

});
</script>

@endsection