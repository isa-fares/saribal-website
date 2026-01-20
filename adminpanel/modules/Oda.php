<?php


namespace AdminPanel;


class Oda  extends Settings{


    public  $modulName;
    private $table;
    private $tablelang;
    public  $tablist;
    public  $modul_info;



    public function __construct($settings)
    {
        parent::__construct($settings);

        $this->AuthCheck();

        $cmd = strtolower($this->getParameter()["modul"]);
        $this->modul_info = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE modul = '$cmd'");

        $this->modulName = $cmd;
        $this->table = $this->modulName;
        $this->tablelang = $this->modulName."_lang";


        $this->tablist = array(
            array("title" =>"Odalar", "href" => "liste", "icon" => "mdi mdi-view-sequential"),
            //array("title" => "Satış Ağı", "href" => "kategoriler", "icon" => "mdi mdi-settings")
        );


    }



    public function index($id)
    {
        $function = $this->getParameter()["function"];
        if (empty($function)){
            header("Location:".$this->baseAdminURL($this->modulName."/liste"));
        }
    }



    public function settings($id=null)
    {
        $this->SayfaBaslik = "Modül Ayarları";

        $pagelist = new Pagelist($this->settings);
        $text = $pagelist->Tablist($this->tablist);
        if ($this->exits_module_settings($this->modulName))
            $text .= $this->_inc_module_settings($this->modulName, array("modul"=>$this->modulName));
        else
            $text .= "Ayar Dosyası Bulunamadı.";

        return $text;

    }



    public function help($id=null)
    {
        $this->SayfaBaslik = $this->modul_info["baslik"]." / Yardım";

        $pagelist = new Pagelist($this->settings);
        $text = $pagelist->Tablist($this->tablist);
        if ($this->exits_module_help($this->modulName))
            $text .= $this->_inc_module_help($this->modulName, array("modul"=>$this->modulName));
        else
            $text .= "Yardım Dosyası Bulunamadı.";

        return $text;

    }



