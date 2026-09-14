@extends('layouts.staff')

@section('title', 'Tambah Member - Staff')

@section('content')

<style>
.staff-create-member-page {
    width: 100%;
    max-width: 760px;
    margin: 0 auto;
}


.staff-create-member-header {
    margin-bottom: 20px;
}


.staff-create-member-title {
    margin: 0;

    color: #171717;

    font-size: 26px;
    line-height: 34px;

    font-weight: 600;
}


.staff-create-member-subtitle {
    margin: 5px 0 0;

    color: #7F6D60;

    font-size: 13px;
    line-height: 19px;
}


.staff-create-member-card {
    background: #FFFFFF;

    border:
        1px solid #EADFD1;

    border-radius: 16px;

    box-shadow:
        0 8px 24px rgba(48, 31, 21, .04);

    padding: 20px;
}


.staff-create-member-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 16px;
}


.staff-form-group {
    min-width: 0;
}


.staff-form-group.full {
    grid-column: 1 / -1;
}


.staff-form-label {
    display: block;

    margin-bottom: 7px;

    color: #4B443F;

    font-size: 12px;

    font-weight: 600;
}


.staff-form-input {
    width: 100%;

    min-height: 44px;

    padding: 11px 13px;

    border:
        1px solid #DDD2C8;

    border-radius: 11px;

    background: #FFFFFF;

    color: #171717;

    font-family: inherit;

    font-size: 13px;

    outline: none;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}


.staff-form-input:focus {
    border-color: #4A2E1F;

    box-shadow:
        0 0 0 3px rgba(74, 46, 31, .08);
}


.staff-form-help {
    margin-top: 6px;

    color: #9A8779;

    font-size: 10px;

    line-height: 15px;
}


.staff-create-member-actions {
    display: flex;

    align-items: center;
    justify-content: flex-end;

    gap: 10px;

    margin-top: 20px;

    padding-top: 18px;

    border-top:
        1px solid #F0ECE8;
}


.staff-create-cancel {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-height: 42px;

    padding: 10px 15px;

    border:
        1px solid #D9C9BB;

    border-radius: 11px;

    background: #FFFFFF;

    color: #4A2E1F;

    font-size: 12px;

    font-weight: 600;

    text-decoration: none;
}


.staff-create-submit {
    min-height: 42px;

    padding: 10px 16px;

    border: 0;

    border-radius: 11px;

    background: #4A2E1F;

    color: #FFFFFF;

    font-family: inherit;

    font-size: 12px;

    font-weight: 600;

    cursor: pointer;
}


.staff-create-submit:hover {
    background: #5B3927;
}


@media (max-width: 640px) {

    .staff-create-member-title {
        font-size: 23px;
        line-height: 30px;
    }

    .staff-create-member-card {
        padding: 16px;
    }

    .staff-create-member-grid {
        grid-template-columns: 1fr;
    }

    .staff-form-group.full {
        grid-column: auto;
    }

    .staff-create-member-actions {
        flex-direction: column-reverse;
    }

    .staff-create-cancel,
    .staff-create-submit {
        width: 100%;
    }

}
</style>


<div class="staff-create-member-page">


    {{-- HEADER --}}
    <div class="staff-create-member-header">

        <h1 class="staff-create-member-title">
            Tambah Member
        </h1>

        <p class="staff-create-member-subtitle">
            Daftarkan customer baru menjadi member SAÉ CAFE ROJEL.
        </p>

    </div>


    {{-- FORM --}}
    <div class="staff-create-member-card">

        <form method="POST" action="{{ route('staff.customers.store') }}">

            @csrf


            <div class="staff-create-member-grid">


                {{-- NAMA --}}
                <div class="staff-form-group full">

                    <label for="nama" class="staff-form-label">
                        Nama Lengkap
                    </label>

                    <input id="nama" type="text" name="nama" value="{{ old('nama') }}" class="staff-form-input"
                        placeholder="Masukkan nama lengkap" required>

                </div>


                {{-- NOMOR HP --}}
                <div class="staff-form-group">

                    <label for="nomor_hp" class="staff-form-label">
                        Nomor WhatsApp
                    </label>

                    <input id="nomor_hp" type="text" name="nomor_hp" value="{{ old('nomor_hp') }}"
                        class="staff-form-input" placeholder="08xxxxxxxxxx" inputmode="numeric" required>

                    <div class="staff-form-help">
                        Nomor ini akan digunakan sebagai username login customer.
                    </div>

                </div>


                {{-- EMAIL --}}
                <div class="staff-form-group">

                    <label for="email" class="staff-form-label">
                        Email
                    </label>

                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="staff-form-input"
                        placeholder="nama@email.com">

                </div>


                {{-- TANGGAL LAHIR --}}
                <div class="staff-form-group">

                    <label for="tanggal_lahir" class="staff-form-label">
                        Tanggal Lahir
                    </label>

                    <input id="tanggal_lahir" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                        class="staff-form-input">

                </div>


                {{-- PASSWORD --}}
                <div class="staff-form-group">

                    <label for="password" class="staff-form-label">
                        Password Akun
                    </label>

                    <input id="password" type="password" name="password" class="staff-form-input"
                        placeholder="Minimal 6 karakter" required>

                </div>


                {{-- KONFIRMASI --}}
                <div class="staff-form-group">

                    <label for="password_confirmation" class="staff-form-label">
                        Konfirmasi Password
                    </label>

                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="staff-form-input" placeholder="Ulangi password" required>

                </div>

            </div>


            {{-- ACTION --}}
            <div class="staff-create-member-actions">

                <a href="{{ route('staff.customers') }}" class="staff-create-cancel">
                    Batal
                </a>

                <button type="submit" class="staff-create-submit">
                    Simpan Member
                </button>

            </div>

        </form>

    </div>

</div>

@endsection