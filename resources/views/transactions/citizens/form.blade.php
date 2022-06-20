@extends("layouts.app")

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Kependudukan</h4>
            <form class="form-sample" action="/citizens" method="POST">
                @csrf
                <p class="card-description my-3 text-muted">
                    Identitas pribadi
                </p>
                <hr class="text-muted">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="number" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="Nomor Induk Kependudukan" autofocus value="{{ old('nik') }}"/>
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
                                <input type="number" name="kk" class="form-control @error('kk') is-invalid @enderror" placeholder="Kartu Keluarga" value="{{ old('kk') }}"/>
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
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" required value="{{ old('name') }}"/>
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
                                <input type="date" name="date_birth" class="form-control @error('date_birth') is-invalid @enderror" placeholder="Y-m-d" required value="{{ old('date_birth') }}"/>
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
                                    <option value="l">Laki-laki</option>
                                    <option value="p">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" name="place_birth" class="form-control @error('place_birth') is-invalid @enderror" placeholder="Tempat Lahir" required value="{{ old('place_birth') }}"/>
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
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen Katolik">Kristen Katolik</option>
                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Aliran Kepercayaan">Aliran Kepercayaan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status Keluarga</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="family_status">
                                    <option value="kepala keluarga">Kepala keluarga</option>
                                    <option value="istri">Istri</option>
                                    <option value="anak">Anak</option>
                                    <option value="famili lain">Famili</option>
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
                                    <option value="-">-</option>
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
                                <input type="text" class="form-control @error('job') is-invalid @enderror" placeholder="Pekerjaan" name="job" value="{{ old('job') }}"/>
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
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Nomor Telepon" name="phone" value="{{ old('phone') }}">
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
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Kawin Tercatat">Kawin Tercatat</option>
                                    <option value="Kawin Tidak Tercatat">Kawin Tidak Tercatat</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pendidikan</label>
                            <div class="col-sm-9">
                                <input type="text" name="last_education" class="form-control" value="{{ old('last_education') }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Asuransi Kesehatan</label>
                            <div class="col-sm-9">
                                <input type="text" name="health_assurance" class="form-control @error('health_assurance') is-invalid @enderror" value="{{ old('health_assurance') }}"/>
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
                            <label class="col-sm-3 col-form-label">Nama Ayah</label>
                            <div class="col-sm-9">
                                <input type="text" name="father_name" class="form-control @error('father_name') is-invalid @enderror" value="{{ old('father_name') }}"/>
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
                            <label class="col-sm-3 col-form-label">Nama Ibu</label>
                            <div class="col-sm-9">
                                <input type="text" name="mother_name" class="form-control @error('mother_name') is-invalid @enderror" value="{{ old('mother_name') }}"/>
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
                            <label class="col-sm-3 col-form-label">Disabilitas</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="disability">
                                    <option value="tidak">Tidak</option>
                                    <option value="tuna rungu">Tuna Rungu</option>
                                    <option value="tuna wicara">Tuna Wicara</option>
                                    <option value="tuna daksa">Tuna Daksa</option>
                                    <option value="tuna netra">Tuna Netra</option>
                                    <option value="tuna laras">Tuna Laras</option>
                                    <option value="tuna grahita">Tuna Grahita</option>
                                    <option value="tuna ganda">Tuna Ganda</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pendatang</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="newcomer">
                                    <option value="tidak">Tidak</option>
                                    <option value="ya">Ya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tgl Datang</label>
                            <div class="col-sm-9">
                            <input type="date" name="in_date" class="form-control @error('in_date') is-invalid @enderror" placeholder="Y-m-d" value="{{ old('in_date') }}"/>
                                @error('in_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <p class="card-description my-3 text-muted">
                    Alamat
                </p>
                <hr class="text-muted">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" required value="{{ old('address') }}"/>
                                @error('rt')
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
                            <label class="col-sm-3 col-form-label">RT</label>
                            <div class="col-sm-9">
                                <select name="rt" id="rt" class="form-control">

                                    @foreach($rts as $rt)
                                        <option value="{{ $rt->name }}" @if($rtSelected == $rt->name) {{ 'selected' }} @endif> {{ $rt->name }}</option>
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
                                    @foreach($rws as $rw)
                                        <option value="{{ $rw->name }}" @if($rwSelected == $rw->name) {{ 'selected' }} @endif> {{ $rw->name }}</option>
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
                               
                                <input type="text" class="form-control @error('village') is-invalid @enderror" placeholder="Desa" name="village" value="{{ old('village') }}"/>
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
                            <input type="text" class="form-control @error('sub_districts') is-invalid @enderror" placeholder="Kecamatan" name="sub_districts" value="{{ old('sub_districts') }}"/>
                                @error('sub_districts')
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
                            <input type="text" class="form-control @error('districts') is-invalid @enderror" placeholder="Kabupaten" name="districts" value="{{ old('districts') }}"/>
                                @error('districts')
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
                            <input type="text" class="form-control @error('province') is-invalid @enderror" placeholder="Provinsi" name="province" value="{{ old('province') }}"/>
                                @error('province')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <p class="card-description my-3 text-muted">
                    Status Vaksinasi
                </p>
                <hr class="text-muted">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Vaksin 1</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="vaccine_1">
                                    <option value="belum vaksin">Belum Vaksin</option>
                                    <option value="sudah vaksin">Sudah Vaksin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Vaksin 2</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="vaccine_2">
                                    <option value="belum vaksin">Belum Vaksin</option>
                                    <option value="sudah vaksin">Sudah Vaksin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Vaksin 3</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="vaccine_3">
                                    <option value="belum vaksin">Belum Vaksin</option>
                                    <option value="sudah vaksin">Sudah Vaksin</option>
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
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status DTKS</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="dtks">
                                    <option value="ya" >Ya</option>
                                    <option value="tidak" selected>Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center my-4">
                    <button type="submit" class="btn btn-primary">Tambah Data Kependudukan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
