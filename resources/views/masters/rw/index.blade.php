@extends("layouts.app")
@section('content')

@if(session()->has('success'))
<div class="alert alert-success col-lg-10" role="alert">
  {{ session('success')}}
</div>
@endif

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data RW</h4>
                <p class="card-description">
                    Data RW Kelurahan Lembah Sari
                </p>
                <a href="/rw" class="btn btn-sm btn-secondary btnReload"><i class="mdi mdi-refresh"></i></a>
                <a href="/rw/create" class="btn btn-sm btn-primary btn-fw"><i class="mdi mdi-plus-outline text-white"></i> Tambah Data</a>
                <a href="#" class="btn btn-sm btn-primary btn-fw float-right"><i class="mdi mdi-account-search text-white"></i> Cari Data</a>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Created By</th>
                                <th>Update By</th>
                                <th>Deleted By</th>
                                <th>Created At</th>
                                <th>Update At</th>
                                <th>Delete At</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $key => $data)
                            <tr>
                                <td>{{ $data->id }} </td>
                                <td>{{ $data->name}} </td>
                                <td>{{ $data->created_by}}</td>
                                <td>{{ $data->update_by}}</td>
                                <td>{{ $data->deleted_by}}</td>
                                <td>{{ $data->created_at, 'H:i:s'}}</td>
                                <td>{{ $data->created_at, 'H:i:s'}}</td>
                                <td>{{$data->created_at, 'H:i:s'}}</td>
                                <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                            <a class="dropdown-item">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $datas->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

