@extends("layouts.app")
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Penduduk Lembah Sari</h4>
                <p class="card-description">
                    Data Penduduk Kelurahan Lembah Sari
                </p>
                <a href="/citizens" class="btn btn-sm btn-secondary btnReload"><i class="mdi mdi-refresh"></i></a>
                <a href="/citizens/create" class="btn btn-sm btn-primary btn-fw"><i
                        class="mdi mdi-plus-outline text-white"></i> Tambah Data</a>
                <!-- <a class="btn btn-sm btn-primary btn-fw float-end cetakLaporan" href="{{ route('citizens.export') }}"><i class="mdi mdi-file-excel text-white"></i> Export Data</a>  -->
                <a href="{{url('export/exportCitizen?nik='.$nik.'&kk='.$kk.'&name='.$name.'&gender='.$genderSelected.'&date_birth='.$date_birth.'&date_birth2='.$date_birth2.'&place_birth='.
                    $place_birth.'&address='.$address.'&newcomer='.$newcomer.'&religion='.$religionSelected.'&family_status='.$familyStatusSelected.'&blood='.$bloodSelected.'&job='.
                    $job.'&phone='.$phone.'&vaccine_1='.$vaccine1Selected.'&vaccine_2='.$vaccine2Selected.'&vaccine_3='.$vaccine3Selected.
                    '&rt='.$rtSelected.'&rw='.$rwSelected.'&village='.$villageSelected.'&sub_districs='.$sub_districsSelected
                    .'&province='.$provinceSelected.'&health_assurance='.$healthAssurancesSelected.'&lastEducation='.$last_educationSelected)}}" class="btn btn-sm btn-primary btn-fw float-end cetakLaporan" title="Export Excel">

                    <i class="mdi mdi-file-excel text-white"></i> Ekspor Excel</a>

                {{-- Search Modal --}}
                <button class="btn btn-sm btn-primary btn-fw float-right" data-bs-toggle="modal"
                    data-bs-target="#myModal"><i class="mdi mdi-account-search text-white"></i> Cari Data</button>
                <div class="modal" id="myModal">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form class="form-sample" action="">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cari Data Kependudukan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{-- <p class="card-description text-muted">
                                        Identitas pribadi
                                    </p>
                                    <hr class="text-muted"> --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">NIK</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="nik"
                                                        class="form-control @error('nik') is-invalid @enderror"
                                                        placeholder="Nomor Induk Kependudukan" autofocus
                                                        value="{{ old('nik') }}" />
                                                    @error('nik')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">KK</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="kk"
                                                        class="form-control @error('kk') is-invalid @enderror"
                                                        placeholder="Kartu Keluarga" value="{{ old('kk') }}" />
                                                    @error('kk')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        placeholder="Nama Lengkap" value="{{ old('name') }}" />
                                                    @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Rentang usia</label>
                                                <div class="col-sm-9 row">
                                                    <div class="col-sm-4 birth-input">
                                                        <input type="number" name="date_birth" id="date_birth" class="form-control col-md-7 input-min" value="0">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="col-form-label mySeparator">-</div>
                                                    </div>
                                                    <div class="col-sm-4 birth-input">
                                                        <input type="number" name="date_birth2" id="date_birth2" class="form-control col-md-7 input-max" value="120">
                                                    </div>

                                                    {{-- Slider date birth --}}
                                                    <div class="slider mt-3 ms-3">
                                                        <div class="progress"></div>
                                                    </div>
                                                    <div class="range-input">
                                                        <input type="range" class="range-min" min="0" max="120" value="0" class="form-control">
                                                        <input type="range" class="range-max" min="0" max="120" value="120" class="form-control">
                                                    </div>

                                                    @error('date_birth')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="gender">
                                                    <option value="">-- Pilih jenis kelamin --</option>
                                    <option value="l">Laki Laki</option>
                                    <option value="p">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="place_birth"
                                                        class="form-control @error('place_birth') is-invalid @enderror"
                                                        placeholder="Tempat Lahir"
                                                        value="{{ old('place_birth') }}" />
                                                    @error('place_birth')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Agama</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="religion">
                                                        <option value="">-- Pilih agama --</option>
                                                        <option value="Islam">Islam</option>
                                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                                        <option value="Buddha">Buddha</option>
                                                        <option value="Hindu">Hindu</option>
                                                        <option value="Konghucu">Konghucu</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Status Keluarga</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="family_status">
                                                        <option value="">-- Pilih status keluarga --</option>
                                                        <option value="head">Kepala keluarga</option>
                                                        <option value="wife">Istri</option>
                                                        <option value="child">Anak</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Golongan Darah</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="blood">
                                                        <option value="">-- Pilih golongan darah --</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="AB">AB</option>
                                                        <option value="O">O</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Pekerjaan</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('job') is-invalid @enderror"
                                                        placeholder="Pekerjaan" name="job"
                                                        value="{{ old('job') }}" />
                                                    @error('job')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nomor Telepon</label>
                                                <div class="col-sm-9">
                                                    <input type="number"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        placeholder="Nomor Telepon" name="phone"
                                                        value="{{ old('phone') }}">
                                                    @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Status Pernikahan</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="marriage">
                                                        <option value="">-- Pilih status pernikahan --</option>
                                                        <option value="Belum Kawen">Belum Menikah</option>
                                                        <option value="Kawin Tercatat">Sudah Menikah</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <p class="card-description my-3 text-muted">
                                        Alamat
                                    </p> --}}
                                    <hr class="text-muted">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">RT</label>
                                                <div class="col-sm-9">
                                                    <input type="number"
                                                        class="form-control @error('rt') is-invalid @enderror" name="rt"
                                                     value="{{ old('rt') }}" />
                                                    @error('rt')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">RW</label>
                                                <div class="col-sm-9">
                                                    <input type="number"
                                                        class="form-control @error('rw') is-invalid @enderror" name="rw"
                                                     value="{{ old('rw') }}" />
                                                    @error('rw')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Kelurahan / Desa</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('village') is-invalid @enderror"
                                                        name="village" value="{{ old('village') }}" />
                                                    @error('village')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Kecamatan</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('districts') is-invalid @enderror"
                                                        name="districts" value="{{ old('districts') }}" />
                                                    @error('districts')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Kota / Kabupaten</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('sub_districts') is-invalid @enderror"
                                                        name="sub_districts"
                                                        value="{{ old('sub_districts') }}" />
                                                    @error('sub_districts')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Provinsi</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('province') is-invalid @enderror"
                                                        name="province" value="{{ old('province') }}" />
                                                    @error('province')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <p class="card-description my-3 text-muted">
                                        Lanjutan
                                    </p> --}}
                                    <hr class="text-muted">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Tanggal Pindah</label>
                                                <div class="col-sm-9">
                                                    <input type="date"
                                                        class="form-control @error('move_date') is-invalid @enderror"
                                                        name="move_date" value="{{ old('move_date') }}" />
                                                    @error('move_date')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Tanggal Meninggal</label>
                                                <div class="col-sm-9">
                                                    <input type="date"
                                                        class="form-control @error('death_date') is-invalid @enderror"
                                                        name="death_date" value="{{ old('death_date') }}" />
                                                    @error('death_date')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Pendatang</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="newcomer">
                                                        <option value="">-- Pilih Status --</option>
                                                        <option value="ya">Ya</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <p class="card-description my-3 text-muted">
                                        Status Vaksinasi
                                    </p> --}}
                                    <hr class="text-muted">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Vaksin 1</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="vaccine_1">
                                                        <option value="">Belum Vaksin</option>
                                                        <option value="Sudah Vaksin">Sudah Vaksin</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Vaksin 2</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="vaccine_2">
                                                        <option value="">Belum Vaksin</option>
                                                        <option value="Sudah Vaksin">Sudah Vaksin</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Vaksin 3</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="vaccine_3">
                                                        <option value="">Belum Vaksin</option>
                                                        <option value="Sudah Vaksin">Sudah Vaksin</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Cari Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- End Seach Modal --}}

                {{-- Death Button --}}
                @foreach ($datas as $data)
                <div class="modal" id="deathModal">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <form action="/citizens/{{ $data->uuid }}" method="POST">
                                @method('PUT')
                                @csrf
                                <input id="uuidValidate" type="hidden" name="uuidValidate">
                                <div class="modal-header">
                                    <label>Tanggal Meninggal</label>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="date" name="death_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">OK</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

                @foreach ($datas as $data)
                <div class="modal" id="moveModal">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form action="/citizens/{{ $data->uuid }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    Penduduk Pindah
                                </div>
                                <div class="modal-body row">
                                    <input id="uuidValidate2" type="hidden" name="uuidValidate">
                                    <div class="form-group col-6">
                                            <label>Tanggal Pindah</label>
                                            <input type="date" name="move_date" class="form-control" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Pindah ke</label>
                                            <input type="text" name="move_to" class="form-control" required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success text-white">SIMPAN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach


                @if($datas->isEmpty())
                <button class="btn btn-sm btn-primary btn-fw float-right" data-bs-toggle="modal"
                    data-bs-target="#importModal"><i class="mdi mdi-account-search text-white"></i> Impor Data</button>

                <div class="modal" id="importModal">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        <form action="{{ route('citizens.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>PILIH FILE</label>
                                        <input type="file" name="file" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">IMPORT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif



                @if (session()->has('success'))

                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif


                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIK/KK</th>
                                <th colspan="2"><center>Informasi</center></th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $key => $data)

                            <tr>
                                <td>{{ $loop->iteration }} </td>
                                <td>{{ $data->name }} <b>({{ strtoupper($data->gender) }})</b><br>

                                @if($data->vaccine_1 == 'Sudah Vaksin')
                                <span class="badge badge-pill badge-primary"><i class="mdi mdi-check-circle"></i> Vaksin 1</span>
                                @endif

                                @if($data->vaccine_2 == 'Sudah Vaksin')
                                <span class="badge badge-pill badge-primary"><i class="mdi mdi-check-circle"></i> Vaksin 2</span>
                                @endif

                                @if($data->vaccine_3 == 'Sudah Vaksin')
                                <span class="badge badge-pill badge-primary"><i class="mdi mdi-check-circle"></i> Vaksin 3</span>
                                @endif


                                <td>
                                    <b>NIK:</b> {{ $data->nik }}<br>
                                    <b>KK :</b> {{ $data->kk }}


                                </td>

                                <td>

                                    <span class="d-block mb-1"><b>TTL : </b> <span>{{ $data->place_birth ?? '-' }},
                                            {!! $data->date_birth !!}
                                            @php
                                        $birthDate = new DateTime($data->date_birth);
                                        $today = new DateTime("today");
                                        $y = $today->diff($birthDate)->y;
                                        $m = $today->diff($birthDate)->m;
                                        $d = $today->diff($birthDate)->d;
                                        @endphp <b>({{ $y }} Tahun {{ $m }} Bulan {{ $d }} hari)</b></span></span>
                                    <span class="d-block mb-1"><b>Telp : </b>
                                        <span>{{ $data->phone ?? '-' }}</span></span>
                                        <span class="d-block mb-1"><b>Alamat : </b> <span>{{ $data->address ?? '-' }}<b> RT : </b>{{ $data->rt ?? '-' }}<b> RW : </b>
                                        {{ $data->rw ?? '-' }}</span></span>

                                    <span class="d-block mb-1"><b>Pekerjaan : </b>
                                        <span>{{ $data->job ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Agama : </b>
                                        <span>{{ $data->religion ?? '-' }}</span></span>
                                        <span class="d-block mb-1"><b>Disabilitas : </b>
                                        <span>{{ $data->disability ?? '-' }}</span></span>


                                </td>

                                <td>


                                    <span class="d-block mb-1"><b>Gol.Darah : </b>
                                        <span>{{ $data->blood ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Status Pernikahan : </b>{{ $data->marriage ?? '-' }}</span>
                                    <span class="d-block mb-1"><b>Status Keluarga : </b>
                                        <span>{{ $data->family_status ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Pendidikan Terakhir : </b>
                                        <span>{{ $data->last_education ?? '-' }}</span></span>
                                        <span class="d-block mb-1"><b>Asuransi Kesehatan : </b>
                                        <span>{{ $data->health_assurance ?? '-' }}</span></span>
                                        <span class="d-block mb-1"><b>DTKS : </b>
                                        <span>{{ $data->dtks ?? '-' }}</span></span>
                                @if (is_array($data->kk) || is_object($data->kk))
                                @foreach ($data->kk as $value)
                                {{$value->family_status}}
                                @endforeach
                                @endif
                                </td>
                                <td>

                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">

                                            <a href="/citizens/{{ $data->uuid }}/showkk"
                                                    class="dropdown-item"><i class="mdi mdi-account-card-details"></i>  Lihat KK</a>
                                                <div class="dropdown-divider"></div>

                                                <a href="/citizens/{{ $data->uuid }}/edit"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Edit</a>
                                                <div class="dropdown-divider"></div>


                                                {{-- Move Button --}}
                                                <button class="dropdown-item" data-bs-toggle="modal" data-id="{{ $data->uuid }}" onclick="$('#uuidValidate2').val($(this).data('id')); $('#moveModal').modal('show');"><i class="mdi mdi-folder-move"></i> Pindah</button>
                                                <div class="dropdown-divider"></div>
                                                {{-- data-bs-target="#MoveModal" --}}

                                                {{-- Death Button --}}
                                                <button class="dropdown-item" data-bs-toggle="modal" data-id="{{ $data->uuid }}" onclick="$('#uuidValidate').val($(this).data('id')); $('#deathModal').modal('show');"><i class="mdi mdi-account-minus"></i> Meninggal</button>
                                                <div class="dropdown-divider"></div>
                                                {{-- data-bs-target="#deathModal" --}}

                                                <form action="/citizens/{{ $data->uuid }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="dropdown-item" type="submit"
                                                        onclick="return confirm('Hapus data?')"><i class="mdi mdi-delete-forever"></i>Hapus</button>
                                                </form>


                                                <form class="d-none invisible"
                                                    action="/citizens/destroy/{{$data->uuid}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="dropdown-item" type="submit"
                                                        onclick="return confirm('Hapus data?')">Hapus</button>
                                                </form>

                                            </div>

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

{{-- <script type="text/javascript">
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
    myInput.focus()
    })
</script> --}}

@endsection
