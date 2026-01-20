<?php
/**
 * Created by PhpStorm.
 * User: VEMEDYA
 * Date: 8.10.2016
 * Time: 14:43
 */

/* @var $this \AdminPanel\Controller object */
/* @var $this \AdminPanel\Settings object */
/* @var $this Database object */

namespace AdminPanel;


class Ajax extends Settings {


    public function __construct($settings)
    {
        parent::__construct($settings);

        $this->AuthCheck();

    }


 

    public function image_save_from_url($my_img,$fullpath){

        if($fullpath!="" && $fullpath){
            $fullpath = $fullpath."/".basename($my_img);
        }
        $ch = curl_init ($my_img);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
        $rawdata=curl_exec($ch);
        curl_close ($ch);
        if(file_exists($fullpath)){
            unlink($fullpath);
        }
        $fp = fopen($fullpath,'x');
        fwrite($fp, $rawdata);
        fclose($fp);
    }

    public function file_download($link,$dosya_adi=NULL){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $dosya=curl_exec($ch);
        curl_close($ch);

        if($dosya_adi==NULL){
            $dosya_adi=explode("../upload/video/",$link);
            $dosya_adi=array_reverse($dosya_adi);
            $dosya_adi=$dosya_adi[0];
        }

        $fp = fopen($dosya_adi,'w');
        fwrite($fp, $dosya);
        fclose($fp);
    }





    public function changeTheme(){
        $class = (isset($_GET["theme"])) ? $_GET["theme"] : "skin-blue";
        $duzen = $this->dbConn->update('kullanici',array('theme' => $class),array('id'=>$this->user_id));
        echo ($duzen) ? 1 : 0;
    }

    public static function imageUrlToBase64()
    {
        $url = $_POST["url"];
        $type = 'jpg';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);
        curl_close($ch);

