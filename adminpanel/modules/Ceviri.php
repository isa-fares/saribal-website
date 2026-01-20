<?php


namespace AdminPanel;


class Ceviri  extends Settings{


    public  $modulName;
    private  $table;
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

        $this->tablist = array(
            array("title" => "Çeviri Listesi", "href" => "liste", "icon" => "mdi mdi-view-sequential"),
            //array("title" => "Haberler Modül Ayarları", "href" => "settings", "icon" => "mdi mdi-settings")
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
            $kosul = " and  kid = '".$id."'";
        }



        $search_columns = array("key");

        $this->SayfaBaslik = $this->modul_info["baslik"];

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;

        $text = "";

        $baslik_list = array(
            array("title"=>"Key", "width"=>"10%")
        );

        $p_list = array(
            array('dataTitle'=>'key', 'type'=>'short_text'),
        );

        foreach ($this->settings->lang("lang") as $key=>$lang){
            array_push($baslik_list, array("title"=>strtoupper($key), "width"=>"10%"));
            array_push($p_list, array("dataTitle"=>$key, 'type'=>'short_text'));
            array_push($search_columns, $key);
        }

        list($sql, $showing, $toplamVeri) = $this->ceviriSayfalama(array(
            "table"=>$this->table,
            "search"=>$search_columns,
            "kosul"=>$kosul,
        ));


        $text .= $pagelist->PageList(array(
            'flitpageceviri' => array("url"=>$filterURL,"title"=>"Kategori Seçiniz",'sql'=>"select * from ceviri_kategori",'option'=>array('value'=>'baslik','title'=>'baslik'), "name"=>"kategoriFilter", "class"=>"flit_filter"),
            'id'=>$id,
            'selected_cat'=>$id,
            'modul_id'=>$this->modul_info["id"],
            'modul_name'=>$this->modulName,
            'page'=>$this->table,
            "place"=>"kelime giriniz",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "disableSortable"=>true,
            "search"=>true,
            'button' => array(array('title'=>'Çeviri Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle&kid='.$id),"class"=>"btn btn-success")),
            'p'=>$p_list,
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),
            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>$baslik_list
        ));

        return $text;

    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Çeviri '.(($id) ? "Düzenle" : "Ekle");
        $selectedKid = (isset($_GET["kid"]) ? $_GET["kid"] : '');
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));

        if ($id) $data = $this->dbConn->tekSorgu("SELECT * FROM ".$this->table." WHERE id = $id");
        $text .= $form->openColumn(8);

        $text.=$form->openBox().$form->openBoxBody();
        $text .= $form->input(array("required"=>true,'value'=>((isset($data['key']) ? $this->temizle($data['key']) :'')),'title'=>'Key','name'=>'key'));
        foreach ($this->settings->lang('lang') as $dil=>$title):
            $text .= $form->input(array("required"=>(($dil === "tr") ? true : null), 'lang'=>$dil, 'id'=>'ceviri_value_'.$dil, 'value'=>((isset($data[$dil]) ? $this->temizle($data[$dil]) :'')),'title'=>'Value','name'=>'value'));
        endforeach;

        $text.= $form->closeDiv();
        $text.= $form->closeDiv();

        $text.= $form->closeDiv();

        $text.=$form->openColumn(4);
        $text.=$form->openBox().$form->openBoxBody();

        $text .= $form->select(array("required"=>true, 'title'=>'Grup', 'name'=>'kid','data'=> $form->parent(array('sql'=>"select * from ceviri_kategori ",'option'=>array('value'=>'baslik','title'=>'baslik'),'selected'=>((isset($data['kid'])) ? $data['kid'] : $selectedKid)),0,0)));

        $text.= $form->closeDiv();

        $text .= $form->submitButton(array("color"=>"btn-success  btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeDiv();

        $text.= $form->closeDiv();
        $text .= $form->formClose();


        return $text;
    }

    public function kaydet($id=null)
    {

        $dbname = $this->getDbName();
        $post = array(
            '`key`'=> $this->kirlet($this->_POST('key')),
            '`kid`'=> $this->kirlet($this->_POST('kid')),
        );

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $post["`".$dil."`"] = $this->kirlet($this->_POST("value",$dil));

            $knt = $this->dbConn->tekSorgu("SELECT COUNT(*) as tp FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$this->table' AND COLUMN_NAME = '".$dil."' AND table_schema = '".$dbname."'");

            if ($knt["tp"] == 0){
                $this->dbConn->manualSql("ALTER TABLE $this->table ADD COLUMN ".$dil." TEXT(0)");
            }

        endforeach;


        if(isset($id) and $id){
            //GÜNCELLE
            $this->dbConn->update($this->table, $post, $id);
        }else {
            //EKLE

            $al = $this->dbConn->tekSorgu("SELECT * FROM $this->table WHERE `key` = '".$this->kirlet($this->_POST('key'))."' and kid = '".$this->kirlet($this->_POST('kid'))."'");
            if (is_array($al)){
                //KEY DAHA ÖNCE EKLENMİŞSE SİL

                $this->dbConn->sil("DELETE FROM $this->table WHERE `key` = '".$this->kirlet($this->_POST('key'))."' and kid = '".$this->kirlet($this->_POST('kid'))."'");
            }

            $this->dbConn->insert($this->table,$post);
        }

        $this->ceviriDosyaYaz($this->_POST('kid'));
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'.(($this->_POST('kid')) ? "&kid=".$this->_POST('kid'):'')));
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




}