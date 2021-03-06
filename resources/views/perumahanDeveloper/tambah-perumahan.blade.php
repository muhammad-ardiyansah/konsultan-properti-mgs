<div class="row">
    <div class="col-12">

        @php
            
            $oldNamaPerumahanValue = old('nama_perumahan');
            $msgErrNamaPerumahan = "";
            if ($errors->has('nama_perumahan') && !empty($oldNamaPerumahanValue)) {
                $msgErrNamaPerumahan = "\"".$oldNamaPerumahanValue."\"";
                $oldNamaPerumahanValue = "";
            }

        @endphp


        <form id="perumahan-developer-form"  method="POST" action="" class="form-horizontal {{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>
        @csrf
            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Tambah</div>
                    <h5 class="text-primary float-end mt-0"><i class="uil-file-plus-alt"></i></h5>
                    <div class="ribbon-content">    
                            
                            <div class="row mb-3">
                                <label for="nama_perumahan" class="col-3 col-form-label">Nama perumahan</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="nama_perumahan" name="nama_perumahan" placeholder="" @error('nama_perumahan') required @enderror value="{{ $oldNamaPerumahanValue }}" >
                                    @error('nama_perumahan')
                                        <div class="invalid-feedback">
                                        {{ $msgErrNamaPerumahan.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>                            

                            <div class="row mb-3">
                                <label for="province_code" class="col-3 col-form-label">Provinsi</label>
                                <div class="col-6">    
                                    <select class="form-control select2" name="province_code" id="province_code" data-toggle="select2" @error('province_code') required @enderror >
                                    <option value="">[- Pilih Propinsi -]</option>
                                        @foreach ($provinces as $code => $name)
                                            <option value="{{ $code }}" {{ $code == old('province_code') ? "selected" : "" }}>{{ $name }}</option>
                                        @endforeach
                                    </select>          
                                    @error('province_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                      
                            </div>

                            <div class="row mb-3">
                                <label for="city_code" class="col-3 col-form-label">Kabupaten/Kota</label>
                                <div class="col-6">    
                                    <select class="form-control select2" name="city_code" id="city_code" data-toggle="select2" @error('city_code') required @enderror >
                                    <option value="">[- Pilih Kabupaten/Kota -]</option>
                                    @foreach ($cities as $code => $name)
                                        <option value="{{ $code }}" {{ $code == old('city_code') ? "selected" : "" }}>{{ $name }}</option>
                                    @endforeach
                                    </select>          
                                    @error('city_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                      
                            </div>

                            <div class="row mb-3">
                                <label for="district_code" class="col-3 col-form-label">Kecamatan</label>
                                <div class="col-6">    
                                    <select class="form-control select2" name="district_code" id="district_code" data-toggle="select2" @error('district_code') required @enderror >
                                    <option value="">[- Pilih Kecamatan -]</option>
                                    @foreach ($districts as $code => $name)
                                        <option value="{{ $code }}" {{ $code == old('district_code') ? "selected" : "" }}>{{ $name }}</option>
                                    @endforeach                                    
                                    </select>          
                                    @error('district_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                      
                            </div>      
                            
                            <div class="row mb-3">
                                <label for="village_code" class="col-3 col-form-label">Desa/Kelurahan</label>
                                <div class="col-6">    
                                    <select class="form-control select2" name="village_code" id="village_code" data-toggle="select2" @error('village_code') required @enderror >
                                    <option value="">[- Pilih Desa/Kelurahan -]</option>
                                    @foreach ($villages as $code => $name)
                                        <option value="{{ $code }}" {{ $code == old('village_code') ? "selected" : "" }}>{{ $name }}</option>
                                    @endforeach                                    
                                    </select>          
                                    @error('village_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                      
                            </div>
                            
                            <div class="row mb-3">
                                <label for="kampung" class="col-3 col-form-label">Kampung</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="kampung" name="kampung" placeholder="Isi nama kampung jika ada" @error('kampung') required @enderror value="{{ old('kampung') }}" >
                                    @error('kampung')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>                            

                            <div class="row mb-3">
                                <label for="alamat" class="col-3 col-form-label">Alamat Lengkap Rumah</label>
                                <div class="col-9">
                                    <textarea class="form-control" placeholder="" id="alamat" name="alamat" style="height: 100px;" @error('alamat') required @enderror >{{ old('alamat') }}</textarea>                                    
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror                       
                                </div>
                            </div>              
                            
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->                       

            <div class="card widget-flat">
                <div class="card-body">
                    <div class="justify-content-end row">
                        <div class="col-9">
                            <input name="developer_id" type="hidden" value="{{ $developerId; }}">
                            <input name="url_tambah" type="hidden" value="{{ $urlTambah }}">
                            <input name="url_list" type="hidden" value="{{ $urlList }}">
                            <input name="is_ajax" type="hidden" value="1">     
                            <input name="validation_errors" id="validation_errors"  type="hidden" value="{{ $errors->any() ? 1 : '' }}">                   
                            <button type="Submit" class="btn btn-primary">Simpan</button>
                            <button type="Button" id="kembali" class="btn btn-warning">Kembali</button>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->

        </form> 

    </div>
</div>

<script>
    $('#province_code').select2({
        dropdownParent: $('#staticBackdrop')
    });
    $('#city_code').select2({
        dropdownParent: $('#staticBackdrop')
    });

    $('#district_code').select2({
        dropdownParent: $('#staticBackdrop')
    });         
    
    $('#village_code').select2({
        dropdownParent: $('#staticBackdrop')
    });
</script>