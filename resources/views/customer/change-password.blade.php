@extends('layouts.customer')
@section('title','Ubah Password - SAÉ CAFE ROJEL')
@section('mobile_title','Ubah Password')
@section('content')
<div style="max-width:520px;margin:0 auto;background:#fffdf9;border:1px solid #e9ded1;border-radius:18px;padding:24px">
<h1 style="font-size:24px;color:#4b2d1c">Ubah Password</h1><p style="margin-top:5px;color:#8b796b;font-size:12px">Gunakan password baru yang unik untuk akun member Anda.</p>
@if($errors->any())<div style="margin-top:16px;padding:12px;border-radius:10px;background:#fff0ef;color:#b84444;font-size:11px">{{ $errors->first() }}</div>@endif
@if(session('success'))<div style="margin-top:16px;padding:12px;border-radius:10px;background:#eef9ef;color:#2d7c49;font-size:11px">{{ session('success') }}</div>@endif
<form method="POST" action="{{ route('customer.password.update') }}" style="margin-top:20px;display:grid;gap:14px">@csrf @method('PUT')<label style="font-size:11px;font-weight:700">Password Saat Ini<input name="current_password" type="password" required style="display:block;width:100%;margin-top:6px;padding:11px 12px;border:1px solid #e9ded1;border-radius:10px"></label><label style="font-size:11px;font-weight:700">Password Baru<input name="password" type="password" required style="display:block;width:100%;margin-top:6px;padding:11px 12px;border:1px solid #e9ded1;border-radius:10px"></label><label style="font-size:11px;font-weight:700">Konfirmasi Password<input name="password_confirmation" type="password" required style="display:block;width:100%;margin-top:6px;padding:11px 12px;border:1px solid #e9ded1;border-radius:10px"></label><button style="border:0;background:#4b2d1c;color:#fff;padding:12px;border-radius:10px;font-weight:700;cursor:pointer">Simpan Password</button></form>
</div>
@endsection
