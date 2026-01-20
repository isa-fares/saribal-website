<style>
    table tr td{
        border:1px solid #ccc;
        padding:4px !important;
        vertical-align: top !important;
    }

    table tr td label {
        font-weight: 500;
        font-size: 11px;
        margin-bottom: 0px !important;
    }

    table tr td h3 {
        margin: 3px 0px;
        font-size: 13px;
        font-weight: bold;
    }

    @media print
    {

        body {
            display: table;
            table-layout: fixed;
            padding-top: 1cm;
            padding-left: 1cm;
            padding-right: 1cm;
            padding-bottom: 1cm;
            height: auto;
        }

        .no-print, .no-print *
        {
            display: none !important;
        }

        body {
            margin: 0px;
            padding:0px;
        }


        .ebat td {
            font-size: 80%;
            color:#111;
        }

        .ebat th {
            color:#111;
            font-size:90%;
        }

        .ebat td label {
            color:#111;
            margin-bottom: 0;
        }


        .main-footer {
            display: none;
        }

    }
</style>
<div class="row">
    <?
    $data = $param["pdata"];
    ?>
    <div class="col-lg-12">
        <table width="100%" border="0"  borderColor="#ccc" class="ebat" style="width:100%; float: left;">
            <tr>
                <td colspan="5"><strong>Başvuru Tarihi : <label for="basvuru_tarihi"><?=$data["basvuru_tarihi"]?></label></strong></td>
                <!--<td width="20%" rowspan="6">
                    <?/*
                    if ($data["resim"] != ""){
                        */?>

                        <div class="kariyerDetayRow" style="float:right;">

                            <img  align="right" class="rotateImg" src="<?/*=$data["resim"]*/?>" style="float:right; max-width: 150px;">

                        </div>

                    <?/* } */?>
                </td>-->
            </tr>
            <tr>
                <td width="40%"><strong>ADI SOYADI</strong></td>
                <td width="40%" colspan="4"><label for="adi_soyadi"><?=$data["adi_soyadi"]?></label></td>
            </tr>
            <tr>
                <td><strong>T.C. KİMLİK NO</strong></td>
                <td colspan="4"><label for="tc_kimlik"><?=$data["tc_kimlik"]?></label></td>
            </tr>
            <tr>
                <td width="40%"><strong>CİNSİYET</strong></td>
                <td colspan="4"><label for="cinsiyet"><?=$data["cinsiyet"]?></label></td>
            </tr>

            <tr>
                <td width="40%"><strong>ADRESİ</strong></td>
                <td colspan="4"><label for="cinsiyet"><?=$data["adresi"]?></label></td>
            </tr>
            <tr>
                <td width="40%"><strong>CEP TELEFONU</strong></td>
                <td colspan="4"><label for="cinsiyet"><?=$data["cep_telefonu"]?></label></td>
            </tr>
            <tr>
                <td width="40%"><strong>MESLEĞİ</strong></td>
                <td colspan="4"><label for="meslek"><?=$data["meslek"]?></label></td>
            </tr>

            <tr>
                <td width="53%"><strong>TAHSİL DURUMU</strong></td>
                <td colspan="4"><label for="tahsil"> <?=$data["tahsil"]?> </label></td>
            </tr>

            <tr>
                <td width="53%"><strong>ENGELLİLİK ORANI</strong></td>
                <td colspan="4"><label for="engellilik"> <?=$data["engellilik"]?>  </label></td>
            </tr>

            <!--<tr>
                <td width="40%"><strong>DOĞUM TARİHİ</strong></td>
                <td colspan="4"><label for="dogum_yeri_ve_tarihi"><?/*=$data["dogum_yeri_ve_tarihi"]*/?></label></td>
            </tr>

            <tr>
                <td width="40%"><strong>BOY / KİLO</strong></td>
                <td colspan="4"><label for="boy"><?/*=$data["boy"]*/?>  <?/*=($data["kilo"] != "") ? " / ".$data["kilo"] : ""*/?></label></td>
            </tr>-->
        </table>


    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        window.print();
    });
</script>