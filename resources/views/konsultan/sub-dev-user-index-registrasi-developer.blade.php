<div class="card ribbon-box">
    <div class="card-body">
        <div class="ribbon ribbon-success float-start"><i class="mdi mdi-access-point me-1"></i>Pencarian</div>
        <h5 class="text-success float-end mt-0"><i class="mdi mdi-magnify-scan"></i></h5>
        <div class="ribbon-content">   
            <form id="cari-user-developer" name="cari-user-developer" method="get" action="{{ route('konsultan.indexRegistrasiDeveloper') }}">
                <div class="row">

                    <div class="col-lg-6 col-xl-6">   
                    
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ request()->get('name') }}">
                        </div>                                
                        
                    </div>

                    <div class="col-lg-6 col-xl-6">   
                    
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ request()->get('username') }}">
                        </div>                                
                        
                    </div>                                
                    
                </div>    

                <div class="row">

                    <div class="col-lg-6 col-xl-6">                                

                        <div class="mb-3">
                            <label for="developer_id" class="form-label">Developer</label>
                            <select class="form-control select2" name="developer_id" id="developer_id" data-toggle="select2" @error('developer_id') required @enderror >
                                <option value="">[- Semua Developer -]</option>
                                @foreach ($developers as $id => $nama_perusahaan)
                                    <option value="{{ $id }}" {{ $id == request()->get('developer_id') ? "selected" : "" }}>{{ $nama_perusahaan }}</option>
                                @endforeach
                            </select>                                
                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-12 text-end">
                        <input name="active" id="active" type="hidden" value="user">
                        <input name="data_per_halaman" id="data_per_halaman" type="hidden" value="{{ request()->get('data_per_halaman') }}">
                        <a href="{{ route('konsultan.indexRegistrasiDeveloper', ['active'=>'user']) }}" class="btn btn-warning btn-m ms-3"> Reset</a>
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

            <div class="col-md-6 col-lg-6 col-xl-6">                    

                <form class="form-horizontal">
                    <div class="row ms-1">
                        
                        <label for="show" class="col-sm-12 col-md-12 col-lg-3 col-xl-3 col-form-label">Tampilkan</label>
                        <div class="col-sm-12 col-md-12 col-lg-3">

                            <select class="form-select" id="per_halaman_user" name="per_halaman_user">
                                @foreach ($perPageLists as $id => $per_page)
                                    <option value="{{ $id }}" {{ $id == request()->get('data_per_halaman') ? "selected" : "" }}>{{ $per_page }}</option>
                                @endforeach
                            </select>                                 

                        </div>
                        <label for="show" class="col-sm-12 col-md-12 col-lg-3 col-xl-4 col-form-label">data per halaman</label>

                    </div>
                </form>

            </div>        

            <div class="col-md-6 col-lg-6 col-xl-6 text-end">
                <a href="{{ route('konsultan.tambahRegistrasiUserDeveloper') }}" class="btn btn-primary btn-m ms-3"><i class="mdi mdi-plus"></i> Tambah User Login</a>
            </div>

        </div>
    
        <div class="table-responsive">
            <table id="scroll-horizontal-datatable" class="table table-hover w-100 wrap font-14">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>@sortablelink('name', 'Nama User')</th>
                        <th>@sortablelink('username', 'Username Login')</th>
                        <th>Email User</th>
                        <th>Nama Developer</th>
                        <th>@sortablelink('created_at', 'Tgl. Registrasi')</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datas as $key => $data) 
                        <tr>
                            <td>{{ $datas->firstItem() + $key }}</td>
                            <td>{{ $data->name; }}</td>
                            <td>{{ $data->username; }}</td>
                            <td>{{ $data->email; }}</td>
                            <td>{{ $data->developers->first()->nama_perusahaan; }}</td>
                            <td>@format_tgl_dMYHis($data->created_at)</td>
                            <td class="table-action">
                                <a href="{{ route('konsultan.editRegistrasiUserDeveloper', ['id' => $data->id]) }}" class="action-icon edit" title="edit"> <i class="mdi mdi-pencil"></i></a>
                                <a href="{{ route('konsultan.deleteRegistrasiUserDeveloper', ['id'=> $data->id]) }}" class="action-icon delete" title="delete" > <i class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"> <div class="text-center">Tidak ada data</div></td>
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