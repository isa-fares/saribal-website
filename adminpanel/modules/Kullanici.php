<?php


namespace AdminPanel;


class Kullanici  extends Settings{


    public  $modulName = 'kullanici';
    private $table;
    private $tablelang;
    public  $tablist;
    public $modul_info;



    public function __construct($settings)
    {
        parent::__construct($settings);

        $this->AuthCheck();

        $cmd = strtolower($this->getParameter()["modul"]);
        $this->modul_info = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE modul = '$cmd'");

        $this->modulName = $cmd;
        $this->table = $this->modulName;
        $this->tablelang = $this->modulName."_lang";


    }



    public function index($id)
    {
        $function = $this->getParameter()["function"];
        if (empty($function)){
            header("Location:".$this->baseAdminURL($this->modulName."/liste"));
        }
    }




    public function liste($id=null)
    {
        $active_user = $this->user_id;
        $user_tur = $this->user_type;
        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->table,
            "kosul"=>" (tur <> 1 and tur >= $user_tur) ",
            "search"=>array("kullanici", "adi"),
            "order"=>"ORDER BY id ASC"
        ));

        $this->SayfaBaslik = $this->modul_info["baslik"];

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;


        $text = $pagelist->Tablist($this->tablist);

        $text .= $pagelist->PageList(array(
            //'flitpage' => array("url"=>$filterURL,"title"=>"Sayfa Kategorisi Seçiniz",'sql'=>"select * from sayfakategori ",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"sayfaFilter", "class"=>"flit_filter"),
            'id'=>$id,
            'modul_id'=>$this->modul_info["id"],
            'modul_name'=>$this->modulName,
            'page'=>$this->table,
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "disableSortable"=>true,
            "search"=>true,
            'button' => array(array('title'=>'Kullanıcı Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('class'=>'sort text-center','tabindex'=>0,'dataTitle'=>'id'),
                array('dataTitle'=>'kullanici', 'class'=>'sort', "type"=>"oturum"),
                array('dataTitle'=>'adi', 'class'=>'sort')
            ),
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                               array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Resim Ekle','class'=>'btn bg-olive','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Resim/fotoekle/'), "data-icon"=>"ti-camera", "modul"=>$this->table),
                //array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'ID','width'=>'2%', "align"=>"center"),
                array('title'=>'Kullanıcı Adı','width'=>'20%'),
                array('title'=>'Adı','width'=>'20%'),
            )
        ));

        return $text;

    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Kullanıcı '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $form = new Form($this->settings);
        $user_type = $this->user_type;
        if (isset($id)){
            $data = $this->dbConn->tekSorgu("SELECT * FROM $this->table WHERE id = $id");
            if ($user_type > $data["tur"]){
                $this->setPanelMessage("error", "Bu kullanıcıyı düzenlemek için yetkiniz bulunmamaktadır.");
                $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'));
            }
        }


        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text.="<div class='col-md-12'>";
        $text.= $form->openBox().$form->openBoxBody();
        $text.="<div class='row'>";
        $text.="<div class='col-md-8'>";

        $text  .= $form->input(array("required"=>true,'value'=>((isset($data['kullanici']) ? $this->temizle($data['kullanici']) :'')),'title'=>'Kullanıcı Adı','name'=>'kullanici'));
        $text  .= $form->input(array("required"=>true,'value'=>((isset($data['adi']) ? $this->temizle($data['adi']) :'')),'title'=>'Adı','name'=>'adi'));
        if (isset($id)){
            $text  .= $form->input(array("type"=>"password",'title'=>'Şifre','name'=>'sifre', "help"=>"Boş bırakırsanız şifreniz değişmeyecektir."));
        }
        else {
            $text  .= $form->input(array('title'=>'Şifre','name'=>'sifre', 'required'=>true,"minlength"=>5));
        }


        if ($user_type == 1){
            $text .= $form->selectmulti(array('required'=>true,'title'=>'Yetkiler','name'=>'yetkiler','data'=> $form->parent(array("multiple"=>true, 'sql'=>"select * from moduller WHERE aktif = 1",'option'=>array('value'=>'id','title'=>'baslik'),'selected'=>((isset($data['yetkiler'])) ? json_decode($data['yetkiler']) :'')),0,0)));
        }

        else {
            if ($this->user_id != $id){
                $user  = $this->dbConn->tekSorgu("SELECT * FROM kullanici WHERE id = $this->user_id");
                $yetki_list = implode(",", array_map('intval', json_decode($user["yetkiler"])));
                $text .= $form->selectmulti(array('required'=>true,'title'=>'Yetkiler','name'=>'yetkiler','data'=> $form->parent(array('sql'=>"select * from moduller WHERE aktif = 1 and id IN ($yetki_list)",'option'=>array('value'=>'id','title'=>'baslik'),'selected'=>((isset($data['yetkiler'])) ? json_decode($data['yetkiler']) :'')),0,0)));

            }

        }



        $text .= $form->submitButton(array("color"=>"btn-success btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));

        $text.="</div>";
        $text.="<div class='col-md-4'>";

        $text.= $form->file(array('url'=>$this->BaseURL('upload')."/users",'folder'=>"users",'title'=>'İkon','name'=>'user_icon','resimBoyut'=>$this->modul_image_size($this->modul_info["id"]),'src'=>((isset($data['resim'])) ? $data['resim'] :'')));
        $text.="</div>";
        $text.= $form->closeDiv();
        $text.= $form->closeDiv();
        $text.= $form->closeDiv();


        $text .= $form->formClose();
        return $text;

    }



    public function kaydet($id=null)
    {

        $user_type = $this->user_type;

        $post = array(
            "adi"=>$this->kirlet($this->_POST('adi')),
            "kullanici"=>$this->kirlet($this->_POST('kullanici')),
            'resim' => $this->_RESIM_BASE64('user_icon', "users"),

        );

        if (!empty($this->_POST("sifre"))){
            $post["sifre"] = sha1(md5(($this->_POST('sifre'))));
        }


        if(isset($id) and $id):
            //Güncelle

            $data = $this->dbConn->tekSorgu("SELECT * FROM $this->table WHERE id = $id");
            $tur = $data["tur"];

            if ($this->user_id != $id && $user_type < $tur){
               $post["yetkiler"] = $this->arraytojson($this->_POST('yetkiler'));
            }


            $post["duzenleme_tarihi"] = date("Y-m-d H:i:s");
            $post["duzenleyen"] = $this->getUserInfo("adi");

            if ($user_type == 1 || ($user_type <= $tur)){
                $this->dbConn->update($this->table,$post,$id);
                $this->setPanelMessage("success", "Kullanıcı Güncellendi.");
            }

            else {
                $this->setPanelMessage("error", "Bu kullanıcıyı düzenlemek için yetkiniz bulunmamaktadır.");
            }

        else:
            // kaydet

            $post["tur"] = $user_type+1;
            $post["parent"] = $this->user_id;
            $post["ekleyen"] = $this->getUserInfo("adi");
            $post["eklenme_tarihi"] = date("Y-m-d H:i:s");
            $post["yetkiler"] = $this->arraytojson($this->_POST('yetkiler'));
            $this->dbConn->insert($this->table,$post,$id);
            $this->setPanelMessage("success", "Kullanıcı Eklendi.");

        endif;

        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'));
    }


    public function sil($id=null)
    {
        if ($id){
            echo $id."-".$this->user_id;
            //$date = date("Y-m-d H:i:s");
            //$this->dbConn->update($this->table, array("sil"=>1, "silme_tarihi"=>$date), array("id"=>$id));
            //$this->dbConn->langUpdate($this->tablelang, array("sil"=>1, "silme_tarihi"=>$date), array("master_id"=>$id));
        }
        //$this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'));
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