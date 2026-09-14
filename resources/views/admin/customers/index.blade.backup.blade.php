@extends('layouts.admin')

@section('title', 'Customer Management')

@section('content')

<div class="w-full min-w-0 space-y-6">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="min-w-0">
        <h1 class="text-2xl font-semibold text-gray-900 sm:text-3xl">
            Customer Management
        </h1>

        <p class="mt-1 text-sm text-gray-500 sm:text-base">
            Kelola data member Saé Cafe
        </p>
    </div>


    {{-- =========================================================
        SEARCH
    ========================================================== --}}
    <div class="w-full rounded-2xl bg-white p-4 shadow-sm sm:p-5">

        <form method="GET" action="{{ route('admin.customers.index') }}" x-data class="w-full">

            <label for="customer-search" class="sr-only">
                Cari customer
            </label>

            <input id="customer-search" type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari nama, nomor HP, atau member code..." @input.debounce.500ms="$el.form.submit()" class="
                    block
                    w-full
                    rounded-xl
                    border
                    border-gray-200
                    bg-white
                    px-4
                    py-3
                    text-sm
                    text-gray-900
                    outline-none
                    transition
                    placeholder:text-gray-400
                    focus:border-[#4A2E1F]
                    focus:ring-2
                    focus:ring-[#4A2E1F]/10
                ">

        </form>

    </div>


    {{-- =========================================================
        DESKTOP / TABLET TABLE
        Mulai md (>= 768px)
    ========================================================== --}}
    <div class="hidden w-full min-w-0 overflow-hidden rounded-2xl bg-white shadow-sm md:block">

        <div class="w-full overflow-x-auto">

            <table class="w-full min-w-[680px] text-sm">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left font-semibold text-gray-900">
                            Member Code
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-gray-900">
                            Nama
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-gray-900">
                            Nomor HP
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-gray-900">
                            Point
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-gray-900">
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($customers as $customer)

                    <tr class="border-b border-gray-100 last:border-b-0">

                        {{-- MEMBER CODE --}}
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                            {{ $customer->member_code }}
                        </td>


                        {{-- NAME --}}
                        <td class="px-6 py-4 font-medium text-gray-900">

                            <a href="{{ route('admin.customers.show', $customer->id_customer) }}"
                                class="transition hover:text-[#4A2E1F] hover:underline">
                                {{ $customer->nama }}
                            </a>

                        </td>


                        {{-- PHONE --}}
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                            {{ $customer->nomor_hp }}
                        </td>


                        {{-- POINT --}}
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                            {{ number_format($customer->saldo_point) }}
                        </td>


                        {{-- STATUS --}}
                        <td class="px-6 py-4 whitespace-nowrap">

                            <span class="
                                        inline-flex
                                        rounded-full
                                        px-3
                                        py-1
                                        text-xs
                                        font-medium
                                        {{ $customer->status_member == 'aktif'
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-red-100 text-red-700'
                                        }}
                                    ">
                                {{ ucfirst($customer->status_member) }}
                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-500">
                            Belum ada data customer.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =========================================================
    MOBILE CUSTOMER CARDS
    Hanya muncul < 768px
========================================================== --}}
    <div class="space-y-3 md:hidden">

        @forelse($customers as $customer)

        <article class="
                w-full
                min-w-0
                rounded-2xl
                border
                border-gray-200
                bg-white
                p-4
                shadow-sm
            ">

            {{-- HEADER --}}
            <div class="flex items-center justify-between gap-3">

                <div class="min-w-0">
                    <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">
                        Member Code
                    </p>

                    <p class="mt-0.5 truncate text-sm font-semibold text-gray-900">
                        {{ $customer->member_code }}
                    </p>
                </div>

                <span class="
                        inline-flex
                        shrink-0
                        rounded-full
                        px-2.5
                        py-1
                        text-[11px]
                        font-medium
                        {{ $customer->status_member == 'aktif'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-700'
                        }}
                    ">
                    {{ ucfirst($customer->status_member) }}
                </span>

            </div>


            {{-- CUSTOMER NAME --}}
            <div class="mt-4">

                <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">
                    Nama
                </p>

                <a href="{{ route('admin.customers.show', $customer->id_customer) }}" class="
                        mt-0.5
                        block
                        break-words
                        text-[15px]
                        font-semibold
                        leading-5
                        text-gray-900
                        transition
                        hover:text-[#4A2E1F]
                    ">
                    {{ $customer->nama }}
                </a>

            </div>


            {{-- CONTACT + POINT --}}
            <div class="mt-3 grid grid-cols-2 gap-4">

                <div class="min-w-0">

                    <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">
                        Nomor HP
                    </p>

                    <p class="mt-0.5 break-all text-sm font-medium text-gray-800">
                        {{ $customer->nomor_hp }}
                    </p>

                </div>


                <div class="min-w-0">

                    <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">
                        Saldo Point
                    </p>

                    <div class="mt-0.5 flex items-baseline gap-1.5">

                        <span class="text-base font-bold text-[#4A2E1F]">
                            {{ number_format($customer->saldo_point) }}
                        </span>

                        <span class="text-[11px] font-medium text-gray-500">
                            Point
                        </span>

                    </div>

                </div>

            </div>


            {{-- ACTION --}}
            <div class="mt-4">

                <a href="{{ route('admin.customers.show', $customer->id_customer) }}" class="
                        block
                        w-full
                        rounded-xl
                        bg-[#4A2E1F]
                        px-4
                        py-2.5
                        text-center
                        text-sm
                        font-semibold
                        text-white
                        transition
                        hover:bg-[#3A2117]
                        active:scale-[0.99]
                    ">
                    Lihat Detail
                </a>

            </div>

        </article>

        @empty

        <div class="
                rounded-2xl
                border
                border-gray-200
                bg-white
                px-4
                py-10
                text-center
                text-sm
                text-gray-500
            ">
            Belum ada data customer.
        </div>

        @endforelse

    </div>


    {{-- =========================================================
        PAGINATION
    ========================================================== --}}
    <div class="w-full overflow-x-auto">
        {{ $customers->links() }}
    </div>

</div>

@endsection