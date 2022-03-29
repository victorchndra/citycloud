@extends("layouts.app")

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Bantuan Sosial</h4>
            <form class="form-sample" action="/assistance" method="POST">
                @csrf
                <p class="card-description my-3 text-muted">
                    Identitas pribadi
                </p>
                <hr class="text-muted">
                <div class="row">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Bantuan Sosial</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" placeholder="Nama Bantuan Sosial"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nominal Bantuan</label>
                        <div class="col-sm-9">
                            <input type="number" name="nominal" class="form-control" placeholder="Nominal Bantuan"/>
                        </div>
                    </div>
                </div>
                
                
                <div class="d-flex justify-content-center my-4">
                    <button class="btn btn-primary">Tambah Data Bantuan Sosial</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
