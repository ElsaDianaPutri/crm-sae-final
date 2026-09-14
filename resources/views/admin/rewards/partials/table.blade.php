 <!-- TABLE -->
 <table class="min-w-[760px] w-full text-sm">


     <thead class="bg-gray-100">


         <tr>


             <th class="px-6 py-4 text-left">
                 Reward
             </th>


             <th class="px-6 py-4 text-left">
                 Point
             </th>


             <th class="px-6 py-4 text-left">
                 Stock
             </th>


             <th class="px-6 py-4 text-left">
                 Status
             </th>


             <th class="px-6 py-4 text-left">
                 Aksi
             </th>


         </tr>


     </thead>




     <tbody>



         @forelse($rewards as $reward)


         <tr class="border-b border-gray-100 transition hover:bg-[#FCFAF7]">



             <td class="px-6 py-4">


                 <div class="flex items-center gap-4">


                     @if($reward->image_path)

                     <img src="{{ asset('storage/'.$reward->image_path) }}" alt="{{ $reward->reward_name }}"
                         loading="lazy" class="h-14 w-14 shrink-0 rounded-xl object-cover">


                     @else

                     <div class="
                            w-14
                            h-14
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




                     <div>


                         <p class="font-medium">

                             {{ $reward->reward_name }}

                         </p>


                         <p class="text-gray-400 text-xs">

                             {{ $reward->description }}

                         </p>


                     </div>


                 </div>


             </td>





             <td class="px-6 py-4">

                 {{ number_format($reward->point_required) }}

             </td>





             <td class="px-6 py-4">

                 {{ $reward->stock }}

             </td>





             <td class="px-6 py-4">


                 @if($reward->status == 'tersedia')


                 <span class="
                        px-3
                        py-1
                        rounded-full
                        text-xs
                        bg-green-100
                        text-green-700
                        ">

                     Tersedia

                 </span>


                 @else


                 <span class="
                        px-3
                        py-1
                        rounded-full
                        text-xs
                        bg-red-100
                        text-red-700
                        ">

                     Tidak Tersedia

                 </span>


                 @endif


             </td>






             <td class="px-6 py-4">


                 <div class="flex gap-2">


                     <!-- EDIT -->

                     <a href="{{ route('admin.rewards.edit',$reward->id_reward) }}" class="
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

                         Edit

                     </a>





                     <!-- DELETE -->

                     <form method="POST" action="{{ route('admin.rewards.destroy',$reward->id_reward) }}">


                         @csrf

                         @method('DELETE')


                         <button onclick="return confirm('Hapus reward ini?')" class="
            px-4
            py-2
            rounded-xl
            bg-red-500
            text-white
            text-sm
            font-medium
            cursor-pointer
            hover:bg-red-600
            transition
            ">


                             Hapus


                         </button>


                     </form>


                 </div>


             </td>




         </tr>



         @empty


         <tr>

             <td colspan="5" class="
                    px-6
                    py-8
                    text-center
                    text-gray-500
                    ">

                 Belum ada reward


             </td>

         </tr>


         @endforelse



     </tbody>


 </table>