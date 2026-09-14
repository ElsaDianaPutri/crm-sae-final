@extends('layouts.admin')

@section('title', 'Customer Detail')


@section('content')

<div class="space-y-6">


    <!-- HEADER -->

    <div class="flex justify-between items-start mb-6">

        <div>

            <h1 class="text-2xl font-semibold">
                Customer Detail
            </h1>

            <p class="text-gray-500 text-sm">
                Informasi lengkap member Saé Cafe
            </p>

        </div>


        <!-- Edit Button -->
        <div class="flex gap-3">

            <a href="{{ route('admin.customers.edit', $customer->id_customer) }}" class="
    inline-flex
    items-center
    gap-2
    px-4
    py-2
    rounded-xl
    bg-[#4A2E1F]
    text-white
    text-sm
    font-medium
    hover:bg-[#5b3927]
    transition
    ">

                ✎ Edit Customer

            </a>

            <!-- Delete Button -->

            <form action="{{ route('admin.customers.destroy', $customer->id_customer) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus customer ini?')">


                @csrf
                @method('DELETE')


                <button type="submit" class="
        inline-flex
        items-center
        gap-2
        px-4
        py-2
        rounded-xl
        bg-red-500
        text-white
        text-sm
        font-medium
        hover:bg-red-600
        transition
        ">

                    🗑 Hapus Customer

                </button>


            </form>
        </div>

    </div>

    <!-- PROFILE CARD -->

    <div class="
        bg-white
        rounded-2xl
        shadow-sm
        p-6
    ">

        <div class="flex items-center gap-5">

            <div class="
                w-20
                h-20
                rounded-full
                bg-[#D8A45D]
                flex
                items-center
                justify-center
                text-2xl
                font-bold
            ">

                {{ substr($customer->nama,0,1) }}

            </div>

            <div>

                <h2 class="text-xl font-semibold">
                    {{ $customer->nama }}
                </h2>

                <p class="text-gray-500">
                    {{ $customer->member_code }}
                </p>



                <span class="
    inline-block
    mt-2
    px-3
    py-1
    rounded-full
    text-xs
    font-medium
    {{ $customer->status_member == 'aktif'
        ? 'bg-green-100 text-green-700'
        : 'bg-red-100 text-red-700'
    }}
">

                    {{ ucfirst($customer->status_member) }}

                </span>


            </div>


        </div>



        <hr class="my-6">



        <!-- SUMMARY -->


        <div class="
            grid
            md:grid-cols-4
            gap-4
        ">


            <div class="bg-[#F9F5EF] rounded-xl p-5">

                <p class="text-gray-400 text-sm">
                    Total Transaksi
                </p>

                <p class="text-2xl font-semibold mt-2">
                    {{ $customer->transactions->count() }}
                </p>

            </div>



            <div class="bg-[#F9F5EF] rounded-xl p-5">

                <p class="text-gray-400 text-sm">
                    Saldo Point
                </p>

                <p class="text-2xl font-semibold mt-2">
                    {{ number_format($customer->saldo_point) }}
                </p>

            </div>




            <div class="bg-[#F9F5EF] rounded-xl p-5">

                <p class="text-gray-400 text-sm">
                    Total Redeem
                </p>

                <p class="text-2xl font-semibold mt-2">
                    {{ $customer->redemptions->count() }}
                </p>

            </div>




            <div class="bg-[#F9F5EF] rounded-xl p-5">

                <p class="text-gray-400 text-sm">
                    Point History
                </p>

                <p class="text-2xl font-semibold mt-2">
                    {{ $customer->pointHistories->count() }}
                </p>

            </div>


        </div>




        <hr class="my-6">



        <!-- INFORMATION -->


        <div class="grid md:grid-cols-2 gap-5">


            <div>

                <p class="text-gray-400 text-sm">
                    Nomor HP
                </p>

                <p class="font-medium">
                    {{ $customer->nomor_hp }}
                </p>

            </div>



            <div>

                <p class="text-gray-400 text-sm">
                    Email
                </p>

                <p class="font-medium">
                    {{ $customer->email ?? '-' }}
                </p>

            </div>



            <div>

                <p class="text-gray-400 text-sm">
                    Tanggal Lahir
                </p>

                <p class="font-medium">
                    {{ $customer->tanggal_lahir?->format('d M Y') ?? '-' }}
                </p>

            </div>



            <div>

                <p class="text-gray-400 text-sm">
                    Tanggal Daftar
                </p>

                <p class="font-medium">
                    {{ $customer->tanggal_daftar?->format('d M Y') }}
                </p>

            </div>


        </div>


    </div>






    <!-- TRANSACTION HISTORY -->


    <div class="
        bg-white
        rounded-2xl
        shadow-sm
        p-6
    ">


        <h3 class="text-lg font-semibold mb-4">
            Riwayat Transaksi
        </h3>



        <div class="overflow-x-auto">


            <table class="w-full text-sm">


                <thead class="bg-[#4A2E1F] text-white">

                    <tr>

                        <th class="text-left p-3">
                            Kode
                        </th>


                        <th class="text-left p-3">
                            Tanggal
                        </th>


                        <th class="text-left p-3">
                            Total
                        </th>


                        <th class="text-left p-3">
                            Point
                        </th>


                    </tr>

                </thead>



                <tbody>


                    @forelse($customer->transactions as $transaction)


                    <tr class="border-b">


                        <td class="p-3">
                            {{ $transaction->kode_transaksi }}
                        </td>


                        <td class="p-3">
                            {{ $transaction->tanggal_transaksi?->format('d M Y') }}
                        </td>


                        <td class="p-3">
                            Rp {{ number_format($transaction->total_belanja) }}
                        </td>


                        <td class="p-3">
                            {{ $transaction->point_didapat }}
                        </td>


                    </tr>


                    @empty


                    <tr>

                        <td colspan="4" class="p-5 text-center text-gray-400">

                            Belum ada transaksi

                        </td>

                    </tr>


                    @endforelse


                </tbody>


            </table>


        </div>


    </div>





    <!-- REDEMPTION HISTORY -->


    <div class="
        bg-white
        rounded-2xl
        shadow-sm
        p-6
    ">


        <h3 class="text-lg font-semibold mb-4">
            Riwayat Redemption
        </h3>



        <div class="overflow-x-auto">


            <table class="w-full text-sm">


                <thead class="bg-[#4A2E1F] text-white">

                    <tr>

                        <th class="text-left p-3">
                            Reward
                        </th>


                        <th class="text-left p-3">
                            Tanggal
                        </th>


                        <th class="text-left p-3">
                            Point Digunakan
                        </th>


                        <th class="text-left p-3">
                            Status
                        </th>


                    </tr>


                </thead>



                <tbody>


                    @forelse($customer->redemptions as $redeem)


                    <tr class="border-b">


                        <td class="p-3">

                            {{ $redeem->reward->nama_reward ?? '-' }}

                        </td>


                        <td class="p-3">

                            {{ $redeem->redeem_date?->format('d M Y') }}

                        </td>


                        <td class="p-3">

                            {{ number_format($redeem->point_used) }}

                        </td>


                        <td class="p-3">


                            <span class="
                            px-3
                            py-1
                            rounded-full
                            text-xs
                            bg-green-100
                            text-green-700
                            ">

                                {{ $redeem->status }}

                            </span>


                        </td>


                    </tr>


                    @empty


                    <tr>

                        <td colspan="4" class="p-5 text-center text-gray-400">

                            Belum ada redemption

                        </td>


                    </tr>


                    @endforelse


                </tbody>


            </table>


        </div>

    </div>
</div>


</div>


@endsection