@extends("layouts.app")
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ubah Data RT</h4>
                @foreach($datas as $key => $data)
                <form class="forms-sample" action="/motherpregnant/{{ $data->uuid}}" method="POST">
                    @method('put')
                    @csrf
                    <p class="card-description">
                        Ubah Data Ibu Hamil
                    </p>
                    <div class="col-md-12 form-group">
                        <label>Nama Ibu</label>
                        <select disabled id="citizen_id" class="form-control select2" name="citizen_id"
                            style="width: 100%;" required>
                            
                            @foreach($citizen as $citizens)
                            <option value="{{ $citizens->id  }}">{{ $data->motherUser->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Berat Badan Sebelum Dan Sesudah Hamil</label>
                        <input type="text" name="weight" class="form-control @error('weight') is-invalid @enderror" id="weight"
                            placeholder="Berat Badan Sebelum Dan Sesudah Hamil" required autofocus value="{{old('weight', $data->weight)}}">
                        @error('weight')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Tinggi Badan</label>
                        <input type="text" name="height" class="form-control @error('height') is-invalid @enderror" id="height"
                            placeholder="Tinggi Badan" required autofocus value="{{ old('height',$data->height) }}">
                        @error('height')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Hamil ke</label>
                        <input type="text" name="pregnant_to" class="form-control @error('pregnant_to') is-invalid @enderror" id="pregnant_to"
                            placeholder="Hamil ke" required autofocus value="{{ old('pregnant_to',$data->pregnant_to) }}">
                        @error('pregnant_to')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Usia Kehamilan</label>
                        <input type="text" name="gestational_age" class="form-control @error('gestational_age') is-invalid @enderror" id="gestational_age"
                            placeholder="Usia Kehamilan" required autofocus value="{{ old('gestational_age',$data->gestational_age) }}">
                        @error('gestational_age')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Penyakit Penyerta</label>
                        <input type="text" name="disease" class="form-control @error('disease') is-invalid @enderror" id="disease"
                            placeholder="Penyakit Penyerta" required autofocus value="{{ old('disease',$data->disease) }}">
                        @error('disease')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Lila (Lingkar Lengan Atas)</label>
                        <input type="text" name="lila" class="form-control @error('lila') is-invalid @enderror" id="lila"
                            placeholder="Lila (Lingkar Lengan Atas)" required autofocus value="{{ old('lila',$data->lila) }}">
                        @error('lila')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Periksa Kehamilan</label>
                        <input type="text" name="check_pregnancy" class="form-control @error('check_pregnancy') is-invalid @enderror" id="check_pregnancy"
                            placeholder="Periksa Kehamilan" required autofocus value="{{ old('check_pregnancy',$data->check_pregnancy) }}">
                        @error('check_pregnancy')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Jumlah Hidup</label>
                        <input type="text" name="number_lives" class="form-control @error('number_lives') is-invalid @enderror" id="number_lives"
                            placeholder="Jumlah Hidup" required autofocus value="{{ old('number_lives',$data->number_lives) }}">
                        @error('number_lives')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Jumlah Mati</label>
                        <input type="text" name="number_death" class="form-control @error('number_death') is-invalid @enderror" id="number_death"
                            placeholder="Jumlah Mati" required autofocus value="{{ old('number_death',$data->number_death) }}">
                        @error('number_death')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Tanggal Meninggal</label>
                        <input type="date" name="meninggal" class="form-control @error('meninggal') is-invalid @enderror" id="meninggal"
                            placeholder="Tanggal Meninggal" required autofocus value="{{ old('meninggal',$data->meninggal) }}">
                        @error('meninggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">tt1</label>
                        <input type="text" name="tt1" class="form-control @error('tt1') is-invalid @enderror" id="tt1"
                            placeholder="tt1" required autofocus value="{{ old('tt1',$data->tt1) }}">
                        @error('tt1')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">tt2</label>
                        <input type="text" name="tt2" class="form-control @error('tt2') is-invalid @enderror" id="tt2"
                            placeholder="tt2" required autofocus value="{{ old('tt2',$data->tt2) }}">
                        @error('tt2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">tt3</label>
                        <input type="text" name="tt3" class="form-control @error('tt3') is-invalid @enderror" id="tt3"
                            placeholder="tt3" required autofocus value="{{ old('tt3',$data->tt3) }}">
                        @error('tt3')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">tt4</label>
                        <input type="text" name="tt4" class="form-control @error('tt4') is-invalid @enderror" id="tt4"
                            placeholder="tt4" required autofocus value="{{ old('tt4',$data->tt4) }}">
                        @error('tt4')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">tt5</label>
                        <input type="text" name="tt5" class="form-control @error('tt5') is-invalid @enderror" id="tt5"
                            placeholder="tt5" required autofocus value="{{ old('tt5',$data->tt5) }}">
                        @error('tt5')
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
