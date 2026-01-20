<?php
/**
 * Created by PhpStorm.
 * User: VEMEDYA
 * Date: 02.03.2016
 * Time: 14:30
 */

namespace AdminPanel;



use Fonksiyonlar\Func;

class Settings extends Func
{

    /**
     * @var \Database\Data
     */
    public $dbConn;
    /**
     * @var string
     */
    public $baslik = '';
    /**
     * @var string
     */
    public $sayfaBaslik="";
    /**
     * @var string
     */
    public $settings = '';
    /**
     * @var string
     */
    private $folder = '';
    /**
     * @var
     */
    private $allow_image_type;
    /**
     * @var
     */
    private $allow_file_type;
    /**
     * @var
     */
    public $user_type;
    /**
     * @var
     */
    public $user_id;
    /**
     * @var
     */
    public $user_pass;

    /**
     * @var
     */
    public $user_yetki = array();

    /**
     * @var
     */
    public $loginKey;


    /**
     * @var string
     */
    public $aktifColumn = "aktif";
    /**
     * @var string
     */
    public $silColumn = "sil";

    /**
     * Settings constructor.
     * @param $settings
     */
    public function __construct($settings)
    {


        $this->dbConn = $this->db($settings);
        $this->settings = $settings;
        $this->folder = "../" . $settings->config('folder');
        $this->allow_image_type = $settings->file('allow_image_type');
        $this->allow_file_type = $settings->file('allow_file_type');




        if (isset($_COOKIE["loginC"])){
            $this->loginKey = $_COOKIE["loginC"];
        }

        else if(isset($_SESSION["loginS"])) {
            $this->loginKey = $_SESSION["loginS"];
        }

        else {
            //$this->RedirectURL($this->BaseAdminURL('login/cikis'));
        }



        if ($this->loginKey != ""){
            $par = explode("-", $this->sifreCoz($this->loginKey));

            $this->user_id = $par[0];
            $this->user_type = $par[1];
            $this->user_pass = $par[2];


        }




    }


    public function getDbName(){
        $domain = explode('.',$_SERVER["SERVER_NAME"]);
        $domain = $domain[count($domain)-1];

        $database = $this->settings->database();

        if($_SERVER["SERVER_NAME"] == "localhost" or $domain=="test" or $domain == 'vm' ){
            $data = $database["pdo"]["local"];
        }
        else {
            $data = $database["pdo"]["host"];
        }
        return $data["dbname"];
    }

