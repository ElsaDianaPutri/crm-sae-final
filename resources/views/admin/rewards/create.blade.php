@extends('layouts.admin')

@section('title', 'Tambah Reward')


@section('content')


<div class="space-y-6">


    <!-- HEADER -->

    <div>

        <h1 class="text-2xl font-semibold">
            Tambah Reward
        </h1>

        <p class="text-gray-500 text-sm">
            Tambahkan hadiah baru untuk program loyalty Saé Cafe
        </p>

    </div>




    <!-- FORM -->


    <div class="rounded-2xl bg-white p-4 shadow-sm sm:p-6">

        <form method="POST" action="{{ route('admin.rewards.store') }}" enctype="multipart/form-data">


            @csrf

            <div class="grid md:grid-cols-2 gap-5">

                <!-- Nama Reward -->

                <div>

                    <label class="text-sm text-gray-500">
                        Nama Reward
                    </label>


                    <input type="text" name="reward_name" value="{{ old('reward_name') }}" class="
                    mt-2
                    w-full
                    px-4
                    py-3
                    rounded-xl
                    border
                    border-gray-200
                    " placeholder="Contoh: Kopi Gratis">


                </div>


                <!-- Point -->

                <div>

                    <label class="text-sm text-gray-500">
                        Point Dibutuhkan
                    </label>


                    <input type="number" name="point_required" value="{{ old('point_required') }}" class="
                    mt-2
                    w-full
                    px-4
                    py-3
                    rounded-xl
                    border
                    border-gray-200
                    " placeholder="100">


                </div>

                <!-- Stock -->

                <div>

                    <label class="text-sm text-gray-500">
                        Stock
                    </label>


                    <input type="number" name="stock" value="{{ old('stock') }}" class="
                    mt-2
                    w-full
                    px-4
                    py-3
                    rounded-xl
                    border
                    border-gray-200
                    " placeholder="20">


                </div>

                <!-- Status -->

                <div>

                    <label class="text-sm text-gray-500">
                        Status
                    </label>


                    <select name="status" class="
                    mt-2
                    w-full
                    px-4
                    py-3
                    rounded-xl
                    border
                    border-gray-200
                    ">


                        <option value="tersedia">
                            Tersedia
                        </option>


                        <option value="tidak_tersedia">
                            Tidak Tersedia
                        </option>


                    </select>


                </div>


            </div>





            <!-- IMAGE URL -->


            <div class="mt-5">


                <label class="text-sm text-gray-500">
                    Gambar Reward
                </label>


                <input type="file" name="image" accept="image/*" class="
    mt-2
    w-full
    px-4
    py-3
    rounded-xl
    border
    border-gray-200
    ">


            </div>





            <!-- DESCRIPTION -->


            <div class="mt-5">


                <label class="text-sm text-gray-500">
                    Deskripsi
                </label>


                <textarea name="description" rows="4" class="
                mt-2
                w-full
                px-4
                py-3
                rounded-xl
                border
                border-gray-200
                " placeholder="Deskripsi reward">{{ old('description') }}</textarea>


            </div>





            <!-- BUTTON -->


            <div class="mt-6 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">

                <a href="{{ route('admin.rewards.index') }}" class="
        inline-flex
        w-full
        items-center
        justify-center
        rounded-xl
        border
        border-gray-200
        px-4
        py-3
        text-sm
        font-medium
        text-gray-700
        transition
        hover:bg-gray-50
        sm:w-auto
    ">
                    Batal
                </a>


                <button type="submit" class="
        inline-flex
        w-full
        items-center
        justify-center
        rounded-xl
        bg-[#4A2E1F]
        px-4
        py-3
        text-sm
        font-semibold
        text-white
        transition
        hover:bg-[#5B3927]
        sm:w-auto
    ">
                    Simpan Reward
                </button>


            </div>


        </form>


    </div>


</div>


@endsection