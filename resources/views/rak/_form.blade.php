<div class="form-section-heading"><span class="section-number">01</span><div><h2>Identitas Rak</h2><p>Kode unik dan lokasi rak di gudang.</p></div></div>
<div class="form-grid">
    <div class="form-field">
        <label for="Kode_Rak">Kode Rak <span>*</span></label>
        <input id="Kode_Rak" name="Kode_Rak" type="text" maxlength="50" value="{{ old('Kode_Rak', $rak->Kode_Rak ?? '') }}" placeholder="Contoh: A2" {{ isset($rak) ? 'readonly' : 'required' }}>
        @error('Kode_Rak')<small class="field-error">{{ $message }}</small>@enderror
    </div>
    <div class="form-field">
        <label for="Zona">Zona <span>*</span></label>
        <input id="Zona" name="Zona" type="text" maxlength="100" value="{{ old('Zona', $rak->Zona ?? '') }}" placeholder="Contoh: Zona A" required>
        @error('Zona')<small class="field-error">{{ $message }}</small>@enderror
    </div>
    <div class="form-field">
        <label for="Lorong">Lorong <span>*</span></label>
        <input id="Lorong" name="Lorong" type="text" maxlength="100" value="{{ old('Lorong', $rak->Lorong ?? '') }}" placeholder="Contoh: Lorong 1" required>
        @error('Lorong')<small class="field-error">{{ $message }}</small>@enderror
    </div>
    <div class="form-field">
        <label for="Level">Level <span>*</span></label>
        <input id="Level" name="Level" type="number" min="0" value="{{ old('Level', $rak->Level ?? '') }}" placeholder="Contoh: 1" required>
        @error('Level')<small class="field-error">{{ $message }}</small>@enderror
    </div>
</div>

<div class="form-section-heading section-spaced"><span class="section-number">02</span><div><h2>Kapasitas dan Isi</h2><p>Daya tampung dan jenis barang di rak.</p></div></div>
<div class="form-grid">
    <div class="form-field">
        <label for="kapasitas">Kapasitas <span>*</span></label>
        <input id="kapasitas" name="kapasitas" type="number" min="0" value="{{ old('kapasitas', $rak->kapasitas ?? '') }}" placeholder="Contoh: 100" required>
        @error('kapasitas')<small class="field-error">{{ $message }}</small>@enderror
    </div>
    <div class="form-field">
        <label for="isi_rak">Isi Rak</label>
        <input id="isi_rak" name="isi_rak" type="text" maxlength="150" value="{{ old('isi_rak', $rak->isi_rak ?? '') }}" placeholder="Contoh: Elektronik">
        @error('isi_rak')<small class="field-error">{{ $message }}</small>@enderror
    </div>
</div>
