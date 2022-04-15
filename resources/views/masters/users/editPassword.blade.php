@extends("layouts.app")

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Pengguna</h4>
            @foreach ($datas as $data)
            <form class="form-sample" action="/users" method="POST">
                @csrf
                <p class="card-description my-3 text-muted">
                    Identitas pengguna
                </p>
                <hr class="text-muted">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kata sandi lama</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kata sandi lama" required"/>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kata sandi baru</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kata sandi baru" required"/>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Konfirmasi kata sandi baru</label>
                            <div class="col-sm-9">
                                <input type="password" name="cpassword" class="form-control @error('cpassword') is-invalid @enderror" placeholder="Konfirmasi kata sandi baru" required"/>
                                @error('cpassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                <div class="my-4 d-flex justify-content-end">
                    <div>
                        <a href="/users/{{ $data->uuid }}/edit" class="btn btn-secondary me-3 text-white">Tutup</a>
                        <button type="submit" class="btn btn-primary">Ubah password</button>
                    </div>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection
