@extends("layouts.app")

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Pengguna</h4>
       
            <form class="forms-sample" enctype="multipart/form-data" action="/profiles/{{ $data->uuid}}" method="POST">
                            @csrf
                            @if(!empty($data))
                                <input type="hidden" value="PUT" name="_method">
                            @endif
                            <div class="row">
                                         <!-- success message -->
                        @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <!-- success message end -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama Lengkap" value="@if(!empty($data)){{ $data->name }}@else{{ old('name') }}@endif">
                                        @error('name')<div class="invalid-feedback">* {{ $message }}</div>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="@if(!empty($data)){{ $data->email }}@else{{ old('email') }}@endif">
                                        @error('email')<div class="invalid-feedback">* {{ $message }}</div>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Telp</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Telp" value="@if(!empty($data)){{ $data->phone }}@else{{ old('phone') }}@endif">
                                        @error('phone')<div class="invalid-feedback">* {{ $message }}</div>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Alamat" value="@if(!empty($data)){{ $data->address }}@else{{ old('address') }}@endif">
                                        @error('address')<div class="invalid-feedback">* {{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                @if ( Auth::user()->roles == 'god')
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" value="@if(!empty($data)){{ $data->username }}@else{{ old('username') }}@endif">
                                        @error('username')<div class="invalid-feedback">* {{ $message }}</div>@enderror
                                    </div>
                                @endif

                                @if ( Auth::user()->roles == 'citizens' || Auth::user()->roles == 'admin' )
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input readonly type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" value="@if(!empty($data)){{ $data->username }}@else{{ old('username') }}@endif">
                                        @error('username')<div class="invalid-feedback">* {{ $message }}</div>@enderror
                                    </div>
                                @endif
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" >
                                        @error('password')<div class="invalid-feedback">* {{ $message }}</div>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Password</label>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" >
                                        @error('password_confirmation')<div class="invalid-feedback">* {{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success float-right">Simpan</button>
                        </form>
        </div>
    </div>
</div>
@endsection
