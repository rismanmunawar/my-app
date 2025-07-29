@extends('layouts.app')

@section('title', '403 Forbidden')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-6 bg-base-200">
        <div class="text-center max-w-xl">
            <img src="https://undraw.co/api/illustrations/7c233b21-4d12-4d1d-b3a5-13a80147c6fd" alt="403 Forbidden"
                class="mx-auto mb-6 w-72">

            <h1 class="text-4xl font-bold text-error">403 - Forbidden</h1>
            <p class="mt-4 text-lg text-base-content">
                Maaf, Anda tidak memiliki akses ke halaman ini. Silakan hubungi administrator jika menurut Anda ini adalah
                sebuah kesalahan.
            </p>

            <a href="{{ url()->previous() }}" class="btn mt-6 btn-primary btn-sm">
                ⬅️ Kembali
            </a>
        </div>
    </div>
@endsection