    public function liste($id=null)
    {

        $kosul = "";

        if (!empty($id)){
            $kosul.=" sehir = ".$id;
        }

        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->table,
            "kosul"=>$kosul,
            "search"=>array("baslik"),
            "sqlEk"=>"(SELECT baslik FROM sehirler WHERE sehirler.id = ".$this->table.".sehir) as sehir",
        ));

        $this->SayfaBaslik = "Odalar";

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;


        $text = $pagelist->Tablist($this->tablist);

        $text .= $pagelist->PageList(array(
            'id'=>$id,
            'modul_id'=>$this->modul_info["id"],
            'modul_name'=>$this->modulName,
            'page'=>$this->table,
            "place"=>"odalarda ara",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            //'flitpage' => array("url"=>$filterURL,"title"=>"Şehir Seçiniz",'sql'=>"select * from sehirler",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"katFilter", "class"=>"kat_filter"),
            'button' => array(array('title'=>'Oda Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('dataTitle'=>'baslik', 'class'=>'sort'),
                array('dataTitle'=>'telefon', 'class'=>'sort'),
                array('dataTitle'=>'baskan', 'class'=>'sort'),
            ),
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Resim Ekle','class'=>'btn bg-olive','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Resim/fotoekle/'), "data-icon"=>"ti-camera", "modul"=>$this->table),
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'Başlık','width'=>'15%'),
                array('title'=>'Telefon','width'=>'10%'),
                array('title'=>'Başkan','width'=>'10%'),
                //array('title'=>'Resim','width'=>'5%', "align"=>"center"),
                array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )
        ));

        return $text;

    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Oda '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(7);

        if($id) $data = $tabs->tabData($this->table,$id);

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text']  = $form->input(array("required"=>array("tr"),'value'=>((isset($data[$dil]['baslik']) ? $this->temizle($data[$dil]['baslik']) :'')),'title'=>'Başlık','lang'=>$dil,'name'=>'baslik'));

            //$tabForm[$dil]['text'] .= $form->textEditor(array('value'=>((isset($data[$dil]['detay']) ? $this->temizle($data[$dil]['detay']) :'')),'title'=>'Detay','name'=>'detay','lang'=>$dil,'height' => '230'));
        endforeach;

        $text .= $tabs->tabContent($tabForm);

        $text.=$form->openBox().$form->openBoxBody();

        $text  .= $form->input(array("icon"=>"fa fa-user",'value'=>((isset($data["tr"]['baskan']) ? $this->temizle($data["tr"]['baskan']) :'')),'title'=>'Başkan','name'=>'baskan'));
        $text  .= $form->input(array("icon"=>"fa fa-user",'value'=>((isset($data["tr"]['sekreter']) ? $this->temizle($data["tr"]['sekreter']) :'')),'title'=>'Genel Sekreter','name'=>'sekreter'));
        $text  .= $form->input(array("icon"=>"fa fa-user",'value'=>((isset($data["tr"]['vekil']) ? $this->temizle($data["tr"]['vekil']) :'')),'title'=>'Başkan Vekili','name'=>'vekil'));
        $text  .= $form->textarea(array("icon"=>"fa fa-users",'value'=>((isset($data["tr"]['yonetim']) ? $this->temizle($data["tr"]['yonetim']) :'')),'title'=>'Yönetim Kurulu Üyeleri','name'=>'yonetim'));
        $text  .= $form->textarea(array("icon"=>"fa fa-users",'value'=>((isset($data["tr"]['denetim']) ? $this->temizle($data["tr"]['denetim']) :'')),'title'=>'Denetim Kurulu Üyeleri','name'=>'denetim'));

        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));




        $text.= $form->closeDiv();
        $text .= $form->submitButton(array("color"=>"btn-success  btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeDiv();



        $text.= $form->closeDiv();


        $text .= $form->openColumn(5);

        $text.= $form->file(array('url'=>$this->BaseURL('upload')."/".$this->modulName,'folder'=>$this->modulName,'title'=>'Logo','name'=>'resim','resimBoyut'=>$this->modul_image_size($this->modul_info["id"]),'src'=>((isset($data['tr']['resim'])) ? $data['tr']['resim'] :'')));

        $text.=$form->openBox().$form->openBoxBody();

        $text  .= $form->input(array("icon"=>"fa fa-phone","required"=>true,'value'=>((isset($data["tr"]['telefon']) ? $this->temizle($data["tr"]['telefon']) :'')),'title'=>'Telefon Numarası','name'=>'telefon'));
        $text  .= $form->input(array("icon"=>"fa fa-fax",'value'=>((isset($data["tr"]['fax']) ? $this->temizle($data["tr"]['fax']) :'')),'title'=>'Fax','name'=>'fax'));
        $text  .= $form->input(array("icon"=>"fa fa-envelope",'value'=>((isset($data["tr"]['email']) ? $this->temizle($data["tr"]['email']) :'')),'title'=>'Email','name'=>'email'));

        $text  .= $form->textarea(array("icon"=>"fa fa-map-marker",'value'=>((isset($data["tr"]['adres']) ? $this->temizle($data["tr"]['adres']) :'')),'title'=>'Adres','name'=>'adres'));
        $text  .= $form->textarea(array("icon"=>"fa fa-map-marker",'value'=>((isset($data["tr"]['harita']) ? $this->temizle($data["tr"]['harita']) :'')),'title'=>'Harita (Iframe)','name'=>'harita'));

        $text.= $form->closeDiv();
        $text.= $form->closeDiv();

        $text.= $form->closeDiv();

        $text .= $form->formClose();


        return $text;
    }

    public function kaydet($id=null)
    {

        foreach ($this->settings->lang('lang') as $dil=>$title):

            if($dil == "tr"):
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'baskan'=> $this->kirlet($this->_POST('baskan')),
                    'sekreter'=> $this->kirlet($this->_POST('sekreter')),
                    'vekil'=> $this->kirlet($this->_POST('vekil')),
                    'yonetim'=> $this->kirlet($this->_POST('yonetim')),
                    'denetim'=> $this->kirlet($this->_POST('denetim')),
                    'telefon'=> $this->kirlet($this->_POST('telefon')),
                    'fax'=> $this->kirlet($this->_POST('fax')),
                    'adres'=> $this->kirlet($this->_POST('adres')),
                    'email'=> $this->kirlet($this->_POST('email')),
                    'harita'=> $this->kirlet($this->_POST('harita')),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'resim' => $this->_RESIM_BASE64('resim', $this->modulName, "", "jpg"),
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'dil' => $dil
                );
            endif;



        endforeach;




        if(isset($id) and $id):
            //Güncelle

            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["duzenleme_tarihi"] = date("Y-m-d H:i:s");
                $post[$dil]["duzenleyen"] = $this->getUserInfo("adi");
            }

            $post["tr"]["url"] = strtolower($this->permalink($post["tr"]["baslik"]))."-".$id;

            $this->dbConn->update($this->table,$post['tr'],$id);
            foreach ($this->settings->lang('lang') as $dil=>$title):
                if($dil!='tr') {
                    $post[$dil]["url"] = strtolower($this->permalink($post[$dil]["baslik"]))."-".$id;

                    if (isset($post["ar"])){
                        $post["ar"]["url"] = isset($post["en"]) ? $post["en"]["url"] : $post["tr"]["url"];
                    }

                    if(count($this->dbConn->sorgu("select lang_id from ".$this->tablelang." where dil='$dil'  and master_id='$id' "))==1)
                        $this->dbConn->update($this->tablelang, $post[$dil], array('master_id' => $id,'dil'=>$dil));
                    else
                        $this->dbConn->insert($this->tablelang,array_merge($post[$dil],array('master_id'=>$id)));
                }
            endforeach;

        else:

            // kaydet
            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["eklenme_tarihi"] = date("Y-m-d H:i:s");
                $post[$dil]["ekleyen"] = $this->getUserInfo("adi");
            }

            $post["tr"]["sira"] = $this->Order($this->table);
            $this->dbConn->insert($this->table,$post['tr'],$id);
            $lastid = $this->dbConn->lastid();

            $this->dbConn->update($this->table, array(
                "url"=>strtolower($this->permalink($post["tr"]["baslik"]))."-".$lastid
            ),$lastid);

            foreach ($this->settings->lang('lang') as $dil=>$title):

                $post[$dil]["url"] = strtolower($this->permalink($post[$dil]["baslik"]))."-".$lastid;

                if (isset($post["ar"])){
                    $post["ar"]["url"] = isset($post["en"]) ? $post["en"]["url"] : $post["tr"]["url"];
                }

                if($dil!='tr') $this->dbConn->insert($this->tablelang,array_merge($post[$dil],array('dil'=>$dil,'master_id'=>$lastid)));

            endforeach;
        endif;
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'.(($this->_POST('kid_tr')) ? "/".$this->_POST('kid_tr'):'')));
    }


    public function sil($id=null)
    {
        if ($id){
            $date = date("Y-m-d H:i:s");
            $this->dbConn->update($this->table, array("sil"=>1, "silme_tarihi"=>$date), array("id"=>$id));
            $this->dbConn->langUpdate($this->tablelang, array("sil"=>1, "silme_tarihi"=>$date), array("master_id"=>$id));
        }
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'));
    }



    public function durum($id=null)
    {
        $durum = ((isset($_GET['durum'])) ? $_GET['durum'] : null);
        $id = ((isset($_GET['id'])) ? $_GET['id'] : null);
        $tr_duzenle = $this->dbConn->update($this->table,array('aktif'=>$durum),$id);
        $lang_duzenle = $this->dbConn->langUpdate($this->tablelang,array('aktif'=>$durum),$id);

        if($tr_duzenle && $lang_duzenle) echo 1; else echo 0;
        exit();
    }





    public function kategoriler($id=null)
    {

        $kosul = "";

        if (!empty($id)){
            $kosul.=" sehir = ".$id;
        }

        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->ktable,
            "kosul"=>$kosul,
            "search"=>array("baslik"),
            "sqlEk"=>"(SELECT baslik FROM sehirler WHERE sehirler.id = ".$this->ktable.".sehir) as sehir_baslik",
        ));


        $this->SayfaBaslik = "Satış Müdürlüğü Listesi";

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;

        $text = $pagelist->Tablist($this->tablist);

        $text .= $pagelist->Pagelist(array(
            'flitpage' => array("url"=>$filterURL,"title"=>"Şehir Seçiniz",'sql'=>"select * from sehirler",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"katFilter", "class"=>"kat_filter"),
            'id'=>$id,
            'modul_id'=>$this->modul_info["id"],
            'modul_name'=>$this->modulName,
            'page'=>$this->ktable,
            "place"=>"satış müdürlerinde ara",
            "showing"=>$showing,
            //"resim"=>true,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            'button' => array(array('title'=>'Satış Müdürlüğü Ekle','href'=>$this->BaseAdminURL($this->modulName.'/kategoriEkle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('dataTitle'=>'baslik', 'class'=>'sort'),
                array('dataTitle'=>'sehir_baslik', 'class'=>'sort'),
                array('dataTitle'=>'telefon', 'class'=>'sort'),
            ),
            'tools' =>array(
                array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/kategoriEkle/'),'color'=>'btn-primary'),
                array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/kategoriSil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Ek Resimler','class'=>'btn bg-olive','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Resim/fotoekle/'), "data-icon"=>"ti-camera", "modul"=>$this->ktable),
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/kategoriDurum/')),
            ),
            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'Müdürlük Adı','width'=>'15%'),
                array('title'=>'Şehir','width'=>'10%'),
                array('title'=>'Telefon','width'=>'10%'),
                //array('title'=>'Resimler','width'=>'5%'),
                array('title'=>'Durum','width'=>'3%', "align"=>"center"),
            )
        ));

        return $text;

    }


    public function kategoriEkle($id=null)
    {
        $this->SayfaBaslik = 'Satış Müdürlüğü '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kategoriKaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(6);

        if($id) $data = $tabs->tabData($this->ktable,$id);

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text']  = $form->input(array("required"=>array("tr"),'value'=>((isset($data[$dil]['baslik']) ? $this->temizle($data[$dil]['baslik']) :'')),'title'=>'Başlık','lang'=>$dil,'name'=>'baslik'));
            //$tabForm[$dil]['text'] .= $form->textarea(array('value'=>((isset($data[$dil]['ozet']) ? $this->temizle($data[$dil]['ozet']) :'')),'title'=>'Açıklama','name'=>'ozet','lang'=>$dil));
            //$tabForm[$dil]['text']  .= $form->input(array('value'=>((isset($data[$dil]['link']) ? $this->temizle($data[$dil]['link']) :'')),'title'=>'Dışarı Link','lang'=>$dil,'name'=>'link'));

        endforeach;

        $text .= $tabs->tabContent($tabForm);



        $text.=$form->openBox().$form->openBoxBody();

        $text  .= $form->input(array("icon"=>"fa fa-phone","required"=>true,'value'=>((isset($data["tr"]['telefon']) ? $this->temizle($data["tr"]['telefon']) :'')),'title'=>'Telefon Numarası','name'=>'telefon'));
        $text  .= $form->input(array("icon"=>"fa fa-fax",'value'=>((isset($data["tr"]['fax']) ? $this->temizle($data["tr"]['fax']) :'')),'title'=>'Fax','name'=>'fax'));
        $text  .= $form->textarea(array("icon"=>"fa fa-map-marker","required"=>true,'value'=>((isset($data["tr"]['adres']) ? $this->temizle($data["tr"]['adres']) :'')),'title'=>'Adres','name'=>'adres'));


        $text .= $form->select(array("required"=>true, 'title'=>'Şehir', 'name'=>'sehir','data'=> $form->parent(array('sql'=>"select * from sehirler",'option'=>array('value'=>'id','title'=>'baslik'),'selected'=>((isset($data['tr']['sehir'])) ? $data['tr']['sehir'] :'')),0,0)));

        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));
        $text.= $form->closeDiv();

        $text .= $form->submitButton(array("color"=>"btn-success  btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeDiv();

        $text.= $form->closeDiv();



        $text .= $form->formClose();



        return $text;
    }



    public function kategoriKaydet($id=null)
    {

        foreach ($this->settings->lang('lang') as $dil=>$title):

            if($dil == "tr"):
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'telefon'=> $this->kirlet($this->_POST('telefon')),
                    'fax'=> $this->kirlet($this->_POST('fax')),
                    'adres'=> $this->kirlet($this->_POST('adres')),
                    'koordinat'=> $this->kirlet($this->_POST('koordinat')),
                    'tur'=> ($this->_POST('tur')) ? $this->_POST('tur'):1,
                    //'ozet'=> $this->kirlet($this->_POST('ozet',$dil)),
                    //'link'=> $this->kirlet($this->_POST('link',$dil)),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'sehir'=> ($this->_POST('sehir')) ? $this->_POST('sehir'):27,
                    //'ustu'=>($this->_POST('ustu')) ? $this->_POST('ustu'):0,
                    'resim' => $this->_RESIM_BASE64('resim', $this->table),
                    //'banner' => $this->_RESIM_BASE64('banner', $this->ktable),
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'tur'=> ($this->_POST('tur')) ? $this->_POST('tur'):1,
                    //'link'=> $this->kirlet($this->_POST('link',$dil)),
                    //'ozet'=> $this->kirlet($this->_POST('ozet',$dil)),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    //'ustu'=>($this->_POST('ustu')) ? $this->_POST('ustu'):0,
                    'dil' => $dil
                );
            endif;


        endforeach;




        if(isset($id) and $id):
            //Güncelle

            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["duzenleme_tarihi"] = date("Y-m-d H:i:s");
                $post[$dil]["duzenleyen"] = $this->getUserInfo("adi");
            }

            $post["tr"]["url"] = strtolower($this->permalink($post["tr"]["baslik"]))."-".$id;


            $this->dbConn->update($this->ktable,$post['tr'],$id);
            foreach ($this->settings->lang('lang') as $dil=>$title):
                if($dil!='tr') {
                    $post[$dil]["url"] = strtolower($this->permalink($post[$dil]["baslik"]))."-".$id;

                    if (isset($post["ar"])){
                        $post["ar"]["url"] = isset($post["en"]) ? $post["en"]["url"] : $post["tr"]["url"];
                    }

                    if(count($this->dbConn->sorgu("select lang_id from ".$this->ktablelang." where dil='$dil'  and master_id='$id' "))==1)
                        $this->dbConn->update($this->ktablelang, $post[$dil], array('master_id' => $id,'dil'=>$dil));
                    else
                        $this->dbConn->insert($this->ktablelang,array_merge($post[$dil],array('master_id'=>$id)));
                }
            endforeach;

        else:

            // kaydet
            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["eklenme_tarihi"] = date("Y-m-d H:i:s");
                $post[$dil]["ekleyen"] = $this->getUserInfo("adi");
            }

            $post["tr"]["sira"] = $this->Order($this->ktable);
            $this->dbConn->insert($this->ktable,$post['tr'],$id);
            $lastid = $this->dbConn->lastid();

            $this->dbConn->update($this->ktable, array(
                "url"=>strtolower($this->permalink($post["tr"]["baslik"]))."-".$lastid
            ),$lastid);

            foreach ($this->settings->lang('lang') as $dil=>$title):

                $post[$dil]["url"] = strtolower($this->permalink($post[$dil]["baslik"]))."-".$lastid;

                if (isset($post["ar"])){
                    $post["ar"]["url"] = isset($post["en"]) ? $post["en"]["url"] : $post["tr"]["url"];
                }

                if($dil!='tr') $this->dbConn->insert($this->ktablelang,array_merge($post[$dil],array('dil'=>$dil,'master_id'=>$lastid)));

            endforeach;
        endif;
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/kategoriler'.(($this->_POST('ustu')) ? "/".$this->_POST('ustu'):'')));
    }





    public function kategoriSil($id=null)
    {
        if ($id){
            $date = date("Y-m-d H:i:s");
            $this->dbConn->update($this->ktable, array("sil"=>1, "silme_tarihi"=>$date, "silen"=>$this->getUserInfo("adi")), array("id"=>$id));
            $this->dbConn->langUpdate($this->ktablelang, array("sil"=>1, "silme_tarihi"=>$date, "silen"=>$this->getUserInfo("adi")), array("master_id"=>$id));
        }
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/kategoriler'));
    }




    public function kategoriDurum($id=null)
    {
        $durum = ((isset($_GET['durum'])) ? $_GET['durum'] : null);
        $id = ((isset($_GET['id'])) ? $_GET['id'] : null);
        $tr_duzenle = $this->dbConn->update($this->ktable,array('aktif'=>$durum),$id);
        $lang_duzenle = $this->dbConn->langUpdate($this->ktablelang,array('aktif'=>$durum),$id);

        if($tr_duzenle && $lang_duzenle) echo 1; else echo 0;
        exit();
    }










}