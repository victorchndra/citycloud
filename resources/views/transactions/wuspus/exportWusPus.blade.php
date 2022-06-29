<html>

<head>
    <style>

    </style>
</head>

<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan=15 rowspan=2 style="vertical-align:center;text-align:center;"><strong> LAPORAN WUS/PUS</strong></th>
            </tr>
            <tr>
                <th colspan=27>&nbsp;</th>
            </tr>
            <tr>
                <th>#</th>
                <th>Nama WUS/PUS</th>
                <th>Umur</th>
                <th>Nama Suami</th>
                <th>Umur</th>
                <th>Yang Hidup</th>
                <th>Meninggal pada Umur</th>
                <th>Hasil Pengukuran Lingkar Kepala</th>
                <th>Pemberian Imun I</th>
                <th>Pemberian Imun II</th>
                <th>Pemberian Imun III</th>
                <th>Pemberian Imun IV</th>
                <th>Pemberian Imun V</th>
                <th>Jenis Kontrasepsi yang Dipakai</th>
                <th>Tanggal Bulan</th>
            </tr>

        </thead>
        <tbody>
            @if (!empty($datas))
                @foreach ($datas as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>'{{ $data->name }}</td>
                        <td>'{{ \Carbon\Carbon::parse($data->date_birth)->age }} tahun</td>
                        <td>-- nama suami --</td>
                        <td>--Umur Suami--</td>
                        <td>'{{ $data->number_lives }}</td>
                        <td>'{{ $data->number_death }}</td>
                        <td>'{{ $data->lila }}</td>
                        <td>'{{ $data->tt1 }}</td>
                        <td>'{{ $data->tt2 }}</td>
                        <td>'{{ $data->tt3 }}</td>
                        <td>'{{ $data->tt4 }}</td>
                        <td>'{{ $data->tt5 }}</td>
                        <td>'{{ $data->kb_name }}</td>
                        <td>'{{ $data->kb_date }}</td>
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
