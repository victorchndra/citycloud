@extends('layouts.app')
@section('content')
    <!-- select 2 -->
    <link rel="stylesheet" href="{{ asset('/css/addons/select2/select2.css') }}">

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Surat Pernyataan Kepemilikan Tanah</h3>
                    <p class="text-subtitle text-muted">Multiple Surat Keterangan Usaha you can use</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/list">Surat</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Surat Pernyataan Kepemilikan Tanah</li>
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
                            <h4 class="card-title">Edit Surat Pernyataan Kepemilikan Tanah</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @foreach ($citizen as $c)
                                    <form class="form-sample" action="/letters-landownership/{{ $c->uuid }}"
                                        method="POST">
                                        @method('put')
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label>No Surat</label>
                                                    @foreach ($informations as $information)
                                                        <input type="text" name="letter_index"
                                                            class="form-control @error('letter_index') is-invalid @enderror"
                                                            placeholder="No Surat"
                                                            value="  {{ $information->letter_index }}">
                                                    @endforeach
                                                </div>

                                                <div class="col-md-12 form-group">
                                                    <label>Pilih Penduduk</label>
                                                    <select disabled id="citizens" class="form-control select2"
                                                        name="citizens" style="width: 100%;" required>
                                                        @foreach ($citizen as $citizens)
                                                            <option value="{{ $citizens->id }}">{{ $citizens->nik }} -
                                                                {{ $citizens->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-12 form-group">
                                                    <label>Nama Jalan</label>
                                                    <input type="text" name="letter_street"
                                                        class="form-control @error('letter_street') is-invalid @enderror"
                                                        placeholder="Keterangan Batas Tanah Sebelah Utara" required
                                                        value="{{ old('letter_street', $c->letter_street) }}" />
                                                    @error('letter_street')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>RT</label>
                                                    <select id="letter_rt" class="form-control" name="letter_rt"
                                                        style="width: 100%;" required>
                                                        @foreach ($rts as $rt)
                                                            <option value="{{ $rt->name }}"
                                                                @if ($rtSelected == $rt->name) {{ 'selected' }} @endif>
                                                                {{ $rt->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>RW</label>
                                                    <select id="letter_rw" class="form-control" name="letter_rw"
                                                        style="width: 100%;" required>
                                                        @foreach ($rws as $rw)
                                                            <option value="{{ $rw->name }}"
                                                                @if ($rwSelected == $rw->name) value="{{ old('letter_vilage', $c->letter_vilage) }}" @endif>
                                                                {{ $rw->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Desa</label>
                                                    <input type="text" name="letter_vilage"
                                                        class="form-control @error('letter_vilage') is-invalid @enderror"
                                                        placeholder="Keterangan Batas Tanah Sebelah Utara" required
                                                        value="{{ old('letter_vilage', $c->letter_vilage) }}" />
                                                    @error('letter_vilage')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Kelurahan</label>
                                                    <input type="text" name="letter_sub_districts"
                                                        class="form-control @error('letter_sub_districts') is-invalid @enderror"
                                                        placeholder="Keterangan Batas Tanah Sebelah Utara" required
                                                        value="{{ old('letter_sub_districts', $c->letter_sub_districts) }}" />
                                                    @error('letter_sub_districts')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Kecamatan/ Kota</label>
                                                    <input type="text" name="letter_districts"
                                                        class="form-control @error('letter_districts') is-invalid @enderror"
                                                        placeholder="Keterangan Batas Tanah Sebelah Utara" required
                                                        value="{{ old('letter_districts', $c->letter_districts) }}" />
                                                    @error('letter_districts')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Provinsi</label>
                                                    <input type="text" name="letter_province"
                                                        class="form-control @error('letter_province') is-invalid @enderror"
                                                        placeholder="Keterangan Batas Tanah Sebelah Utara" required
                                                        value="{{ old('letter_province', $c->letter_province) }}" />
                                                    @error('letter_province')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                

                                                <div class="col-md-6 form-group">
                                                    <label>Batas Sebelah Utara</label>

                                                    <input type="text" name="letter_north"
                                                        class="form-control @error('letter_north') is-invalid @enderror"
                                                        placeholder="Keterangan Batas Tanah Sebelah Utara" required
                                                        value="{{ old('letter_north', $c->letter_north) }}" />
                                                    @error('letter_north')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Batas Sebelah Timur</label>
                                                    <input type="text" name="letter_east"
                                                        class="form-control @error('letter_east') is-invalid @enderror"
                                                        placeholder="Keterangan Batas Tanah Sebelah Utara" required
                                                        value="{{ old('letter_east', $c->letter_east) }}" />
                                                    @error('letter_east')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Batas Sebelah Selatan</label>
                                                    <input type="text" name="letter_south"
                                                        class="form-control @error('letter_south') is-invalid @enderror"
                                                        placeholder="Keterangan Batas Tanah Sebelah Selatan" required
                                                        value="{{ old('letter_south', $c->letter_south) }}" />
                                                    @error('letter_south')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Batas Sebelah Barat</label>
                                                    <input type="text" name="letter_west"
                                                        class="form-control @error('letter_west') is-invalid @enderror"
                                                        placeholder="Keterangan Batas Tanah Sebelah Barat" required
                                                        value="{{ old('letter_west', $c->letter_west) }}" />
                                                    @error('letter_west')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Luas Tanah (m²)</label>
                                                    <input type="text" name="letter_total_area"
                                                        class="form-control @error('letter_total_area') is-invalid @enderror"
                                                        placeholder="Luas Tanah (m²)" required
                                                        value="{{ old('letter_total_area', $c->letter_total_area) }}" />
                                                    @error('letter_total_area')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Nama Ayah</label>
                                                    <input type="text" name="letter_father_name"
                                                        class="form-control @error('letter_father_name') is-invalid @enderror"
                                                        placeholder="Nama Ayah" required
                                                        value="{{ old('letter_father_name', $c->letter_father_name) }}" />
                                                    @error('letter_father_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>


                                                <div class="col-md-6 form-group">
                                                    <label>Nama Orang Tua Laki-laki Dari Ayah</label>
                                                    <input type="text" name="letter_father_name_bin"
                                                        class="form-control @error('letter_father_name_bin') is-invalid @enderror"
                                                        placeholder="Nama Orang Tua Laki-laki Dari Ayah" required
                                                        value="{{ old('letter_father_name_bin', $c->letter_father_name_bin) }}" />
                                                    @error('letter_father_name_bin')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Tahun Pemberian Tanah</label>
                                                    <input type="text" name="letter_year"
                                                        class="form-control @error('letter_year') is-invalid @enderror"
                                                        placeholder="Tahun Pemberian Tanah " required
                                                        value="{{ old('letter_year', $c->letter_year) }}" />
                                                    @error('letter_year')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                   <label>Saksi 1</label>
                                                    <input type="text" name="letter_evidence1"
                                                        class="form-control @error('letter_evidence1') is-invalid @enderror"
                                                        placeholder="Tahun Pemberian Tanah " required
                                                        value="{{ old('letter_evidence1', $c->letter_evidence1) }}" />
                                                    @error('letter_evidence1')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                   <label>Saksi 2</label>
                                                    <input type="text" name="letter_evidence2"
                                                        class="form-control @error('letter_evidence2') is-invalid @enderror"
                                                        placeholder="Tahun Pemberian Tanah " required
                                                        value="{{ old('letter_evidence2', $c->letter_evidence2) }}" />
                                                    @error('letter_evidence2')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            

                                                <div class="col-md-12 form-group">
                                                    <label>Tgl Surat</label>
                                                    <input type="date"
                                                        class="form-control @error('letter_date') is-invalid @enderror"
                                                        name="letter_date" id="date" required
                                                        value="{{ $c->letter_date }}">
                                                </div>



                                                <div class="col-md-12 form-group">
                                                    <label>Ditandatangani Oleh</label>
                                                    <select id="positions" class="form-control" name="positions"
                                                        style="width: 100%;" required>
                                                        @foreach ($position as $positions)
                                                            <option
                                                                value="{{ $positions->id }} {{ $positions->position }}">
                                                                {{ $positions->name }} -
                                                                {{ $positions->position }}</option>
                                                        @endforeach
                                                    </select>

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

                                                    <hr>
                                                    <div class="col-sm-12 d-flex justify-content-end">
                                                        <button type="submit"
                                                            class="btn btn-primary me-1 mb-1">Simpan</button>
                                                    </div>
                                                </div>



                                            </div>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- select2js -->
    <script src="{{ asset('/js/extensions/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('/js/extensions/select2/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $("#citizens").select2({
                maximumSelectionLength: 3
            });

        });
    </script>
    <script>
        $(document).on('change', '#positions', function(e) {
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
