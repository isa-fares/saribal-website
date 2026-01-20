<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>İletişim Formu</title>
    <style media="all" type="text/css">

        body {
            background-color: #efefef;
            font-family: 'Arial', sans-serif !important;
            font-size: 15px;
            color:#555;
        }
        a, a:hover, a:focus, a:visited {
            text-decoration: none;
        }

        .detay {
            background-color: #ffffff;
            padding:20px;
            border:1px solid #d9d9d9;
            border-top:none;
        }

        .baslik {
            background-color: #f7f7f7;
            font-weight: bold;
            padding:15px;
            border:1px solid #d9d9d9;
        }

        .detay table tbody tr td ,.detay table tbody tr th {
            padding:10px;
            text-align: left;
            border-collapse: collapse;
            border:1px solid #dee2e6;
            border-spacing: 0px;
        }


        .container {
            width: 1000px;
            margin-bottom: 30px;
        }

        .table {
            width: 100%;
        }

        .detay table thead tr th {
            color:#ffffff;
            padding:20px !important;
        }

        .small {
            font-size: 11px;
        }


    </style>
</head>
<body>
<div class="container" align="center">
    <img src="<?=$this->themeURL?>images/asotologo.png">
    <br><br>

</div>

<table class="container" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
    <tr>
        <td class="baslik">
            Merhaba Yetkili, <br> İletişim Formundan Mesaj Aldınız
        </td>
    </tr>
    <tr>
        <td class="detay">
            <table class="table" width="100%" cellspacing="0" cellpadding="0">

                <tbody>

                    <tr class="">
                        <th width="20%">Adı Soyadı</th>
                        <td><?=$adi?></td>
                    </tr>

                    <tr>
                        <th>E-posta</th>
                        <td><?=$email?></td>
                    </tr>

                    <tr>
                        <th>Telefon</th>
                        <td><?=$tel?></td>
                    </tr>

                    <tr>
                        <th>Konu</th>
                        <td><?=$konu?></td>
                    </tr>


                    <tr>
                        <th>Mesajı</th>
                        <td><?=$mesaj?></td>
                    </tr>

                </tbody>
            </table>
        </td>
    </tr>
</table>
<table class="container" align="center" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td align="center" class="small">
            <br><br>
            <p><strong><?=$this->ayarlar('firma_tr')?></strong></p>
            <p><?=$this->ayarlar('adres_merkez')?></p>
            <p>Telefon : <?=$this->ayarlar('telefon_merkez')?></p>
            <p>E-Posta : <?=$this->ayarlar('email_merkez')?></p>
        </td>
    </tr>
</table>
</body>
</html>