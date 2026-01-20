<?


$tum = (isset($_GET["limit"])) ? $_GET["limit"] : "";


$i=1;
$pageFilterUrl = "";
foreach ($_GET as $key=>$value){
    $seperator = ($i==1) ? "?" : "&";
    if ($key != "sayfa"){
        $pageFilterUrl.= $seperator.$key."=".$value;
        $i++;
    }

}

$pageUrl = $this->BaseAdminURL()."/".$pageFilterUrl;

if (isset($_GET["kelime"])){
    $pageUrl.="&kelime=".$_GET["kelime"];
}
$sayfa = (isset($_GET["sayfa"])) ? $this->kirlet(intval($_GET['sayfa'])) : 1;

if (isset($param["toplamVeri"])){


    $toplamVeri = $param["toplamVeri"];


    if (!is_numeric($sayfa)){
        $sayfa = 1;
    }

    $sayfaLimit = isset($param["sayfaLimit"]) ? $param["sayfaLimit"] : $this->settings->config('veriLimit');

    $toplamSayfa = ceil($toplamVeri / $sayfaLimit);

    if ($sayfa > $toplamSayfa)
    {
        $sayfa = 1;
    }


}

$ex = explode('/',$_GET["cmd"]);
if (isset($ex[2])) $id = $ex[2];

if(isset($_GET["filter"]))
{
    if ($_GET["user_id"] != ""){
        $user = $this->dbConn->teksorgu("SELECT * FROM uyeler WHERE id = ".$_GET["user_id"]);
        $userName = ($user["unvan"] != "") ? $this->temizle($user["unvan"])." (".$this->temizle($user["adi"]) : $this->temizle($user["adi"]);
    }

    if ($_GET["kurs_id"] != ""){
        $kurs = $this->dbConn->teksorgu("SELECT * FROM kurslar WHERE id = ".$_GET["kurs_id"]);
        $kursName = $this->temizle($kurs["kod"])." ".$this->temizle($kurs["baslik"]);
    }
}

?>

<?
$toplam_satis = $this->dbConn->tekSorgu("SELECT Count(id) as toplam FROM siparis");
$iptal = $this->dbConn->tekSorgu("SELECT Count(id) as toplam FROM siparis WHERE iptal = 1");
$beklemede = $this->dbConn->tekSorgu("SELECT Count(id) as toplam FROM siparis WHERE islem = 1");
$basarili = $this->dbConn->tekSorgu("SELECT Count(id) as toplam FROM siparis WHERE islem = 2");
$hata = $this->dbConn->tekSorgu("SELECT Count(id) as toplam FROM siparis WHERE islem = 3");
?>
<!--<div class="box-footer" style="padding:0px">
    <table class="table table-bordered">
        <tr>
            <td width="40%">&nbsp;</td>
            <td width="10%">Toplam Satış : <span class="badge badge-dark"><b><?/*=$toplam_satis["toplam"]*/?></b></span> </td>
            <td width="10%">İptal Edilen : <span class="badge badge-purple"><b><?/*=$iptal["toplam"]*/?></b></span></td>
            <td width="10%">Başarılı : <span class="badge badge-green"><b><?/*=$basarili["toplam"]*/?></b></span></td>
            <td width="10%">Hata : <span class="badge badge-danger"><b><?/*=$hata["toplam"]*/?></b></span></td>
            <td width="12%">Ödeme Bekliyor : <span class="badge badge-warning text-dark"><b><?/*=$beklemede["toplam"]*/?></b></span></td>
        </tr>
    </table>
</div>-->




<div class="row">
    <div class="col-md-3">
        <div class="box pull-up">
            <div class="box-body">
                <div class="flexbox mb-1">
                    <div>
                        <p class="text-info font-size-26 font-weight-500 mb-0"><?=$toplam_satis["toplam"]?></p>
                        Toplam Satış
                    </div>
                </div>
                <div class="progress progress-xxs mt-10 mb-0">
                    <div class="progress-bar progress-xs bg-info" role="progressbar" style="width: 100%; height: 40px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>





