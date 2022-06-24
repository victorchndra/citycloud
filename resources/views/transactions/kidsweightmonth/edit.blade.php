@extends('layouts.app')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ubah Data Timbang Anak</h4>
                @foreach ($datas as $key => $data)
                    <form class="forms-sample" action="/kidsweight/{{ $data->uuid }}" method="POST">
                        @method('put')
                        @csrf
                        <p class="card-description">
                            Ubah Data Timbang Anak
                        </p>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Pilih Nama Anak</label>
                                <select disabled id="citizen_id" class="form-control select2" name="citizen_id"
                                    style="width: 100%;" required>
                                    @foreach ($citizen as $citizen_id)
                                        <option value="{{ $citizen_id->id }}">{{ $citizen_id->nik }} -
                                            {{ $citizen_id->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Tinggi Badan</label>
                                <div class="input-group mb-3">
                                    <input name="height" type="text"
                                        class="form-control @error('height') is-invalid @enderror"
                                        placeholder="Tinggi Badan Anak" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2" required
                                        value="{{ old('business_name', $data->height) }}" />
                                    @error('height')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <span class="input-group-text" id="basic-addon2">cm</span>
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Berat Badan</label>
                                <div class="input-group mb-3">
                                    <input name="weight" type="text"
                                        class="form-control @error('weight') is-invalid @enderror"
                                        placeholder="Tinggi Badan Anak" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2" required
                                        value="{{ old('business_name', $data->weight) }}" />
                                    @error('weight')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <span class="input-group-text" id="basic-addon2">Kg</span>
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Lingkar Kepala</label>
                                <div class="input-group mb-3">
                                    <input name="head_width" type="text"
                                        class="form-control @error('head_width') is-invalid @enderror"
                                        placeholder="Tinggi Badan Anak" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2" required
                                        value="{{ old('business_name', $data->head_width) }}" />
                                    @error('head_width')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <span class="input-group-text" id="basic-addon2">cm</span>
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Kepemilikan Buku KMS</label>
                                <select class="form-control @error('kms') is-invalid @enderror" name="kms" id="kms"
                                    required>
                                    <option value="" @if (!empty($data) && $data->kms == '') {{ 'selected' }} @endif>
                                    </option>
                                    <option value="TIDAK" @if (!empty($data) && $data->kms == 'TIDAK') {{ 'selected' }} @endif>
                                        Tidak</option>
                                    <option value="YA" @if (!empty($data) && $data->kms == 'YA') {{ 'selected' }} @endif>
                                        Ya</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>IMDB</label>
                                <select class="form-control @error('imdb') is-invalid @enderror" name="imdb" id="imdb"
                                    required>
                                    <option value="" @if (!empty($data) && $data->imdb == '') {{ 'selected' }} @endif>
                                    </option>
                                    <option value="TIDAK" @if (!empty($data) && $data->imdb == 'TIDAK') {{ 'selected' }} @endif>
                                        Tidak</option>
                                    <option value="YA" @if (!empty($data) && $data->imdb == 'YA') {{ 'selected' }} @endif>
                                        Ya</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Cara Ukur</label>
                                <select class="form-control @error('method_measure') is-invalid @enderror"
                                    name="method_measure" id="method_measure" required>
                                    <option value="" @if (!empty($data) && $data->method_measure == '') {{ 'selected' }} @endif>
                                    </option>
                                    <option value="TERLENTANG"
                                        @if (!empty($data) && $data->method_measure == 'TERLENTANG') {{ 'selected' }} @endif>Terlentang</option>
                                    <option value="BERDIRI" @if (!empty($data) && $data->method_measure == 'BERDIRI') {{ 'selected' }} @endif>
                                        Berdiri</option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Vitamin A</label>
                                <select class="form-control @error('vitamin') is-invalid @enderror" name="vitamin"
                                    id="vitamin" required>
                                    <option value="" @if (!empty($data) && $data->vitamin == '') {{ 'selected' }} @endif>
                                    </option>
                                    <option value="VITAMIN A MERAH"
                                        @if (!empty($data) && $data->vitamin == 'VITAMIN A MERAH') {{ 'selected' }} @endif>Vitamin A Merah
                                    </option>
                                    <option value="VITAMIN A BIRU"
                                        @if (!empty($data) && $data->vitamin == 'VITAMIN A BIRU') {{ 'selected' }} @endif>Vitamin A Biru
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Booster</label>
                                <select class="form-control @error('booster') is-invalid @enderror" name="booster"
                                    id="booster" required>
                                    <option value="" @if (!empty($data) && $data->booster == '') {{ 'selected' }} @endif>
                                    </option>
                                    <option value="TIDAK" @if (!empty($data) && $data->booster == 'TIDAK') {{ 'selected' }} @endif>
                                        Tidak</option>
                                    <option value="YA" @if (!empty($data) && $data->booster == 'YA') {{ 'selected' }} @endif>
                                        Ya</option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Jenis Imunisasi</label>
                                <select class="form-control @error('imunitation') is-invalid @enderror" name="imunitation"
                                    id="imunitation" required>
                                    <option value="" @if (!empty($data) && $data->imunitation == '') {{ 'selected' }} @endif>
                                        TIDAK ADA</option>
                                    <option value="HEPATITIS B"
                                        @if (!empty($data) && $data->imunitation == 'HEPATITIS B') {{ 'selected' }} @endif>
                                        HEPATITIS B</option>
                                    <option value="DPT-1" @if (!empty($data) && $data->imunitation == 'DPT-1') {{ 'selected' }} @endif>
                                        DPT-1</option>
                                    <option value="POLIO-2" @if (!empty($data) && $data->imunitation == 'POLIO-2') {{ 'selected' }} @endif>
                                        POLIO-2</option>
                                    <option value="BCG (BACILLUS CALMETTE GUERIN)"
                                        @if (!empty($data) && $data->imunitation == 'BCG (BACILLUS CALMETTE GUERIN)') {{ 'selected' }} @endif>
                                        BCG (BACILLUS CALMETTE GUERIN)</option>
                                    <option value="TDPT-2" @if (!empty($data) && $data->imunitation == 'TDPT-2') {{ 'selected' }} @endif>
                                        TDPT-2</option>
                                    <option value="POLIO-3" @if (!empty($data) && $data->imunitation == 'POLIO-3') {{ 'selected' }} @endif>
                                        POLIO-3</option>
                                    <option value="POLIO-1" @if (!empty($data) && $data->imunitation == 'POLIO-1') {{ 'selected' }} @endif>
                                        POLIO-1</option>
                                    <option value="DPT-3" @if (!empty($data) && $data->imunitation == 'DPT-3') {{ 'selected' }} @endif>
                                        DPT-3</option>
                                    <option value="CAMPAK" @if (!empty($data) && $data->imunitation == 'CAMPAK') {{ 'selected' }} @endif>
                                        CAMPAK</option>
                                    <option value="VITAMIN C"
                                        @if (!empty($data) && $data->imunitation == 'VITAMIN C') {{ 'selected' }} @endif>
                                        VITAMIN C</option>
                                    <option value="IVP" @if (!empty($data) && $data->imunitation == 'IVP') {{ 'selected' }} @endif>
                                        IVP</option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Tanggal Imunisasi</label>
                                <input type="date" class="form-control @error('imunitation_date') is-invalid @enderror"
                                    name="imunitation_date" id="date" required value="{{ $data->imunitation_date }}">
                            </div>

                            <div class="col-md-4 form-group">
                                <label>e1</label>
                                <select class="form-control @error('e1') is-invalid @enderror" name="e1" id="e1" required>
                                    <option value="" @if (!empty($data) && $data->e1 == '') {{ 'selected' }} @endif>
                                    </option>
                                    <option value="TIDAK" @if (!empty($data) && $data->e1 == 'TIDAK') {{ 'selected' }} @endif>
                                        Tidak</option>
                                    <option value="YA" @if (!empty($data) && $data->e1 == 'YA') {{ 'selected' }} @endif>
                                        Ya</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>e2</label>
                                <select class="form-control @error('e2') is-invalid @enderror" name="e2" id="e2" required>
                                    <option value="" @if (!empty($data) && $data->e2 == '') {{ 'selected' }} @endif>
                                    </option>
                                    <option value="TIDAK" @if (!empty($data) && $data->e2 == 'TIDAK') {{ 'selected' }} @endif>
                                        Tidak</option>
                                    <option value="YA" @if (!empty($data) && $data->e2 == 'YA') {{ 'selected' }} @endif>
                                        Ya</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>e3</label>
                                <select class="form-control @error('e3') is-invalid @enderror" name="e3" id="e3" required>
                                    <option value="" @if (!empty($data) && $data->e3 == '') {{ 'selected' }} @endif>
                                    </option>
                                    <option value="TIDAK" @if (!empty($data) && $data->e3 == 'TIDAK') {{ 'selected' }} @endif>
                                        Tidak</option>
                                    <option value="YA" @if (!empty($data) && $data->e3 == 'YA') {{ 'selected' }} @endif>
                                        Ya</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>e4</label>
                                <select class="form-control @error('e4') is-invalid @enderror" name="e4" id="e4" required>
                                    <option value="" @if (!empty($data) && $data->e4 == '') {{ 'selected' }} @endif>
                                    </option>
                                    <option value="TIDAK" @if (!empty($data) && $data->e4 == 'TIDAK') {{ 'selected' }} @endif>
                                        Tidak</option>
                                    <option value="YA" @if (!empty($data) && $data->e4 == 'YA') {{ 'selected' }} @endif>
                                        Ya</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>e3</label>
                                <select class="form-control @error('e3') is-invalid @enderror" name="e5" id="e5" required>
                                    <option value="" @if (!empty($data) && $data->e5 == '') {{ 'selected' }} @endif>
                                    </option>
                                    <option value="TIDAK" @if (!empty($data) && $data->e5 == 'TIDAK') {{ 'selected' }} @endif>
                                        Tidak</option>
                                    <option value="YA" @if (!empty($data) && $data->e5 == 'YA') {{ 'selected' }} @endif>
                                        Ya</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>e6</label>
                                <select class="form-control @error('e6') is-invalid @enderror" name="e6" id="e6" required>
                                    <option value="" @if (!empty($data) && $data->e6 == '') {{ 'selected' }} @endif>
                                    </option>
                                    <option value="TIDAK" @if (!empty($data) && $data->e6 == 'TIDAK') {{ 'selected' }} @endif>
                                        Tidak</option>
                                    <option value="YA" @if (!empty($data) && $data->e6 == 'YA') {{ 'selected' }} @endif>
                                        Ya</option>
                                </select>
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Catatan</label>
                                <input type="text" name="notes" class="form-control @error('notes') is-invalid @enderror"
                                    required value="{{ old('notes', $data->notes) }}" />
                                @error('notes')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
