@extends("layouts.app")
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Anak</h4>
                <p class="card-description">
                    Data Anak Kelurahan Lembah Sari
                </p>

                    <div class="card-content">
                        <div class="card-body">
                        @foreach ($datas as $data)

                        @if(isset($data->children))
                        <form class="form-sample" action="/health-care/{{ $data->uuid }}" method="POST">
                            @method('PUT')
                        @else
                        <form class="form-sample" action="/health-care/{{ $data->uuid }}" method="POST">
                        @endif
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="name">Nama Anak</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $data->name }}" readonly>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="parentName">Nama Orang Tua</label>
                                        <input type="text" name="parentName" class="form-control @error('parentName') is-invalid @enderror" value="{{ strtoupper($data->father_name) }} - {{ strtoupper($data->mother_name) }}" readonly>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="weight">Berat Badan</label>
                                        <div class="d-flex flex-row">
                                            <div class="col-md-10">
                                                <input type="number" name="weight" placeholder="Tulis berat badan" required class="col-md-10 form-control @error('weight') is-invalid @enderror" @if(isset($data->children->weight)) value="{{ old('weight', $data->children->weight) }}" @endif>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" readonly value="KG" class="form-control text-center">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="height">Tinggi Badan</label>
                                        <div class="d-flex flex-row">
                                            <div class="col-md-10">
                                                <input type="number" name="height" placeholder="Tulis tinggi badan" required class="form-control @error('height') is-invalid @enderror" @if(isset($data->children->height)) value="{{ old('height', $data->children->height) }}" @endif>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" readonly value="CM" class="form-control text-center">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="gender">Jenis Kelamin</label>
                                        <input type="text" name="gender" value="{{ strtoupper($data->gender) }}" class="form-control @error('gender') is-invalid @enderror" readonly>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="num_of_child">Anak ke-</label>
                                        <input type="number" name="num_of_child" placeholder="Tulis anak ke-" required class="form-control @error('num_of_child') is-invalid @enderror" @if(isset($data->children->num_of_child)) value="{{ old('num_of_child', $data->children->num_of_child) }}" @endif>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" name="nik" value="{{ $data->nik }}" class="form-control @error('nik') is-invalid @enderror" readonly>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="date_birth">Tanggal Lahir</label>
                                        <input type="date" name="date_birth" value="{{ $data->date_birth }}" readonly class="form-control @error('date_birth') is-invalid @enderror">
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="bpjs">Nomor BPJS (bila ada)</label>
                                        <input type="text" name="bpjs" value="@if ($data->health_assurance) {{ $data->health_assurance }} @else - @endif" readonly class="form-control @error('bpjs') is-invalid @enderror">
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="kms">Memiliki KMS</label>
                                        <div class="mt-2">
                                            <input type="radio" name="kms" value="1" @if(isset($data->children->kms) && $data->children->kms == 1) checked @endif> Ya
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="kms" value="0" @if(isset($data->children->kms) && $data->children->kms == 0) checked @endif> Tidak
                                        </div>
                                    </div>

                                    <hr>

                                    
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">@if(isset($data->children)) Ubah @else Simpan @endif</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endforeach
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
