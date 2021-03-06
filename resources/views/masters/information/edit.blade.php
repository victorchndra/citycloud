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
      
        <form class="forms-sample" action="/information/{{ $i->uuid}}" method="post" enctype="multipart/form-data">
          @method('put')
          @csrf
          <div class="form-group">
            <label for="name">Surat</label>
            <input type="text" id="letter_index" name="letter_index" class="form-control @error('letter_index') is-invalid @enderror" 
            required autofocus value="{{old('letter_index',$i->letter_index)}}">
            @error('letter_index')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="name">Desa</label>
            <input type="text" id="village_name" name="village_name" class="form-control @error('village_name') is-invalid @enderror" 
            required autofocus value="{{old('village_name',$i->village_name)}}">
            @error('village_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="name">Kecamatan</label>
            <input type="text" id="sub_district_name" name="sub_district_name" class="form-control @error('sub_district_name') is-invalid @enderror" 
            required autofocus value="{{old('sub_district_name',$i->sub_district_name)}}">
            @error('sub_district_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="name">Kabupaten</label>
            <input type="text" id="district_name" name="district_name" class="form-control @error('district_name') is-invalid @enderror" 
            required autofocus value="{{old('district_name',$i->district_name)}}">
            @error('district_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="name">Provinsi</label>
            <input type="text" id="province_name" name="province_name" class="form-control @error('province_name') is-invalid @enderror" 
            required autofocus value="{{old('province_name',$i->province_name)}}">
            @error('province_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <!-- <div class="form-group">
            <label for="name">Kepala</label>
            <input type="text" id="header" name="header" class="form-control @error('header') is-invalid @enderror" 
            required autofocus value="{{old('header',$i->header)}}">
            @error('header')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div> -->
          <div class="form-group">
            <label for="name">Kode</label>
            <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" 
            required autofocus value="{{old('code',$i->code)}}">
            @error('code')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="header" class="form-label">Input Kop</label>
            <input type="hidden" name="oldImage" value="{{ $i->header}}">
            @if ($i->header)
            <img src="{{asset('storage/' . $i->header)}}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @else
            <img class="img-preview img-fluid mb-3 col-sm-5">
            @endif
            
            <input class="form-control @error('header') is-invalid @enderror"" type="file" id="header" name="header" value="{{ old('header', $i->header)}}" onchange="previewImage()">
            @error('header')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="signature" class="form-label">Input TTD Digital</label>
            <input type="hidden" name="oldImage" value="{{ $i->signature}}">
            @if ($i->signature)
            <img src="{{asset('storage/' . $i->signature)}}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @else
            <img class="img-preview img-fluid mb-3 col-sm-5">
            @endif
            
            <input class="form-control @error('signature') is-invalid @enderror"" type="file" id="signature" name="signature" value="{{ old('signature', $i->signature)}}" onchange="previewImage()">
            @error('signature')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
         
          <div class="mb-3">
            <label for="logo" class="form-label">Input Logo</label>
            <input type="hidden" name="oldImage" value="{{ $i->logo}}">
            @if ($i->logo)
            <img src="{{asset('storage/' . $i->logo)}}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @else
            <img class="img-preview img-fluid mb-3 col-sm-5">
            @endif
            
            <input class="form-control @error('logo') is-invalid @enderror"" type="file" id="logo" name="logo" value="{{ old('logo', $i->logo)}}" onchange="previewImage()">
            @error('logo')
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

  <script type="text/javascript">
   
    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection

   