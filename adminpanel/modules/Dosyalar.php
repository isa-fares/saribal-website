<?php


namespace AdminPanel;


class Dosyalar  extends Settings{


    public  $modulName = "dosyalar";
    private $table = "dosyalar";
    private $tablelang;


    public function __construct($settings)
    {
        parent::__construct($settings);
        $this->AuthCheck();
    }


    public function index($id)
    {
        return $this->ekle($id);
    }



    public function ekle($id=0)
    {
        $type = (isset($_GET["type"])) ? $_GET["type"] : null;
        $file_type = (isset($_GET["file_type"])) ? $_GET["file_type"] : null;
        $lang = (isset($_GET["lang"])) ? $_GET["lang"] : "tr";

        $langTitle = $this->settings->lang("lang")[$lang];


        $kat = $this->dbConn->tekSorgu("SELECT * FROM $type WHERE id = $id");
        $baslik = $this->permalink($this->temizle($kat["baslik"]));





        $addTitle = "Dosya Yükle [".$langTitle."]";
        $list_title = "Ekli Dosyalar [".$langTitle."]";
        $sub_title = "Dosya Ekle";
        if (!empty($file_type)){
            if ($file_type == "video"){
                $list_title = "Video Listesi";
                $addTitle = "Video Yükle";
                $sub_title = "Video Ekle";
            }
            if ($file_type == "3d"){
                $list_title = "3D Modeller Listesi";
                $addTitle = "3D Model Yükle";
                $sub_title = "3D Model Ekle";
            }
        }


        $this->SayfaBaslik = $this->kisalt($this->temizle($kat["baslik"]),40).' / '.$sub_title;


        $upload_folder = '../'.$this->settings->config('folder').$type."/";
        if (!empty($file_type)){
            $upload_folder = '../'.$this->settings->config('folder').$file_type."/";
        }

        $pagelist = new Pagelist($this->settings);

        return $pagelist->Dosyalist(array(
            'title'=> 'Dosya Listesi',
            'id'=>$id,
            'type'=>$type,
            "list_title"=>$list_title,
            'page'=>'dosyalar',
            "file_type"=>$file_type,
            'pfolder'=>$upload_folder,
            'p'=>array(
                array('class'=>'sort text-center sira_no','tabindex'=>0,'dataTitle'=>'sira'),
                array('dataTitle'=>'file_type'),
                array('dataTitle'=>'baslik', "download"=>true),
            ),
            //'button' => array(array('title'=>'Dosya Ekle','href'=>$this->BaseAdminURL($this->modulName.'/yukle&data_id='.$id."&type=".$type."&lang=".$lang),"class"=>"btn btn-success")),
            'tools' =>array(array('type'=>$type, 'title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/duzenle/'),'color'=>'btn-primary'),
                array('type'=>$type, "disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon dosyaSil')
            ),
            'yukle'=> array('lang'=>$lang, 'type'=>'button','title'=>$addTitle,'class'=>'btn-primary btn-block btn-lg','modul'=>$type,"file_type"=>$file_type, 'is_files'=>'1', 'folder'=>$upload_folder,'name'=>((isset($baslik)) ? $baslik:null)),
            'buton'=> array(
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/dosyaDurum/')),
            ),

            'pdata' => $this->dosyaAl(array(
                "type"=>$type,
                "data_id"=>$id,
                "tur"=>"dosya",
                "lang"=>$lang,
                "file_type"=>$file_type
            )),

            'baslik'=>array(
                array('title'=>'Sıra No','width'=>'5%'),
                array('title'=>'Türü','width'=>'3%'),
                array('title'=>'Başlık','width'=>'25%'),
                array('title'=>'Aktif','width'=>'5%'),
            )

        ));

    }



    public function sil($id=null)
    {
        $rec2 = $this->dbConn->tekSorgu("SELECT * FROM dosyalar WHERE id='$id'");
        $type = $rec2["type"];

        $kid = $rec2['data_id'];
        $date = date("Y-m-d H:i:s");

        if($id) $this->dbConn->update("dosyalar", array("sil"=>1, "silme_tarihi"=>$date), array("id"=>$id));
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/ekle/'.$kid."&type=".$type));
    }


    public function duzenle($id=null)
    {

        if(isset($id) and $id) $data = $this->dbConn->tekSorgu('select * from dosyalar WHERE id='.$id);
        $type = $data["type"];
        $file_type = $data["file_type"];
        $lang = $data["lang"];
        $data_id = $data["data_id"];

        $text = '';
        $this->SayfaBaslik = ($type == "belge") ? "Belge Düzenle" : 'Dosya Düzenle';

        $form = new Form($this->settings);
        $text .= $form->formOpen(array('method'=>'POST','action'=>  $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')."&type=".$type),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));

        $text .= $form->openColumn(8);
        $text.=$form->openBox().$form->openBoxBody();


        $inputTitle = '<img src="'.$this->ThemeFile().'/assets/flags/'.$lang.'.png" width="25px" style="margin-right:10px;">';
        $text .= $form->input(array('style'=>(($lang == "ar") ? "direction:rtl":""),'value'=>((isset($data['baslik']) ? $data['baslik'] :'')),'lang'=>$lang,'title'=>$inputTitle.' Dosya Başlığı','name'=>'baslik','id'=>'baslik'));

        $text .= $form->submitButton(array("color"=>"btn-success btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.="<input type='hidden' name='type' value='".$type."'>";
        $text.="<input type='hidden' name='file_type' value='".$file_type."'>";
        $text.="<input type='hidden' name='lang' value='".$lang."'>";
        $text.="<input type='hidden' name='data_id' value='".$data_id."'>";


        $text.=$form->closeBoxBody();
        $text.=$form->closeBox();

        $text.=$form->closeDiv();
        $text .= $form->openColumn(4);

        //$text.= $form->file(array('url'=>$this->BaseURL('upload')."/".$file_type,'folder'=>$file_type,'title'=>'Kapak Resmi','name'=>'resim','resimBoyut'=>'600x350','src'=>((isset($urun['resim'])) ? $urun['resim'] :'')));

        $text.=$form->closeDiv();

        $text .= $form->formClose();
        return $text;
    }

    public  function kaydet($id=null)
    {
        $lang = $this->_POST("lang");
        $data_id = $this->_POST("data_id");
        $type = $this->_POST("type");

        $post = array(
            'baslik'=> $this->_POST('baslik', $lang),
            'duzenleme_tarihi'=>date("Y-m-d H:i:s"),
            'duzenleyen'=>$this->getUserInfo("adi")
        );


        // Güncelle
        if(isset($id) and $id):
            $this->dbConn->update('dosyalar',$post,$id);
            if ($type == "destek"){
                $this->dbConn->update("destek", array("duzenleme_tarihi"=>date("Y-m-d H:i:s")), array("id"=>$data_id));
                $this->dbConn->update("destek_lang", array("duzenleme_tarihi"=>date("Y-m-d H:i:s")), array("master_id"=>$data_id));
            }
        endif;

        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/ekle/'.$data_id."&type=".$type.((!empty($file_type)) ? "&file_type=".$file_type : "").((!empty($lang)) ? "&lang=".$lang : "")));
    }




    public function dosyaDurum($id=null)
    {
        $durum = ((isset($_GET['durum'])) ? $_GET['durum'] : null);

        $id = ((isset($_GET['id'])) ? $_GET['id'] : null);

        $tr_duzenle = $this->dbConn->update("dosyalar",array('aktif'=>$durum),$id);

        if($tr_duzenle) echo 1; else echo 0;

        exit();
    }




}