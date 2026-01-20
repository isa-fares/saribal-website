<?php
/*** MODUL AYARLARI ***/
/* @var $form $form object */
/* @var $data $data array */
?>
<?=$form->formOpen(array('method'=>'POST','action'=> "",'fileUpload'=>true,'id'=>'form_sample_3','class'=>'')); ?>
<div class="col-md-12">
        <div class="box">
            <input type="hidden" name="save" value="1">
            <input type="hidden" name="id" value="<?=$data["id"]?>">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?=$form->input(array('value'=>((isset($data['icon']) ? $this->temizle($data['icon']) :'')),"icon"=>$data["icon"],"id"=>"select_icon",'title'=>'Icon','name'=>'icon', "help"=>"<a   href='".$this->baseAdminURL("icons")."' class='text-danger font-size-14' target='_blank'>Icon Listesi</a>"));?>
                    </div>

                    <div class="col-md-4">
                        <?=$form->input(array('value'=>((isset($data['big']) ? $this->temizle($data['big']) :'')),'title'=>'Resim Boyutu', 'name'=>'big'));?>
                    </div>

                    <div class="col-md-4">
                        <?=$form->input(array('value'=>((isset($data['thumb']) ? $this->temizle($data['thumb']) :'')),'title'=>'Thumb Resim Boyutu', 'name'=>'thumb'));?>
                    </div>

                    <div class="col-md-4">
                        <?=$form->input(array('value'=>((isset($data['ek']) ? $this->temizle($data['ek']) :'')),'title'=>'Çoklu Resim Boyutu', 'name'=>'ek'));?>
                    </div>
                </div>

            </div>

            <?=$form->submitButton(array("color"=>"btn-success btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));?>

        </div>
</div>
<?=$form->formClose(); ?>

<?
    if (isset($_POST["save"])){


        $id = (isset($_POST["id"]) && !empty($_POST["id"])) ? $_POST["id"] : null;

        $post = array(
            'icon'=>$this->kirlet($this->_POST('icon')),
        );

        $post_boyut = array(
            "big"=>$this->kirlet($this->_POST('big')),
            "thumb"=>$this->kirlet($this->_POST('thumb')),
            "ek"=>$this->kirlet($this->_POST('ek'))
        );



        if(!empty($id)):
            //Güncelle

            $post["duzenleme_tarihi"] = date("Y-m-d H:i:s");

            $this->dbConn->update("moduller",$post,$id);
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
            $post["sira"] = $this->Order("moduller");
            $this->dbConn->insert("moduller",$post,$id);
            $lastid = $this->dbConn->lastid();
            $post_boyut["modul_id"] = $lastid;
            $this->dbConn->insert("boyutlar",$post_boyut);
        endif;

        $this->setPanelMessage("success","Ayarlar Başarıyla Güncellendi");
        $this->RedirectURL($this->BaseAdminURL($modul.'/settings'));

    }
?>
