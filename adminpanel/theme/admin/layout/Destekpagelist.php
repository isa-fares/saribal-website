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

$_get = $this->getParameter();
$modul = $_get["modul"];
$function = $_get["function"];
$id = $_get["id"];



$modul_kontrol = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE modul = '$modul' and aktif = 1");


?>

<div class="box ">
    <div class="box-header with-border">
        <h5 class="box-title">
            Filtreleme Seçenekleri
        </h5>
        <ul class="box-controls pull-right">
            <li><a class="box-btn-slide" href="#"></a></li>
        </ul>
    </div>
    <div class="box-content">
        <div class="box-body" style="padding:5px 16px;">

            <form action="" method="get" autocomplete="off" class="filter-order">

                <input type="hidden" name="cmd" value="destek">
                <input type="hidden" name="filter" value="true">

                <div class="row">

                    <div class="col">
                        <label class='font-size-14 font-weight-500 text-dark'>Kurumlar</label>
                        <select name="kurum" class="select2">
                            <option value="" <?=(isset($_GET["filter"]) && $_GET["kurum"] == "") ? "selected" : ""?>>Seçiniz</option>
                            <?
                            $kurumlar = $this->dbConn->sorgu("SELECT * FROM kurum WHERE sil <> 1 ORDER BY baslik ASC");
                            foreach ($kurumlar as $kurum){
                            ?>
                                <option value="<?=$kurum["id"]?>" <?=(isset($_GET["filter"]) && $_GET["kurum"] == $kurum["id"]) ? "selected" : ""?>><?=$this->temizle($kurum["baslik"])?></option>
                            <? } ?>
                        </select>
                        <? if(isset($_GET["filter"])):?>
                            <a href="<?=$this->BaseAdminURL("Destek")?>"   class="text-danger font-weight-bold d-inline-block mt-3">[x Tüm Filtreleri Temizle]</a>
                        <? endif; ?>
                    </div>

                    <div class="col">
                        <label class='font-size-14 font-weight-500 text-dark'>Konular</label>
                        <select name="konu" class="select2">
                            <option value="" <?=(isset($_GET["filter"]) && $_GET["konu"] == "") ? "selected" : ""?>>Seçiniz</option>
                            <?
                            $konular = $this->dbConn->sorgu("SELECT * FROM konu WHERE sil <> 1 ORDER BY baslik ASC");
                            foreach ($konular as $konu){
                            ?>

                                <option value="<?=$konu["id"]?>" <?=(isset($_GET["filter"]) && $_GET["konu"] == $konu["id"]) ? "selected" : ""?>><?=$this->temizle($konu["baslik"])?></option>

                            <? } ?>
                        </select>
                    </div>

                    <div class="col">
                            <?
                            if (isset($param["search"])) {
                                $place = (isset($param["place"])) ? $param["place"] : "Başlık";
                            ?>

                                <label class='font-size-14 font-weight-500 text-dark'>Anahtar Kelime</label>
                                    <input type="text"
                                           placeholder="<?=$param["place"]?>"
                                           name="kelime"
                                           data-url="<?= $pageUrl ?><?= (isset($_GET["sayfa"])) ? '&sayfa=' . $_GET["sayfa"] : '&sayfa=1' ?>"
                                           id="kelime" value="<?= (isset($_GET["kelime"])) ? $_GET['kelime'] : '' ?>"
                                           class="form-control" style="height: 33px;">
                            <?
                            }
                            ?>
                    </div>



                    <div class="col">
                        <label class='font-size-14 font-weight-500 text-dark' style="margin-bottom: 12px">Durumu</label><br>
                        <input <?=(isset($_GET["filter"]) && $_GET["durum"] == 1) ? "checked" : ""?> type="checkbox" name="durum" id="basic_checkbox_2" value="1" class="filled-in"/>
                        <label for="basic_checkbox_2" style="line-height: 18px;padding-left: 26px;font-weight: 400;font-size: 15px;">Aktif Olanlar</label>
                        <button type="submit"  style="margin-top: -6px;" class="btn btn-info pull-right">Filtrele</button>

                    </div>

                </div>

            </form>






        </div>
    </div>

</div>



