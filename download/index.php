<?php
$dosya = (isset($_GET["document"])) ? $_GET["document"] : null;
$dir = (isset($_GET["dir"])) ? $_GET["dir"] : '';

$par = explode(".", $dosya);
$ext = $par[count($par) - 1];

$title = (isset($_GET["title"])) ? $_GET["title"].".".$ext : $dosya;

if ($dir != ""){
    $download = "../upload/".$dir."/".$dosya;
}
else {
    $download = $dosya;
}



$type = mime_content_type($download);
header('Content-type: '.$type);
header('Content-Disposition: attachment; filename="'.$title .'"');
readfile($download);

?>