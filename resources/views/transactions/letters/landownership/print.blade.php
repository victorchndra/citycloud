<!DOCTYPE html>
<html class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $informations->village_name }}</title>
    <meta name="description" content="">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="">

    <style type="text/css">
        @page {
            size: Legal
        }


        * {
            background: none;
            border: none;
        }

        body {
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            line-height: 1.5;
            /* word-spacing:1.5pt; */
            letter-spacing: 0.2pt;
            font-family: Garamond, "Times New Roman", serif;
            color: #000;
            background: none;
            font-size: 12pt;
        }

        tr.spaceUnder>td {
            padding-bottom: 5em;
        }

        .pagebreak {
            page-break-after: always;
        }

    </style>

</head>

<body class="Legal">
    <section class="pagebreak">
        <center>
            <img src="{{ asset('/storage/' . $informations->header) }}" class="img-fluid" width="700">
        </center>

        <hr style="border: 2px solid black;">

        <div style="line-height: 1;">
            <table align="center" width="460" border="1px">
                <tr>
                    <td>
                        <center>
                            <font style="font-weight: bold; text-decoration: underline;">
                                {{ strtoupper($data->letter_name) }}</font>
                            <br>
                            Nomor : {{ $data->letter_index }}
                        </center>
                    </td>
                </tr>
            </table>
        </div>
        </div>

        <table align="center" width="600" style="line-height: 1.5;">
            <tr>
                <td>
                    Saya yang bertanda tangan di bawah ini :
                </td>
            </tr>
        </table>

        <div style="line-height: 1; margin-top: 10px;">
            <table align="center" width="540">
                <tr>
                    <td width="180"><span style="display:inline-block; width: 35 px;"></span>Nama </td>
                    <td width="2">: </td>
                    <td>
                        <font style="font-weight: bold; ">{{ $data->name }}</font>
                    </td>
                </tr>
                <tr>
                    <td width="180"><span style="display:inline-block; width: 35 px;"></span>Tempat/tanggal lahir</td>
                    <td width="2">: </td>
                    <td>{{ $data->place_birth }}, {{ $data->date_birth }}</td>
                </tr>
                <tr>
                    <td width="180"><span style="display:inline-block; width: 35 px;"></span>NIK</td>
                    <td width="2">: </td>
                    <td>{{ $data->nik }}</td>
                </tr>
                <tr>
                    <td width="180"><span style="display:inline-block; width: 35 px;"></span>Jenis Kelamin</td>
                    <td width="2">: </td>
                    <td>{{ $data->gender }}</td>
                </tr>

                <tr>
                    <td width="180"><span style="display:inline-block; width: 35 px;"></span>Agama</td>
                    <td width="2">: </td>
                    <td>{{ $data->religion }}</td>
                </tr>

                <tr>
                    <td width="180"><span style="display:inline-block; width: 35 px;"></span>Pekerjaan</td>
                    <td width="2">: </td>
                    <td>{{ $data->job }}</td>
                </tr>
                <tr>
                    <td width="180"><span style="display:inline-block; width: 35 px;"></span>Alamat</td>
                    <td width="2">: </td>
                    <td>{{ $data->address }}</td>
                </tr>
            </table>
        </div>


        <table align="center" width="600" style="line-height: 1; margin-top: 10px;">
            <tr>
                <td class="justify" style="text-align: justify">
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Dengan ini menyatakan dengan sebenar-benarnya
                    bahwa sebidang Tanah yang terletak di <b>
                        Jalan {{ $data->letter_street }}, RT. {{ $data->letter_rt }}, RW.
                        {{ $data->letter_rw }}, Desa/ Kelurahan {{ $data->letter_sub_districts }}, Kota
                        {{ $data->letter_districts }}, Provinsi {{ $data->letter_province }}</b>, Dengan
                    batas - batas tanah sebagai berikut : 
                </td>
            </tr>
        </table>
        <div style="line-height: 1; margin-top: 10px;">
            <table align="center" width="540">
                <tr>
                    <td width="250"><span style="display:inline-block; width: 30 px;"></span>-&nbsp;&nbsp;&nbsp;Sebelah
                        Utara berbatasan dengan</td>
                    <td width="2">:&nbsp;&nbsp;&nbsp; </td>
                    <td><strong>{{ $data->letter_north }}</strong></td>
                </tr>
                <tr>
                    <td width="250"><span style="display:inline-block; width: 30 px;"></span>-&nbsp;&nbsp;&nbsp;Sebelah
                        Timur berbatasan dengan</td>
                    <td width="2">:&nbsp;&nbsp;&nbsp; </td>
                    <td><strong>{{ $data->letter_east }}</strong></td>
                </tr>
                <tr>
                    <td width="250"><span style="display:inline-block; width: 30 px;"></span>-&nbsp;&nbsp;&nbsp;Sebelah
                        Selatan berbatasan dengan</td>
                    <td width="2">:&nbsp;&nbsp;&nbsp; </td>
                    <td><strong>{{ $data->letter_south }}</strong></td>
                </tr>
                <tr>
                    <td width="250"><span style="display:inline-block; width: 30 px;"></span>-&nbsp;&nbsp;&nbsp;Sebelah
                        Barat berbatasan dengan</td>
                    <td width="2">:&nbsp;&nbsp;&nbsp; </td>
                    <td><strong>{{ $data->letter_west }}</strong></td>
                </tr>
            </table>
        </div>

        <table align="center" width="600" style="line-height: 1; margin-top: 10px;">
            <tr>
                <td class="justify" style="text-align: justify">
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Dengan luas total
                    <b>{{ $data->letter_total_area }} M² </b> (<b>{{ $data->letter_total_area }} Meter
                        Persegi)</b> benar milik saya pribadi yang mana diperoleh dari pembagian waris orang tua atas
                    nama <b> {{ $data->letter_father_name }} </b> bin <b>{{ $data->letter_father_name_bin }}</b>
                    pada tahun <b>{{ $data->letter_year }}</b> tanpa surat-surat dengan penjelasan sebagai berikut :
                </td>
            </tr>
        </table>

        <div style="line-height: 1; margin-top: 10px;">
            <table align="center" width="550" style="text-align: justify">
                <tr>
                    <td width="350">1. Tanah tersebut merupakan tanah waris turun temurun.</td>
                </tr>
                <tr>

                    <td width="350">2. Tanah tersebut tidak dalam status tanah sengketa dengan dengan pihak manapun.
                    </td>
                </tr>
                <tr>

                    <td width="350">3. Bahwa tanah tersebut sejak awal belum memiliki Sertifikat dan belum pernah
                        &nbsp;&nbsp;&nbsp;&nbsp;dimohonkan hak kepada pihak pertanahan.</td>
                </tr>
                <tr>

                    <td width="350">4. Bahwa apabila dikemudian hari ternyata pernyataan ini terbukti tidak benar, maka
                        &nbsp;&nbsp;&nbsp;&nbsp;segala akibat hukum yang ditimbulkan sepenuhnya menjadi tanggung jawab
                        saya.</td>
                </tr>
            </table>
        </div>

        <br>
        <table align="center" width="600" style="line-height: 1;">
            <tr>
                <td class="justify" style="text-align: justify">
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Demikianlah <b>{{ $data->letter_name }}</b> ini
                        saya buat dan saya tanda tangani dalam keadaan sehat dan pikiran waras tanpa paksaan dan tekanan
                        dari pihak manapun untuk dipergunakan sebagaimana mestinya.
                </td>
            </tr>
        </table>

        <div overflow:auto;">
            <table align="center" width="500" border="1px" style="text-align: center">
                <tr style="font-weight: bolder">
                    <td width="10" style="padding-bottom: 1.5cm"">Yang Membuat Pernyataan </td>
                    <td width=" 10" style="padding-bottom: 1.5cm">Saksi 1</td>
                    <td width="10" style="padding-bottom: 1.5cm">Saksi 2</td>
                </tr>
                <tr style="font-weight: bolder">
                    <td width="10"><u>{{ $data->name }}</u></td>
                    <td width="10"><u>{{ $data->letter_evidence1 }}</u></td>
                    <td width="10"><u>{{ $data->letter_evidence2 }}</u></td>

                </tr>

            </table>
        </div>

        <table align="center" width="600" style="line-height: 1.5; font-size: 12px">
            <tr>
                <td class="justify" style="text-align: justify">
                    **Catatan : <br> Saksi Memberikan Tanda Tangan dan Cap Jempol
                </td>
            </tr>
        </table>


        <div style="margin-bttom:10px; overflow:auto;">
            <table align="right" width="320" border="1px" style="text-align: center">
                <tr>
                    <td width="">Dikeluarkan di </td>
                    <td width="10 px">: </td>
                    <td width=""> {{ $informations->village_name }} </td>
                    <td></td>

                </tr>
                <tr>
                    <td style=" border-bottom: 1px solid #000; ">Pada Tanggal</td>
                    <td style=" border-bottom: 1px solid #000;">: </td>
                    <td style=" border-bottom: 1px solid #000;">
                        {{ \Carbon\Carbon::parse($data->letter_date)->translatedFormat('d M Y') }}</td>
                    <td></td>
                </tr>
            </table>
        </div>


        @if ($data->user->position == 'Kepala Desa')
            <table align="right" width="400" border="1px" style="text-align: center">


                @if ($data->signature == 'wet')
                    <tr class="spaceUnder">
                        <td width=""></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            {{ strtoupper($data->user->position) }}
                            {{ strtoupper($informations->village_name) }}
                        </td>
                @endif
                @if ($data->signature == 'digital')
                    <tr>
                        <td> </td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            {{ strtoupper($data->user->position) }}
                            {{ strtoupper($informations->village_name) }}
                        </td>
                    <tr>

                        <td> </td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <img src="{{ asset('/storage/' . $informations->signature) }}" class="img-fluid"
                                width="100">

                    </tr>
                @endif
                <tr>
                    <td width=""> </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <u><b> {{ $data->user->front_title }} {{ strtoupper($data->user->name) }}
                                {{ $data->user->back_title }} </b></u>
                    </td>
                </tr>
            </table>
        @else
            <table align="right" width="400" border="1px" style="text-align: center">
                <tr class="spaceUnder">
                    <td width=""> </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        An. KEPALA DESA
                        {{ strtoupper($informations->village_name) }}<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ strtoupper($data->user->position) }} {{ strtoupper($informations->village_name) }}


                    </td>
                <tr>
                    <td width=""> </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <u><b> {{ $data->user->front_title }} {{ strtoupper($data->user->name) }}
                                {{ $data->user->back_title }} </b></u>
                    </td>
                </tr>

            </table>

        @endif
        <br>
        <div style="margin-top:-50px; margin-left:70px;" class="right">
            {!! QrCode::size(100)->generate('Dokumen sah Desa ' . $informations->village_name . ' Hari/Tanggal ' . $data->letter_date . ' Untuk Keperluan ' . $data->letter_name . '-' . $data->name) !!}
        </div>
        </div>
    </section>

</body>

</html>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<!-- prevent ctrl+s ctrl+u rightclick -->
<script>
    document.onkeypress = function(event) {
        event = (event || window.event);
        return keyFunction(event);
    }
    document.onmousedown = function(event) {
        event = (event || window.event);
        return keyFunction(event);
    }
    document.onkeydown = function(event) {
        event = (event || window.event);
        return keyFunction(event);
    }

    //Disable right click script 
    var message = "Sorry, right-click has been disabled";

    function clickIE() {
        if (document.all) {
            (message);
            return false;
        }
    }

    function clickNS(e) {
        if (document.layers || (document.getElementById && !document.all)) {
            if (e.which == 2 || e.which == 3) {
                (message);
                return false;
            }
        }
    }
    if (document.layers) {
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown = clickNS;
    } else {
        document.onmouseup = clickNS;
        document.oncontextmenu = clickIE;
    }
    document.oncontextmenu = new Function("return false")

    function keyFunction(event) {
        //"F12" key
        if (event.keyCode == 123) {
            return false;
        }

        if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
            return false;
        }
        //"J" key
        if (event.ctrlKey && event.shiftKey && event.keyCode == 74) {
            return false;
        }
        //"S" key
        if (event.keyCode == 83) {
            return false;
        }
        //"U" key
        if (event.ctrlKey && event.keyCode == 85) {
            return false;
        }
        //F5
        if (event.keyCode == 116) {
            return false;
        }
    }
</script>
<script>
    window.print();
    window.onfocus = function() {
        setTimeout(function() {
            window.close();
        }, 300);
    }
</script>
