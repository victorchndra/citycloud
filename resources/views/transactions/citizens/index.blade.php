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
                <a href="/citizens/create" class="btn btn-sm btn-primary btn-fw"><i
                        class="mdi mdi-plus-outline text-white"></i> Tambah Data</a>
                <!-- <a class="btn btn-sm btn-primary btn-fw float-end cetakLaporan" href="{{ route('citizens.export') }}"><i class="mdi mdi-file-excel text-white"></i> Export Data</a>  -->
                <a href="{{url('export/exportCitizen?nik='.$nik.'&kk='.$kk.'&name='.$name.'&gender='.$genderSelected.'&place_birth='.
                    $place_birth.'&address='.$address.'&religion='.$religionSelected.'&family_status='.$familyStatusSelected.'&marriage='.$marriageSelected.'&blood='.$bloodSelected.'&job='.
                    $job.'&phone='.$phone.'&vaccine_1='.$vaccine1Selected.'&vaccine_2='.$vaccine2Selected.'&vaccine_3='.$vaccine3Selected.
                    '&rt='.$rtSelected.'&rw='.$rwSelected.'&village='.$villageSelected.'&sub_districs='.$sub_districsSelected
                    .'&province='.$provinceSelected.
                    '&health_assurance='.$healthAssurancesSelected.
                    '&last_education='.$last_educationSelected.
                    '&dtks='.$dtksSelected)}}"
                    class="btn btn-sm btn-primary btn-fw float-end cetakLaporan" title="Export Excel">

                    <i class="mdi mdi-file-excel text-white"></i> Ekspor Excel</a>

                {{-- Search Modal --}}
                <button class="btn btn-sm btn-primary btn-fw float-right" data-bs-toggle="modal"
                    data-bs-target="#myModal"><i class="mdi mdi-account-search text-white"></i> Cari Data</button>
                <div class="modal" id="myModal">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form class="form-sample" action="/citizens" id="search_form">
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
                                                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                                <div class="col-sm-9">
                                                <input type="date" name="date_birth" id="date_birth" class="form-control col-md-7" value="">
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
                                                <select name="place_birth" id="place_birth" class="form-control">
                                                        <option value="">Semua Tempat Lahir</option>
                                                        @foreach($place_births as $place_birth)
                                                            <option value="{{ $place_birth->place_birth }}" @if($place_birthSelected == $place_birth->place_birth) {{ 'selected' }} @endif> {{ $place_birth->place_birth }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Agama</label>
                                                <div class="col-sm-9">
                                                <select name="religion" id="religion" class="form-control">
                                                        <option value="">Semua Agama</option>
                                                        @foreach($religions as $religion)
                                                            <option value="{{ $religion->religion }}" @if($religionSelected == $religion->religion) {{ 'selected' }} @endif> {{ $religion->religion }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Status Keluarga</label>
                                                <div class="col-sm-9">
                                                <select name="family_status" id="family_status" class="form-control">
                                                        <option value="">Semua Status</option>
                                                        @foreach($family_statuses as $family_status)
                                                            <option value="{{ $family_status->family_status }}" @if($family_statusSelected == $family_status->family_status) {{ 'selected' }} @endif> {{ $family_status->family_status }}</option>
                                                        @endforeach
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
                                                        <option value="a">A</option>
                                                        <option value="b">B</option>
                                                        <option value="ab">AB</option>
                                                        <option value="o">O</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Pekerjaan</label>
                                                <div class="col-sm-9">
                                                <select name="job" id="job" class="form-control">
                                                        <option value="">Semua Pekerjaan</option>
                                                        @foreach($jobs as $job)
                                                            <option value="{{ $job->job }}" @if($jobSelected == $job->job) {{ 'selected' }} @endif> {{ $job->job }}</option>
                                                        @endforeach
                                                    </select>
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
                                                <select name="marriage" id="marriage" class="form-control">
                                                        <option value="">Semua Status</option>
                                                        @foreach($marriages as $marriage)
                                                            <option value="{{ $marriage->marriage }}" @if($marriageSelected == $marriage->marriage) {{ 'selected' }} @endif> {{ $marriage->marriage }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Pendidikan</label>
                                                <div class="col-sm-9">
                                                <select name="last_education" id="last_education" class="form-control">
                                                        <option value="">Semua Pendidikan</option>
                                                        @foreach($last_educations as $last_education)
                                                            <option value="{{ $last_education->last_education }}" @if($last_educationSelected == $last_education->last_education) {{ 'selected' }} @endif> {{ $last_education->last_education }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Asuransi Kesehatan</label>
                                                <div class="col-sm-9">
                                                <select name="health_assurance" id="health_assurance" class="form-control">
                                                        <option value="">Semua Asuransi</option>
                                                        @foreach($health_assurances as $health_assurance)
                                                            <option value="{{ $health_assurance->health_assurance }}" @if($healthAssurancesSelected == $health_assurance->health_assurance) {{ 'selected' }} @endif> {{ $health_assurance->health_assurance }}</option>
                                                        @endforeach
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
                                                    <select name="rt" id="rt" class="form-control">
                                                        <option value="">Semua RT</option>
                                                        @foreach($rts as $rt)
                                                            <option value="{{ $rt->rt }}" @if($rtSelected == $rt->rt) {{ 'selected' }} @endif> {{ $rt->rt }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">RW</label>
                                                <div class="col-sm-9">
                                                    <select name="rw" id="rw" class="form-control">
                                                        <option value="">Semua RW</option>
                                                        @foreach($rws as $rw)
                                                            <option value="{{ $rw->rw }}" @if($rwSelected == $rw->rw) {{ 'selected' }} @endif> {{ $rw->rw }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Kelurahan / Desa</label>
                                                <div class="col-sm-9">
                                                <select name="village" id="village" class="form-control">
                                                        @foreach($villages as $village)
                                                            <option value="{{ $village->village }}" @if($villageSelected == $village->village) {{ 'selected' }} @endif> {{ $village->village }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Kecamatan</label>
                                                <div class="col-sm-9">
                                                <select name="sub_districts" id="sub_districts" class="form-control">
                                                        @foreach($sub_districtses as $sub_districts)
                                                            <option value="{{ $sub_districts->sub_districts }}" @if($sub_districtSelected == $sub_districts->sub_districts) {{ 'selected' }} @endif> {{ $sub_districts->sub_districts }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Kota / Kabupaten</label>
                                                <div class="col-sm-9">
                                                <select name="districts" id="districts" class="form-control">
                                                        @foreach($districtses as $districts)
                                                            <option value="{{ $districts->districts }}" @if($districtsSelected == $districts->districts) {{ 'selected' }} @endif> {{ $districts->districts }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Provinsi</label>
                                                <div class="col-sm-9">
                                                <select name="province" id="province" class="form-control">
                                                        @foreach($provinces as $province)
                                                            <option value="{{ $province->province }}" @if($provinceSelected == $province->province) {{ 'selected' }} @endif> {{ $province->province }}</option>
                                                        @endforeach
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
                                                <select name="vaccine_1" id="vaccine_1" class="form-control">
                                                        @foreach($vaccine1s as $vaccine_1)
                                                            <option value="{{ $vaccine_1->vaccine_1 }}" @if($vaccine1Selected == $vaccine_1->vaccine_1) {{ 'selected' }} @endif> {{ $vaccine_1->vaccine_1 }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Vaksin 2</label>
                                                <div class="col-sm-9">
                                                <select name="vaccine_2" id="vaccine_2" class="form-control">
                                                        @foreach($vaccine1s as $vaccine_2)
                                                            <option value="{{ $vaccine_2->vaccine_2 }}" @if($vaccine1Selected == $vaccine_2->vaccine_2) {{ 'selected' }} @endif> {{ $vaccine_2->vaccine_2 }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Vaksin 3</label>
                                                <div class="col-sm-9">
                                                <select name="vaccine_3" id="vaccine_3" class="form-control">
                                                        @foreach($vaccine1s as $vaccine_3)
                                                            <option value="{{ $vaccine_3->vaccine_3 }}" @if($vaccine1Selected == $vaccine_3->vaccine_3) {{ 'selected' }} @endif> {{ $vaccine_3->vaccine_3 }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="card-description my-3 text-muted">
                                        Status DTKS
                                    </p>
                                    <hr class="text-muted">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Status DTKS</label>
                                                <div class="col-sm-9">
                                                <select name="dtks" id="dtks" class="form-control">
                                                <option value="">Semua Status DTKS</option>
                                                        @foreach($dtkses as $dtks)
                                                            <option value="{{ $dtks->dtks }}" @if($dtksSelected == $dtks->dtks) {{ 'selected' }} @endif> {{ $dtks->dtks }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" onclick="form_submit()" data-bs-dismiss="modal">Cari
                                        Data</button>
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
                                @method('PUT');
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
                                <th colspan="2">
                                    <center>Informasi</center>
                                </th>
                                <th>Ditambahkan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $key => $data)

                            <tr>
                                <td>{{ $loop->iteration }} </td>
                                <td>{{ $data->name }} <b>({{ strtoupper($data->gender) }})</b><br>

                                    @if($data->vaccine_1 == 'Sudah Vaksin')
                                    <span class="badge badge-pill badge-primary"><i class="mdi mdi-check-circle"></i>
                                        Vaksin 1</span>
                                    @endif

                                    @if($data->vaccine_2 == 'Sudah Vaksin')
                                    <span class="badge badge-pill badge-primary"><i class="mdi mdi-check-circle"></i>
                                        Vaksin 2</span>
                                    @endif

                                    @if($data->vaccine_3 == 'Sudah Vaksin')
                                    <span class="badge badge-pill badge-primary"><i class="mdi mdi-check-circle"></i>
                                        Vaksin 3</span>
                                    @endif


                                <td>
                                    <b>NIK:</b> {{ $data->nik }}<br>
                                    <b>KK :</b> {{ $data->kk }}


                                </td>
                                <td>

                                    <span class="d-block mb-1"><b>TTL : </b> <span>{{ $data->place_birth ?? '-' }},
                                            {{$data->date_birth}}</span></span>
                                    <span class="d-block mb-1"><b>Telp : </b>
                                        <span>{{ $data->phone ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Alamat : </b> <span>{{ $data->address ?? '-' }} <b>RT :
                                            </b>{{ $data->rt ?? '-' }}<b> RW : </b>
                                            {{ $data->rw ?? '-' }}</span></span>

                                    <span class="d-block mb-1"><b>Pekerjaan : </b>
                                        <span>{{ $data->job ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Agama : </b>
                                        <span>{{ $data->religion ?? '-' }}</span></span>

                                </td>
                                <td>


                                    <span class="d-block mb-1"><b>Gol.Darah : </b>
                                        <span>{{ $data->blood ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Status Pernikahan :
                                        </b>{{ $data->marriage ?? '-' }}</span>
                                    <span class="d-block mb-1"><b>Status Keluarga : </b>
                                        <span>{{ $data->family_status ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Pendidikan Terakhir : </b>
                                        <span>{{ $data->last_education ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Asuransi Kesehatan : </b>
                                        <span>{{ $data->health_assurance ?? '-' }}</span></span>
                                </td>
                                <td>   <span>Ditambahkan Oleh: <b> {{$data->createdUser->name}} </b></span><br>
                                        <span>{{$data->created_at, 'd M Y'}}</span><br>
                                        @if($data->updated_by)
                                        <br>
                                        <span>Diubah Oleh: <b> {{$data->updatedUser->name}} </b></span> <br>
                                        <span>{{$data->updated_at, 'd M Y'}}<br>
                                        @endif
                                <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/citizens/{{ $data->uuid }}/edit"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Edit</a>
                                                <div class="dropdown-divider"></div>

                                                <a href="/citizens/{{ $data->uuid }}/show"
                                                    class="dropdown-item"><i class="mdi mdi-account-card-details"></i>  Lihat KK</a>
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
                                        </div>
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

<script type="text/javascript">
    function form_submit() {
        document.getElementById("search_form").submit();
    }

    // $(document).ready(function(){
    //     $(document).on("click", ".passingID", function () {
    //         var ids = $(this).data('id');
    //         // $("#deathModal").modal('show');
    //         $("#uuidValidate").val(ids);
    //     });
    // });
</script>

@endsection
