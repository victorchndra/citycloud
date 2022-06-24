<html>

<head>
    <style>

    </style>
</head>

<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan=15 rowspan=2 style="vertical-align:center;text-align:center;"><strong> LAPORAN DATA ANAK</strong></th>
            </tr>
            <tr>
                <th colspan=15>&nbsp;</th>
            </tr>
            <tr>
                <th>#</th>
                <th>NIK</th>
                <th>KK</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Agama</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>Berat Badan (KG)</th>
                <th>Tinggi Badan (CM)</th>
                <th>Anak ke</th>
                <th>KMS</th>
            </tr>

        </thead>
        <tbody>
            @if (!empty($datas))
            @foreach($datas as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>'{{ $data->nik }}</td>
                <td>'{{ $data->kk }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->gender }}</td>
                <td>{{ $data->place_birth }}</td>
                <td>{!! $data->date_birth !!}</td>
                <td>{{ $data->address }}</td>
                <td>{{ $data->religion }}</td>
                <td>{{ $data->father_name }}</td>
                <td>{{ $data->mother_name }}</td>
                <td>{{ isset($data->children->weight) ? $data->children->weight : '-' }}</td>
                <td>{{ isset($data->children->height) ? $data->children->height : '-' }}</td>
                <td>{{ isset($data->children->num_of_child) ? $data->children->num_of_child : '-' }}</td>
                <td>{{ isset($data->children->kms) ? 'Ya' : 'Tidak' }}</td>
                @endforeach
                @else
            <tr>
                <td colspan="15">Data Kosong</td>
            </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
