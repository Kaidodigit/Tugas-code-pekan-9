@extends('layouts.app')

@section('title', 'Jadwal Perawatan')
@section('page_title', 'Jadwal Perawatan')

@section('content')
@php
    $totalData = $perawatan->count();
    $jmlFk = $perawatan->filter(fn($i) => str_starts_with(strtolower($i->nomor_seri), 'fk'))->count();
    $jmlTrPu = $perawatan->filter(fn($i) => str_starts_with(strtolower($i->nomor_seri), 'tr') || str_starts_with(strtolower($i->nomor_seri), 'pu'))->count();
@endphp

    <div class="page-heading">
        <div>
            <p class="eyebrow">PENGELOLAAN ARMADA</p>
            <h1>Jadwal Perawatan</h1>
            <p class="page-description">Kelola pencatatan nomor seri dan jadwal servis berkala kendaraan operasional gudang.</p>
        </div>
        <div class="heading-actions">
            <a href="{{ route('home') }}" class="btn btn-secondary">← Kembali</a>
            <button type="button" command="show-modal" commandfor="modalPerawatan" class="btn btn-primary">
                <span class="plus">+</span> Input Perawatan
            </button>
        </div>
    </div>

    <section class="stats-grid" aria-label="Ringkasan data perawatan">
        <article class="stat-card">
            <div class="stat-top"><span class="stat-label">Total Jadwal</span><span class="stat-icon icon-blue">▦</span></div>
            <div class="stat-value">{{ number_format($totalData, 0, ',', '.') }}</div>
            <div class="stat-foot">Seluruh data perawatan tercatat</div>
        </article>
        <article class="stat-card">
            <div class="stat-top"><span class="stat-label">Unit Forklift (fk_)</span><span class="stat-icon icon-green">✓</span></div>
            <div class="stat-value">{{ number_format($jmlFk, 0, ',', '.') }}</div>
            <div class="stat-foot">Jadwal perawatan forklift</div>
        </article>
        <article class="stat-card">
            <div class="stat-top"><span class="stat-label">Troli & Pick-up (tr_ / pu_)</span><span class="stat-icon icon-orange">⚙</span></div>
            <div class="stat-value">{{ number_format($jmlTrPu, 0, ',', '.') }}</div>
            <div class="stat-foot">Jadwal perawatan troli & pick-up</div>
        </article>
    </section>

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2>Data Perawatan Armada</h2>
                <p>Daftar jadwal perawatan yang tersimpan di database.</p>
            </div>
            <span class="record-count">{{ $totalData }} data ditemukan</span>
        </div>

        <form class="filter-bar" action="{{ route('perawatan.index') }}" method="GET">
            <label class="search-box">
                <span aria-hidden="true">⌕</span>
                <input type="search" name="keyword" value="{{ request('keyword') }}" placeholder="Cari nomor seri armada (contoh: fk_1, tr_2, pu_1)...">
            </label>
            <button type="submit" class="btn btn-secondary">Terapkan</button>
            @if (request('keyword'))
                <a href="{{ route('perawatan.index') }}" class="clear-filter">Reset</a>
            @endif
        </form>

        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NOMOR SERI / ARMADA</th>
                        <th>KATEGORI UNIT</th>
                        <th>TANGGAL PERAWATAN</th>
                        <th>STATUS</th>
                        <th class="actions-heading">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($perawatan as $index => $item)
                        @php
                            $prefix = strtolower(substr($item->nomor_seri, 0, 2));
                            if ($prefix === 'tr') {
                                $unitName = 'Troli Gudang Hidrolik';
                                $unitImg = asset('image/Troli.png');
                            } elseif ($prefix === 'pu') {
                                $unitName = 'Mobil Pick-up Logistik';
                                $unitImg = asset('image/Pickup.png');
                            } else {
                                $unitName = 'Forklift Operasional';
                                $unitImg = asset('image/Forklift.png');
                            }

                            $tglObj = \Carbon\Carbon::parse($item->tanggal_perawatan);
                            $isDone = $tglObj->isPast() && !$tglObj->isToday();
                            $isToday = $tglObj->isToday();
                        @endphp
                        <tr>
                            <td><span class="muted-text">{{ $index + 1 }}</span></td>
                            <td>
                                <div class="company-cell">
                                    <span class="company-avatar"><img src="{{ $unitImg }}" alt="{{ $unitName }}"></span>
                                    <div>
                                        <span class="company-name">{{ strtolower($item->nomor_seri) }}</span>
                                        <span class="company-email">{{ strtoupper(str_replace('_', '-', $item->nomor_seri)) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="type-pill">{{ $unitName }}</span></td>
                            <td>
                                <div class="primary-text">{{ $tglObj->format('d M Y') }}</div>
                                <div class="muted-text">{{ $tglObj->diffForHumans() }}</div>
                            </td>
                            <td>
                                @if ($isToday)
                                    <span class="status-pill status-inactive"><span></span>Servis Hari Ini</span>
                                @elseif ($isDone)
                                    <span class="status-pill status-active"><span></span>Selesai</span>
                                @else
                                    <span class="status-pill status-scheduled"><span></span>Terjadwal</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions">
                                    <button type="button" command="show-modal" commandfor="modalEdit{{ $item->id }}" class="action-link">Edit</button>
                                    @if (auth()->user()->isAdmin())
                                        <button type="button" command="show-modal" commandfor="modalDelete{{ $item->id }}" class="action-link action-delete">Hapus</button>
                                    @endif
                                </div>

                                <!-- MODAL EDIT -->
                                <el-dialog>
                                    <dialog id="modalEdit{{ $item->id }}" aria-labelledby="titleEdit{{ $item->id }}" class="modal-dialog">
                                        <el-dialog-backdrop class="modal-backdrop"></el-dialog-backdrop>
                                        <div tabindex="0" class="modal-positioner">
                                            <el-dialog-panel class="modal-panel">
                                                <div class="form-section-heading">
                                                    <div class="form-section-left">
                                                        <span class="section-number">01</span>
                                                        <div>
                                                            <h2 id="titleEdit{{ $item->id }}">Edit Perawatan Armada</h2>
                                                            <p>Perbarui nomor seri atau tanggal perawatan untuk <strong>{{ strtolower($item->nomor_seri) }}</strong>.</p>
                                                        </div>
                                                    </div>
                                                    <button type="button" command="close" commandfor="modalEdit{{ $item->id }}" class="modal-close" aria-label="Tutup">×</button>
                                                </div>

                                                <form action="{{ route('perawatan.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    <div class="form-grid">
                                                        <div class="form-field">
                                                            <label>Pilih Armada & Nomor Seri <span>*</span></label>
                                                            <select name="nomor_seri" required>
                                                                <optgroup label="Forklift Operasional">
                                                                    <option value="fk_1" {{ $item->nomor_seri == 'fk_1' ? 'selected' : '' }}>fk_1 — Forklift Unit 01</option>
                                                                    <option value="fk_2" {{ $item->nomor_seri == 'fk_2' ? 'selected' : '' }}>fk_2 — Forklift Unit 02</option>
                                                                    <option value="fk_3" {{ $item->nomor_seri == 'fk_3' ? 'selected' : '' }}>fk_3 — Forklift Unit 03</option>
                                                                    <option value="fk_4" {{ $item->nomor_seri == 'fk_4' ? 'selected' : '' }}>fk_4 — Forklift Unit 04</option>
                                                                    <option value="fk_5" {{ $item->nomor_seri == 'fk_5' ? 'selected' : '' }}>fk_5 — Forklift Unit 05</option>
                                                                </optgroup>
                                                                <optgroup label="Troli Gudang Hidrolik">
                                                                    <option value="tr_1" {{ $item->nomor_seri == 'tr_1' ? 'selected' : '' }}>tr_1 — Troli Unit 01</option>
                                                                    <option value="tr_2" {{ $item->nomor_seri == 'tr_2' ? 'selected' : '' }}>tr_2 — Troli Unit 02</option>
                                                                    <option value="tr_3" {{ $item->nomor_seri == 'tr_3' ? 'selected' : '' }}>tr_3 — Troli Unit 03</option>
                                                                    <option value="tr_4" {{ $item->nomor_seri == 'tr_4' ? 'selected' : '' }}>tr_4 — Troli Unit 04</option>
                                                                    <option value="tr_5" {{ $item->nomor_seri == 'tr_5' ? 'selected' : '' }}>tr_5 — Troli Unit 05</option>
                                                                </optgroup>
                                                                <optgroup label="Mobil Pick-up Logistik">
                                                                    <option value="pu_1" {{ $item->nomor_seri == 'pu_1' ? 'selected' : '' }}>pu_1 — Pick-up Unit 01</option>
                                                                    <option value="pu_2" {{ $item->nomor_seri == 'pu_2' ? 'selected' : '' }}>pu_2 — Pick-up Unit 02</option>
                                                                    <option value="pu_3" {{ $item->nomor_seri == 'pu_3' ? 'selected' : '' }}>pu_3 — Pick-up Unit 03</option>
                                                                    <option value="pu_4" {{ $item->nomor_seri == 'pu_4' ? 'selected' : '' }}>pu_4 — Pick-up Unit 04</option>
                                                                    <option value="pu_5" {{ $item->nomor_seri == 'pu_5' ? 'selected' : '' }}>pu_5 — Pick-up Unit 05</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                        <div class="form-field">
                                                            <label>Tanggal Perawatan <span>*</span></label>
                                                            <input type="date" name="tanggal_perawatan" value="{{ $item->tanggal_perawatan }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <button type="button" command="close" commandfor="modalEdit{{ $item->id }}" class="btn btn-secondary">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan <span>→</span></button>
                                                    </div>
                                                </form>
                                            </el-dialog-panel>
                                        </div>
                                    </dialog>
                                </el-dialog>

                                @if (auth()->user()->isAdmin())
                                    <!-- MODAL KONFIRMASI HAPUS (KHUSUS ADMIN) -->
                                    <el-dialog>
                                        <dialog id="modalDelete{{ $item->id }}" aria-labelledby="titleDelete{{ $item->id }}" class="modal-dialog">
                                            <el-dialog-backdrop class="modal-backdrop"></el-dialog-backdrop>
                                            <div tabindex="0" class="modal-positioner">
                                                <el-dialog-panel class="modal-panel">
                                                    <div class="form-section-heading">
                                                        <div class="form-section-left">
                                                            <span class="section-number" style="background:#fff3f2;color:#c53d48">!</span>
                                                            <div>
                                                                <h2 id="titleDelete{{ $item->id }}">Hapus Jadwal Perawatan?</h2>
                                                                <p>Data yang dihapus tidak dapat dikembalikan.</p>
                                                            </div>
                                                        </div>
                                                        <button type="button" command="close" commandfor="modalDelete{{ $item->id }}" class="modal-close" aria-label="Tutup">×</button>
                                                    </div>
                                                    <p style="margin:18px 0 6px;font-size:12px;color:#435068;line-height:1.6;">
                                                        Apakah Anda yakin ingin menghapus jadwal servis untuk armada <strong>{{ strtolower($item->nomor_seri) }}</strong> pada tanggal <strong>{{ $tglObj->format('d M Y') }}</strong>?
                                                    </p>
                                                    <div class="form-actions">
                                                        <button type="button" command="close" commandfor="modalDelete{{ $item->id }}" class="btn btn-secondary">Batal</button>
                                                        <a href="{{ route('perawatan.destroy', $item->id) }}" class="btn btn-danger-solid">Ya, Hapus Data</a>
                                                    </div>
                                                </el-dialog-panel>
                                            </div>
                                        </dialog>
                                    </el-dialog>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <span class="empty-icon">⌕</span>
                                    <strong>{{ request('keyword') ? 'Data perawatan tidak ditemukan' : 'Belum ada jadwal perawatan' }}</strong>
                                    <p>{{ request('keyword') ? 'Coba ubah kata kunci pencarian atau reset filter.' : 'Tambahkan jadwal perawatan baru untuk armada operasional.' }}</p>
                                    <button type="button" command="show-modal" commandfor="modalPerawatan" class="btn btn-primary btn-small">Input Perawatan</button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <!-- MODAL TAMBAH DATA (CREATE) -->
    <el-dialog>
        <dialog id="modalPerawatan" aria-labelledby="modalLabel" class="modal-dialog">
            <el-dialog-backdrop class="modal-backdrop"></el-dialog-backdrop>
            <div tabindex="0" class="modal-positioner">
                <el-dialog-panel class="modal-panel">
                    <div class="form-section-heading">
                        <div class="form-section-left">
                            <span class="section-number">01</span>
                            <div>
                                <h2 id="modalLabel">Input Perawatan Armada</h2>
                                <p>Lengkapi formulir berikut untuk menambahkan jadwal servis baru.</p>
                            </div>
                        </div>
                        <button type="button" command="close" commandfor="modalPerawatan" class="modal-close" aria-label="Tutup">×</button>
                    </div>

                    <form action="{{ route('perawatan.store') }}" method="POST">
                        @csrf
                        <div class="form-grid">
                            <div class="form-field">
                                <label for="nomor_seri">Pilih Armada & Nomor Seri <span>*</span></label>
                                <select id="nomor_seri" name="nomor_seri" required>
                                    <option value="" disabled selected>Pilih unit armada operasional...</option>
                                    <optgroup label="Forklift Operasional">
                                        <option value="fk_1">fk_1 — Forklift Unit 01</option>
                                        <option value="fk_2">fk_2 — Forklift Unit 02</option>
                                        <option value="fk_3">fk_3 — Forklift Unit 03</option>
                                        <option value="fk_4">fk_4 — Forklift Unit 04</option>
                                        <option value="fk_5">fk_5 — Forklift Unit 05</option>
                                    </optgroup>
                                    <optgroup label="Troli Gudang Hidrolik">
                                        <option value="tr_1">tr_1 — Troli Unit 01</option>
                                        <option value="tr_2">tr_2 — Troli Unit 02</option>
                                        <option value="tr_3">tr_3 — Troli Unit 03</option>
                                        <option value="tr_4">tr_4 — Troli Unit 04</option>
                                        <option value="tr_5">tr_5 — Troli Unit 05</option>
                                    </optgroup>
                                    <optgroup label="Mobil Pick-up Logistik">
                                        <option value="pu_1">pu_1 — Pick-up Unit 01</option>
                                        <option value="pu_2">pu_2 — Pick-up Unit 02</option>
                                        <option value="pu_3">pu_3 — Pick-up Unit 03</option>
                                        <option value="pu_4">pu_4 — Pick-up Unit 04</option>
                                        <option value="pu_5">pu_5 — Pick-up Unit 05</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-field">
                                <label for="tanggal_perawatan">Tanggal Perawatan <span>*</span></label>
                                <input type="date" id="tanggal_perawatan" name="tanggal_perawatan" required>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="button" command="close" commandfor="modalPerawatan" class="btn btn-secondary">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perawatan <span>→</span></button>
                        </div>
                    </form>
                </el-dialog-panel>
            </div>
        </dialog>
    </el-dialog>
@endsection
