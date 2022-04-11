@extends("layouts.app")

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Rentang Usia</h4>
            <form class="form-sample" action="/agerange" method="POST">
                @csrf
                <p class="card-description my-3 text-muted">
                    Tambah Data Rentang Usia
                </p>
                <hr class="text-muted">
                
                <div class="row">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Mulai</label>
                        <div class="col-sm-9">
                            <input type="number" name="start" class="form-control @error('start') is-invalid @enderror" placeholder="Mulai"/>
                        </div>
                        @error('start')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sampai</label>
                        <div class="col-sm-9">
                            <input type="number" name="end" class="form-control @error('end') is-invalid @enderror" placeholder="Sampai"/>
                        </div>
                        @error('end')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <input type="text" name="notes" class="form-control @error('notes') is-invalid @enderror" placeholder="Keterangan"/>
                        </div>
                        @error('notes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                
                
                <div class="d-flex justify-content-center my-4">
                    <button type="submit" class="btn btn-primary">Tambah Data Rentang Usia</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
