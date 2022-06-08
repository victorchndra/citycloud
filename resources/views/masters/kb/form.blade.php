@extends("layouts.app")
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Input Data Jenis KB</h4>
                <form class="forms-sample" action="/kb" method="POST">
                    @csrf
                    <p class="card-description">
                        Input Data Jenis KB
                    </p>
                    <div class="form-group">
                        <label for="name">Jenis KB</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="name" required autofocus value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
