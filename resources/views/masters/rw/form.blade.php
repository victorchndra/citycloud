@extends("layouts.app")
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Input Data RW</h4>
        <p class="card-description">
          Input Data RW
        </p>
        <form class="forms-sample" action="/masters/rw/form">
          <div class="form-group">
            <label for="exampleInputName1">UUID</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Nama RW</label>
            <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
          </div>
         
          {{-- <div class="form-group">
            <label for="exampleSelectGender">Gender</label>
              <select class="form-control" id="exampleSelectGender">
                <option>Male</option>
                <option>Female</option>
              </select>
            </div> --}}
          {{-- <div class="form-group">
            <label>File upload</label>
            <input type="file" name="img[]" class="file-upload-default">
            <div class="input-group col-xs-12">
              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputCity1">City</label>
            <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
          </div>
          <div class="form-group">
            <label for="exampleTextarea1">Textarea</label>
            <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
          </div> --}}
          <button type="submit" class="btn btn-primary me-2">Submit</button>
          <button class="btn btn-light">Cancel</button>
        </form>
      </div>
    </div>
  </div>


@endsection