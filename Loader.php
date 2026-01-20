<?php
header('Content-Type: text/html; charset=utf-8');
include( __DIR__.'/vendor/autoload.php');
include( __DIR__.'/include/Smap.php');
include( __DIR__.'/include/Functions.php');
include( __DIR__.'/include/Database.php');
include( __DIR__.'/include/Mail.php');
include( __DIR__.'/include/FrontClass.php');
include( __DIR__.'/include/Lang.php');
include( __DIR__.'/include/Form.php');
include( __DIR__.'/include/Captcha/Captcha.php');

if (!function_exists('getallheaders')) {
    function getallheaders() {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}

if( !function_exists('random_bytes') )
{
    function random_bytes($length = 6)
    {
        $characters = '0123456789';
        $characters_length = strlen($characters);
        $output = '';
        for ($i = 0; $i < $length; $i++)
            $output .= $characters[rand(0, $characters_length - 1)];

        return $output;
    }
}


use Snowsoft\Captcha\Captcha;

/**
 * Class Loader
 * @var string $title
 */
class Loader extends FrontClass
{
    public $settings;
    public $themeURL;
    public $katalogURL;
    public $bultenURL;
    public $lang;
    public $theme = 'default';
    public $fullUrl;
    public $getLoaderLang;
    public function __construct($settings)
    {
        parent::__construct($settings);
        $this->settings = $settings;
        $this->theme = $this->settings->config('siteTemasi').'/';
        $this->themeURL = $this->settings->config('url').'view/'.$this->theme."assets/";
        $this->katalogURL = $this->settings->config('url').'view/'.$this->theme."e-katalog/";
        $this->bultenURL = $this->settings->config('url').'view/'.$this->theme."bulten/";
        $this->fullUrl = $this->settings->config("url").$_SERVER["REQUEST_URI"];
    }


    public function setLoaderLang($lng)
    {
        $this->getLoaderLang = $lng;
    }


    public function sifrele($sifre){
        $password =  $this->settings->config('sifre_anahtar');
        $method = 'aes-256-cbc';
        $password = substr(hash('sha256', $password, true), 0, 32);

        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        return base64_encode(openssl_encrypt($sifre, $method, $password, OPENSSL_RAW_DATA, $iv));
    }

    public function sifreCoz($sifreliVeri){
        $password =  $this->settings->config('sifre_anahtar');
        $method = 'aes-256-cbc';
        $password = substr(hash('sha256', $password, true), 0, 32);

        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        return openssl_decrypt(base64_decode($sifreliVeri), $method, $password, OPENSSL_RAW_DATA, $iv);
    }

    public function uzantiAl($dosya)
    {
        $par = explode(".",$dosya);
        $ct = count($par);
        return $uzanti = $par[$ct-1];
    }




    public function uzantiKontrol($uzanti)
    {
        $desteklenen = array("jpg","jpeg","png","doc","docx","doc","xls","xlsx","pdf");
        if (!in_array($uzanti, $desteklenen))
        {
            return false;
        }
        else {
            return true;
        }
    }


    public function resimUzantiKontrol($uzanti)
    {
        $desteklenen = array("jpg","jpeg","png");
        if (!in_array($uzanti, $desteklenen))
        {
            return false;
        }
        else {
            return true;
        }
    }

    public function boyutKontrol($dosyaBoyut)
    {
        $maks_boyut = 10;

        if($dosyaBoyut > (1024*1024*$maks_boyut)){
            return false;
        }
        else {
            return true;
        }
    }

    public function pageLoader($data=array())
    {


        $LangGET = new \Lang($data['lang']);
        $LangLink = new \Lang((($data['lang']=="tr") ? 'tr':'en'));

        $this->lang  = $LangGET;

        $data = array_merge(array('LangGET'=>$LangGET,'LangLink'=>$LangLink),$data);

        $text = "";
        $disable_header_footer = array("e-katalog","basvuru", 'bulten');
        if (!in_array($data["page"], $disable_header_footer)){
            $text .= $this->_include('bolum/ust',$data,$this->theme);
        }




        switch ($data['page']):


            case 'index':
                $text .=  $this->_include('sayfa/index',$data,$this->theme);
                break;

            default:
                $text .=  $this->_include('sayfa/'.$data['page'],$data,$this->theme);
                break;



            case 'kurumsal-kimlik':
            case 'corporate-identity':
                $text .= $this->_include('sayfa/kurumsal-kimlik',$data,$this->theme);
            break;


            case 'haberler':
            case 'news':
                $text .= $this->_include('sayfa/haberler',$data,$this->theme);
                break;


            case 'haber':
            case 'new':
                $text .= $this->_include('sayfa/haber',$data,$this->theme);
                break;

            case 'announcements':
            case 'duyurular':
                $text .= $this->_include('sayfa/duyurular',$data,$this->theme);
                break;


            case 'announcement':
            case 'duyuru':
                $text .= $this->_include('sayfa/duyuru',$data,$this->theme);
                break;


            case 'projeler':
            case 'projects':
                $text .= $this->_include('sayfa/projeler',$data,$this->theme);
                break;


            case 'proje':
            case 'project':
                $text .= $this->_include('sayfa/proje',$data,$this->theme);
                break;

            case 'etkinlikler':
            case 'events':
                $text .= $this->_include('sayfa/etkinlikler',$data,$this->theme);
                break;


            case 'etkinlik':
            case 'event':
                $text .= $this->_include('sayfa/etkinlik',$data,$this->theme);
            break;


            case 'educations':
            case 'kurslar':
                $text .= $this->_include('sayfa/kurslar',$data,$this->theme);
                break;


            case 'education':
            case 'kurs':
                $text .= $this->_include('sayfa/kurs',$data,$this->theme);
                break;

            case 'education-service':
            case 'egitim-hizmetleri':
                $text .= $this->_include('sayfa/egitim-hizmetleri',$data,$this->theme);
                break;

            case 'kurumsal':
            case 'corporate':
                $text .= $this->_include('sayfa/kurumsal',$data,$this->theme);
                break;

            case 'destek':
                $text .= $this->_include('sayfa/destek',$data,$this->theme);
                break;

            case 'legislation':
            case 'mevzuat':
                $text .= $this->_include('sayfa/mevzuat',$data,$this->theme);
                break;

            case 'policies':
            case 'politikalar':
                $text .= $this->_include('sayfa/politikalar',$data,$this->theme);
                break;

            case 'iletisim':
            case 'contact':
                $text .= $this->_include('sayfa/iletisim',$data,$this->theme);
                break;


            case 'katalog':
            case 'catalogue':
                $text .= $this->_include('sayfa/katalog',$data,$this->theme);
                break;



            case 'hata':
                $text .= $this->_include('sayfa/hata',$data,$this->theme);
                break;




        endswitch;


        if (!in_array($data["page"], $disable_header_footer)){
            $text .= $this->_include('bolum/alt',$data,$this->theme);
        }

        return  $text;



    }

    // ajax/*
    public function ajaxLoader($page)
    {


        switch ($page):



            case 'testControl':
                $lang = Request::GETURL("lang", "tr");

                $return = array();
                $data =  $this->langGet("sorular", "data", $lang);
                $error = array();
                $answers = array();
                $correct_count = 0;
                $incorrect_count = 0;
                $question_score = intval(100 / count($data));



                foreach ($data as $key=>$item){
                    $value = Request::POST("a".$key);
                    $correct = $this->langGet("sorular", "data", $lang)[$key]["correct"];

                    if ($value == ""){
                        $error[$key]= str_replace('%q%', $key, $this->langGet("genel", "soru_bos", $lang));
                    }
                    if (count($error) < 1){
                        if ($value == $correct){
                            $answers[$key] = ['result'=>true,'correct'=>$correct, 'selected'=>$value];
                            $correct_count++;
                        }else {
                            $answers[$key] = ['result'=>false, 'correct'=>$correct,'selected'=>$value];
                            $incorrect_count++;
                        }
                    }
                }

                $score = $correct_count * $question_score;

                $message = "<table class='table'>";
                $icon = "success";
                $message_code = 1;

                $message.="<tr><td class='text-success' colspan='2'>".$this->langGet("genel", "puaniniz", $lang)." <h4 style='font-size:50px;'>".$score."</h4>";
                $short_message = "";

                if ($score >= 0 && $score <= 48){
                    $message .= "<p class='text-center text-danger' style='font-size:20px;'>".$this->langGet("genel", "test_msg1", $lang)."</p></td></tr>";
                    $short_message = $this->langGet("genel", "test_msg1", $lang);
                    $icon = "error";
                }

                if ($score >= 49 && $score <= 54){
                    $message .= "<p class='text-center text-warning' style='font-size:20px;'>".$this->langGet("genel", "test_msg2", $lang)."</p></td></tr>";
                    $short_message = $this->langGet("genel", "test_msg2", $lang);
                    $icon = "warning";
                    $message_code = 2;
                }

                if ($score >= 55 && $score <= 88){
                    $message .= "<p class='text-center text-warning' style='font-size:20px;'>".$this->langGet("genel", "test_msg3", $lang)."</p></td></tr>";
                    $short_message = $this->langGet("genel", "test_msg3", $lang);
                    $icon = "info";
                    $message_code = 3;
                }

                if ($score >= 89 && $score <= 100){
                    $message .= "<p class='text-center text-success' style='font-size:20px;'>".$this->langGet("genel", "test_msg4", $lang)."</p></td></tr>";
                    $short_message = $this->langGet("genel", "test_msg4", $lang);
                    $icon = "success";
                    $message_code = 4;
                }

                $message.="<tr><th class='text-success text-left'>".$this->langGet("genel", "dogru_sayisi", $lang).":</th><td class='text-left'>".$correct_count."</td></tr>";
                $message.="<tr><th class='text-danger text-left'>".$this->langGet("genel", "yanlis_sayisi", $lang).":</th><td class='text-left'>".$incorrect_count."</td></tr>";


                $message.="</table>";




                if (count($error) > 0){
                    $return["result"] = 0;
                    $return["messages"] = "<span class='text-danger font-weight-light'>".implode("<br>", $error)."</span>";
                    $icon = "error";
                    $return["title"] = $this->langGet("genel", "hata", $lang);
                }else {
                    $return["result"] = 1;
                    $icon = "success";
                    $return["title"] =  $this->langGet("genel", "tebrikler", $lang);
                    $return["messages"] = $message;
                }

                $return["icon"] = $icon;
                $return["total_question"] = count($data);
                $return["total_correct"] = $correct_count;
                $return["answers"] = $answers;

                $return["score"] = $score;
                $return["short_message"] = $short_message;
                $return["correct_count"] = $correct_count;
                $return["incorrect_count"] = $incorrect_count;
                $return["message_code"] = $message_code;
                $_SESSION["girisimcilik_testi"] = $return;

                echo json_encode($return);


            break;




            case 'anket':
                $lang = Request::GETURL("lang", "tr");

                $return = array();
                $error = array();
                $post = array();

                $data = $this->sorgu("SELECT * FROM anket");
                foreach ($data as $item){
                    $id = $item['id'];
                    $selectedVal = Request::POST("a".$id);
                    if (empty($selectedVal)){
                        $error[$id] = $id;
                    }
                    if (count($error) < 1){
                        $post["question_".$id] = $selectedVal;
                    }
                }

                $this->insert("anket_cevap", array_merge($post, ["tarih"=>date("d.m.Y"), "ip"=>$this->getIp(), 'lang'=>$lang]));

                if (count($error) < 1){
                    $message = $this->langGet("genel", "anket_degerlendirme", $lang);
                    $icon = "success";
                    $return["messages"] = $message;
                    $return["icon"] = $icon;
                    $return["title"] = $this->langGet("genel", "basarili", $lang);
                    $return["result"] = 1;

                }else {
                    $message = $this->langGet("genel", "iki_secenek", $lang);
                    $icon = "error";
                    $return["messages"] = $message;
                    $return["icon"] = $icon;
                    $return["title"] = $this->langGet("genel", "hata", $lang);
                    $return["result"] = 0;
                }


                    $_SESSION["anket"] = $return;
                    echo json_encode($return);



                break;




            case 'getcaptchaimage':
                $captcha = new \Captcha();
                $captcha_code = $captcha->getCaptchaCode(6);
                $captcha->setSession('captcha_code', $captcha_code);
                $imageData = $captcha->createCaptchaImage($captcha_code);
                $captcha->renderCaptchaImage($imageData);
            break;


            case 'iletisimForm':

                $post  = [];
                $error = [];
                $required = array("adi", "tel", "email", "mesaj",);


                if(count(Request::postAll()) > 0){
                    foreach (Request::postAll() as $key=>$value){
                        if (in_array($key, $required)){
                            if ($value == ""){
                                $error[$key] = "Boş Bırakılamaz";
                            }
                        }
                    }
                }
                else {
                    $error["all"] = "Boş alanları doldurunuz";
                }




                $govde = $this->_include('ajax/iletisim',
                    array(
                        'adi'=>Request::POST('adi'),
                        'mesaj'=>Request::POST('mesaj'),
                        'konu'=>Request::POST('konu'),
                        'tel'=>Request::POST('tel'),
                        'email'=>Request::POST('email'),
                    ));

                    if (count($error) < 1){
                        $captcha = new \Captcha();
                        if($captcha->validateCaptcha(Request::POST("captcha_value"))) {
                            echo $this->_SEND($this->ayarlar('email'),$this->ayarlar('email'),"İletişim Formu",$govde, $this->ayarlar("firma_tr"));
                        }else {
                            echo 3;
                        }
                    }else {
                        echo 4;
                    }

                break;


            case 'basvuru':
                $forms = $this->settings->form();
                $error = [];
                $required = array("adi", "tel", "email");
                foreach (Request::postAll() as $key => $value) {
                    if ($key != "recaptcha_return") :
                        if (in_array($key, $required)) {
                            if ($value == "") {
                                $error[$key] = "Boş Bırakılamaz";
                            }
                        }
                    endif;
                }

                foreach ($forms['inputs'] as $input) :
                    $post[$input['name']] =  $this->kirlet(Request::POST($input['name']));

                endforeach;
                foreach ($forms['selects'] as $select) :
                    $post[$select['name']] =  $this->kirlet(Request::POST($select['name']));
                endforeach;
                foreach ($forms['textareas'] as $textarea) :
                    $post[$textarea['name']] =  $this->kirlet(Request::POST($textarea['name']));
                endforeach;



                $govde1 = $this->_include(
                    'ajax/basvuru',
                    $post
                );


                if (count($error) < 1) {
                    $captcha = new \Captcha();
                    if ($captcha->validateCaptcha(Request::POST("captcha_value"))) {
                        echo $this->_SEND($this->ayarlar('email'), $this->ayarlar('email'), "İş Başvuru Formu", $govde1, $this->ayarlar("unvan_tr"));
                    } else {
                        echo 3;
                    }
                } else {
                    echo 4;
                }

                break;



            case 'testEkipmaniDestek':
                $error = [];

                $required = array("adi", "tel", "email","mesaj");
                foreach (Request::postAll() as $key=>$value){
                    if ($key != "recaptcha_return"):
                        if (in_array($key, $required)){
                            if ($value == ""){
                                $error[$key] = "Boş Bırakılamaz";
                            }
                        }
                    endif;
                }
                $govde1 = $this->_include('ajax/testEkipmaniDestek',
                    array(
                        'adi'=>$this->kirlet(Request::POST('adi')),
                        'tel'=>$this->kirlet(Request::POST('tel')),
                        'email'=>Request::POST('email'),
                        'gridRadios'=>$this->kirlet(Request::POST('gridRadios')),
                        'mesaj'=>$this->kirlet(Request::POST('mesaj')),

                    ));


                if (count($error) < 1){
                    $captcha = new \Captcha();
                    if($captcha->validateCaptcha(Request::POST("captcha_value"))) {
                        echo $this->_SEND($this->ayarlar('email'),$this->ayarlar('email'),"Test Ekipmanları Destek Hattı Formu",$govde1, $this->ayarlar("unvan_tr"));
                    }else {
                        echo 3;
                    }
                }else {
                    echo 4;
                }

                break;

            case 'yedekParcaDestek':
                $error = [];

                $required = array("adi", "tel", "email","mesaj");
                foreach (Request::postAll() as $key=>$value){
                    if ($key != "recaptcha_return"):
                        if (in_array($key, $required)){
                            if ($value == ""){
                                $error[$key] = "Boş Bırakılamaz";
                            }
                        }
                    endif;
                }
                $govde1 = $this->_include('ajax/yedekParcaDestek',
                    array(
                        'adi'=>$this->kirlet(Request::POST('adi')),
                        'tel'=>$this->kirlet(Request::POST('tel')),
                        'email'=>Request::POST('email'),
                        'gridRadios'=>Request::POST('gridRadios'),
                        'mesaj'=>$this->kirlet(Request::POST('mesaj')),

                    ));


                if (count($error) < 1){
                    $captcha = new \Captcha();
                    if($captcha->validateCaptcha(Request::POST("captcha_value"))) {
                        echo $this->_SEND($this->ayarlar('email'),$this->ayarlar('email'),"Yedek Parça Destek Hattı Formu",$govde1, $this->ayarlar("unvan_tr"));
                    }else {
                        echo 3;
                    }
                }else {
                    echo 4;
                }

                break;




            case 'messageForm':

                $govde = $this->_include('ajax/messageForm',
                    array(
                        'adi'=>Request::POST('name'),
                        'mesaj'=>Request::POST('messages'),
                        'konu'=>Request::POST('subject'),
                        'tel'=>Request::POST('phone'),
                        'email'=>Request::POST('email'),
                    ));

                $captcha = new \Captcha();
                if($captcha->validateCaptcha(Request::POST("captcha_value"))){
                    echo $this->_SEND($this->ayarlar('email'),$this->ayarlar('email'),"Görüş & Öneri Formu",$govde, $this->ayarlar("unvan_tr"));
                }else {
                    echo 3;
                }

                break;


            case 'support_form':

                $govde = $this->_include('ajax/support_form',
                    array(
                        'adi'=>Request::POST('adi'),
                        'mesaj'=>Request::POST('mesaj'),
                        'tel'=>Request::POST('tel'),
                        'email'=>Request::POST('email'),
                    ));

                $captcha = new \Captcha();
                if($captcha->validateCaptcha(Request::POST("captcha_value"))){
                    echo $this->_SEND($this->ayarlar('email'),$this->ayarlar('email'),"Müşteri Hizmetleri Destek Formu",$govde, $this->ayarlar("unvan_tr"));
                }else {
                    echo 3;
                }

                break;
            case 'kiralik_form':

                $ik_il = $this->kirlet(Request::POST('ik_il'));
                $ik_ilce = $this->kirlet(Request::POST('ik_ilce'));
                $il = $this->tekSorgu("SELECT * FROM city WHERE CityID = ".$ik_il)["CityName"];
                $ilce = $this->tekSorgu("SELECT * FROM town WHERE TownID = ".$ik_ilce)["TownName"];

                $govde = $this->_include('ajax/kiralik_form',
                    array(
                        'adi'=>Request::POST('adi'),
                        'email'=>Request::POST('email'),
                        'tel'=>Request::POST('tel'),
                        'adres'=>Request::POST('adres'),
                        'kat_sayisi'=>Request::POST('kat_sayisi'),
                        'floor_m2'=>Request::POST('floor_m2'),
                        'mesaj'=>Request::POST('mesaj'),
                        "il"=>$il,
                        "ilce"=>$ilce,
                    ));

                $captcha = new \Captcha();
                if($captcha->validateCaptcha(Request::POST("captcha_value"))){
                    echo $this->_SEND($this->ayarlar('email'),$this->ayarlar('email'),"Kiralik Dükkan Önerisi",$govde, $this->ayarlar("unvan_tr"));
                }else {
                    echo 3;
                }

            break;


            case 'ilceler':
                header('Content-Type: text/html; charset=utf-8');
                $il = $this->koru(Request::POST('il'));

                if (isset($il) && (int)$il > 0) {
                    $veri = $this->sorgu("SELECT * FROM town WHERE CityID=$il");
                    echo "<option value='0'>İlçe Seçiniz.</option>";

                    foreach ($veri as $ilce) {
                        echo "<option value='".$ilce['TownID']."'>".$ilce["TownName"]."</option>";
                    }
                }

            break;







            case 'teklif':




                    $govde = $this->_include('ajax/teklif',
                    array(
                        'adi'=>Request::POST('adi'),
                        'mesaj'=>Request::POST('mesaj'),
                        'tel'=>Request::POST('tel'),
                        'konu'=>Request::POST('konu'),
                        'email'=>Request::POST('email'),
                    ));


                    if ($this->RecaptchaValidate(Request::POST("recaptcha_return"))){
                        echo $this->_SEND($this->ayarlar('email'),$this->ayarlar('email'),'Talep Formu',$govde);
                    }else {
                        echo 3;
                    }




                break;







            case 'isBasvuruForm':

                    $d_tarihi = new DateTime(date("Y-m-d", strtotime($this->kirlet(Request::POST('dogum_yeri_ve_tarihi')))));
                    $now = new DateTime(date("Y-m-d"));

                    $interval= $d_tarihi->diff($now);
                    $yas = $interval->y;


                    if ($yas < 22){
                        echo 7;
                        exit();
                    }


                    if (Request::POST('askerlik') === "Tecilli"){
                        $tecil_tarihi = new DateTime(date("Y-d-m", strtotime($this->kirlet(Request::POST('tecil_tarih')))));
                        $fark= $tecil_tarihi->diff($now);
                        $tecil_suresi = $fark->y;
                        if ($tecil_suresi < 2){
                            echo 8;
                            exit();
                        }
                    }


                    $istenen_bolumler = str_replace(",", ", ", $this->kirlet(Request::POST('bolum_text')));

                    $mesaj = "";
                    $dosya = "";

                    @$uploads_dir = $this->settings->config('folder')."kariyer/";

                    @$klasor = $_SERVER['DOCUMENT_ROOT'].$uploads_dir;

                    @exec("chmod -R 0777 $klasor");

                    $date = date("d-m-Y");

                    $captcha = Request::POST("captcha");







                    if ($_FILES["foto"]["name"] != ""){
                        $tmp_name = $_FILES["foto"]["tmp_name"];
                        $name = $_FILES["foto"]["name"];
                        $fsize = $_FILES["foto"]["size"];
                        $uzanti = $this->uzantiAl($name);


                        if ($name != ""){
                            if ($this->uzantiKontrol($uzanti)){
                                if ($this->boyutKontrol($fsize)){
                                    $rand = rand(000000,999999);
                                    $new = $this->permalink($this->kirlet(Request::POST('adi_soyadi')))."-".$date."-".$rand.".".$uzanti;
                                    $yukle = move_uploaded_file($tmp_name, "$uploads_dir$new");
                                    $this->kucult($uploads_dir,$new,500,0);
                                    if ($yukle){
                                        $dosya = $this->baseURL($uploads_dir.$new);
                                    }
                                }
                                else {
                                    $mesaj.= "4";
                                }
                            }

                            else {
                                $mesaj.= "5";
                            }

                        }
                    }



                    if ($_FILES["cv"]["name"] != ""){
                        $tmp_name = $_FILES["cv"]["tmp_name"];
                        $name = $_FILES["cv"]["name"];
                        $fsize = $_FILES["cv"]["size"];
                        $uzanti = $this->uzantiAl($name);
                        $files_ext = array("doc", "docx", "xls", "xlsx","pdf");


                        if ($name != ""){
                            if ($this->uzantiKontrol($uzanti)){
                                if ($this->boyutKontrol($fsize)){
                                    $rand = rand(000000,999999);
                                    $new = $this->permalink($this->kirlet(Request::POST('adi_soyadi')))."-".$date."-".$rand.".".$uzanti;
                                    $yukle = move_uploaded_file($tmp_name, "$uploads_dir$new");
                                    if (!in_array($uzanti, $files_ext)){
                                        $this->kucult($uploads_dir,$new,500,0);
                                    }
                                    if ($yukle){
                                        $cv = $this->baseURL($uploads_dir.$new);
                                    }
                                }
                                else {
                                    $mesaj.= "44";
                                }
                            }
                            else {
                                $mesaj.= "55";
                            }
                        }
                    }else {
                        $cv = null;
                    }




                    $ik_il = $this->kirlet(Request::POST('ik_il'));
                    $ik_ilce = $this->kirlet(Request::POST('ik_ilce'));
                    $il = $this->tekSorgu("SELECT * FROM city WHERE CityID = ".$ik_il)["CityName"];
                    $ilce = $this->tekSorgu("SELECT * FROM town WHERE TownID = ".$ik_ilce)["TownName"];
                    $calismak_istenen_yer = $this->kirlet(Request::POST('calismak_istenen_yer'));


                    $post = array(
                        'tc_kimlik'=>$this->kirlet(Request::POST('tc_kimlik')),
                        'adi_soyadi'=>$this->kirlet(Request::POST('adi_soyadi')),
                        'cinsiyet'=>$this->kirlet(Request::POST('cinsiyet')),
                        'dogum_yeri_ve_tarihi'=>$this->kirlet(Request::POST('dogum_yeri_ve_tarihi')),
                        'ik_il'=>$il,
                        'ik_ilce'=>$ilce,
                        'adresi'=>$this->kirlet(Request::POST('adresi')),
                        'aile_calisan'=>$this->kirlet(Request::POST('aile_calisan')),
                        'cep_telefonu'=>$this->kirlet(Request::POST('cep_telefonu')),
                        'meslek'=>$this->kirlet(Request::POST('meslek')),
                        'ehliyet'=>$this->kirlet(Request::POST('ehliyet')),
                        'askerlik'=>$this->kirlet(Request::POST('askerlik')),
                        'tecil_tarih'=>$this->kirlet(Request::POST('tecil_tarih')),
                        'rahatsizlik'=>$this->kirlet(Request::POST('rahatsizlik')),
                        'medeni_hal'=>$this->kirlet(Request::POST('medeni_hal')),
                        'cocuk_sayisi'=>$this->kirlet(Request::POST('cocuk_sayisi')),
                        'sabika'=>$this->kirlet(Request::POST('sabika')),
                        'icra_takibi'=>$this->kirlet(Request::POST('icra_takibi')),
                        'istenen_bolum'=>$istenen_bolumler,
                        'tahsil'=>$this->kirlet(Request::POST('tahsil')),
                        'calismak_istenen_yer'=>$calismak_istenen_yer,
                        'kurslar'=>$this->kirlet(Request::POST('kurslar')),
                        'referans'=>$this->kirlet(Request::POST('referans')),
                        'firma_adi_1'=>$this->kirlet(Request::POST('firma_adi_1')),
                        'firma_telefon_1'=>$this->kirlet(Request::POST('firma_telefon_1')),
                        'firma_gorev_1'=>$this->kirlet(Request::POST('firma_gorev_1')),
                        'calisma_suresi_1'=>$this->kirlet(Request::POST('calisma_suresi_1')),
                        'ayrilik_nedeni_1'=>$this->kirlet(Request::POST('ayrilik_nedeni_1')),
                        'firma_adi_2'=>$this->kirlet(Request::POST('firma_adi_2')),
                        'firma_telefon_2'=>$this->kirlet(Request::POST('firma_telefon_2')),
                        'firma_gorev_2'=>$this->kirlet(Request::POST('firma_gorev_2')),
                        'calisma_suresi_2'=>$this->kirlet(Request::POST('calisma_suresi_2')),
                        'ayrilik_nedeni_2'=>$this->kirlet(Request::POST('ayrilik_nedeni_2')),
                        'firma_adi_3'=>$this->kirlet(Request::POST('firma_adi_3')),
                        'firma_telefon_3'=>$this->kirlet(Request::POST('firma_telefon_3')),
                        'firma_gorev_3'=>$this->kirlet(Request::POST('firma_gorev_3')),
                        'calisma_suresi_3'=>$this->kirlet(Request::POST('calisma_suresi_3')),
                        'ayrilik_nedeni_3'=>$this->kirlet(Request::POST('ayrilik_nedeni_3')),
                        'boy'=>$this->kirlet(Request::POST('boy')),
                        'kilo'=>$this->kirlet(Request::POST('kilo')),
                        'engellilik'=>$this->kirlet(Request::POST('engellilik')),
                        'basvuru_tarihi'=>date("d-m-Y H:i"),
                        'resim'=>$dosya,
                        "cv"=>$cv,
                    );




                    $captcha = new \Captcha();
                    if($captcha->validateCaptcha(Request::POST("captcha_value"))){

                       $ekle = $this->insert("kariyer", $post);
                       $govde1 = $this->_include('ajax/isBasvuruForm',$post);

                        if ($mesaj == ""){
                            echo $this->_SEND($this->ayarlar('kariyer_form'),$this->ayarlar('kariyer_form'),'İş Başvuru Formu',$govde1);
                        }
                        else {
                            echo $mesaj;
                        }
                    }

                    else {
                        echo 3;
                    }



                break;




            case 'form':
                echo   $this->_include('ajax/form');
            break;

            case 'newsletterForm':
                $lang = $this->pageLang;
                if(Request::POST('email')):
                    $email = Request::POST('email');
                    $mail = $this->sorgu("select email from emaillist where email='$email' and sil <> 1 and dil = '".$lang."'");
                    if(is_array($mail)>0): echo 2;
                    else:
                        $this->insert('emaillist',array(
                            'email' => $email,
                            'tarih' =>date('d/m/Y H:i'),
                            'ip'=>$_SERVER['SERVER_ADDR'],
                            'dil'=>$lang,
                        ));
                        echo 1;
                    endif;
                else:
                    echo 3;
                endif;
            break;




            case 'kursKayit':

                $post  = [];
                $error = [];
                $required = array("select-1635494118541-0", "text-1635494154468-0", "text-1635494178596", "text-1635494207868");
                $disablePostNames = array('kursKayit_token', 'captcha_value');

                $forms = ["select-1635494118541-0"=>"HANGİ EĞİTİM PROGRAMI İÇİN BAŞVURU YAPIYORSUNUZ?*","text-1635494154468-0"=>"ADI SOYADI*","text-1635494178596"=>"T.C.GKKN KİMLİK NO*","text-1635494193756"=>"DOĞUM TARİHİ*","text-1635494207868"=>"TELEFON NO*","text-1635494219084"=>"ACİL DURUMLAR İÇİN İKİNCİ BİR TELEFON NO*","radio-group-1635494232516-0"=>"CİNSİYET*","radio-group-1635494278636"=>"MEDENİ DURUM*","text-1635494301723-0"=>"EVLİ İSENİZ EŞİNİZİN ADI SOYADI*","number-1635494319411-0"=>"HANEDE BULUNAN KİŞİ SAYISI*","number-1635494363339"=>"HANEDE BULUNAN 18 YAŞ ALTI KİŞİ SAYISI","number-1635494381099"=>"HANEDE ÇALIŞAN KİŞİ SAYISI","radio-group-1635494397947-0"=>"EVİNİZİN AYLIK GELİRİ NE KADAR BELİRTİNİZ*","number-1635494456843-0"=>"HANEDE VARSA ENGELLİ SAYISI","radio-group-1635494472211-0"=>"UYRUK*","textarea-1635494516235-0"=>"ADRES*","textarea-1635494539011"=>"ŞU AN ÇALIŞTIĞINIZ BİR İŞİNİZ VAR MI VARSA BELİRTİNİZ*","radio-group-1635494600939-0"=>"HERHANGİ BİR YERDEN SOSYAL YARDIM ALIYOR MUSUNUZ?","radio-group-1635494953787-0"=>"YARDIM ALIYORSANIZ HANGİ KURUMDAN ALIYORSUNUZ","radio-group-1635495058290-0"=>"TÜRKÇE DİL SEVİYENİZ NEDİR?*","radio-group-1635495133186-0"=>"ARAPÇA DİL SEVİYENİZ NEDİR?*","radio-group-1635495543930-0"=>"İNGİLİZCE DİL SEVİYENİZ NEDİR?*","text-1635495618538-0"=>"MESLEK*","radio-group-1635495628042-0"=>"EĞİTİM DURUMU*","textarea-1635495676921-0"=>"MEZUN OLDUĞUNUZ OKUL VE BÖLÜM","textarea-1635495690625-0"=>"DAHA ÖNCE HERHANGİ BİR KURSTA MESLEK EĞİTİMİ ALDINIZ MI ALDINIZ İSE BELİRTİNİZ","textarea-1635495713690-0"=>"DAHA ÖNCE GESOB-MEKSA DAN EĞİTİM ALDINIZ MI","textarea-1635495724666-0"=>"ALACAĞINIZ EĞİTİMLE YAPMAK İSTEDİĞİNİZ NEDİR","textarea-1635495734890"=>"KURSTAN SONRA ÇALIŞMANIZA HERHANGİ BİR ENGEL VAR MI,VARSA BELİRTİNİZ","radio-group-1635495742682-0"=>"KURSTAN SONRA ÇALIŞMAK İSTERMİSİNİZ?*","radio-group-1635495791130-0"=>"RESMİ İKAMETGAH İLİNİZ NERESİDİR?*","text-1635495824834-0"=>"DAHA ÖNCE ÇALIŞMA İZİN BELGESİ ALDINIZ MI?","radio-group-1635495879450-0"=>"ÇALIŞMA İZNİNİZ VARMI? (SADECE YABANCI UYRUKLULAR İÇİN)","radio-group-1635495908537-0"=>"EHLİYETİNİZ VAR MI?*"];

                if(count(Request::postAll()) > 0){
                    foreach (Request::postAll() as $key=>$value){
                        if (in_array($key, $required)){
                            if ($value == ""){
                                $error[$key] = "Boş Bırakılamaz";
                            }
                        }
                        if(!in_array($key, $disablePostNames)){
                            $post[$key] = $this->kirlet(htmlentities(addslashes($value)));
                        }
                    }
                }
                else {
                    $error["all"] = "Boş alanları doldurunuz";
                }


                $tarih = date('d.m.Y H:i');




                $govde = $this->_include('ajax/kursKayit', ['post'=>$post, 'forms'=>$forms]);

                if (count($error) < 1){
                    $captcha = new \Captcha();
                    if($captcha->validateCaptcha(Request::POST("captcha_value"))) {
                        echo $this->_SEND($this->ayarlar('kariyer_form'), $this->ayarlar('kariyer_form'), "Kurs Kayıt Formu", $govde, $this->ayarlar("firma_tr"));
                        $this->insert('kurskayit', array(
                            'dil' => $this->pageLang,
                            'tarih' => $tarih,
                            'aktif' => 1,
                            'goruldu' => 0,
                            'kurs' => $post["select-1635494118541-0"],
                            'baslik' => $post['text-1635494154468-0'],
                            'detay' => $this->kirlet($govde)
                        ));
                    }else {
                        echo 3;
                    }

                }else {
                    echo 4;
                }


            break;



            case 'uzmanKayit':

                $post  = [];
                $error = [];
                $required = array("tc_kimlik", "adi_soyadi", "cinsiyet", "medeni_hali", "eposta", "sabit_telefon", "gsm", "sehir", "adres",
                    "meslek", "mezuniyet_durumu", "yabanci_dil", "derecesi"
                );
                $disablePostNames = array('uzmanKayit_token', 'captcha_value');

                if(count(Request::postAll()) > 0){
                    foreach (Request::postAll() as $key=>$value){
                        if (in_array($key, $required)){
                            if ($value == ""){
                                $error[$key] = "Boş Bırakılamaz";
                            }
                        }

                        if(!in_array($key, $disablePostNames)){
                            $post[$key] = $this->kirlet(htmlentities(addslashes($value)));
                        }
                    }
                }
                else {
                    $error["all"] = "Boş alanları doldurunuz";
                }


                $post['tarih'] = date('d.m.Y H:i');

                $govde = $this->_include('ajax/uzmanKayit', ['post'=>$post]);

                if (count($error) < 1){
                    $captcha = new \Captcha();
                    if($captcha->validateCaptcha(Request::POST("captcha_value"))) {
                        echo $this->_SEND($this->ayarlar('kariyer_form'),$this->ayarlar('kariyer_form'),"İş Başvuru Formu",$govde, $this->ayarlar("firma_tr"));
                        $this->insert('uzmankayit',array(
                            'dil' => $this->pageLang,
                            'tarih' =>$post['tarih'],
                            'aktif'=>1,
                            'goruldu'=>0,
                            'baslik'=>$post['adi_soyadi'],
                            'detay'=>$this->kirlet($govde)
                        ));
                    }else {
                        echo 3;
                    }
                }else {
                    echo 4;
                }


                break;



            case 'bilgiEdinme':

                $post  = [];
                $error = [];
                $required = array("tc_kimlik", "adi_soyadi", "telefon", "adres", "dogum_tarihi",
                    'talepler'
                );
                $disablePostNames = array('bilgiEdinme_token', 'captcha_value');

                if(count(Request::postAll()) > 0){
                    foreach (Request::postAll() as $key=>$value){
                        if (in_array($key, $required)){
                            if ($value == ""){
                                $error[$key] = "Boş Bırakılamaz";
                            }
                        }

                        if(!in_array($key, $disablePostNames)){
                            $post[$key] = $this->kirlet(htmlentities(addslashes($value)));
                        }
                    }
                }
                else {
                    $error["all"] = "Boş alanları doldurunuz";
                }


                $post['tarih'] = date('d.m.Y H:i');

                $govde = $this->_include('ajax/bilgiEdinme', ['post'=>$post]);

                if (count($error) < 1){
                    $captcha = new \Captcha();
                    if($captcha->validateCaptcha(Request::POST("captcha_value"))) {
                        echo $this->_SEND($this->ayarlar('email'),$this->ayarlar('email'),"Bilgi Edinme Formu",$govde, $this->ayarlar("firma_tr"));
                        $this->insert('bilgiedinme',array(
                            'dil' => $this->pageLang,
                            'tarih' =>$post['tarih'],
                            'aktif'=>1,
                            'goruldu'=>0,
                            'baslik'=>$post['adi_soyadi'],
                            'detay'=>$this->kirlet($govde)
                        ));
                    }else {
                        echo 3;
                    }
                }else {
                    echo 4;
                }


                break;


            case 'dilekSikayet':

                $post  = [];
                $error = [];
                $required = array("konu", "adi_soyadi", "telefon", "eposta", "mesaj");
                $disablePostNames = array('captcha_value');

                if(count(Request::postAll()) > 0){
                    foreach (Request::postAll() as $key=>$value){
                        if (in_array($key, $required)){
                            if ($value == ""){
                                $error[$key] = "Boş Bırakılamaz";
                            }
                        }

                        if(!in_array($key, $disablePostNames)){
                            $post[$key] = $this->kirlet(htmlentities(addslashes($value)));
                        }
                    }
                }
                else {
                    $error["all"] = "Boş alanları doldurunuz";
                }


                $post['tarih'] = date('d.m.Y H:i');

                $govde = $this->_include('ajax/dilekSikayet', ['post'=>$post]);

                if (count($error) < 1){
                    $captcha = new \Captcha();
                    if($captcha->validateCaptcha(Request::POST("captcha_value"))) {
                        echo $this->_SEND($this->ayarlar('email'),$this->ayarlar('email'),"Dilek & Şikayet Formu",$govde, $this->ayarlar("firma_tr"));
                    }else {
                        echo 3;
                    }
                }else {
                    echo 4;
                }


            break;



            case 'kayitDetay':
                $type = htmlentities($this->kirlet(Request::GETURL('type', null)));
                $id = (int)htmlentities($this->kirlet(Request::GETURL('id', null)));
                echo $this->_include('ajax/kayitDetay', ['type'=>$type, 'id'=>$id]);

            break;



        endswitch;



    }


}