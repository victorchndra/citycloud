@extends("layouts.app")
@section('content')
<!-- select 2 -->
<link rel="stylesheet" href="{{asset('/css/addons/select2/select2.css')}}">

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Surat Keterangan Usaha</h3>
                <p class="text-subtitle text-muted">Multiple Surat Keterangan Usaha you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/list">Surat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Surat Keterangan Usaha</li>
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
                        <h4 class="card-title">Edit Surat Keterangan Usaha</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        @foreach ($citizen as $c)
                        <form class="form-sample" action="/letters-collegedispensation/{{ $c->uuid }}" method="POST">
                            @method('put')
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
                                            <label>Pilih Penduduk</label>
                                            <select disabled id="citizens" class="form-control select2" name="citizens"
                                                style="width: 100%;" required>
                                                @foreach($citizen as $citizens)
                                                <option value="{{ $citizens->id }}">{{ $citizens->nik }} -
                                                    {{ $citizens->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- start --}}

                                        <div class="col-md-7 form-group">
                                            <label>Surat Ditujukan Kepada</label>
                                            <input type="text" name="receiver"
                                                class="form-control @error('receiver') is-invalid @enderror"
                                                placeholder="Nama Penerima" value="{{ old('receiver', $c->receiver) }}">
                                        </div>

                                        <div class="col-md-5 form-group">
                                            <label>Perguruan Tinggi</label>
                                            <input type="text" name="college"
                                                class="form-control @error('college') is-invalid @enderror"
                                                placeholder="Nama Perguruan Tinggi" value="{{ old('college', $c->college) }}">
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>NIM</label>
                                            <input type="text" name="nim"
                                                class="form-control @error('nim') is-invalid @enderror"
                                                placeholder="NIM" value="{{ old('nim', $c->nim) }}">
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Jurusan</label>
                                            <input type="text" name="major"
                                                class="form-control @error('major') is-invalid @enderror"
                                                placeholder="Jurusan" value="{{ old('major', $c->major) }}">
                                        </div>

                                        <div class="col-md-2 form-group">
                                            <label>Semester</label>
                                            <input type="number" name="semester"
                                                class="form-control @error('semester') is-invalid @enderror"
                                                placeholder="0" value="{{ old('semester', $c->semester) }}">
                                        </div>

                                        <div class="col-md-2 form-group">
                                            <label>Pembayaran tahap ke</label>
                                            <input type="number" name="stage"
                                                class="form-control @error('stage') is-invalid @enderror"
                                                placeholder="0" value="{{ old('stage', $c->stage) }}">
                                        </div>

                                        <div class="col-md-2 form-group">
                                            <label>Tahun Ajaran</label>
                                            <input type="text" name="academic_year"
                                                class="form-control @error('academic_year') is-invalid @enderror"
                                                placeholder="(cth : 2022/2023)" value="{{ old('academic_year', $c->academic_year) }}">
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label>Nominal Pembayaran</label>
                                            <input type="number" name="nominal"
                                                class="form-control @error('nominal') is-invalid @enderror"
                                                placeholder="(cth : Rp 1500000)" value="{{ old('nominal', $c->nominal) }}">
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label>Waktu Pembayaran</label>
                                            <select class="form-control select2" name="pay_month" style="width: 100%;" required>
                                                <option value="Januari" @if(!empty($c) && $c->pay_month =='Januari'){{ 'selected' }}@endif>Januari</option>
                                                <option value="Februari" @if(!empty($c) && $c->pay_month =='Februari'){{ 'selected' }}@endif>Februari</option>
                                                <option value="Maret" @if(!empty($c) && $c->pay_month =='Maret'){{ 'selected' }}@endif>Maret</option>
                                                <option value="April" @if(!empty($c) && $c->pay_month =='April'){{ 'selected' }}@endif>April</option>
                                                <option value="Mei" @if(!empty($c) && $c->pay_month =='Mei'){{ 'selected' }}@endif>Mei</option>
                                                <option value="Juni" @if(!empty($c) && $c->pay_month =='Juni'){{ 'selected' }}@endif>Juni</option>
                                                <option value="Juli" @if(!empty($c) && $c->pay_month =='Juli'){{ 'selected' }}@endif>Juli</option>
                                                <option value="Agustus" @if(!empty($c) && $c->pay_month =='Agustus'){{ 'selected' }}@endif>Agustus</option>
                                                <option value="September" @if(!empty($c) && $c->pay_month =='September'){{ 'selected' }}@endif>September</option>
                                                <option value="Oktober" @if(!empty($c) && $c->pay_month =='Oktober'){{ 'selected' }}@endif>Oktober</option>
                                                <option value="November" @if(!empty($c) && $c->pay_month =='November'){{ 'selected' }}@endif>November</option>
                                                <option value="Desember" @if(!empty($c) && $c->pay_month =='Desember'){{ 'selected' }}@endif>Desember</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Tgl Surat</label>
                                            <input type="date" class="form-control @error('letter_date') is-invalid @enderror" name="letter_date" id="date" required value="{{$c->letter_date}}">
                                        </div>



                                        <div class="col-md-12 form-group">
                                            <label>Ditandatangani Oleh</label>
                                            <select id="positions" class="form-control" name="positions"
                                                style="width: 100%;" required>
                                                @foreach($position as $positions)
                                                <option value="{{ $positions->id  }} {{ $positions->position  }}">{{ $positions->name }} -
                                                    {{ $positions->position }}</option>

                                                @endforeach
                                            </select>

                                        <div class="col-md-12">
                                            <div class="form-group">

                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" value="wet" name="signature" id="wet" checked>
                                            <label class="form-check-label" for="wet">
                                               Basah
                                            </label>
                                            </div>

                                            <div class="form-check" name="sep" id="sep">
                                            <input class="form-check-input" type="radio" value="digital" name="signature" id="digital">
                                            <label class="form-check-label" for="digital">
                                                Digital
                                            </label>
                                            </div>

                                            </div>
                                        </div>

                                            <hr>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
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
<script src="{{asset('/js/extensions/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('/js/extensions/select2/select2.full.min.js')}}"></script>
<script>
    $(document).ready(function () {

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
        console.log("checkvalue",replaced);
    });


    </script>
@endsection
