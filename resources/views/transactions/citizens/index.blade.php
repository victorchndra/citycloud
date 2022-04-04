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
                <a href="/citizens/create" class="btn btn-sm btn-primary btn-fw"><i class="mdi mdi-plus-outline text-white"></i> Tambah Data</a>
                <!-- <a class="btn btn-sm btn-primary btn-fw float-end cetakLaporan" href="{{ route('citizens.export') }}"><i class="mdi mdi-file-excel text-white"></i> Export Data</a>  -->
                <a href="{{url('export/exportCitizen?nik='.$nik.'&kk='.$kk.'&name='.$name.'&gender='.$genderSelected.'&place_birth='.
                    $place_birth.'&address='.$address.'&religion='.$religionSelected.'&family_status='.$familyStatusSelected.'&blood='.$bloodSelected.'&job='.
                    $job.'&phone='.$phone.'&vaccine_1='.$vaccine1Selected.'&vaccine_2='.$vaccine2Selected.'&vaccine_3='.$vaccine3Selected.
                    '&rt='.$rtSelected.'&rw='.$rwSelected.'&village='.$villageSelected.'&sub_districs='.$sub_districsSelected
                    .'&province='.$provinceSelected.'&health_assurance='.$health_assuranceSelected.'&lastEducation='.$lastEducationSelected)}}" class="btn btn-sm btn-primary btn-fw float-end cetakLaporan" title="Export Excel">
                    
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
                                                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                                <div class="col-sm-9">
                                                    <input type="date" name="date_birth"
                                                        class="form-control @error('date_birth') is-invalid @enderror"
                                                        placeholder="dd/mm/yyyy"
                                                        value="{{ old('date_birth') }}" />
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
                                            {{$data->date_birth}}</span></span>
                                    <span class="d-block mb-1"><b>Telp : </b>
                                        <span>{{ $data->phone ?? '-' }}</span></span>
                                        <span class="d-block mb-1"><b>Alamat : </b> <span>{{ $data->address ?? '-' }}<b>RT : </b>{{ $data->rt ?? '-' }}<b> RW : </b>
                                        {{ $data->rw ?? '-' }}</span></span>
                           
                                    <span class="d-block mb-1"><b>Pekerjaan : </b>
                                        <span>{{ $data->job ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Agama : </b>
                                        <span>{{ $data->religion ?? '-' }}</span></span>
                                    
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
                                <td>{{$data->created_at, 'H:i:s'}}</td>
                                <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/citizens/{{ $data->uuid }}/edit"
                                                    class="dropdown-item">Edit</a>
                                                <div class="dropdown-divider"></div>

                                                <form action="/citizens/{{ $data->uuid }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="dropdown-item" type="submit"
                                                        onclick="return confirm('Hapus data?')">Hapus</button>
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

{{-- <script type="text/javascript">
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
    myInput.focus()
    })
</script> --}}

@endsection
