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
            <input type="hidden" name="icon" value="<?=$data["icon"]?>">
            <input type="hidden" class="modul_anasayfa_<?=$data["id"]?>" name="anasayfa" value="<?=$data["anasayfa"]?>">
            <div class="box-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group row mb-1">


                            <label class="col-sm-2" style="font-size: 14px; line-height: 36px;">
                                Anasayfada Göster
                            </label>


                            <div class="input-group col-sm-10">
                                <button type="button" data-modul="<?=$data["id"]?>" class="home_switch btn btn-lg btn-toggle <?=($data["anasayfa"] == 0) ? "" : "active"?>" data-toggle="button" aria-pressed="<?=($data["anasayfa"] == 0) ? "false" : "true"?>">
                                    <span class="handle"></span>
                                </button>

                            </div>

                            <div class="col-sm-12">
                                <div class="form-control-feedback" style="padding:8px 0 0; font-size:12px;">
                                    <i class="fa fa-info-circle"></i> Websitenizin anasayfasında bulunan Pratik Bilgiler bölümünü kapatıp açabilirsiniz.</div>
                            </div>



                        </div>
                        <hr class="my-15">
                    </div>

                    <div class="col-md-4">
                        <?=$form->input(array('value'=>((isset($data['big']) ? $this->temizle($data['big']) :'')),'title'=>'Resim Boyutu', 'name'=>'big'));?>
                    </div>

                    <div class="col-md-4">
                        <?=$form->input(array('value'=>((isset($data['thumb']) ? $this->temizle($data['thumb']) :'')),'title'=>'Küçük Resim Boyutu', 'name'=>'thumb'));?>
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
            'anasayfa'=>$this->kirlet($this->_POST("anasayfa"))
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

        endif;
        $this->setPanelMessage("success","Ayarlar Başarıyla Güncellendi");
        $this->RedirectURL($this->BaseAdminURL($modul.'/settings'));


    }
?>
