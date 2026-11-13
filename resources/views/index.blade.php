@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- =========================================================================
         OFFICIAL TAILWIND PLUS <el-tab-group> + GOLDEN RATIO (7 : 5)
    ========================================================================== -->
    <el-tab-group class="block">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- KOLOM KIRI (7 Kolom): <el-tab-list> Daftar Armada Operasional -->
            <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-5">
                    <div class="flex items-center gap-2">
                        <h2 class="text-lg font-extrabold text-slate-900">Armada Operasional Gudang</h2>
                    </div>
                    <a href="{{ route('perawatan.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-3 py-2 rounded-xl transition shrink-0">
                        <span>Buka Jadwal Perawatan</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>

                <!-- Tailwind Plus Official <el-tab-list> -->
                <el-tab-list class="block space-y-4">
                    <!-- TAB BUTTON 1: FORKLIFT -->
                    <button type="button"
                            class="w-full text-left cursor-pointer rounded-2xl border-2 border-slate-200/90 bg-white aria-selected:border-blue-600 aria-selected:bg-blue-50/35 aria-selected:ring-2 aria-selected:ring-blue-500/15 hover:border-blue-300 p-5 transition-all duration-200 hover:shadow-md relative overflow-hidden group focus:outline-none">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="space-y-3 flex-1">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="font-mono text-xs font-bold text-slate-400">SERI UNIT:</span>
                                    <span class="font-mono text-sm font-extrabold text-slate-900">fk_1 s/d fk_5</span>
                                </div>
                                <div>
                                    <h3 class="text-xl font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors">Forklift Operasional</h3>
                                </div>
                                <div class="pt-1 flex flex-wrap items-center gap-2.5">
                                    <span onclick="window.location.href='{{ route('perawatan.index') }}'; event.stopPropagation();"
                                          class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold shadow-sm shadow-blue-600/20 transition">
                                        <span>Cek Info & Perawatan</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="w-full sm:w-44 h-32 rounded-xl bg-white border border-slate-200/80 p-2 flex items-center justify-center shrink-0 shadow-2xs">
                                <img src="{{ asset('image/Forklift.png') }}" alt="Forklift" class="max-h-28 w-auto object-contain group-hover:scale-105 transition-transform duration-300">
                            </div>
                        </div>
                    </button>

                    <!-- TAB BUTTON 2: TROLI -->
                    <button type="button"
                            class="w-full text-left cursor-pointer rounded-2xl border-2 border-slate-200/90 bg-white aria-selected:border-blue-600 aria-selected:bg-blue-50/35 aria-selected:ring-2 aria-selected:ring-blue-500/15 hover:border-blue-300 p-5 transition-all duration-200 hover:shadow-md relative overflow-hidden group focus:outline-none">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="space-y-3 flex-1">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="font-mono text-xs font-bold text-slate-400">SERI UNIT:</span>
                                    <span class="font-mono text-sm font-extrabold text-slate-900">tr_1 s/d tr_5</span>
                                </div>
                                <div>
                                    <h3 class="text-xl font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors">Troli Gudang Hidrolik</h3>
                                </div>
                                <div class="pt-1 flex flex-wrap items-center gap-2.5">
                                    <span onclick="window.location.href='{{ route('perawatan.index', ['keyword' => 'tr_']) }}'; event.stopPropagation();"
                                          class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold shadow-sm shadow-blue-600/20 transition">
                                        <span>Cek Info & Perawatan</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="w-full sm:w-44 h-32 rounded-xl bg-slate-50 border border-slate-200/80 p-2 flex items-center justify-center shrink-0">
                                <img src="{{ asset('image/Troli.png') }}" alt="Troli" class="max-h-28 w-auto object-contain group-hover:scale-105 transition-transform duration-300">
                            </div>
                        </div>
                    </button>

                    <!-- TAB BUTTON 3: PICKUP -->
                    <button type="button"
                            class="w-full text-left cursor-pointer rounded-2xl border-2 border-slate-200/90 bg-white aria-selected:border-blue-600 aria-selected:bg-blue-50/35 aria-selected:ring-2 aria-selected:ring-blue-500/15 hover:border-blue-300 p-5 transition-all duration-200 hover:shadow-md relative overflow-hidden group focus:outline-none">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="space-y-3 flex-1">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="font-mono text-xs font-bold text-slate-400">SERI UNIT:</span>
                                    <span class="font-mono text-sm font-extrabold text-slate-900">pu_1 s/d pu_5</span>
                                </div>
                                <div>
                                    <h3 class="text-xl font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors">Mobil Pick-up Logistik</h3>
                                </div>
                                <div class="pt-1 flex flex-wrap items-center gap-2.5">
                                    <span onclick="window.location.href='{{ route('perawatan.index', ['keyword' => 'pu_']) }}'; event.stopPropagation();"
                                          class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold shadow-sm shadow-blue-600/20 transition">
                                        <span>Cek Info & Perawatan</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="w-full sm:w-44 h-32 rounded-xl bg-slate-50 border border-slate-200/80 p-2 flex items-center justify-center shrink-0">
                                <img src="{{ asset('image/Pickup.png') }}" alt="Pickup" class="max-h-28 w-auto object-contain group-hover:scale-105 transition-transform duration-300">
                            </div>
                        </div>
                    </button>
                </el-tab-list>
            </div>

            <!-- KOLOM KANAN (5 Kolom): <el-tab-panels> Bento Preview Armada -->
            <div class="lg:col-span-5">
                <el-tab-panels class="block">

                    <!-- PANEL 1: FORKLIFT HERO BENTO CARD -->
                    <div class="bg-blue-600 text-white rounded-2xl p-6 shadow-lg shadow-blue-600/25 relative overflow-hidden focus:outline-none">
                        <div class="absolute -right-10 -top-10 w-44 h-44 rounded-full bg-blue-500/30 blur-2xl pointer-events-none"></div>
                        <div class="flex items-center gap-3 relative z-10">
                            <div class="w-12 h-12 rounded-xl bg-white text-blue-600 font-extrabold flex items-center justify-center shadow-sm shrink-0">
                                <span class="font-mono text-sm">FK</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-extrabold text-white tracking-tight">Forklift Operasional</h3>
                            </div>
                        </div>

                        <div class="my-5 bg-white/95 rounded-2xl p-6 flex items-center justify-center shadow-inner relative z-10">
                            <img src="{{ asset('image/Forklift.png') }}" alt="Forklift" class="max-h-40 w-auto object-contain">
                        </div>

                        <div class="relative z-10">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-blue-200 block mb-2">Daftar Nomor Seri Terdaftar:</span>
                            <div class="flex flex-wrap gap-1.5">
                                <span class="px-2.5 py-1 rounded-lg bg-white text-blue-700 font-mono text-xs font-bold shadow-2xs">fk_1</span>
                                <span class="px-2.5 py-1 rounded-lg bg-blue-700/80 text-white border border-blue-400/30 font-mono text-xs font-semibold">fk_2</span>
                                <span class="px-2.5 py-1 rounded-lg bg-blue-700/80 text-white border border-blue-400/30 font-mono text-xs font-semibold">fk_3</span>
                                <span class="px-2.5 py-1 rounded-lg bg-blue-700/80 text-white border border-blue-400/30 font-mono text-xs font-semibold">fk_4</span>
                                <span class="px-2.5 py-1 rounded-lg bg-blue-700/80 text-white border border-blue-400/30 font-mono text-xs font-semibold">fk_5</span>
                            </div>
                        </div>
                    </div>

                    <!-- PANEL 2: TROLI HERO BENTO CARD -->
                    <div hidden class="bg-blue-600 text-white rounded-2xl p-6 shadow-lg shadow-blue-600/25 relative overflow-hidden focus:outline-none">
                        <div class="absolute -right-10 -top-10 w-44 h-44 rounded-full bg-blue-500/30 blur-2xl pointer-events-none"></div>
                        <div class="flex items-center gap-3 relative z-10">
                            <div class="w-12 h-12 rounded-xl bg-white text-blue-600 font-extrabold flex items-center justify-center shadow-sm shrink-0">
                                <span class="font-mono text-sm">TR</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-extrabold text-white tracking-tight">Troli Gudang Hidrolik</h3>
                            </div>
                        </div>

                        <div class="my-5 bg-white/95 rounded-2xl p-6 flex items-center justify-center shadow-inner relative z-10">
                            <img src="{{ asset('image/Troli.png') }}" alt="Troli" class="max-h-40 w-auto object-contain">
                        </div>

                        <div class="relative z-10">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-blue-200 block mb-2">Daftar Nomor Seri Terdaftar:</span>
                            <div class="flex flex-wrap gap-1.5">
                                <span class="px-2.5 py-1 rounded-lg bg-white text-blue-700 font-mono text-xs font-bold shadow-2xs">tr_1</span>
                                <span class="px-2.5 py-1 rounded-lg bg-blue-700/80 text-white border border-blue-400/30 font-mono text-xs font-semibold">tr_2</span>
                                <span class="px-2.5 py-1 rounded-lg bg-blue-700/80 text-white border border-blue-400/30 font-mono text-xs font-semibold">tr_3</span>
                                <span class="px-2.5 py-1 rounded-lg bg-blue-700/80 text-white border border-blue-400/30 font-mono text-xs font-semibold">tr_4</span>
                                <span class="px-2.5 py-1 rounded-lg bg-blue-700/80 text-white border border-blue-400/30 font-mono text-xs font-semibold">tr_5</span>
                            </div>
                        </div>
                    </div>

                    <!-- PANEL 3: PICKUP HERO BENTO CARD -->
                    <div hidden class="bg-blue-600 text-white rounded-2xl p-6 shadow-lg shadow-blue-600/25 relative overflow-hidden focus:outline-none">
                        <div class="absolute -right-10 -top-10 w-44 h-44 rounded-full bg-blue-500/30 blur-2xl pointer-events-none"></div>
                        <div class="flex items-center gap-3 relative z-10">
                            <div class="w-12 h-12 rounded-xl bg-white text-blue-600 font-extrabold flex items-center justify-center shadow-sm shrink-0">
                                <span class="font-mono text-sm">PU</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-extrabold text-white tracking-tight">Mobil Pick-up Logistik</h3>
                            </div>
                        </div>

                        <div class="my-5 bg-white/95 rounded-2xl p-6 flex items-center justify-center shadow-inner relative z-10">
                            <img src="{{ asset('image/Pickup.png') }}" alt="Pickup" class="max-h-40 w-auto object-contain">
                        </div>

                        <div class="relative z-10">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-blue-200 block mb-2">Daftar Nomor Seri Terdaftar:</span>
                            <div class="flex flex-wrap gap-1.5">
                                <span class="px-2.5 py-1 rounded-lg bg-white text-blue-700 font-mono text-xs font-bold shadow-2xs">pu_1</span>
                                <span class="px-2.5 py-1 rounded-lg bg-blue-700/80 text-white border border-blue-400/30 font-mono text-xs font-semibold">pu_2</span>
                                <span class="px-2.5 py-1 rounded-lg bg-blue-700/80 text-white border border-blue-400/30 font-mono text-xs font-semibold">pu_3</span>
                                <span class="px-2.5 py-1 rounded-lg bg-blue-700/80 text-white border border-blue-400/30 font-mono text-xs font-semibold">pu_4</span>
                                <span class="px-2.5 py-1 rounded-lg bg-blue-700/80 text-white border border-blue-400/30 font-mono text-xs font-semibold">pu_5</span>
                            </div>
                        </div>
                    </div>

                </el-tab-panels>
            </div>

        </div>
    </el-tab-group>

</div>
@endsection
