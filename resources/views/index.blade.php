@extends('layouts.app')

@section('title', 'Dashboard Armada')
@section('page_title', 'Dashboard Armada')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">PENGELOLAAN ARMADA</p>
            <h1>Armada Operasional Gudang</h1>
            <p class="page-description">Daftar kategori kendaraan operasional gudang beserta nomor seri unit yang terdaftar.</p>
        </div>
        <a href="{{ route('perawatan.index') }}" class="btn btn-primary">Jadwal Perawatan <span>→</span></a>
    </div>

    <section class="fleet-grid" aria-label="Kategori Armada Operasional">
        <!-- Forklift -->
        <article class="fleet-card">
            <div class="fleet-media">
                <img src="{{ asset('image/Forklift.png') }}" alt="Forklift">
            </div>
            <div class="fleet-body">
                <div class="fleet-top">
                    <h2 class="fleet-title">Forklift Operasional</h2>
                    <span class="type-pill">fk_1..fk_5</span>
                </div>
                <div class="fleet-serials">
                    <span class="type-pill">fk_1</span>
                    <span class="type-pill">fk_2</span>
                    <span class="type-pill">fk_3</span>
                    <span class="type-pill">fk_4</span>
                    <span class="type-pill">fk_5</span>
                </div>
                <div class="fleet-actions">
                    <a href="{{ route('perawatan.index', ['keyword' => 'fk_']) }}" class="btn btn-primary">Cek Info & Perawatan <span>→</span></a>
                </div>
            </div>
        </article>

        <!-- Troli -->
        <article class="fleet-card">
            <div class="fleet-media">
                <img src="{{ asset('image/Troli.png') }}" alt="Troli">
            </div>
            <div class="fleet-body">
                <div class="fleet-top">
                    <h2 class="fleet-title">Troli Gudang Hidrolik</h2>
                    <span class="type-pill">tr_1..tr_5</span>
                </div>
                <div class="fleet-serials">
                    <span class="type-pill">tr_1</span>
                    <span class="type-pill">tr_2</span>
                    <span class="type-pill">tr_3</span>
                    <span class="type-pill">tr_4</span>
                    <span class="type-pill">tr_5</span>
                </div>
                <div class="fleet-actions">
                    <a href="{{ route('perawatan.index', ['keyword' => 'tr_']) }}" class="btn btn-primary">Cek Info & Perawatan <span>→</span></a>
                </div>
            </div>
        </article>

        <!-- Pick-up -->
        <article class="fleet-card">
            <div class="fleet-media">
                <img src="{{ asset('image/Pickup.png') }}" alt="Pickup">
            </div>
            <div class="fleet-body">
                <div class="fleet-top">
                    <h2 class="fleet-title">Mobil Pick-up Logistik</h2>
                    <span class="type-pill">pu_1..pu_5</span>
                </div>
                <div class="fleet-serials">
                    <span class="type-pill">pu_1</span>
                    <span class="type-pill">pu_2</span>
                    <span class="type-pill">pu_3</span>
                    <span class="type-pill">pu_4</span>
                    <span class="type-pill">pu_5</span>
                </div>
                <div class="fleet-actions">
                    <a href="{{ route('perawatan.index', ['keyword' => 'pu_']) }}" class="btn btn-primary">Cek Info & Perawatan <span>→</span></a>
                </div>
            </div>
        </article>
    </section>
@endsection
