@forelse($pointHistories as $history)

@php
$isPlus = $history->type === 'tambah';
@endphp

<div class="point-history-row">

    {{-- CUSTOMER --}}
    <div class="point-history-field customer">

        <span class="point-history-label">
            Customer
        </span>

        <div class="point-history-value point-history-customer">
            {{ $history->customer->nama ?? '-' }}
        </div>

    </div>


    {{-- TYPE --}}
    <div class="point-history-field type">

        <span class="point-history-label">
            Jenis
        </span>

        <span class="
                    point-history-type
                    {{ $isPlus ? 'plus' : 'minus' }}
                ">
            {{ $isPlus ? 'Point Bertambah' : 'Point Berkurang' }}
        </span>

    </div>


    {{-- POINT --}}
    <div class="point-history-field point">

        <span class="point-history-label">
            Point
        </span>

        <div class="
                    point-history-value
                    point-history-point
                    {{ $isPlus ? 'plus' : 'minus' }}
                ">
            {{ $isPlus ? '+' : '-' }}{{ number_format($history->point) }}
        </div>

    </div>


    {{-- KETERANGAN --}}
    <div class="point-history-field description">

        <span class="point-history-label">
            Keterangan
        </span>

        <div class="point-history-value">
            {{ $history->keterangan ?? '-' }}
        </div>

    </div>


    {{-- TANGGAL --}}
    <div class="point-history-field date">

        <span class="point-history-label">
            Tanggal
        </span>

        <div class="point-history-value point-history-date">
            {{ $history->created_at?->format('d M Y H:i') ?? '-' }}
        </div>

    </div>

</div>

@empty

<div class="point-history-empty">
    Belum ada riwayat point.
</div>

@endforelse