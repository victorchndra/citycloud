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
                        <form class="form-sample" action="/letters-business/{{ $c->uuid }}" method="POST">
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

                                        <div class="col-md-6 form-group">
                                            <label>Jenis Usaha</label>

                                                <input type="text" name="business_variation" class="form-control @error('business_variation') is-invalid @enderror" 
                                                placeholder="cth: Grosir/Eceran, Rumah Makan" required value="{{ old('business_variation', $c->business_variation) }}"/>
                                                    @error('business_variation')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                 </div>

                                        <div class="col-md-6 form-group">
                                            <label>Nama Merk/Usaha</label>
                                            
                                            <input type="text" name="business_name" class="form-control @error('business_name') is-invalid @enderror" 
                                                placeholder="cth: Abadi Jaya, Mandiri Bangunan" required value="{{ old('business_name', $c->business_name) }}"/>
                                                    @error('business_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                 </div>

                                        <div class="col-md-6 form-group">
                                            <label>Alamat usaha</label>
                                            <input type="text" name="business_address" class="form-control @error('business_address') is-invalid @enderror" 
                                                placeholder="Alamat usaha" required value="{{ old('business_address', $c->business_address) }}"/>
                                                    @error('business_address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                 </div>

                                        <div class="col-md-6 form-group">
                                            <label>Tempat usaha</label>
                                            <input type="text" name="business_place" class="form-control @error('business_place') is-invalid @enderror" 
                                                placeholder="Tempat usaha" required value="{{ old('business_place', $c->business_place) }}"/>
                                                    @error('business_place')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                 </div>

                                        <div class="col-md-6 form-group">
                                            <label>Status Tanah</label>
                                            
                                            <select class="form-control @error('agrarian_status') is-invalid @enderror"
                                            name="agrarian_status" id="agrarian_status" required>
                                            <option value="Tidak ada" @if(!empty($c) && $c->agrarian_status =='TIDAK ADA'){{ 'selected' }}@endif>TIDAK ADA</option>
                                            <option value="Sertifikat Hak Milik" @if(!empty($c) && $c->agrarian_status =='SERTIFIKAT HAK MILIK'){{ 'selected' }}@endif>SERTIFIKAT HAK MILIK</option>
                                            <option value="HGB" @if(!empty($c) && $c->agrarian_status=='HGB'){{ 'selected' }}@endif>HGB</option>
                                            <option value="SKRT" @if(!empty($c) && $c->agrarian_status =='SKRT'){{ 'selected' }}@endif>SKRT</option>
                                            <option value="SKGK" @if(!empty($c) && $c->agrarian_status == 'SKGK'){{ 'selected' }}@endif>SKGK</option>
                                            </select>

                                         
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Status Kepemilikan</label>
                                            
                                            <select class="form-control @error('self_status') is-invalid @enderror"
                                            name="self_status" id="self_status" required>
                                            <option value="Sewa" @if(!empty($c) && $c->self_status =='SEWA'){{ 'selected' }}@endif>Sewa</option>
                                            <option value="Pinjam Pakai" @if(!empty($c) && $c->self_status =='PINJAM PAKAI'){{ 'selected' }}@endif>Pinjam Pakai</option>
                                            <option value="Milik Sendiri" @if(!empty($c) && $c->self_status=='MILIK SENDIRI'){{ 'selected' }}@endif>Milik Sendiri</option>
                                            <option value="Milik Orang Tua" @if(!empty($c) && $c->self_status =='MILIK ORANG TUA'){{ 'selected' }}@endif>Milik Orang Tua</option>
                                            <option value="Milik Perusahaan" @if(!empty($c) && $c->self_status == 'MILIK PERUSAHAAN'){{ 'selected' }}@endif>Milik Perusahaan</option>
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
