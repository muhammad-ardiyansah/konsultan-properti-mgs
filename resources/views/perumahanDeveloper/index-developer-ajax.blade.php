    <div class="row">
        <div class="col-12">


            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-success float-start"><i class="mdi mdi-access-point me-1"></i>Pencarian</div>
                    <h5 class="text-success float-end mt-0"><i class="mdi mdi-magnify-scan"></i></h5>
                    <div class="ribbon-content">   
                        <form id="cari-perumahan" name="cari-perumahan" method="get" action="{{ route('developer.listPerumahanDeveloper') }}">
                            <div class="row">
                                
                                <div class="col-lg-6 col-xl-6">

                                    <div class="mb-3">
                                        <label for="nama_perumahan" class="form-label">Nama Perumahan</label>
                                        <input type="text" name="nama_perumahan" id="nama_perumahan" class="form-control" value="{{ request()->get('nama_perumahan') }}">
                                    </div>

                                </div>
                                
                                <div class="col-lg-6 col-xl-6 text-end mt-3">   
                                    
                                    <input name="data_per_halaman" id="data_per_halaman" type="hidden" value="{{ request()->get('data_per_halaman') }}">
                                    <a href="{{ route('developer.listPerumahanDeveloper') }}" class="btn btn-warning btn-m ms-3"> Reset</a>
                                    <button type="Submit" class="btn btn-success"><i class="mdi mdi-magnify-scan"></i> Cari Data</button>                                
                                    
                                </div>                             
                                
                            </div>    


                            <div class="row">
                                <div class="col-12 text-end">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>        

        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-sm-12 col-md-6">

                            <form class="form-horizontal">
                                <div class="row ms-1">
                                    
                                    <label for="show" class="col-sm-12 col-md-12 col-lg-3 col-xl-3 col-form-label">Tampilkan</label>
                                    <div class="col-sm-12 col-md-12 col-lg-3">

                                        <select class="form-select" id="per_halaman" name="per_halaman">
                                            @foreach ($perPageLists as $id => $per_page)
                                                <option value="{{ $id }}" {{ $id == request()->get('data_per_halaman') ? "selected" : "" }}>{{ $per_page }}</option>
                                            @endforeach
                                        </select>                                 

                                    </div>
                                    <label for="show" class="col-sm-12 col-md-12 col-lg-3 col-xl-4 col-form-label">data per halaman</label>

                                </div>
                            </form>         

                        </div>
                        <div class="col-sm-12 col-md-6 text-end">
                            <a href="javascript:void(0);" class="btn btn-primary btn-m ms-3" id="tambah-perumahan-developer"><i class="mdi mdi-plus"></i> Tambah Perumahan Developer</a>
                        </div>

                    </div>                

                    @if (Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <i class="dripicons-checkmark me-2"></i> {{ Session::get('success') }}
                        </div>
                    @endif

                    @if (Session::get('fail'))
                    <div class="alert alert-danger" role="alert">
                        <i class="dripicons-wrong me-2"></i> {{ Session::get('fail') }}
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table id="scroll-horizontal-datatable" class="table table-hover w-100 wrap font-14">
                            <thead>
                                <tr>
                                    <th>No. </th>
                                    <th>Nama Perumahan</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten/Kota</th>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th>Kampung</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($perumahanDevelopers as $key => $perumahan) 
                                <tr>
                                    <td>{{ $perumahanDevelopers->firstItem() + $key }}</td>
                                    <td>{{ $perumahan->nama_perumahan; }}</td>
                                    <td>{{ $perumahan->province->name; }}</td>
                                    <td>{{ $perumahan->city->name; }}</td>
                                    <td>{{ $perumahan->district->name; }}</td>
                                    <td>{{ $perumahan->village->name; }}</td>
                                    <td>{{ $perumahan->kampung; }}</td>
                                    <td>{{ $perumahan->alamat; }}</td>
                                    <td class="table-action">
                                        <input name="id[]" type="hidden" value="{{ $perumahan->id; }}">
                                        <a href="javascript:void(0);" class="action-icon edit" title="edit"> <i class="mdi mdi-pencil"></i></a>
                                        <a href="javascript:void(0);" class="action-icon delete" title="delete" > <i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="9"> <div class="text-center">Belum ada data</div></td>
                                    </tr>
                                @endforelse                        
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-3">    
                        {{ $perumahanDevelopers->links('vendor.pagination.custom') }}
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row-->  