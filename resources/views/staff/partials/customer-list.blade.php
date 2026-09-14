@forelse($customers as $customer)

<tr>

    {{-- MEMBER --}}
    <td>

        <div class="staff-member-name">
            {{ $customer->nama }}
        </div>

        <div class="staff-member-code">
            {{ $customer->member_code }}
        </div>

    </td>


    {{-- WHATSAPP --}}
    <td>
        {{ $customer->nomor_hp }}
    </td>


    {{-- POINT --}}
    <td class="staff-member-point">
        {{ number_format($customer->saldo_point) }}
    </td>


    {{-- STATUS --}}
    <td>

        @if($customer->status_member === 'aktif')

        <span class="staff-member-status active">
            Aktif
        </span>

        @else

        <span class="staff-member-status inactive">
            {{ $customer->status_member }}
        </span>

        @endif

    </td>


    {{-- TRANSAKSI --}}
    <td>

        <a href="{{ route('staff.transactions.create', ['id_customer' => $customer->id_customer]) }}"
            class="staff-member-transaction-button">
            Transaksi
        </a>

    </td>

</tr>

@empty

<tr>

    <td colspan="5" class="staff-member-empty">

        @if(request('search'))

        Member dengan pencarian
        "<strong>{{ request('search') }}</strong>"
        tidak ditemukan.

        @else

        Belum ada member.

        @endif

    </td>

</tr>

@endforelse