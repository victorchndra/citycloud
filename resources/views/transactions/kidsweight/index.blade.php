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
                    <a href="/kidsweight/create" class="btn btn-sm btn-primary btn-fw"><i
                            class="mdi mdi-plus-outline text-white"></i> Tambah Data</a>

                    <a href="{{ url('export/exportKidsWeight?nik=' . $nik . '&name=' . $name . '&weight=' . $weight . '&height=' . $height . '&imdb=' . $imdbSelected . '&head_width=' . $headWidth . '&method_measure=' . $methodMeasureSelected . '&vitamin=' . $vitaminSelected . '&kms=' . $kmsSelected . '&imunitation=' . $imunitationSelected . '&booster=' . $boosterSelected . '&e1=' . $e1Selected . '&e2=' . $e2Selected . '&e3=' . $e3Selected . '&e4=' . $e4Selected . '&e5=' . $e5Selected . '&e6=' . $e6Selected . '&notes=' . $notes) }}"
                        class="btn btn-sm btn-primary btn-fw float-end cetakLaporan" title="Export Excel">

                        <i class="mdi mdi-file-excel text-white"></i> Ekspor Excel</a>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered" style="width: 500mm">
                            <thead style="text-align: center">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Anak</th>
                                    <th>Tinggi Badan dan<br> Berat Badan</th>
                                    <th>Lingkar <br>Kepala</th>
                                    <th>Memiliki <br> Buku KMS</th>
                                    <th>IMDB</th>
                                    <th>Cara Ukur</th>
                                    <th>Vitamin A</th>
                                    <th>Nama<br> Imunisasi</th>
                                    <th>Tanggal <br>Imunisasi</th>
                                    <th>Booster</th>
                                    <th>e</th>
                                    <th>Catatan</th>
                                    <th>Ditambahkan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key => $data)
                                    <tr style="text-align: center">
                                        <td>{{ $data->id }} </td>
                                        <td>{{ $data->name }} </b></td>
                                        <td>Tinggi : {{ $data->height }} cm <br> Berat : {{ $data->weight }} kg </b>
                                        </td>
                                        <td>{{ $data->head_width }} cm</b></td>
                                        <td>{{ $data->kms }} </b></td>
                                        <td>{{ $data->imdb }} </b></td>
                                        <td>{{ $data->method_measure }} </b></td>
                                        <td>{{ $data->vitamin }} </b></td>
                                        <td>{{ $data->imunitation }} </b></td>
                                        <td>{{ $data->imunitation_date }} </b></td>
                                        <td>{{ $data->booster }} </b></td>
                                        <td><b>e1</b> : {{ $data->e1 }}, <b>e2</b> : {{ $data->e2 }}<br>
                                            <b>e3</b> : {{ $data->e1 }}, <b>e4</b> : {{ $data->e2 }}<br>
                                            <b>e5</b> : {{ $data->e1 }}, <b>e6</b> : {{ $data->e2 }}</b>
                                        </td>
                                        <td>{{ $data->notes }} </b></td>

                                        <td> <span>Ditambahkan Oleh: <b> {{ $data->createdUser->name }} </b></span><br>
                                            <span>{{ $data->created_at, 'd M Y' }}</span><br>
                                            @if ($data->updated_by)
                                                <br>
                                                <span>Diubah Oleh: <b> {{ $data->updatedUser->name }} </b></span> <br>
                                                <span>{{ $data->updated_at, 'd M Y' }}<br>
                                            @endif
                                        </td>
                                        <td>
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
