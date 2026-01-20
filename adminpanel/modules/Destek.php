<?php


namespace AdminPanel;


class Destek  extends Settings{


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
            array("title" => "Devlet Destekleri Listesi", "href" => "liste", "icon" => "mdi mdi-view-sequential"),
            //array("title" => "Haberler Modül Ayarları", "href" => "settings", "icon" => "mdi mdi-settings")
        );


    }


    public function index($id=null)
    {
        $function = $this->getParameter()["function"];
        if (empty($function)){
            //header("Location:".$this->baseAdminURL($this->modulName."/liste"));
            return $this->liste($id=null);
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

        if (isset($_GET["filter"])){
            $kosul = " 1=1 ";

            if (isset($_GET["kurum"]) && $_GET["kurum"] != ""){
                $kosul.=" and kurumlar LIKE '%\"".$_GET["kurum"]."\"%'";
            }

            if (isset($_GET["konu"]) && $_GET["konu"] != ""){
                $kosul.=" and konular LIKE '%\"".$_GET["konu"]."\"%'";
            }

            if (isset($_GET["durum"]) && $_GET["durum"] != 0){
                $kosul.=" and aktif = ".$_GET["durum"];
            }

        }

        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->table,
            "search"=>array("baslik", "detay"),
            "kosul"=>$kosul,
            "order"=>"ORDER BY eklenme_tarihi DESC",
        ));

        $this->SayfaBaslik = $this->modul_info["baslik"];

        $pagelist = new PageList($this->settings);




        $text = $pagelist->Destekpagelist(array(
            'id'=>$id,
            'modul_id'=>$this->modul_info["id"],
            'modul_name'=>$this->modulName,
            'page'=>$this->table,
            "place"=>"kelime giriniz",
            "showing"=>$showing,
            //'resim'=>true,
            "toplamVeri"=>$toplamVeri,
            "disableSortable"=>true,
            "search"=>true,
            'button' => array(array('title'=>'Destek Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('dataTitle'=>'baslik', 'class'=>'sort'),
                array('dataTitle'=>'kurumlar', 'class'=>'sort'),
                array('dataTitle'=>'konular', 'class'=>'sort'),

            ),
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Ek Resimler','class'=>'btn bg-olive','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Resim/fotoekle/'), "data-icon"=>"ti-camera", "modul"=>$this->table),
                array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Dosya Yükle','class'=>'btn btn-dark','dataname'=>'dosyaekle','url'=>$this->BaseAdminURL('Dosyalar/ekle/'), "data-icon"=>"ti-file", "lang"=>"tr", "modul"=>$this->table),
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'Başlık','width'=>'20%'),
                array('title'=>'Kurum','width'=>'10%'),
                array('title'=>'Konu','width'=>'10%'),
                //array('title'=>'Ek Resimler','width'=>'5%', "align"=>"center"),
                array('title'=>'Dosyalar','width'=>'5%', "align"=>"center"),
                array('title'=>'Proje Durumu','width'=>'4%', "align"=>"center"),
            )
        ));

        return $text;

    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Destek '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));

        $text .= $form->openColumn(6);

        if($id) $data = $tabs->tabData($this->table,$id);

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text']  = $form->input(array("required"=>array("tr"),'value'=>((isset($data[$dil]['baslik']) ? $this->temizle($data[$dil]['baslik']) :'')),'title'=>'Başlık','lang'=>$dil,'name'=>'baslik'));
            //$tabForm[$dil]['text'] .= $form->input(array('yardim'=>"Markaya tıklanınca açılacak sayfanın urlsi", 'icon'=>'fa fa-unlink','value'=>((isset($data[$dil]['link']) ? $this->temizle($data[$dil]['link']) :'')),'title'=>'URL','lang'=>$dil,'name'=>'link', 'help'=>"Örneğin: ".$this->baseURL("iletisim.html")));
            $tabForm[$dil]['text'] .= $form->textEditor(array('value'=>((isset($data[$dil]['detay']) ? $this->temizle($data[$dil]['detay']) :'')),'title'=>'Detay','name'=>'detay','lang'=>$dil,'height' => '183'));

            $tabForm[$dil]['text'] .=  $form->tags(array('value'=>((isset($data[$dil]['etiketler']) ? $this->temizle($data[$dil]['etiketler']) :'')),'title'=>'Etiketler', 'name'=>'etiketler', "lang"=>$dil));
        endforeach;

        $text .= $tabs->tabContent($tabForm);

        $text.= $form->closeDiv();

        $text.=$form->openColumn(6);


        $text.=$form->openBox().$form->openBoxBody();

        $text .= $form->selectmulti(array("required"=>true, 'title'=>'Kurumlar', 'name'=>'kurumlar','data'=> $form->parent(array('sql'=>"select * from kurum WHERE sil <> 1",'option'=>array('value'=>'id','title'=>'baslik'),'selected'=>((isset($data['tr']['kurumlar'])) ? $data['tr']['kurumlar'] :'')),0,0)));

        $text .= $form->selectmulti(array( "required"=>true, 'title'=>'Konular', 'name'=>'konular','data'=> $form->parent(array('sql'=>"select * from konu  WHERE sil <> 1",'option'=>array('value'=>'id','title'=>'baslik'),'selected'=>((isset($data['tr']['konular'])) ? $data['tr']['konular'] :'')),0,0)));

        $text .= $form->selectmulti(array("selectAll"=>true, 'title'=>'Sektörler', 'name'=>'sektorler','data'=> $form->parent(array('sql'=>"select * from sektor  WHERE sil <> 1",'option'=>array('value'=>'id','title'=>'baslik'),'selected'=>((isset($data['tr']['sektorler'])) ? $data['tr']['sektorler'] :'')),0,0)));

        $text .= $form->selectmulti(array("selectAll"=>true, 'title'=>'Şehirler', 'name'=>'sehirler','data'=> $form->parent(array('sql'=>"select * from sehirler ",'option'=>array('value'=>'id','title'=>'baslik'),'selected'=>((isset($data['tr']['sehirler'])) ? $data['tr']['sehirler'] :'')),0,0)));

        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));


        $text.= $form->closeDiv();

        $text .= $form->submitButton(array("color"=>"btn-success  btn-lg","name"=>"action","value"=>"save", "icon"=>"fa fa-save", 'appendButon'=>array("text"=>(($id) ? 'Güncelle':'Kaydet')." ve Dosya Yükle", 'value'=>"save_and_continue", "class"=>"btn-lg btn-danger ml-20", "icon"=>"ti-files"), 'submit'=>($id) ? 'Güncelle':'Kaydet'));

        $text.= $form->closeDiv();

        $text.= $form->closeDiv();
        $text .= $form->formClose();


        return $text;
    }

    public function kaydet($id=null)
    {
        $action = $this->_POST("action");

        foreach ($this->settings->lang('lang') as $dil=>$title):

            if($dil == "tr"):
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'etiketler'=> $this->kirlet(implode(",", $this->_POST('etiketler', $dil))),
                    'tarih'=>date('Y-m-d', strtotime($this->_POST("tarih"))),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'kurumlar' => $this->arraytojson($this->_POST('kurumlar')),
                    'konular' => $this->arraytojson($this->_POST('konular')),
                    'sektorler' => $this->arraytojson($this->_POST('sektorler')),
                    'sehirler' => $this->arraytojson($this->_POST('sehirler')),
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'etiketler'=> $this->kirlet(implode(",", $this->_POST('etiketler', $dil))),
                    'tarih'=>date('Y-m-d', strtotime($this->_POST("tarih"))),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'kurumlar' => $this->arraytojson($this->_POST('kurumlar')),
                    'konular' => $this->arraytojson($this->_POST('konular')),
                    'sektorler' => $this->arraytojson($this->_POST('sektorler')),
                    'sehirler' => $this->arraytojson($this->_POST('sehirler')),
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
                $post[$dil]["duzenleme_tarihi"] = date("Y-m-d H:i:s");
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
        if ($action == "save"){
            $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'.(($this->_POST('kid_tr')) ? "/".$this->_POST('kid_tr'):'')));
        }
        if ($action == "save_and_continue"){
            $location_id = ((isset($id) and $id) ? $id : $lastid);
            $this->RedirectURL($this->BaseAdminURL('Dosyalar/ekle/'.$location_id."&type=".$this->modulName."&lang=tr"));
        }

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

    public function proje_durum($id=null)
    {
        $durum = ((isset($_GET['durum'])) ? $_GET['durum'] : null);
        $id = ((isset($_GET['id'])) ? $_GET['id'] : null);
        $tr_duzenle = $this->dbConn->update($this->table,array('durum'=>$durum),$id);
        $lang_duzenle = $this->dbConn->langUpdate($this->tablelang,array('durum'=>$durum),$id);

        if($tr_duzenle && $lang_duzenle) echo 1; else echo 0;
        exit();
    }







}