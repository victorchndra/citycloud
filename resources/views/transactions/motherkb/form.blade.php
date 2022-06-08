@extends('layouts.app')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Ibu KB</h4>
                <form class="form form-horizontal" action="/motherkb" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-12 form-group">
                                <label>Nama Ibu</label>
                                <input type="text" name="mother_id"
                                    class="form-control @error('mother_id') is-invalid @enderror"
                                    placeholder="Nama Ibu">
                            </div>
                            
                            <div class="col-md-6 form-group">
                                <label>Nama KB</label>
                                <input type="text" name="kb_id"
                                    class="form-control @error('kb_id') is-invalid @enderror"
                                    placeholder="KB">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Tanggal KB</label>
                                <input type="date" name="kb_date"
                                    class="form-control @error('kb_date') is-invalid @enderror"
                                    placeholder="Tanggal KB">
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Tgl Surat</label>
                                <input type="date" name="letter_date"
                                    class="form-control @error('letter_date') is-invalid @enderror" placeholder="Y-m-d"
                                    required value="{{ old('letter_date') }}" />
                                @error('letter_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
