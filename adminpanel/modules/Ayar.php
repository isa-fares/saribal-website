<?php
/**
 * Created by PhpStorm.
 * User: VEMEDYA
 * Date: 03.03.2016
 * Time: 13:18
 */

namespace AdminPanel;


class Ayar extends Settings {

    public $SayfaBaslik = 'Ayarlar';
    public $settings ;
    private $modulName = 'Ayar';
    private $function;
    private $id;
    private $loadedFunction;


    public function __construct($settings)
    {
        parent::__construct($settings);
        $this->settings = $settings;
        $this->AuthCheck();


        $get = $_GET["cmd"];
        $ex = explode('/',$get);

        if(isset($ex[1])) $this->function = $ex[1];
        if(isset($ex[2])) $this->id = $ex[2];

    }



    public function index($id=null)
    {
        return $this->ayarlar($id);
    }

    public function harita($id=nul)
    {
        $control = array('control'=>$this,
            'settings' => $this->settings);
        $this->load('helper/harita/index',$control);

        exit;

    }



    public function ayarlar($id=null)
    {

        $text  = '';
        $form = new Form($this->settings);
        // $form = new Form($this->set);
        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')."&tur=".$this->function),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text.= $this->ayarlarSidebar($this->function);
        $text .= $form->openColumn(9);

        $tabForm = array();
        $tabs = new Tabs($this->settings);
        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text'] = $form->input(array('value' => $this->get_element('title_'.$dil),'title'=>'Site Başlığı','name'=>'title','id'=>'title','lang'=>$dil));
            $tabForm[$dil]['text'].= $form->textarea(array('value'=>$this->get_element('description_'.$dil),'title'=>'Site Açıklama','name'=>'description','id'=>'description','lang'=>$dil,'height'=>'80'));
            $tabForm[$dil]['text'] .= $form->textarea(array('help'=>'google aramalarında çıkması için gereklidir.','value'=>$this->get_element('keywords_'.$dil),'title'=>'Anahtar kelimeler','name'=>'keywords','id'=>'keywords','lang'=>$dil,'height'=>'80',));
            $tabForm[$dil]['text'] .= $form->input(array('value' => $this->get_element('firma_'.$dil),'title'=>'Firma Adı','name'=>'firma','lang'=>$dil));
            //$tabForm[$dil]['text'] .= $form->input(array('value' => $this->get_element('unvan_'.$dil),'title'=>'Firma Ünvanı','name'=>'unvan','id'=>'unvan','lang'=>$dil));
            $tabForm[$dil]['text'] .= $form->textEditor(array('value'=>$this->get_element('kisaca_'.$dil),'title'=>'Anasayfa Hakkımızda Alanı',"id"=>"kisaca", 'name'=>'kisaca','lang'=>$dil,'height' => '183'));
        endforeach;
        $text .= $tabs->tabContent($tabForm);


        $text.= $form->openBox().$form->openBoxBody();
        $text .= $form->input(array('value'=>$this->get_element('sayac'),'title'=>'Google Analytics Kodu','name'=>'sayac','id'=>'sayac','height'=>'80','help'=>'Google Analytics kodunuzu buraya girebilirsiniz. ÖRN:UA-87157922-1'));
        //$text .= $form->input(array('value'=>$this->get_element('map_api'),'title'=>'Google Maps Api','name'=>'map_api','id'=>'map_api','height'=>'80','help'=>'Google Harita Api kodunuzu buraya girebilirsiniz. ÖRN:AIzaSyBgq-Hq93LIjnCS1wJBOTh3SnMd0J0Pr9E'));
        $text .= $form->submitButton(array("color" => "btn-success btn-lg", "icon" => "fa fa-check", 'submit' => ($id) ? 'Güncelle' : 'Kaydet'));
        $text.="</div></div></div>";

        $text .= $form->formClose();
        return $text;
    }


