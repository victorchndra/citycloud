@extends('layouts.app')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{-- tes --}}
                <h4 class="card-title">Data Timbangan Anak</h4>
                <form class="form form-horizontal" action="/kidsweight" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Pilih Nama Anak</label>
                                <select id="citizen_id" class="form-control select2" name="citizen_id" style="width: 100%;"
                                    required>
                                    <option selected="selected" value="">Ketik Nama atau NIK</option>
                                    @foreach ($citizen as $citizen_id)
                                        <option value="{{ $citizen_id->id }}">{{ $citizen_id->nik }} -
                                            {{ $citizen_id->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Tinggi Badan</label>
                                <div class="input-group mb-3">
                                    <input name="height" type="text" class="form-control" placeholder="Tinggi Badan Anak"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">cm</span>
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Berat Badan</label>
                                <div class="input-group mb-3">
                                    <input name="weight" type="text" class="form-control"  placeholder="Berat Badan Anak"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Kg</span>
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Lingkar Kepala</label>
                                <div class="input-group mb-3">
                                    <input name="head_width" type="text" class="form-control" placeholder="Lingkar Kepala Anak"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">cm</span>
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Kepemilikan Buku KMS</label>
                                <select class="form-control" name="kms">
                                    <option value=""></option>
                                    <option value="Tidak">Tidak</option>
                                    <option value="Ya">Ya</option>                                    
                                </select>
                            </div>
                            
                            <div class="col-md-4 form-group">
                                <label>IMDB</label>
                                <select class="form-control" name="imdb">
                                    <option value=""></option>
                                    <option value="Tidak">Tidak</option>
                                    <option value="Ya">Ya</option>                                    
                                </select>
                            </div>
                            
                            <div class="col-md-4 form-group">
                                <label>Cara Ukur</label>
                                <select class="form-control" name="method_measure">
                                    <option value=""></option>
                                    <option value="Terlentang">Terlentang</option>
                                    <option value="Berdiri">Berdiri</option>                                    
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Vitamin A</label>
                                <select class="form-control" name="vitamin">
                                    <option value=""></option>
                                    <option value="Vitamin A Merah">Vitamin A Merah</option>
                                    <option value="Vitamin A Biru">Vitamin A Biru</option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Booster</label>
                                <select class="form-control" name="booster">
                                    <option value=""></option>
                                    <option value="Tidak">Tidak</option>
                                    <option value="Ya">Ya</option>                                    
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Jenis Imunisasi</label>
                                <div class="col-sm-12">
                                    <select name="imunitation" id="imunitation" class="form-control">
                                        <option selected="selected" value=""></option>
                                        @foreach ($imuns as $imun)
                                            <option value="{{ $imun->name }}"
                                                @if ($imunSelected == $imun->name) {{ 'selected' }} @endif>
                                                {{ $imun->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           
                            <div class="col-md-6 form-group">
                                <label>Tanggal Imunisasi</label>
                                <input type="date" name="imunitation_date"
                                    class="form-control @error('imunitation_date') is-invalid @enderror" placeholder="Tanggal Imunisasi">
                            </div>
                            

                            <div class="col-md-2 form-group">
                                <label>e1</label>
                                <select class="form-control" name="e1">
                                    <option value=""></option>
                                    <option value="Tidak">Tidak</option>
                                    <option value="Ya">Ya</option>                                    
                                </select>
                            </div>                            

                            <div class="col-md-2 form-group">
                                <label>e2</label>
                                <select class="form-control" name="e2">
                                    <option value=""></option>
                                    <option value="Tidak">Tidak</option>
                                    <option value="Ya">Ya</option>                                    
                                </select>
                            </div>

                            <div class="col-md-2 form-group">
                                <label>e3</label>
                                <select class="form-control" name="e3">
                                    <option value=""></option>
                                    <option value="Tidak">Tidak</option>
                                    <option value="Ya">Ya</option>                                    
                                </select>
                            </div>

                            <div class="col-md-2 form-group">
                                <label>e4</label>
                                <select class="form-control" name="e4">
                                    <option value=""></option>
                                    <option value="Tidak">Tidak</option>
                                    <option value="Ya">Ya</option>                                    
                                </select>
                            </div>

                            <div class="col-md-2 form-group">
                                <label>e5</label>
                                <select class="form-control" name="e5">
                                    <option value=""></option>
                                    <option value="Tidak">Tidak</option>
                                    <option value="Ya">Ya</option>                                    
                                </select>
                            </div>

                            <div class="col-md-2 form-group">
                                <label>e6</label>
                                <select class="form-control" name="e6">
                                    <option value=""></option>
                                    <option value="Tidak">Tidak</option>
                                    <option value="Ya">Ya</option>                                    
                                </select>
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Catatan</label>
                                <input type="text" name="notes"
                                    class="form-control @error('notes') is-invalid @enderror"
                                    placeholder="Catatan">
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
