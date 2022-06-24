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
                    <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Nama Ibu</label>
                        <select disabled id="citizen_id" class="form-control select2" name="citizen_id"
                            style="width: 100%;" required>
                            
                            @foreach($citizen as $citizens)
                            <option value="{{ $citizens->id  }}">{{ $data->motherUser->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="name">Berat Badan Sebelum Dan Sesudah Hamil</label>
                        <input type="text" name="weight" class="form-control @error('weight') is-invalid @enderror" id="weight"
                            placeholder="Berat Badan Sebelum Dan Sesudah Hamil" required autofocus value="{{old('weight', $data->weight)}}">
                        @error('weight')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">Tinggi Badan</label>
                        <input type="text" name="height" class="form-control @error('height') is-invalid @enderror" id="height"
                            placeholder="Tinggi Badan" required autofocus value="{{ old('height',$data->height) }}">
                        @error('height')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="name">Hamil ke</label>
                        <input type="text" name="pregnant_to" class="form-control @error('pregnant_to') is-invalid @enderror" id="pregnant_to"
                            placeholder="Hamil ke" required autofocus value="{{ old('pregnant_to',$data->pregnant_to) }}">
                        @error('pregnant_to')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="name">Usia Kehamilan</label>
                        <input type="text" name="gestational_age" class="form-control @error('gestational_age') is-invalid @enderror" id="gestational_age"
                            placeholder="Usia Kehamilan" required autofocus value="{{ old('gestational_age',$data->gestational_age) }}">
                        @error('gestational_age')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="name">Penyakit Penyerta</label>
                        <input type="text" name="disease" class="form-control @error('disease') is-invalid @enderror" id="disease"
                            placeholder="Penyakit Penyerta" required autofocus value="{{ old('disease',$data->disease) }}">
                        @error('disease')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="name">Lila (Lingkar Lengan Atas)</label>
                        <input type="text" name="lila" class="form-control @error('lila') is-invalid @enderror" id="lila"
                            placeholder="Lila (Lingkar Lengan Atas)" required autofocus value="{{ old('lila',$data->lila) }}">
                        @error('lila')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">Periksa Kehamilan</label>
                        <input type="text" name="check_pregnancy" class="form-control @error('check_pregnancy') is-invalid @enderror" id="check_pregnancy"
                            placeholder="Periksa Kehamilan" required autofocus value="{{ old('check_pregnancy',$data->check_pregnancy) }}">
                        @error('check_pregnancy')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="name">Jumlah Hidup</label>
                        <input type="text" name="number_lives" class="form-control @error('number_lives') is-invalid @enderror" id="number_lives"
                            placeholder="Jumlah Hidup" required autofocus value="{{ old('number_lives',$data->number_lives) }}">
                        @error('number_lives')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">Jumlah Mati</label>
                        <input type="text" name="number_death" class="form-control @error('number_death') is-invalid @enderror" id="number_death"
                            placeholder="Jumlah Mati" required autofocus value="{{ old('number_death',$data->number_death) }}">
                        @error('number_death')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">Tanggal Meninggal</label>
                        <input type="date" name="meninggal" class="form-control @error('meninggal') is-invalid @enderror" id="meninggal"
                            placeholder="Tanggal Meninggal" required autofocus value="{{ old('meninggal',$data->meninggal) }}">
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
                        <div class="col-sm-9">
                        <select name="tt1" class="form-control" required>
                            @if (old('tt1', 'ya') == $data->tt1)
                            <option value="ya" selected>Ya</option>
                            <option value="belum">Belum</option>
                            @elseif (old('tt1', 'belum') == $data->tt1)
                            <option value="ya" >Ya</option>
                            <option value="belum" selected>Belum</option>
                            @endif
                        </select>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">tt2</label>
                        <div class="col-sm-9">
                            <select name="tt2" class="form-control" required>
                                @if (old('tt2', 'ya') == $data->tt2)
                                <option value="ya" selected>Ya</option>
                                <option value="belum">Belum</option>
                                @elseif (old('tt2', 'belum') == $data->tt2)
                                <option value="ya" >Ya</option>
                                <option value="belum" selected>Belum</option>
                                @endif
                            </select>
                            </div>
                        @error('tt2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">tt3</label>
                        <div class="col-sm-9">
                            <select name="tt3" class="form-control" required>
                                @if (old('tt3', 'ya') == $data->tt3)
                                <option value="ya" selected>Ya</option>
                                <option value="belum">Belum</option>
                                @elseif (old('tt3', 'belum') == $data->tt3)
                                <option value="ya" >Ya</option>
                                <option value="belum" selected>Belum</option>
                                @endif
                            </select>
                            </div>
                        @error('tt3')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">tt4</label>
                        <div class="col-sm-9">
                            <select name="tt4" class="form-control" required>
                                @if (old('tt4', 'ya') == $data->tt4)
                                <option value="ya" selected>Ya</option>
                                <option value="belum">Belum</option>
                                @elseif (old('tt4', 'belum') == $data->tt4)
                                <option value="ya" >Ya</option>
                                <option value="belum" selected>Belum</option>
                                @endif
                            </select>
                            </div>
                        @error('tt4')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">tt5</label>
                        <div class="col-sm-9">
                            <select name="tt5" class="form-control" required>
                                @if (old('tt5', 'ya') == $data->tt5)
                                <option value="ya" selected>Ya</option>
                                <option value="belum">Belum</option>
                                @elseif (old('tt5', 'belum') == $data->tt5)
                                <option value="ya" >Ya</option>
                                <option value="belum" selected>Belum</option>
                                @endif
                            </select>
                            </div>
                        @error('tt5')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
                @endforeach
            </div>  
        </div>
    </div>
@endsection
