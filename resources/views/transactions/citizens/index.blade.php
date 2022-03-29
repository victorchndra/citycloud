@extends("layouts.app")
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Penduduk</h4>
                <p class="card-description">
                    Data Penduduk Kelurahan Lembah Sari
                </p>
                <a href="/citizens" class="btn btn-sm btn-secondary btnReload"><i class="mdi mdi-refresh"></i></a>
                <a href="/citizens/create" class="btn btn-sm btn-primary btn-fw"><i class="mdi mdi-plus-outline text-white"></i> Tambah Data</a>
                <a href="#" class="btn btn-sm btn-primary btn-fw float-right"><i class="mdi mdi-account-search text-white"></i> Cari Data</a>
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
                                <th>Nama</th>
                                <th>NIK/KK</th>
                                <th>Informasi</th>
                                <th>Ditambahkan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $key => $data)
                            <tr>
                                <td>{{ $data->id }} </td>
                                <td>{{ $data->name }} <b>({{ strtoupper($data->gender) }})</b></td>
                                <td>
                                    <b>NIK:</b> {{ $data->nik }}<br>
                                    <b>KK :</b> {{ $data->kk }}
                                </td>
                                <td>

                                    <span class="d-block mb-1"><b>TTL : </b> <span>{{ $data->place_birth ?? '-' }}, {{$data->date_birth}}</span></span>
                                    <span class="d-block mb-1"><b>Telp : </b> <span>{{ $data->phone ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>RT : </b>{{ $data->rt ?? '-' }}<b> RW : </b> {{ $data->rw ?? '-' }}</></span>
                                    <span class="d-block mb-1"><b>Pekerjaan : </b> <span>{{ $data->job ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Agama : </b> <span>{{ $data->religion ?? '-' }}</span></span>
                                </td>
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
