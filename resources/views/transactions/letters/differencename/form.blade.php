@extends("layouts.app")
@section('content')
<!-- select 2 -->
<link rel="stylesheet" href="{{asset('/css/addons/select2/select2.css')}}">

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Surat Keterangan Beda Nama</h3>
                <p class="text-subtitle text-muted">Multiple Surat Keterangan Beda Nama you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/list">Surat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Surat Keterangan Beda Nama</li>
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
                        <h4 class="card-title">Tambah Surat Keterangan Beda Nama</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        @if ( Auth::user()->roles == 'god' || Auth::user()->roles == 'admin')
                            <form class="form form-horizontal" action="/letters-difference-name" method="POST">
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
                                            <select id="citizens" class="form-control select2" name="citizens"
                                                style="width: 100%;" required>
                                                <option selected="selected" value="">Ketik Nama atau NIK</option>
                                                @foreach($citizen as $citizens)
                                                <option value="{{ $citizens->id }}">{{ $citizens->nik }} -
                                                    {{ $citizens->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Nama Salah</label>
                                            <input type="text" name="old_name"
                                                class="form-control @error('old_name') is-invalid @enderror"
                                                placeholder="Nama Lama">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Letak Salah</label>
                                            <input type="text" name="mistake_loc"
                                                class="form-control @error('mistake_loc') is-invalid @enderror"
                                                placeholder="(cth : Buku Nikah / ...)">
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Nama Benar</label>
                                            <input type="text" name="new_name"
                                                class="form-control @error('new_name') is-invalid @enderror"
                                                placeholder="Nama Baru">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Letak Benar</label>
                                            <input type="text" name="valid_loc"
                                                class="form-control @error('valid_loc') is-invalid @enderror"
                                                placeholder="(cth: KTP / KK / ...)">
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Untuk Kepentingan</label>
                                            <input type="text" name="used_for"
                                                class="form-control @error('used_for') is-invalid @enderror"
                                                placeholder="Kepentingan Surat">
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Warga Negara</label>
                                            <select id="citizenStatus" class="form-control select2" name="citizen_status" style="width: 100%;" required>
                                                <option value="WNI">WNI</option>
                                                <option value="WNA">WNA</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Tgl Surat</label>
                                            <input type="date" name="letter_date" class="form-control @error('letter_date') is-invalid @enderror" placeholder="Y-m-d" required value="{{ old('letter_date') }}"/>
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
                                                <option value="{{ $positions->id  }} {{ $positions->position  }}">{{ $positions->name }} -
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
                                    </div>

                                    </div>
                            </form>
                        @else

                        <form class="form form-horizontal" action="/letters-difference-name" method="POST">
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

                                                <option value="{{ Auth::user()->citizens_id}}">{{ Auth::user()->name}} - {{ Auth::user()->username}}</option>

                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Nama Salah</label>
                                            <input type="text" name="old_name"
                                                class="form-control @error('old_name') is-invalid @enderror"
                                                placeholder="Nama Lama">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Letak Salah</label>
                                            <input type="text" name="mistake_loc"
                                                class="form-control @error('mistake_loc') is-invalid @enderror"
                                                placeholder="(cth : Buku Nikah / ...)">
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Nama Benar</label>
                                            <input type="text" name="new_name"
                                                class="form-control @error('new_name') is-invalid @enderror"
                                                placeholder="Nama Baru">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Letak Benar</label>
                                            <input type="text" name="valid_loc"
                                                class="form-control @error('valid_loc') is-invalid @enderror"
                                                placeholder="(cth: KTP / KK / ...)">
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Untuk Kepentingan</label>
                                            <input type="text" name="used_for"
                                                class="form-control @error('used_for') is-invalid @enderror"
                                                placeholder="Kepentingan Surat">
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Warga Negara</label>
                                            <select id="citizenStatus" class="form-control select2" name="citizen_status" style="width: 100%;" required>
                                                <option value="WNI">WNI</option>
                                                <option value="WNA">WNA</option>
                                            </select>
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
