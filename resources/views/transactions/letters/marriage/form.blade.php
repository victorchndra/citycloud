@extends("layouts.app")
@section('content')
<!-- select 2 -->
<link rel="stylesheet" href="{{asset('/css/addons/select2/select2.css')}}">

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Surat Keterangan Menikah</h3>
                <p class="text-subtitle text-muted">Multiple Surat Keterangan Menikah you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/list">Surat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Surat Keterangan Menikah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Surat Keterangan Menikah</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @if ( Auth::user()->roles == 'god' || Auth::user()->roles == 'admin')
                            <form class="form form-horizontal" action="/letters-marriage" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>No Surat</label>
                                            @foreach($informations as $information)
                                            <input type="text" name="letter_index"
                                                class="form-control @error('letter_index') is-invalid @enderror"
                                                placeholder="No Surat" value="  {{ $information->letter_index  }}">
                                            @endforeach
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Pilih Pemohon</label>
                                            <select id="citizen" class="form-control select2" name="citizen"
                                                style="width: 100%;" required>
                                                <option selected="selected" value="">Ketik Nama atau NIK</option>
                                                @foreach($citizen as $citizens)
                                                <option value="{{ $citizens->id }}">{{ $citizens->nik }} -
                                                    {{ $citizens->name }}</option>
                                                @endforeach
                                            </select>
                                            </select>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Status Perkawinan</label>
                                            <input type="text" name="marriage_status"
                                                class="form-control @error('marriage_status') is-invalid @enderror"
                                                placeholder="Janda,Perawan,Duda,Perjaka" required
                                                value="{{ old('marriage_status') }}" />
                                            @error('marriage_status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>


                                        <!-- FATHER SECTION -->

                                        <div class="col-md-12">
                                            <div class="form-group inline">
                                                <label>Status Ayah</label>
                                                <div class="form-check inline">
                                                    <input class="form-check-input" type="radio" value="warga"
                                                        type="radio" onclick="javascript:yesnoFather();"
                                                        name="yesnoAyah" id="yesCheck" />
                                                    <label class="form-check-label" for="warga">
                                                        Warga
                                                    </label>
                                                </div>

                                                <div class="form-check inline">
                                                    <input class="form-check-input" type="radio" value="bukan"
                                                        type="radio" onclick="javascript:yesnoFather();"
                                                        name="yesnoAyah" id="noCheck" />
                                                    <label class="form-check-label" for="bukan">
                                                        Bukan Warga
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div id="father_citizen" class="col-md-12 form-group">
                                            <label>Pilih Ayah (Pemohon)</label>
                                            <select id="father" class="form-control select2" name="father"
                                                style="width: 100%;">
                                                <option selected="selected" value="">Ketik Nama atau NIK</option>
                                                @foreach($father as $fathers)
                                                <option value="{{ $fathers->id }}">{{ $fathers->nik }} -
                                                    {{ $fathers->name }}</option>
                                                @endforeach
                                            </select>
                                            </select>
                                        </div>

                                        <div id="father_not" class="col-md-12 form-group">
                                            <div class="row">

                                                <div class="col-md-4 form-group">
                                                    <label>Nama Ayah</label>
                                                    <input type="text" name="father_name"
                                                        class="form-control @error('father_name') is-invalid @enderror"
                                                        placeholder="Nama Ayah" 
                                                        value="{{ old('father_name') }}" />
                                                    @error('father_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Bin</label>
                                                    <input type="text" name="father_bin"
                                                        class="form-control @error('father_bin') is-invalid @enderror"
                                                        placeholder="Bin"  value="{{ old('father_bin') }}" />
                                                    @error('father_bin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>NIK</label>
                                                    <input type="text" name="father_nik"
                                                        class="form-control @error('father_nik') is-invalid @enderror"
                                                        placeholder="Nik Ayah" 
                                                        value="{{ old('father_nik') }}" />
                                                    @error('father_nik')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>



                                                <div class="col-md-4 form-group">
                                                    <label>Tempat Lahir</label>
                                                    <input type="text" name="father_place_birth"
                                                        class="form-control @error('father_place_birth') is-invalid @enderror"
                                                        placeholder="Tempat Lahir Ayah" 
                                                        value="{{ old('father_place_birth') }}" />
                                                    @error('father_place_birth')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Tgl Lahir</label>
                                                    <input type="date" name="father_date_birth"
                                                        class="form-control @error('father_date_birth') is-invalid @enderror"
                                                        placeholder="Bin" 
                                                        value="{{ old('father_date_birth') }}" />
                                                    @error('father_date_birth')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Kewarganegaraan</label>
                                                    <input type="text" name="father_citizenship"
                                                        class="form-control @error('father_citizenship') is-invalid @enderror"
                                                        placeholder="Kewarganegaraan:WNI/WNA" 
                                                        value="{{ old('father_citizenship') }}" />
                                                    @error('father_citizenship')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>



                                                <div class="col-md-4 form-group">
                                                    <label>Agama</label>
                                                    <input type="text" name="father_religion"
                                                        class="form-control @error('father_religion') is-invalid @enderror"
                                                        placeholder="Agama Ayah" 
                                                        value="{{ old('father_religion') }}" />
                                                    @error('father_religion')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Pekerjaan</label>
                                                    <input type="text" name="father_job"
                                                        class="form-control @error('father_job') is-invalid @enderror"
                                                        placeholder="Pekerjaan Ayah" 
                                                        value="{{ old('father_job') }}" />
                                                    @error('father_job')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Alamat</label>
                                                    <input type="text" name="father_address"
                                                        class="form-control @error('father_address') is-invalid @enderror"
                                                        placeholder="Alamat Ayah" 
                                                        value="{{ old('father_address') }}" />
                                                    @error('father_address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                        <!-- FATHER SECTION END -->


                                        <!-- MOTHER SECTION -->

                                        <div class="col-md-12">
                                            <div class="form-group inline">
                                                <label>Status Ibu</label>
                                                <div class="form-check inline">
                                                    <input class="form-check-input" type="radio" value="warga"
                                                        type="radio" onclick="javascript:yesnoMother();" name="yesnoIbu"
                                                        id="yesMotherCheck" />
                                                    <label class="form-check-label" for="warga">
                                                        Warga
                                                    </label>
                                                </div>

                                                <div class="form-check inline">
                                                    <input class="form-check-input" type="radio" value="bukan"
                                                        type="radio" onclick="javascript:yesnoMother();" name="yesnoIbu"
                                                        id="noMotherCheck" />
                                                    <label class="form-check-label" for="bukan">
                                                        Bukan Warga
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div id="mother_citizen" class="col-md-12 form-group">
                                            <label>Pilih Ibu (Pemohon)</label>
                                            <select id="mother" class="form-control select2" name="mother"
                                                style="width: 100%;">
                                                <option selected="selected" value="">Ketik Nama atau NIK</option>
                                                @foreach($mother as $mothers)
                                                <option value="{{ $mothers->id }}">{{ $mothers->nik }} -
                                                    {{ $mothers->name }}</option>
                                                @endforeach
                                            </select>
                                            </select>
                                        </div>

                                        <div id="mother_not" class="col-md-12 form-group">
                                            <div class="row">

                                                <div class="col-md-4 form-group">
                                                    <label>Nama Ibu</label>
                                                    <input type="text" name="mother_name"
                                                        class="form-control @error('mother_name') is-invalid @enderror"
                                                        placeholder="Nama Ibu"
                                                        value="{{ old('mother_name') }}" />
                                                    @error('mother_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Binti</label>
                                                    <input type="text" name="mother_bin"
                                                        class="form-control @error('mother_bin') is-invalid @enderror"
                                                        placeholder="Bin" value="{{ old('mother_bin') }}" />
                                                    @error('mother_bin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>NIK</label>
                                                    <input type="text" name="father_nik"
                                                        class="form-control @error('father_nik') is-invalid @enderror"
                                                        placeholder="Nik Ibu"
                                                        value="{{ old('father_nik') }}" />
                                                    @error('father_nik')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>



                                                <div class="col-md-4 form-group">
                                                    <label>Tempat Lahir</label>
                                                    <input type="text" name="mother_place_birth"
                                                        class="form-control @error('mother_place_birth') is-invalid @enderror"
                                                        placeholder="Tempat Lahir Ibu"
                                                        value="{{ old('mother_place_birth') }}" />
                                                    @error('mother_place_birth')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Tgl Lahir</label>
                                                    <input type="date" name="mother_date_birth"
                                                        class="form-control @error('mother_date_birth') is-invalid @enderror"
                                                        placeholder="Bin"
                                                        value="{{ old('mother_date_birth') }}" />
                                                    @error('mother_date_birth')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Kewarganegaraan</label>
                                                    <input type="text" name="mother_citizenship"
                                                        class="form-control @error('mother_citizenship') is-invalid @enderror"
                                                        placeholder="Kewarganegaraan:WNI/WNA"
                                                        value="{{ old('mother_citizenship') }}" />
                                                    @error('mother_citizenship')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>



                                                <div class="col-md-4 form-group">
                                                    <label>Agama</label>
                                                    <input type="text" name="mother_religion"
                                                        class="form-control @error('mother_religion') is-invalid @enderror"
                                                        placeholder="Agama Ibu"
                                                        value="{{ old('mother_religion') }}" />
                                                    @error('mother_religion')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Pekerjaan</label>
                                                    <input type="text" name="mother_job"
                                                        class="form-control @error('mother_job') is-invalid @enderror"
                                                        placeholder="Pekerjaan Ibu"
                                                        value="{{ old('mother_job') }}" />
                                                    @error('mother_job')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Alamat</label>
                                                    <input type="text" name="mother_address"
                                                        class="form-control @error('mother_address') is-invalid @enderror"
                                                        placeholder="Alamat Ibu"
                                                        value="{{ old('mother_address') }}" />
                                                    @error('mother_address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                        <!-- MOTHER SECTION END -->


                                        <!-- COUPLE SECTION -->

                                        <div class="col-md-12">
                                            <div class="form-group inline">
                                                <label>Status Calon</label>
                                                <div class="form-check inline">
                                                    <input class="form-check-input" type="radio" value="warga"
                                                        type="radio" onclick="javascript:yesnoCouple();" name="yesnoCalon"
                                                        id="yesCoupleCheck" />
                                                    <label class="form-check-label" for="warga">
                                                        Warga
                                                    </label>
                                                </div>

                                                <div class="form-check inline">
                                                    <input class="form-check-input" type="radio" value="bukan"
                                                        type="radio" onclick="javascript:yesnoCouple();" name="yesnoCalon"
                                                        id="noCoupleCheck" />
                                                    <label class="form-check-label" for="bukan">
                                                        Bukan Warga
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div id="couple_citizen" class="col-md-12 form-group">
                                            <label>Pilih Calon (Pemohon)</label>
                                            <select id="couple" class="form-control select2" name="couple"
                                                style="width: 100%;">
                                                <option selected="selected" value="">Ketik Nama atau NIK</option>
                                                @foreach($couple as $couples)
                                                <option value="{{ $couples->id }}">{{ $couples->nik }} -
                                                    {{ $couples->name }}</option>
                                                @endforeach
                                            </select>
                                            </select>
                                        </div>

                                        <div id="couple_not" class="col-md-12 form-group">
                                            <div class="row">

                                                <div class="col-md-4 form-group">
                                                    <label>Nama Calon</label>
                                                    <input type="text" name="couple_name"
                                                        class="form-control @error('couple_name') is-invalid @enderror"
                                                        placeholder="Nama Ibu"
                                                        value="{{ old('couple_name') }}" />
                                                    @error('couple_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Bin</label>
                                                    <input type="text" name="couple_bin"
                                                        class="form-control @error('couple_bin') is-invalid @enderror"
                                                        placeholder="Bin" value="{{ old('couple_bin') }}" />
                                                    @error('couple_bin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>NIK</label>
                                                    <input type="text" name="couple_nik"
                                                        class="form-control @error('couple_nik') is-invalid @enderror"
                                                        placeholder="Nik Calon"
                                                        value="{{ old('couple_nik') }}" />
                                                    @error('couple_nik')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>



                                                <div class="col-md-4 form-group">
                                                    <label>Tempat Lahir</label>
                                                    <input type="text" name="couple_place_birth"
                                                        class="form-control @error('couple_place_birth') is-invalid @enderror"
                                                        placeholder="Tempat Lahir Calon"
                                                        value="{{ old('couple_place_birth') }}" />
                                                    @error('couple_place_birth')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Tgl Lahir</label>
                                                    <input type="date" name="couple_date_birth"
                                                        class="form-control @error('couple_date_birth') is-invalid @enderror"
                                                        placeholder="Bin"
                                                        value="{{ old('couple_date_birth') }}" />
                                                    @error('couple_date_birth')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Kewarganegaraan</label>
                                                    <input type="text" name="couple_citizenship"
                                                        class="form-control @error('couple_citizenship') is-invalid @enderror"
                                                        placeholder="Kewarganegaraan:WNI/WNA"
                                                        value="{{ old('couple_citizenship') }}" />
                                                    @error('couple_citizenship')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>



                                                <div class="col-md-4 form-group">
                                                    <label>Agama</label>
                                                    <input type="text" name="couple_religion"
                                                        class="form-control @error('couple_religion') is-invalid @enderror"
                                                        placeholder="Agama Calon"
                                                        value="{{ old('couple_religion') }}" />
                                                    @error('couple_religion')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Pekerjaan</label>
                                                    <input type="text" name="couple_job"
                                                        class="form-control @error('couple_job') is-invalid @enderror"
                                                        placeholder="Pekerjaan"
                                                        value="{{ old('couple_job') }}" />
                                                    @error('couple_job')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Alamat</label>
                                                    <input type="text" name="couple_address"
                                                        class="form-control @error('couple_address') is-invalid @enderror"
                                                        placeholder="Alamat Calon"
                                                        value="{{ old('couple_address') }}" />
                                                    @error('couple_address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                        <!-- COUPLE SECTION END -->

                                        <h4 class="card-title">Akan Melangsungkan Pernikahan Pada</h4>

                                        <div class="col-md-12 form-group">
                                            <label>Tgl Menikah</label>
                                            <input type="date" name="marriage_date"
                                                class="form-control @error('marriage_date') is-invalid @enderror"
                                                placeholder="Y-m-d" required value="{{ old('marriage_date') }}" />
                                            @error('marriage_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Jam</label>
                                            <input type="text" name="marriage_hour"
                                                class="form-control @error('marriage_hour') is-invalid @enderror"
                                                placeholder="Y-m-d" required value="{{ old('marriage_hour') }}" />
                                            @error('marriage_hour')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Bertempat di</label>
                                            <input type="text" name="marriage_location"
                                                class="form-control @error('marriage_location') is-invalid @enderror"
                                                placeholder="Y-m-d" required value="{{ old('marriage_location') }}" />
                                            @error('marriage_location')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <label>Pindah Nikah</label>
                                            <div class="col-md-12">
                                                <div class="form-group inline">

                                                    <div class="form-check inline">
                                                        <input class="form-check-input" type="radio" value="ya"
                                                            type="radio" onclick="javascript:yesnoMove();" name="yesnoPindah"
                                                            id="yesMoveCheck" />
                                                        <label class="form-check-label" for="ya">
                                                            Ya
                                                        </label>
                                                    </div>

                                                    <div class="form-check inline">
                                                        <input class="form-check-input" type="radio" value="bukan"
                                                            type="radio" onclick="javascript:yesnoMove();" name="yesnoPindah"
                                                            id="noMoveCheck" />
                                                        <label class="form-check-label" for="bukan">
                                                            Tidak
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <label>Buat Surat Ket. Kematian?</label>
                                            <div class="col-md-12">
                                                <div class="form-group inline">

                                                    <div class="form-check inline">
                                                        <input class="form-check-input" type="radio" value="ya"
                                                            type="radio" onclick="javascript:yesnoDeath();" name="yesnoDeath"
                                                            id="yesDeathCheck" />
                                                        <label class="form-check-label" for="ya">
                                                            Ya
                                                        </label>
                                                    </div>

                                                    <div class="form-check inline">
                                                        <input class="form-check-input" type="radio" value="bukan"
                                                            type="radio" onclick="javascript:yesnoDeath();" name="yesnoDeath"
                                                            id="noDeathCheck" />
                                                        <label class="form-check-label" for="bukan">
                                                            Tidak
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-12 form-group">
                                            <label>Tgl Surat</label>
                                            <input type="date" name="letter_date"
                                                class="form-control @error('letter_date') is-invalid @enderror"
                                                placeholder="Y-m-d" required value="{{ old('letter_date') }}" />
                                            @error('letter_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 form-group">

                                            <label>Ditandatangani Oleh</label>
                                            <select id="positions" class="form-control" name="positions"
                                                style="width: 100%;" required>
                                                <option value="">Pilih Jabatan</option>
                                                @foreach($position as $positions)
                                                <option value="{{ $positions->id  }} {{ $positions->position  }}">
                                                    {{ $positions->name }} -
                                                    {{ $positions->position }}</option>
                                                @endforeach
                                            </select>
                                            <hr>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="wet"
                                                            name="signature" id="wet" checked>
                                                        <label class="form-check-label" for="wet">
                                                            Basah
                                                        </label>
                                                    </div>

                                                    <div class="form-check" name="sep" id="sep">
                                                        <input class="form-check-input" type="radio" value="digital"
                                                            name="signature" id="digital">
                                                        <label class="form-check-label" for="digital">
                                                            Digital
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                            </form>
                            @else

                            <form class="form form-horizontal" action="/letters-not-bpjs" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12 form-group ">
                                            <label>No Surat</label>
                                            @foreach($informations as $information)
                                            <input readonly type="text" name="letter_index"
                                                class="form-control @error('letter_index') is-invalid @enderror"
                                                placeholder="No Surat" value="  {{ $information->letter_index  }}">
                                            @endforeach
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Pilih Penduduk</label>
                                            <select id="citizens" class="form-control select2" name="citizens"
                                                style="width: 100%;" required>

                                                <option value="{{ Auth::user()->citizens_id}}">{{ Auth::user()->name}} -
                                                    {{ Auth::user()->username}}</option>

                                            </select>
                                            </select>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Ditandatangani Oleh</label>
                                            <select id="positions" class="form-control" name="positions"
                                                style="width: 100%;" required>

                                                @foreach($position as $positions)
                                                <option value="{{ $positions->id  }} {{ $positions->position  }}">
                                                    {{ $positions->name }} -
                                                    {{ $positions->position }}</option>
                                                @endforeach
                                            </select>
                                            <hr>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- select2js -->
<script src="{{asset('/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('/js/select2/select2.full.min.js')}}" defer></script>

<script>
    window.onload = function () {
        document.getElementById('father_citizen').style.display = 'none';
        document.getElementById('father_not').style.display = 'none';

        document.getElementById('mother_citizen').style.display = 'none';
        document.getElementById('mother_not').style.display = 'none';

        document.getElementById('couple_citizen').style.display = 'none';
        document.getElementById('couple_not').style.display = 'none';
    }

    function yesnoFather() {
        if (document.getElementById('yesCheck').checked) {

            document.getElementById('father_citizen').style.display = 'block';
            document.getElementById('father_not').style.display = 'none';

        } else if (document.getElementById('noCheck').checked) {
            document.getElementById('father_not').style.display = 'block';
            document.getElementById('father_citizen').style.display = 'none';
        }
    }

    function yesnoMother() {
        if (document.getElementById('yesMotherCheck').checked) {

            document.getElementById('mother_citizen').style.display = 'block';
            document.getElementById('mother_not').style.display = 'none';

        } else if (document.getElementById('noMotherCheck').checked) {
            document.getElementById('mother_not').style.display = 'block';
            document.getElementById('mother_citizen').style.display = 'none';
        }
    }

    function yesnoCouple() {
        if (document.getElementById('yesCoupleCheck').checked) {

            document.getElementById('couple_citizen').style.display = 'block';
            document.getElementById('couple_not').style.display = 'none';

        } else if (document.getElementById('noCoupleCheck').checked) {
            document.getElementById('couple_not').style.display = 'block';
            document.getElementById('couple_citizen').style.display = 'none';
        }
    }

</script>


<script>
    $(document).ready(function () {

        $("#citizen").select2({
            maximumSelectionLength: 3
        });

        $("#father").select2({
            maximumSelectionLength: 3
        });


        $("#mother").select2({
            maximumSelectionLength: 3
        });

        $("#couple").select2({
            maximumSelectionLength: 3
        });


    });

</script>



<script>
    $(document).on('change', '#positions', function (e) {
        var value = $(this).val();
        const replaced = value.replace(/[0-9]/g, '');

        if (replaced == ' Kepala Desa') {
            document.getElementById("sep").style.display = "block";
            document.getElementById("sep").required = true;
        } else {
            document.getElementById("sep").style.display = "none";
            document.getElementById("sep").required = false;
        }
        console.log($(this).val());
        console.log("checkvalue", replaced);
    });

</script>
@endsection
