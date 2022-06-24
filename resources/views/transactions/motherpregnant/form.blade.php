@extends("layouts.app")
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Input Data Ibu Hamil</h4>
                <form class="forms-sample" action="/motherpregnant" method="POST">
                    @csrf
                    <p class="card-description">
                        Input Data Ibu Hamil
                    </p>
                    <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Nama Ibu</label>
                        <select id="citizen_id" class="form-control select2" name="citizen_id"
                            style="width: 100%;" required>
                            <option selected="selected" value="">Ketik Nama atau NIK</option>
                            @foreach($citizen as $citizens)
                            <option value="{{ $citizens->id }}">{{ $citizens->nik }} -
                                {{ $citizens->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="name">Berat Badan</label>
                        <input type="text" name="weight" class="form-control @error('weight') is-invalid @enderror" id="weight"
                            placeholder="Berat Badan Sebelum Dan Sesudah Hamil" required autofocus value="{{ old('weight') }}">
                        @error('weight')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">Tinggi Badan</label>
                        <input type="text" name="height" class="form-control @error('height') is-invalid @enderror" id="height"
                            placeholder="Tinggi Badan" required autofocus value="{{ old('height') }}">
                        @error('height')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="name">Hamil ke</label>
                        <input type="text" name="pregnant_to" class="form-control @error('pregnant_to') is-invalid @enderror" id="pregnant_to"
                            placeholder="Hamil ke" required autofocus value="{{ old('pregnant_to') }}">
                        @error('pregnant_to')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="name">Usia Kehamilan</label>
                        <input type="text" name="gestational_age" class="form-control @error('gestational_age') is-invalid @enderror" id="gestational_age"
                            placeholder="Usia Kehamilan" required autofocus value="{{ old('gestational_age') }}">
                        @error('gestational_age')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="name">Penyakit Penyerta</label>
                        <input type="text" name="disease" class="form-control @error('disease') is-invalid @enderror" id="disease"
                            placeholder="Penyakit Penyerta" required autofocus value="{{ old('disease') }}">
                        @error('disease')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="name">Lila (Lingkar Lengan Atas)</label>
                        <input type="text" name="lila" class="form-control @error('lila') is-invalid @enderror" id="lila"
                            placeholder="Lila (Lingkar Lengan Atas)" required autofocus value="{{ old('lila') }}">
                        @error('lila')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">Periksa Kehamilan</label>
                        <input type="text" name="check_pregnancy" class="form-control @error('check_pregnancy') is-invalid @enderror" id="check_pregnancy"
                            placeholder="Periksa Kehamilan" required autofocus value="{{ old('check_pregnancy') }}">
                        @error('check_pregnancy')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <label for="name">Jumlah Hidup</label>
                        <input type="text" name="number_lives" class="form-control @error('number_lives') is-invalid @enderror" id="number_lives"
                            placeholder="Jumlah Hidup" required autofocus value="{{ old('number_lives') }}">
                        @error('number_lives')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">Jumlah Mati</label>
                        <input type="text" name="number_death" class="form-control @error('number_death') is-invalid @enderror" id="number_death"
                            placeholder="Jumlah Mati" required autofocus value="{{ old('number_death') }}">
                        @error('number_death')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="name">Tanggal Meninggal</label>
                        <input type="date" name="meninggal" class="form-control @error('meninggal') is-invalid @enderror" id="meninggal"
                            placeholder="Tanggal Meninggal" required autofocus value="{{ old('meninggal') }}">
                        @error('meninggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="name">tt1</label>
                        <select name="tt1" id="tt1" class="form-control" required>
                            <option value="ya">Ya</option>
                            <option value="belum">Belum</option>
                        </select>
                        @error('tt1')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">tt2</label>
                        <select name="tt2" id="tt2" class="form-control" required>
                            <option value="ya">Ya</option>
                            <option value="belum">Belum</option>
                        </select>
                        @error('tt2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">tt3</label>
                        <select name="tt3" id="tt3" class="form-control" required>
                            <option value="ya">Ya</option>
                            <option value="belum">Belum</option>
                        </select>
                        @error('tt3')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">tt4</label>
                        <select name="tt4" id="tt4" class="form-control" required>
                            <option value="ya">Ya</option>
                            <option value="belum">Belum</option>
                        </select>
                        @error('tt4')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">tt5</label>
                        <select name="tt5" id="tt5" class="form-control" required>
                            <option value="ya">Ya</option>
                            <option value="belum">Belum</option>
                        </select>
                        @error('tt5')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
