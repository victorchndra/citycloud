@extends("layouts.app")
@section('content')
{{-- Isi konten --}}
<link rel="stylesheet" href="{{asset('/vendors/simple-datatables/style.css')}}">
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Aktivitas Pengguna</h4>
                <p class="card-description">
                    Riwayat aktivitas pengguna
                </p>
                <a href="/log" class="btn btn-sm btn-secondary btnReload"><i class="mdi mdi-refresh"></i></a>

                <div class="table-responsive pt-3">
                    <table class="table table-bordered"  id="tablelog">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Pengguna</th>
                                <th>Tanggal Aktivitas</th>
                            </tr>
                        </thead>
                        <h1></h1>
                        <tbody>
                            @foreach($datas as $key => $data)
                                <tr>
                                    <td>{{ $loop->iteration }} </td>
                                    <td>{!! $data->description !!}</td>
                                    <td>{{ $data->category }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>        
                                            <span>{{$data->created_at, 'd M Y'}}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/vendors/simple-datatables/simple-datatables.js')}}"></script>
<script>
    // Simple Datatable
    let tablelog = document.querySelector('#tablelog');
    let dataTable = new simpleDatatables.DataTable(tablelog);
    
</script>
@endsection