        echo 'data:image/'.$type.';base64,'. base64_encode($output);
    }




    public function veriSil(){
        $id     =  (isset($_GET["id"])) ? $_GET["id"] : null;
        $table  =  (isset($_GET["table"])) ? $_GET["table"] : null;
        $date   =  date("Y-m-d H:i:s");

        $diller = $this->settings->lang('lang');


        if ($table == "kurslar"){
            $kontrol = $this->dbConn->tekSorgu("SELECT * FROM siparis WHERE kurs_id = $id");
            if (!$kontrol){
                $sil = $this->dbConn->update($table, array("sil"=>1, "silme_tarihi"=>$date, "silen"=>$this->getUserInfo("adi")), array("id"=>$id));
                echo ($sil) ? 1 : 0;
            }
            else {
                echo 3;
            }
        }
        elseif ($table == "kullanici"){
            $active_user = $this->user_id;
            if ($id <> $active_user){
                $sil = $this->dbConn->update($table, array("sil"=>1, "silme_tarihi"=>$date), array("id"=>$id));
                echo ($sil) ? 1 : 0;
            }
            else {
                echo 4;
            }
        }

        elseif ($table == "galeri"){
            $kontrol = $this->dbConn->tekSorgu("SELECT * FROM dosyalar WHERE type='galeri' and data_id = $id and sil <> 1");

            if (!$kontrol){
                $sil = $this->dbConn->update($table, array("sil"=>1, "silme_tarihi"=>$date), array("id"=>$id));
                echo ($sil) ? 1 : 0;
            }

            else {
                echo 5;
            }
        }


        elseif ($table == "ceviri"){
            $dt = $this->dbConn->tekSorgu('SELECT * FROM ceviri WHERE id = '.$id);
            $sil = $this->dbConn->sil('DELETE FROM ceviri WHERE id = '.$id);
            $this->ceviriDosyaYaz($dt['kid']);
            echo ($sil) ? 1 : 0;
        }


        else {

            if (!empty($id)){
                $sil = $this->dbConn->update($table, array("sil"=>1, "silme_tarihi"=>$date, "silen"=>$this->getUserInfo("adi")), array("id"=>$id));
                if (count($diller) > 1){
                    $kontrol = $this->dbConn->tekSorgu("show tables like '".$table."_lang'");
                    if (is_array($kontrol)){
                        $langSil = $this->dbConn->update($table."_lang", array("sil"=>1, "silme_tarihi"=>$date,"silen"=>$this->getUserInfo("adi")), array("master_id"=>$id));
                    }
                }
                echo ($sil) ? 1 : 0;
            }
        }
    }

    public function dosyaSil(){
        $id     =  (isset($_GET["id"])) ? $_GET["id"] : null;
        $date   =  date("Y-m-d H:i:s");

        if (!empty($id)){
            $sil = $this->dbConn->update("dosyalar", array("sil"=>1, "silme_tarihi"=>$date), array("id"=>$id));
            echo ($sil) ? 1 : 0;
        }

    }


    public function yorumAl(){

        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        if (!empty($id)){
            $return = array();
            $veri = $this->dbConn->tekSorgu("SELECT * FROM yorum WHERE id = $id");
            $kurs = $this->dbConn->tekSorgu("SELECT * FROM kurslar WHERE id = ".$veri["kurs"]);
            $return["baslik"] = $this->temizle($veri["baslik"]);
            $return["yorum"] = $this->temizle($veri["ozet"]);
            $return["tarih"] = date("d.m.Y", $veri["tarih"]);
            $return["kurs"] = $this->temizle($kurs["baslik"]);
            echo json_encode($return);
        }

    }




    public function uyeAl(){
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        if (!empty($id)){
            $veri = $this->dbConn->tekSorgu("SELECT * FROM uyeler WHERE id = $id");
            $count = strlen($this->sifreCoz($veri["sifre"]));
            $html = "<span class='hidden-pass'>";
            for($i=0; $i<=$count; $i++){
                $html.="*";
            }

            $html.="</span><span class='show-pass' style='display:none;'>".$this->sifreCoz($veri["sifre"])."</span> <a class='showPass' style='display: inline-block; margin-left: 15px;'  href='#'>[<i class='ti-eye'></i>]</a>";
            $veri["pass"] = $html;
            echo json_encode($veri);
        }

    }


    public function yorumOnay(){
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;
        $durum = (isset($_GET["durum"])) ? $_GET["durum"] : 0;
        if (!empty($id)){
           if ($this->dbConn->update("yorum", array("aktif"=>$durum), $id)){
               echo 1;
           }
        }
    }


    public function siparisOnay(){
        $id   = (isset($_GET["id"]))   ? $_GET["id"]   : null;
        $type = (isset($_GET["type"])) ? $_GET["type"] : null;

        if (!empty($id)){
            if ($this->dbConn->update("siparis", array("durum"=>$type), $id)){
                echo 1;
            }
        }

    }

    public function search_user(){
        $value = (isset($_GET["value"])) ? $_GET["value"] : null;
        $selected = (isset($_GET["selected"])) ? $_GET["selected"] : null;
        $value = mb_strtolower($value);
        $query = "SELECT * FROM uyeler WHERE (adi LIKE '%".$value."%' or firma_adi LIKE '%".$value."%')";
        $sorgu = $this->dbConn->sorgu($query);
        if (is_array($sorgu)){
            foreach ($sorgu as $item){
                if ($item["firma_adi"] != ""){
                    echo "<li class='".($selected == $item["id"] ? "selected" : "")."' data-id='".$item["id"]."'>".$this->temizle($item["firma_adi"])." <span style='font-size:13px'>(".$this->temizle($item["adi"]).")</span></li>";
                }
                else {
                    echo "<li class='".($selected == $item["id"] ? "selected" : "")."' data-id='".$item["id"]."'>".$this->temizle($item["adi"])."</li>";
                }
            }
        }
        else {
            echo "<b>Kayıt Bulunamadı.</b>";
        }
    }


    public function search_egitim(){
        $value = (isset($_GET["value"])) ? $_GET["value"] : null;
        $selected = (isset($_GET["selected"])) ? $_GET["selected"] : null;
        $value = mb_strtolower($value);
        $query = "SELECT * FROM kurslar WHERE (baslik LIKE '%".$value."%' or kod LIKE '%".$value."%') and sil <> 1 ORDER BY id DESC";
        $sorgu = $this->dbConn->sorgu($query);
        if (is_array($sorgu)){
            foreach ($sorgu as $item){
                 echo "<li class='".($selected == $item["id"] ? "selected" : "")."' data-id='".$item["id"]."'>".$this->temizle($item["kod"])." ".$this->temizle($item["baslik"])."</li>";
            }
        }
        else {
            echo "<b>Kayıt Bulunamadı.</b>";
        }
    }

    public function getPanelMessage(){
        $return = array();
        if (isset($_SESSION["panel_mesaj"]) && $_SESSION["panel_mesaj"] != ""){
            $message = $_SESSION["panel_mesaj"];
            $return["type"]     = $message["type"];
            $return["message"]  = $message["message"];
            echo json_encode($return,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            unset($_SESSION['panel_mesaj']);
        }
    }

    public function siparisDurumGuncelle(){
        $yeni_durum = (isset($_GET["yeni_durum"])) ? $_GET["yeni_durum"] : null;
        $yeni_fiyat = (isset($_GET["yeni_fiyat"])) ? $_GET["yeni_fiyat"] : null;
        $eski_durum = (isset($_GET["eski_durum"])) ? $_GET["eski_durum"] : null;
        $eski_fiyat = (isset($_GET["eski_fiyat"])) ? $_GET["eski_fiyat"] : null;
        $siparisNo = (isset($_GET["siparisNo"])) ? $_GET["siparisNo"] : null;

        $al = $this->dbConn->tekSorgu("SELECT * FROM siparis WHERE id = $siparisNo");


        $ozet = (isset($_GET["ozet"])) ? $_GET["ozet"] : null;

        $text = "";

        if ($yeni_durum !== $eski_durum){
            $logText = "satış durumu ".$this->getIslemDurum($eski_durum)." iken ".$this->getIslemDurum($yeni_durum)." olarak güncellendi";
            $this->islemLog($siparisNo, $logText);
        }

        if ($eski_fiyat !== $yeni_fiyat){
            $logText = "satışın genel tutarı ".$eski_fiyat." iken ".$yeni_fiyat." olarak güncellendi";
            $this->islemLog($siparisNo, $logText);
        }




        $guncelle = $this->dbConn->update("siparis", array(
            "islem"=>$yeni_durum,
            "genel_toplam"=>$this->returnDecimal($yeni_fiyat),
            "tarihce"=>$this->kirlet($ozet),
        ), array("id"=>$siparisNo));

        $text =  ($guncelle) ? 1 : 0;

        $type = ($guncelle) ? "success" : "error";
        $message = ($guncelle) ? "Satış Durumu Başarıyla Güncellendi" : "Hata Oluştu";



        $this->setPanelMessage($type, $message);
        echo $text;
    }

    public function siparisIptal(){
        $value = (isset($_GET["value"])) ? $_GET["value"] : null;
        $siparisNo = (isset($_GET["siparisNo"])) ? $_GET["siparisNo"] : null;
        $al = $this->dbConn->tekSorgu("SELECT * FROM siparis WHERE id = $siparisNo");

        $logText = ($value == 1) ? "Satış iptal edildi" : "Satış iptali geri alındı";
        $this->islemLog($siparisNo, $logText);

        $guncelle = $this->dbConn->update("siparis", array(
            "iptal"=>$value
        ), array("id"=>$siparisNo));


        echo ($guncelle) ? 1 : 0;
    }


    public function kursiyerSil(){
        $id = $_GET["id"];
        $siparis_id = $_GET["siparis_id"];

        $al = $this->dbConn->tekSorgu("SELECT * FROM kursiyerler WHERE id = $id");


        $adi   =   $this->temizle($al["adi_soyadi"]);
        $tel   =   $this->temizle($al["telefon"]);
        $email =   $this->temizle($al["email"]);
        $kurs_id = $al["kurs_id"];

        if (is_array($al)){ //VERİ VARSA
            $kurs_id = $al["kurs_id"];

            $guncelle = $this->dbConn->update("kursiyerler", array("sil"=>1), array("id"=>$id));
            $this->satisGuncelle($kurs_id);
            $logText = " $id id numaralı katılımcı (Adı: $adi, Telefon:$tel, Email: $email) silindi. (Kurs id : $kurs_id)";
            $this->islemLog($siparis_id, $logText);

            if ($guncelle){
                $this->setPanelMessage("success", "Katılımcı Silindi");
            }

            echo ($guncelle) ? 1 : 0;

        }

    }


    public function modalKatilimci()
    {
        $kurs_id = $_GET["kurs_id"];
        $return = array();
        $al = $this->dbConn->tekSorgu("SELECT * FROM kurslar WHERE id = $kurs_id");
        $kursiyer = $this->dbConn->sorgu("
            SELECT
            kursiyerler.id as kursiyer_id,
            kursiyerler.email,
            kursiyerler.telefon,
            siparis.type
            FROM
            kursiyerler
            INNER JOIN siparis ON kursiyerler.siparis_id = siparis.id
            WHERE  siparis.kurs_id = " . $kurs_id . " and siparis.type = 'success' and siparis.iptal <> 1 and kursiyerler.sil <> 1
        ");

        if (is_array($kursiyer)) {
            $email = "";
            $telefon = "";
            foreach ($kursiyer as $item) {
                $email .= $this->temizle($item["email"]) . ";\n";
                $telefon .= $this->temizle($item["telefon"]) . "\n";
            }


            $return["email"] = $email;
            $return["telefon"] = $telefon;

            echo json_encode($return, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            echo "error";
        }
    }



    public function modalFatura()
    {
        $kurs_id = $_GET["kurs_id"];
        $return = array();
        $al = $this->dbConn->tekSorgu("SELECT baslik FROM kurslar WHERE id = $kurs_id");
        $kursiyer = $this->dbConn->sorgu("
            SELECT
            kursiyerler.id as kursiyer_id,
            kursiyerler.email,
            kursiyerler.telefon,
            siparis.type,
            siparis.mesaj,
            kursiyerler.user_id,
            siparis.tutar,
            siparis.kisi_sayisi,
            siparis.genel_tutar,
            siparis.user_type            
            FROM
            kursiyerler
            INNER JOIN siparis ON kursiyerler.siparis_id = siparis.id
            WHERE  siparis.kurs_id = " . $kurs_id . " and siparis.type = 'success' and siparis.iptal <> 1 and kursiyerler.sil <> 1 GROUP BY siparis.user_id ORDER BY user_type DESC, kisi_sayisi DESC
        ");

        if (is_array($kursiyer)) {
            $data = "";

            foreach ($kursiyer as $item) {
                $uye_id = $item["user_id"];
                $uye = $this->dbConn->tekSorgu("SELECT * FROM uyeler WHERE id = $uye_id");

                $data .= "<tr>";
                    $data .= "<td>".(($uye["tur"] == 2) ? $this->temizle($uye["unvan"]) : $this->temizle($uye["adi"])."<br><small>(Bireysel)</small>")."</td>";


                    $data .= "<td>".$this->temizle($uye["vergi_dairesi"])."</td>";
                    $data .= "<td>".(($uye["tur"] == 2) ? $this->temizle($uye["vergi_no"]) : $this->temizle($uye["tc_kimlik"]))."</td>";
                    $data .= "<td>".$this->temizle($uye["adres"])."</td>";
                    $data .= "<td>".$item["kisi_sayisi"]." * ".$this->fiyatAl($item["tutar"])."<br><b>".$this->fiyatAl($item["genel_tutar"])."</b> </td>";
                    $data .= "<td>".$this->temizle($item["mesaj"])."</td>";
                $data.="</tr>";

                if ($uye["tur"] == 2){
                    $katilimci = $this->dbConn->sorgu("
                  SELECT * FROM 
                  kursiyerler 
                  INNER JOIN siparis ON siparis.id = kursiyerler.siparis_id
                  WHERE 
                    kursiyerler.kurs_id = $kurs_id 
                    and kursiyerler.sil <> 1 
                    and kursiyerler.user_id = $uye_id
                    and siparis.type='success'
                  ");

                    if (is_array($katilimci)){
                        $data.="<tr class='bb-3 border-gray'>";
                        $data.="<td colspan='6'>";
                        foreach ($katilimci as $k){
                            $data.=$this->temizle($k["adi_soyadi"]).", ";
                        }
                        $data.="</td></tr>";

                    }
                }

            }

            $return["title"] = $this->temizle($al["baslik"]);
            $return["data"] = $data;

            echo json_encode($return, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            echo "error";
        }
    }



    public function setEmailExcel(){
        $kurs_id = $_GET["kurs_id"];
        $al = $this->dbConn->tekSorgu("SELECT * FROM kurslar WHERE id = $kurs_id");
        $filename = $this->temizle($al["kod"])." Katılımcı Email Listesi (".date("d.m.Y H-i").")";

        $kursiyer = $this->dbConn->sorgu("
            SELECT
            kursiyerler.id as kursiyer_id,
            kursiyerler.email,
            kursiyerler.adi_soyadi,
            siparis.type
            FROM
            kursiyerler
            INNER JOIN siparis ON kursiyerler.siparis_id = siparis.id
            WHERE  siparis.kurs_id = " . $kurs_id . " and siparis.type = 'success' and siparis.iptal <> 1 and kursiyerler.sil <> 1
        ");

        $data=array();

        $sutun=array(
            'Adı Soyadı',
            'Email Adresi'
        );

        if (is_array($kursiyer)){
            foreach ($kursiyer as $item){
                $data[]=array(
                    $this->temizle($item["adi_soyadi"]),
                    $this->temizle($item["email"]),
                );
            }
        }

        $this->exportExcel($filename,$sutun,$data);

    }

    public function setTelefonExcel(){
        $kurs_id = $_GET["kurs_id"];
        $al = $this->dbConn->tekSorgu("SELECT * FROM kurslar WHERE id = $kurs_id");
        $filename = $this->temizle($al["kod"])." Katılımcı Telefon Listesi (".date("d.m.Y H-i").")";

        $kursiyer = $this->dbConn->sorgu("
            SELECT
            kursiyerler.id as kursiyer_id,
            kursiyerler.telefon,
            kursiyerler.adi_soyadi,
            siparis.type
            FROM
            kursiyerler
            INNER JOIN siparis ON kursiyerler.siparis_id = siparis.id
            WHERE  siparis.kurs_id = " . $kurs_id . " and siparis.type = 'success' and siparis.iptal <> 1 and kursiyerler.sil <> 1
        ");

        $data=array();

        $sutun=array(
            'Adı Soyadı',
            'Telefon Numarası'
        );

        if (is_array($kursiyer)){
            foreach ($kursiyer as $item){
                $data[]=array(
                    $this->temizle($item["adi_soyadi"]),
                    $this->temizle($item["telefon"]),
                );
            }
        }

        $this->exportExcel($filename,$sutun,$data);

    }

    public function anketExcel(){


        $dil = $_GET["dil"];

        $cevaplar = $this->dbConn->sorgu("SELECT * FROM anket_cevap WHERE lang = '".$dil."' ORDER BY id ASC");
        $sorular = $this->dbConn->sorgu("SELECT * FROM anket ORDER BY id ASC");
        $filename = "Anket Katılım Sonuçları (".date("d.m.Y H-i").")";


        if (!is_array($cevaplar)){
            echo "Bu dil için kayıtlı veri bulunamadı";
            exit();
        }

        $data=array();
        $sutun = array('Tarih');

        foreach ($sorular as $soru){
            $sutun[] = $soru["question_".$dil];
        }

        $sutun[] = "Dil";

        foreach ($cevaplar as $cevap){
            $p = array();
            $p[] = $cevap["tarih"];
            for ($i=1; $i<=6; $i++){
                $p[] = $cevap["question_".$i];
            }
            $p[] = $cevap["lang"];
            $data[] = $p;
        }

        $this->exportExcel($filename,$sutun,$data);




    }

    public function removeImage(){
        $id = $_GET["id"];
        $table = $_GET["table"];
        $lang = $_GET["lang"];
        $column = $_GET["column"];

        $column = (($table == "dosyalar") ? "dosya" : $column);


        if(!empty($lang)){
            if($table != 'dosyalar'){
                if($lang != 'tr'){
                    $guncelle = $this->dbConn->update($table."_lang", array($column=>null), array("master_id"=>$id));
                }else {
                    $guncelle = $this->dbConn->update($table, array($column=>null), array("id"=>$id));
                }
            }
        }else {
            $guncelle = $this->dbConn->update($table, array($column=>null), array("id"=>$id));
        }

        if ($guncelle){
            echo "1";
        }
    }

    public function truncateTable()
    {
        $domain = explode('.', $_SERVER["SERVER_NAME"]);
        $domain = $domain[count($domain) - 1];
        if ($_SERVER["SERVER_NAME"] == "localhost" or $domain == "test" or $domain == 'vm') {

            $disable_table  = array("boyutlar", "kullanici", "moduller", "sayfakategori", "sehirler", "ceviri", "ceviri_kategori", 'city', 'town');
            $table  = array();
            $dbName = $this->getDbName();
            $query = $this->dbConn->sorgu("SELECT TABLE_NAME AS tablo FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '" . $dbName . "'");
            foreach ($query as $item) {
                if (!in_array($item["tablo"], $disable_table)) {
                    $this->dbConn->sorgu("TRUNCATE TABLE " . $item["tablo"]);
                }
            }

            $dizinadi = str_replace('/adminpanel/index.php', '', $_SERVER['SCRIPT_FILENAME']) . '/' . $this->settings->config('folder');
            $disable_folders = array("users", "no-image.png");
            $dizin = opendir($dizinadi);


            while ($dosya = readdir($dizin)) {
                if (!in_array($dosya, $disable_folders)) {
                    if (is_dir($dizinadi . "/" . $dosya)) {
                        if ($dosya != "." and $dosya != "..") {
                            $table[] = $dosya;
                        }
                    }
                }
            }
            foreach ($table as $item) {
                $dizin = opendir($dizinadi . "/" . $item);
                while ($dosya = readdir($dizin)) {
                    if ($dosya != "." and $dosya != "..") {

                        if (is_file($dizinadi . "/" . $item . "/" . $dosya)) {
                            if ($dosya != 'no-image.png') {
                                unlink($dizinadi . "/" . $item . "/" . $dosya);
                            }
                        } else {
                            $dizin2 = opendir($dizinadi . "/" . $item . "/" . $dosya);
                            while ($dosya2 = readdir($dizin2)) {
                                if ($dosya2 != "." and $dosya2 != "..") {
                                    if (is_file($dizinadi . "/" . $item . "/" . $dosya . "/" . $dosya2)) {
                                        unlink($dizinadi . "/" . $item . "/" . $dosya . "/" . $dosya2);
                                    }
                                }
                            }
                        }
                    }
                }
                closedir($dizin);
            }

            $protected =  [
                'mailType' => 'smtp',
                'SmtpHost' => 'mail.vemedya.com',
                'SmtpMail' => 'form@vemedya.com',
                'SmtpPass' => "ri&amp;8C#9.Gq",
                'SmtpPort' => '465',
                'SmtpSecret' => 'ssl',
            ];

            foreach ($protected as $key => $value) {
                $this->dbConn->insert('ayarlar', array('value' => $value, 'name' => $key));
            }
            $this->dbConn->sorgu("DELETE FROM kullanici WHERE id <> 1");
            echo 1;
        }
    }

}