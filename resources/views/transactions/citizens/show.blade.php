@extends("layouts.app")
<script>
 $(function(){
        $("#to").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#from").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
            minValue.setDate(minValue.getDate()+1);
            $("#to").datepicker( "option", "minDate", minValue );
        })
    });
</script>
@section('content')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Kependudukan</h4>
            @foreach ($citizen as $c)
            <form class="form-sample" action="/citizens/{{ $c->uuid }}" method="POST">
                @method('put')
                @csrf
                <p class="card-description my-3 text-muted">
                    Identitas Kartu Keluarga
                </p>
                <hr class="text-muted">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="number" name="nik" readonly class="form-control-plaintext" placeholder="Nomor Induk Kependudukan" autofocus value="{{ old('nik', $c->nik) }}"/>
                                @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">KK</label>
                            <div class="col-sm-9">
                                <input type="number" name="kk" readonly class="form-control-plaintext"placeholder="Kartu Keluarga" value="{{ old('kk', $c->kk) }}"/>
                               
                                @error('kk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" readonly class="form-control-plaintext"  placeholder="Nama Lengkap" required value="{{ old('name',$c->name ) }}"/>            
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                            <input type="date" readonly class="form-control-plaintext" name="date_birth" id="date" required value="{{ date('Y-m-d', strtotime($c->date_birth))}}">
                        </div>
                        </div>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select disabled class="form-control-plaintext" name="gender">
                                    @if (old('gender', 'l') == $c->gender)
                                        <option value="l" selected>Laki-laki</option>
                                        <option value="p">Perempuan</option>
                                    @elseif (old('gender', 'p') == $c->gender)
                                        <option value="l">Laki-laki</option>
                                        <option value="p" selected>Perempuan</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status Keluarga</label>
                            <div class="col-sm-9">
                                <select disabled class="form-control-plaintext" name="gender">
                                @if (old('family_status', 'Kepala Keluarga') == $c->family_status)
                                    <option value="kepala keluarga" selected>Kepala keluarga</option>
                                    <option value="istri">Istri</option>
                                    <option value="anak">Anak</option>
                                    <option value="famili lain">Famili Lain</option>
                                    @elseif (old('family_status', 'Istri') == $c->family_status)
                                    <option value="kepala keluarga" >Kepala keluarga</option>
                                    <option value="istri" selected>Istri</option>
                                    <option value="anak">Anak</option>
                                    <option value="famili lain">Famili Lain</option>
                                    @elseif (old('family_status', 'Anak') == $c->family_status)
                                    <option value="kepala keluarga" >Kepala keluarga</option>
                                    <option value="istri" >Istri</option>
                                    <option value="anak" selected>Anak</option>
                                    <option value="famili lain">Famili Lain</option>
                                    @else
                                    <option value="kepala keluarga" >Kepala keluarga</option>
                                    <option value="istri" >Istri</option>
                                    <option value="anak">Anak</option>
                                    <option value="famili lain">Famili Lain</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" readonly name="place_birth" class="form-control-plaintext" placeholder="Tempat Lahir" required value="{{ old('place_birth', $c->place_birth) }}"/>
                                @error('place_birth')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <h4 class="card-title">Anggota Keluarga {{$c->name}} </h4>
                <p class="card-description my-3 text-muted">
                    Identitas Kartu Keluarga {{$c->name}}
                </p>
                <hr class="text-muted">

            <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIK/KK</th>
                                <th colspan="2">
                                    <center>Informasi</center>
                                </th>
                                <th>Nama Ayah</th>
                                <th>Nama Ibu</th>
                                <th>Ditambahkan</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($families as $key => $data)

                            <tr>
                                <td>{{ $loop->iteration }} </td>
                                <td>{{ $data->name }} <b>({{ strtoupper($data->gender) }})</b><br>

                                    @if($data->vaccine_1 == 'Sudah Vaksin')
                                    <span class="badge badge-pill badge-primary"><i class="mdi mdi-check-circle"></i>
                                        Vaksin 1</span>
                                    @endif

                                    @if($data->vaccine_2 == 'Sudah Vaksin')
                                    <span class="badge badge-pill badge-primary"><i class="mdi mdi-check-circle"></i>
                                        Vaksin 2</span>
                                    @endif

                                    @if($data->vaccine_3 == 'Sudah Vaksin')
                                    <span class="badge badge-pill badge-primary"><i class="mdi mdi-check-circle"></i>
                                        Vaksin 3</span>
                                    @endif


                                <td>
                                    <b>NIK:</b> {{ $data->nik }}<br>
                                    <b>KK :</b> {{ $data->kk }}


                                </td>
                                <td>

                                    <span class="d-block mb-1"><b>TTL : </b> <span>{{ $data->place_birth ?? '-' }},
                                            {!! $data->date_birth !!}</span></span>
                                    <span class="d-block mb-1"><b>Telp : </b>
                                        <span>{{ $data->phone ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Alamat : </b> <span>{{ $data->address ?? '-' }} <b>RT :
                                            </b>{{ $data->rt ?? '-' }}<b> RW : </b>
                                            {{ $data->rw ?? '-' }}</span></span>

                                    <span class="d-block mb-1"><b>Pekerjaan : </b>
                                        <span>{{ $data->job ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Agama : </b>
                                        <span>{{ $data->religion ?? '-' }}</span></span>
                                        <span class="d-block mb-1"><b>Disabilitas : </b>
                                        <span>{{ $data->disability ?? '-' }}</span></span>


                                </td>
                                <td>


                                    <span class="d-block mb-1"><b>Gol.Darah : </b>
                                        <span>{{ $data->blood ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Status Pernikahan :
                                        </b>{{ $data->marriage ?? '-' }}</span>
                                    <span class="d-block mb-1"><b>Status Keluarga : </b>
                                        <span>{{ $data->family_status ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Pendidikan Terakhir : </b>
                                        <span>{{ $data->last_education ?? '-' }}</span></span>
                                    <span class="d-block mb-1"><b>Asuransi Kesehatan : </b>
                                        <span>{{ $data->health_assurance ?? '-' }}</span></span>
                                        <span class="d-block mb-1"><b>DTKS : </b>
                                        <span>{{ $data->dtks ?? '-' }}</span></span>
                                </td>
                                <td>{{ $data->father_name ?? '-' }}</td>
                                <td>{{ $data->mother_name ?? '-' }}</td>
                                <td>   <span>Ditambahkan Oleh: <b> {{$data->createdUser->name}} </b></span><br>
                                        <span>{{$data->created_at, 'd M Y'}}</span><br>
                                        @if($data->updated_by)
                                        <br>
                                        <span>Diubah Oleh: <b> {{$data->updatedUser->name}} </b></span> <br>
                                        <span>{{$data->updated_at, 'd M Y'}}<br>
                                        @endif
                            
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @endforeach
        </div>
    </div>
</div>
@endsection
