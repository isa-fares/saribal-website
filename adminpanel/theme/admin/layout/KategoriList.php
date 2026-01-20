<?
$tum = (isset($_GET["limit"])) ? $_GET["limit"] : "";

$pageUrl = $this->BaseAdminURL()."/?cmd=".$_GET["cmd"].((isset($param["kat_id"])) ? "&kat=".$param["kat_id"] : '');

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

                <div class="row">

                    <strong class="mr-10 ml-10"><h5 class="mb-0" style="margin-top:8px;">Filtrele</h5></strong>
                    <?
                    if (isset($param["flitpage"])) {
                        ?>

                        <div class="col-md-3">
                            <?
                            if (isset($param['flitpage']) and is_array($param['flitpage'])) {
                                $filterp = $param["id"];
                                $form = new AdminPanel\Form($this->settings);
                                echo $form->filter(array("title" => $param["flitpage"]["title"], 'class' => (isset($param["flitpage"]["class"]) ? $param["flitpage"]["class"] : ""), "url" => (isset($param["flitpage"]["url"]) ? $param["flitpage"]["url"] : ''), 'title' => (isset($param['flitpage']['title'])) ? $param['flitpage']['title'] : null, 'name' => (isset($param['flitpage']['name'])) ? $param['flitpage']['name'] : 'katfild', 'data' => $form->parent(array('sql' => ((isset($param['flitpage']['sql'])) ? $param['flitpage']['sql'] : null), 'option' => ((isset($param['flitpage']['option'])) ? $param['flitpage']['option'] : array('value' => 'id', 'title' => 'kategori')), 'kat' => ((isset($param['flitpage']['kat'])) ? $param['flitpage']['kat'] : null), 'selected' => ((isset($filterp)) ? $filterp : '')), 0, 0)));
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

                                echo 'href="' . ((isset($button['href'])) ? $button['href'] : '') . '" id="' . ((isset($button['id'])) ? $button['id'] : '') . '" class="btn-xlg  ' . ((isset($button['class'])) ? $button['class'] : '') . ' pull-right"> <i class="' . ((isset($button['icon'])) ? $button['icon'] : 'fa fa-plus') . '"></i> ' . ((isset($button['title'])) ? $button['title'] : '') . '
            </a>';

                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>






            </div>



            <div class="box-content">

                <table data-reload="1" class="table mb-0 table-bordered table-hover <?=(!isset($param["disableSortable"])) ? "sorted_table" : ""?>" data-page="<?=$sayfa?>" id="<?=((!isset($param["disableSortable"])) ? "sortable" : "")?>" <?=((isset($param['page'])) ? 'data-id="'.$param['page'].'"':null)?>>
                    <thead>
                    <tr class="bb-3 theme-border-color">
                        <?
                        if ($tum == "all"){
                            ?>
                            <th class="resimBlok" width="1%" align="center"> Sırala</th>
                        <? } ?>
                        <?
                        if (isset($param["resim"]) && $param["resim"]){
                            ?>

                            <th class="resimBlok" width="2%"> Resim</th>

                        <? } ?>

                        <?php
                        if(isset($param['baslik']) and is_array($param['baslik']))
                            foreach($param['baslik'] as $baslik):
                                echo'
                        <th  style="'.((isset($baslik['width']) ? 'width:'.$baslik['width'].';':'')).'" class="'.((isset($baslik["align"])) ? " text-".$baslik["align"] : '').'"> '.$baslik['title'].' </th>';
                            endforeach;
                        ?>
                        <th style="width: 3%">Araçlar</th>
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


                                echo'<tr  data-sil="'.$pdata[$this->silColumn].'"'.((isset($pdata['id'])) ? 'data-id="'.$pdata['id'].'"':null).' class="'.(($pdata[$this->silColumn]) == 1 ? "bg-pale-danger" : "").((isset($param["tr_class"]) && $param["tr_class"] != "") ? $param["tr_class"]."_".$pdata[$param["tr_class"]]." " : "").(($pdata[$this->silColumn]) != 1 ? "durum_".$pdata[$this->aktifColumn] : "").'">';

                                if ($tum == "all") {
                                    echo "<td  align='center' valign='middle' style='padding:0px;'><i class='ti-split-v move'></i> </td>";
                                }

                                if (isset($param["resim"]) && $param["resim"]){
                                    $resim = $pdata["resim"];
                                    $dizin = "../".$this->settings->config('folder').$param["page"]."/";

                                    if (!empty($resim)){

                                        $baseURL = $this->baseURL();
                                        $siteURL = (($_SERVER["SERVER_PORT"] == 80) ? "http://" : "https://").$_SERVER["SERVER_NAME"]."/";
                                        if ($baseURL != $siteURL){
                                            $resAl = $this->resimal(0,40,$resim,"../".$this->settings->config('folder').$param["page"]."/");
                                        }else {
                                            $resAl = @$this->BaseURL($this->resimal(0,40,$resim,$dizin));
                                        }


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


                                                echo "<span ".((isset($p["labelClass"]) && $p["labelClass"] != "") ? "class='".$p["labelClass"]."'" : "").">";
                                                echo $this->temizle($pdata[$p['dataTitle']]).((isset($p["ek"])) ? " - ".$pdata[$p["ek"]] : "");
                                                echo "</span>";


                                        }

                                        ?>



                                        <?


                                        echo '</td>';
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



                                                case 'button':
                                                    echo  '<td><a href="'.((isset($but['url']) ? $but['url'] :'')).'&folder='.((isset($but['folder']) ? base64_encode($but['folder']) :'')).'&modul='.((isset($but['modul']) ? $but['modul'] :'')).'&gelenid='.((isset($pdata['id']))? $pdata['id']:null).'" class="dosya fancybox.iframe '.((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                                    ;
                                                    break;

                                                case 'button2':
                                                    echo   '<td align="'.((isset($but["align"]) && $but["align"] != "") ? $but["align"] : "").'"><a href="'.((isset($but['url']) ? $but['url'] :'')).((!isset($but["urlEkle"])) ? $pdata['id'] : $this->temizle($pdata[$but["urlEkle"]])).((isset($but["modul"])) ? "&type=".$but["modul"] : "").((isset($but["file_type"])) ? "&file_type=".$but["file_type"] : "").((isset($but["resim_tur"])) ? "&resim_tur=".$but["resim_tur"] : '').'" class="'.((isset($but["disable_delete"])) ? ($pdata[$this->silColumn]) ? "disabled " : " " : " ").((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but["data-icon"])) ? "<i class='".$but["data-icon"]."' style='margin-right:7px;'></i>" : "").((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                                    break;

                                        endswitch;
                                    endforeach;
                                endif;



                                echo'<td width="3%">';

                                foreach($param['tools'] as $tool):
                                    echo' <a   '.(($param["page"] == "uyeler") ? "data-tur='".$pdata["tur"]."'" : "").((isset($tool["modal"])) ? "data-toggle='modal' data-target='".$tool["url"]."'" : "").'  data-toggle="tooltip" data-page="'.$param["page"].'" data-id="'.$pdata["id"].'" data-placement="top" title="'.((isset($tool['title'])) ? $tool['title']: '').'" href="'.((isset($tool['url'])) ? $tool['url'].((isset($tool["disable_id"])) ? "" : $pdata['id']) : 'javascript:;').'" class="toolsButton btn btn-sm '.((isset($tool["disable_delete"])) ? ($pdata[$this->silColumn]) ? "disabled " : " " : " ").((isset($tool['color'])) ? $tool['color']: '').'">
                        <i class="'.((isset($tool['icon'])) ? $tool['icon']: '').'"></i></a>';

                                endforeach;

                                echo '</td></tr>';

                                $where = " WHERE ustu = ".$pdata["id"];
                                if ($this->user_type != 1){
                                    $where.=" and ".$this->silColumn." <> 1";
                                }

                                $alt = $this->dbConn->sorgu("SELECT * FROM ".$param["page"]." ".$where." ORDER BY sira ASC");


                                        if (is_array($alt) && !isset($_GET["kelime"])){
                                            foreach ($alt as $a_item){
                                                echo'<tr style="background-color:#fff;"  data-sil="'.$a_item[$this->silColumn].'"'.((isset($a_item['id'])) ? 'data-id="'.$a_item['id'].'"':null).' class="unsortable '.(($a_item[$this->silColumn]) == 1 ? "bg-pale-danger" : "").((isset($param["tr_class"]) && $param["tr_class"] != "") ? $param["tr_class"]."_".$a_item[$param["tr_class"]]." " : "").(($a_item[$this->silColumn]) != 1 ? "durum_".$a_item[$this->aktifColumn] : "").'">';

                                                if ($tum == "all") {
                                                    echo "<td  align='center' valign='middle' style='padding:0px;'>&nbsp;</td>";
                                                }

                                                foreach ($param["p"] as $p){

                                                    if (is_array($p)){

                                                        echo'<td  class="'.((isset($p['class'])) ? $p['class'] : '').'" tabindex="'.((isset($p['tabindex'])) ? $p['tabindex'] : '').'" data-itemsayfa="'.$sayfa.'">';

                                                        if (isset($p["dataTitle"])){

                                                            echo "<i class='fa fa-level-up flipH ml-15 mr-10'></i>";
                                                            echo "<span ".((isset($p["labelClass"]) && $p["labelClass"] != "") ? "class='".$p["labelClass"]."'" : "").">";
                                                            echo $this->temizle($a_item[$p['dataTitle']]).((isset($p["ek"])) ? " - ".$a_item[$p["ek"]] : "");
                                                            echo "</span>";


                                                        }


                                                        echo '</td>';
                                                    }


                                                }


                                            if(isset($param['buton']) and is_array($param['buton'])):
                                                foreach($param['buton'] as $but):

                                                    if(isset($but['type']))
                                                        switch($but['type']):
                                                            case 'radio':

                                                                echo '<td style="width: 5%" align="center">';

                                                                if ($a_item[$this->silColumn] != 1) {
                                                                    echo '<button type="button" class="btn btn-lg btn-toggle ' . ((isset($a_item[$but['dataname']]) and $a_item[$but['dataname']] == 1) ? 'active' : '') . '" onclick="$.panel.durum(this,\'' . ((isset($pdata['id']) ? $a_item['id'] : 0)) . '\',\'' . ((isset($but['url'])) ? $but['url'] : null) . '\')" data-toggle="button" aria-pressed="true"><span class="handle"></span></button>';
                                                                }
                                                                else {
                                                                    echo '<span class="label label-danger">Silinmiş</span>';
                                                                }

                                                                echo "</td>";

                                                                break;



                                                            case 'button':
                                                                echo  '<td><a href="'.((isset($but['url']) ? $but['url'] :'')).'&folder='.((isset($but['folder']) ? base64_encode($but['folder']) :'')).'&modul='.((isset($but['modul']) ? $but['modul'] :'')).'&gelenid='.((isset($a_item['id']))? $a_item['id']:null).'" class="dosya fancybox.iframe '.((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                                                ;
                                                                break;

                                                            case 'button2':
                                                                echo   '<td align="'.((isset($but["align"]) && $but["align"] != "") ? $but["align"] : "").'"><a href="'.((isset($but['url']) ? $but['url'] :'')).((!isset($but["urlEkle"])) ? $a_item['id'] : $this->temizle($a_item[$but["urlEkle"]])).((isset($but["modul"])) ? "&type=".$but["modul"] : "").((isset($but["resim_tur"])) ? "&resim_tur=".$but["resim_tur"] : '').'" class="'.((isset($but["disable_delete"])) ? ($a_item[$this->silColumn]) ? "disabled " : " " : " ").((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but["data-icon"])) ? "<i class='".$but["data-icon"]."' style='margin-right:7px;'></i>" : "").((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                                                break;



                                                        endswitch;
                                                endforeach;

                                            endif;

                                                 echo'<td width="5%">';

                                foreach($param['tools'] as $tool):
                                    echo' <a   '.(($param["page"] == "uyeler") ? "data-tur='".$a_item["tur"]."'" : "").((isset($tool["modal"])) ? "data-toggle='modal' data-target='".$tool["url"]."'" : "").'  data-toggle="tooltip" data-page="'.$param["page"].'" data-id="'.$a_item["id"].'" data-placement="top" title="'.((isset($tool['title'])) ? $tool['title']: '').'" href="'.((isset($tool['url'])) ? $tool['url'].((isset($tool["disable_id"])) ? "" : $a_item['id']) : 'javascript:;').'" class="toolsButton btn btn-sm '.((isset($tool["disable_delete"])) ? ($a_item[$this->silColumn]) ? "disabled " : " " : " ").((isset($tool['color'])) ? $tool['color']: '').'">
                        <i class="'.((isset($tool['icon'])) ? $tool['icon']: '').'"></i></a>';

                                endforeach;
                                echo '</td>';

                                ?>

                                </tr>

                                        <?php
                                            $where1 = " WHERE ustu = ".$a_item["id"];
                                            if ($this->user_type != 1){
                                                $where1.=" and ".$this->silColumn." <> 1";
                                            }
                                            $e_alt = $this->dbConn->sorgu("SELECT * FROM ".$param["page"]." ".$where1." ORDER BY sira ASC");
                                            if (is_array($e_alt) && empty($id) && !isset($_GET["kelime"])) {
                                                foreach ($e_alt as $alt_item) {
                                                    echo'<tr style="background-color:#fff;"  data-sil="'.$a_item[$this->silColumn].'"'.((isset($alt_item['id'])) ? 'data-id="'.$alt_item['id'].'"':null).' class="unsortable '.(($alt_item[$this->silColumn]) == 1 ? "bg-pale-danger" : "").((isset($param["tr_class"]) && $param["tr_class"] != "") ? $param["tr_class"]."_".$alt_item[$param["tr_class"]]." " : "").(($alt_item[$this->silColumn]) != 1 ? "durum_".$alt_item[$this->aktifColumn] : "").'">';

                                                        if ($tum == "all") {
                                                            echo "<td  align='center' valign='middle' style='padding:0px;'>&nbsp;</td>";
                                                        }

                                                    foreach ($param["p"] as $p){

                                                        if (is_array($p)){

                                                            echo'<td  class="'.((isset($p['class'])) ? $p['class'] : '').'" tabindex="'.((isset($p['tabindex'])) ? $p['tabindex'] : '').'" data-itemsayfa="'.$sayfa.'">';

                                                            if (isset($p["dataTitle"])){

                                                                echo "<i class='fa fa-circle flipH ml-40 mr-10' style='font-size: 6px;'></i>";
                                                                echo "<span ".((isset($p["labelClass"]) && $p["labelClass"] != "") ? "class='".$p["labelClass"]."'" : "").">";
                                                                echo $this->temizle($alt_item[$p['dataTitle']]).((isset($p["ek"])) ? " - ".$alt_item[$p["ek"]] : "");
                                                                echo "</span>";


                                                            }


                                                            echo '</td>';
                                                        }


                                                    }


                                                    if(isset($param['buton']) and is_array($param['buton'])):
                                                        foreach($param['buton'] as $but):

                                                            if(isset($but['type']))
                                                                switch($but['type']):
                                                                    case 'radio':

                                                                        echo '<td style="width: 5%" align="center">';

                                                                        if ($alt_item[$this->silColumn] != 1) {
                                                                            echo '<button type="button" class="btn btn-lg btn-toggle ' . ((isset($alt_item[$but['dataname']]) and $alt_item[$but['dataname']] == 1) ? 'active' : '') . '" onclick="$.panel.durum(this,\'' . ((isset($alt_item['id']) ? $alt_item['id'] : 0)) . '\',\'' . ((isset($but['url'])) ? $but['url'] : null) . '\')" data-toggle="button" aria-pressed="true"><span class="handle"></span></button>';
                                                                        }
                                                                        else {
                                                                            echo '<span class="label label-danger">Silinmiş</span>';
                                                                        }

                                                                        echo "</td>";

                                                                        break;



                                                                    case 'button':
                                                                        echo  '<td><a href="'.((isset($but['url']) ? $but['url'] :'')).'&folder='.((isset($but['folder']) ? base64_encode($but['folder']) :'')).'&modul='.((isset($but['modul']) ? $but['modul'] :'')).'&gelenid='.((isset($alt_item['id']))? $alt_item['id']:null).'" class="dosya fancybox.iframe '.((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                                                        ;
                                                                        break;

                                                                    case 'button2':
                                                                        echo   '<td align="'.((isset($but["align"]) && $but["align"] != "") ? $but["align"] : "").'"><a href="'.((isset($but['url']) ? $but['url'] :'')).((!isset($but["urlEkle"])) ? $alt_item['id'] : $this->temizle($alt_item[$but["urlEkle"]])).((isset($but["modul"])) ? "&type=".$but["modul"] : "").((isset($but["resim_tur"])) ? "&resim_tur=".$but["resim_tur"] : '').'" class="'.((isset($but["disable_delete"])) ? ($alt_item[$this->silColumn]) ? "disabled " : " " : " ").((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but["data-icon"])) ? "<i class='".$but["data-icon"]."' style='margin-right:7px;'></i>" : "").((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                                                        break;



                                                                endswitch;
                                                        endforeach;

                                                    endif;

                                                    echo'<td width="5%">';

                                                    foreach($param['tools'] as $tool):
                                                        echo' <a   '.(($param["page"] == "uyeler") ? "data-tur='".$alt_item["tur"]."'" : "").((isset($tool["modal"])) ? "data-toggle='modal' data-target='".$tool["url"]."'" : "").'  data-toggle="tooltip" data-page="'.$param["page"].'" data-id="'.$alt_item["id"].'" data-placement="top" title="'.((isset($tool['title'])) ? $tool['title']: '').'" href="'.((isset($tool['url'])) ? $tool['url'].((isset($tool["disable_id"])) ? "" : $alt_item['id']) : 'javascript:;').'" class="toolsButton btn btn-sm '.((isset($tool["disable_delete"])) ? ($alt_item[$this->silColumn]) ? "disabled " : " " : " ").((isset($tool['color'])) ? $tool['color']: '').'">
                        <i class="'.((isset($tool['icon'])) ? $tool['icon']: '').'"></i></a>';

                                                    endforeach;
                                                    echo '</td></tr>';

                                                }
                                            }
                                         }


                                    echo "</td></tr>";
                                }



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

