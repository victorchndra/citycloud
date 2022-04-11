@extends("layouts.app")
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Informasi</h4>
        <p class="card-description">
          Edit Data Informasi
        </p>
        {{-- @if (is_array($data) || is_object($data)) --}}
      
       @foreach($in as $key => $i)
      
        <form class="forms-sample" action="/ti/{{ $i->uuid}}" method="POST" enctype="multipart/form-data">
          @method('put')
          @csrf
          <div class="form-group">
            <label for="letter_index">Surat</label>
            <input type="text" id="letter_index" name="letter_index" class="form-control @error('letter_index') is-invalid @enderror" 
            required autofocus value="{{old('letter_index',$i->letter_index)}}">
            @error('letter_index')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="village_name">Nama Desa</label>
            <input type="text" id="village_name" name="village_name" class="form-control @error('village_name') is-invalid @enderror" 
            required autofocus value="{{old('village_name',$i->village_name)}}">
            @error('village_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="sub_district_name">Sub Nama Desa</label>
            <input type="text" id="sub_district_name" name="sub_district_name" class="form-control @error('sub_district_name') is-invalid @enderror" 
            required autofocus value="{{old('sub_district_name',$i->sub_district_name)}}">
            @error('sub_district_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="district_name">Nama District</label>
            <input type="text" id="district_name" name="district_name" class="form-control @error('district_name') is-invalid @enderror" 
            required autofocus value="{{old('district_name',$i->district_name)}}">
            @error('district_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="province_name">Nama Provinsi</label>
            <input type="text" id="province_name" name="province_name" class="form-control @error('province_name') is-invalid @enderror" 
            required autofocus value="{{old('province_name',$i->province_name)}}">
            @error('province_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="header">Kepala</label>
            <input type="text" id="header" name="header" class="form-control @error('header') is-invalid @enderror" 
            required autofocus value="{{old('header',$i->header)}}">
            @error('header')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="code">Kode</label>
            <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" 
            required autofocus value="{{old('code',$i->code)}}">
            @error('code')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
         
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="/ti" class="btn btn-ligth">Cancel</a>
        </form>
        @endforeach
        
      </div>
    </div>
  </div>


@endsection

   