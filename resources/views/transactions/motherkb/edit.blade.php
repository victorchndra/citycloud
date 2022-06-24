@extends('layouts.app')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ubah Data Jenis KB</h4>
                @foreach ($motherkb as $key => $data)
                    <form class="forms-sample" action="/motherkb/{{ $data->uuid }}" method="POST">
                        @method('put')
                        @csrf
                        <p class="card-description">
                            Ubah Data Jenis KB
                        </p>

                        <div class="col-md-12 form-group">
                            <label>Pilih Penduduk</label>
                            <select id="citizen_id" class="form-control select2" name="citizen_id" style="width: 100%;"
                                required>
                                @foreach ($motherkb as $motherkbs)
                                    <option selected="selected" value="{{ $motherkbs->citizen_id }}">
                                        {{ $motherkbs->citizenUser->nik }} - {{ $motherkbs->citizenUser->name }} 
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Jenis KB</label>
                            <div class="col-sm-12">
                                <select name="kb_name" id="kb_name" class="form-control">
                                    @foreach ($motherkb as $m)
                                        <option selected="selected" value="{{ $m->kb_name }}"> {{ $m->kb_name }}
                                        </option>
                                    @endforeach
                                    @foreach ($kbs as $kb)
                                        <option value="{{ $kb->name }}"
                                            @if ($kbSelected == $kb->name) {{ 'selected' }} @endif>
                                            {{ $kb->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Tanggal KB</label>

                            <input type="date" name="kb_date" class="form-control @error('kb_date') is-invalid @enderror"
                                placeholder="cth: 01/01/2022" required value="{{ old('kb_date', $data->kb_date) }}" />
                            @error('kb_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
