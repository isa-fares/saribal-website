<?php


namespace AdminPanel;


class Rakam  extends Settings{


    public  $modulName = 'rakam';
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
            "search"=>array("baslik", "rakam"),
        ));

        $this->SayfaBaslik = 'Rakamlarla Biz';

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;

        return $pagelist->PageList(array(
            'id'=>$id,
            'page'=>$this->table,
            //"resim"=>true,
            "place"=>"başlık, rakam",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            //'button' => array(array('title'=>'Rakam Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('class'=>'sort text-center','tabindex'=>0,'dataTitle'=>'id'),
                array('dataTitle'=>'rakam', 'class'=>'sort'),
                array('dataTitle'=>'baslik', 'class'=>'sort'),
            ),
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                               //array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'ID','width'=>'2%', "align"=>"center"),
                array('title'=>'Rakam','width'=>'10%'),
                array('title'=>'Başlık','width'=>'20%'),
                array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )

        ));



    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Rakam '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(6);

        if($id) $data = $tabs->tabData($this->table,$id);

        foreach ($this->settings->lang('lang') as $dil=>$title):

            $tabForm[$dil]['text']  = $form->input(array("required"=>array("tr"), 'value'=>((isset($data[$dil]['rakam']) ? $this->temizle($data[$dil]['rakam']) :'')),'title'=>'Rakam','lang'=>$dil,'name'=>'rakam'));

            //$tabForm[$dil]['text']  .= $form->input(array("required"=>array("tr"), 'value'=>((isset($data[$dil]['birim']) ? $this->temizle($data[$dil]['birim']) :'')),'title'=>'Birim','lang'=>$dil,'name'=>'birim',"help"=>"Örneğin: Kg."));

            $tabForm[$dil]['text']  .= $form->input(array("required"=>array("tr"),'value'=>((isset($data[$dil]['baslik']) ? $this->temizle($data[$dil]['baslik']) :'')),'title'=>'Başlık','lang'=>$dil,'name'=>'baslik', "help"=>"Yeni Satır İçin \\ Kullanın. Örn:(Satır1\Satır2)"));

        endforeach;

        $text .= $tabs->tabContent($tabForm);

        $text.=$form->openBox().$form->openBoxBody();
        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));
        $text.= $form->closeDiv();

        $text .= $form->submitButton(array("color"=>"btn-success  btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeDiv();

        $text.= $form->closeDiv();
        $text.= $form->openColumn(4);
        $text.= $form->file2(array('url'=>$this->BaseURL('upload')."/".$this->modulName,'folder'=>$this->modulName,'title'=>'Icon','name'=>'resim','resimBoyut'=>'100x100','src'=>((isset($data['tr']['resim'])) ? $data['tr']['resim'] :'')));
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
                    'rakam'=> $this->kirlet($this->_POST('rakam',$dil)),
                    'birim'=> $this->kirlet($this->_POST('birim',$dil)),
                    //'ozet'=> $this->kirlet($this->_POST('ozet',$dil)),
                    'link'=> $this->kirlet($this->_POST('link',$dil)),
                    'resim' => $this->_RESIM_BASE64('resim', $this->modulName),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'rakam'=> $this->kirlet($this->_POST('rakam',$dil)),
                    'birim'=> $this->kirlet($this->_POST('birim',$dil)),
                    'ozet'=> $this->kirlet($this->_POST('ozet',$dil)),
                    'link'=> $this->kirlet($this->_POST('link',$dil)),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
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
        $lang_duzenle = $this->dbConn->langUpdate($this->tablelang,array('aktif'=>$durum),$id);

        if($tr_duzenle && $lang_duzenle) echo 1; else echo 0;

        exit();
    }





}