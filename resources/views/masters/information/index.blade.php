@extends("layouts.app")
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Informasi</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Master Data</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Informasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="row" id="basic-table">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Informasi</h4>
                        <a href="/information" class="btn btn-sm btn-secondary btnReload"><i class="bi bi-arrow-counterclockwise"></i></a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                      
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                            <table class="table table-lg table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Index</th>               
                                <th>Desa</th>  
                                <th>Kecamatan</th>
                                <th>Kabupaten</th>
                                <th>Provinsi</th>
                                <th>Header</th>
                                <th>Signature</th>
                                <th>Logo</th>
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
                                <td> @if ($data->header)
                                    <div style="max-height: 350px; overflow: hidden;">
                                        <img src="{{ asset('/storage/'. $data->header)}}"
                                            class="img-fluid">
                                    </div>
                                    @endif
                                </td>
                                <td> @if ($data->signature)
                                    <div style="max-height: 350px; overflow: hidden;">
                                        <img src="{{ asset('/storage/'. $data->signature)}}"
                                            class="img-fluid">
                                    </div>
                                    @endif
                                </td>

                                <td> @if ($data->logo)
                                    <div style="max-height: 350px; overflow: hidden;">
                                        <img src="{{ asset('/storage/'. $data->logo)}}"
                                            class="img-fluid">
                                    </div>
                                    @endif
                                </td>


                                <td>{{ $data->code}} </td> 

                                                                   
                                <td>{{ $data->created_at, 'H:i:s'}}</td>
                                <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group d-flex">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                            <a href="/information/{{ $data->uuid }}/edit" class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i>Edit</a>
                                        </div>
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
        </div>
    </section>
    <!-- Basic Tables end -->
</div>
@endsection