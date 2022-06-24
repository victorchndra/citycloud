<html>

<head>
    <style>

    </style>
</head>

<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan=20 rowspan=2 style="vertical-align:center;text-align:center;"><strong> LAPORAN TIMBANG
                        ANAK</strong></th>
            </tr>
            <tr>
                <th colspan=27>&nbsp;</th>
            </tr>
            <tr>
                <th>#</th>
                <th>NIK</th>
                <th>Nama Anak</th>
                <th>Tinggi Badan </th>
                <th> Berat Badan</th>
                <th>Lingkar Kepala</th>
                <th>Memiliki  Buku KMS</th>
                <th>IMDB</th>
                <th>Cara Ukur</th>
                <th>Vitamin A</th>
                <th>Nama Imunisasi</th>
                <th>Tanggal Imunisasi</th>
                <th>Booster</th>
                <th>e1</th>
                <th>e2</th>
                <th>e3</th>
                <th>e4</th>
                <th>e5</th>
                <th>e6</th>
                <th>Catatan</th>                
            </tr>

        </thead>
        <tbody>
            @if (!empty($datas))
                @foreach ($datas as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>'{{ $data->nik }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->height }} cm</td>
                        <td>{{ $data->weight }} kg</td>
                        <td>{!! $data->head_width !!} cm</td>
                        <td>{{ $data->kms }}</td>
                        <td>{{ $data->imdb }}</td>
                        <td>{{ $data->method_measure }}</td>
                        <td>{{ $data->vitamin }}</td>
                        <td>{{ $data->imunitation }}</td>
                        <td>{{ $data->imunitation_date }}</td>
                        <td>{{ $data->booster }}</td>
                        <td>{{ $data->e1 }}</td>
                        <td>{{ $data->e2 }}</td>
                        <td>{{ $data->e3 }}</td>
                        <td>{{ $data->e4 }}</td>
                        <td>{{ $data->e5 }}</td>
                        <td>{{ $data->e6 }}</td>
                        <td>{{ $data->notes }}</td>
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
