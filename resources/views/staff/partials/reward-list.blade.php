@forelse($rewards as $reward)

<article class="staff-reward-card">

    {{-- IMAGE --}}
    <div class="staff-reward-image">

        @if($reward->image_path)

        <img src="{{ asset('storage/' . $reward->image_path) }}" alt="{{ $reward->reward_name }}">

        @else

        <span class="staff-reward-no-image">
            Tidak ada gambar
        </span>

        @endif

    </div>


    {{-- BODY --}}
    <div class="staff-reward-body">

        <div class="staff-reward-name">
            {{ $reward->reward_name }}
        </div>


        <p class="staff-reward-description">
            {{ $reward->description ?: 'Tidak ada deskripsi reward.' }}
        </p>


        <div class="staff-reward-meta">

            <span class="staff-reward-point">
                {{ number_format($reward->point_required) }}
                Point
            </span>

            <span class="staff-reward-stock">
                Stock {{ number_format($reward->stock) }}
            </span>

        </div>

    </div>

</article>

@empty

<div class="staff-reward-empty">
    @if(request('search'))
    Reward dengan pencarian
    "<strong>{{ request('search') }}</strong>"
    tidak ditemukan.
    @else
    Belum ada reward tersedia.
    @endif
</div>

@endforelse