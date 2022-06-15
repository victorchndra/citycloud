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
                    <h4 class="card-title">Data Ibu Hamil</h4>
                    <p class="card-description">
                        Data Ibu Hamil
                    </p>
                    <a href="/motherpregnant" class="btn btn-sm btn-secondary btnReload"><i class="mdi mdi-refresh"></i></a>
                    <a href="/motherpregnant/create" class="btn btn-sm btn-primary btn-fw"><i
                            class="mdi mdi-plus-outline text-white"></i> Tambah Data</a>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Ibu</th>
                                    <th>Berat badan sebelum dan sesudah hamil</th>
                                    <th>Tinggi Badan</th>
                                    <th>Hamil Ke</th>
                                    <th>Usia Kehamilan</th>
                                    <th>Penyakit Penyerta</th>
                                    <th>Lila (Lingkar Lengan Atas)</th>
                                    <th>Periksa Kehamilan</th>
                                    <th>Jumlah Hidup</th>
                                    <th>Jumlah Meninggal</th>
                                    <th>Tanggal Meninggal</th>
                                    <th>tt1</th>
                                    <th>tt2</th>
                                    <th>tt3</th>
                                    <th>tt4</th>
                                    <th>tt5</th>
                                    <th>Ditambahkan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key => $data)
                                    <tr>
                                        <td>{{ $data->id }} </td>
                                        <td>{{ $data->motherUser->citizen_id }}{{$data->motherUser->name}} </b></td>
                                        <td>{{ $data->weight }} </b></td>
                                        <td>{{ $data->height }} </b></td>
                                        <td>{{ $data->pregnant_to }} </b></td>
                                        <td>{{ $data->gestational_age }} </b></td>
                                        <td>{{ $data->disease }} </b></td>
                                        <td>{{ $data->check_pregnancy }} </b></td>
                                        <td>{{ $data->lila }} </b></td>
                                        <td>{{ $data->number_lives }} </b></td>
                                        <td>{{ $data->number_death }} </b></td>
                                        <td>{{ $data->meninggal }} </b></td>
                                        <td>{{ $data->tt1 }} </b></td>
                                        <td>{{ $data->tt2 }} </b></td>
                                        <td>{{ $data->tt3 }} </b></td>
                                        <td>{{ $data->tt4 }} </b></td>
                                        <td>{{ $data->tt5 }} </b></td>
                                        
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

                                                        <a href="/motherpregnant/{{ $data->uuid }}/edit" class="dropdown-item">Edit</a>

                                                        <div class="dropdown-divider"></div>

                                                        <form action="/motherpregnant/{{ $data->uuid }}" method="post"
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
