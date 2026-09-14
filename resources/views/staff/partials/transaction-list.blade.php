@forelse($transactions as $transaction)

<tr>

    <td class="staff-transaction-code">
        {{ $transaction->kode_transaksi }}
    </td>

    <td>
        {{ $transaction->customer->nama ?? '-' }}
    </td>

    <td>
        Rp {{ number_format(
                $transaction->total_belanja,
                0,
                ',',
                '.'
            ) }}
    </td>

    <td class="staff-transaction-point">
        +{{ number_format($transaction->point_didapat) }}
    </td>

    <td>
        {{ ucfirst($transaction->source ?? '-') }}
    </td>

    <td>
        {{ ucfirst($transaction->status ?? '-') }}
    </td>

    <td>
        {{ $transaction->tanggal_transaksi?->format('d M Y H:i') ?? '-' }}
    </td>

</tr>

@empty

<tr>

    <td colspan="7" class="staff-transaction-empty">
        @if(request('search'))

        Transaksi dengan pencarian
        "<strong>{{ request('search') }}</strong>"
        tidak ditemukan.

        @else

        Belum ada transaksi.

        @endif
    </td>

</tr>

@endforelse