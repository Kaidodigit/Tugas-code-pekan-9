@extends('layouts.app')

@section('title', 'Tambah Rak')
@section('page_title', 'Tambah Rak')

@section('content')
    <div class="page-heading compact-heading">
        <div><p class="eyebrow">DAFTAR RAK <span>/</span> TAMBAH</p><h1>Tambah Rak</h1><p class="page-description">Lengkapi formulir berikut untuk mendaftarkan rak baru.</p></div>
        <a href="{{ route('rak.index') }}" class="btn btn-secondary">← Kembali ke Daftar</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-error validation-summary"><strong>Data belum dapat disimpan.</strong><span>Periksa kembali kolom yang ditandai. {{ $errors->count() }} kesalahan ditemukan.</span></div>
    @endif

    <form action="{{ route('rak.store') }}" method="POST" class="form-panel">
        @csrf
        @include('rak._form')
        <div class="form-actions"><a href="{{ route('rak.index') }}" class="btn btn-secondary">Batal</a><button type="submit" class="btn btn-primary">Simpan Rak <span>→</span></button></div>
    </form>
@endsection
