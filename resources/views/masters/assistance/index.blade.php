@extends("layouts.app")
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Master</h4>
                <p class="card-description">
                    Data Bantuan Sosial
                </p>
                <a href="/assistance" class="btn btn-sm btn-secondary btnReload"><i class="mdi mdi-refresh"></i></a>
                <a href="/assistance/create" class="btn btn-sm btn-primary btn-fw"><i class="mdi mdi-plus-outline text-white"></i> Tambah Data</a>
                {{-- <a href="#" class="btn btn-sm btn-primary btn-fw float-right"><i class="mdi mdi-account-search text-white"></i> Cari Data</a> --}}

                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Bantuan</th>
                                <th>Nominal</th>
                                <th>Ditambahkan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $key => $data)
                            <tr>
                                <td>{{ $data->id }} </td>
                                <td>{{ $data->name }} </td>
                                <td>{{ $data->nominal }} </td>
                                <td>   <span>Ditambahkan Oleh: <b> {{$data->createdUser->name}} </b></span><br>
                                    <span>{{$data->created_at, 'd M Y'}}</span><br>
                                    @if($data->updated_by)
                                    <br>
                                    <span>Diubah Oleh: <b> {{$data->updatedUser->name}} </b></span> <br>
                                    <span>
                                        {{$data->updated_at, 'd M Y'}}<br>
                                    </span>
                                    @endif
                            </td>
                                <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                            <a href="/assistance/{{ $data->uuid }}/edit" class="dropdown-item">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <form action="/assistance/{{ $data->uuid }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="dropdown-item" type="submit" onclick="return confirm('Hapus data?')">Hapus</button>
                                            </form>
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
