@extends("layouts.app")
@section('content')

@if(session()->has('success'))
<div class="alert alert-success col-lg-10" role="alert">
  {{ session('success')}}
</div>
@endif

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informasi</h4>
                <p class="card-description">
                    Data Informasi
                </p>
                <a href="/ti" class="btn btn-sm btn-secondary btnReload"><i class="mdi mdi-refresh"></i></a>
                
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Surat</th>               
                                <th>Nama Desa</th>  
                                <th>Sub Nama District</th>
                                <th>Nama District</th>
                                <th>Nama Provinsi</th>
                                <th>Header</th>
                                <th>Code</th>     
                                <th>Dibuat</th>                                           
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $key => $data)
                            <tr>
                                <td>{{ $loop->iteration }} </td>
                                <td>{{ $data->letter_index}} </td>                                                      
                                <td>{{ $data->village_name}} </td>                                                      
                                <td>{{ $data->sub_district_name}} </td>                                                      
                                <td>{{ $data->district_name }} </td>                                                      
                                <td>{{ $data->province_name}} </td>                                                      
                                <td>{{ $data->header}} </td>                                                      
                                <td>{{ $data->code}} </td>                                                      
                                <td>{{ $data->created_at, 'H:i:s'}}</td>
                                <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group d-flex">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                            <a href="/ti/{{ $data->uuid }}/edit" class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i>Edit</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $datas->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

