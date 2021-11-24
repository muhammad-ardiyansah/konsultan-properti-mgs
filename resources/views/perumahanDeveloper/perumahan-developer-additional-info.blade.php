<div class="row mb-3">
    <label for="province" class="col-3 col-form-label">Provinsi</label>
    <div class="col-9">
        <input type="text" class="form-control" id="province" name="province" placeholder=""  value="{{ $perumahanDeveloper->province->name; }}" readonly>
        <input name="province_code" id="province_code" type="hidden" value="{{ $perumahanDeveloper->province_code; }}">
    </div>
</div>

<div class="row mb-3">
    <label for="city" class="col-3 col-form-label">Kabupaten/Kota</label>
    <div class="col-9">
        <input type="text" class="form-control" id="city" name="city" placeholder=""  value="{{ $perumahanDeveloper->city->name; }}" readonly>
    </div>
</div>

<div class="row mb-3">
    <label for="district" class="col-3 col-form-label">Kecamatan</label>
    <div class="col-9">
        <input type="text" class="form-control" id="district" name="district" placeholder=""  value="{{ $perumahanDeveloper->district->name; }}" readonly>
    </div>
</div>

<div class="row mb-3">
    <label for="village" class="col-3 col-form-label">Desa</label>
    <div class="col-9">
        <input type="text" class="form-control" id="village" name="village" placeholder=""  value="{{ $perumahanDeveloper->village->name; }}" readonly>
    </div>
</div>

@if ($perumahanDeveloper->kampung)
<div class="row mb-3">
    <label for="kampung" class="col-3 col-form-label">Kampung</label>
    <div class="col-9">
        <input type="text" class="form-control" id="kampung" name="kampung" placeholder=""  value="{{ $perumahanDeveloper->kampung; }}" readonly>
    </div>
</div>
@endif

@if ($perumahanDeveloper->alamat)
<div class="row mb-3">
    <label for="kampung" class="col-3 col-form-label">Alamat</label>
    <div class="col-9">
        <textarea class="form-control" placeholder="" id="alamat" name="alamat" style="height: 100px;" readonly>{{ $perumahanDeveloper->alamat }}</textarea>                                    
    </div>
</div>
@endif
