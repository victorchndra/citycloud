@extends("layouts.app")
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                @foreach ($datas as $data)
                <div class="modal" id="showModal">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Anak</h5>
                            </div>
                            <div class="modal-body">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                          <th scope="row" style="width: 20%;">Nama Ibu</th>
                                          <td style="width: 3%">:</td>
                                          <td style="width: 77%" id="motherName"></td>
                                        </tr>
                                        <tr>
                                          <th scope="row" style="width: 20%;">Nama Ayah</th>
                                          <td style="width: 3%">:</td>
                                          <td style="width: 77%" id="fatherName"></td>
                                        </tr>
                                        <tr>
                                          <th scope="row" style="width: 20%;">Alamat</th>
                                          <td style="width: 3%">:</td>
                                          <td style="width: 77%" id="address"></td>
                                        </tr>
                                        <tr>
                                          <th scope="row" style="width: 20%;">Berat Badan</th>
                                          <td style="width: 3%">:</td>
                                          <td style="width: 77%" id="weight"></td>
                                        </tr>
                                        <tr>
                                          <th scope="row" style="width: 20%;">Tinggi Badan</th>
                                          <td style="width: 3%">:</td>
                                          <td style="width: 77%" id="height"></td>
                                        </tr>
                                        <tr>
                                          <th scope="row" style="width: 20%;">Anak Ke</th>
                                          <td style="width: 3%">:</td>
                                          <td style="width: 77%" id="numOfChild"></td>
                                        </tr>
                                        <tr>
                                          <th scope="row" style="width: 20%;">NIK</th>
                                          <td style="width: 3%">:</td>
                                          <td style="width: 77%" id="nik"></td>
                                        </tr>
                                        <tr>
                                          <th scope="row" style="width: 20%;">No. BPJS</th>
                                          <td style="width: 3%">:</td>
                                          <td style="width: 77%" id="bpjs"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <h4 class="card-title">Posyandu</h4>
                <p class="card-description">
                    Posyandu Kelurahan Lembah Sari
                </p>

                @if (session()->has('success'))

                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Anak</th>
                                <th>Orang Tua</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>KMS</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $key => $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $data->name }}</strong></td>
                                <td>{{ $data->father_name }} & {{ $data->mother_name }}</td>
                                <td>{{ ucwords($data->gender) }}</td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->date_birth)->isoFormat('DD MMMM YYYY') }}</td>
                                <td>@if (isset($data->children->kms) && $data->children->kms == 1) Ya @elseif ((isset($data->children->kms) && $data->children->kms == 0)) Tidak @else - @endif</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary  dropdown-toggle"
                                                data-bs-toggle="dropdown" >Aksi</button>
                                    <div class="dropdown-menu">
                                        {{-- Info Button --}}
                                        <button class="dropdown-item" data-bs-toggle="modal" data-mname="{{ $data->mother_name != null ? strtoupper($data->mother_name) : '-' }}" data-fname="{{ $data->father_name != null ? strtoupper($data->father_name) : '-' }}" data-address="{{ $data->address != null ? strtoupper($data->address) : '-' }}" data-weight="{{ isset($data->children->weight) ? $data->children->weight : '-' }}" data-height="{{ isset($data->children->height) ? $data->children->height : '-' }}" data-numofchild="{{ isset($data->children->num_of_child) ? $data->children->num_of_child : '-' }}" data-nik="{{ $data->nik =! null ? $data->nik : '-' }}" data-bpjs="{{ isset($data->children->bpjs) ? $data->children->bpjs : '-' }}" onclick="
                                            $('#motherName').text($(this).data('mname'));
                                            $('#fatherName').text($(this).data('fname'));
                                            $('#address').text($(this).data('address'));
                                            $('#weight').text($(this).data('weight'));
                                            $('#height').text($(this).data('height'));
                                            $('#numOfChild').text($(this).data('numofchild'));
                                            $('#nik').text($(this).data('nik'));
                                            $('#bpjs').text($(this).data('bpjs'));
                                            $('#showModal').modal('show');
                                        "><i class="mdi mdi-folder-move"></i> Info</button>
                                        {{-- End Info Button --}}
                                        <div class="dropdown-divider"></div>
                                        <a href="/health-care/{{ $data->uuid }}/edit" class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Edit</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $datas->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
