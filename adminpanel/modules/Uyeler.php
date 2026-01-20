<?php
/**
 * Copyright Ve Interaktif Medya 2019
 *
 * @var $this FrontClass|Loader
 *
 */

namespace AdminPanel;


class Uyeler  extends Settings{


    public  $modulName = 'uyeler';

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
            "kosul"=>(isset($id)) ? "kid = ".$id : "",
            "order"=>"ORDER BY goruldu asc, id DESC",
            "search"=>array("adi", "unvan", "email"),
        ));

        $this->SayfaBaslik = 'Üye Listesi';

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;

        $text =  $pagelist->PageList(array(
            //'flitpage' => array("url"=>$filterURL,"title"=>"Sayfa Kategorisi Seçiniz",'sql'=>"select * from sayfakategori ",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"sayfaFilter", "class"=>"flit_filter"),
            'id'=>$id,
            'page'=>$this->table,
            "place"=>"ad soyad, firma adı, email",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "disableSortable"=>true,
            "search"=>true,
            //'button' => array(array('title'=>'Sayfa Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('class'=>'sort text-center position-relative','tabindex'=>0,'dataTitle'=>'id', "new"=>array("text"=>"Yeni", "badgeClass"=>"badge-danger", "kosul"=>"0", "sutun"=>"goruldu")),
                array('dataTitle'=>'adi', 'class'=>'sort'),
                array('dataTitle'=>'email', 'class'=>'sort', "align"=>"center"),
                array('dataTitle'=>'telefon', 'class'=>'sort', "align"=>"center"),
                array('dataTitle'=>'tur', 'class'=>'sort text-center', "align"=>"center", "type"=>"user_type"),
            ),
            'tools' =>array(   array('title'=>'Satışlar','icon'=>'mdi mdi-currency-try','url'=>$this->BaseAdminURL('Siparis&filter=true&kurs_id=&islem=0&user_id='),'color'=>'btn-primary'),
                               array('title'=>'Önizleme', 'disable_id'=>true, 'icon'=>'ti-eye','url'=>'#modalInfo','color'=>'btn-info infoModal'),
            ),

            'buton'=> array(
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'ID','width'=>'2%', "align"=>"center"),
                array('title'=>'Adı Soyadı','width'=>'10%'),
                array('title'=>'Email Adresi','width'=>'10%'),
                array('title'=>'Telefon','width'=>'10%'),
                array('title'=>'Üyelik Türü','width'=>'10%', "align"=>"center"),
                array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )
        ));
        $this->dbConn->update($this->table,array("goruldu"=>1));
        $modal = new Widget($this->settings);
        $text .=  $modal->userModal(array(),"infoModal","Üye Bilgileri");
        return $text;



    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Kullanıcı '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $form = new Form($this->settings);

        $data = $this->dbConn->tekSorgu("SELECT * FROM uyeler WHERE id = $id");

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(12);
        $text.=$form->openBox();
        $text.='<div class="box-header with-border"><h5 style="margin-bottom: 0px;">Kullanıcı Bilgileri</div>';
        $text.=$form->openBoxBody();

        if ($data["tur"] == "2"){
            $text.=$form->input(array("inline"=>true,"icon"=>"mdi mdi-account-star", 'value'=>((isset($data['unvan']) ? $this->temizle($data['unvan']) :'')),'title'=>'Firma Adı','name'=>'unvan'));
            $text.=$form->input(array("inline"=>true,"icon"=>"mdi mdi-briefcase", 'value'=>((isset($data['vergi_dairesi']) ? $this->temizle($data['vergi_dairesi']) :'')),'title'=>'Vergi Dairesi','name'=>'vergi_dairesi'));
            $text.=$form->input(array("inline"=>true,"icon"=>"mdi mdi-decimal-increase", 'value'=>((isset($data['vergi_no']) ? $this->temizle($data['vergi_no']) :'')),'title'=>'Vergi No','name'=>'vergi_no'));
            $text.=$form->input(array("inline"=>true,"icon"=>"mdi mdi-account-check", 'value'=>((isset($data['adi']) ? $this->temizle($data['adi']) :'')),'title'=>'Yetkili','name'=>'adi'));
        }
        else {
            $text.=$form->input(array("inline"=>true,"icon"=>"mdi mdi-account-check", 'value'=>((isset($data['adi']) ? $this->temizle($data['adi']) :'')),'title'=>'Adı Soyadı','name'=>'adi'));
        }

        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));
        $text.= $form->closeDiv();
        $text .= $form->submitButton(array("color"=>"btn-success btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
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
                    'ozet'=>$this->kirlet($this->_POST('ozet',$dil)),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'resim' => $this->_RESIM_BASE64('SayfaResim', $this->modulName),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'kid'=>($this->_POST('kid')) ? $this->_POST('kid'):0,
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'ozet'=>$this->kirlet($this->_POST('ozet',$dil)),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'kid'=>($this->_POST('kid')) ? $this->_POST('kid'):0,
                    'dil' => $dil
                );
            endif;



        endforeach;




        if(isset($id) and $id):
            //Güncelle

            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["duzenleme_tarihi"] = date("Y-m-d H:i:s");
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
        $lang_duzenle = true;

        if($tr_duzenle && $lang_duzenle) echo 1; else echo 0;
        exit();
    }




}