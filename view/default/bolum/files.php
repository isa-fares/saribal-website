<?
/* @var $this FrontClass object */
/* @var $param array */

$type      =  $param["type"];
$data_id   =  $param["data_id"];
$lang = $this->pageLang;


$query = "SELECT * FROM dosyalar WHERE type='$type' and data_id = {$data_id} and tur = 'dosya' and lang = '".$lang."' and sil <> 1 ORDER BY sira ASC";
$data = $this->sorgu($query);
$type_data = $this->dbLangSelectRow($type,array("id"=>$data_id, "master_id"=>$data_id));
?>

<? if(is_array($data) and count($data) > 0): ?>


    <div class="widget p-4 ">
        <?
        foreach ($data as $item):
            $dosya = $item["dosya"];
            $uzanti = $this->uzantiAl($item["dosya"]);
            $baslik = ((!empty($item["baslik"])) ? $this->temizle($item["baslik"]) : explode(".", $item["dosya"])[0]);
            $url = $this->BaseURL("download/index.php?document=".$dosya."&title=".$baslik."&dir=".$type);
            $folder = $_SERVER['DOCUMENT_ROOT'].(($_SERVER["SCRIPT_NAME"] == "/yeni/index.php") ? "/yeni" : null);
//            $filesize = filesize($folder."/upload/".$type."/".$dosya);
            $date = (!empty($item["duzenleme_tarihi"])) ? $item["duzenleme_tarihi"] : $item["eklenme_tarihi"];
            ?>
            <aside class="widget widget-download with-title" style="padding: 0px 0px 18px; border-bottom: 1px solid #f2f2f2;">
                <ul class="download box-shadow" style="padding-top: 11px;padding-bottom: 0px;display: flex;">
                    <a href="<?=$url?>">
                        <img src="<?=$this->themeURL?>images/file_icons/<?=$uzanti?>-file.png" alt="<?=$baslik?>">
                        <div style="width: 100%;margin-top: 8px;"><h4 style="display: inline-flex; margin-left: 15px;      font-size: 13px;  text-transform: uppercase;"><?=$this->mb_ucfirst($baslik)?></h4><a style="float: right;line-height: 23px;margin-right: 25px;color: #fff;padding: 7px 50px 7px 50px;background-color: #d52339;" href="<?=$url?>">İndir</a></div>
                        </li>
                    </a>
                </ul>
            </aside>
        <? endforeach;?>


    </div>


<? endif; ?>



