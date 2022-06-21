@extends("layouts.app")
<script>
 $(function(){
        $("#to").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#from").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
            minValue.setDate(minValue.getDate()+1);
            $("#to").datepicker( "option", "minDate", minValue );
        })
    });
</script>
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
                            <input type="date" class="form-control @error('date_birth') is-invalid @enderror" name="date_birth" id="date" required value="{{ date('Y-m-d', strtotime(Str::limit($c->date_birth, 10, '')))}}"> {{-- bug --}} 
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
                                        <option value="khonghucu">Konghucu</option>
                                        <option value="Aliran Kepercayaan">Aliran Kepercayaan</option>
                                    @elseif (old('religion', 'Kristen Katolik') == $c->religion)
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Katolik" selected>Kristen Katolik</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghucu">Konghucu</option>
                                        <option value="Aliran Kepercayaan">Aliran Kepercayaan</option>
                                    @elseif (old('religion', 'Kristen Protestan') == $c->religion)
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                        <option value="Kristen Protestan" selected>Kristen Protestan</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghucu">Konghucu</option>
                                        <option value="Aliran Kepercayaan">Aliran Kepercayaan</option>
                                    @elseif (old('religion', 'Buddha') == $c->religion)
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Buddha" selected>Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghucu">Konghucu</option>
                                        <option value="Aliran Kepercayaan">Aliran Kepercayaan</option>
                                    @elseif (old('religion', 'Hindu') == $c->religion)
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu" selected>Hindu</option>
                                        <option value="Konghucu">Konghucu</option>
                                        <option value="Aliran Kepercayaan">Aliran Kepercayaan</option>
                                    @elseif (old('religion', 'Konghucu') == $c->religion)
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghucu" selected>Konghucu</option>
                                        <option value="Aliran Kepercayaan">Aliran Kepercayaan</option>
                                    @elseif (old('religion', 'Aliran Kepercayaan') == $c->religion)
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghucu">Konghucu</option>
                                        <option value="Aliran Kepercayaan" selected>Aliran Kepercayaan</option>
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
                                    @if (old('family_status', 'Kepala Keluarga') == $c->family_status)
                                    <option value="kepala keluarga" selected>Kepala keluarga</option>
                                    <option value="istri">Istri</option>
                                    <option value="anak">Anak</option>
                                    <option value="famili">Famili</option>
                                    <option value=""></option>
                                    @elseif (old('family_status', 'Istri') == $c->family_status)
                                    <option value="kepala keluarga" >Kepala keluarga</option>
                                    <option value="istri" selected>Istri</option>
                                    <option value="anak">Anak</option>
                                    <option value="famili">Famili</option>
                                    <option value=""></option>
                                    @elseif (old('family_status', 'Anak') == $c->family_status)
                                    <option value="kepala keluarga" >Kepala keluarga</option>
                                    <option value="istri" >Istri</option>
                                    <option value="anak" selected>Anak</option>
                                    <option value="famili">Famili</option>
                                    <option value=""></option>
                                    @elseif (old('family_status', 'Famili') == $c->family_status)
                                    <option value="kepala keluarga" >Kepala keluarga</option>
                                    <option value="istri" >Istri</option>
                                    <option value="anak" >Anak</option>
                                    <option value="famili" selected>Famili</option>
                                    <option value=""></option>
                                    @elseif (old('family_status', '') == $c->family_status)
                                    <option value="kepala keluarga" >Kepala keluarga</option>
                                    <option value="istri" >Istri</option>
                                    <option value="anak" >Anak</option>
                                    <option value="famili">Famili</option>
                                    <option value="" selected></option>
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
                                    <option value="-">-</option>
                                    <option value="A" selected>A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                    @elseif (old('blood', 'B') == $c->blood)
                                    <option value="-">-</option>
                                    <option value="A">A</option>
                                    <option value="B" selected>B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                    @elseif (old('blood', 'AB') == $c->blood)
                                    <option value="-">-</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB" selected>AB</option>
                                    <option value="O">O</option>
                                    @elseif (old('blood', 'O') == $c->blood)
                                    <option value="-">-</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O" selected>O</option>
                                    @elseif (old('blood', '-') == $c->blood)
                                    <option value="-" selected>-</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                    @elseif (old('blood', '') == $c->blood)
                                    <option value="-" selected>-</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('job') is-invalid @enderror" placeholder="Pekerjaan" name="job" value="{{ old('job', $c->job) }}"/>
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
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" placeholder="Nomor Telepon" name="phone" value="{{ old('phone', $c->phone) }}">
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
                                    @if (old('marriage', 'Belum Kawin') == $c->marriage)
                                    <option value="Belum Kawin" selected>Belum Kawin</option>
                                    <option value="Kawin Tercatat">Kawin Tercatat</option>
                                    <option value="Kawin Tidak Tercatat">Kawin Tidak Tercatat</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                    @elseif (old('marriage', 'Kawin Tercatat') == $c->marriage)
                                    <option value="Belum Kawin">Belum Menikah</option>
                                    <option value="Kawin Tercatat" selected>Sudah Menikah</option>
                                    <option value="Kawin Tidak Tercatat">Kawin Tidak Tercatat</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                    @elseif (old('marriage', 'Kawin Tidak Tercatat') == $c->marriage)
                                    <option value="Belum Kawin">Belum Menikah</option>
                                    <option value="Kawin Tercatat" >Sudah Menikah</option>
                                    <option value="Kawin Tidak Tercatat" selected>Kawin Tidak Tercatat</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                    @elseif (old('marriage', 'Cerai Hidup') == $c->marriage)
                                    <option value="Belum Kawin">Belum Menikah</option>
                                    <option value="Kawin Tercatat" >Sudah Menikah</option>
                                    <option value="Kawin Tidak Tercatat">Kawin Tidak Tercatat</option>
                                    <option value="Cerai Hidup" selected>Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                    @elseif (old('marriage', 'Cerai Mati') == $c->marriage)
                                    <option value="Belum Kawin">Belum Menikah</option>
                                    <option value="Kawin Tercatat" >Sudah Menikah</option>
                                    <option value="Kawin Tidak Tercatat">Kawin Tidak Tercatat</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati" selected>Cerai Mati</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pendidikan</label>
                            <div class="col-sm-9">
                                <input type="text" name="last_education" class="form-control @error('last_education') is-invalid @enderror" placeholder="Isikan Bagian Kosong" value="{{ old('last_education', $c->last_education) }}">
                                @error('last_education')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Asuransi Kesehatan</label>
                            <div class="col-sm-9">
                                <input type="text" name="health_assurance" class="form-control @error('health_assurance') is-invalid @enderror" value="{{ old('health_assurance', $c->health_assurance) }}"/>
                                @error('health_assurance')
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
                                <input type="text" name="father_name" class="form-control @error('father_name') is-invalid @enderror" placeholder="Isikan Bagian Kosong" value="{{ old('father_name', $c->father_name) }}">
                                @error('father_name')
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
                                <input type="text" name="mother_name" class="form-control @error('mother_name') is-invalid @enderror" placeholder="Isikan Bagian Kosong" value="{{ old('mother_name', $c->mother_name) }}">
                                @error('mother_name')
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
                                    <option value="tidak" @if(!empty($c) && $c->disability =='tidak'){{ 'selected' }}@endif>Tidak</option>
                                    <option value="tuna rungu" @if(!empty($c) && $c->disability =='Tuna Rungu'){{ 'selected' }}@endif>Tuna Rungu</option>
                                    <option value="tuna wicara" @if(!empty($c) && $c->disability=='Tuna Wicara'){{ 'selected' }}@endif>Tuna Wicara</option>
                                    <option value="tuna daksa" @if(!empty($c) && $c->disability =='Tuna Daksa'){{ 'selected' }}@endif>Tuna Daksa</option>
                                    <option value="tuna netra" @if(!empty($c) && $c->disability =='Tuna Netra'){{ 'selected' }}@endif>Tuna Netra</option>
                                    <option value="tuna grahita" @if(!empty($c) && $c->disability == 'Tuna Grahita'){{ 'selected' }}@endif>Tuna Grahita</option>
                                    <option value="tuna laras" @if(!empty($c) && $c->disability == 'Tuna Laras'){{ 'selected' }}@endif>Tuna Laras</option>
                                    <option value="tuna ganda" @if(!empty($c) && $c->disability == 'Tuna Ganda'){{ 'selected' }}@endif>Tuna Ganda</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pendatang</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="newcomer">
                                    <option value="tidak" @if(!empty($c) && $c->newcomer =='tidak'){{ 'selected' }}@endif>Tidak</option>
                                    <option value="ya" @if(!empty($c) && $c->newcomer =='ya'){{ 'selected' }}@endif>Ya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tgl Datang</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control @error('in_date') is-invalid @enderror" name="in_date" id="date" value="{{ old('in_date', $c->in_date) }}"> 
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
                        <div class="form-group row ">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                            <input class="form-control @error('address') is-invalid @enderror" name="address" id="address" required value="{{ old('address', $c->address) }}"></input>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">RT</label>
                            <div class="col-sm-9">
                                    <input class="form-control @error('rt') is-invalid @enderror" name="rt" id="rt" required value="{{ old('rt', $c->rt) }}"></input>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">RW</label>
                            <div class="col-sm-9">
                                    <input class="form-control @error('address') is-invalid @enderror" name="rw" id="rw" required value="{{ old('rw', $c->rw) }}"></input>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control @error('village') is-invalid @enderror" placeholder="Kelurahan" name="village" value="{{ old('village', $c->village) }}"/>
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
                            <input type="text" class="form-control @error('sub_districts') is-invalid @enderror" placeholder="Pekerjaan" name="sub_districts" value="{{ old('sub_districts', $c->sub_districts) }}"/>
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
                            <input type="text" class="form-control @error('districts') is-invalid @enderror" placeholder="Pekerjaan" name="districts" value="{{ old('districts', $c->districts) }}"/>
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
                            <input type="text" class="form-control @error('province') is-invalid @enderror" placeholder="Pekerjaan" name="province" value="{{ old('province', $c->province) }}"/>
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
                                    @if (old('vaccine_1', 'Sudah Vaksin') == $c->vaccine_1)
                                    <option value="Sudah Vaksin" selected>Sudah Vaksin</option>
                                    <option value="Belum Vaksin">Belum Vaksin</option>
                                    @elseif (old('vaccine_1', 'Belum Vaksin') == $c->vaccine_1)
                                    <option value="Sudah Vaksin">Sudah Vaksin</option>
                                    <option value="Belum Vaksin" selected>Belum Vaksin</option>
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
                                    @if (old('vaccine_2', 'Sudah Vaksin') == $c->vaccine_2)
                                    <option value="Sudah Vaksin" selected>Sudah Vaksin</option>
                                    <option value="Belum Vaksin">Belum Vaksin</option>
                                    @elseif (old('vaccine_2', 'Belum Vaksin') == $c->vaccine_2)
                                    <option value="Sudah Vaksin" >Sudah Vaksin</option>
                                    <option value="Belum Vaksin" selected>Belum Vaksin</option>
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
                                    @if (old('vaccine_3', 'Sudah Vaksin') == $c->vaccine_3)
                                    <option value="Sudah Vaksin" selected>Sudah Vaksin</option>
                                    <option value="Belum Vaksin">Belum Vaksin</option>
                                    @elseif (old('vaccine_3', 'Belum Vaksin') == $c->vaccine_3)
                                    <option value="Sudah Vaksin" >Sudah Vaksin</option>
                                    <option value="Belum Vaksin" selected>Belum Vaksin</option>
                                    @endif
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
                                    @if (old('dtks', 'DTKS') == $c->dtks)
                                     <option value="dtks" selected>DTKS</option>
                                    <option value="kks">KKS</option>
                                    <option value="p-pkh">P-PKH</option>
                                    <option value="pkh">PKH</option>
                                    <option value="tidak">TIDAK</option>
                                    <option value="u-pkh">U-PKH</option>
                                    @elseif (old('dtks', 'KKS') == $c->dtks)
                                    <option value="dtks">DTKS</option>
                                    <option value="kks" selected>KKS</option>
                                    <option value="p-pkh">P-PKH</option>
                                    <option value="pkh">PKH</option>
                                    <option value="tidak">TIDAK</option>
                                    <option value="u-pkh">U-PKH</option>
                                    @elseif (old('dtks', 'P-PKH') == $c->dtks)
                                    <option value="dtks">DTKS</option>
                                    <option value="kks">KKS</option>
                                    <option value="p-pkh" selected>P-PKH</option>
                                    <option value="pkh">PKH</option>
                                    <option value="tidak">TIDAK</option>
                                    <option value="u-pkh">U-PKH</option>
                                    @elseif (old('dtks', 'PKH') == $c->dtks)
                                    <option value="dtks" >DTKS</option>
                                    <option value="kks">KKS</option>
                                    <option value="p-pkh">P-PKH</option>
                                    <option value="pkh" selected>PKH</option>
                                    <option value="tidak">TIDAK</option>
                                    <option value="u-pkh">U-PKH</option>
                                    @elseif (old('dtks', 'TIDAK') == $c->dtks)
                                    <option value="dtks" >DTKS</option>
                                    <option value="kks">KKS</option>
                                    <option value="p-pkh">P-PKH</option>
                                    <option value="pkh">PKH</option>
                                    <option value="tidak" selected>TIDAK</option>
                                    <option value="u-pkh">U-PKH</option>
                                    @elseif (old('dtks', 'U-PKH') == $c->dtks)
                                    <option value="dtks" >DTKS</option>
                                    <option value="kks">KKS</option>
                                    <option value="p-pkh">P-PKH</option>
                                    <option value="pkh">PKH</option>
                                    <option value="tidak">TIDAK</option>
                                    <option value="u-pkh" selected>U-PKH</option>
                                    @elseif (old('dtks', '') == $c->dtks)
                                    <option value="" selected>Pilih Status</option>
                                    <option value="dtks">DTKS</option>
                                    <option value="kks">KKS</option>
                                    <option value="p-pkh">P-PKH</option>
                                    <option value="pkh">PKH</option>
                                    <option value="tidak">TIDAK</option>
                                    <option value="u-pkh">U-PKH</option>
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
