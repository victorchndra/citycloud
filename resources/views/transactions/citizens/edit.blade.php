@extends("layouts.app")

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Kependudukan</h4>
            @foreach ($citizen as $c)
            <form class="form-sample" action="/citizens/{{ $c->uuid }}" method="POST">
                @method('put')
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
                                <input type="number" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="Nomor Induk Kependudukan" autofocus value="{{ old('nik', $c->nik) }}"/>
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
                                <input type="number" name="kk" class="form-control @error('kk') is-invalid @enderror" placeholder="Kartu Keluarga" value="{{ old('kk', $c->kk) }}"/>
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
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" required value="{{ old('name', $c->name) }}"/>
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
                                <input type="date" name="date_birth" class="form-control @error('date_birth') is-invalid @enderror" placeholder="dd/mm/yyyy" required value="{{ old('date_birth', $c->date_birth) }}"/>
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
                                    @if (old('gender', 'l') == $c->gender)
                                        <option value="l" selected>Laki-laki</option>
                                        <option value="p">Perempuan</option>
                                    @elseif (old('gender', 'p') == $c->gender)
                                        <option value="l">Laki-laki</option>
                                        <option value="p" selected>Perempuan</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" name="place_birth" class="form-control @error('place_birth') is-invalid @enderror" placeholder="Tempat Lahir" required value="{{ old('place_birth', $c->place_birth) }}"/>
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
                                    @if (old('religion', 'Islam') == $c->religion)
                                        <option value="Islam" selected>Islam</option>
                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghucu">Konghucu</option>
                                    @elseif (old('religion', 'Kristen Katolik') == $c->religion)
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Katolik" selected>Kristen Katolik</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghucu">Konghucu</option>
                                    @elseif (old('religion', 'Kristen Protestan') == $c->religion)
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                        <option value="Kristen Protestan" selected>Kristen Protestan</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghucu">Konghucu</option>
                                    @elseif (old('religion', 'Buddha') == $c->religion)
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Buddha" selected>Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghucu">Konghucu</option>
                                    @elseif (old('religion', 'Hindu') == $c->religion)
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu" selected>Hindu</option>
                                        <option value="Konghucu">Konghucu</option>
                                    @elseif (old('religion', 'Konghucu') == $c->religion)
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghucu" selected>Konghucu</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status Keluarga</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="family_status">
                                    @if (old('family_status',$c->family_status))
                                    <option value="head" selected>Kepala keluarga</option>
                                    <option value="wife">Istri</option>
                                    <option value="child">Anak</option>
                                    @elseif (old('family_status', $c->family_status))
                                    <option value="head">Kepala keluarga</option>
                                    <option value="wife" selected>Istri</option>
                                    <option value="child">Anak</option>
                                    @elseif (old('family_status', $c->family_status))
                                    <option value="head">Kepala keluarga</option>
                                    <option value="wife">Istri</option>
                                    <option value="child" selected>Anak</option>
                                    @endif
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
                                    @if (old('blood', 'A') == $c->blood)
                                    <option value="A" selected>A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                    @elseif (old('blood', 'B') == $c->blood)
                                    <option value="A">A</option>
                                    <option value="B" selected>B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                    @elseif (old('blood', 'AB') == $c->blood)
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB" selected>AB</option>
                                    <option value="O">O</option>
                                    @elseif (old('blood', 'O') == $c->blood)
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O" selected>O</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('job') is-invalid @enderror" placeholder="Pekerjaan" name="job" required value="{{ old('job', $c->job) }}"/>
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
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" placeholder="Nomor Telepon" name="phone" required value="{{ old('phone', $c->phone) }}">
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
                                    @if (old('marriage', $c->marriage))
                                    <option value="Belum Kawen" selected>Belum Menikah</option>
                                    <option value="Kawin Tercatat">Sudah Menikah</option>
                                    @elseif (old('marriage', $c->marriage))
                                    <option value="Belum Kawen">Belum Menikah</option>
                                    <option value="Kawin Tercatat" selected>Sudah Menikah</option>
                                    @endif
                                </select>
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
                            <label class="col-sm-3 col-form-label">RT</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('rt') is-invalid @enderror" name="rt" required value="{{ old('rt', $c->rt) }}"/>
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
                                <input type="number" class="form-control @error('rw') is-invalid @enderror" name="rw" required value="{{ old('rw', $c->rw) }}"/>
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
                            <label class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('village') is-invalid @enderror" name="village" required value="{{ old('village', $c->village) }}"/>
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
                            <label class="col-sm-3 col-form-label">Kota / Kabupaten</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('sub_districts') is-invalid @enderror" name="sub_districts" required value="{{ old('sub_districts', $c->sub_districts) }}"/>
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
                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('districts') is-invalid @enderror" name="districts" required value="{{ old('districts', $c->districts) }}"/>
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
                                <input type="text" class="form-control @error('province') is-invalid @enderror" name="province" required value="{{ old('province', $c->province) }}"/>
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
                    Lanjutan
                </p>
                <hr class="text-muted">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Pindah</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control @error('move_date') is-invalid @enderror" name="move_date" value="{{ old('move_date', $c->move_date) }}"/>
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
                                <input type="date" class="form-control @error('death_date') is-invalid @enderror" name="death_date" value="{{ old('death_date', $c->death_date) }}"/>
                                @error('death_date')
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
                                    @if (old('vaccine_1','') ==$c->vaccine_1 )
                                    <option value="" selected>Belum Vaksin</option>
                                    <option value="Sudah Vaksin">Sudah Vaksin</option>
                                    @elseif (old('vaccine_1', 'Sudah Vaksin') == $c->vaccine_1)
                                    <option value="">Belum Vaksin</option>
                                    <option value="Sudah Vaksin" selected>Sudah Vaksin</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Vaksin 2</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="vaccine_2">
                                    @if (old('vaccine_2', '')==$c->vaccine_2)
                                    <option value="" selected>Belum Vaksin</option>
                                    <option value="Sudah Vaksin">Sudah Vaksin</option>
                                    @elseif (old('vaccine_2', 'Sudah Vaksin') == $c->vaccine_2)
                                    <option value="">Belum Vaksin</option>
                                    <option value="Sudah Vaksin" selected>Sudah Vaksin</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Vaksin 3</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="vaccine_3">
                                    @if (old('vaccine_3','')==$c->vaccine_3)
                                    <option value="" selected>Belum Vaksin</option>
                                    <option value="Sudah Vaksin">Sudah Vaksin</option>
                                    @elseif (old('vaccine_3', 'Sudah Vaksin') == $c->vaccine_3)
                                    <option value="">Belum Vaksin</option>
                                    <option value="Sudah Vaksin" selected>Sudah Vaksin</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center my-4">
                    <button type="submit" class="btn btn-primary">Edit Data Kependudukan</button>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection
