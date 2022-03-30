@extends("layouts.app")
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Input Data RW</h4>
        <p class="card-description">
          Input Data RW
        </p>
        {{-- @if (is_array($data) || is_object($data)) --}}
       @foreach($rw as $key => $j)
      
        <form class="forms-sample" action="/rw/{{ $j->uuid}}" method="post" enctype="multipart/form-data">
          @method('put')
          @csrf
         
          <div class="form-group">
            <label for="name">Nama RW</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
            required autofocus value="{{old('name',$j->name)}}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
         
          <button type="submit" class="btn btn-primary me-2">Ubah</button>
          <button class="btn btn-light">Cancel</button>
        </form>
        @endforeach
        
      </div>
    </div>
  </div>


@endsection
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