    public function kvkk($id=null)
    {

        $text  = '';
        $form = new Form($this->settings);
        // $form = new Form($this->set);
        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')."&tur=".$this->function),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text.= $this->ayarlarSidebar($this->function);
        $text .= $form->openColumn(9);

        $tabForm = array();
        $tabs = new Tabs($this->settings);
        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text'] = $form->textEditor(array('value'=>$this->get_element('kvkk_'.$dil),'title'=>'K.V.K.K','name'=>'kvkk','lang'=>$dil,'height' => '183'));
            $tabForm[$dil]['text'] .= $form->textEditor(array('value'=>$this->get_element('uyelik_kosullari_'.$dil),'title'=>'Üyelik Koşulları','name'=>'uyelik_kosullari','lang'=>$dil,'height' => '183'));
            $tabForm[$dil]['text'] .= $form->textEditor(array('value'=>$this->get_element('satis_sozlesmesi_'.$dil),'title'=>'Satış Sözleşmesi','name'=>'satis_sozlesmesi','lang'=>$dil,'height' => '183'));
            $tabForm[$dil]['text'] .= $form->textEditor(array('value'=>$this->get_element('gizlilik_ve_guvenlik_'.$dil),'title'=>'Gizlilik ve Güvenlik','name'=>'gizlilik_ve_guvenlik','lang'=>$dil,'height' => '183'));
            $tabForm[$dil]['text'] .= $form->textEditor(array('value'=>$this->get_element('iade_'.$dil),'title'=>'İade ve İptal Şartları','name'=>'iade','lang'=>$dil,'height' => '183'));
        endforeach;
        $text .= $tabs->tabContent($tabForm);


        $text.= $form->openBox().$form->openBoxBody();
        $text .= $form->submitButton(array("color" => "btn-success btn-lg", "icon" => "fa fa-check", 'submit' => ($id) ? 'Güncelle' : 'Kaydet'));
        $text.="</div></div></div>";

        $text .= $form->formClose();
        return $text;
    }

    public function iletisim($id=null)
    {
        $text  = '';

        $form = new Form($this->settings);
        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')."&tur=".$this->function),'id'=>'form_sample_3','class'=>''));
        $text.= $this->ayarlarSidebar($this->function);
        $text.=$form->openColumn(9);
        $text.= $form->openBox()."<div class='box-header with-border'><h3 class='box-title'>İletişim</h3></div>".$form->openBoxBody();
        $tabsList =  $this->settings->sube('subeler');
        $tabks =  $this->settings->sube('kisaltma');
        $tabsForm = array();
        $tabs = new Tabs($this->settings,$tabsList);
        $x=0;
        if(is_array($tabsList))
            foreach ($tabsList as $name=>$value):

                $tabsForm[$name]['text'] = $form->input(array("mask"=>"+99 (999) 999 99 99", "icon"=>"mdi mdi-phone-in-talk",'value'=>$this->get_element('telefon_'.$name),'title'=>'Telefon','type'=>'text', 'name'=>'telefon_'.$name,'id'=>'telefon_'.$name));
                $tabsForm[$name]['text'].= $form->input(array("mask"=>"+99 (999) 999 99 99", "icon"=>"mdi mdi-cellphone-android",'value'=>$this->get_element('telefon_2'.$name),'title'=>'Telefon 2','type'=>'text', 'name'=>'telefon_2'.$name,'help'=>''));
//                $tabsForm[$name]['text'].= $form->input(array("mask"=>"+99 (999) 999 99 99", "icon"=>"mdi mdi-phone-in-talk",'value'=>$this->get_element('bilmer_'.$name),'title'=>'Bilgi Merkezi','type'=>'text', 'name'=>'bilmer_'.$name,'help'=>''));

                //$tabsForm[$name]['text'].= $form->input(array("mask"=>"+99 (999) 999 99 99", "icon"=>"mdi mdi-cellphone-android",'value'=>$this->get_element('telefon_3'.$name),'title'=>'Telefon 3','type'=>'text', 'name'=>'telefon_3'.$name,'help'=>''));

                $tabsForm[$name]['text'].= $form->input(array("mask"=>"+99 (999) 999 99 99", "icon"=>"mdi mdi-fax",'value'=>$this->get_element('faks_'.$name),'title'=>'Faks ','type'=>'text', 'name'=>'faks_'.$name,'id'=>'faks_'.$name,'help'=>''));
                //$tabsForm[$name]['text'].= $form->input(array("mask"=>"+99 (999) 999 99 99", "icon"=>"mdi mdi-cellphone-android",'value'=>$this->get_element('gsm_'.$name),'title'=>'Gsm','type'=>'text', 'name'=>'gsm_'.$name,'id'=>'gsm_'.$name,'help'=>''));

                $tabsForm[$name]['text'].= $form->textarea(array("icon"=>"mdi mdi-home-variant",'value'=>$this->get_element('adres_'.$name),'title'=>'Adres ','type'=>'text', 'name'=>'adres_'.$name,'id'=>'adres_'.$name));
                $tabsForm[$name]['text'].= $form->input(array("icon"=>"mdi mdi-email-variant", 'value'=>$this->get_element('email_'.$name),'title'=>'E-posta ','type'=>'text', 'name'=>'email_'.$name,'id'=>'email_'.$name));
                //$tabsForm[$name]['text'].= $form->input(array("icon"=>"mdi mdi-email-variant", 'value'=>$this->get_element('musteri_email_'.$name),'title'=>'Müşteri Hizmetleri E-Posta ','type'=>'text', 'name'=>'musteri_email_'.$name,'id'=>'musteri_email_'.$name));
                //$tabsForm[$name]['text'].= $form->input(array("icon"=>"mdi mdi-email-variant", 'value'=>$this->get_element('email_2_'.$name),'title'=>'E-posta 2','type'=>'text', 'name'=>'email_2_'.$name,'id'=>'email_2_'.$name));
                /*$tabsForm[$name]['text'].= $form->harita(array(
                    "value"=>explode(",", $this->get_element("koordinat_".$name)),
                    "name"=>"koordinat_".$name,
                    "title"=>"Koordinat"
                ));*/
                $x++;
            endforeach;

        $text .= $tabs->tabContentArray($tabsForm, "flat-tab");

        $text.="</div>";
        $text .= $form->submitButton(array("color" => "btn-success btn-lg", "icon" => "fa fa-check", 'submit' => ($id) ? 'Güncelle' : 'Kaydet'));
        $text.="</div></div>";


        $text .= $form->formClose();
        return $text;
    }



