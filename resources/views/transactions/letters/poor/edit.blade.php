@extends('layouts.app')
@section('content')
    <!-- select 2 -->
    <link rel="stylesheet" href="{{ asset('/css/addons/select2/select2.css') }}">

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Surat Keterangan Miskin</h3>
                    <p class="text-subtitle text-muted">Multiple Surat Keterangan Usaha you can use</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/list">Surat</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Surat Keterangan Miskin</li>
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
                            <h4 class="card-title">Edit Surat Keterangan Miskin</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @foreach ($citizen as $c)
                                    <form class="form-sample" action="/letters-poor/{{ $c->uuid }}" method="POST">
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

                                                <div class="col-md-6 form-group">
                                                    <label>Keterangan</label>

                                                    <select class="form-control @error('letter_status') is-invalid @enderror"
                                                        name="letter_status" id="letter_status" required>
                                                        <option value="Sewa"
                                                            @if (!empty($c) && $c->letter_status == 'Miskin') {{ 'selected' }} @endif>
                                                            Miskin</option>                                                        
                                                    </select>
                                                </div>

                                                <div class="col-md-6 form-group">
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
