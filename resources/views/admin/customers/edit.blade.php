@extends('layouts.admin')

@section('title', 'Edit Customer')


@section('content')

<div class="space-y-6">


    <!-- Header -->

    <div>

        <h1 class="text-2xl font-semibold">
            Edit Customer
        </h1>

        <p class="text-gray-500 text-sm">
            Perbarui informasi member Saé Cafe
        </p>

    </div>



    <!-- Form Card -->

    <div class="
        bg-white
        rounded-2xl
        shadow-sm
        p-8
    ">


        <form action="{{ route('admin.customers.update',$customer->id_customer) }}" method="POST">

            @csrf
            @method('PUT')



            <div class="grid md:grid-cols-2 gap-x-10 gap-y-6">



                <!-- Nama -->

                <div>

                    <label class="text-sm text-gray-500">
                        Nama
                    </label>


                    <input type="text" name="nama" value="{{ $customer->nama }}" class="
                    mt-2
                    w-full
                    rounded-xl
                    border
                    border-gray-200
                    px-4
                    py-3
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#4A2E1F]
                    ">


                </div>




                <!-- Nomor HP -->

                <div>

                    <label class="text-sm text-gray-500">
                        Nomor HP
                    </label>


                    <input type="text" name="nomor_hp" value="{{ $customer->nomor_hp }}" class="
                    mt-2
                    w-full
                    rounded-xl
                    border
                    border-gray-200
                    px-4
                    py-3
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#4A2E1F]
                    ">


                </div>





                <!-- Email -->

                <div>

                    <label class="text-sm text-gray-500">
                        Email
                    </label>


                    <input type="email" name="email" value="{{ $customer->email }}" class="
                    mt-2
                    w-full
                    rounded-xl
                    border
                    border-gray-200
                    px-4
                    py-3
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#4A2E1F]
                    ">


                </div>





                <!-- Tanggal Lahir -->

                <div>

                    <label class="text-sm text-gray-500">
                        Tanggal Lahir
                    </label>


                    <input type="date" name="tanggal_lahir" value="{{ $customer->tanggal_lahir?->format('Y-m-d') }}"
                        class="
                    mt-2
                    w-full
                    rounded-xl
                    border
                    border-gray-200
                    px-4
                    py-3
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#4A2E1F]
                    ">


                </div>






                <!-- Status -->

                <div>


                    <label class="text-sm text-gray-500">
                        Status Member
                    </label>


                    <select name="status_member" class="
                    mt-2
                    w-full
                    rounded-xl
                    border
                    border-gray-200
                    px-4
                    py-3
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#4A2E1F]
                    ">


                        <option value="aktif" {{ $customer->status_member=='aktif'?'selected':'' }}>
                            Aktif
                        </option>


                        <option value="nonaktif" {{ $customer->status_member=='nonaktif'?'selected':'' }}>
                            Nonaktif
                        </option>


                    </select>


                </div>




                <!-- Member Code -->

                <div>

                    <label class="text-sm text-gray-500">
                        Member Code
                    </label>


                    <input type="text" value="{{ $customer->member_code }}" disabled class="
                    mt-2
                    w-full
                    rounded-xl
                    bg-gray-100
                    border
                    border-gray-200
                    px-4
                    py-3
                    text-gray-500
                    ">


                </div>


            </div>




            <!-- Info -->

            <div class="
                mt-8
                bg-[#FFF8ED]
                border
                border-[#F2D39B]
                rounded-xl
                p-4
            ">


                <p class="font-medium">
                    Informasi
                </p>


                <p class="text-sm text-gray-600 mt-1">

                    Pastikan data yang dimasukkan sudah benar.
                    Perubahan akan langsung tersimpan.

                </p>


            </div>





            <!-- Button -->

            <div class="
                flex
                justify-end
                gap-3
                mt-8
            ">


                <a href="{{ route('admin.customers.show',$customer->id_customer) }}" class="
                px-5
                py-3
                rounded-xl
                bg-gray-100
                text-gray-600
                text-sm
                ">

                    Batal

                </a>



                <button type="submit" class="
                px-5
                py-3
                rounded-xl
                bg-[#4A2E1F]
                text-white
                text-sm
                hover:bg-[#5b3927]
                ">

                    Simpan Perubahan

                </button>


            </div>


        </form>


    </div>



</div>


@endsection