    public function eposta($id=null)
    {
        $text  = '';
        $form = new Form($this->settings);
        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')."&tur=".$this->function),'id'=>'form_sample_3','class'=>''));
        $text.= $this->ayarlarSidebar($this->function);
        $text.=$form->openColumn(9);
        $text.= $form->openBox()."<div class='box-header with-border'><h3 class='box-title'>E-Posta</h3></div>".$form->openBoxBody();
        $text.="<div class='nav-tabs-custom flat-tab'><ul class='nav nav-tabs'>";
        $text.="<li><a class='active' data-toggle=\"tab\" aria-expanded=\"true\" href='#ayarlar_smtp'>Smtp Ayarları</a></li>";
        $text.="<li><a data-toggle=\"tab\" aria-expanded=\"true\" href='#ayarlar_eposta'>Email Gönderim Ayarları</a></li></ul></div>";
        $text.="<div class=\"tab-content\"><div class=\"tab-pane active\" id=\"ayarlar_smtp\">";
        $text .= $form->select(array('title'=>'Posta Doğrulama Tipi','name'=>'mailType','data'=> $form->parent(array('array'=>array(array('id'=>'phpmail','text'=> 'Php Mail'),array('id'=>'smtp','text'=>'Smtp Mail')),'option'=>array('value'=>'id','title'=>'text'),'selected'=>$this->get_element('mailType')),0,0)));
        $text .= $form->input(array('value' => $this->get_element('SmtpHost'),'title'=>'Sunucu','name'=>'SmtpHost','id'=>'SmtpHost','help'=>''));
        $text .= $form->input(array('value' => $this->get_element('SmtpMail'),'title'=>'Email Adresi','name'=>'SmtpMail','id'=>'SmtpMail','help'=>''));
        $text .= $form->input(array('value' => $this->get_element('SmtpPass'),'title'=>'Şifre','name'=>'SmtpPass','id'=>'SmtpPass','help'=>''));
        $text .= $form->input(array('value' => ($this->get_element('SmtpPort')) ? $this->get_element('SmtpPort'):587,'title'=>'Smtp Port','name'=>'SmtpPort','id'=>'SmtpPort','help'=>''));
        $text .= $form->select(array('title'=>'Smtp Şifreleme','name'=>'SmtpSecret','data'=> $form->parent(array('array'=>array(array('id'=>'tls','text'=> 'TLS'),array('id'=>'ssl','text'=>'SSL')),'option'=>array('value'=>'id','title'=>'text'),'selected'=>$this->get_element('SmtpSecret')),0,0)));
        $text.="</div>";
        $text.="<div class=\"tab-pane\" id=\"ayarlar_eposta\">";
        $text .= $form->input(array('value'=>$this->get_element('email'),'title'=>'İletişim Formu','type'=>'email', 'name'=>'email','help'=>'İletişim Formunun gönderileceği mail adresi.'));

        //$text .= $form->input(array('value'=>$this->get_element('kariyer_form'),'title'=>'İş Başvuru Formu','type'=>'email', 'name'=>'kariyer_form','help'=>'İş Başvuru formunun gönderileceği mail adresi.'));
        //$text .= $form->input(array('value'=>$this->get_element('basvuru_form'),'title'=>'Üyelik Ön Başvuru Formu','type'=>'email', 'name'=>'basvuru_form','help'=>'Üyelik ön başvurularının gönderileceği mail adresi.'));

        $text.="</div>";
        $text.="</div>";
        $text.="</div>";
        $text .= $form->submitButton(array("color" => "btn-success btn-lg", "icon" => "fa fa-check", 'submit' => ($id) ? 'Güncelle' : 'Kaydet'));
        $text.="</div></div>";

        $text .= $form->formClose();
        return $text;

    }


