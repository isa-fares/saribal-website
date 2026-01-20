<?php
if(session_id() === "") session_start();
ob_start();
include( __DIR__.'/include/Request.php');
include( __DIR__.'/include/Ayarlar.php');
$page = Request::GET('page','index');
$type = Request::GET('type','master');
$ayarlar = new \AdminPanel\Ayarlar();
$istisna =  $ayarlar->cache('istisna');
$local  = true;
$forms = $ayarlar->form();

if ($ayarlar->config("display_error")){
    ini_set('display_errors', "On");
    ini_set('display_startup_errors', "On");
    ini_set('error_reporting', "E_ALL & ~E_NOTICE & ~E_DEPRECATED");
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
}else {
    ini_set('display_errors', "Off");
    ini_set('display_startup_errors', "Off");
}




if($ayarlar->cache('durum') and $type=="master" and !in_array($page,$istisna)):

    if($ayarlar->cache('klasor') and !is_dir($ayarlar->cache('klasor'))) mkdir($ayarlar->cache('klasor'),0755);


    $pageU = substr(str_replace('/','-',$_SERVER["REQUEST_URI"]),1);
    $pageU = ($pageU) ? $pageU:'index.html';



    $pageURL = $ayarlar->cache('klasor').DIRECTORY_SEPARATOR.$pageU;
    if ($pageU and file_exists($pageURL) and (time() - (($ayarlar->cache('zamanasimi') and is_numeric($ayarlar->cache('zamanasimi'))) ? $ayarlar->cache('zamanasimi'):1800) < filemtime($pageURL))) {

        include($pageURL);
        exit;
    }
endif;







include 'Loader.php';


$front = new \Loader($ayarlar);




$assetURL = $front->themeURL;

$lang_list = $front->settings->lang("lang");
$ln = $front->get_user_lang();
$user_lang = "";
if (array_key_exists($ln,$lang_list)){
    $user_lang = $ln;
}else  {
    $user_lang = "tr";
}

$id    = Request::GET('id',0);
$kid   = Request::GET('kid',0);
//$lang  = Request::GET('lang',$user_lang);
$lang  = Request::GET('lang',"tr");
$sayfa = Request::GET('sayfa','1');
$url   = Request::GET('url','');
$katurl  = Request::GET('katurl','');

$ids       = ($lang != "tr") ? "lang_" : "";
$mid       = ($lang != "tr") ? "master_" : "";

$ga = Request::GETURL("_ga",0);
if ($ga != 0){
    header("Location: ".$front->baseURL("index.html"));
}




$front->pageLang = $lang;
$front->setPageName($page);

$front->setLoaderLang($lang);



$protocol = (($_SERVER['SERVER_PORT'] == "443") ? 'https' : 'http');


$front->protocol = $protocol;


if (@$checkLogin){
    $kontrol = $front->tekSorgu("SELECT * FROM uyeler WHERE id = $userid and aktif = 1");

    if (!is_array($kontrol)){
        $front->redirectURL($front->baseURL("cikis.html"));
    }

}



if($type == "ajax"):
    $front->ajaxLoader($page);
else:
    $data =  [
        'id' => $id,
        'kid' => $kid,
        'page' =>$page,
        'lang' => $lang,
        'assetURL' => $assetURL,
        'ids' => $ids,
        'userid'=>@$userid,
        'checkLogin'=> @$checkLogin,
        'mid' => $mid,
        'content' => $front->pageLoader(
            [
                'sayfa' => $sayfa,
                'page' =>$page,
                'id' => $id,
                'kid' => $kid,
                'lang' => $lang,
                'url' => $url,
                'userid'=>@$userid,
                'assetURL' => $assetURL,
                'checkLogin' => @$checkLogin,
                'katurl' => $katurl,
                'urunurl' => @$urunurl,
                'ids' => $ids,
                'mid' => $mid,
                'local'     => $local,
                'forms'     => $forms
            ])
        ];


  

    if ($page != "e-katalog" && $page != "bulten"){
        echo $front->_include('master',$data,$front->settings->config('siteTemasi').'/');
    }

    else {
        if ($page == "e-katalog"){
            echo $front->_include('index',$data,$front->settings->config('siteTemasi').'/e-katalog/');
        }
        if ($page == "bulten"){
            echo $front->_include('index',$data,$front->settings->config('siteTemasi').'/bulten/');
        }

    }


endif;

if($ayarlar->cache('durum') and $type=="master" and !in_array($page,$istisna)):
    $cached = fopen($pageURL, 'w');
    fwrite($cached, ob_get_contents());
    fclose($cached);
endif;
