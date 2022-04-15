@extends("layouts.app")
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Pengguna</h4>
                <p class="card-description">
                    Data Pengguna Kelurahan Lembah Sari
                </p>
                <a href="citizens" class="btn btn-sm btn-secondary btnReload"><i class="mdi mdi-refresh"></i></a>
                <a href="/users/create" class="btn btn-sm btn-primary btn-fw"><i class="mdi mdi-plus-outline text-white"></i> Tambah Data</a>
                <!-- wajib pakai route href nya kalo mau export atau nge blank hasilnya -->
                <!-- <a class="btn btn-warning float-end" href="{{ route('users.export') }}">Export User Data</a> -->

                <div class="table-responsive pt-3">

                @if (session()->has('success'))

                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Informasi</th>
                                <th>Ditambahkan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $key => $data)
                            <tr>
                                <td>{{ $loop->iteration }} </td>
                                <td>{{ $data->name }} </b></td>
                                <td>{{ $data->username }}</td>
                                <td>
                                    <span class="d-block mb-1"><b>Telp : </b> <span>{{ $data->phone ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Alamat : </b> <span>{{ $data->address ?? '-' }}</span></span>
                                </td>
                                <td>{{$data->created_at, 'H:i:s'}}</td>
                                <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/users/{{ $data->uuid }}/edit">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <form action="/users/{{ $data->uuid }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Hapus pengguna?')">Hapus</button>
                                            </form>
                                            <form class="d-none invisible"
                                                action="/users/destroy/{{$data->uuid}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="dropdown-item" type="submit"
                                                    onclick="return confirm('Hapus data?')">Hapus</button>
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
