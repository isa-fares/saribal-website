<?php


namespace AdminPanel;


class Kurskategori  extends Settings{


    public  $modulName = 'kurskategori';

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
        ));

        $this->SayfaBaslik = 'Kurs Kategorileri';

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;

        return $pagelist->PageList(array(
            'id'=>$id,
            'page'=>$this->table,
            "place"=>"kategori başlığı",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            'button' => array(array('title'=>'Kategori Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('class'=>'sort text-center','tabindex'=>0,'dataTitle'=>'id'),
                array('dataTitle'=>'baslik', 'class'=>'sort'),
                //array('dataTitle'=>'tarih', 'class'=>'sort', "align"=>"center","type"=>"date", "labelClass"=>"btn btn-light")
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
                array('title'=>'ID','width'=>'2%', "align"=>"center"),
                array('title'=>'Başlık','width'=>'20%'),
                //array('title'=>'Tarih','width'=>'20%'),
                //array('title'=>'Resim','width'=>'5%', "align"=>"center"),
                array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )

        ));



    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Kategori '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(8);

        if($id) $data = $tabs->tabData($this->table,$id);

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text']  = $form->input(array("required"=>array("tr"),'value'=>((isset($data[$dil]['baslik']) ? $this->temizle($data[$dil]['baslik']) :'')),'title'=>'Başlık','lang'=>$dil,'name'=>'baslik'));
            //$tabForm[$dil]['text'] .= $form->textarea(array('value'=>((isset($data[$dil]['ozet']) ? $this->temizle($data[$dil]['ozet']) :'')),'title'=>'Özet','name'=>'ozet','lang'=>$dil,));
            //$tabForm[$dil]['text'] .= $form->textEditor(array('value'=>((isset($data[$dil]['detay']) ? $this->temizle($data[$dil]['detay']) :'')),'title'=>'Detay','name'=>'detay','lang'=>$dil,'height' => '250'));
        endforeach;

        $text .= $tabs->tabContent($tabForm);
        $text.= $form->closeDiv();

        $text.=$form->openColumn(4);
        $text.= $form->file(array('url'=>$this->BaseURL('upload')."/".$this->modulName,'folder'=>$this->modulName,'title'=>'Kategori Resmi','name'=>'resim','resimBoyut'=>$this->settings->boyut($this->modulName),'src'=>((isset($data['tr']['resim'])) ? $data['tr']['resim'] :'')));

        $text.=$form->openBox().$form->openBoxBody();
        //$text .= $form->date(array("format"=>"DD.MM.YYYY","required"=>"true", 'value'=>((isset($data["tr"]['tarih']) ? date("d.m.Y",strtotime($data["tr"]['tarih'])) : date('d.m.Y'))),'title'=>'Tarih','name'=>'tarih'));
        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));
        $text.= $form->closeDiv();

        $text .= $form->submitButton(array("color"=>"btn-success btn-block btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
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
                    //'ozet'=>$this->kirlet($this->_POST('ozet',$dil)),
                    //'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'resim' => $this->_RESIM_BASE64('resim', $this->modulName),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    //'tarih'=>date('Y-m-d', strtotime($this->_POST("tarih"))),
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    //'ozet'=>$this->kirlet($this->_POST('ozet',$dil)),
                    //'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    //'tarih'=>date('Y-m-d', strtotime($this->_POST("tarih"))),
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