<html>

<head>
    <style>

    </style>
</head>

<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan=20 rowspan=2 style="vertical-align:center;text-align:center;"><strong> LAPORAN DATA IBU HAMIL</strong></th>
            </tr>
            <tr>
                <th colspan=27>&nbsp;</th>
            </tr>
            <tr>
                <th>#</th>
                {{-- <th>Citizen id</th> --}}
                <th>Nama Ibu</th>
                <th>Berat Badan</th>
                <th>Tinggi Badan</th>
                <th>Hamil Ke</th>
                <th>Usia Kehamilan</th>
                <th>Penyakit Penyerta</th>
                <th>Lila (Lingkar Lengan Atas)</th>
                <th>Periksa Kehamilan</th>
                <th>Jumlah Hidup</th>
                <th>Jumlah Meninggal</th>
                <th>Tanggal Meninggal</th>
                <th>tt1</th>
                <th>tt2</th>
                <th>tt3</th>
                <th>tt4</th>
                <th>tt5</th>
            </tr>

        </thead>
        <tbody>
            @if (!empty($datas))
                @foreach ($datas as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        {{-- <td>{{ $data->citizen_id }}</td> --}}
                        <td>{{ $data->motherUser->name }}</td>
                        <td>{{ $data->weight }}</td>
                        <td>{{ $data->height }}</td>
                        <td>{{ $data->pregnant_to }}</td>
                        <td>{{ $data->gestational_age }}</td>
                        <td>{{ $data->disease }}</td>
                        <td>{{ $data->lila }}</td>
                        <td>{{ $data->check_pregnancy }}</td>
                        <td>{{ $data->number_lives }}</td>
                        <td>{{ $data->number_death }}</td>
                        <td>{{ $data->meninggal }}</td>
                        <td>{{ $data->tt1 }}</td>
                        <td>{{ $data->tt2 }}</td>
                        <td>{{ $data->tt3 }}</td>
                        <td>{{ $data->tt4 }}</td>
                        <td>{{ $data->tt5 }}</td>
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