<?
    if (isset($param["flitpageCustom"]) || isset($param["search"])) {
?>


<div class="box ">
    <div class="box-header with-border">
        <h5 class="box-title">Filtreleme Seçenekleri</h5>
        <ul class="box-controls pull-right">
            <li><a class="box-btn-slide" href="#"></a></li>
        </ul>
    </div>
    <div class="box-content">
        <div class="box-body" style="padding:5px 16px;">

            <form action="" method="get" autocomplete="off" class="filter-order">

                    <input type="hidden" name="cmd" value="Siparis">
                    <input type="hidden" name="filter" value="true">

                    <div class="row">
                        <div class="col">
                            <label class='font-size-14 font-weight-500 text-dark'>Kullanıcı</label>
                            <div class="search-block">
                                <div class="search-block-input"><?=(isset($_GET["filter"]) && $_GET["user_id"] != "") ? $userName : "Seçiniz"?></div>
                                <div class="search-area">
                                    <div class='search-default-text'>Seçiniz</div>
                                    <input type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" class="search-input" data-type="search_user" placeholder="Kullanıcı Ara" autocomplete="off">
                                    <input type="hidden" name="user_id" class="d-none return_value" value="<?=(isset($_GET["filter"]) && $_GET["user_id"] != "") ? $_GET["user_id"] : ""?>">
                                    <i class="text-center fa fa-spinner fa-spin loading-result"></i>
                                    <ul class="search-result" data-selected="0"></ul>
                                </div>
                            </div>

                            <?
                            if (isset($_GET["filter"])){
                                echo "<br>";
                                if ($param["toplamVeri"] > 0){
                                    echo "<span  class='text-danger font-size-16'>Toplam <b>".$param["toplamVeri"]."</b> Adet Kayıt Bulundu</span>";
                                }
                                else {
                                    echo "<span class='text-danger font-size-16'>Seçtiğiniz kriterlerde kayıt bulunamadı</span>";
                                }

                                echo "<a class='btn btn-danger btn-sm' href='".$this->BaseAdminURL()."/?cmd=".$_GET["cmd"]."' style='margin-top: 10px;'><i class='fa fa-times-circle'></i> Filtreyi Temizle</a>";
                            }
                            ?>

                        </div>


                        <div class="col">
                            <label class='font-size-14 font-weight-500 text-dark'>Websitesi Türü</label>
                            <select name="tur" class="select2">
                                <option value="" <?=(isset($_GET["filter"]) && $_GET["tur"] == "") ? "selected" : ""?>>Seçiniz</option>
                                <?
                                    $turler = $this->settings->config("paketTurleri");
                                    foreach ($turler as $tur){
                                ?>

                                        <option value="<?=$tur["id"]?>" <?=(isset($_GET["filter"]) && $_GET["tur"] == $tur["id"]) ? "selected" : ""?>><?=$tur["title"]?></option>

                                <? } ?>
                            </select>
                        </div>


                        <div class="col">
                            <label class='font-size-14 font-weight-500 text-dark'>Temalar</label>
                            <select name="tema" class="select2">
                                <option value="" <?=(isset($_GET["filter"]) && $_GET["tema"] == "") ? "selected" : ""?>>Seçiniz</option>
                                <?
                                $temalar = $this->dbConn->sorgu("SELECT * FROM temalar ORDER BY sira ASC");
                                foreach ($temalar as $tema){
                                ?>

                                    <option value="<?=$tema["id"]?>" <?=(isset($_GET["filter"]) && $_GET["tema"] == $tema["id"]) ? "selected" : ""?>><?=$tema["baslik"]?></option>

                                <? } ?>
                            </select>
                        </div>


                        <div class="col">
                            <label class='font-size-14 font-weight-500 text-dark'>Ödeme</label>
                            <select name="islem" class="select2">
                                <option value="" <?=(isset($_GET["filter"]) && $_GET["islem"] == '') ? "selected" : ""?>>Seçiniz</option>
                                <option value="1" <?=(isset($_GET["filter"]) && $_GET["islem"] == 1) ? "selected" : ""?>>Beklemede</option>
                                <option value="2" <?=(isset($_GET["filter"]) && $_GET["islem"] == 2) ? "selected" : ""?>>Başarılı</option>
                                <option value="3" <?=(isset($_GET["filter"]) && $_GET["islem"] == 3) ? "selected" : ""?>>Hata</option>
                            </select>
                        </div>


                        <div class="col">
                            <label class='font-size-14 font-weight-500 text-dark' style="margin-bottom: 12px">İptal Durumu</label><br>
                            <input <?=(isset($_GET["filter"]) && $_GET["iptal"] == 1) ? "checked" : ""?> type="checkbox" name="iptal" id="basic_checkbox_2" value="1" class="filled-in"/>
                            <label for="basic_checkbox_2" style="line-height: 18px;padding-left: 26px;font-weight: 400;font-size: 15px;">İptal Edilenler</label>
                            <button type="submit"  style="margin-top: -6px;" class="btn btn-info pull-right">Filtrele</button>
                        </div>

                    </div>

            </form>






        </div>
    </div>

</div>
<?
    }
