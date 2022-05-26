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
        <br>
        <table align="center" width="600" style="line-height: 1.5;">
            <tr>
                <td>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Kepala Desa
                    {{ $informations->village_name }} Kecamatan {{ $informations->sub_district_name }} Kota
                    {{ $informations->district_name }}, dengan ini menerangkan bahwa :
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


        <table align="center" width="600" style="line-height: 1.5; margin-top: 10px;">
            <tr>
                <td class="justify" style="text-align: justify">
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Bahwa data yang dimaksud diatas adalah
                    benar Berdomisili di <b>
                        Desa {{ $informations->village_name }}, RT. {{ $data->rt }}, RW. {{ $data->rw }}, Kecamatan {{ $informations->sub_district_name }},
                        Kota
                        {{ $informations->district_name }}, Provinsi {{ $informations->province_name }}</b>.                    
                </td>
            </tr>
        </table> 
              
        <table align="center" width="600" style="line-height: 1.5;">
            <tr>
                <td class="justify">
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                    Demikianlah {{ $data->letter_name }} ini kami berikan untuk dapat dipergunakan seperlunya.
                </td>
            </tr>
        </table>


        <div style="margin-bttom:10px; overflow:auto;">
            <table align="right" width="320" border="1px">
                <tr>
                    <td width="">Dikeluarkan di </td>
                    <td width="10 px">: </td>
                    <td width="" ;> {{ $informations->village_name }} </td>
                    <td></td>

                </tr>
                <tr>
                    <td style=" border-bottom: 1px solid #000; ">Pada Tanggal</td>
                    <td style=" border-bottom: 1px solid #000;">: </td>
                    <td style=" border-bottom: 1px solid #000;">{{ \Carbon\Carbon::parse($data->letter_date)->translatedFormat('d M Y') }}</td>
                    <td></td>
                </tr>
            </table>
        </div>


        @if ($data->user->position == 'Kepala Desa')
            <table align="right" width="400" border="1px">


                @if ($data->signature == 'wet')
                    <tr class="spaceUnder">
                        <td width=""> </td>
                        <td>
                            <center> {{ strtoupper($data->user->position) }}
                                {{ strtoupper($informations->village_name) }} </center>
                        </td>
                @endif
                @if ($data->signature == 'digital')
                    <tr>
                        <td> </td>
                        <td>
                            <center> {{ strtoupper($data->user->position) }}
                                {{ strtoupper($informations->village_name) }} </center>
                        </td>
                    <tr>

                        <td> </td>
                        <td>
                            <center> <img src="{{ asset('/storage/' . $informations->signature) }}"
                                    class="img-fluid" width="100"></center>

                    </tr>
                @endif
                <tr>
                    <td width=""> </td>
                    <td>
                        <center><u><b> {{ $data->user->front_title }} {{ strtoupper($data->user->name) }}
                                    {{ $data->user->back_title }} </b></u></center>
                    </td>
                </tr>
            </table>
        @else
            <table align="right" width="400" border="1px">
                <tr class="spaceUnder">
                    <td width=""> </td>
                    <td>
                        <center>An. KEPALA DESA {{ strtoupper($informations->village_name) }}<BR>
                            {{ strtoupper($data->user->position) }} {{ strtoupper($informations->village_name) }}
                        </center>

                    </td>
                <tr>
                    <td width=""> </td>
                    <td>
                        <center><u><b> {{ $data->user->front_title }} {{ strtoupper($data->user->name) }}
                                    {{ $data->user->back_title }} </b></u></center>
                    </td>
                </tr>

            </table>
        @endif


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
