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
                    <h4 class="card-title">Data WUS/PUS</h4>
                    <p class="card-description">
                        Data WUS/PUS Kelurahan Lembah Sari
                    </p>
                    <a href="/wuspus" class="btn btn-sm btn-secondary btnReload"><i class="mdi mdi-refresh"></i></a>
                    {{-- <a href="/wuspus/create" class="btn btn-sm btn-primary btn-fw"><i
                            class="mdi mdi-plus-outline text-white"></i> Tambah Data</a> --}}
                    {{-- <a href="{{ url('export/exportMotherKb?mother_id=' . $mother_id . '&kb_name=' . $kb_name . '&kb_date=' . $kb_date) }}"
                        class="btn btn-sm btn-primary btn-fw float-end cetakLaporan" title="Export Excel"> --}}
                        
                    
                        <i class="mdi mdi-file-excel text-white"></i> Ekspor Excel</a>

                    <div class="table-responsive pt-3" >
                        <table class="table table-bordered"  >
                            <thead >
                                <tr >
                                    <th>#</th>
                                    <th style="width: 100mm">Nama WUS/PUS</th>
                                    <th style="width: 100mm">Nama Suami</th>
                                    <th>Status KK</th>
                                    <th>Kelompok Dawasima</th>
                                    <th>Yang Hidup</th>
                                    <th>Meninggal pada Umur</th>
                                    <th>Hasil Pengukuran Lingkar Lengan</th>
                                    <th style="width: 100mm">Pemberian Imun</th>
                                    <th style="width: 100mm">Jenis Kontrasepsi</th>
                                    <th>Kesertaan JKN</th>
                                    {{-- <th>Ditambahkan</th> --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key => $data)
                                    <tr>
                                        <td>{{ $data->id }} </td>
                                        <td>
                                            <strong>{{ $data->name }}</strong> <br>
                                            umur : {{ \Carbon\Carbon::parse($data->date_birth)->age }}
                                        </td> 
                                        <td>
                                            <strong>{{ $data->name }}</strong> <br>
                                            {{-- umur : {{ \Carbon\Carbon::parse($data->coupleUser->date_birth)->age }} --}}
                                        </td>
                                        <td> {{ $data->marriage }} </td>
                                        <td> klp dawasima belum</td>
                                        <td> {{ $data->number_lives }} </td>
                                        <td> tanggal meninggal belum </td>
                                        <td> {{ $data->lila }} </td>
                                        <td>
                                            Imun 1 : {{ $data->tt1 }} <br>
                                            Imun 2 : {{ $data->tt2 }} <br>
                                            Imun 3 : {{ $data->tt3 }} <br>
                                            Imun 4 : {{ $data->tt4 }} <br>
                                            Imun 5 : {{ $data->tt5 }} <br>
                                        </td>
                                        <td>
                                            {{ $data->kb_name }} <br>
                                            pada : {{ $data->kb_date }} 
                                        </td>
                                        <td> - </td> 

                                        {{-- <td> 
                                            <span>Ditambahkan Oleh: <b> {{ $data->createdUser->name }} </b></span><br>
                                            <span>{{ $data->created_at, 'd M Y' }}</span><br>
                                            @if ($data->updated_by)
                                            <br>
                                                <span>Diubah Oleh: <b> {{ $data->updatedUser->name }} </b></span> <br>
                                                <span>{{ $data->updated_at, 'd M Y' }}<br>
                                            @endif
                                        </td> --}}
                                        <td>
                                            <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown">Aksi</button>
                                                    <div class="dropdown-menu">

                                                        <a href="/motherkb/{{ $data->uuid }}/edit"
                                                            class="dropdown-item">Edit</a>

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
