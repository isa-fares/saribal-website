<?php


namespace AdminPanel;


class Bulten  extends Settings{


    public  $modulName = 'bulten';
    private $table;
    private $tablelang;
    public  $tablist;
    public $tablemail = 'emaillist';



    public function __construct($settings)
    {
        parent::__construct($settings);
        $this->AuthCheck();
        $this->table = $this->modulName;
        $this->tablist = array(
            array("title" => "Bülten Listesi", "href" => "liste", "icon" => "mdi mdi-view-sequential"),
            array("title" => "Email Listesi", "href" => "email", "icon" => "mdi mdi-envelope"),
            //array("title" => "Haberler Modül Ayarları", "href" => "settings", "icon" => "mdi mdi-settings")
        );
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
            //"order"=>"ORDER BY eklenme_tarihi DESC"
        ));

        $this->SayfaBaslik = $this->modul_info["baslik"];

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;


        $text = $pagelist->Tablist($this->tablist);

        $text .= $pagelist->PageList(array(
            'id'=>$id,
            'modul_id'=>$this->modul_info["id"],
            'modul_name'=>$this->modulName,
            'page'=>$this->table,
            //"place"=>"kelime giriniz",
            "showing"=>$showing,
            //'resim'=>true,
            "toplamVeri"=>$toplamVeri,
            "disableSortable"=>true,
            //"search"=>true,
            'button' => array(
                array('title'=>'Bülten Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle'),"class"=>"btn btn-success"),
            ),
            'p'=>array(
                array('dataTitle'=>'baslik', 'class'=>'sort', 'type'=>'bulten_title'),
                array('dataTitle'=>'tarih', 'class'=>'sort', 'type'=>'date', "dateFormat"=>"d.m.Y", "labelClass"=>"label label-default"),
                array('dataTitle'=>'url', 'class'=>'sort', 'type'=>"bulten_url"),
            ),
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Ek Resimler','class'=>'btn bg-olive','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Resim/fotoekle/'), "data-icon"=>"ti-camera", "modul"=>$this->table),
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Dosya Yükle','class'=>'btn btn-dark','dataname'=>'dosyaekle','url'=>$this->BaseAdminURL('Dosyalar/ekle/'), "data-icon"=>"ti-file", "modul"=>$this->table),
                //array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'Başlık','width'=>'20%'),
                array('title'=>'Tarih','width'=>'10%'),
                array('title'=>'URL','width'=>'10%'),
                //array('title'=>'Ek Resimler','width'=>'5%', "align"=>"center"),
                //array('title'=>'Dosyalar','width'=>'5%', "align"=>"center"),
                //array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )
        ));

        return $text;

    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Bülten '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));

        $text .= $form->openColumn(8);

        if($id) $data = $this->dbConn->tekSorgu("SELECT * FROM $this->table WHERE id = $id");

        $lang_data = array();
        foreach ($this->settings->lang('lang') as $dil=>$title):
            array_push($lang_data, ["title"=>$title, "value"=>$dil]);
        endforeach;


        $text.=$form->openBox().$form->openBoxBody();

        $text.= $form->input(array("required"=>true,'value'=>((isset($data['baslik']) ? $this->temizle($data['baslik']) :'')),'title'=>'Bülten Başlığı', 'name'=>'baslik'));
        $text.= $form->radio(array("required"=>true, 'main_class'=>'lang_select_radios','class'=>'lang_select', 'title'=>'Bülten Dili','name'=>'dil', 'data'=>$lang_data, 'checked'=>((isset($data['dil'])) ? $data['dil'] : 'tr')));


        $text.='<div class="options_lang option_tr" style="'.((isset($data) && $data["dil"] == 'tr') ? "" : (($id) ? "display:none" : '')).'">';

            $text .= $form->select(array('title'=>'Haftanın Desteği', 'name'=>'haftanin_destegi_tr','data'=> $form->parent(array('sql'=>"select * from destek WHERE sil <> 1",'option'=>array('value'=>'id','title'=>'baslik'),'selected'=>((isset($data['haftanin_destegi'])) ? $data['haftanin_destegi'] :'')),0,0)));
            $text .= $form->selectmulti(array('title'=>'Diğer Destekler', 'name'=>'destekler_tr','data'=> $form->parent(array('sql'=>"select * from destek WHERE sil <> 1",'option'=>array('value'=>'id','title'=>'baslik'),'selected'=>((isset($data['destekler'])) ? $data['destekler'] : '')),0,0)));

        $text.='</div>';

        foreach ($this->settings->lang('lang') as $dil=>$title):
            if ($dil != 'tr'){
                $text.='<div class="options_lang option_'.$dil.'" style="'.((isset($data) && $data["dil"] == $dil) ? "" : "display:none;").'">';
                $text .= $form->select(array('title'=>'Haftanın Desteği', 'name'=>'haftanin_destegi_'.$dil,'data'=> $form->parent(array('sql'=>"select * from destek_lang WHERE dil = '".$dil."' and baslik <> '' and sil <> 1",'option'=>array('value'=>'master_id','title'=>'baslik'),'selected'=>((isset($data['haftanin_destegi'])) ? $data['haftanin_destegi'] :'')),0,0)));

                $text .= $form->selectmulti(array('title'=>'Diğer Destekler', 'name'=>'destekler_'.$dil,'data'=> $form->parent(array('sql'=>"select * from destek_lang WHERE dil = '".$dil."' and baslik <> '' and sil <> 1",'option'=>array('value'=>'master_id','title'=>'baslik'),'selected'=>((isset($data['destekler'])) ? $data['destekler'] :'0')),0,0)));
                $text.='</div>';
            }
        endforeach;

        $text .= $form->textEditor(array('value'=>((isset($data['detay']) ? $this->temizle($data['detay']) :'')),'title'=>'Detay','name'=>'detay','height' => '183'));
        $text .= $form->date(array("format"=>"DD.MM.YYYY","required"=>"true", 'value'=>((isset($data['tarih']) ? date("d.m.Y",strtotime($data['tarih'])) : date('d.m.Y'))),'title'=>'Tarih','name'=>'tarih'));

        $text.= $form->closeDiv();

        $text .= $form->submitButton(array("color"=>"btn-success  btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeDiv();

        $text.= $form->closeDiv();

        $text .= $form->formClose();


        return $text;
    }

    public function kaydet($id=null)
    {

        $lang = $this->_POST("dil");

        foreach ($this->settings->lang('lang') as $dil=>$title):

            if($dil == "tr"):
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik')),
                    'detay'=>$this->kirlet($this->_POST('detay')),
                    'tarih'=>date('Y-m-d', strtotime($this->_POST("tarih"))),
                    'dil' => $lang,
                    'haftanin_destegi'=>$this->_POST("haftanin_destegi_".$lang),
                    'destekler'=>$this->arraytojson($this->_POST("destekler_".$lang)),
                );
            else:
                $post[$dil] = array(

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

        endif;
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'.(($this->_POST('kid_tr')) ? "/".$this->_POST('kid_tr'):'')));
    }


    public function sil($id=null)
    {
        if ($id){
            $date = date("Y-m-d H:i:s");
            $this->dbConn->update($this->table, array("sil"=>1, "silme_tarihi"=>$date), array("id"=>$id));
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




    public function email($id=null)
    {


        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->tablemail,
            "search"=>array("email"),
        ));

        $this->SayfaBaslik = 'Email Listesi';

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;

        $html = $pagelist->Tablist($this->tablist);

        $html .= $pagelist->PageList(array(
            'id'=>$id,
            'page'=>$this->tablemail,
            'disableSortable'=>true,
            "place"=>"email adresi",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            'button' => array(
                array('title'=>'Email Ekle','href'=>$this->BaseAdminURL($this->modulName.'/emailekle'),"class"=>"btn btn-success"),
                array('title'=>'E-posta Listesini Al','href'=>'','class'=>'btn btn-danger mr-10','data'=>array('target'=>'#bultenmodal','toggle'=>'modal'),'icon'=>'fa fa-list')
            ),
            'p'=>array(
                array('class'=>'sort text-center','tabindex'=>0,'dataTitle'=>'id'),
                array('dataTitle'=>'email', 'class'=>'sort'),
            ),
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/emailekle/'),'color'=>'btn-primary'),
                array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/emailsil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/emaildurum/')),
            ),
            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'ID','width'=>'2%', "align"=>"center"),
                array('title'=>'Email Adresi','width'=>'20%'),
                array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )

        ));

        $modal = new Widget($this->settings);
        $html .=  $modal->bulten($this->dbConn->sorgu('select * from '.$this->tablemail.' WHERE '.$this->silColumn.' <> 1 and aktif = 1 order by id desc'),'bultenmodal');
        return $html;



    }



    public function emailekle($id=null)
    {
        $this->SayfaBaslik = 'Email '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/emailkaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>false,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(8);

        if ($id) $data = $this->dbConn->tekSorgu("SELECT * FROM $this->tablemail WHERE id = $id");
        $text.=$form->openBox().$form->openBoxBody();
        $text  .= $form->input(array("required"=>true,'value'=>((isset($data['email']) ? $this->temizle($data['email']) :'')),'title'=>'Email','name'=>'email'));

        $lang_data = array();
        foreach ($this->settings->lang('lang') as $dil=>$title):
            array_push($lang_data, ["title"=>$title, "value"=>$dil]);
        endforeach;

        $text.= $form->radio(array("required"=>true, 'main_class'=>'lang_select_radios','class'=>'lang_select', 'title'=>'Bülten Dili','name'=>'dil', 'data'=>$lang_data, 'checked'=>((isset($data)) ? $data['dil'] : '')));


        $text .= $form->checkbox(array('value'=>((isset($data['aktif'])) ? $this->temizle($data['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));
        $text.= $form->closeDiv();

        $text .= $form->submitButton(array("color"=>"btn-success btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeDiv();
        $text.= $form->closeDiv();
        $text .= $form->formClose();

        return $text;
    }

    public function emailkaydet($id=null)
    {

        $lang = $this->kirlet($this->_POST('dil'));

        foreach ($this->settings->lang('lang') as $dil=>$title):

            if($dil == "tr"):
                $post[$dil] = array(
                    'email'=> $this->kirlet($this->_POST('email')),
                    'dil'=> $lang,
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                );
            endif;

        endforeach;


        $kontrol = $this->dbConn->tekSorgu("SELECT * FROM  $this->tablemail WHERE dil = '".$lang."' and email = '".$this->_POST("email")."'");

        if (is_array($kontrol)){
            $this->setPanelMessage("error", "Bu Email Adresi Daha Önce Eklenmiştir");
            $this->RedirectURL($this->BaseAdminURL('bulten/emailekle'.(($id) ? "/".$id : "")));
            exit();
        }

        if(isset($id) and $id):
            //Güncelle

            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["duzenleme_tarihi"] = date("Y-m-d H:i:s");
            }

            $this->dbConn->update($this->tablemail,$post['tr'],$id);

        else:

            // kaydet
            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["eklenme_tarihi"] = date("Y-m-d H:i:s");
            }

            $post["tr"]["sira"] = $this->Order($this->tablemail);
            $this->dbConn->insert($this->tablemail,$post['tr'],$id);
            $lastid = $this->dbConn->lastid();


        endif;
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/email'));
    }



    public function emaildurum($id=null)
    {
        $durum = ((isset($_GET['durum'])) ? $_GET['durum'] : null);

        $id = ((isset($_GET['id'])) ? $_GET['id'] : null);

        $tr_duzenle = $this->dbConn->update($this->tablemail,array('aktif'=>$durum),$id);

        if($tr_duzenle) echo 1; else echo 0;

        exit();
    }



}