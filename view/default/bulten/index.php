<?
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $id int
 * @var $katurl string
 */
?>
<?
$id = Request::GET("id", null);
if (empty($id)){
    $this->RedirectURL($this->BaseURL());
}

$data = $this->tekSorgu("SELECT * FROM bulten WHERE sil <> 1 and dil = '".$lang."' and id = $id");
if (!is_array($data)){
    $this->RedirectURL($this->BaseURL());
}
$title = $this->temizle($data["baslik"]);
$haftanin_destegi = $data["haftanin_destegi"];
$destekler = json_decode($data["destekler"]);
$dil = $data["dil"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="format-detection" content="date=no" />
    <meta name="format-detection" content="address=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="x-apple-disable-message-reformatting" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title><?=$title?></title>
    <!--[if gte mso 9]>
    <style type="text/css" media="all">
        sup { font-size: 100% !important; }
    </style>
    <![endif]-->

    <style type="text/css">
        *{
            line-height: 100%;
            vertical-align: top;
        }
        html, body, div, span, applet, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        a, abbr, acronym, address, big, cite, code,
        del, dfn, em, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt, var,
        b, u, i, center,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, canvas, details, embed,
        figure, figcaption, footer, header, hgroup,
        menu, nav, output, ruby, section, summary,
        time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: top;
            line-height: 100%;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        body {
            font-family: 'Roboto', sans-serif !important;
            font-size: 15px;
            color:#555;
        }
        a, a:hover, a:focus, a:visited {
            text-decoration: none;
        }

        .detay {
            background-color: #ffffff;
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
            width: 720px;
            margin:0 auto;
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
<body class="body" style="font-family:Roboto; padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#ccc; -webkit-text-size-adjust:none;">

<table class="container" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="margin-top: 30px">
    <tr>
        <td style="padding:25px 15px;">
            <table class="table">
                <tr>
                    <td width="60%">
                        <a href="<?=$this->BaseURL("index", $lang, 1)?>" target="_blank"><img src="<?=$this->bultenURL?>images/logo.png"></a>
                    </td>
                    <td align="right" style="text-align: right">
                        <table align="right" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="padding: 0 5px"><a class="px-1" target="_blank" href="<?=$this->ayarlar("fb")?>"><img src="<?=$this->bultenURL?>images/fb-icon.png"> </a></td>
                                <td style="padding: 0 5px"><a class="px-1" target="_blank" href="<?=$this->ayarlar("tw")?>"><img src="<?=$this->bultenURL?>images/tw-icon.png"> </a></td>
                                <td style="padding: 0 5px"><a class="px-1" target="_blank" href="<?=$this->ayarlar("ins")?>"><img src="<?=$this->bultenURL?>images/ins-icon.png"> </a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:35px 25px;  font-size:30px; color:#fff; text-align: left;  background-color: #202a45;" align="center">
            <b style="font-weight: 500"><?=$title?></b>
            <br><br>
            <div style="font-size: 14px">
                <?=$this->detay($data)?>
            </div>
        </td>
    </tr>
    <?
        if (!empty($haftanin_destegi)):
            $destek = $this->dbLangSelectRow("destek", array("id"=>$haftanin_destegi, "master_id"=>$haftanin_destegi), "resim");
            $ilk_kurum = json_decode($destek["kurumlar"])[0];
            $kurum = $this->dbLangSelect("kurum", $mid."id = $ilk_kurum", "resim")[0];
            $kurum_logo = $this->dbResimAl($kurum["resim"],"kurum", "70x70", true);
            $url = $this->getURL($destek, "destek");
    ?>
    <tr>
        <td style="padding:20px; background-color: #ababab; color:#fff; font-size: 25px; border-top: 6px solid #e46b1a;" bgcolor="#ababab">
            <b style="font-weight: 600;"><?=$this->lang->genel("Haftanın Desteği")?></b><br><br>
            <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #fff; color:#202a45; border-radius: 5px">
                <tr>
                    <td style="padding: 15px; vertical-align: top;" width="15%" valign="top">
                        <img src="<?=$kurum_logo?>">
                    </td>
                    <td style="padding:15px; border-left: 1px solid #efefef;">
                        <h5 style="font-size: 20px; font-weight: 500; padding-bottom: 10px;">
                            <?=$this->temizle($destek["baslik"])?>
                            <? if ($destek["aktif"] == 1):?>
                                <img src="<?=$this->bultenURL?>images/active.jpg">
                            <? endif; ?>
                        </h5>
                        <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 14px;">
                            <tr> <td valign="middle" style="padding: 5px 0"><img src="<?=$this->bultenURL?>images/<?=(($destek["aktif"] == 1) ? "check" : "times")?>-circle.jpg" style="margin-right: 3px;"> Proje Durumu : <?=$this->lang->genel(($destek["aktif"] == 1) ? "Aktif" : "Pasif")?></td> </tr>
                            <tr> <td valign="middle" style="padding: 5px 0"><img src="<?=$this->bultenURL?>images/date.jpg" style="margin-right: 3px;"> Güncelleme Tarihi : <?=date("d.m.Y", strtotime($destek["duzenleme_tarihi"]))?></td> </tr>

                            <tr> <td valign="middle" style="padding: 5px 0"><img src="<?=$this->bultenURL?>images/institution.jpg" style="margin-right: 3px;"> Kurum : <?=$this->temizle($kurum["baslik"])?></td> </tr>

                            <tr>
                                <td>
                                    <a style="border-radius:3px;color:#ffffff;display:inline-block;font-size:14px;font-weight:400;padding:10px 20px;text-decoration:none;text-align:center;background-color:#202a45;width:auto;margin-top:12px;" href="<?=$url?>" target="_blank"><?=$this->lang->genel("GÖZAT")?></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <? endif; ?>

    <?
       if (is_array($destekler)):
           $destek_data = $this->dbLangSelect("destek", "baslik <> '' and ".$mid."id IN (".implode(',', array_map('intval', $destekler)).")");
           if (is_array($destek_data)):

    ?>

        <tr>
            <td style="padding:30px; background-color: #efefef; color:#202a45; font-size: 20px;" bgcolor="#efefef">
                <b style="font-weight:500;"><?=$this->lang->genel("Diğer Destekler")?></b><br><br>
                <?
                   foreach ($destek_data as $item):
                       $ilk_kurum = json_decode($item["kurumlar"])[0];
                       $kurum = $this->dbLangSelect("kurum", $mid."id = $ilk_kurum", "resim")[0];
                       $kurum_logo = $this->dbResimAl($kurum["resim"],"kurum", "70x70", true);
                       $url = $this->getURL($item, "destek");
                ?>
                    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #fff; color:#202a45; border-radius: 5px; border-bottom: 1px solid #efefef;">
                        <tr>
                            <td style="padding: 15px; vertical-align: top;" width="15%" valign="top">
                                <img src="<?=$kurum_logo?>"  style="border-radius:100%; border:5px solid #fff;">
                            </td>
                            <td style="padding:15px; border-left: 1px solid #efefef;">
                                <h5 style="font-size: 15px; font-weight: 500; padding-bottom: 10px;">
                                    <?=$this->temizle($item["baslik"])?>
                                    <? if ($item["aktif"] == 1):?>
                                        <img src="<?=$this->bultenURL?>images/active.jpg">
                                    <? endif; ?>
                                </h5>
                                <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 13px;">
                                    <tr> <td valign="middle" style="padding: 5px 0"><img src="<?=$this->bultenURL?>images/<?=(($item["aktif"] == 1) ? "check" : "times")?>-circle.jpg" style="margin-right: 3px;"> Proje Durumu : <?=$this->lang->genel(($item["aktif"] == 1) ? "Aktif" : "Pasif")?></td> </tr>
                                    <tr> <td valign="middle" style="padding: 5px 0"><img src="<?=$this->bultenURL?>images/date.jpg" style="margin-right: 3px;"> Güncelleme Tarihi : <?=date("d.m.Y", strtotime($item["duzenleme_tarihi"]))?></td> </tr>
                                    <tr> <td valign="middle" style="padding: 5px 0"><img src="<?=$this->bultenURL?>images/institution.jpg" style="margin-right: 3px;"> Kurum : <?=$this->temizle($kurum["baslik"])?></td> </tr>
                                    <tr>
                                        <td>
                                            <a style="border-radius:3px;color:#ffffff;display:inline-block;font-size:14px;font-weight:400;padding:10px 20px;text-decoration:none;text-align:center;background-color:#202a45;width:auto;margin-top:12px;" href="<?=$url?>" target="_blank"><?=$this->lang->genel("GÖZAT")?></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
               <? endforeach;?>
            </td>
        </tr>
        <? endif; ?>
    <? endif; ?>

    <tr>
        <td style="border-bottom: 1px solid #efefef;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:14px; color:#202a45; text-align: center;  background-color: #fff;">
                        <img src="<?=$this->bultenURL?>images/footer-logos.png">
                    </td>
                </tr>
                <tr>
                    <td style="padding:20px;  font-size:13px; color:#202a45; text-align: center;  background-color: #fff;" align="center">
                        “Gaziantep’te Kalıcı Gelir için İstihdam Projesi”, Alman Federal Ekonomik İş Birliği ve Kalkınma Bakanlığı (BMZ) tarafından finanse edilen PEP- Ekonomik Fırsatların Desteklenmesi Programı kapsamında; Alman Uluslararası İş Birliği Kurumu (GİZ) ve Gaziantep Sanayi Odası (GSO) iş birliği ile yürütülmektedir.   Bu web sitesi, Alman Federal Ekonomik İşbirliği ve Kalkınma Bakanlığı’nın (BMZ) maddi desteği ile GSO tarafından hazırlanmıştır. İçerik tamamı ile Gaziantep Sanayi Odası'nın (GSO) sorumluluğu altındadır. BMZ ve GİZ’in görüşlerini yansıtmak zorunda değildir.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:20px;  font-size:14px; color:#202a45; text-align: center;  background-color: #fff;" align="center">
            <?=$this->ayarlar("title_".$lang)?><br><br>
            <a target="_blank" style="color:#ef8022;" href="<?=$this->BaseURL()?>">Websitesine Git</a>
        </td>
    </tr>
</table>




</body>
</html>

