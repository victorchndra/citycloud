<html>

<head>
    <style>

    </style>
</head>

<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan=6 rowspan=2 style="vertical-align:center;text-align:center;"><strong> LAPORAN IBU KB</strong></th>
            </tr>
            <tr>
                <th colspan=27>&nbsp;</th>
            </tr>
            <tr>
                <th>#</th>
                <th>NIK</th>
                <th>Nama Ibu</th>
                <th>Nama Alamat</th>
                <th>Nama KB</th>
                <th>Tangal KB</th>
            </tr>

        </thead>
        <tbody>
            @if (!empty($datas))
                @foreach ($datas as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>'{{ $data->citizenUser->nik }}</td>
                        <td>'{{ $data->citizenUser->name }}</td>
                        <td>'{{ $data->citizenUser->address }}</td>
                        <td>{{ $data->kb_name }}</td>
                        <td>{{ $data->kb_date }}</td>
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
