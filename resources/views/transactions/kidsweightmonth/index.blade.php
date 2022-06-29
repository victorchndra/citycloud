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

                    <a href="{{ url('export/exportKidsWeightMonth?name=' . $name . '&nik=' . $nik . '&weight=' . $weight . '&height=' . $height) }}"
                        class="btn btn-sm btn-primary btn-fw float-end cetakLaporan" title="Export Excel">

                        <i class="mdi mdi-file-excel text-white"></i> Ekspor Excel</a>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead style="text-align: center">
                                <tr>
                                    <th>#</th>
                                    <th>No. KK</th>
                                    <th>Orang Tua</th>
                                    <th>Data Anak</th>
                                    <th>Anak Ke</th>
                                    <th>
                                        Tinggi Badan | Berat Badan <br>
                                        Lingkar Kepala
                                    </th>
                                    {{-- <th>Lingkar Kepala</th> --}}
                                    <th>KMS</th>
                                    <th>IMDB</th>
                                    <th>Vitamin</th>
                                    <th>Imunisasi</th>
                                    <th>Booster</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key => $data)
                                    <tr style="text-align: center">
                                    <th>#</th>
                                    <td> {{ $data->kk }}</td>
                                    <td align="left"> 
                                        Ayah : <strong>{{ $data->father_name }}</strong> <br>
                                        {{-- nik : <strong>{{ $data->fatherUser->name }}</strong> <br><br> --}}
                                        
                                        Ibu : <strong>{{ $data->mother_name }}</strong> 
                                        {{-- nik : <strong>{{ $data->motherUser->name }}</strong> <br><br> --}}
                                    </td>
                                    <td align="left"> 
                                        <strong>{{ $data->name }}</strong> <br>
                                        NIK : {{ $data->nik }} <br>
                                        Tgl. Lahir : {{ $data->date_birth }} <strong>[{{ \Carbon\Carbon::parse($data->date_birth)->age }} tahun]</strong> <br>
                                        Gender : {{ $data->gender }}
                                    </td>
                                    <td> {{ $data->num_of_child }}</td>
                                    <td > 
                                        Berat : <strong>{{ $data->weight }} kg</strong> |
                                        Tinggi : <strong>{{ $data->height }} cm</strong><br>
                                        Lingkar Kepala : <strong>{{ $data->head_width }} cm</strong>
                                    </td>
                                    {{-- <td> {{ $data->head_width }} cm </td> --}}
                                    <td>@if ($data->kms == 1) Ya @elseif ($data->kms == 0)) Tidak @else - @endif</td> 
                                    <td> {{ $data->imdb }} </td>
                                    <td> {{ $data->vitamin }} </td>
                                    <td> {{ $data->imunitation }} </td>
                                    <td> {{ $data->booster }} </td>

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