    public function sosyal($id=null)
    {

        $text  = '';
        $form = new Form($this->settings);
        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')."&tur=".$this->function),'id'=>'form_sample_3','class'=>''));
        $text.= $this->ayarlarSidebar($this->function);
        $text.=$form->openColumn(9);
        $text.= $form->openBox()."<div class='box-header with-border'><h3 class='box-title'>Sosyal Medya</h3></div>".$form->openBoxBody();

        $list = $this->settings->sosyal()["list"];
        foreach ($list as $key=>$item){
            $icon = $this->settings->sosyal("adminIcons")[$key];
            $text .= $form->input(array("icon"=>$icon, 'value'=>$this->get_element($key),'title'=>$item.' Url','name'=>$key));
        }
        $text.="</div>";
        $text .= $form->submitButton(array("color" => "btn-success btn-lg", "icon" => "fa fa-check", 'submit' => ($id) ? 'Güncelle' : 'Kaydet'));
        $text.="</div></div>";

        $text .= $form->formClose();
        return $text;

    }


    public function fiyat($id=null)
    {

        $text  = '';
        $form = new Form($this->settings);
        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')."&tur=".$this->function),'id'=>'form_sample_3','class'=>''));
        $text.= $this->ayarlarSidebar($this->function);
        $text.=$form->openColumn(9);
        $text.= $form->openBox()."<div class='box-header with-border'><h3 class='box-title'>Fiyat Ayarları</h3></div>".$form->openBoxBody();


        $text .= $form->input(array("icon"=>"mdi mdi-currency-try", 'value'=>$this->get_element("standart_fiyat"),'title'=>"Kurumsal Standart Paket Fiyatı",'name'=>"standart_fiyat"));
        $text .= $form->input(array("icon"=>"mdi mdi-currency-try", 'value'=>$this->get_element("etkinlik_standart_fiyat"),'title'=>"Proje/Etkinlik Standart Paket Fiyatı",'name'=>"etkinlik_standart_fiyat"));
        $text .= $form->input(array("icon"=>"mdi mdi-currency-try", 'value'=>$this->get_element("blog_standart_fiyat"),'title'=>"Blog Standart Paket Fiyatı",'name'=>"blog_standart_fiyat"));

        $text .= $form->input(array("icon"=>"mdi mdi-currency-try", 'value'=>$this->get_element("hosting_fiyat"),'title'=>"İlk Yıl Sonrası Hosting Fiyatı",'name'=>"hosting_fiyat"));
        $text.="</div>";
        $text .= $form->submitButton(array("color" => "btn-success btn-lg", "icon" => "fa fa-check", 'submit' => ($id) ? 'Güncelle' : 'Kaydet'));
        $text.="</div></div>";

        $text .= $form->formClose();
        return $text;

    }