?>


<div class="box">
    <div class="box-header with-border">
        <?
            if (isset($param["showing"])){
        ?>
        <div class="float-left">
            <strong style="line-height: 42px;"><?=$param["showing"]?></strong>
        </div>
        <? } ?>



        <div class="float-right">
            <?
            if (isset($_GET["limit"]) && $_GET["limit"] == "all") {
                $limitIcon = "mdi-format-list-numbers";
                $limitText = "Sayfa";
                $limitUrl = "";
            } else {
                $limitIcon = "mdi-crop-free";
                $limitText = "Tümü";
                $limitUrl = "&limit=all";
            }
            ?>
            <?
                    if (!isset($param["disableSortable"])) {
            ?>
                <a href="<?= $pageUrl . $limitUrl ?>" class="btn-xlg btn btn-info pull-right"
               style="margin-left: 15px;"><i class="mdi <?= $limitIcon ?>"></i> <?= $limitText ?> </a>
            <?
            }
            ?>
            <?
            if (isset($param['button']) and is_array($param['button'])):

                foreach ($param['button'] as $button):

                    echo '<a ';
                    if (isset($button['data']) and is_array($button['data']))
                        foreach ($button['data'] as $key => $value):
                            echo "data-" . $key . '="' . $value . '"';
                        endforeach;

                    echo 'href="' . ((isset($button['href'])) ? $button['href'] : '') . '" id="' . ((isset($button['id'])) ? $button['id'] : '') . '" class="btn-xlg  ' . ((isset($button['class'])) ? $button['class'] : '') . ' pull-right"> <i class="' . ((isset($button['icon'])) ? $button['icon'] : 'fa fa-plus') . '"></i> ' . ((isset($button['title'])) ? $button['title'] : '') . '
            </a>';

                endforeach;
            endif;
            ?>

        </div>



    </div>



    <div class="box-content">

            <table class="table table-striped table-bordered table-hover <?=(!isset($param["disableSortable"])) ? "sorted_table" : ""?>" data-page="<?=$sayfa?>" id="<?=((!isset($param["disableSortable"])) ? "sortable" : "")?>" <?=((isset($param['page'])) ? 'data-id="'.$param['page'].'"':null)?>>
                <thead>
                <tr class="bb-3 theme-border-color">
                    <?
                        if ($tum == "all"){
                    ?>
                    <th class="resimBlok" width="2%" align="center"> Sırala</th>
                    <? } ?>
                    <?
                    if (isset($param["resim"]) && $param["resim"]){
                    ?>

                        <th class="resimBlok" width="5%"> Resim</th>

                    <? } ?>

                    <?php
                    if(isset($param['baslik']) and is_array($param['baslik']))
                        foreach($param['baslik'] as $baslik):
                            echo'
                        <th  style="'.((isset($baslik['width']) ? 'width:'.$baslik['width'].';':'')).'" class="'.((isset($baslik["align"])) ? " text-".$baslik["align"] : '').'"> '.$baslik['title'].' </th>';
                        endforeach;
                    ?>
                    <th style="width: 5%">Araçlar</th>
                </tr>
                </thead>

                <tbody>

                <?php

                if(isset($param['p']) and is_array($param['p'])):
                    if(isset($param['pdata']) and is_array($param['pdata'])):
                        foreach($param['pdata'] as $pdata):


                            echo'<tr  data-sil="'.$pdata[$this->silColumn].'"'.((isset($pdata['id'])) ? 'data-id="'.$pdata['id'].'"':null).' class="'.(($pdata["goruldu"]) == 0 ? " bg-pale-yellow " : "").((isset($param["tr_class"]) && $param["tr_class"] != "") ? $param["tr_class"]."_".$pdata[$param["tr_class"]]." " : "").(($pdata[$this->silColumn]) != 1 ? "durum_".$pdata[$this->aktifColumn] : "").'">';

                            if ($tum == "all") {
                                echo "<td align='center' valign='middle' style='padding:0px;'><i class='ti-split-v move'></i> </td>";
                            }


                            if (isset($param["resim"]) && $param["resim"]){
                                $resim = $pdata["resim"];
                                $dizin = "../".$this->settings->config('folder').$param["page"]."/";
                                if (!empty($resim)){
                                    $resAl = $this->BaseURL($this->resimal(0,40,$resim,$dizin));
                                    echo "<td align='center' style='padding:0.5rem'><a class='popImage' rel='list_".$param["page"]."' href='".$dizin.$resim."'><img class='tmb-image img-rounded img-thumbnail' src='".$resAl."'></a></td>";
                                }
                                else {
                                    $resAl = $this->BaseAdminURL()."/img/noimage.png";
                                    echo "<td  align='center'><img src='".$resAl."'></td>";
                                }
                            }


                            foreach ($param["p"] as $p){

                                if (is_array($p)){

                                    echo'<td  class="'.((isset($p['class'])) ? $p['class'] : '').'" tabindex="'.((isset($p['tabindex'])) ? $p['tabindex'] : '').'" data-itemsayfa="'.$sayfa.'">';

                                    if (isset($p["dataTitle"])){

                                        if ($pdata["goruldu"] == 0){
                                            if (isset($p["badge"]) && $p["badge"] != ""){
                                                echo "<div style='position: absolute;   left: -11px;  top: 0;' class='badge ".$p["badgeClass"]."'>".$p["badge"]."</div>";
                                            }

                                        }

                                        if (isset($p["type"]) and $p["type"] == "date"){
                                            echo "<span ".((isset($p["labelClass"]) && $p["labelClass"] != "") ? "class='".$p["labelClass"]."'" : "")." style='cursor:inherit'>";
                                            echo "<i class='mdi mdi-calendar-clock' style='margin-right: 7px;'></i>".date('d.m.Y',strtotime($pdata[$p['dataTitle']]));
                                            echo "</span>";
                                        }

                                        elseif(isset($p["type"]) and $p["type"] == "fiyat"){
                                            echo "<span ".((isset($p["labelClass"]) && $p["labelClass"] != "") ? "class='".$p["labelClass"]."'" : "").">";
                                            echo $this->fiyatAl($pdata[$p["dataTitle"]])." <i class='fa fa-try'></i>";
                                            echo "</span>";
                                        }

                                        elseif(isset($p["type"]) and $p["type"] == "user_type"){
                                            echo "<span ".((isset($p["labelClass"]) && $p["labelClass"] != "") ? "class='".$p["labelClass"]."'" : "").">";
                                            echo ($pdata[$p["dataTitle"]] == 2) ? "Kurumsal" : "Bireysel";

                                            echo "</span>";
                                        }

                                        elseif(isset($p["type"]) and $p["type"] == "kullanici"){
                                            echo "<span ".((isset($p["labelClass"]) && $p["labelClass"] != "") ? "class='".$p["labelClass"]."'" : "").">";
                                            echo $pdata[$p["dataTitle"]]."<span class='infoModal'  data-id='".$pdata["user_id"]."'><i class='fa fa-info-circle text-primary'></i> </span><br>";
                                            echo "<span style='font-size:12px'>".$pdata[$p["ek"]]."</span>";
                                            echo "</span>";
                                        }


                                        elseif(isset($p["type"]) and $p["type"] == "siparis_durum"){

                                                switch ($pdata[$p["dataTitle"]]):
                                                    case 1:
                                                    case 0:
                                                        $labelClass = "bg-info";
                                                        $labelText = "Onay Bekliyor";
                                                    break;

                                                    case 2:
                                                        $labelClass = "bg-olive";
                                                        $labelText = "Onaylandı";
                                                    break;

                                                    case 3:
                                                        $labelClass = "bg-red";
                                                        $labelText = "İptal Edildi";
                                                    break;

                                                    default:
                                                        $labelClass = "bg-info";
                                                        $labelText = "Onay Bekliyor";
                                                    break;

                                                endswitch;


                                                echo "<span class='label ".$labelClass."'>";
                                                    echo $labelText;
                                                echo "</span>";

                                        }


                                        elseif(isset($p["type"]) and $p["type"] == "odeme"){

                                            switch ($pdata[$p["dataTitle"]]):

                                                case 1:
                                                case 0:
                                                    $labelClass = "badge-warning";
                                                    $labelText = "Ödeme Bekleniyor";
                                                    break;

                                                case 2:
                                                    $labelClass = "badge-green";
                                                    $labelText = "Başarılı";
                                                    break;

                                                case 3:
                                                    $labelClass = "badge-danger";
                                                    $labelText = "Hata";
                                                    break;

                                            endswitch;


                                            echo "<span class='badge ".$labelClass."'>";
                                            echo $labelText;
                                            echo "</span>";

                                            if ($pdata["iptal"] == 1){
                                                echo "<span class='badge badge-danger ml-5'>İptal</span>";
                                            }

                                        }

                                        elseif(isset($p["dataYeni"]) and $p["dataYeni"] != ""){
                                            echo $this->temizle($pdata[$p['dataTitle']]).((isset($p["ek"])) ? " - ".$pdata[$p["ek"]] : "");
                                            if ($pdata[$p["dataYeni"]] == 1){
                                                echo "<span style='margin-left:10px; padding:5px 10px; font-size: 12px;' class='label label-danger'>YENİ</span>";
                                            }
                                        }

                                        else {
                                            echo "<span ".((isset($p["labelClass"]) && $p["labelClass"] != "") ? "class='".$p["labelClass"]."'" : "").">";
                                            echo $this->temizle($pdata[$p['dataTitle']]).((isset($p["ek"])) ? " - ".$pdata[$p["ek"]] : "");
                                            echo "</span>";
                                        }


                                    }

                                    echo '</td>';
                                }

                                else {
                                    echo "<td>".$p."</td>";
                                }

                            }


                            if(isset($param['buton']) and is_array($param['buton'])):
                                foreach($param['buton'] as $but):

                                    if(isset($but['type']))
                                        switch($but['type']):
                                            case 'radio':

                                                echo '<td style="width: 5%" align="center">';

                                                if ($pdata[$this->silColumn] != 1) {
                                                    echo '<button type="button" class="btn btn-lg btn-toggle ' . ((isset($pdata[$but['dataname']]) and $pdata[$but['dataname']] == 1) ? 'active' : '') . '" onclick="$.panel.durum(this,\'' . ((isset($pdata['id']) ? $pdata['id'] : 0)) . '\',\'' . ((isset($but['url'])) ? $but['url'] : null) . '\')" data-toggle="button" aria-pressed="true"><span class="handle"></span></button>';
                                                }
                                                else {
                                                    echo '<span class="label label-danger">Silinmiş</span>';
                                                }

                                                echo "</td>";

                                            break;

                                            case 'checkbox':
                                                echo  '<td>check</td>';
                                            break;

                                            case 'button':
                                                echo  '<td><a href="'.((isset($but['url']) ? $but['url'] :'')).'&folder='.((isset($but['folder']) ? base64_encode($but['folder']) :'')).'&modul='.((isset($but['modul']) ? $but['modul'] :'')).'&gelenid='.((isset($pdata['id']))? $pdata['id']:null).'" class="dosya fancybox.iframe '.((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                                ;
                                            break;

                                            case 'button2':
                                                echo   '<td align="'.((isset($but["align"]) && $but["align"] != "") ? $but["align"] : "").'"><a href="'.((isset($but['url']) ? $but['url'] :'')).((!isset($but["urlEkle"])) ? $pdata['id'] : $this->temizle($pdata[$but["urlEkle"]])).((isset($but["modul"])) ? "&type=".$but["modul"] : "").((isset($but["resim_tur"])) ? "&resim_tur=".$but["resim_tur"] : '').'" class="'.((isset($but["disable_delete"])) ? ($pdata[$this->silColumn]) ? "disabled " : " " : " ").((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but["data-icon"])) ? "<i class='".$but["data-icon"]."' style='margin-right:7px;'></i>" : "").((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                            break;

                                            case 'modalButton':
                                                echo   '<td  align="'.((isset($but["align"]) && $but["align"] != "") ? $but["align"] : "").'"><a data-id="'.$pdata["id"].'" class="'.((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but["data-icon"])) ? "<i class='".$but["data-icon"]."' style='margin-right:7px;'></i>" : "").((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                            break;

                                        endswitch;
                                endforeach;

                            endif;

                            echo'<td width="5%">';

                            foreach($param['tools'] as $tool):
                                echo' <a data-page="'.$param["page"].'" data-id="'.$pdata["id"].'"  title="'.((isset($tool['title'])) ? $tool['title']: '').'" href="'.((isset($tool['url'])) ? $tool['url'].((isset($tool["disable_id"])) ? "" : $pdata['id']) : 'javascript:;').'" class="toolsButton btn btn-sm '.((isset($tool["disable_delete"])) ? ($pdata[$this->silColumn]) ? "disabled " : " " : " ").((isset($tool['color'])) ? $tool['color']: '').'">
                        <i class="'.((isset($tool['icon'])) ? $tool['icon']: '').'"></i> '.((isset($tool["title"])) ? " ".$tool["title"] : "").'</a>';

                            endforeach;
                            echo '</td> </tr>';

                        endforeach;
                    else:
                        echo "<tr class='bg-pale-yellow' ><td style='border:none;' colspan='100%'>Kayıtlı Veri Bulunamadı</td></tr>";
                    endif;
                endif;
                ?>
                </tbody>
            </table>

            <div class="sayfalama">
                <?
                if (isset($param["toplamVeri"])){


                    if ($toplamSayfa > 1){
                        ?>


                        <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate">
                            <ul class="pagination">
                                <?
                                if( $sayfa > 1 )
                                {
                                    $ilk = $pageUrl;

                                    $onceki = $pageUrl."&sayfa=".($sayfa - 1);
                                    echo '<li class="paginate_button previous" id="example2_previous"><a href="'.$ilk.'" aria-controls="example2" data-dt-idx="0" tabindex="0"><i class="ti-shift-left"></i> </a></li>';
                                    echo '<li class="paginate_button previous" id="example2_previous"><a href="'.$onceki.'" aria-controls="example2" data-dt-idx="0" tabindex="0"><i class="ti-angle-left"></i> </a></li>';
                                }
                                ?>

                                <?
                                for( $i = $sayfa - 3; $i < $sayfa + 4; $i++ )
                                {
                                    if( $i > 0 && $i <= $toplamSayfa )
                                    {
                                        $url = $pageUrl."&sayfa=".$i;
                                        ?>

                                        <li class="paginate_button <?=($i == $sayfa) ? 'active' : ''?>"><a href="<?=$url?>" aria-controls="example2"><?=$i?></a></li>

                                        <?
                                    }
                                }

                                if( $sayfa != $toplamSayfa )
                                {

                                    $sonraki = $pageUrl."&sayfa=".($sayfa + 1);
                                    $son = $pageUrl."&sayfa=".$toplamSayfa;

                                    echo '<li class="paginate_button next" id="example2_next"><a href="'.$sonraki.'" aria-controls="example2" data-dt-idx="7" tabindex="0"><i class="ti-angle-right"></i></a></li>';

                                    echo '<li class="paginate_button next" id="example2_next"><a href="'.$son.'" aria-controls="example2" data-dt-idx="7" tabindex="0"><i class="ti-shift-right"></i> </a></li>';
                                }
                                ?>





                            </ul>
                        </div>

                        <?
                    }
                }
                ?>
            </div>
    </div>




    </div>
    <!-- /.box-body -->


    <!-- /.box-footer-->
</div>

