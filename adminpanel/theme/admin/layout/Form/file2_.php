<?php
$image_file = ((isset($src)) ? ((self::isJSON($src)) ? json_decode($src,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES): array('crop'=>false,'image'=>$src)):array());

$file_allow = $this->settings->file('allow_image_type');
$filea  = ' ';
if(is_array($file_allow))
    foreach ($file_allow as $file)  $filea .= str_replace('image/','',$file).', ';


?>

<div class="box">
    <div class="box-header with-border">
        <h5 style="margin-bottom: 0px;"><?=(isset($title) ? $title:null)?></h5>

    </div>
    <div class="box-content">
        <div class="box-body">
            <div class="form-group fileupload"  id="<?=(isset($name) ? $name:'').((isset($lang)) ? '_'.$lang:'')?>">

                <?=((isset($image_file['image']) and $image_file['image']) ?
                    '<img src="'.((isset($url)) ? $url:'')."/".((isset($image_file['image']) and $image_file['image']) ?
                        (($image_file['crop']=="true") ? 'crop_':'').$image_file['image']:'').'" class="img-prev" style=" display: block; margin:0 auto; margin-bottom:10px; border:1px solid #efefef;  max-height: 275px;">':
                    '<img src="" class="img-prev" style="display:none;  margin:0 auto; margin-bottom:10px;  border:1px solid #efefef; max-height: 275px;">' )?>
                <div id="<?=(isset($image_file['image']) ? $image_file['image']:'')?>" class="files d-none"><?=(isset($image_file['image']) ? $image_file['image']:'')?></div>
                <div class="row">
                    <div class="col-md-6">
                    <span class="btn btn-block btn-lg btn-info fileinput-button ">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Yükle..</span>
                            <input type="file"
                                   name="files"
                                   id="<?=(isset($name) ? $name:'').((isset($lang)) ? '_'.$lang:'')?>"
                                   <?=((isset($require)) ? 'required':null)?> >

                            <input type="hidden"
                                   id="<?=(isset($name) ? $name:null).((isset($lang)) ? '_'.$lang:'')?>"
                                   class="image_val"
                                   name="<?=(isset($name) ? $name:null).((isset($lang)) ? '_'.$lang:'')?>"
                                   value="<?=(isset($image_file['image']) ? $image_file['image']:'')?>">

                            <input type="hidden"
                                   id="<?=(isset($name) ? $name:null).((isset($lang)) ? '_'.$lang:'')?>"
                                   class="crop"
                                   name="crop_<?=(isset($name) ? $name:null).((isset($lang)) ? '_'.$lang:'')?>"
                                   value="<?=((isset($image_file['crop']) and $image_file['crop']=="true") ? 'true':'false')?>">

                            <input type="hidden"
                                   id="fotoResim_folder"
                                   class="image_folder"
                                   name="<?=(isset($name) ? $name:null).((isset($lang)) ? '_'.$lang:'')?>_folder"
                                   value="<?=((isset($folder)) ? $folder:null)?>">
                      </span>
                    </div>

                    <?
                    if (!isset($crop)){
                        ?>
                        <div class="col-md-6">
                        <span class="btn  btn-block btn-lg btn-success crop_file" data-id="<?=((isset($resimBoyut))? $resimBoyut:0)?>">
                            <i class="glyphicon glyphicon-resize-small "></i>
                            <span>Resmi Kırp... </span>
                           </span>
                        </div>
                    <? } ?>

                </div>

                <div id="progress" class="progress mt-15">
                    <div class="progress-bar progress-bar-green"></div>
                </div>
                <span class="help-block">
                <table class="table" style="margin-bottom: 0px; margin-top: 15px;">
                    <tbody>
                        <tr>
                            <td style=" padding:8px;">Önerilen Resim Boyutu</td>
                            <th style="font-weight: 600; padding:8px;"><?=$resimBoyut?></th>
                        </tr>
                        <tr>
                            <td style="padding:8px;">İzin Verilen Resim Türleri</td>
                            <th style="font-weight: 600;  padding:8px;"><?=strtoupper($filea)?></th>
                        </tr>
                    </tbody>
                </table>
            </span>
            </div>
        </div>
    </div>
</div>