    /**
     * @return mixed
     */
    public function getUserId(){
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getUserType(){
        return $this->user_type;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getUserInfo($data){
        $user_id = $this->user_id;
        $al = $this->dbConn->tekSorgu("SELECT $data FROM kullanici WHERE id = $user_id");
        return $al[$data];
    }

    /**
     * @param $siparis_id
     * @param $islem
     */
    public function islemLog($siparis_id, $islem){

        $ip    = $_SERVER['SERVER_ADDR'];
        $user  = $this->getUserInfo("kullanici");
        $tarih = date("d.m.Y H:i");
        $siparis = $this->dbConn->tekSorgu("SELECT * FROM siparis WHERE id = $siparis_id");
        $siparis_no = $siparis["siparis_no"];
        return $this->dbConn->insert("siparis_log", array(
           "ip"=>$ip,
           "user"=>$user,
           "tarih"=>$tarih,
           "siparis_no"=>$siparis_no,
           "siparis_id"=>$siparis_id,
           "islem"=>$islem
        ));

    }



    /**
     * @param $kurs_id
     * @return bool
     */
    public function satisGuncelle($kurs_id){

        $kurs = $this->dbConn->teksorgu("SELECT * FROM kurslar WHERE id = $kurs_id");
        $kursiyer = $this->dbConn->sorgu("
            SELECT
            kursiyerler.id as kursiyer_id,
            siparis.type
            FROM
            kursiyerler
            INNER JOIN siparis ON kursiyerler.siparis_id = siparis.id
            WHERE  siparis.kurs_id = ".$kurs_id." and siparis.type = 'success' and siparis.iptal <> 1 and kursiyerler.sil <> 1
        ");

        if (!empty($kursiyer)){

            $toplam = count($kursiyer);


            if ($kurs["kontenjan"] > $kurs["satis"] ){
                return $this->dbConn->update("kurslar", array("satis"=>$toplam), $kurs_id);
            }
            else {
                return false;

            }
        }

        else {
            return $this->dbConn->update("kurslar", array("satis"=>0), $kurs_id);
        }

    }

    /**
     * @param $siparis_id
     * @return int
     */
    public function toplamKursiyer($siparis_id){
        $kursiyerler = $this->dbConn->sorgu("SELECT * FROM kursiyerler WHERE siparis_id = $siparis_id and sil <> 1");
        return count($kursiyerler);
    }


    /**
     * @param $durum integer
     * @return string
     */

    public function getIslemDurum($durum){

        $labelText= "";

            switch ($durum):
                case 1: $labelText = "Ödeme Bekleniyor"; break;
                case 2: $labelText = "Başarılı";  break;
                case 3: $labelText = "Hata"; break;
            endswitch;

        return $labelText;
    }


    /**
     * @param $durum
     * @return string
     */
    public function getSatisTur($durum){

        $labelText= "";

        switch ($durum):
            case 1: $labelText = "Kredi Kartı"; break;
            case 2: $labelText = "Havale / EFT";  break;
        endswitch;

        return $labelText;
    }


    /**
     * @param $type
     * @param $message
     */
    function  setPanelMessage($type, $message){
        $_SESSION["panel_mesaj"] = array("type"=>$type,"message"=>$message);
    }


    /**
     * @param $sayi
     * @return string
     */
    public function siparisNo($sayi){
        $toplamUzunluk = $this->settings->config('siparisNoUzunluk');
        $uzunluk = strlen($sayi);
        $ek = "S-";
        if ($toplamUzunluk > $uzunluk){
            $fark = $toplamUzunluk - $uzunluk;
            if ($fark > 0) {

                for ($i = 1; $i <= $fark; $i++) {
                    $ek .= "0";
                }
            }

        }

        return $ek.$sayi;
    }


    /**
     * @param string $filename
     * @param array $columns
     * @param array $data
     * @param array $replaceDotCol
     */
    public function exportExcel($filename='ExportExcel', $columns=array(), $data=array(), $replaceDotCol=array()){
        header('Content-Encoding: UTF-8');
        header('Content-Type: text/plain; charset=utf-8');
        header("Content-disposition: attachment; filename=".$filename.".xls");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM

        $say=count($columns);

        echo '<table border="1" cellpadding="5" cellspacing="5"><tr>';
        foreach($columns as $v){
            echo '<th style="background-color:#efefef">'.trim($v).'</th>';
        }
        echo '</tr>';

        foreach($data as $val){
            echo '<tr>';
            for($i=0; $i < $say; $i++){

                if(in_array($i,$replaceDotCol)){
                    echo '<td>'.str_replace('.',',',$val[$i]).'</td>';
                }else{
                    echo '<td>'.$val[$i].'</td>';
                }
            }
            echo '</tr>';
        }
    }

    /**
     * @param $records
     */
    public function ExportFile($records) {
        $heading = false;
        if(!empty($records))
            foreach($records as $row) {
                if(!$heading) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $heading = true;
                }
                echo implode("\t", array_values($row)) . "\n";
            }
        exit;
    }


    /**
     * @param array $param
     * @return array
     */
    public function sayfalama($param = array()){

        $table = (isset($param["table"])) ? $param["table"] : "";
        $limit = (isset($param["limit"])) ? $param["limit"] : "";
        $kosul = (isset($param["kosul"])) ? $param["kosul"] : "";
        $search = (isset($param["search"])) ? $param["search"] : "";
        $sqlEk = (isset($param["sqlEk"])) ? $param["sqlEk"] : "";
        $order = (isset($param["order"])) ? $param["order"] : "";
        $showSql = (isset($param["showSql"])) ? $param["showSql"] : "";
        $kosulTur = (isset($param["kosulTur"])) ? $param["kosulTur"] : " WHERE ";

        $sayfa = (isset($_GET["sayfa"])) ? $this->kirlet(intval($_GET['sayfa'])) : 1;

        $where = $kosulTur." 1=1";

        if ($kosul != ""){
            $where.=" and ".$kosul;
        }


        if (is_array($search) && count($search) > 0){

            if (isset($_GET["kelime"])){
                $i=0;
                $toplam = count($search);
                $where.=" and (";

                foreach ($search as $key){
                    $operator = ($i==0) ? "" : " OR ";
                    $where.=$operator.$key." LIKE '%".$_GET["kelime"]."%'";
                    $i++;
                }
                $where.=")";
            }
        }

        $sql = "SELECT *";
        if ($sqlEk != ""){
            $sql.=",".$sqlEk;
        }


        if (!isset($param["disable_delete"])){
            if ($this->user_type != 1){
                $where.=" and ".$this->silColumn." <> 1";
            }
        }


        $sql.=" FROM $table".$where;


        if($order != ""){
            $sql.=" ".$order;
        }

        else {
            $sql.=" ORDER BY sira, id ASC";
        }

        if ($showSql){
            echo $sql;
            exit();
        }
        $query = $this->dbConn->sorgu($sql);
        if (is_array($query)){
            $toplamVeri = count($query);
        }else {
            $toplamVeri = 0;
        }



        $sayfa = (isset($_GET["sayfa"])) ? $this->kirlet(intval($_GET['sayfa'])) : 1;

        if (!is_numeric($sayfa)){
            $sayfa = 1;
        }

        if (isset($_GET["limit"]) && $_GET["limit"] == "all"){
            $sayfaLimit = 1000;
        }

        else {

            if ($limit == ""){
                $sayfaLimit = $this->settings->config('veriLimit');
            }

            else {
                $sayfaLimit = $limit;
            }

        }


        $gecerli = 0;

        $toplamSayfa = ceil($toplamVeri / $sayfaLimit);

        if ($sayfa > $toplamSayfa)
        {
            $sayfa = 1;
        }

        if ($sayfa > 0){
            $gecerli = ($sayfa - 1) * $sayfaLimit;
        }

        $showlist = "";
        if ($toplamSayfa < 2){
            $showlist = "Toplam $toplamVeri adet içerikten 0 - ".$toplamVeri." arası listeleniyor.";
        }
        else {

            if ($sayfa == 1){
                $showlist = "Toplam $toplamVeri adet içerikten 0 - ".$sayfaLimit." arası listeleniyor.";
            }

            else {
                if ($sayfa == $toplamSayfa){
                    $showlist = "Toplam $toplamVeri adet içerikten ".($sayfa - 1) * $sayfaLimit." - ".$toplamVeri." arası listeleniyor.";
                }
                else {
                    $showlist = "Toplam $toplamVeri adet içerikten ".($sayfa - 1) * $sayfaLimit." - ".($sayfa * $sayfaLimit)." arası listeleniyor.";
                }
            }

        }


        return array($sql." LIMIT ".$gecerli.", $sayfaLimit", $showlist, $toplamVeri);

    }


    public function ceviriSayfalama($param = array()){

        $table = "ceviri";
        $table_lang = "ceviri_lang";
        $kosul = (isset($param["kosul"])) ? $param["kosul"] : "";
        $search = (isset($param["search"])) ? $param["search"] : "";


        $sayfa = (isset($_GET["sayfa"])) ? $this->kirlet(intval($_GET['sayfa'])) : 1;

        $where = " WHERE 1=1 ";

        if ($kosul != ""){
            $where.=" ".$kosul;
        }


        if (is_array($search) && count($search) > 0){

            if (isset($_GET["kelime"])){
                $i=0;
                $toplam = count($search);

                $where.=" and (";
                foreach ($search as $key){
                    $operator = ($i==0) ? "" : " OR ";
                    $where.=$operator."`".$key."` LIKE '%".$_GET["kelime"]."%'";
                    $i++;
                }

                $where.=")";
            }
        }

        $sql = "SELECT * ";
        if ($sqlEk != ""){
            $sql.=",".$sqlEk;
        }

        $sql.=" FROM $table".$where;




        if($order != ""){
            $sql.=" ".$order;
        }

        else {
            $sql.=" ORDER BY id DESC";
        }



        $query = $this->dbConn->sorgu($sql);
        if (is_array($query)){
            $toplamVeri = count($query);
        }else {
            $toplamVeri = 0;
        }


        $sayfa = (isset($_GET["sayfa"])) ? $this->kirlet(intval($_GET['sayfa'])) : 1;

        if (!is_numeric($sayfa)){
            $sayfa = 1;
        }

        if (isset($_GET["limit"]) && $_GET["limit"] == "all"){
            $sayfaLimit = 1000;
        }

        else {

            if ($limit == ""){
                $sayfaLimit = $this->settings->config('veriLimit');
            }

            else {
                $sayfaLimit = $limit;
            }

        }


        $gecerli = 0;

        $toplamSayfa = ceil($toplamVeri / $sayfaLimit);

        if ($sayfa > $toplamSayfa)
        {
            $sayfa = 1;
        }

        if ($sayfa > 0){
            $gecerli = ($sayfa - 1) * $sayfaLimit;
        }

        $showlist = "";
        if ($toplamSayfa < 2){
            $showlist = "Toplam $toplamVeri adet içerikten 0 - ".$toplamVeri." arası listeleniyor.";
        }
        else {

            if ($sayfa == 1){
                $showlist = "Toplam $toplamVeri adet içerikten 0 - ".$sayfaLimit." arası listeleniyor.";
            }

            else {
                if ($sayfa == $toplamSayfa){
                    $showlist = "Toplam $toplamVeri adet içerikten ".($sayfa - 1) * $sayfaLimit." - ".$toplamVeri." arası listeleniyor.";
                }
                else {
                    $showlist = "Toplam $toplamVeri adet içerikten ".($sayfa - 1) * $sayfaLimit." - ".($sayfa * $sayfaLimit)." arası listeleniyor.";
                }
            }

        }


        return array($sql." LIMIT ".$gecerli.", $sayfaLimit", $showlist, $toplamVeri);

    }

    /**
     * @param $param
     * @return \PDOStatement
     */
    public function dosyaAl($param){
        $type = (isset($param["type"])) ? $param["type"] : "";
        $lang = (isset($param["lang"])) ? $param["lang"] : "";
        $data_id = (isset($param["data_id"])) ? $param["data_id"] : "";
        $order = (isset($param["order"])) ? $param["order"] : " sira ASC";
        $where = (isset($param["where"])) ? $param["where"] : "";
        $file_type = (isset($param["file_type"])) ? $param["file_type"] : "";
        $tur = (isset($param["tur"])) ? $param["tur"] : "";

        if ($this->user_type != 1){
            $where.=" and ".$this->silColumn." <> 1";
        }

        $sorgu = "select * from dosyalar WHERE ".((!empty($tur)) ? " tur='$tur' and " : "").((!empty($lang)) ? " lang='$lang' and " : "").((!empty($file_type)) ? " file_type='$file_type' and " : "")." type = '".$type."' and data_id = ".$data_id." $where ORDER by ".$order;
        return  $this->dbConn->sorgu($sorgu);
    }

    /**
     * @param $dil
     * @return mixed
     */
    public function langSelect($dil){
        return $this->settings->lang()["lang"][$dil];
    }


    /**
     * @param $settings
     * @return \Database\Data
     */
    public function db($settings)
    {
        $db = new \Database\Data($settings);
        return $db;
    }

    /**
     * @param array $param
     * @return mixed
     */
    public function PageList($param = array())
    {
        $liste = new PageList();
        return $liste->Liste($param = array());
    }

    /**
     * @param null $url
     * @return string
     */
    public function BaseAdminURL($url = null)
    {
        return (($url) ? $this->settings->config('url').''. $this->settings->config('adminfolder'). '/' . (($this->settings->config('adminSeo')) ? null : '?cmd=') . $url :
            $this->settings->config('url'). $this->settings->config('adminfolder')
        );
    }


    /**
     * @param null $url
     * @return string
     */
    public function BaseAdmin($url = null)
    {
        return (($url) ? $this->settings->config('url'). $this->settings->config('adminfolder'). '/' . $url :
            $this->settings->config('url'). $this->settings->config('adminfolder')
        );
    }

    /**
     * @param null $url
     * @return string
     */
    public function Base($url = null)
    {
        return (($url) ? $this->settings->config('url')."/".$url :
            $this->settings->config('url')
        );
    }

    /**
     * @param null $url
     * @return string
     */
    public function ThemeFile($url = null)
    {
        return (($url) ? $this->settings->config('url').$this->settings->config('adminfolder'). '/theme/' . $this->settings->config('adminTheme'). '/' . $url :
            $this->settings->config('url'). $this->settings->config('adminfolder'). '/theme/' . $this->settings->config('adminTheme')
        );
    }

    /**
     * @param null $url
     * @return string
     */
    public function BaseTheme($url = null)
    {
        return (($url) ? $this->settings->config('url')."view/".$this->settings->config('siteTemasi')."/".$url :
            $this->settings->config('url')."view/".$this->settings->config('siteTemasi'). '/'
        );
    }


    /**
     * @param null $url
     * @return string
     */
    public function BaseURL($url = null)
    {
        return (($url) ? $this->settings->config('url') .  $url : $this->settings->config('url'));
    }


    /**
     * @param $url
     */
    public function RedirectURL($url)
    {
        header('location:' . $url);
    }


    /**
     * @param $fiyat
     * @return string
     */
    public function fiyatAl($fiyat){
        return number_format($fiyat, 2, ',', '.');
    }


    public function dosyaTur($dosya){
        $par = explode(".",$dosya);
        $count = count($par);
        $uzanti = $par[$count - 1];

        $resimler = array("jpg","gif","jpeg","png","bmp","JPG","JPEG","GIF","PNG","BMP");
        return (in_array($uzanti, $resimler)) ? "resim" : "dosya";
    }


    /**
     * @param $lastid
     * @param $module
     */
    public function FileSessionSave($lastid, $module, $file_type = null)
    {
        if(isset($_SESSION['proje_new_file_'.$module]) and is_array($_SESSION['proje_new_file_'.$module])):
            foreach ($_SESSION['proje_new_file_'.$module] as $key=>$file)
            {
                $this->dbConn->insert('dosyalar',
                    array(
                        'data_id' =>   $lastid,
                        'dosya'   =>   $file['name'],
                        'type'    =>   $module,
                        'sira'    =>   $key+1,
                        "lang"    =>   $file["lang"],
                        'file_type'=>$file_type,
                        'tur' => $this->dosyaTur($file["name"]),
                    ));
            }
            unset($_SESSION['proje_new_file_'.$module]);
        endif;
    }


    /**
     * @param $table
     * @param array $url
     * @return string
     */
    public function SeoURL($table, $url = array())
    {

        $sURL = strtolower($this->permalink($url['value']));
        $baslik = $url['value'];
        $name = $url['name'];
        $sorgu = $this->dbConn->sorgu("select * from $table where $name='{$baslik}' ");

        if(count($sorgu)>1)  return $sURL.'-'.$url['id'];
        else return $sURL;

    }

    /**
     * @param $files
     * @param $name
     * @param null $folder
     * @return array
     */
    public function imageUploader($files, $name, $folder=null)
    {
        $filename = array();

        $folder = str_replace("/","",$folder);
        if(!file_exists($this->folder.'/'.$folder)) mkdir($this->folder.'/'.$folder, 0755);

        foreach ($files as $name2 => $file):
            $fname = $this->addegisir($file['name'], strtolower($name));
            if (isset($file['type']) and in_array(strtolower($file['type']), $this->allow_image_type)):  move_uploaded_file($file['tmp_name'], $this->folder.'/'.$folder."/".$fname);
                $filename[] = $fname;
            endif;

        endforeach;

        return $filename;

    }


    /**
     * @param $aktifFunction
     * @return string
     */
    public function ayarlarSidebar($aktifFunction){
        $text = "";
        $text.="<div class='col-sm-3'>";

        $text.="<div class='box'><div class='box-header with-border'>
            <h3 class='box-title'>Seçenekler</h3>
                    </div> <div class='box-body no-padding mailbox-nav'>";
        $text.='<ul class="nav nav-pills flex-column">';
        //$text.="<li class='nav-item'><a href='".$this->BaseAdminURL("Ayar/fiyat")."' class='nav-link ".(($aktifFunction == "fiyat") ? "active" : "")."'><i class='mdi mdi-currency-try'></i> Fiyat Ayarları</a></li>";

        //$text.="<li class='nav-item'><a href='".$this->BaseAdminURL("Ayar/kvkk")."' class='nav-link ".(($aktifFunction == "kvkk") ? "active" : "")."'><i class='mdi mdi-textbox'></i> KVKK ve Diğer Sayfalar</a></li>";

        $text.="<li class='nav-item'><a href='".$this->BaseAdminURL("Ayar/ayarlar")."' class='nav-link ".(($aktifFunction == "ayarlar" || $aktifFunction == "") ? "active" : "")."'><i class='mdi mdi-auto-fix'></i> Site Ayarları</a></li>";
        $text.="<li class='nav-item'><a href='".$this->BaseAdminURL("Ayar/iletisim")."' class='nav-link ".(($aktifFunction == "iletisim") ? "active" : "")."'><i class='mdi mdi-phone-in-talk'></i> İletişim</a></li>";
        $text.="<li class='nav-item'><a href='".$this->BaseAdminURL("Ayar/sosyal")."' class='nav-link ".(($aktifFunction == "sosyal") ? "active" : "")."'><i class='mdi mdi-facebook'></i> Sosyal Medya</a></li>";
        $text.="<li class='nav-item'><a href='".$this->BaseAdminURL("kullanici/liste")."' class='nav-link ".(($aktifFunction == "kullanici") ? "active" : "")."'><i class='mdi mdi-account-key'></i> Kullanıcı Ayarları</a></li>";
        $text.="<li class='nav-item'><a href='".$this->BaseAdminURL("Ayar/eposta")."' class='nav-link ".(($aktifFunction == "eposta") ? "active" : "")."'><i class='mdi mdi-email-variant'></i> Eposta Ayarları</a></li>";


        if ($this->user_type == 1) {
            //$text.="<li class='nav-item'><a href='".$this->BaseAdminURL("Ayar/asset")."' class='nav-link ".(($aktifFunction == "asset") ? "active" : "")."'><i class='mdi mdi-xml'></i> Css & Javascript Versiyon</a></li>";
        }

        $text.="</ul></div></div>";
        if ($this->user_type == 1) {
            $domain = explode('.',$_SERVER["SERVER_NAME"]);
            $domain = $domain[count($domain)-1];
            if($_SERVER["SERVER_NAME"] == "localhost" or $domain=="test" or $domain == 'vm' ){
                $text .= "<a href='#' class='mt-10 btn-block btn btn-danger truncateTable'><i class='fa fa-remove'></i> Veritabanı Ve Uplad Klasörünü Boşalt</a>";
            }
        }


        $text.="</div>";
        return $text;

    }

    /**
     * @param $files
     * @param $name
     * @return array
     */
    public function fileUpload($files, $name)
    {

        $filename = array();
        foreach ($files as $name2 => $file):
            $uzanti = explode('.',$file['name']);
            $uzanti = $uzanti[count($uzanti)-1];

            $fname = $this->addegisir($file['name'], strtolower($name));
            if (isset($file['type']) and in_array(strtolower($uzanti), $this->allow_file_type)):  move_uploaded_file($file['tmp_name'], $this->folder . '/dosya/' . $fname);
                $filename[] = $fname;
            endif;

        endforeach;

        return $filename;
    }


    /**
     * @param $deger
     * @return mixed|null|string|string[]
     */
    public function perma($deger)
    {
        $turkce = array("þ", "Þ", "ý", "(", ")", "'", "ü", "Ü", "ö", "Ö", "ç", "Ç", " ", "/", "*", "?", "ð", "Ð", "Ý", "Ã–", "Ã‡", "Åž", "Ä°", "Äž", "Ãœ", "Ä±", "Ã¶", "Ã§", "ÅŸ", "ÄŸ", "Ã¼", "ı", "ğ", 'İ', 'Ü', 'Ğ', 'Ş', '.', 'ş', '"');
        $duzgun = array("s", "s", "i", "", "", "", "u", "u", "o", "o", "c", "c", "-", "", "-", "", "g", "g", "i", "o", "c", "s", "i", "g", "u", "i", "o", "c", "s", "g", "u", "i", "g", 'i', 'u', 'g', 's', '', 's', '');
        $deger = str_replace($turkce, $duzgun, $deger);
        $deger = preg_replace("@[^A-Za-z0-9\-_]+@i", "", $deger);
        //  $date =rand(10000,99999);
        return $deger;
    }

    /**
     * @param $file
     * @param $control
     * @param bool $string
     * @return string
     * @throws \Dwoo_Exception
     */
    public function load($file, $control, $string = false)
    {

        $dwoo = new \Dwoo();
       // $dwoo->getCacheTime(2000);
        $dwoo->setCompileDir('compiled/');
        $dwoo->setCacheDir('cache/');


        $dwoo->clearCompiled();
        if($string):
            if ($file and file_exists($file . '.tpl')):
               return  $dwoo->output($file.'.tpl', $control);
            //  include('theme/' . $file . '.tpl');
            endif;
        else:
            if ($file and file_exists($file . '.tpl')):
              $dwoo->output($file . '.tpl', $control);

        endif;
        endif;

    }

    /**
     * @param $file
     * @param array $data
     * @return false|string
     */
    public function _includeBackend($file, $data = array())
    {
        if ($data)
        {
            extract($data);
        }
        include($file);
        return ob_get_clean();
    }


    /*public function loadphp($file, $data, $string = false)
    {
        if ($string):
            if ($file and file_exists( $file . '.php'))
                $this->_includeBackend( $file . '.php', $data);
            else
                $this->_includeBackend( $file . '.php', $data);
        else:
            if ($file and file_exists( $file . '.php'))
                return  $this->_includeBackend( $file . '.php', $data);
            else
                return  $this->_includeBackend( $file . '.php', $data);
        endif;
    }*/


    /**
     * @param $file
     * @param $control
     * @param bool $string
     * @return mixed
     */
    public function loadphp($file, $control, $string = false)
    {
        if ($string):
            if ($file and file_exists( $file . '.php'))
                include( $file . '.php');
            else
                include( $file . '.php');
        else:
            if ($file and file_exists( $file . '.php'))
                return include( $file . '.php');
            else
                return include( $file . '.php');
        endif;
    }


    /**
     * @param $post
     * @param null $dil
     * @return false|string
     */
    public function arraytojson($post, $dil=null)
    {
        //DİL SEÇENEĞİ $post = $post.(($dil) ? '_'.$dil:null);
        $c = array();

        if (is_array($post))
            foreach ($post as $p):
                $c[] = $p;
            endforeach;
        return json_encode($c);
    }


    /**
     * @param $veri
     * @param $tablo
     * @param int $page
     * @return bool
     */
    public function sirala($veri, $tablo, $page = 1)
    {
        $sirala = explode(',',$veri);

        if(count($sirala)>1):
            if ($page != 1){
                $x = ($page * $this->settings->config("veriLimit") - ($this->settings->config("veriLimit") + 1));
            }
            else {
                $x = 1;
            }

            foreach($sirala as $sira):
                $this->dbConn->update($tablo,array('sira'=>$x),$sira);
                $x++;
            endforeach;

           return true;
        endif;


    }


    /**
     * @param $sifre
     * @return string
     */
    public function sifrele($sifre){
        $password = $this->settings->config('sifre_anahtar');
        $method = 'aes-256-cbc';
        $password = substr(hash('sha256', $password, true), 0, 32);

        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        return base64_encode(openssl_encrypt($sifre, $method, $password, OPENSSL_RAW_DATA, $iv));
    }

    /**
     * @param $sifreliVeri
     * @return string
     */
    public function sifreCoz($sifreliVeri){
        $password = $this->settings->config('sifre_anahtar');
        $method = 'aes-256-cbc';
        $password = substr(hash('sha256', $password, true), 0, 32);

        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        return openssl_decrypt(base64_decode($sifreliVeri), $method, $password, OPENSSL_RAW_DATA, $iv);
    }


    /**
     *
     */
    public function AuthCheck()
    {

        if ($this->loginKey == ""){
            $this->RedirectURL($this->BaseAdminURL('login/cikis'));
        }

        if ($this->user_pass == ""){
            $this->RedirectURL($this->BaseAdminURL('login/cikis'));
        }

        $kontrol = $this->dbConn->tekSorgu("SELECT * FROM kullanici WHERE id =  $this->user_id and sifre = '$this->user_pass'");

        if (is_array($kontrol) and count($kontrol) > 0){
           if ($kontrol["tur"] != $this->user_type){
               $this->RedirectURL($this->BaseAdminURL('login/cikis'));
           }
        }

        else {
            $this->RedirectURL($this->BaseAdminURL('login/cikis'));
        }


    }



    /**
     * @param $table
     * @return int|mixed
     */


    public function Order($table, $ustu = ""){

        $sql = ($ustu != "") ? " ustu = $ustu and sil <> 1" : " sil <> 1";

        $data =  $this->dbConn->tekSorgu("select sira from $table WHERE $sql ORDER BY sira DESC");

        return (is_array($data)) ? $data["sira"] + 1 : 1;
    }

    /**
     * @param $kosul
     * @return int|mixed
     */
    public function OrderFile($kosul){

        $sql = ($kosul != "") ? " $kosul and sil <> 1" : " sil <> 1";

        $data =  $this->dbConn->tekSorgu("select sira from dosyalar WHERE $sql ORDER BY sira DESC");

        return (is_array($data)) ? $data["sira"] + 1 : 1;
    }


    /**
     * @param $intNumber
     * @return string
     */
    public function moneyFormat($intNumber){
        return number_format($intNumber, 2, ',', '.');
    }

    /**
     * @param $intNumber
     * @return mixed
     */
    public function returnDecimal($intNumber){
        return str_replace(array(".", ","),array("", "."), $intNumber);
    }

    /**
     * @param $element
     * @param null $defaultval
     * @return mixed|null|string
     */
    public function get_element($element, $defaultval=null)
    {
        $q =  $this->dbConn->tekSorgu("select value from ayarlar where name='$element'");

        if($q)
        {
            if($defaultval) {
                $this->dbConn->update('ayarlar', array('value'=>$defaultval),array('name'=>$element));
                return $defaultval;
            }
            else return ((isset($q['value']) and $q['value']) ? $this->temizle($q['value']):'');
        }
        else
        {
            $this->dbConn->insert('ayarlar', array('name'=>$element,'value'=>$this->kirlet($defaultval)));
            return $defaultval;
        }


    }


    /**
     * @param $string
     * @return bool
     */
    public static function isJSON($string){
            return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
        }

    /**
     * @param $resim
     * @return mixed|null|string
     */
    public function resimGet($resim)
    {
        if(self::isJSON($resim)):
            $files =  json_decode($resim,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            return (isset($files['image']) and is_array($files)) ? (($files['crop']=="true") ? "crop_".$files['image']:$files['image']):null;
        else:
            return $resim;
        endif;
    }


    /**
     * @param $post
     * @param null $dil
     * @return null
     */
    public function _POST($post, $dil=null)
    {
        $post = $post.(($dil) ? '_'.$dil:null);
         return (isset($_POST[$post])) ? $_POST[$post]:null;
    }


    /**
     * @param $post
     * @return false|string
     */
    public function _MULTIPOST($post)
    {
        $a = array();
        $x=0;
        $p = (isset($_POST[$post])) ? $_POST[$post]:null;

        if(is_array($p))
            for ($i=0;$i<count($p)-1;$i++):
                $x++;
                $a[]    = array($post.$x=>$p[$i]);
                endfor;

        return  json_encode($a,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }


    /**
     * @param $post
     * @param null $dil
     * @return null
     */
    public function _GET($post, $dil=null)
    {
        $post = $post.(($dil) ? '_'.$dil:null);
        return (isset($_GET[$post])) ? $_GET[$post]:null;
    }

    /**
     * @param $image
     * @return false|string
     */
    public function _RESIM($image)
    {
        $images =  array('image'=>$this->_POST($image),'crop'=>$this->_POST('crop_'.$image ));
        return  $files =  json_encode($images,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * @param $p
     * @return false|string
     */
    public function _DOSYA($p)
    {
        $file = array();
        $files = explode(',',$this->_POST($p));
        if(is_array($files))
            foreach ($files as $item):

                if($item) {
                    $uzanti = explode('.',$item);
                    $uzanti = $uzanti[count($uzanti)-1];

                    $file[] = array('file'=>$item,'type' => $uzanti);

                }
                endforeach;


        return  $files =  json_encode($file,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * @param $image
     * @param null $dir (uploadFolder)
     * @param null $quality (1-9)
     * @param null $filename (custom fileName)
     * @param string $extension (file extension)
     * @return null|string (saved Image)
     */
    public function _RESIM_BASE64($image, $dir = null, $filename = null, $extension = 'png', $quality = null)
    {
        $image = $this->_POST($image);

        $baslik = $this->permalink(($this->_POST("baslik_tr") != "") ? $this->_POST("baslik_tr") : $this->_POST("baslik"));

        if ($image != null){

            if (strstr($image, "data:image/")){
                $path = $this->folder;
                if (!empty($dir)) $path .= '/' . $dir;

                if (!file_exists($path)){
                    mkdir($this->folder."/".$dir, 0755);
                }


                if (empty($filename)) $filename = $baslik.'-resim-' . rand(100000, 999999) . '.'. $extension;

                $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));


                $im = imagecreatefromstring($data);

                if ($extension == "jpg"){
                    imagejpeg($im,$path . '/' . $filename, ((!empty($quality))) ? $quality : 100);
                }
                else{
                    imagealphablending($im, true);
                    imagesavealpha($im, true);
                    imagepng($im,$path . '/' . $filename, ((!empty($quality))) ? $quality : 9);
                }


                //WEBP KAYDET
          /*      imagealphablending($im, true);
                imagesavealpha($im, true);
                imagewebp($im, $path . '/' . $filename, ((!empty($quality))) ? $quality : 90);*/


                imagedestroy($im);
                @chmod($path."/".$filename, 0755);

                //file_put_contents($path . '/' . $filename, $data);
                return $filename;
            }

            else{
                return $image;
            }

        }

        else {
            return null;
        }


    }

    /**
     * @param $image
     */
    public  function _ResimSil($image)
    {
        if(self::isJSON($image)):



            else:

            endif;


    }

    /**
     * @param $sql
     * @param null $folder
     * @param null $id
     */
    public  function  _ResimBul($sql, $folder=null, $id=null)
    {

        if($sql):


            endif;


    }

    /**
     * @param $file
     * @param null $data
     * @return false|null|string
     */
    public function _inc($file, $data=null)
    {

        $data = array_merge($data);
        if($data) extract($data);
        if($file and file_exists('theme/'.$this->settings->config('adminTheme').'/layout/Form/'.$file.'.php')):
            ob_start();
            include 'theme/'.$this->settings->config('adminTheme').'/layout/Form/'.$file.'.php';
            return ob_get_clean();
        else:
            if($file and file_exists('theme/admin/layout/'.$file.'.php')):
                ob_start();
                include 'theme/admin/layout/'.$file.'.php';
                return ob_get_clean();
            else:
                return null;
            endif;
        endif;

    }

    public function _inc_module_settings($file, $data=null)
    {

        $form = new Form($this->settings);
        $dataModul = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE modul = '$file'");
        $boyutlar = $this->dbConn->tekSorgu("SELECT modul_id, id as b_id, big, thumb, ek FROM boyutlar WHERE modul_id = {$dataModul["id"]}");
        $appendData = array_merge($dataModul, $boyutlar);
        $data = array_merge($data, array("form"=>$form, "data"=>$appendData));
        if($data) extract($data);
        if($file and file_exists('modules/settings/'.$file.'.php')):
            ob_start();
            include 'modules/settings//'.$file.'.php';
            return ob_get_clean();

        endif;

    }



    public function _inc_module_help($file, $data=null)
    {

        $form = new Form($this->settings);
        $dataModul = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE modul    = '$file'");
        $boyutlar  = $this->dbConn->tekSorgu("SELECT * FROM boyutlar WHERE modul_id = {$dataModul["id"]}");
        $appendData = array_merge($dataModul, $boyutlar);
        $data = array_merge($data, array("form"=>$form, "data"=>$appendData));
        if($data) extract($data);
        if($file and file_exists('modules/help/'.$file.'.php')):
            ob_start();
            include 'modules/help/'.$file.'.php';
            return ob_get_clean();
        endif;

    }


    public function exits_module_settings($module){
        return (file_exists("modules/settings/".$module.".php")) ? true : false;
    }


    public function exits_module_help($module){
        return (file_exists("modules/help/".$module.".php")) ? true : false;
    }


    public function modul_image_size($modul_id, $get = "big"){
        $query = $this->dbConn->tekSorgu("SELECT * FROM boyutlar WHERE modul_id = $modul_id");

        if ($query){
            return (!empty($query[$get])) ? $query[$get] : "800x600";
        }
        else {
            $this->dbConn->insert("boyutlar", array(
               "big"=>"800x600",
               "thumb"=>"400x300",
               "ek"=>"800x600",
               "modul_id"=>$modul_id
            ));

            return "800x600";
        }
    }






    public function getParameter(){
        $array = array();
        $ex = explode('/',$_GET["cmd"]);

        $array["modul"] = $ex[0];
        $array["function"] = $ex[1];
        if (isset($ex[2])){
            $array["id"] = $ex[2];
        }

        return $array;
    }


    /**
     * @param $file
     * @param $param
     * @param $lang
     * @return mixed
     */
    public function langGet($file, $param, $lang)
    {
        $this->pageLang = $lang;
        $data = include $_SERVER["DOCUMENT_ROOT"]."include/lang/".$lang."/".$file.".php";
        return $data[$param];
    }


    public function ceviriDosyaYaz($kid)
    {
        if (!empty($kid)){
            foreach ($this->settings->lang("lang") as $dil=>$title){
                $folder = str_replace(["index.php", $this->settings->config("adminfolder")], ["", ""],$_SERVER['SCRIPT_FILENAME'])."/include/lang/".$dil;
                $file = "/".$kid.".php";
                if (!file_exists($folder)){
                    mkdir($folder, 655);
                }
                if (file_exists($file)){
                    @unlink($file);
                }

                $fh = fopen($folder.$file, 'w+');
                $text = "<?php\n\nreturn[\n\n";

                $data = $this->dbConn->sorgu("SELECT * FROM `ceviri` WHERE kid = '".$kid."' ORDER BY id ASC");
                if (is_array($data)){
                    foreach ($data as $item){
                        $text.="\t\t'".$item["key"]."'=>'".$item[$dil]."',\n";
                    }
                }

                var_dump($data);

                $text.="\n\n];";

                fwrite($fh, $text);
                fclose($fh);
            }



        }
    }


    public function kisalt($string, $maxuzunluk): string
    {
        $uzunluk = mb_strlen($string, "UTF-8");
        if ($uzunluk > $maxuzunluk){
            $text = mb_substr($string, 0, $maxuzunluk, "UTF-8")."...";
        }else {
            $text = $string;
        }
        return $text;
    }



} 