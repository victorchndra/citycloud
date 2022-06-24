@extends('layouts.app')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{-- tes --}}
                <h4 class="card-title">Data WUS/PUS</h4>
                <form class="form form-horizontal" action="/motherkb" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-12 form-group">
                                <label>Pilih Penduduk</label>
                                <select id="wuspus_id" class="form-control select2" name="wuspus_id" style="width: 100%;"
                                    required>
                                    <option selected="selected" value="">Ketik Nama atau NIK</option>
                                    @foreach ($citizen as $citizens)
                                        <option value="{{ $citizens->id }}">
                                            {{ $citizens->nik }} - {{ $citizens->name }}
                                        </option>
                                    @endforeach
                                </select> 
                                </select>
                            </div>
                            
                            <div class="col-md-12 form-group">
                                <label>Pilih Pasangan</label>
                                <select id="couple_id" class="form-control select2" name="couple_id" style="width: 100%;"
                                    required>
                                    <option selected="selected" value="">Ketik Nama atau NIK</option>
                                    @foreach ($couple as $citizens)
                                        <option value="{{ $citizens->id }}">
                                            {{ $citizens->nik }} - {{ $citizens->name }}
                                        </option>
                                    @endforeach
                                </select> 
                                </select>
                            </div>
                            
                            <div class="col-md-12 form-group">
                                <label>Status KK</label>
                                <select class="form-control" name="status_kk">
                                    <option value="">Pilih Status</option>
                                    <option value="Sejahtera">Sejahtera</option>
                                    <option value="Tidak Sejahtera">Tidak Sejahtera</option>                                    
                                </select>
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Kelompok Dawasima</label>
                                <input type="text" name="klp_dawasima"
                                    class="form-control @error('klp_dawasima') is-invalid @enderror" placeholder="Kelompok Dawasima">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Hidup</label>
                                <input type="text" name="alive"
                                    class="form-control @error('alive') is-invalid @enderror" placeholder="Hidup">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Meninggal Pada Umur</label>
                                <input type="text" name="death"
                                    class="form-control @error('death') is-invalid @enderror" placeholder="Meninggal Pada Umur">
                            </div>
                            
                            <div class="col-md-12 form-group">
                                <label>Hasil Pengukuran Lingkar Lengan</label>
                                <input type="text" name="size"
                                    class="form-control @error('size') is-invalid @enderror" placeholder="Hasil Pengukuran Lingkar Lengan">
                            </div>

                            <div class="col-md-2 form-group">
                                <label>Pemberian Imun 1</label>
                                <select class="form-control" name="status_kk">
                                    <option value="">Pilih Opsi</option>
                                    <option value="Sejahtera">Ya</option>
                                    <option value="Tidak Sejahtera">Belum</option>                                    
                                </select>
                            </div>

                            <div class="col-md-2 form-group">
                                <label>Pemberian Imun 2</label>
                                <select class="form-control" name="status_kk">
                                    <option value="">Pilih Opsi</option>
                                    <option value="Sejahtera">Ya</option>
                                    <option value="Tidak Sejahtera">Belum</option>                                    
                                </select>
                            </div>

                            <div class="col-md-2 form-group">
                                <label>Pemberian Imun 3</label>
                                <select class="form-control" name="status_kk">
                                    <option value="">Pilih Opsi</option>
                                    <option value="Sejahtera">Ya</option>
                                    <option value="Tidak Sejahtera">Belum</option>                                    
                                </select>
                            </div>

                            <div class="col-md-2 form-group">
                                <label>Pemberian Imun 4</label>
                                <select class="form-control" name="status_kk">
                                    <option value="">Pilih Opsi</option>
                                    <option value="Sejahtera">Ya</option>
                                    <option value="Tidak Sejahtera">Belum</option>                                    
                                </select>
                            </div>

                            <div class="col-md-2 form-group">
                                <label>Pemberian Imun 5</label>
                                <select class="form-control" name="status_kk">
                                    <option value="">Pilih Opsi</option>
                                    <option value="Sejahtera">Ya</option>
                                    <option value="Tidak Sejahtera">Belum</option>                                    
                                </select>
                            </div>
                            
                            <div class="col-md-6 form-group">
                                <label>Jenis Kontrasepsi</label>
                                <div class="col-sm-12">
                                    <select name="kb_name" id="kb_name" class="form-control">
                                        <option selected="selected" value="">Pilih Jenis Kontrasepsi</option>
                                        @foreach ($kbs as $kb)
                                            <option value="{{ $kb->name }}"
                                                @if ($kbSelected == $kb->name) {{ 'selected' }} @endif>
                                                {{ $kb->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Tanggal Kontrasepsi</label>
                                <input type="date" name="kb_date"
                                    class="form-control @error('kb_date') is-invalid @enderror" placeholder="Tanggal KB">
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Kesertaan JKN</label>
                                <select class="form-control" name="status_kk">
                                    <option value="">Pilih Opsi</option>
                                    <option value="Sejahtera">Ya</option>
                                    <option value="Tidak Sejahtera">Tidak</option>                                    
                                </select>
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
