@extends("layouts.app")
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Penduduk Meninggal</h4>
                <p class="card-description">
                    Data Penduduk Kelurahan
                    @foreach($informations as $information)
                    {{ $information->village_name  }},
                    @endforeach

                    Kecamatan
                    @foreach($informations as $information)
                    {{ $information->sub_district_name  }},
                    @endforeach

                    Kota
                    @foreach($informations as $information)
                    {{ $information->district_name  }}
                    @endforeach
                </p>
                <a href="/death" class="btn btn-sm btn-secondary btnReload"><i class="mdi mdi-refresh"></i></a>

                <!-- <a class="btn btn-sm btn-primary btn-fw float-end cetakLaporan" href="{{ route('citizens.export') }}"><i class="mdi mdi-file-excel text-white"></i> Export Data</a>  -->
                <a href="{{url('export/exportDeathCitizen?nik='.$nik.'&kk='.$kk.'&name='.$name.'&gender='.$genderSelected.'&place_birth='.
                    $place_birth.'&address='.$address.'&religion='.$religionSelected.'&family_status='.$familyStatusSelected.'&blood='.$bloodSelected.'&job='.
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
                            <form class="form-sample" action="/death" id="search_form">
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
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Disabilitas</label>
                                                <div class="col-sm-9">
                                                <select name="disability" id="disability" class="form-control">
                                                        <option value="">Semua Disabilitas</option>
                                                        @foreach($disabilitys as $disability)
                                                            <option value="{{ $disability->disability }}" @if($disabilitySelected == $disability->disability) {{ 'selected' }} @endif> {{ $disability->disability }}</option>
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
                                <th>Tanggal Meninggal</th>
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
                                        <span class="d-block mb-1"><b>Alamat : </b> <span>{{ $data->address ?? '-' }}<b>RT : </b>{{ $data->rt ?? '-' }}<b> RW : </b>
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
                                </td>
                                <td>{{$data->death_date, 'H:i:s'}}</td>
                                <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">

                                            <a href="/citizens/{{ $data->uuid }}/show"
                                                    class="dropdown-item"><i class="mdi mdi-account-card-details"></i>  Lihat KK</a>
                                                <div class="dropdown-divider"></div>
                                                
                                                {{-- <a href="/citizens/{{ $data->uuid }}/edit"
                                                    class="dropdown-item">Edit</a> --}}
                                                {{-- <div class="dropdown-divider"></div> --}}

                                                <form action="/death/{{ $data->uuid }}">
                                                    @csrf
                                                    <button class="dropdown-item" type="submit"
                                                        onclick="return confirm('Hapus data dan pindahan ke penduduk aktif?')">Hapus</button>
                                                </form>


                                                <form class="d-none invisible"
                                                    action="/citizens/destroy/{{$data->uuid}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="dropdown-item" type="submit"
                                                        onclick="return confirm('Hapus data dan pindahan ke penduduk aktif?')">Hapus</button>
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

{{-- <script type="text/javascript">
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
    myInput.focus()
    })
</script> --}}

@endsection
