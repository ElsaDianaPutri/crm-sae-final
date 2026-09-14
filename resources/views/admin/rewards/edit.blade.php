@extends('layouts.admin')

@section('title', 'Edit Reward')


@section('content')


<div class="space-y-6">


    <!-- HEADER -->

    <div>

        <h1 class="text-2xl font-semibold">
            Edit Reward
        </h1>

        <p class="text-gray-500 text-sm">
            Perbarui informasi hadiah loyalty Saé Cafe
        </p>

    </div>





    <!-- FORM -->


    <div class="rounded-2xl bg-white p-4 shadow-sm sm:p-6">


        <form method="POST" action="{{ route('admin.rewards.update',$reward->id_reward) }}"
            enctype="multipart/form-data">


            @csrf

            @method('PUT')



            <div class="grid md:grid-cols-2 gap-5">



                <!-- Nama Reward -->

                <div>

                    <label class="text-sm text-gray-500">
                        Nama Reward
                    </label>


                    <input type="text" name="reward_name" value="{{ old('reward_name',$reward->reward_name) }}" class="
                    mt-2
                    w-full
                    px-4
                    py-3
                    rounded-xl
                    border
                    border-gray-200
                    ">


                </div>





                <!-- Point -->

                <div>

                    <label class="text-sm text-gray-500">
                        Point Dibutuhkan
                    </label>


                    <input type="number" name="point_required"
                        value="{{ old('point_required',$reward->point_required) }}" class="
                    mt-2
                    w-full
                    px-4
                    py-3
                    rounded-xl
                    border
                    border-gray-200
                    ">


                </div>





                <!-- Stock -->

                <div>

                    <label class="text-sm text-gray-500">
                        Stock
                    </label>


                    <input type="number" name="stock" value="{{ old('stock',$reward->stock) }}" class="
                    mt-2
                    w-full
                    px-4
                    py-3
                    rounded-xl
                    border
                    border-gray-200
                    ">


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
                    cursor-pointer
                    ">


                        <option value="tersedia" {{ $reward->status == 'tersedia' ? 'selected':'' }}>
                            Tersedia
                        </option>


                        <option value="tidak_tersedia" {{ $reward->status == 'tidak_tersedia' ? 'selected':'' }}>
                            Tidak Tersedia
                        </option>


                    </select>


                </div>



            </div>





            <!-- GAMBAR SAAT INI -->


            <div class="mt-6">


                <label class="text-sm text-gray-500">
                    Gambar Saat Ini
                </label>



                <div class="mt-3">


                    @if($reward->image_path)


                    <img src="{{ asset('storage/'.$reward->image_path) }}" alt="{{ $reward->reward_name }}"
                        class="h-32 w-32 rounded-2xl object-cover shadow-sm">

                    @else


                    <div class="
                    w-32
                    h-32
                    rounded-xl
                    bg-gray-100
                    flex
                    items-center
                    justify-center
                    text-gray-400
                    ">

                        🎁

                    </div>


                    @endif


                </div>


            </div>






            <!-- UPLOAD GAMBAR BARU -->


            <div class="mt-5">


                <label class="text-sm text-gray-500">
                    Upload Gambar Baru (Opsional)
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


                <p class="text-xs text-gray-400 mt-2">
                    Kosongkan jika tidak ingin mengganti gambar
                </p>


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
                ">{{ old('description',$reward->description) }}</textarea>


            </div>







            <!-- BUTTON -->


            <div class="
                mt-6
                flex
                justify-end
                gap-3
            ">


                <a href="{{ route('admin.rewards.index') }}" class="
                px-4
                py-2
                rounded-xl
                border
                text-sm
                cursor-pointer
hover:bg-gray-100
transition
                ">

                    Batal

                </a>




                <button class="
                px-4
                py-2
                rounded-xl
                bg-[#4A2E1F]
                text-white
                text-sm
                font-medium
                cursor-pointer
                hover:bg-[#5b3927]
transition
                ">

                    Simpan Perubahan

                </button>


            </div>




        </form>


    </div>


</div>


@endsection