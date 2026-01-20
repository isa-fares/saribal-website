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

$ex = explode('/',$_GET["cmd"]);
if (isset($ex[2])) $id = $ex[2];

$table = $param["page"];

$now = date("Y-m-d H:i:s");

$filterType = (isset($_GET["type"])) ? $_GET["type"] : "";



?>
<?
    if (isset($param["flitpage"]) || isset($param["search"])) {
?>

        <div class="row filterType">

            <div class="col-md-2">
                <a href="<?= $this->BaseAdminURL() . "/?cmd=" . "Kurslar"?>">
                    <div class="box box-inverse box-warning pull-up  <?=($filterType == "") ? "active" : ""?>">
                        <div class="box-body text-center">
                            <h6 class="text-white ">TÜM EĞİTİMLER</h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-10">
                <div class="row">

                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="<?= $this->BaseAdminURL() . "/?cmd=" . "Kurslar" . "&type=1" ?>">
                            <div class="box box-inverse box-info pull-up <?=($filterType == "1") ? "active" : ""?>">
                                <div class="box-body text-center">
                                    <h6 class="text-white ">SÜREN EĞİTİMLER</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="<?= $this->BaseAdminURL() . "/?cmd=" . "Kurslar" . "&type=2" ?>">
                            <div class="box box-success box-inverse pull-up <?=($filterType == "2") ? "active" : ""?>">
                                <div class="box-body text-center">
                                    <h6 class="text-white ">SATIŞTAKİ EĞİTİMLER</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="<?= $this->BaseAdminURL() . "/?cmd=" . "Kurslar" . "&type=3" ?>">
                            <div class="box box-inverse box-danger pull-up <?=($filterType == "3") ? "active" : ""?>">
                                <div class="box-body text-center">
                                    <h6 class="text-white ">PLANLANAN EĞİTİMLER</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="<?= $this->BaseAdminURL() . "/?cmd=" . "Kurslar" . "&type=4" ?>">
                            <div class="box box-inverse box-dark pull-up <?=($filterType == "4") ? "active" : ""?>">
                                <div class="box-body text-center">
                                    <h6 class="text-white ">TAMAMLANAN EĞİTİMLER</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

            </div>



        </div>

<div class="box <?=((isset($id) || isset($_GET["kelime"])) ? "" : "box-slided-up")?>">
    <div class="box-header with-border">
        <h5 class="box-title">Filtreleme Seçenekleri</h5>
        <ul class="box-controls pull-right">
            <li><a class="box-btn-slide" href="#"></a></li>
        </ul>
    </div>
    <div class="box-content">
        <div class="box-body" style="padding:5px 16px;">
            <div class="row">
                <div class="col-md-3">
                    <?
                    if (isset($param['flitpage']) and is_array($param['flitpage'])) {
                        $filterp = $param["id"];
                        $form = new AdminPanel\Form($this->settings);
                        echo $form->filter(array("title" => $param["flitpage"]["title"], 'class' => (isset($param["flitpage"]["class"]) ? $param["flitpage"]["class"] : ""), "url" => (isset($param["flitpage"]["url"]) ? $param["flitpage"]["url"] : ''), 'title' => (isset($param['flitpage']['title'])) ? $param['flitpage']['title'] : null, 'name' => (isset($param['flitpage']['name'])) ? $param['flitpage']['name'] : 'katfild', 'data' => $form->parent(array('sql' => ((isset($param['flitpage']['sql'])) ? $param['flitpage']['sql'] : null), 'option' => ((isset($param['flitpage']['option'])) ? $param['flitpage']['option'] : array('value' => 'id', 'title' => 'kategori')), 'kat' => ((isset($param['flitpage']['kat'])) ? $param['flitpage']['kat'] : null), 'selected' => ((isset($filterp)) ? $filterp : '')), 0, 0)));
                    }
                    ?>
                </div>
                <div class="col-md-6">

                </div>

                <div class="col-md-3">
                    <?
                    if (isset($param["search"])) {
                        $place = (isset($param["place"])) ? $param["place"] : "Başlık";
                        ?>

                        <div class="input-group">
                            <input type="text"
                                   placeholder="<?= (isset($param["place"]) ? $param["place"] : "") ?>"
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
                                    <a href="#" class="btn btn-default" id="araButon"><i
                                                class="fa fa-search"></i> Ara</a>
                                <? } ?>
                            </div>
                        </div>
                        <?
                    }
                    ?>
                </div>
            </div>


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
                if (isset($_GET["limit"]) && $_GET["limit"] == "all"){
                    $limitIcon = "mdi-format-list-numbers";
                    $limitText = "Sayfa";
                    $limitUrl = "";
                }
                else {
                    $limitIcon = "mdi-crop-free";
                    $limitText = "Tümü";
                    $limitUrl = "&limit=all";
                }
            ?>
            <a href="<?=$pageUrl.$limitUrl?>" class="btn-xlg btn btn-info pull-right" style="margin-left: 15px;"><i class="mdi <?=$limitIcon?>"></i> <?=$limitText?> </a>
            <?
            if(isset($param['button']) and is_array($param['button'])):

                foreach($param['button'] as $button):

                    echo'<a ';
                    if(isset($button['data']) and is_array($button['data']))
                        foreach ($button['data'] as $key=>$value):
                            echo "data-".$key.'="'.$value.'"';
                        endforeach;

                    echo'href="'.((isset($button['href'])) ? $button['href'] : '').'" id="'.((isset($button['id'])) ? $button['id'] : '').'" class="btn-xlg  '.((isset($button['class'])) ? $button['class'] : '').' pull-right"> <i class="'.((isset($button['icon'])) ? $button['icon'] : 'fa fa-plus').'"></i> '.((isset($button['title'])) ? $button['title'] : '').'
                    </a>';

                endforeach;
            endif;
            ?>

        </div>

    </div>



    <div class="box-content">

            <table class="table table-striped table-bordered table-hover sorted_table" data-page="<?=$sayfa?>" id="<?=((!isset($param["disableSortable"])) ? "sortable" : "")?>" <?=((isset($param['page'])) ? 'data-id="'.$param['page'].'"':null)?>>
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
                    <th style="width: 7%">Araçlar</th>
                </tr>
                </thead>

                <tbody>

                <?php

                if(isset($param['p']) and is_array($param['p'])):
                    if(isset($param['pdata']) and is_array($param['pdata'])):
                        foreach($param['pdata'] as $pdata):


                            echo'<tr data-sil="'.$pdata[$this->silColumn].'"'.((isset($pdata['id'])) ? 'data-id="'.$pdata['id'].'"':null).' class="'.(($pdata[$this->silColumn]) == 1 ? "bg-pale-danger" : "").((isset($param["tr_class"]) && $param["tr_class"] != "") ? $param["tr_class"]."_".$pdata[$param["tr_class"]] : "").(($pdata[$this->silColumn]) != 1 ? "durum_".$pdata[$this->aktifColumn] : "").'">';

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

                                        if (isset($p["type"]) and $p["type"] == "date"){
                                            echo "<span ".((isset($p["labelClass"]) && $p["labelClass"] != "") ? "class='".$p["labelClass"]."'" : "")." style='cursor:inherit'>";
                                            echo "<i class='mdi mdi-calendar-clock' style='margin-right: 7px;'></i>".date($p["dateFormat"],strtotime($pdata[$p['dataTitle']]));
                                            echo "</span>";
                                        }

                                        elseif(isset($p["type"]) and $p["type"] == "fiyat"){
                                            echo "<span ".((isset($p["labelClass"]) && $p["labelClass"] != "") ? "class='".$p["labelClass"]."'" : "").">";
                                            echo $this->fiyatAl($pdata[$p["dataTitle"]])." <i class='fa fa-try'></i>";
                                            echo "</span>";
                                        }
                                        elseif(isset($p["dataYeni"]) and $p["dataYeni"] != ""){
                                            echo $this->temizle($pdata[$p['dataTitle']]).((isset($p["ek"])) ? " - ".$pdata[$p["ek"]] : "");
                                            if ($pdata[$p["dataYeni"]] == 1){
                                                echo " <span style='margin-left:10px; padding:5px 10px; font-size: 12px;' class='label label-danger'>YENİ</span>";
                                            }
                                        }


                                        elseif(isset($p["type"]) and $p["type"] == "kontenjan"){
                                            $url = $this->BaseAdminURL("Siparis&filter=true&user_id=&kurs_id=".$pdata["id"]."&islem=2");
                                            echo "<a href='$url'>";
                                            echo "<span ".((isset($p["labelClass"]) && $p["labelClass"] != "") ? "class='".$p["labelClass"]."'" : "").">";
                                            echo $this->temizle($pdata[$p['dataTitle']]).((isset($p["ek"])) ? $p["ek"]["seperator"].$pdata[$p["ek"]["data"]] : "");
                                            echo "</span></a>";

                                        }

                                        else {
                                            echo "<span ".((isset($p["labelClass"]) && $p["labelClass"] != "") ? "class='".$p["labelClass"]."'" : "").">";
                                            echo $this->temizle($pdata[$p['dataTitle']]).((isset($p["ek"])) ? $p["ek"]["seperator"].$pdata[$p["ek"]["data"]] : "");
                                            if ($p["dataTitle"] == "baslik"){
                                                if ($pdata["kod"] != "") {
                                                    echo " - <span style='font-size: 12px;'>(" . $this->temizle($pdata["kod"]) . ")</span>";
                                                }
                                            }
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
                                                echo   '<td align="'.((isset($but["align"]) && $but["align"] != "") ? $but["align"] : "").'"><a   href="'.((isset($but['url']) ? $but['url'] :'')).((!isset($but["urlEkle"])) ? $pdata['id'] : $this->temizle($pdata[$but["urlEkle"]])).((isset($but["modul"])) ? "&type=".$but["modul"] : "").((isset($but["resim_tur"])) ? "&resim_tur=".$but["resim_tur"] : '').'" class="'.((isset($but["disable_delete"])) ? ($pdata[$this->silColumn]) ? "disabled " : " " : " ").((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but["data-icon"])) ? "<i class='".$but["data-icon"]."' style='margin-right:7px;'></i>" : "").((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                                break;

                                        endswitch;
                                endforeach;

                            endif;

                            echo'<td width="10%">';

                            foreach($param['tools'] as $tool):
                                echo' <a data-toggle="tooltip" data-page="'.$param["page"].'" data-placement="top"  data-id="'.$pdata["id"].'" title="'.((isset($tool['title'])) ? $tool['title']: '').'" href="'.((isset($tool['url'])) ? $tool['url'].((isset($tool["disable_id"])) ? "" : $pdata['id']) : 'javascript:;').'" class="btn btn-sm '.((isset($tool["disable_delete"])) ? ($pdata[$this->silColumn]) ? "disabled " : " " : " ").((isset($tool['color'])) ? $tool['color']: '').'">
                        <i class="'.((isset($tool['icon'])) ? $tool['icon']: '').'"></i></a>';

                            endforeach;
                            echo '<a data-toggle="tooltip" data-id="'.$pdata["id"].'" class="btn btn-info btn-sm ml-3 modalKatilimci" data-title="Katılımcılar" href="#"><i class="mdi mdi-account-star"></i></a>';
                            echo '<a data-toggle="tooltip" data-id="'.$pdata["id"].'" class="btn btn-dark btn-sm ml-3 modalFatura" data-title="Üye Listesi" href="#"><i class="fa fa-table"></i></a>';
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


<div class="modal fade"  id="modalKatilimci" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg "  role="document">
        <div class="modal-content">

            <div class="modal-header bg-secondary">
                <h4 style="margin-bottom: 0; line-height: 30px;">Katılımcı Listesi</h4>

                <div class="pull-right">
                    <a href="#" class="btn btn-sm btn-info emailList"><i class="fa fa-envelope-open"></i> Email Listesini Excele Aktar</a>
                    <a href="#" class="btn btn-sm btn-info ml-5 telefonList"><i class="fa fa-phone"></i> Telefon Numaralarını Excele Aktar</a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-pale-yellow"><th><h5 class="mb-0">Email Listesi</h5></th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <pre class="no-border no-padding  m-0 email"></pre>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-pale-yellow"><th><h5 class="mb-0">Telefon Listesi</h5></th></tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <pre class="no-border no-padding m-0 telefon"></pre>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Kapat</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade"  id="modalFatura" tabindex="-1" role="dialog" >
    <div class="modal-dialog "  role="document" style="width: 90%; max-width: 1200px">
        <div class="modal-content">

            <div class="modal-header bg-secondary">
                <h4 style="margin-bottom: 0; line-height: 30px;">Katılımcı Listesi</h4>

                <div class="pull-right">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

            <div class="modal-body">
                <h4 class="adi"></h4>
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr class="bg-inverse">
                        <th>Firma / Üye Adı</th>
                        <th>Vergi Dairesi</th>
                        <th>Vergi No</th>
                        <th>Adres</th>
                        <th>Katılımcı Sayısı</th>
                        <th width="20%">Açıklama</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Firma / Üye Adı</td>
                        <td>Vergi Dairesi</td>
                        <td>Vergi No</td>
                        <td>Adres</td>
                        <td>Katılımcı Sayısı</td>
                        <td>Açıklama</td>
                    </tr>
                    </tbody>
                </table>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Kapat</button>
            </div>

        </div>
    </div>
</div>

