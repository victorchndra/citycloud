@extends("layouts.app")
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success col-lg-12" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger col-lg-12" role="alert">
            {{ session('delete') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Ibu KB</h4>
                    <p class="card-description">
                        Data Ibu KB Kelurahan Lembah Sari
                    </p>
                    <a href="/motherkb" class="btn btn-sm btn-secondary btnReload"><i class="mdi mdi-refresh"></i></a>
                    <a href="/motherkb/create" class="btn btn-sm btn-primary btn-fw"><i
                            class="mdi mdi-plus-outline text-white"></i> Tambah Data</a>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Ibu</th>
                                    <th>Jenis KB</th>                                    
                                    <th>Tanggal KB</th>
                                    <th>Ditambahkan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key => $data)
                                    <tr>
                                        <td>{{ $data->id }} </td>
                                        <td>{{ $data->mother_id }} </td>
                                        <td>{{ $data->kb_id    }} </td>
                                        <td>{{ $data->kb_date    }} </td>                                        
                                        
                                        <td>   <span>Ditambahkan Oleh: <b> {{$data->createdUser->name}} </b></span><br>
                                            <span>{{$data->created_at, 'd M Y'}}</span><br>
                                            @if($data->updated_by)
                                            <br>
                                            <span>Diubah Oleh: <b> {{$data->updatedUser->name}} </b></span> <br>
                                            <span>{{$data->updated_at, 'd M Y'}}<br>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown">Aksi</button>
                                                    <div class="dropdown-menu">

                                                        <a href="/motherkb/{{ $data->uuid }}/edit" class="dropdown-item">Edit</a>

                                                        <div class="dropdown-divider"></div>

                                                        <form action="/motherkb/{{ $data->uuid }}" method="post"
                                                            class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">Hapus</button>
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
