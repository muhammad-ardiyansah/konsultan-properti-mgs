

<div class="row">
    <div class="col-12">        
        
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

        <div class="row d-flex justify-content-end">
            <div class="col-md-6">
                <form id="cari-pengawas-form" method="get" action="">
                    <div class="mb-3 col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" name="nama_perusahaan" value="{{ request()->get('nama_perusahaan') }}" placeholder="Ketik nama pengawas">
                            <button class="btn btn-primary" type="submit">Cari Pengawas</button>
                        </div>
                    </div>
                </form>
            </div>    
        </div>

        <div class="card d-block">
            <div class="card-body">
                
            
                <div class="dropdown card-widgets">
                    <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="dripicons-dots-3"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="javascript:void(0);" class="dropdown-item" id="tambah-pengawas"><i class="mdi mdi-bank-plus me-1"></i>Tambah Pengawas</a>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover table-centered mb-10">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>No. Register</th>
                                <th>Nama Perusahaan</th>
                                <th>Direktur</th>
                                <th>Email</th>
                                <th>Provinsi</th>
                                <th>Kabupaten/Kota</th>
                                <th>Kecamatan</th>
                                <th>Alamat</th>
                                <th>No. Telpon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($pengawas as $key => $data) 
                            <tr>
                                <td>{{ $pengawas->firstItem() + $key }}</td>
                                <td>{{ $data->no_register; }}</td>
                                <td>{{ $data->nama_perusahaan; }}</td>
                                <td>{{ $data->nama_direktur }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->province->name; }}</td>
                                <td>{{ $data->city->name; }}</td>
                                <td>{{ $data->district->name; }}</td>
                                <td>{{ $data->alamat; }}</td>
                                <td>{{ $data->no_telpon; }}</td>
                                <td class="table-action">
                                    <input name="id[]" type="hidden" value="{{ $data->id; }}">
                                    <a href="javascript:void(0);" class="action-icon edit-pengawas" title="edit"> <i class="mdi mdi-pencil"></i></a>
                                    <a href="javascript:void(0);" class="action-icon delete-pengawas" title="delete" > <i class="mdi mdi-delete"></i></a>
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
                    {{ $pengawas->links('vendor.pagination.custom') }}
                </div>                                

            </div> <!-- end card-body-->
        </div> <!-- end card-->

    </div>
</div>