<div class="box">
    <div class="box-header with-border">

        <div class="row">

            <div class="col-md-3">
                <?
                if (isset($param["showing"])){
                    ?>
                    <strong style="line-height: 42px;" class="float-left mr-50"><?=$param["showing"]?></strong>
                <? } ?>
            </div>






            <div class="col">
                <?
                if (isset($_GET["limit"]) && $_GET["limit"] == "all") {
                    $limitIcon = "mdi mdi-format-list-numbers";
                    $limitText = "Listeye Dön";
                    $limitUrl = "";
                } else {
                    $limitIcon = "ti-split-v";
                    $limitText = "Sırala";
                    $limitUrl = "&limit=all";
                }
                ?>
                <?
                if (!isset($param["disableSortable"])) {
                    ?>
                    <a href="<?= $pageUrl . $limitUrl ?>" class="btn-xlg btn btn-info pull-right"
                       style="margin-left: 15px;"><i class="<?= $limitIcon ?>"></i> <?= $limitText ?> </a>
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






    </div>



    <div class="box-content">

        <table class="table mb-0 table-striped table-bordered table-hover <?=(!isset($param["disableSortable"])) ? "sorted_table" : ""?>" data-page="<?=$sayfa?>" id="<?=((!isset($param["disableSortable"])) ? "sortable" : "")?>" <?=((isset($param['page'])) ? 'data-id="'.$param['page'].'"':null)?>>
            <thead>
            <tr class="bb-3 theme-border-color">
                <?
                if ($tum == "all"){
                    ?>
                    <th class="resimBlok" width="2%" align="center"> Sırala</th>
                <? } ?>
                <?
                if (isset($param["resim"]) && $param["resim"]){
                    $resimWidth = (($param["page"] == "slayt") ? "3" : "2");
                    ?>

                    <th class="resimBlok" width="<?=$resimWidth?>%"> Resim</th>

                <? } ?>

                <?php
                if(isset($param['baslik']) and is_array($param['baslik']))
                    foreach($param['baslik'] as $baslik):
                        if (is_array($baslik)):
                            echo'
                        <th  style="'.((isset($baslik['width']) ? 'width:'.$baslik['width'].';':'')).'" class="'.((isset($baslik["align"])) ? " text-".$baslik["align"] : '').'"> '.$baslik['title'].' </th>';
                        endif;
                    endforeach;
                ?>
                <th style="width: 5%">Araçlar</th>
            </tr>
            </thead>

            <tbody>


            <?php

            if ($tum == "all") {
                echo "<div class='bg-pale-success p-10 font-weight-bold'>Sıralama Yapmak İçin, Sırala Sütunundaki Oklardan Tutarak Yukarı/Aşağı Taşıyın</div>";
            }

            if(isset($param['p']) and is_array($param['p'])):
                if(isset($param['pdata']) and is_array($param['pdata'])):
                    foreach($param['pdata'] as $pdata):


                        echo'<tr  data-sil="'.$pdata[$this->silColumn].'"'.((isset($pdata['id'])) ? 'data-id="'.$pdata['id'].'"':null).' class="'.(($pdata[$this->silColumn]) == 1 ? "bg-pale-danger" : "").((isset($param["tr_class"]) && $param["tr_class"] != "") ? $param["tr_class"]."_".$pdata[$param["tr_class"]]." " : "").(($pdata[$this->silColumn]) != 1 ? "durum_".$pdata[$this->aktifColumn] : "").((isset($param["goruldu"]) && $param["goruldu"]) ? " goruldu_".$pdata["goruldu"] : "").'">';

                        if ($tum == "all") {
                            echo "<td  align='center' valign='middle' style='padding:0px;'><i class='ti-split-v move'></i> </td>";
                        }

                        if (isset($param["resim"]) && $param["resim"]){
                            $resim = $pdata["resim"];
                            if (empty($resim) && !empty($pdata["icon"]))  $resim = $pdata["icon"];
                            $dizin = "../".$this->settings->config('folder').$param["page"]."/";

                            if (!empty($resim) && file_exists($dizin.$resim) || (isset($param["icon"]) && file_exists($dizin.$param["icon"]))){

                                $resimHeight = (($param["page"] == "slayt") ? "60" : "50");

                                $baseURL = $this->baseURL();
                                $siteURL = (($_SERVER["SERVER_PORT"] == 80) ? "http://" : "https://").$_SERVER["SERVER_NAME"]."/";
                                if ($baseURL != $siteURL){
                                    $resAl = $this->resimal(0,$resimHeight,$resim,"../".$this->settings->config('folder').$param["page"]."/");
                                }else {
                                    $resAl = @$this->BaseURL($this->resimal(0,$resimHeight,$resim,$dizin));
                                }


                                echo "<td align='center' style='padding:0.5rem'><a class='popImage' rel='list_".$param["page"]."' href='".$dizin.$resim."'><img style='height:".$resimHeight."px; width:auto;' class='tmb-image img-rounded img-thumbnail' src='".$resAl."'></a></td>";
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

                                    if (isset($p["new"]) && is_array($p["new"])){
                                        $text = $p["new"]["text"];
                                        $badgeClass = $p["new"]["badgeClass"];
                                        $kosul = $p["new"]["kosul"];
                                        $sutun = $p["new"]["sutun"];

                                        if ($pdata[$sutun] == $kosul){
                                            echo "<div style='position: absolute;   left: -11px;  top: 0;' class='badge ".$badgeClass."'>".$text."</div>";
                                        }

                                    }

                                    if (isset($p["type"]) and $p["type"] == "date"){
                                        if (!empty($pdata[$p["dataTitle"]])) {
                                            echo "<span " . ((isset($p["labelClass"]) && $p["labelClass"] != "") ? "class='" . $p["labelClass"] . "'" : "") . " style='cursor:inherit'>";
                                            echo "<i class='mdi mdi-calendar-clock' style='margin-right: 7px;'></i>" . date($p["dateFormat"], strtotime($pdata[$p['dataTitle']]));
                                            echo "</span>";
                                        }
                                    }



                                    elseif($p["dataTitle"] == "kurumlar" ){
                                        $data = implode(",", array_map("intval", json_decode($pdata[$p["dataTitle"]])));
                                        $kurumlar = $this->dbConn->tekSorgu("SELECT CAST(GROUP_CONCAT(baslik SEPARATOR ', ') AS CHAR) as data FROM kurum  WHERE id IN ( $data )");
                                        echo $kurumlar["data"];
                                    }


                                    elseif($p["dataTitle"] == "konular" ){
                                        $data = implode(",", array_map("intval", json_decode($pdata[$p["dataTitle"]])));
                                        $konular = $this->dbConn->tekSorgu("SELECT CAST(GROUP_CONCAT(baslik SEPARATOR ', ') AS CHAR) as data FROM konu  WHERE id IN ( $data )");
                                        echo $konular["data"];
                                    }



                                    elseif(isset($p["dataYeni"]) and $p["dataYeni"] != ""){
                                        echo $this->temizle($pdata[$p['dataTitle']]).((isset($p["ek"])) ? " - ".$pdata[$p["ek"]] : "");
                                        if ($pdata[$p["dataYeni"]] == 1){
                                            echo " <span style='margin-left:10px; padding:5px 10px; font-size: 12px;' class='label label-danger'>YENİ</span>";
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

                                        case 'radio2':

                                            echo '<td style="width: 5%" align="center">';

                                            if ($pdata[$this->silColumn] != 1) {
                                                echo '<button type="button" class="btn btn-lg btn-toggle ' . ((isset($pdata[$but['dataname']]) and $pdata[$but['dataname']] == 1) ? 'active' : '') . '" onclick="$.panel.proje_durum(this,\'' . ((isset($pdata['id']) ? $pdata['id'] : 0)) . '\',\'' . ((isset($but['url'])) ? $but['url'] : null) . '\')" data-toggle="button" aria-pressed="true"><span class="handle"></span></button>';
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
                                            echo   '<td align="'.((isset($but["align"]) && $but["align"] != "") ? $but["align"] : "").'"><a href="'.((isset($but['url']) ? $but['url'] :'')).((!isset($but["urlEkle"])) ? $pdata['id'] : $this->temizle($pdata[$but["urlEkle"]])).((isset($but["modul"])) ? "&type=".$but["modul"] : "").((isset($but["file_type"])) ? "&file_type=".$but["file_type"] : "").((isset($but["lang"])) ? "&lang=".$but["lang"] : "").((isset($but["resim_tur"])) ? "&resim_tur=".$but["resim_tur"] : '').'" class="'.((isset($but["disable_delete"])) ? ($pdata[$this->silColumn]) ? "disabled " : " " : " ").((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but["data-icon"])) ? "<i class='".$but["data-icon"]."' style='margin-right:7px;'></i>" : "").((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                            break;

                                        case 'modalButton':
                                            echo   '<td  align="'.((isset($but["align"]) && $but["align"] != "") ? $but["align"] : "").'"><a data-id="'.$pdata["id"].'" class="'.((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but["data-icon"])) ? "<i class='".$but["data-icon"]."' style='margin-right:7px;'></i>" : "").((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                            break;

                                    endswitch;
                            endforeach;

                        endif;


                        $wd = ($param["page"] == "uyeler") ? "8%" : "5%";
                        echo'<td width="'.$wd.'">';

                        foreach($param['tools'] as $tool):
                            echo' <a   '.(($param["page"] == "uyeler") ? "data-tur='".$pdata["tur"]."'" : "").((isset($tool["modal"])) ? "data-toggle='modal' data-target='".$tool["url"]."'" : "").'  data-toggle="tooltip" data-page="'.$param["page"].'" data-id="'.$pdata["id"].'" data-placement="top" title="'.((isset($tool['title'])) ? $tool['title']: '').'" href="'.((isset($tool['url'])) ? $tool['url'].((isset($tool["disable_id"])) ? "" : $pdata['id']) : 'javascript:;').'" data-id="'.((isset($tool["disable_id"])) ? "" : $pdata["id"]).'" class="toolsButton btn btn-sm '.((isset($tool["disable_delete"])) ? ($pdata[$this->silColumn]) ? "disabled " : " " : " ").((isset($tool['color'])) ? $tool['color']: '').'">
                        <i class="'.((isset($tool['icon'])) ? $tool['icon']: '').'"></i></a>';

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







    </div>


    <div class="box-footer" style="padding:5px 15px;">


        <div class="sayfalama float-left">
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

