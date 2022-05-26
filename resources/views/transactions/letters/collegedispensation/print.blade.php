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

            .pagebreak{
            page-break-after: always;
            }
        </style>

    </head>
    <body class="Legal">
    <section class="pagebreak">
        <div style="line-height: 1; margin-top:5rem;">
            <table align="center" width="460" border="1px">
                <tr>
                    <td>
                        <center>
                            <font style="font-weight: bold; text-decoration: underline;">{{strtoupper($data->letter_name)}}</font>
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
                Kepada <br>Yth. {{ $data->receiver }}<br>{{ $data->college }}<br>di<br>Tempat
            </td>
        </tr>
    </table>
    <br>
    <table align="center" width="600" style="line-height: 1.5;">
        <tr>
            <td>
                Yang bertanda tangan dibawah ini :
            </td>
        </tr>
    </table>

    <div style="line-height: 1;">
        <table align="center" width="600">
            <tr>
                <td width="120"><span style="display:inline-block; width: 35 px;"></span>Nama</td>
                <td width="2">: </td>
                <td>
                    <font style="font-weight: bold; ">{{$data->name}}</font>
                </td>
            </tr>
            <tr>
                <td width="120"><span style="display:inline-block; width: 35 px;"></span>NIM</td>
                <td width="2">: </td>
                <td>
                    <font style="font-weight: bold; ">{{$data->nim}}</font>
                </td>
            </tr>
            <tr>
                <td width="120"><span style="display:inline-block; width: 35 px;"></span>Jurusan</td>
                <td width="2">: </td>
                <td>
                    <font style="font-weight: bold; ">{{$data->major}}</font>
                </td>
            </tr>
            <tr>
                <td width="120"><span style="display:inline-block; width: 35 px;"></span>Semester</td>
                <td width="2">: </td>
                <td>
                    <font style="font-weight: bold; ">{{$data->semester}}</font>
                </td>
            </tr>
        </table>
    </div>


    <table align="center" width="600" style="line-height: 1.5; margin-top: 10px;">
        <tr>
            <td class="justify">
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Dengan ini mengajukan kiranya diijinkan untuk dispensasi pembayaran Uang Kuliah Tahap {{ $data->stage }} pada semester @if ($data->semester % 2 == 0) {{ 'Genap' }} @else {{ 'Ganjil' }} @endif Tahun Akademik {{ $data->academic_year }} sebesar Rp. {{ number_format($data->nominal,0,',','.') }} (
                    @php
                        function penyebut($nilai) {
                            $nilai = abs($nilai);
                            $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
                            $temp = "";
                            if ($nilai < 12) {
                                $temp = " ". $huruf[$nilai];
                            } else if ($nilai <20) {
                                $temp = penyebut($nilai - 10). " belas";
                            } else if ($nilai < 100) {
                                $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
                            } else if ($nilai < 200) {
                                $temp = " seratus" . penyebut($nilai - 100);
                            } else if ($nilai < 1000) {
                                $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
                            } else if ($nilai < 2000) {
                                $temp = " seribu" . penyebut($nilai - 1000);
                            } else if ($nilai < 1000000) {
                                $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
                            } else if ($nilai < 1000000000) {
                                $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
                            } else if ($nilai < 1000000000000) {
                                $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
                            } else if ($nilai < 1000000000000000) {
                                $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
                            }
                            return $temp;
                        }
                        echo penyebut($data->nominal) . ' rupiah';
                    @endphp
                ) dan akan dibayar pada bulan {{ $data->pay_month }}. Apabila dalam jangka waktu yang telah ditentukan belum bisa membayar SPP maka saya bersedia dikenakan sanksi sesuai dengan aturan lembaga yang berlaku.
            </td>
        </tr>
    </table>
    <table align="center" width="600" style="line-height: 1.5;">
        <tr>
            <td class="justify">
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Demikian, atas permakluman dan kebijaksanaan Bapak/Ibu saya sampaikan terima kasih.
            </td>
        </tr>
    </table>

    <div style="margin-bttom:10px; overflow:auto;">
        <table align="center" width="600">
            <tr>
                <td colspan="3" style="text-align: right;">{{ $informations->village_name }}, {{ \Carbon\Carbon::parse($data->letter_date)->translatedFormat('d M Y') }}</td>
            </tr>
            <tr>
                <td style="text-align: center;">Mengetahui,</td>
                <td><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td style="text-align: center;"><b>Pemohon,</b></td>
            </tr>
            <tr>
                <td>
                    <div style="height:80px;"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td style="text-align: center; text-decoration:underline;"><b>({{ ucfirst(trans(strtolower($data->name))) }})</b><br>NIM: {{ $data->nim }}</td>
            </tr>
        </table>
    </div>

    <div style="margin-top:50px; margin-left:70px;" class="right">

        {!! QrCode::size(100)->generate('Dokumen sah Desa '. $informations->village_name. ' Hari/Tanggal '. $data->letter_date. ' Untuk Keperluan '. $data->letter_name. '-'. $data->name); !!}

    </div>
    </section>

    </body>
</html>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<!-- prevent ctrl+s ctrl+u rightclick -->
<script>
document.onkeypress = function (event) {
    event = (event || window.event);
    return keyFunction(event);
}
document.onmousedown = function (event) {
    event = (event || window.event);
    return keyFunction(event);
}
document.onkeydown = function (event) {
    event = (event || window.event);
    return keyFunction(event);
}

//Disable right click script
var message="Sorry, right-click has been disabled";

function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers)
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
document.oncontextmenu=new Function("return false")

function keyFunction(event){
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
