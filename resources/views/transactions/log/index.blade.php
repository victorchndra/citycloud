@extends("layouts.app")
@section('content')
{{-- Isi konten --}}

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

                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Nama pengguna</th>
                                <th>Tanggal Aktivitas</th>
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                        <h1></h1>
                        <tbody>
                            @foreach($datas as $key => $data)
                                <tr>
                                    <td>{{ $loop->iteration }} </td>
                                    <td>{{ $data->description }}</td>
                                    <td>{{ $data->category }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>{{ $data->created_at}}</td>
                                    {{-- <td>
                                        <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Aksi</button>
                                                <div class="dropdown-menu">
                                                <a href="/rw/{{ $data->uuid }}/edit" class="dropdown-item">Edit</a>
                                                <div class="dropdown-divider"></div>
                                                    <form action="/rw/{{ $data->uuid }}"  method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" onclick="return confirm('Hapus data?')" class="dropdown-item">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
                    {{-- {{ $datas->links('pagination::bootstrap-5') }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
