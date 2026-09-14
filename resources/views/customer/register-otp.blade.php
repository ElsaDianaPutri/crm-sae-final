@extends('layouts.customer')

@section('title', 'Verifikasi OTP - SAÉ CAFE ROJEL')

@section('content')

<div style="
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f7f3ed;
        padding: 28px 16px;
    ">
    <div style="
            width: min(430px, 100%);
            background: #fffaf2;
            border: 1px solid #e8ddd1;
            border-radius: 22px;
            padding: 26px;
            box-shadow: 0 16px 40px rgba(75,45,28,.08);
        ">

        <div style="
                font-size: 11px;
                color: #806f62;
                letter-spacing: .08em;
                text-transform: uppercase;
            ">
            Verifikasi Member
        </div>

        <h1 style="
                margin: 6px 0;
                font-size: 24px;
                color: #3b2418;
            ">
            Masukkan Kode OTP
        </h1>

        <p style="
                font-size: 12px;
                color: #806f62;
                line-height: 1.6;
            ">
            Kode verifikasi dikirim ke WhatsApp Anda dan berlaku selama 5 menit.
        </p>

        @if($errors->any())
        <div style="
                    margin: 15px 0;
                    padding: 11px;
                    border-radius: 10px;
                    background: #fff0f0;
                    color: #a12727;
                    font-size: 12px;
                ">
            {{ $errors->first() }}
        </div>
        @endif

        @if(session('success'))
        <div style="
                    margin: 15px 0;
                    padding: 11px;
                    border-radius: 10px;
                    background: #edf7ef;
                    color: #21673a;
                    font-size: 12px;
                ">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('register.verify.store') }}">
            @csrf

            <input name="otp" inputmode="numeric" maxlength="6" autocomplete="one-time-code" placeholder="••••••" style="
                    width: 100%;
                    text-align: center;
                    letter-spacing: .45em;
                    font-size: 24px;
                    padding: 13px;
                    border: 1px solid #ded2c6;
                    border-radius: 12px;
                    outline: none;
                " required>

            <button type="submit" style="
                    width: 100%;
                    margin-top: 14px;
                    padding: 13px;
                    border: 0;
                    border-radius: 12px;
                    background: #4a2e1f;
                    color: #fff;
                    font-weight: 600;
                ">
                Verifikasi & Aktifkan Member
            </button>
        </form>

        @if(!empty($debugOtp))
        <div style="
                    margin-top: 16px;
                    font-size: 11px;
                    color: #9a6d34;
                    background: #fff7e5;
                    border: 1px solid #edd9a7;
                    padding: 10px;
                    border-radius: 10px;
                ">
            Mode lokal: OTP testing =
            <strong>{{ $debugOtp }}</strong>.
            OTP ini tidak ditampilkan di production.
        </div>
        @endif

    </div>
</div>

@endsection