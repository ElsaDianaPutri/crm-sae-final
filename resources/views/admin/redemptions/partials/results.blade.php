<div id="redemption-results-content">

    @forelse($redemptions as $redemption)

    <article class="redemption-row">

        {{-- KODE --}}
        <div class="redemption-field code">

            <span class="redemption-label">
                Kode
            </span>

            <div class="redemption-value redemption-code">
                {{ $redemption->redemption_code }}
            </div>

        </div>


        {{-- CUSTOMER --}}
        <div class="redemption-field customer">

            <span class="redemption-label">
                Customer
            </span>

            <div class="redemption-value redemption-customer">
                {{ $redemption->customer->nama ?? '-' }}
            </div>

            <div class="redemption-subvalue">
                {{ $redemption->customer->member_code ?? '-' }}
            </div>

        </div>


        {{-- REWARD --}}
        <div class="redemption-field reward">

            <span class="redemption-label">
                Reward
            </span>

            <div class="redemption-value">
                {{ $redemption->reward->reward_name ?? '-' }}
            </div>

        </div>


        {{-- POINT --}}
        <div class="redemption-field point">

            <span class="redemption-label">
                Point
            </span>

            <div class="redemption-value redemption-point">
                -{{ number_format($redemption->point_used) }}
            </div>

        </div>


        {{-- STATUS --}}
        <div class="redemption-field status">

            <span class="redemption-label">
                Status
            </span>

            @php
            $status = strtolower(
            trim((string) $redemption->status)
            );

            $statusClass = match (true) {
            in_array($status, [
            'berhasil',
            'success',
            'sukses',
            'selesai',
            'dikonfirmasi',
            'confirmed'
            ], true) => 'success',

            in_array($status, [
            'pending',
            'menunggu',
            'diajukan'
            ], true) => 'pending',

            in_array($status, [
            'gagal',
            'failed',
            'dibatalkan',
            'cancelled'
            ], true) => 'failed',

            default => 'default',
            };
            @endphp

            <span class="redemption-status {{ $statusClass }}">
                {{ ucfirst($redemption->status) }}
            </span>

        </div>


        {{-- TANGGAL --}}
        <div class="redemption-field date">

            <span class="redemption-label">
                Tanggal
            </span>

            <div class="redemption-value redemption-date">
                {{ $redemption->created_at?->format('d M Y H:i') ?? '-' }}
            </div>

        </div>

    </article>

    @empty

    <div class="redemption-empty">

        @if(request()->filled('search') || request()->filled('status'))
        Tidak ada redemption yang sesuai dengan filter.
        @else
        Belum ada redemption.
        @endif

    </div>

    @endforelse

</div>


{{-- PAGINATION --}}
<div id="redemption-pagination" class="mt-4 w-full overflow-x-auto">
    {{ $redemptions->links() }}
</div>