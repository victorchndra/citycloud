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
                                <label>Pilih Penduduk</label>
                                <select id="mother_id" class="form-control select2" name="mother_id" style="width: 100%;"
                                    required>
                                    <option selected="selected" value="">Ketik Nama atau NIK</option>
                                    @foreach ($citizen as $citizens)
                                        <option value="{{ $citizens->name }}">{{ $citizens->nik }} -
                                            {{ $citizens->name }}</option>
                                    @endforeach
                                </select> 
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Jenis KB</label>
                                <div class="col-sm-12">
                                    <select name="kb_name" id="kb_name" class="form-control">
                                        <option selected="selected" value="">Pilih Jenis KB</option>
                                        @foreach ($kbs as $kb)
                                            <option value="{{ $kb->name }}"
                                                @if ($kbSelected == $kb->name) {{ 'selected' }} @endif>
                                                {{ $kb->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Tanggal KB</label>
                                <input type="date" name="kb_date"
                                    class="form-control @error('kb_date') is-invalid @enderror" placeholder="Tanggal KB">
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
