@extends('layouts.app')

@section('title', 'Daftar Rak')
@section('page_title', 'Daftar Rak')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">PENGELOLAAN GUDANG</p>
            <h1>Daftar Rak Gudang</h1>
            <p class="page-description">Rekapitulasi tata letak zonasi, kapasitas, dan posisi rak gudang.</p>
        </div>
        {{-- Admin & Staff --}}
        <a href="{{ route('rak.create') }}" class="btn btn-primary"><span class="plus">+</span> Tambah Rak Baru</a>
    </div>

    <section class="stats-grid" aria-label="Ringkasan data rak">
        <article class="stat-card"><div class="stat-top"><span class="stat-label">Total Rak</span><span class="stat-icon icon-blue">▦</span></div><div class="stat-value">{{ number_format($rak->count(), 0, ',', '.') }}</div><div class="stat-foot">Seluruh rak terdaftar</div></article>
        <article class="stat-card"><div class="stat-top"><span class="stat-label">Total Kapasitas</span><span class="stat-icon icon-green">✓</span></div><div class="stat-value">{{ number_format($rak->sum('kapasitas'), 0, ',', '.') }}</div><div class="stat-foot">Gabungan semua rak</div></article>
        <article class="stat-card"><div class="stat-top"><span class="stat-label">Jumlah Zona</span><span class="stat-icon icon-orange">◆</span></div><div class="stat-value">{{ number_format($rak->pluck('Zona')->unique()->count(), 0, ',', '.') }}</div><div class="stat-foot">Zona berbeda di gudang</div></article>
    </section>

    <section class="panel">
        <div class="panel-header">
            <div><h2>Data Rak</h2><p>Daftar rak yang tersimpan di database.</p></div>
            <span class="record-count">{{ $rak->count() }} data ditemukan</span>
        </div>

        <div class="table-wrap">
            <table class="data-table">
                <thead><tr><th>KODE RAK</th><th>ZONA</th><th>LORONG</th><th>LEVEL</th><th>KAPASITAS</th><th>ISI RAK</th><th class="actions-heading">AKSI</th></tr></thead>
                <tbody>
                    @forelse ($rak as $item)
                        <tr>
                            <td><div class="company-cell"><span class="company-avatar">{{ mb_strtoupper(mb_substr($item->Kode_Rak, 0, 1)) }}</span><div><span class="company-name">{{ $item->Kode_Rak }}</span></div></div></td>
                            <td><span class="type-pill">{{ $item->Zona }}</span></td>
                            <td><div class="primary-text">{{ $item->Lorong }}</div></td>
                            <td><div class="primary-text">{{ $item->Level }}</div></td>
                            <td><div class="primary-text">{{ $item->kapasitas }}</div></td>
                            <td><div class="primary-text">{{ $item->isi_rak }}</div></td>
                            <td>
                                <div class="table-actions">
                                    {{-- Admin & Staff --}}
                                    <a class="action-link" href="{{ route('rak.edit', $item) }}" title="Edit rak">Edit</a>

                                    {{-- Hanya Admin --}}
                                    @if (auth()->user()->role === 'admin')
                                        <form action="{{ route('rak.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus rak ini? Data yang dihapus tidak dapat dikembalikan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="action-link action-delete" type="submit">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7"><div class="empty-state"><span class="empty-icon">⌕</span><strong>Belum ada data rak gudang</strong><p>Tambahkan rak baru untuk mulai mengelola gudang.</p><a class="btn btn-primary btn-small" href="{{ route('rak.create') }}">Tambah Rak</a></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
