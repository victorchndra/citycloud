@extends("layouts.app")
@section('content')

<link rel="stylesheet" href="{{asset('/vendors/simple-datatables/style.css')}}">
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>DataTable</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="/letters" class="btn btn-sm btn-secondary btnReload"><i
                        class="bi bi-arrow-counterclockwise"></i></a>

                <a href="/list" class="btn btn-sm btn-primary btn-fw">
                    <i class="bi bi-plus text-white"></i> Tambah Surat</a>

            </div>
            
            <div class="card-body">
                
                          <!-- success message -->
                          @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <!-- success message end -->


                        

                <table class="table table-striped" id="letters" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Jenis Surat</th>
                            <th>Ditambahkan pada</th>
                          
                            @if ( Auth::user()->roles == 'god' || Auth::user()->roles == 'admin')  <th style="align:center">Aksi</th>@endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($businessletters as $key => $businessletter)


                        <tr>
                            <td> {{ $key + 1 }}</td>
                            <td>{{ $businessletter->name }} <b>(@if($businessletter->gender == 'PEREMPUAN'){{'P'}}@else{{'L'}}@endif)</b></td>
                            <td>{{ $businessletter->letter_name}}</td>
                            <td>
                                                Ditambahkan Oleh: <b> {{$businessletter->createdUser->name}}
                                                </b><br>{{$businessletter->created_at, 'd M Y'}}

                                                @if($businessletter->updated_by)
                                                <br>
                                                Diubah Oleh: <b> {{$businessletter->updatedUser->name}}
                                                </b><br>{{$businessletter->updated_at, 'd M Y'}}
                                                @endif
                            </td>
                            
                                @if ( Auth::user()->roles == 'god' || Auth::user()->roles == 'admin')
                            <td>
                                
                                            <button type="button" class="btn btn-sm btn-primary  dropdown-toggle"
                                                data-bs-toggle="dropdown" >Aksi</button>
                                            <div class="dropdown-menu">

                                            <a href="/letters-business/{{ $businessletter->uuid }}"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Cetak</a>
                                                    <div class="dropdown-divider"></div>
                              

                                            <a href="/letters-business/{{ $businessletter->uuid }}/edit"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Edit</a>
                                                    <div class="dropdown-divider"></div>

                                                <form action="/letters-business/{{ $businessletter->uuid }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="dropdown-item" type="submit"
                                                        onclick="return confirm('Hapus data?')"><i class="mdi mdi-delete-forever"></i>Hapus</button>
                                                </form>


                                                <form class="d-none invisible"
                                                    action="/letters-business/destroy/{{$businessletter->uuid}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="dropdown-item" type="submit"
                                                        onclick="return confirm('Hapus data?')">Hapus</button>
                                                </form>
                                            </div>
                              
                                </td>
                                @endif 
                                @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

<script src="{{asset('/vendors/simple-datatables/simple-datatables.js')}}"></script>
<script>
    // Simple Datatable
    let letters = document.querySelector('#letters');
    let dataTable = new simpleDatatables.DataTable(letters);
</script>
@endsection
