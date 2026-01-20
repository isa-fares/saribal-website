<?php


namespace AdminPanel;


class Proje  extends Settings{


    public  $modulName;
    private $table;
    private $tablelang;
    public  $tablist;
    public  $modul_info;
    private $ktable = "proje_kategori";
    private $ktablelang = "proje_kategori_lang";



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
            array("title" => $this->modul_info["baslik"]." Listesi", "href" => "liste", "icon" => "mdi mdi-view-sequential"),
            array("title" => "Proje Kategorileri", "href" => "kategoriler", "icon" => "mdi mdi-view-sequential"),
            //array("title" => $this->modul_info["baslik"]." Modül Ayarları", "href" => "settings", "icon" => "mdi mdi-settings")
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



        $durum = (isset($_GET["durum"])) ? $_GET["durum"] : 0;


        if (!empty($id)){
            $kosul = " kid = ".$id;
        }


        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->table,
            "kosul"=>$kosul,
            "search"=>array("baslik", "ozet"),
            "sqlEk"=>"(SELECT baslik FROM $this->ktable WHERE $this->ktable.id = ".$this->table.".kid) as kategori"
        ));

        $this->SayfaBaslik = $this->modul_info["baslik"];

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;


        $text = $pagelist->Tablist($this->tablist);

        $text .= $pagelist->PageList(array(
            'flitpage' => array("url"=>$filterURL,"title"=>"Proje Kategorisi Seçiniz",'sql'=>"select * from $this->ktable WHERE sil <> 1 and ",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"kategoriFilter", "class"=>"flit_filter", "kat"=>"ustu"),
            'id'=>$id,
            'modul_id'=>$this->modul_info["id"],
            'modul_name'=>$this->modulName,
            'page'=>$this->table,
            "place"=>"başlık",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            "resim"=>true,
            'button' => array(array('title'=>'Proje Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('dataTitle'=>'baslik', 'class'=>'sort'),
                array('dataTitle'=>'kategori', 'class'=>'sort'),
                //array('dataTitle'=>'durum', 'class'=>'sort', "type"=>"project_type"),

            ),
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Ek Resimler','class'=>'btn bg-olive','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Resim/fotoekle/'), "data-icon"=>"ti-camera", "modul"=>$this->table),
                array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Dosya Yükle','class'=>'btn btn-dark','dataname'=>'dosyaekle','url'=>$this->BaseAdminURL('Dosyalar/ekle/'), "data-icon"=>"ti-file", "modul"=>$this->table),
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'Başlık','width'=>'10%'),
                array('title'=>'Kategori','width'=>'5%'),
                //array('title'=>'Durum','width'=>'5%'),
                array('title'=>'Resim','width'=>'5%', "align"=>"center"),
                array('title'=>'Dosyalar','width'=>'5%', "align"=>"center"),
                array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )
        ));

        return $text;

    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Proje '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(8);

        if($id) $data = $tabs->tabData($this->table,$id);

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text']  = $form->input(array("required"=>array("tr"),'value'=>((isset($data[$dil]['baslik']) ? $this->temizle($data[$dil]['baslik']) :'')),'title'=>'Başlık','lang'=>$dil,'name'=>'baslik'));

            //$tabForm[$dil]['text']  .= $form->input(array('value'=>((isset($data[$dil]['ozet']) ? $this->temizle($data[$dil]['ozet']) :'')),'title'=>'Şehir / Ülke','lang'=>$dil,'name'=>'ozet'));
            //$tabForm[$dil]['text'] .= $form->textarea(array('value'=>((isset($data[$dil]['ozet']) ? $this->temizle($data[$dil]['ozet']) :'')),'title'=>'Özet','name'=>'ozet','lang'=>$dil));
            $tabForm[$dil]['text'] .= $form->textEditor(array('value'=>((isset($data[$dil]['detay']) ? $this->temizle($data[$dil]['detay']) :'')),'title'=>'Detay','name'=>'detay','lang'=>$dil,'height' => '310'));
        endforeach;

        $text .= $tabs->tabContent($tabForm);





        /*$text.=$form->openBox().$form->openBoxBody();

        $text .= $form->date(array("format"=>"DD.MM.YYYY",'value'=>(((isset($data["tr"]['baslangic']) && !empty($data["tr"]["baslangic"])) ? date("d.m.Y",strtotime($data["tr"]['baslangic'])) :null)),'title'=>'Başlangıç Tarihi','name'=>'baslangic'));

        $text .= $form->date(array("format"=>"DD.MM.YYYY",'value'=>(((isset($data["tr"]['bitis']) && !empty($data["tr"]["bitis"])) ? date("d.m.Y",strtotime($data["tr"]['bitis'])) :null)),'title'=>'Bitiş Tarihi','name'=>'bitis'));


        $text.= $form->closeDiv();
        $text.= $form->closeDiv();*/


        $text.= $form->closeDiv();

        $text.= $form->openColumn(4);
        $text.= $form->file(array('url'=>$this->BaseURL('upload')."/".$this->modulName,'folder'=>$this->modulName,'title'=>'Proje Görseli','name'=>'resim','resimBoyut'=>$this->modul_image_size($this->modul_info["id"]),'src'=>((isset($data['tr']['resim'])) ? $data['tr']['resim'] :'')));


        $text.=$form->openBox().$form->openBoxBody();

        $text .= $form->date(array("format"=>"DD.MM.YYYY","required"=>"true", 'value'=>((isset($data["tr"]['tarih']) ? date("d.m.Y",strtotime($data["tr"]['tarih'])) : date('d.m.Y'))),'title'=>'Tarih','name'=>'tarih'));

        $text .= $form->select(array('title'=>'Proje Kategorisi', 'name'=>'kid','data'=> $form->parent(array('sql'=>"select * from $this->ktable WHERE sil <> 1",'option'=>array('value'=>'id','title'=>'baslik'),'selected'=>((isset($data['tr']['kid'])) ? $data['tr']['kid'] :'')),0,0)));


        /*$text .= $form->select(array('title'=>'Proje Durumu','name'=>'durum','data'=> $form->parent(array('array'=>array(
            array('id'=>'1','text'=> 'Devam Eden Projeler'),
            array('id'=>'2','text'=>'Tamamlanan Projeler'),
        ),
            'option'=>array('value'=>'id','title'=>'text'),'selected'=>$data["tr"]["durum"]),0,0)));*/


        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));


        $text.= $form->closeDiv();
        $text .= $form->submitButton(array("color"=>"btn-success  btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeDiv();

        $text.=$form->closeDiv();



        $text .= $form->formClose();


        return $text;
    }

    public function kaydet($id=null)
    {

        foreach ($this->settings->lang('lang') as $dil=>$title):

            if($dil == "tr"):
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'baslangic'=>$this->kirlet($this->_POST('baslangic')),
                    'tarih'=>$this->kirlet($this->_POST('tarih')),
                    'bitis'=>$this->kirlet($this->_POST('bitis')),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'kid'=> ($this->_POST('kid')) ? $this->_POST('kid'):0,
                    'durum'=> ($this->_POST('durum')) ? $this->_POST('durum'):0,
                    'resim' => $this->_RESIM_BASE64('resim', $this->modulName,"","jpg",""),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'kid'=> ($this->_POST('kid')) ? $this->_POST('kid'):0,
                    'ozet'=>$this->kirlet($this->_POST('ozet',$dil)),
                    'tarih'=>$this->kirlet($this->_POST('tarih')),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
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
        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->ktable,
            "kosul"=>(isset($id)) ? "ustu = ".$id : ((!empty($_GET["kelime"])) ? "" : " ustu = 0"),
            "search"=>array("baslik"),
        ));

        $this->SayfaBaslik = "Proje Kategori Listesi";

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;

        $text = $pagelist->Tablist($this->tablist);

        $text .= $pagelist->Pagelist(array(
            //'flitpage' => array("url"=>$filterURL,"title"=>"Kategori Seçiniz",'sql'=>"select * from $this->ktable WHERE sil <> 1 and ",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"kategoriFilter", "class"=>"flit_filter", "kat"=>"ustu"),
            'id'=>$id,
            'modul_id'=>$this->modul_info["id"],
            'modul_name'=>$this->modulName,
            'page'=>$this->ktable,
            "place"=>"kategorilerde ara",
            "showing"=>$showing,
            "resim"=>false,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            'button' => array(array('title'=>'Kategori Ekle','href'=>$this->BaseAdminURL($this->modulName.'/kategoriEkle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('dataTitle'=>'baslik', 'class'=>'sort'),
            ),

            'tools' =>array(
                array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/kategoriEkle/'),'color'=>'btn-primary'),
                array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/kategoriSil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Video Ekle','class'=>'btn bg-olive','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('video/liste/'), "data-icon"=>"mdi mdi-video"),
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'3D Modeller','class'=>'btn btn-success','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Dosyalar/fotoekle/'), "data-icon"=>" ti-envelope", "modul"=>"kategori", "file_type"=>"3d"),
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/kategoriDurum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'Kategori Adı','width'=>'25%'),
                //array('title'=>'Videolar','width'=>'5%'),
                //array('title'=>'3D Modeller','width'=>'5%'),
                array('title'=>'Durum','width'=>'3%', "align"=>"center"),
            )
        ));

        return $text;

    }


    public function kategoriEkle($id=null)
    {
        $this->SayfaBaslik = 'Kategori '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kategoriKaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(5);

        if($id) $data = $tabs->tabData($this->ktable,$id);

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text']  = $form->input(array("required"=>array("tr"),'value'=>((isset($data[$dil]['baslik']) ? $this->temizle($data[$dil]['baslik']) :'')),'title'=>'Kategori Adı','lang'=>$dil,'name'=>'baslik'));
            //$tabForm[$dil]['text'] .= $form->textarea(array('value'=>((isset($data[$dil]['ozet']) ? $this->temizle($data[$dil]['ozet']) :'')),'title'=>'Açıklama','name'=>'ozet','lang'=>$dil));
            //$tabForm[$dil]['text']  .= $form->input(array('value'=>((isset($data[$dil]['link']) ? $this->temizle($data[$dil]['link']) :'')),'title'=>'Dışarı Link','lang'=>$dil,'name'=>'link'));

        endforeach;

        $text .= $tabs->tabContent($tabForm);

        $text.=$form->openBox().$form->openBoxBody();

        //$text .= $form->select(array('title'=>'Üst Kategori', 'name'=>'ustu','data'=> $form->parent(array('sql'=>"select * from $this->ktable WHERE sil <> 1",'option'=>array('value'=>'id','title'=>'baslik'),'selected'=>((isset($data['tr']['ustu'])) ? $data['tr']['ustu'] :'')),0,0)));
        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));
        $text.= $form->closeDiv();

        $text .= $form->submitButton(array("color"=>"btn-success  btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeDiv();

        $text.= $form->closeDiv();


        /* $text .= $form->openColumn(4);

             $text.= $form->file(array('url'=>$this->BaseURL('upload')."/".$this->ktable,'folder'=>$this->ktable,'title'=>'Sayfa Banner Resmi','name'=>'banner_resim','resimBoyut'=>"1920x900",'src'=>((isset($data['tr']['resim'])) ? $data['tr']['resim'] :'')));



         $text.= $form->closeDiv();*/

        $text .= $form->formClose();



        return $text;
    }



    public function kategoriKaydet($id=null)
    {

        foreach ($this->settings->lang('lang') as $dil=>$title):

            if($dil == "tr"):
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    //'ozet'=> $this->kirlet($this->_POST('ozet',$dil)),
                    //'link'=> $this->kirlet($this->_POST('link',$dil)),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    //'ustu'=>($this->_POST('ustu')) ? $this->_POST('ustu'):0,
                    'resim' => $this->_RESIM_BASE64('banner_resim', $this->ktable),
                    'banner' => $this->_RESIM_BASE64('banner', $this->ktable),
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
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