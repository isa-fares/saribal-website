<?php


namespace AdminPanel;


class Moduller  extends Settings{


    public  $modulName = 'moduller';
    private $table;
    private $tablelang;



    public function __construct($settings)
    {
        parent::__construct($settings);
        $this->AuthCheck();
        $this->table = $this->modulName;
        $this->tablelang = $this->modulName."_lang";
    }


    public function index($id)
    {
        return $this->liste($id);
    }

    public function liste($id=null)
    {

        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->table,
            "search"=>array("baslik"),
            "limit"=>"1000"
        ));

        $this->SayfaBaslik = 'Adminpanel Modüller';

        $pagelist = new PageList($this->settings);


        return $pagelist->PageList(array(
            'id'=>$id,
            'page'=>$this->table,
            'modul_settings'=>false,
            "place"=>"modul adı",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "sayfaLimit"=>1000,
            "search"=>true,
            'button' => array(array('title'=>'Modül Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('class'=>'sort text-center','tabindex'=>0,'dataTitle'=>'id'),
                array('dataTitle'=>'icon', 'class'=>'sort', "align"=>"center", "type"=>"icon"),
                array('dataTitle'=>'baslik', 'class'=>'sort'),
                array('dataTitle'=>'modul', 'class'=>'sort', "align"=>"center"),
            ),
            'tools' =>array(
                array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                //array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'ID','width'=>'2%', "align"=>"center"),
                array('title'=>'Icon','width'=>'2%', "align"=>"center"),
                array('title'=>'Başlık','width'=>'20%'),
                array('title'=>'Tablo (url ve modül adı)','width'=>'10%'),
                array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )
        ));
    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Modül '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        if (isset($id)){
            $data = $this->dbConn->tekSorgu("SELECT * FROM $this->table WHERE id = $id");
            $boyut = $this->dbConn->tekSorgu("SELECT * FROM boyutlar WHERE modul_id = $id");
        }
        $form = new Form($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(12);

        $text.=$form->openBox().$form->openBoxBody();

        $text  .= $form->input(array("required"=>true,'value'=>((isset($data['baslik']) ? $this->temizle($data['baslik']) :'')),'title'=>'Başlık','name'=>'baslik'));
        if (isset($id)){
            $text  .= $form->input(array("required"=>true,'value'=>((isset($data['icon']) ? $this->temizle($data['icon']) :'')),"icon"=>$data["icon"],"id"=>"select_icon",'title'=>'Icon','name'=>'icon', "help"=>"<a href='".$this->baseAdminURL("icons")."' class='text-danger font-size-14' target='_blank'>Icon Listesi</a>"));
        }else {
            $text  .= $form->input(array("required"=>true,'value'=>((isset($data['icon']) ? $this->temizle($data['icon']) :'')),"id"=>"select_icon",'title'=>'Icon','name'=>'icon', "help"=>"<a href='".$this->baseAdminURL("icons")."' class='text-info font-size-14' target='_blank'>Icon Listesi</a>"));
        }

        $text  .= $form->input(array("required"=>true,'value'=>((isset($data['modul']) ? $this->temizle($data['modul']) :'')),'title'=>'Url','name'=>'modul', "help"=>"Modul Url, tablo ismi ve modul name"));


        $text .= $form->select(array('title'=>'Şu Modul Dosyasını Kopyala','name'=>'eski_modul','data'=> $form->parent(array('sql'=>"select * from moduller",'option'=>array('value'=>'id','title'=>'baslik'),'selected'=>""),0,0)));


        $text.="<div class='row'>";
        $text  .= "<div class='col-md-4'>".$form->input(array('value'=>((isset($boyut['big']) ? $this->temizle($boyut['big']) :'')),'title'=>'Resim Boyutu','name'=>'big', "help"=>"Resim Boyutu Örnek(800x600)"))."</div>";
        $text  .= "<div class='col-md-4'>".$form->input(array('value'=>((isset($boyut['thumb']) ? $this->temizle($boyut['thumb']) :'')),'title'=>'Thumb Resim Boyutu','name'=>'thumb', "help"=>"Thumb Resim Boyutu Örnek(400x300)"))."</div>";
        $text  .= "<div class='col-md-4'>".$form->input(array('value'=>((isset($boyut['ek']) ? $this->temizle($boyut['ek']) :'')),'title'=>'Çoklu Resim Boyutu','name'=>'ek', "help"=>"Çoklu Resim Boyutu Örnek(800x600)"))."</div>";

        $text.="</div>";

        $text  .= $form->input(array('value'=>((isset($data['url']) ? $this->temizle($data['url']) :'')),'title'=>'Özel Modül URL','name'=>'url', ));

        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));

        $text.= $form->closeDiv();

        $text .= $form->submitButton(array("color"=>"btn-success btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeDiv();

        $text .= $form->formClose();


        return $text;
    }

    public function kaydet($id=null)
    {





        $post = array(
            'baslik'=> $this->kirlet($this->_POST('baslik')),
            'icon'=>$this->kirlet($this->_POST('icon')),
            'modul'=>$this->kirlet($this->_POST('modul')),
            'url'=>$this->kirlet($this->_POST('url')),
            'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
        );

        $post_boyut = array(
            "big"=>$this->kirlet($this->_POST('big')),
            "thumb"=>$this->kirlet($this->_POST('thumb')),
            "ek"=>$this->kirlet($this->_POST('ek'))
        );






        if(isset($id) and $id):
            //Güncelle

            $post["duzenleme_tarihi"] = date("Y-m-d H:i:s");

            $this->dbConn->update($this->table,$post,$id);
            $kontrol = $this->dbConn->sorgu("select modul_id from boyutlar where modul_id=$id");
            if(count($kontrol) == 1){
                $this->dbConn->update("boyutlar", $post_boyut, array('modul_id' => $id));
            }

            else {
                $post_boyut["modul_id"] = $id;
                $this->dbConn->insert("boyutlar", $post_boyut);
            }


        else:

            // kaydet
            $post["eklenme_tarihi"] = date("Y-m-d H:i:s");

            $post["sira"] = $this->Order($this->table);
            $this->dbConn->insert($this->table,$post,$id);
            $lastid = $this->dbConn->lastid();
            $post_boyut["modul_id"] = $lastid;

            $this->dbConn->insert("boyutlar",$post_boyut);

        endif;

        $eski_modul = ($this->_POST('eski_modul')) ? $this->_POST('eski_modul'):0;
        if (!empty($eski_modul)){
            $modulName = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE id = $eski_modul")["modul"];
            $content = file_get_contents(__DIR__."/".ucfirst($modulName.".php"));
            $newfile = ucfirst($post["modul"]).".php";
            $bul = "class ".ucfirst($modulName);
            $dgs = "class ".ucfirst($post["modul"]);
            $changed = str_replace($bul, $dgs, $content);
            touch(__DIR__."/".ucfirst($newfile));
            file_put_contents(__DIR__."/".$newfile, $changed);

            $table = $this->dbConn->tekSorgu("show tables like '".$modulName."'");
            if (is_array($table)){
                $this->dbConn->manualSql("CREATE TABLE ".$post["modul"]." LIKE ".$modulName);
            }

            $table_lang = $this->dbConn->tekSorgu("show tables like '".$modulName."_lang'");
            if (is_array($table_lang)){
                $tb = $post["modul"]."_lang";
                $tb_old = $modulName."_lang";
                $this->dbConn->manualSql("CREATE TABLE ".$tb." LIKE ".$tb_old);
            }
        }

        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'));
    }




    public function durum($id=null)
    {
        $durum = ((isset($_GET['durum'])) ? $_GET['durum'] : null);
        $id = ((isset($_GET['id'])) ? $_GET['id'] : null);
        $tr_duzenle = $this->dbConn->update($this->table,array('aktif'=>$durum),$id);

        if($tr_duzenle) echo 1; else echo 0;
        exit();
    }




}