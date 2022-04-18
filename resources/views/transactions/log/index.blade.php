@extends("layouts.app")
@section('content')
{{-- Isi konten --}}

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Aktivitas Pengguna</h4>
                <p class="card-description">
                    Riwayat aktivitas pengguna
                </p>
                <a href="/log" class="btn btn-sm btn-secondary btnReload"><i class="mdi mdi-refresh"></i></a>

                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Pengguna</th>
                                <th>Tanggal Aktivitas</th>
                            </tr>
                        </thead>
                        <h1></h1>
                        <tbody>
                            @foreach($datas as $key => $data)
                                <tr>
                                    <td>{{ $loop->iteration }} </td>
                                    <td>{!! $data->description !!}</td>
                                    <td>{{ $data->category }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>
                                        <span>Ditambahkan Oleh: <b> {{$data->user->name}} </b></span><br>
                                            <span>{{$data->created_at, 'd M Y'}}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $datas->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
