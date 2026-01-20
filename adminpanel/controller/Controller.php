<?php
/**
 * Created by PhpStorm.
 * User: VEMEDYA
 * Date: 02.03.2016
 * Time: 15:28
 */

namespace AdminPanel;


class Controller  extends Settings{

    public  $class;
    public  $function;
    public  $id;
    public  $settings;
    private $classlist;
    private $err;
    private $content;
    public $allow_module;




    public function __construct($get=null,$settings)
    {


       parent::__construct($settings);
        $this->allow_module = array("login", "yukle", "sirala", "ajax", "dosya", "dosyalar", "files", "resim", "icons", "index", "ajaxpage");
        $this->settings = $settings;
        $ex = explode('.',$get);
        $ex = explode('/',$ex[0]);
        if(isset($ex[0])) $this->class = $ex[0];
        if(isset($ex[1])) $this->function = $ex[1];
        if(isset($ex[2])) $this->id = $ex[2];

        $class = '\AdminPanel\\'.$this->class;

        $adminKontrol = $this->dbConn->tekSorgu("SELECT * FROM kullanici WHERE tur = 1");
        if (!$adminKontrol){
            $this->AuthCheck();
            $this->err = '<div class="alert alert-danger"><h4><i class="icon fa fa-times-circle"></i>Hata!</h4>Yönetici Hesabı silinmiş ya da veri erişimi yoktur. Lütfen firma ile irtibata geçiniz.</div>';
        }
        else {
            if (class_exists($class)) {


                $user_id = $this->user_id;
                $user_type = $this->user_type;


                $kontrol = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE modul = '".strtolower($this->class)."' and aktif = 1");
                $modul_id = $kontrol["id"];


                if (!in_array(strtolower($this->class), $this->allow_module)){

                    if (!empty($user_id)){

                        if ($user_type <> 1){
                            $kullanici = $this->dbConn->tekSorgu("SELECT * FROM kullanici WHERE id = $user_id");
                            $yetkiler = json_decode($kullanici["yetkiler"]);


                            if (!$kontrol){
                                $this->AuthCheck();
                                $this->err = '<div class="alert alert-danger"><h4><i class="icon fa fa-times-circle"></i>Hata !</h4>Bu modül pasif durumdadır.</div>';
                            }


                            if (!in_array($modul_id, $yetkiler) && ($modul_id != 18)){
                                $this->AuthCheck();
                                $this->err = '<div class="alert alert-danger"><h4><i class="icon fa fa-times-circle"></i>Hata!</h4>Bu modülü görüntülemek için yetkiniz bulunmamaktadır.</div>';
                            }



                        }

                    }
                }

                else {
                    if (strtolower($this->class) == "resim"){
                        if ($user_type <> 1) {
                            $type = @$_GET["type"];
                            $getModul = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE modul = '$type'");
                            $mid = $getModul["id"];

                            $kullanici = $this->dbConn->tekSorgu("SELECT * FROM kullanici WHERE id = $user_id");
                            $yetkiler = json_decode($kullanici["yetkiler"]);

                            if (!in_array($mid, $yetkiler)) {
                                if ($this->function != "dosyaDurum"){
                                    $this->AuthCheck();
                                    $this->err = '<div class="alert alert-danger"><h4><i class="icon fa fa-times-circle"></i>Hata!</h4>Bu modülü görüntülemek için yetkiniz bulunmamaktadır.</div>';
                                }
                            }
                        }
                    }

                }



                if (empty($this->err)){

                    $this->classlist = new $class($this->settings);

                    if (method_exists($this->classlist, $this->function)) {
                        if ($this->user_id != ""){
                            $kullanici = $this->dbConn->tekSorgu("SELECT * FROM kullanici WHERE id = $user_id");
                            $yetkiler = json_decode($kullanici["yetkiler"]);

                            if ($kullanici["tur"] > 1) {
                                if (!in_array($modul_id, $yetkiler)) {
                                    if ($this->class == "kullanici") {
                                        if (strtolower($this->function) != "ekle" && strtolower($this->function) != "kaydet") {
                                            $this->RedirectURL($this->BaseAdminURL("kullanici/ekle/" . $this->user_id));
                                        }
                                    }
                                }
                            }


                        }

                        $this->content = $this->classlist->{$this->function}($this->id);
                    }

                    elseif (method_exists($this->classlist, 'index')) {
                        $this->content = $this->classlist->index($this->id);
                    }

                    else {
                        $this->AuthCheck();
                        $this->err = '<div class="alert alert-danger"><h4><i class="icon fa fa-times-circle"></i> Hata!</h4>Sayfa Bulunamadı.</div>';
                    }

                }

            }

            else {
                $this->AuthCheck();
                $this->err = '<div class="alert alert-danger"><h4><i class="icon fa fa-times-circle"></i> Hata!</h4>Modül Bulunamadı.</div>';
            }

        }


    }


    public function getCurrentClass()
    {
        return $this->class;
    }

    public function files()
    {
        return ((method_exists($this->classlist,'crop')) ? true :false);
    }

    public function LoginPage()
    {
        return ((isset($this->classlist->loginPage)) ? $this->classlist->loginPage :false);
    }

    public function sayfaBaslik()
    {
        $_get = strtolower($this->getParameter()["modul"]);
        $al = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE modul = '$_get'");
        $baslik = ($al) ? $this->temizle($al["baslik"]) : $_get;
        return ((isset($this->classlist->SayfaBaslik)) ? $this->classlist->SayfaBaslik : $baslik);
    }

    public function getUser($data){
        $user_id = $this->user_id;
        $al = $this->dbConn->tekSorgu("SELECT $data FROM kullanici WHERE id = $user_id");
        return $al[$data];
    }

    public function getUsericon(){
        $user_id = $this->user_id;
        $al = $this->dbConn->tekSorgu("SELECT resim FROM kullanici WHERE id = $user_id");
        return (!empty($al["resim"])) ? $al["resim"] : "no-user.png";
    }


    public function getUserTheme(){
        $al = $this->dbConn->tekSorgu("SELECT theme FROM kullanici WHERE id = $this->user_id");
        return (!empty($al["theme"])) ? $al["theme"] : "skin-blue";
    }


    public function getMapApi(){

    }


    public function sayfaIcBaslik()
    {
        return ((isset($this->classlist->icbaslik) and $this->classlist->icbaslik) ? $this->classlist->icbaslik :((isset($this->classlist->SayfaBaslik)) ? $this->classlist->SayfaBaslik :''));
    }

    public function CustomPageCss($url)
    {
       if(method_exists($this->classlist,'CustomPageCss')) return $this->classlist->CustomPageCss($url);
    }

    public function CustomPageJs($url)
    {
        if(method_exists($this->classlist,'CustomPageJs')) return $this->classlist->CustomPageJs($url);
    }

    public function Content()
    {

        $class = '\AdminPanel\\'.$this->class;
        if(class_exists($class)):
            if(method_exists($this->classlist,$this->function)):
                return  $this->content;
            elseif(method_exists($this->classlist,'index')):
                return $this->content;
            else:
                return $this->err ;
            endif;
        else: return $this->err; endif;


    }







} 