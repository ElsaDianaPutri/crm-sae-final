@forelse($customers as $customer)

<div class="customer-row">

    {{-- MEMBER CODE --}}
    <div class="customer-field member-code">

        <span class="customer-label">
            Member Code
        </span>

        <div class="customer-value">
            {{ $customer->member_code }}
        </div>

    </div>


    {{-- NAME --}}
    <div class="customer-field name">

        <span class="customer-label">
            Nama
        </span>

        <a href="{{ route('admin.customers.show', $customer->id_customer) }}" class="customer-value customer-name">
            {{ $customer->nama }}
        </a>

    </div>


    {{-- PHONE --}}
    <div class="customer-field phone">

        <span class="customer-label">
            Nomor HP
        </span>

        <div class="customer-value">
            {{ $customer->nomor_hp }}
        </div>

    </div>


    {{-- POINT --}}
    <div class="customer-field point">

        <span class="customer-label">
            Point
        </span>

        <div class="customer-value font-semibold text-[#4A2E1F]">
            {{ number_format($customer->saldo_point) }}
        </div>

    </div>


    {{-- STATUS --}}
    <div class="customer-field status">

        <span class="
                    customer-status
                    {{ $customer->status_member === 'aktif'
                        ? 'active'
                        : 'inactive'
                    }}
                ">
            {{ ucfirst($customer->status_member) }}
        </span>

    </div>

</div>

@empty

<div class="customer-empty">
    Belum ada customer yang sesuai dengan pencarian.
</div>

@endforelse