    public function asset()
    {




        if ($this->user_type == 1) {

            $text = '';
            $form = new Form($this->settings);
            $text .= $form->formOpen(array('method' => 'POST', 'action' => $this->BaseAdminURL($this->modulName . '/kaydet' . ((isset($id)) ? '/' . $id : '') . "&tur=" . $this->function), 'id' => 'form_sample_3', 'class' => ''));
            $text .= $this->ayarlarSidebar($this->function);
            $text .= $form->openColumn(9);
            $text .= $form->openBox() . "<div class='box-header with-border'><h3 class='box-title'>Css & Javascript Asset Versiyon</h3></div>" . $form->openBoxBody();

            $text .= $form->input(array('value' => $this->get_element("cssVersion"), 'title' => "Css Versiyon", 'name' => "cssVersion"));
            $text .= $form->input(array('value' => $this->get_element("jsVersion"), 'title' => "Javascript Versiyon", 'name' => "jsVersion"));
            $text .= "</div>";
            $text .= $form->submitButton(array("color" => "btn-success btn-lg", "icon" => "fa fa-check", 'submit' => ($id) ? 'Güncelle' : 'Kaydet'));
            $text .= "</div></div>";

            $text .= $form->formClose();
            return $text;
        }else {
            $text = "<div class='alert alert-danger'><b>Bu alan için yetkiniz bulunmamaktadır.</b></div>";
            return $text;
        }



    }


    public function kullanici($id=null)
    {
        $text  = '';
        $form = new Form($this->settings);
        $text .= $form->formOpen(array("autocomplete"=>"off", 'method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kullaniciKaydet'),'id'=>'form_sample_3'));
        $user_id = $this->user_id;
        $data = $this->dbConn->tekSorgu("SELECT * FROM kullanici WHERE id = $user_id");
        $text.= $this->ayarlarSidebar($this->function);
        $text.=$form->openColumn(9);
        $text.= $form->openBox()."<div class='box-header with-border'><h3 class='box-title'>Kullanıcı Ayarları</h3></div>".$form->openBoxBody();
        $text.="<div class='row'><div class='col-md-7'>";
        $text .= $form->input(array("icon"=>"mdi mdi-account", 'value'=>$data["adi"],'title'=>'Adınız Soyadınız','name'=>'adi'));
        $text .= $form->input(array("autocomplete"=>"new-username", "icon"=>"mdi mdi-account-star", 'value'=>$data["kullanici"],'title'=>'Kullanıcı Adı','name'=>'kullanici'));
        $text .= $form->input(array("autocomplete"=>"new-password","type"=>"password","icon"=>"mdi mdi-key", 'title'=>'Şifre','name'=>'sifre'));
        $text.="</div>";
        $text.="<div class='col-md-5'>";
        $text.= $form->file(array('url'=>$this->BaseURL('upload')."/users",'folder'=>"users",'title'=>'Profil Resmi','name'=>'profil_resim','resimBoyut'=>$this->settings->boyut("users"),'src'=>((isset($data['resim'])) ? $data['resim'] :'')));
        $text.="</div></div>";
        $text .= $form->submitButton(array("color" => "btn-success btn-lg", "icon" => "fa fa-check", 'submit' => ($id) ? 'Güncelle' : 'Kaydet'));
        $text.="</div></div>";


        $text .= $form->formClose();
        return $text;
    }





    public function kaydet($id=nul)
    {
        $tur = (isset($_GET["tur"])) ? $_GET["tur"] : "ayarlar";
        foreach($_POST as $name => $value)
        {
            $v = (($name == "adres_merkez") ? $value : $this->kirlet($value));
            $this->dbConn->update('ayarlar',array('value' => $v),array('name'=>$name));
        }
        $this->setPanelMessage("success","Ayarlar Başarıyla Güncellendi");
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/'.$tur));
    }


    public function kullaniciKaydet(){
        $user_id = $this->user_id;
        $eski = $this->dbConn->tekSorgu("SELECT * FROM kullanici WHERE id = $user_id");
        $user_eski = $eski["kullanici"];
        $post = array(
            "kullanici"=>$this->_POST("kullanici"),
            "adi"=>$this->_POST("adi"),
            "resim"=>$this->_RESIM_BASE64('profil_resim', "users")
        );


        if ($this->_POST("sifre") != null ){
            $post["sifre"] = sha1(md5($this->koru($this->_POST("sifre"))));
        }

        $this->dbConn->update("kullanici", $post, $user_id);

        $this->setPanelMessage("success","Kullanıcı Başarıyla Güncellendi");

        if ($this->_POST("kullanici") != $user_eski){
            $this->RedirectURL($this->BaseAdminURL("Login/cikis.html"));
        }

        elseif ($this->_POST("sifre") != null ){
            $this->RedirectURL($this->BaseAdminURL("Login/cikis.html"));
        }

        else {
            $this->RedirectURL($this->BaseAdminURL("Ayar/kullanici"));
        }

    }






}