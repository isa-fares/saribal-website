<?php


namespace AdminPanel;


class Yorum  extends Settings{


    public  $modulName = 'yorum';
    private $table;
    private $tablelang;



    public function __construct($settings)
    {
        parent::__construct($settings);
        $this->AuthCheck();
        $this->table = $this->modulName;
        $this->tablelang = $this->modulName."_lang";
        $this->dbConn->update($this->table, array("goruldu"=>1));
    }


    public function index($id)
    {
        return $this->liste($id);
    }

    public function liste($id=null)
    {


        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->table,
            "search"=>array("baslik", "ozet"),
            "order"=>"ORDER BY aktif ASC, id DESC",
            "kosul"=>(isset($id)) ? "kurs = ".$id : "",
            "sqlEk"=>"(SELECT baslik FROM kurslar WHERE kurslar.id = ".$this->table.".kurs) as kat_baslik"
        ));

        $this->SayfaBaslik = 'Yorumlar';

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;

        $html =  $pagelist->PageList(array(
            'id'=>$id,
            'page'=>$this->table,
            "place"=>"ad soyad, yorum",
            'flitpage' => array("url"=>$filterURL,"title"=>"Kurs Seçiniz",'sql'=>"select * from kurslar ",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"kursFilter", "class"=>"flit_filter"),
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            'disableSortable'=>true,
            'p'=>array(
                array('class'=>'sort text-center','tabindex'=>0,'dataTitle'=>'id'),
                array('dataTitle'=>'baslik', 'class'=>'sort'),
                array('dataTitle'=>'kat_baslik', 'class'=>'sort'),
            ),

            'tools' =>array(
                array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),

            'buton'=> array(
                array("disable_delete"=>true,'type'=>'modalButton', 'align'=>"center", 'title'=>'İncele','class'=>'btn bg-olive yorumModal',"data-icon"=>"mdi mdi-eye"),
            ),

            'pdata' => $this->dbConn->sorgu($sql),

            'baslik'=>array(
                array('title'=>'ID','width'=>'2%', "align"=>"center"),
                array('title'=>'Adı Soyadı','width'=>'20%'),
                array('title'=>'Kurs','width'=>'20%'),
                array('title'=>'Yorumu','width'=>'4%', "align"=>"center"),
            )

        ));

        $modal = new Widget($this->settings);
        $html .=  $modal->yorum($this->dbConn->sorgu('select * from bulten WHERE '.$this->silColumn.' <> 1 and aktif = 1 order by id desc'),'yorumModal');

        return $html;

    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Yorum '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(12);

        if($id) $data = $tabs->tabData($this->table,$id);

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text']  = $form->input(array("required"=>array("tr"),'value'=>((isset($data[$dil]['baslik']) ? $this->temizle($data[$dil]['baslik']) :'')),'title'=>'Adı Soyadı','lang'=>$dil,'name'=>'baslik'));
            $tabForm[$dil]['text'] .= $form->textarea(array('value'=>((isset($data[$dil]['ozet']) ? $this->temizle($data[$dil]['ozet']) :'')),'title'=>'Yorumu','name'=>'ozet','lang'=>$dil,));
        endforeach;

        $text .= $tabs->tabContent($tabForm);
        $text.=$form->openBox().$form->openBoxBody();
        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));
        $text.= $form->closeDiv();
        $text .= $form->submitButton(array("color"=>"btn-success  btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
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
                    'ozet'=> $this->kirlet($this->_POST('ozet',$dil)),
                    'resim' => $this->_RESIM_BASE64('resim', $this->modulName),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'ozet'=> $this->kirlet($this->_POST('ozet',$dil)),
                    'aktif'=> ($this->_POST('aktf')) ? $this->_POST('aktif'):0,
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