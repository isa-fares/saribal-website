<?php
/**
 * Created by PhpStorm.
 * User: Abdulkadir
 * Date: 14.11.2016
 * Time: 00:47
 */

$sidebar = $this->dbConn->sorgu("SELECT * FROM moduller WHERE aktif = 1 ORDER BY sira ASC");

$text = '<ul class="sidebar-menu">';

$user_type = $this->user_type;
$user_id = $this->user_id;
$kullanici = $this->dbConn->tekSorgu("SELECT * FROM kullanici WHERE id = $user_id");
$yetkiler = json_decode($kullanici["yetkiler"]);



$ex = explode('/',$_GET["cmd"]);
$modul = $ex[0];
$function = $ex[1];


$type = (isset($_GET["type"])) ? $_GET["type"] : "";

if (is_array($sidebar)) {





    foreach ($sidebar as $side) {
        $url = ((!empty($side["url"])) ? $this->BaseAdminURL($side["url"]) : $this->BaseAdminURL($side["modul"].(($side["modul"] != "ayar") ? "/liste" : "")));

        if ($user_type <> 1){


            if (in_array($side["id"], $yetkiler)) {

                $text .= '<li data-modul="'.$side["modul"].'" class="' . ((strtolower($modul) == $side["modul"] || $type == $side["modul"])  ? "active" : "") . '">
                                <a href="' . $url . '" class="">
                                   <i class="' . $side['icon'] . '"></i>
                                <span class="title">' . $side['baslik'] . '</span>
                                <i class="fa fa-angle-right pull-right"></i>';

                if (!empty($side["pill"])) {
                    $table = $side["pill_table"];
                    $column = $side["pill_column"];
                    $veri = $this->dbConn->tekSorgu("SELECT Count(id) as toplam FROM $table WHERE $column = 0 and sil <> 1");
                    if ($veri["toplam"] > 0) {
                        $text .= '<span class="badge badge-pill badge-danger ml-5">' . $veri["toplam"] . '</span>';
                    }
                }

                $text .= '</a>';

                $text .= '</li>';
            }

        }
        else {
            $text .= '<li data-modul="'.$side["modul"].'" class="' . ((strtolower($modul) == $side["modul"] || $type == $side["modul"])  ? "active" : "") . '">
                                <a href="' . $url. '" class="">
                                   <i class="' . $side['icon'] . '"></i>
                                <span class="title">' . $side['baslik'] . '</span>
                                <i class="fa fa-angle-right pull-right"></i>';

            if (!empty($side["pill"])) {
                $table = $side["pill_table"];
                $column = $side["pill_column"];
                $veri = $this->dbConn->tekSorgu("SELECT Count(id) as toplam FROM $table WHERE $column = 0 and sil <> 1");
                if ($veri["toplam"] > 0) {
                    $text .= '<span class="badge badge-pill badge-danger ml-5">' . $veri["toplam"] . '</span>';
                }
            }

            $text .= '</a>';

            $text .= '</li>';
        }



    }


}

if ($user_type == 1){
    $text.='<li  class="'.((strtolower($modul) == "moduller") ? "active" : "").'"><a href="' . $this->BaseAdminURL("Moduller").'">
                                   <i class="mdi mdi-arrange-send-backward"></i>
                                <span class="title">Modüller</span>
                                <i class="fa fa-angle-right pull-right"></i></a></li>';
}


$text .= '</ul>';

echo  $text;
