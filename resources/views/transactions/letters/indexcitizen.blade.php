@extends("layouts.app")
@section('content')

<link rel="stylesheet" href="{{asset('/vendors/simple-datatables/style.css')}}">
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">


                <h3>Indexcitizenniwoi</h3>
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
                @if ( Auth::user()->roles == 'citizens' || Auth::user()->roles == 'headrt')
                <a href="/list" class="btn btn-sm btn-primary btn-fw">
                    <i class="bi bi-plus text-white"></i> Tambah Surat</a>
                    @endif
            </div>

            <div class="card-body">

                          <!-- success message -->
                          @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        {{-- Death Button --}}
                @foreach ($businessletters as $businessletter)
                <div class="modal" id="deathModal">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                        <form action="/letters-business/{{ $businessletter->uuid }}" method="POST">
                                @method('PUT')
                                @csrf
                                <input id="uuidValidate" type="hidden" name="uuidValidate">
                                <div class="modal-header">
                                    <label>Alasan Surat Ditolak</label>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" name="rejected_notes_admin" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">OK</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

                {{-- Death Button --}}
                @foreach ($businessletters as $businessletter)
                <div class="modal" id="rejectrt">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                        <form action="/letters-business/{{ $businessletter->uuid }}" method="POST">
                                @method('PUT')
                                @csrf
                                <input id="uuidValidate" type="hidden" name="uuidValidate">
                                <div class="modal-header">
                                    <label>Alasan Surat Ditolak</label>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" name="rejected_notes_rt" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">OK</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                        <!-- success message end -->


                <table class="table table-striped" id="letters" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Jenis Surat</th>
                            <th>Ditambahkan pada</th>

                            <th>Status RT</th>
                            <th>Status Admin</th>
                            <th>Keterangan</th>
                            @if ( Auth::user()->roles == 'god' || Auth::user()->roles == 'admin' || Auth::user()->roles == 'headrt')  <th style="align:center">Aksi</th>@endif
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

                                <td>
                                        @if($businessletter->approval_rt == 'approved')
                                        <span class="badge bg-success">Setuju</span>
                                        </span>
                                        @endif

                                        @if($businessletter->approval_rt == 'waiting')
                                        <span class="badge bg-warning"></i> Menunggu</span>
                                        </span>
                                        @endif

                                        @if($businessletter->approval_rt == 'rejected')
                                        <span class="badge bg-danger"> </i> Ditolak</span>
                                        </span>
                                        @endif
                                </td>

                                <td>
                                    @if($businessletter->approval_admin == 'approved')
                                        <span class="badge bg-success">Setuju</span>
                                        </span>
                                        @endif

                                        @if($businessletter->approval_admin == 'waiting')
                                        <span class="badge bg-warning"></i> Menunggu</span>
                                        </span>
                                        @endif

                                        @if($businessletter->approval_admin == 'rejected')
                                        <span class="badge bg-danger"> </i> Ditolak</span>
                                        </span>
                                        @endif
                                </td>


                                <td>
                                        @if($businessletter->approval_admin == 'rejected')
                                        <span class="badge bg-danger"> </i>Admin: {{ $businessletter->rejected_notes_admin }}</span>
                                        </span>
                                        @endif
                                            <br>
                                        @if($businessletter->approval_rt == 'rejected')
                                        <span class="badge bg-danger"> </i>RT: {{ $businessletter->rejected_notes_rt }}</span>
                                        </span>
                                        @endif





                                </td>


                                @if ( Auth::user()->roles == 'god' || Auth::user()->roles == 'admin')
                            <td>
                                            <button type="button" class="btn btn-sm btn-primary  dropdown-toggle"
                                                data-bs-toggle="dropdown" >Aksi</button>
                                            <div class="dropdown-menu">


                                            <a href="{{ route('approve.businessletters', [ $businessletter->uuid ]) }}"
                                                    class="dropdown-item"  type="submit" onclick="return confirm('Setujui Surat?')"><i class="mdi mdi-tooltip-edit"></i> Setujui</a>
                                                    <div class="dropdown-divider"></div>

                                                    {{-- Death Button --}}
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deathModal" data-id="{{ $businessletter->uuid }}" onclick="$('#uuidValidate').val($(this).data('id')); $('#deathModal').modal('show');"><i class="mdi mdi-account-minus"></i> Tolak</button>

                                                {{-- data-bs-target="#deathModal" --}}

                                                    <div class="dropdown-divider"></div>



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

                                @if (Auth::user()->roles == 'headrt')
                            <td>
                                            <button type="button" class="btn btn-sm btn-primary  dropdown-toggle"
                                                data-bs-toggle="dropdown" >Aksi</button>
                                            <div class="dropdown-menu">

{{-- test sdfsdfsdfsfsdfsdfsdfsd--}}
                                            <a href="{{ route('approve.businessletters', [ $businessletter->uuid ]) }}"
                                                    class="dropdown-item"  type="submit" onclick="return confirm('Setujui Surat?')"><i class="mdi mdi-tooltip-edit"></i> Setujui</a>
                                                    <div class="dropdown-divider"></div>

                                                    {{-- Death Button --}}
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#rejectrt" data-id="{{ $businessletter->uuid }}" onclick="$('#uuidValidate').val($(this).data('id')); $('#rejectrt').modal('show');"><i class="mdi mdi-account-minus"></i> Tolak</button>
                                                    {{-- data-bs-target="#deathModal" --}}


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
