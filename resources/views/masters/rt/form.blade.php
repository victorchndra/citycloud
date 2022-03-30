@extends("layouts.app")
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Input Data RT</h4>
        <form class="forms-sample" action="/rt" method="POST">          
          @csrf
        <p class="card-description">
          Input Data RT
        </p>
        
          <div class="form-group">
            <label for="exampleInputEmail3">Nama RT</label>
            <input type="text" class="form-control" id="exampleInputEmail3" placeholder="RT">
          </div>
          <button type="submit" class="btn btn-primary me-2">Submit</button>
          <button class="btn btn-light">Cancel</button>
        </form>
      </div>
    </div>
  </div>


@endsection