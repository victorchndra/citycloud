<html>

<head>
    <style>

    </style>
</head>

<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan=32 rowspan=2 style="vertical-align:center;text-align:center;"><strong> LAPORAN TIMBANG
                        ANAK BULAN</strong></th>
            </tr>
            <tr>
                <th colspan=27>&nbsp;</th>
            </tr>
            <tr>
                <th>#</th>
                <th>Anak Ke</th>
                <th>Nama Anak</th>
                <th>Umur</th>
                <th>Jenis Kelamin</th>
                <th>No. Kartu Keluarga</th>
                <th>NIK (Nomor Induk Kependudukan)</th>
                <th>Tanggal Lahir</th>
                <th>Berat Lahir (KG)</th>
                <th>Panjang Badan Lahir (CM)</th>
                <th>Kepemilikan Buku KIA/KMS</th>
                <th>IMDB</th>
                <th>Nama Orang Tua</th>
                <th>NIK Orang Tua</th>
                <th>No. Telp/Hp Orang Tua</th>
                <th>Alamat</th>
                <th>RT</th>
                <th>RW</th>
                <th>Tanggal Pengukuran</th>
                <th>PANJANG BADAN / TINGGI BADAN (cm) / LINGKAR KEPALA</th>
                <th>Cara Ukur</th>
                <th>Vitamin</th>
                <th>Jenis Imunisasi</th>
                <th>Tanggal Imunisasi</th>
                <th>E 1</th>
                <th>E 2</th>
                <th>E 3</th>
                <th>E 4</th>
                <th>E 5</th>
                <th>E 6</th>
                <th>Status Timbang</th>
                <th>Keterangan</th>           
            </tr>

        </thead>
        <tbody>
            @if (!empty($datas))
                @foreach ($datas as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>'{{ $data->num_of_child }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->date_birth)->age }}</td>
                        <td>'{{ $data->gender }}</td>
                        <td>'{{ $data->kk }}</td>
                        <td>'{{ $data->nik }}</td>
                        <td>'{{ $data->date_birth }}</td>
                        <td>{{ $data->weight }} kg</td>
                        <td>{{ $data->height }} cm</td>
                        <td>{{ $data->kms }}</td>
                        <td>{{ $data->imdb }}</td>
                        <td>{{ $data->father_name }} | {{ $data->mother_name }}</td>
                        <td>nik {{ $data->father_name }} | {{ $data->mother_name }}</td>
                        <td>telp {{ $data->father_name }} | {{ $data->mother_name }}</td>
                        <td>{{ $data->address }}</td>
                        <td>{{ $data->rt }}</td>
                        <td>{{ $data->rw }}</td>
                        <td>{{ $data->imunitation_date }}</td>
                        <td>{{ $data->height }} cm / {{ $data->weight }} kg / {{ $data->head_width }} cm</td>
                        <td>{{ $data->method_measure }}</td>
                        <td>{{ $data->vitamin }}</td>
                        <td>{{ $data->imunitation }}</td>
                        <td>{{ $data->imunitation_date }}</td>
                        {{-- <td>{{ $data->booster }}</td> --}}
                        <td>{{ $data->e1 }}</td>
                        <td>{{ $data->e2 }}</td>
                        <td>{{ $data->e3 }}</td>
                        <td>{{ $data->e4 }}</td>
                        <td>{{ $data->e5 }}</td>
                        <td>{{ $data->e6 }}</td>
                        <td>status {{ $data->notes }}</td>
                        <td>keterangan {{ $data->notes }}</td>
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
