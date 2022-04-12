<html>

<head>
    <style>
    
    </style>
</head>

<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan=27 rowspan=2 style="vertical-align:center;text-align:center;"><strong> LAPORAN KEPENDUDUKAN</strong></th>
            </tr>
            <tr>
                <th colspan=27>&nbsp;</th>
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
                <th>Pekerjaan</th>
                <th>No. Telp</th>
                <th>Agama</th>
                <th>Gol. Darah</th>
                <th>Status Keluarga</th>
                <th>Status Pernikahan</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>Pendidikan Terakhir</th>
                <th>Asuransi Kesehatan</th>
                <th>DTKS</th>
                <th>Disabilitas</th>
                <th>Vaksin 1</th>
                <th>Vaksin 2</th>
                <th>Vaksin 3</th>
                <th>Pindah Ke</th>
                <th>Tgl Pindah</th>
                <th>Tgl Meninggal</th>
                <th>RT</th>
                <th>RW</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Kota</th>
                <th>Provinsi</th>
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
                <td>{{ $data->date_birth }}</td>
                <td>{{ $data->address }}</td>
                <td>{{ $data->job }}</td>
                <td>{{ $data->phone }}</td>
                <td>{{ $data->religion }}</td>
                <td>{{ $data->blood }}</td>
                <td>{{ $data->family_status }}</td>
                <td>{{ $data->marriage }}</td>
                <td>{{ $data->father_name }}</td>
                <td>{{ $data->mother_name }}</td>
                <td>{{ $data->last_education }}</td>
                <td>{{ $data->health_assurance }}</td>
                <td>{{ $data->dtks }}</td>
                <td>{{ $data->disability }}</td>
                <td>{{ $data->vaccine_1 }}</td>
                <td>{{ $data->vaccine_2 }}</td>
                <td>{{ $data->vaccine_3 }}</td>
                <td>{{ $data->move_to }}</td>
                <td>{{ $data->move_date }}</td>
                <td>{{ $data->death_date }}</td>
                <td>{{ $data->rt }}</td>
                <td>{{ $data->rw }}</td>
                <td>{{ $data->village }}</td>
                <td>{{ $data->sub_districts }}</td>
                <td>{{ $data->districts }}</td>
                <td>{{ $data->province }}</td>
                @endforeach
                @else
            <tr>
                <td colspan="25">Data Kosong</td>
            </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
