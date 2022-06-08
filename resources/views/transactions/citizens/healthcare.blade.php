@extends("layouts.app")
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Posyandu</h4>
                <p class="card-description">
                    Posyandu Kelurahan Lembah Sari
                </p>

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
                                <td></td>
                                <td></td>
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
