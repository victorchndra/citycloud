@extends('layouts.app')
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
                    <h4 class="card-title">Data Timbang Anak</h4>
                    <p class="card-description">
                        Data Timbang Anak
                    </p>
                    <a href="/kidsweight" class="btn btn-sm btn-secondary btnReload"><i class="mdi mdi-refresh"></i></a>
                    {{-- <a href="/kidsweight/create" class="btn btn-sm btn-primary btn-fw"><i
                            class="mdi mdi-plus-outline text-white"></i> Tambah Data</a> --}}

                    <a href="{{ url('export/exportKidsWeight?nik=' . $nik . '&name=' . $name . '&weight=' . $weight . '&height=' . $height . '&imdb=' . $imdbSelected . '&head_width=' . $headWidth . '&method_measure=' . $methodMeasureSelected . '&vitamin=' . $vitaminSelected . '&kms=' . $kmsSelected . '&imunitation=' . $imunitationSelected . '&booster=' . $boosterSelected . '&e1=' . $e1Selected . '&e2=' . $e2Selected . '&e3=' . $e3Selected . '&e4=' . $e4Selected . '&e5=' . $e5Selected . '&e6=' . $e6Selected . '&notes=' . $notes) }}"
                        class="btn btn-sm btn-primary btn-fw float-end cetakLaporan" title="Export Excel">

                        <i class="mdi mdi-file-excel text-white"></i> Ekspor Excel</a>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead style="text-align: center">
                                <tr>
                                    <th>#</th>
                                    <th>No. KK</th>
                                    <th>Anak Ke</th>
                                    <th>Data Anak</th>
                                    <th>Data Lahir</th>
                                    <th>Data Orang Tua</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key => $data)
                                    <tr style="text-align: center">
                                    <th>#</th>
                                    <td> {{ $data->kk }}</td>
                                    <td> -- Anak Ke</td>
                                    <td align="left"> 
                                        <strong>{{ $data->name }}</strong> <br>
                                        NIK : {{ $data->nik }} <br>
                                        Umur : {{ \Carbon\Carbon::parse($data->date_birth)->age }} <br>
                                        Kelamin :{{ $data->gender }}
                                    </td>
                                    <td align="left"> 
                                        Tgl. Lahir : {{ $data->date_birth }} <br>
                                        Berat : <strong>{{ $data->weight }} kg</strong><br>
                                        Tinggi : <strong>{{ $data->height }} cm</strong><br>
                                        Lingkar Kepala : <strong>{{ $data->head_width }} cm</strong>
                                    </td>
                                    <td align="left"> 
                                        Ayah : <strong>{{ $data->father_name }}</strong> <br>
                                        NIK : {{ $data->father_name }} <br><br>
                                        Ibu : <strong>{{ $data->mother_name }}</strong> <br>
                                        NIK : {{ $data->mother_name }} 
                                    </td>

                                        {{-- <td> <span>Ditambahkan Oleh: <b> {{ $data->createdUser->name }} </b></span><br>
                                            <span>{{ $data->created_at, 'd M Y' }}</span><br>
                                            @if ($data->updated_by)
                                                <br>
                                                <span>Diubah Oleh: <b> {{ $data->updatedUser->name }} </b></span> <br>
                                                <span>{{ $data->updated_at, 'd M Y' }}<br>
                                            @endif
                                        </td> --}}
                                        {{-- <td>
                                            <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown">Aksi</button>
                                                    <div class="dropdown-menu">

                                                        <a href="/kidsweight/{{ $data->uuid }}/edit"
                                                            class="dropdown-item">Edit</a>

                                                        <div class="dropdown-divider"></div>

                                                        <form action="/kidsweight/{{ $data->uuid }}" method="post"
                                                            class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">Hapus</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </td> --}}
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
