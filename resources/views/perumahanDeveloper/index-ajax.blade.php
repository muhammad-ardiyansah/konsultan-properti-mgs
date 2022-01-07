

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
                <form id="cari-perumahan-developer-form" method="get" action="">
                    <div class="mb-3 col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" name="nama_perumahan" value="{{ request()->get('nama_perumahan') }}" placeholder="Ketik nama perumahan">
                            <input name="developer_id" type="hidden" value="{{ $developerId; }}">
                            <button class="btn btn-primary" type="submit">Cari Perumahan</button>
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
                        <a href="javascript:void(0);" class="dropdown-item" id="tambah-perumahan-developer"><i class="mdi mdi-bank-plus me-1"></i>Tambah Perumahan</a>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover table-centered mb-10">
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

                {{-- $perumahanDevelopers->links() --}}
                
                {{ $perumahanDevelopers->links('vendor.pagination.custom') }}
                                                

            </div> <!-- end card-body-->
        </div> <!-- end card-->

    </div>
</div>

