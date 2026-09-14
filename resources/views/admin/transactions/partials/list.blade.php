@forelse($transactions as $transaction)

<div class="transaction-row">

    {{-- KODE --}}
    <div class="transaction-field code">

        <span class="transaction-label">
            Kode
        </span>

        <div class="transaction-value transaction-code">
            {{ $transaction->kode_transaksi }}
        </div>

    </div>


    {{-- CUSTOMER --}}
    <div class="transaction-field customer">

        <span class="transaction-label">
            Customer
        </span>

        <div class="transaction-value transaction-customer">
            {{ $transaction->customer->nama ?? '-' }}
        </div>

    </div>


    {{-- TOTAL --}}
    <div class="transaction-field total">

        <span class="transaction-label">
            Total
        </span>

        <div class="transaction-value font-semibold text-gray-900">
            Rp {{ number_format($transaction->total_belanja, 0, ',', '.') }}
        </div>

    </div>


    {{-- POINT --}}
    <div class="transaction-field point">

        <span class="transaction-label">
            Point
        </span>

        <div class="transaction-value transaction-point">
            +{{ number_format($transaction->point_didapat) }}
        </div>

    </div>


    {{-- SOURCE --}}
    <div class="transaction-field source">

        <span class="transaction-label">
            Source
        </span>

        <div class="transaction-value transaction-source">
            {{ strtoupper($transaction->source ?? 'manual') }}
        </div>

    </div>


    {{-- STATUS --}}
    <div class="transaction-field status">

        <span class="transaction-label">
            Status
        </span>

        @php
        $status = strtolower((string) $transaction->status);

        $statusClass = match (true) {
        in_array($status, [
        'berhasil',
        'success',
        'sukses',
        'completed',
        'selesai'
        ], true) => 'success',

        in_array($status, [
        'pending',
        'menunggu'
        ], true) => 'pending',

        in_array($status, [
        'gagal',
        'failed',
        'cancelled',
        'dibatalkan'
        ], true) => 'failed',

        default => 'default',
        };
        @endphp

        <span class="transaction-status {{ $statusClass }}">
            {{ ucfirst($transaction->status) }}
        </span>

    </div>


    {{-- TANGGAL --}}
    <div class="transaction-field date">

        <span class="transaction-label">
            Tanggal
        </span>

        <div class="transaction-value transaction-date">
            {{ $transaction->tanggal_transaksi?->format('d M Y H:i') ?? '-' }}
        </div>

    </div>

</div>

@empty

<div class="transaction-empty">
    Tidak ada transaksi yang sesuai dengan pencarian.
</div>

@endforelse