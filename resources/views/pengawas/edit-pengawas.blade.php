<div class="row">
    <div class="col-12">
        {{-- $errors --}}  

        @php

            $oldNoRegisterValue = old('no_register', $pengawas->no_register);
            $msgErrNoRegister = "";
            if ($errors->has('no_register') && !empty($oldNoRegisterValue)) {
                $msgErrNoRegister = "No. Register \"".$oldNoRegisterValue."\"";
                $oldNoRegisterValue = "";
            }        

            $oldNamaPerusahaanValue = old('nama_perusahaan', $pengawas->nama_perusahaan);
            $msgErrNamaPerusahaan = "";
            if ($errors->has('nama_perusahaan') && !empty($oldNamaPerusahaanValue)) {
                $msgErrNamaPerusahaan = "Nama Perusahaan \"".$oldNamaPerusahaanValue."\"";
                $oldNamaPerusahaanValue = "";
            }

            $oldNamaDirekturValue = old('nama_direktur', $pengawas->nama_direktur);

            $oldEmailValue = old('email', $pengawas->email);
            $msgErrEmail = "";
            if ($errors->has('email') && !empty($oldEmailValue)) {
                $msgErrEmail = "Email \"".$oldEmailValue."\"";
                $oldEmailValue = "";
            }

            $oldProvinceCodeValue = old('province_code', $pengawas->province_code);
            $oldCityCodeValue = old('city_code', $pengawas->city_code);
            $oldDistrictCodeValue = old('district_code', $pengawas->district_code);

            $oldAlamatValue = old('alamat', $pengawas->alamat);            
            $oldNoTelponValue = old('no_telpon', $pengawas->no_telpon);
            $msgErrNoTelpon = "";
            if ($errors->has('no_telpon') && !empty($oldNoTelponValue)) {
                $msgErrNoTelpon = "\"".$oldNoTelponValue."\"";
                $oldNoTelponValue = "";
            }            

            
        @endphp


        <form id="pengawas-form"  method="POST" action="" class="form-horizontal {{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>
        @csrf
            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Tambah</div>
                    <h5 class="text-primary float-end mt-0"><i class="uil-file-plus-alt"></i></h5>
                    <div class="ribbon-content">    

                            <div class="row mb-3">
                                <label for="no_register" class="col-3 col-form-label">No. Register</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="no_register" name="no_register" placeholder="" @error('no_register') required @enderror value="{{ $oldNoRegisterValue }}" >
                                    @error('no_register')
                                        <div class="invalid-feedback">
                                        {{ $msgErrNoRegister.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>                    


                            <div class="row mb-3">
                                <label for="nama_perusahaan" class="col-3 col-form-label">Nama perusahaan</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="" @error('nama_perusahaan') required @enderror value="{{ $oldNamaPerusahaanValue }}" >
                                    @error('nama_perusahaan')
                                        <div class="invalid-feedback">
                                        {{ $msgErrNamaPerusahaan.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>                 
                            
                            <div class="row mb-3">
                                <label for="nama_direktur" class="col-3 col-form-label">Nama Direktur</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="nama_direktur" name="nama_direktur" placeholder="" @error('nama_direktur') required @enderror value="{{ $oldNamaDirekturValue }}" >
                                    @error('nama_direktur')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-3 col-form-label">Email</label>
                                <div class="col-6">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="" @error('email') required @enderror value="{{ $oldEmailValue }}" >
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $msgErrEmail.' '.$message }}
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
                                            <option value="{{ $code }}" {{ $code == $oldProvinceCodeValue ? "selected" : "" }}>{{ $name }}</option>
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
                                        <option value="{{ $code }}" {{ $code == $oldCityCodeValue ? "selected" : "" }}>{{ $name }}</option>
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
                                        <option value="{{ $code }}" {{ $code == $oldDistrictCodeValue ? "selected" : "" }}>{{ $name }}</option>
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
                                <label for="alamat" class="col-3 col-form-label">Alamat</label>
                                <div class="col-9">
                                    <textarea class="form-control" placeholder="" id="alamat" name="alamat" style="height: 100px;" @error('alamat') required @enderror >{{ $oldAlamatValue }}</textarea>                                    
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror                       
                                </div>
                            </div>              
                            
                            <div class="row mb-3">
                                <label for="no_telpon" class="col-3 col-form-label">No. Telpon</label>
                                <div class="col-6">
                                    <div class="input-group flex-nowrap">
                                        <input type="text" class="form-control" id="no_telpon" name="no_telpon" placeholder=""  @error('no_telpon') required @enderror value="{{ $oldNoTelponValue  }}">
                                    </div>
                                    @error('no_telpon')
                                        <div class="invalid-feedback" style="display:block;">
                                            {{ $msgErrNoTelpon.' '.$message }}
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
                            <input name="id" type="hidden" value="{{ $pengawas->id; }}">
                            <input name="url_edit" type="hidden" value="{{ $urlEdit }}">
                            <input name="url_list" type="hidden" value="{{ $urlList }}">
                            <input name="is_ajax" type="hidden" value="1">     
                            <input name="validation_errors" id="validation_errors"  type="hidden" value="{{ $errors->any() ? 1 : '' }}">                   
                            <button type="Submit" class="btn btn-primary">Simpan</button>
                            <button type="Button" id="kembali-pengawas-form" class="btn btn-warning">Kembali</button>
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
    
</script>