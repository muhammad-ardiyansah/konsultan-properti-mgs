<div class="card ribbon-box">
    <div class="card-body">
        <div class="ribbon ribbon-success float-start"><i class="mdi mdi-access-point me-1"></i>Pencarian</div>
        <h5 class="text-success float-end mt-0"><i class="mdi mdi-magnify-scan"></i></h5>
        <div class="ribbon-content">   
            <form id="cari-developer" name="cari-developer" method="get" action="{{ route('konsultan.indexRegistrasiDeveloper', ['active'=>'developer']) }}">
                <div class="row">

                    <div class="col-lg-6 col-xl-6">   
                    
                        <div class="mb-3">
                            <label for="nama_developer" class="form-label">Nama Developer</label>
                            <input type="text" name="nama_developer" id="nama_developer" class="form-control" value="{{ request()->get('nama_developer') }}">
                        </div>                                
                        
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        
                        <div class="mb-3">
                            <label for="province_code" class="form-label">Asal DPD Apersi</label>
                            <select class="form-control select2" name="province_code" id="province_code" data-toggle="select2" @error('province_code') required @enderror >
                                <option value="">[- Pilih Asal DPD Apersi -]</option>
                                @foreach ($dpds as $dpd)
                                    <option value="{{ $dpd->province->code }}" {{ $dpd->province->code == request()->get('province_code') ? "selected" : "" }}>{{ $dpd->province->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>                                
                    
                </div>    

                <div class="row">
                    <div class="col-12 text-end">
                        <a href="{{ route('konsultan.indexRegistrasiDeveloper', ['active'=>'developer']) }}" class="btn btn-warning btn-m ms-3"> Reset</a>
                        <button type="Submit" class="btn btn-success"><i class="mdi mdi-magnify-scan"></i> Cari Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="card">
    <div class="card-body">


        <div class="row mb-3">

            <div class="col-sm-12 col-md-12 text-end">
                <a href="{{ route('konsultan.tambahRegistrasiDeveloper') }}" class="btn btn-primary btn-m ms-3"><i class="mdi mdi-plus"></i> Tambah Developer</a>
            </div>

        </div> 

        <div class="table-responsive">
            <table id="scroll-horizontal-datatable" class="table table-hover w-100 wrap font-14">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Developer</th>
                        <th>Nama Direktur</th>
                        <th>No. KTA Apersi</th>
                        <th>Asal DPD Apersi</th>
                        <th>No. Telpon/HP</th>
                        <th>Tgl Register</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datas as $key => $data) 
                        <tr>
                            <td>{{$datas->firstItem() + $key --}}</td>
                            <td>{{ $data->nama_perusahaan; }}</td>
                            <td>{{ $data->nama_direktur; }}</td>
                            <td>{{ $data->no_kta_apersi; }}</td>
                            <td>{{ $data->dpd_apersi->name; }}</td>
                            <td>{{ $data->no_hp; }}</td>
                            <td>@format_tgl_dMYHis($data->created_at)</td>
                            <td class="table-action">
                                <a href="{{ route('konsultan.editRekeningKonsultan', ['id' => $data->id]) }}" class="action-icon edit" title="edit"> <i class="mdi mdi-pencil"></i></a>
                                <a href="{{ route('konsultan.deleteRekeningKonsultan', ['id'=> $data->id]) }}" class="action-icon delete" title="delete" > <i class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8"> <div class="text-center">Tidak ada data</div></td>
                        </tr>
                    @endforelse                        
                </tbody>
            </table>
        </div>

        <div class="row mt-3">    
            {{ $datas->links('vendor.pagination.custom') }}
        </div>        

    </div>
</div>