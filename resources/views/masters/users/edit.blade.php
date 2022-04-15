@extends("layouts.app")

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Pengguna</h4>
            @foreach ($datas as $data)
            {{-- <form class="form-sample" action="/users/{{ $data->uuid }}" method="POST"> --}}
            <form class="form-sample" action="{{ route('users.update', $data->uuid) }}" method="POST">
                @method('put')
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
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" required autofocus value="{{old('name',$data->name)}}"/>
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
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Nama Pengguna" required value="{{ old('username', $data->username) }}"/>
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
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required value="{{ old('email', $data->email) }}"/>
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
                                <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="No. Telp" required value="{{ old('phone', $data->phone) }}"/>
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
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="address" required value="{{ old('address', $data->address) }}"/>
                                @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-4 d-flex justify-content-between">
                    <div>
                        <a href="/users/{{ $data->uuid }}/edit/password" class="btn btn-danger me-3 text-white">Ubah Kata Sandi</a>
                    </div>
                    <div>
                        <a href="/users" class="btn btn-secondary me-3 text-white">Tutup</a>
                        <button type="submit" class="btn btn-primary">Perbarui data pengguna</button>
                    </div>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection
