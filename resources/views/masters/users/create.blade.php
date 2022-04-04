@extends("layouts.app")

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Pengguna</h4>
            <form class="form-sample" action="/users" method="POST">
                @csrf
                <p class="card-description my-3 text-muted">
                    Identitas pengguna
                </p>
                <hr class="text-muted">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" required value="{{ old('name') }}"/>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Pengguna</label>
                            <div class="col-sm-9">
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Nama Pengguna" required value="{{ old('username') }}"/>
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required value="{{ old('email') }}"/>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">No. Telp</label>
                            <div class="col-sm-9">
                                <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="No. Telp" required value="{{ old('phone') }}"/>
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kata Sandi</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kata Sandi" required value="{{ old('password') }}"/>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Konfirmasi Kata Sandi</label>
                            <div class="col-sm-9">
                                <input type="password" name="cpassword" class="form-control @error('cpassword') is-invalid @enderror" placeholder="Konfirmasi Kata Sandi" required value="{{ old('cpassword') }}"/>
                                @error('cpassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="address" required value="{{ old('address') }}"/>
                                @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center my-4">
                    <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
