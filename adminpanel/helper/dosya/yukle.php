<?php


/**
 * upload.php
 *
 * Copyright 2013, Moxiecode Systems AB
 * Released under GPL License.
 *
 * License: http://www.plupload.com/license
 * Contributing: http://www.plupload.com/contributing
 */

#!! IMPORTANT: 
#!! this file is just an example, it doesn't incorporate any security checks and 
#!! is not recommended to be used in production environment as it is. Be sure to 
#!! revise it and customize to your needs.


// Make sure file is not cached (as it happens for example on iOS devices)
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

/* 
// Support CORS
header("Access-Control-Allow-Origin: *");
// other CORS headers if any...
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	exit; // finish preflight CORS requests here
}
*/

$klasor_resimler = base64_decode($control['folder']);



// 5 minutes execution time
@set_time_limit(5 * 60);

// Uncomment this one to fake upload time
// usleep(5000);

// Settings
$targetDir = $klasor_resimler;
//$targetDir = 'uploads';
$cleanupTargetDir = true; // Remove old files
$maxFileAge = 5 * 3600; // Temp file age in seconds


// Create target dir
if (!file_exists($targetDir)) {
    @mkdir($targetDir);
}

// Get a file name
if (isset($_REQUEST["name"])) {
    $fileName = $_REQUEST["name"];
} elseif (!empty($_FILES)) {
    $fileName = $_FILES["file"]["name"];
} else {
    $fileName = uniqid("file_");
}

$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;






// Chunking might be enabled
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


// Remove old temp files	
if ($cleanupTargetDir) {
    if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
    }

    while (($file = readdir($dir)) !== false) {
        $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

        // If temp file is current file proceed to the next
        if ($tmpfilePath == "{$filePath}.part") {
            continue;
        }

        // Remove temp file if it is older than the max age and is not the current file
        if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
            @unlink($tmpfilePath);
        }
    }
    closedir($dir);
}


// Open temp file
if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
}

if (!empty($_FILES)) {
    if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
    }

    // Read binary input stream and append it to temp file
    if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
    }
} else {
    if (!$in = @fopen("php://input", "rb")) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
    }
}

while ($buff = fread($in, 4096)) {
    fwrite($out, $buff);
}

@fclose($out);
@fclose($in);


function dosyaTur($dosya){
    $par = explode(".",$dosya);
    $count = count($par);
    $uzanti = $par[$count - 1];

    $resimler = array("jpg","gif","jpeg","png","bmp","JPG","JPEG","GIF","PNG","BMP");
    return (in_array($uzanti, $resimler)) ? "resim" : "dosya";
}

// Check if file has been uploaded
if (!$chunks || $chunk == $chunks - 1) {
    // Strip the temp .part suffix off
    rename("{$filePath}.part", $filePath);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $parca = explode(".",$fileName);
    $uzanti=$parca[count($parca) - 1];
    $sinifbul = $this->CheckArray($uzanti, $this->image_types);
    if($sinifbul){$sinifbul=1;}else{$sinifbul=2;}   //  resimmi-dökümanmı

    //$yeniad = $this->aDDegisir($fileName,((isset($control['baslikper'])) ? $control['baslikper']:''));

    $yeniad = ucfirst($this->per($parca[0]))."-".rand(0000,9999).".".$this->kharf($uzanti);

    rename($klasor_resimler.$fileName,$klasor_resimler.$yeniad);

    if($yeniad!="" and file_exists($klasor_resimler.$yeniad))
    {
       //$resimalv = $this->resimal2(0,40,$yeniad,$klasor_resimler); //w,h,resim
        if (dosyaTur($yeniad) == "resim") {
            $this->kucult($klasor_resimler, $yeniad, 1400, 0); // w,h istenirse tek tarafta girilebilir
        }
    }

    if(!empty($control['is_files']) && $control['is_files'] != 'undefined'){
        $ttur = 'dosya';
    }else {
         $ttur = dosyaTur($yeniad);
    }

    $sira = $this->OrderFile(((isset($control["lang"]) && $control["lang"] != "") ? "lang = '".$control["lang"]."' and " : "")." type = '".$control["modul"]."' and data_id = ".$control['son_id'].((isset($control["file_type"]) && !empty($control["file_type"])) ? " and file_type = '".$control["file_type"]."'" : "").((isset($control["is_files"]) && $control["is_files"] != 'undefined') ? " and tur = '".$ttur."'" : ""));

    $kaydet = $this->dbConn->insert('dosyalar',array(
        'dosya'=>$yeniad,
        'data_id'=>$control['son_id'],
        'type'=>$control['modul'],
        'lang'=>$control['lang'],
        'file_type'=>$control['file_type'],
        'resim_tur'=>$control["resim_tur"],
        'tur'=>$ttur,
        "sira"=>$sira,
        "eklenme_tarihi"=>date("Y-m-d H:i:s")
    ));

    if ($control["modul"] == "destek"){
        $this->dbConn->update("destek", array("duzenleme_tarihi"=>date("Y-m-d H:i:s")), array("id"=>$control["son_id"]));
        $this->dbConn->update("destek_lang", array("duzenleme_tarihi"=>date("Y-m-d H:i:s")), array("master_id"=>$control["son_id"]));
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

    /*
        ////////////////////////////////////// klasörden resmin adını degiştir.
        $so = mysql_query("SELECT * FROM dosyalar where modul=$modul and kayit_id=$son_id");
        while($rec = sorgu($so))
        {
            $id=$rec["id"];
            $dosya=$rec["dosya"];

            $yeniad = aDDegisir($dosya,$baslikper);
            rename($klasor_resimler.$dosya,$klasor_resimler.$yeniad);

            ResimSil($dosya,$klasor_resimler); // Eski resmi sil

            $guncelle = mysql_query("UPDATE dosyalar SET dosya='$yeniad',durum='1' WHERE id=$id");

        }*/
    ////////////////////////////////////

    /*///// yüklenipte tamamlanmayan form verilerini sil///////////////////////////
    $sq4=mysql_query("SELECT * FROM dosyalar where durum=0");
    while($rec4 = sorgu($sq4))
    {
    $id4=$rec4["id"];
    $resim4=$rec4["resim"];
    ResimSil($resi4m,$klasor_resimler); // Eski resmi sil
    mysql_query("DELETE FROM dosyalar WHERE id=$id4");
    }
    ////////////////////////////////////////////////////////////////////////
*/

}

// Return Success JSON-RPC response
die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');


?>