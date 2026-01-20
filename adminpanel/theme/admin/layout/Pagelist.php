<?
$tum = (isset($_GET["limit"])) ? $_GET["limit"] : "";


$lang = ((isset($_GET["lang"])) ? $_GET["lang"] : "tr");

if ($param["page"] == "urun"){
    $pageUrl = $this->BaseAdminURL()."/?cmd=".$_GET["cmd"].((!empty($param["marka"])) ? "&marka=".$param["marka"] : '');
}
else {
    $pageUrl = $this->BaseAdminURL()."/?cmd=".$_GET["cmd"].((isset($param["kat_id"])) ? "&kat=".$param["kat_id"] : '');
}


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

$_get = $this->getParameter();
$modul = $_get["modul"];
$function = $_get["function"];
$id = $_get["id"];



$modul_kontrol = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE modul = '$modul' and aktif = 1");


?>




<div class="box">
    <div class="box-header with-border">


        <div class="row <?=(($param["page"] == "destek_dosya") ? "align-items-center" : "")?>">
            <?
            if (isset($param["flitpage"]) || isset($param["search"])){
                ?>
                <strong class="mr-10 ml-10"><h5 class="mb-0" style="margin-top:8px;">Filtrele</h5></strong>
            <? } ?>
            <? if ($param["page"] == "destek_dosya"):?>
                <div class="col-md-3">
                    <h4 class="mb-0">Ekli Dosyalar</h4>
                </div>
            <? endif;?>

            <?
            if (isset($param["flitpage"])) {
            ?>



                <div class="col-md-3">
                    <?
                    if (isset($param['flitpage']) and is_array($param['flitpage'])) {
                        $filterp = $param["id"];
                        $form = new AdminPanel\Form($this->settings);
                        echo $form->filter(array("title" => $param["flitpage"]["title"], 'class' => (isset($param["flitpage"]["class"]) ? $param["flitpage"]["class"] : ""), "url" => (isset($param["flitpage"]["url"]) ? $param["flitpage"]["url"] : ''), 'title' => (isset($param['flitpage']['title'])) ? $param['flitpage']['title'] : null, 'name' => (isset($param['flitpage']['name'])) ? $param['flitpage']['name'] : 'katfild', 'data' => $form->parent(array('sql' => ((isset($param['flitpage']['sql'])) ? $param['flitpage']['sql'] : null), 'array'=>((isset($param['flitpage']['array'])) ? $param['flitpage']['array'] : null), 'option' => ((isset($param['flitpage']['option'])) ? $param['flitpage']['option'] : array('value' => 'id', 'title' => 'kategori')), 'kat' => ((isset($param['flitpage']['kat'])) ? $param['flitpage']['kat'] : null), 'selected' => ((isset($filterp)) ? $filterp : '')), 0, 0)));
                    }

                    if (isset($param['flitpageCustom']) and is_array($param['flitpageCustom'])) {
                        $filterp = $param["id"];
                        $dt = $param["flitpageCustom"];
                        echo "<select data-url='".$dt["url"]."' class='select2 ".$dt["class"]."' name='".$dt["name"]."'>";
                        echo "<option value=''>".$dt["title"]."</option>";
                        if(is_array($dt["data"])){
                            foreach ($dt["data"] as $item){
                                echo "<option value='".$item["value"]."' ".(($filterp == $item["value"]) ? 'selected' : '').">".$item["title"]."</option>";
                            }
                        }

                        echo "</select>";
                    }



                    ?>

                </div>

                <?
            }
            ?>
            <?

            if(isset($param['markaFilter']) and is_array($param['markaFilter'])):
                echo ' <div class="col-md-3">';
                $filterp = $param["marka"];
                $form =   new AdminPanel\Form($this->settings);
                echo $form->filter(array("title" => $param["markaFilter"]["title"], 'class' => (isset($param["markaFilter"]["class"]) ? $param["markaFilter"]["class"] : ""), "url" => (isset($param["markaFilter"]["url"]) ? $param["markaFilter"]["url"] : ''), 'title' => (isset($param['markaFilter']['title'])) ? $param['markaFilter']['title'] : null, 'name' => (isset($param['markaFilter']['name'])) ? $param['markaFilter']['name'] : 'katfild', 'data' => $form->parent(array('sql' => ((isset($param['markaFilter']['sql'])) ? $param['markaFilter']['sql'] : null), 'option' => ((isset($param['markaFilter']['option'])) ? $param['markaFilter']['option'] : array('value' => 'id', 'title' => 'kategori')), 'kat' => ((isset($param['markaFilter']['kat'])) ? $param['markaFilter']['kat'] : null), 'selected' => ((isset($filterp)) ? $filterp : '')), 0, 0)));
                echo "</div>";
            endif;

            if (isset($param['flitpageceviri']) and is_array($param['flitpageceviri'])) {
                echo ' <div class="col-md-3">';
                $form =   new AdminPanel\Form($this->settings);
                echo $form->filter(array( 'class' => (isset($param["flitpageceviri"]["class"]) ? $param["flitpageceviri"]["class"] : ""), "url" => (isset($param["flitpageceviri"]["url"]) ? $param["flitpageceviri"]["url"] : ''), 'title' => (isset($param['flitpageceviri']['title'])) ? $param['flitpageceviri']['title'] : null, 'name' => (isset($param['flitpageceviri']['name'])) ? $param['flitpageceviri']['name'] : 'katfild', 'data' => $form->parent(array('sql' => ((isset($param['flitpageceviri']['sql'])) ? $param['flitpageceviri']['sql'] : null), 'option' => ((isset($param['flitpageceviri']['option'])) ? $param['flitpageceviri']['option'] : array('value' => 'id', 'title' => 'kategori')), 'kat' => ((isset($param['flitpageceviri']['kat'])) ? $param['flitpageceviri']['kat'] : null), 'selected' => $param["selected_cat"]), 0, 0)));
                echo "</div>";
            }

            ?>


            <div class="col-md-3">
                <?
                if (isset($param["search"])) {
                    $place = (isset($param["place"])) ? $param["place"] : "Başlık";
                    ?>


                    <div class="input-group">
                        <input type="text"
                               placeholder="<?=$param["place"]?>"
                               name="kelime"
                               data-url="<?= $pageUrl ?><?= (isset($_GET["sayfa"])) ? '&sayfa=' . $_GET["sayfa"] : '&sayfa=1' ?>"
                               id="kelime" value="<?= (isset($_GET["kelime"])) ? $_GET['kelime'] : '' ?>"
                               class="form-control">

                        <div class="input-group-append">
                            <? if (isset($_GET["kelime"])) { ?>
                                <a href="<?= $this->BaseAdminURL() . "/?cmd=" . $_GET["cmd"] ?>"
                                   class="btn btn-danger"> <i class="fa fa-remove"></i> Aramayı Temizle</a>
                                <br>
                            <? } else { ?>
                                <a href="#" class="btn btn-default" id="araButon">
                                    <i class="fa fa-search"></i> Ara</a>
                            <? } ?>
                        </div>

                    </div>

                    <?
                }
                ?>
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

                        echo 'href="' . ((isset($button['href'])) ? $button['href'] : '').(isset($button["id_enable"]) ? "/&".$button["id_name"]."=".$id: "") . '" id="' . ((isset($button['id'])) ? $button['id'] : '') . '" class="btn-xlg  ' . ((isset($button['class'])) ? $button['class'] : '') . ' pull-right"> <i class="' . ((isset($button['icon'])) ? $button['icon'] : 'fa fa-plus') . '"></i> ' . ((isset($button['title'])) ? $button['title'] : '') . '
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
                <? if (isset($param["tools"])): ?>
                    <th style="width: 5%">Araçlar</th>
                <? endif; ?>
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
                                    elseif(isset($p["type"])  and $p["type"] == "bulten_title" ){
                                        echo '<img src="'.$this->ThemeFile().'/assets/flags/'.$pdata["dil"].'.png" style="width:15px; height:auto;vertical-align: initial; margin-right:5px;">'.$this->temizle($pdata["baslik"]);
                                    }

                                    elseif($p["dataTitle"] == "baslik"){
                                         if($param["page"] == 'kurskayit'){
                                             echo '<img src="' . $this->ThemeFile() . '/assets/flags/'.$pdata['dil'].'.png" style="width:15px; height:auto;vertical-align: initial; margin-right:5px;">' . $this->temizle($pdata["baslik"]);
                                         }elseif($param['page'] == 'uzmankayit'){
                                             echo '<img src="' . $this->ThemeFile() . '/assets/flags/'.$pdata['dil'].'.png" style="width:15px; height:auto;vertical-align: initial; margin-right:5px;">' . $this->temizle($pdata["baslik"]);
                                         }
                                         else {
                                             $disable_page = array('moduller', 'ayar', 'kullanici', 'bulten', 'anket');
                                             if (!in_array($param["page"], $disable_page)) {
                                                 $master_id = $pdata["id"];
                                                 $table = $param["page"] . "_lang";
                                                 $kosul = " WHERE baslik <> '' ";
                                                 if ($this->getUserType() != 1) {
                                                     $kosul .= " and sil <> 1";
                                                 }

                                                 foreach ($this->settings->lang('lang') as $dil => $title) {
                                                     if ($dil == 'tr') {
                                                         echo '<img src="' . $this->ThemeFile() . '/assets/flags/tr.png" style="width:15px; height:auto;vertical-align: initial; margin-right:5px;">' . $this->temizle($pdata["baslik"]);
                                                     } else {
                                                         $dt = $this->dbConn->sorgu("SELECT * FROM $table $kosul and dil = '" . $dil . "' and master_id = " . $master_id);
                                                         if (is_array($dt)):
                                                             foreach ($dt as $a) {
                                                                 echo '<br><img src="' . $this->ThemeFile() . '/assets/flags/' . $dil . '.png" style="width:15px; height:auto;vertical-align: initial; margin-right:5px;">' . $this->temizle($a["baslik"]);
                                                             }
                                                         endif;
                                                     }
                                                 }
                                             } else {
                                                 echo '<img src="' . $this->ThemeFile() . '/assets/flags/tr.png" style="width:15px; height:auto;vertical-align: initial; margin-right:5px;">' . $this->temizle($pdata["baslik"]);
                                             }
                                         }

                                    }

                                    elseif(isset($p["type"])  and $p["type"] == "project_type" ){
                                        if ($pdata["durum"] == 1){
                                            echo "Devam Eden Projeler";
                                        }
                                        else {
                                            echo "Tamamlanan Projeler";
                                        }
                                    }

                                    elseif(isset($p["type"])  and $p["type"] == "bulten_url" ){
                                        echo $this->BaseURL("bulten.html/".$pdata["dil"]."/".$pdata["id"]).'<a href="'.$this->BaseURL("bulten.html/".$pdata["dil"]."/".$pdata["id"]).'" target="_blank"><span class="ml-10 badge badge-cyan"><i class="fa fa-eye"></i></span></a> ';
                                    }

                                    elseif(isset($p["type"]) and $p["type"] == "fiyat"){
                                        echo "<span ".((isset($p["labelClass"]) && $p["labelClass"] != "") ? "class='".$p["labelClass"]."'" : "").">";
                                        echo $this->fiyatAl($pdata[$p["dataTitle"]])." TL";
                                        echo "</span>";
                                    }

                                    elseif(isset($p["dataYeni"]) and $p["dataYeni"] != ""){
                                        echo $this->temizle($pdata[$p['dataTitle']]).((isset($p["ek"])) ? " - ".$pdata[$p["ek"]] : "");
                                        if ($pdata[$p["dataYeni"]] == 1){
                                            echo " <span style='margin-left:10px; padding:5px 10px; font-size: 12px;' class='label label-danger'>YENİ</span>";
                                        }
                                    }

                                    elseif(isset($p["type"]) and $p["type"] == "user_type"){

                                        if ($pdata["tur"] == 2){
                                            echo "Kurumsal";
                                        }
                                        else {
                                            echo "Bireysel";
                                        }
                                    }


                                    elseif(isset($p["type"]) and $p["type"] == "oturum"){
                                        $gecerli = $this->user_id;
                                        echo $this->temizle($pdata[$p['dataTitle']]).((isset($p["ek"])) ? " - ".$pdata[$p["ek"]] : "");
                                        if ($pdata["id"] == $gecerli){
                                            echo " <span style='margin-left:10px; padding:5px 10px; font-size: 12px;' class='label label-danger'>Aktif Oturum</span>";
                                        }
                                    }


                                    elseif(isset($p["type"]) and $p["type"] == "icon"){

                                        echo "<div align='center' class='font-size-30'><i class='".$pdata[$p["dataTitle"]]."'></i></div>";

                                    }

                                    elseif(isset($p["type"]) and $p["type"] == "kursDurum"){
                                        $detail = $this->settings->config('kurs_type')[$pdata['durum']-1];
                                        $text = $detail['text'];
                                        switch ($pdata['durum']-1):
                                            case '0':
                                                $label = 'default';
                                                break;
                                            case '1':
                                                $label = 'warning';
                                                break;
                                            case '2':
                                                $label = 'info';
                                                break;
                                            endswitch;
                                        echo " <span style='margin-left:10px; padding:5px 10px; font-size: 12px;' class='label label-".$label."'>".$text."</span>";
                                    }

                                    elseif(isset($p["type"]) and $p["type"] == "kursTarih"){

                                        echo "<span class=' ' style='cursor:inherit'><i class='mdi mdi-calendar-clock' style='margin-right: 7px;'></i>".$pdata['baslangic'].'</span><br>';
                                        echo "<span class=' ' style='cursor:inherit'><i class='mdi mdi-calendar-clock' style='margin-right: 7px;'></i>".$pdata['bitis'].'</span>';

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
                                            echo   '<td align="'.((isset($but["align"]) && $but["align"] != "") ? $but["align"] : "").'"><a href="'.((isset($but['url']) ? $but['url'] :'')).((!isset($but["urlEkle"])) ? $pdata['id'] : $this->temizle($pdata[$but["urlEkle"]])).((isset($but["modul"])) ? "&type=".$but["modul"] : "").((isset($but["file_type"])) ? "&file_type=".$but["file_type"] : "").((isset($but["lang"])) ? "&lang=".$but["lang"] : "").((isset($but["resim_tur"])) ? "&resim_tur=".$but["resim_tur"] : '').'" class="'.((isset($but["disable_delete"])) ? ($pdata[$this->silColumn]) ? "disabled " : " " : " ").((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but["data-icon"])) ? "<i class='".$but["data-icon"]."' style='margin-right:7px;'></i>" : "").((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                            break;

                                        case 'detay':
                                            echo   '<td align="'.((isset($but["align"]) && $but["align"] != "") ? $but["align"] : "").'"><a  href="'.$this->BaseURL('ajax/kayitDetay.html?type='.$param['page'].'&id='.$pdata['id'], 'tr').'" data-id="'.$pdata['id'].'" target="_blank" class=" kayitDetailBtn'.((isset($but["disable_delete"])) ? ($pdata[$this->silColumn]) ? "disabled " : " " : " ").((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but["data-icon"])) ? "<i class='".$but["data-icon"]."' style='margin-right:7px;'></i>" : "").((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                            break;

                                        case 'modalButton':
                                            echo   '<td  align="'.((isset($but["align"]) && $but["align"] != "") ? $but["align"] : "").'"><a data-id="'.$pdata["id"].'" class="'.((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but["data-icon"])) ? "<i class='".$but["data-icon"]."' style='margin-right:7px;'></i>" : "").((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                            break;

                                    endswitch;
                            endforeach;

                        endif;

                        if (isset($param["tools"])):
                        $wd = ($param["page"] == "uyeler") ? "8%" : "5%";
                        echo'<td width="'.$wd.'">';


                            foreach($param['tools'] as $tool):
                                echo' <a   '.(($param["page"] == "uyeler") ? "data-tur='".$pdata["tur"]."'" : "").((isset($tool["modal"])) ? "data-toggle='modal' data-target='".$tool["url"]."'" : "").'  data-toggle="tooltip" data-page="'.$param["page"].'" data-id="'.$pdata["id"].'" data-placement="top" title="'.((isset($tool['title'])) ? $tool['title']: '').'" href="'.((isset($tool['url'])) ? $tool['url'].((isset($tool["disable_id"])) ? "" : $pdata['id']) : 'javascript:;').'" data-id="'.((isset($tool["disable_id"])) ? "" : $pdata["id"]).'" class="toolsButton btn btn-sm '.((isset($tool["disable_delete"])) ? ($pdata[$this->silColumn]) ? "disabled " : " " : " ").((isset($tool['color'])) ? $tool['color']: '').'">
                            <i class="'.((isset($tool['icon'])) ? $tool['icon']: '').'"></i></a>';

                            endforeach;





                        echo '</td>';
                        endif;
                        echo '</tr>';
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
        <?
        if (isset($param["showing"])){
            ?>
            <strong style="line-height: 42px;" class="float-left mr-50"><?=$param["showing"]?></strong>
        <? } ?>

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

