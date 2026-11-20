@extends('layouts.app')

@section('title', 'Edit Rak')
@section('page_title', 'Edit Rak')

@section('content')
    <div class="page-heading compact-heading">
        <div><p class="eyebrow">DAFTAR RAK <span>/</span> EDIT</p><h1>Edit Rak</h1><p class="page-description">Perbarui informasi untuk rak <strong>{{ $rak->Kode_Rak }}</strong>.</p></div>
        <a href="{{ route('rak.index') }}" class="btn btn-secondary">← Kembali ke Daftar</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-error validation-summary"><strong>Perubahan belum dapat disimpan.</strong><span>Periksa kembali kolom yang ditandai. {{ $errors->count() }} kesalahan ditemukan.</span></div>
    @endif

    <form action="{{ route('rak.update', $rak) }}" method="POST" class="form-panel">
        @csrf
        @method('PUT')
        @include('rak._form')
        <div class="form-actions"><a href="{{ route('rak.index') }}" class="btn btn-secondary">Batal</a><button type="submit" class="btn btn-primary">Simpan Perubahan <span>→</span></button></div>
    </form>
@endsection
