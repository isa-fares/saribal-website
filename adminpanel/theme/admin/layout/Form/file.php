<?php

$langCount = count($this->settings->lang('lang'));

$file_allow = $this->settings->file('allow_image_type');
$filea  = ' ';
$get = @$_GET["cmd"];
$ex = explode('.', $get);
$ex = explode('/', $ex[0]);
$id = $ex[2];

if (is_array($file_allow))
    foreach ($file_allow as $file)  $filea .= str_replace('image/', '', $file) . ', ';
?>
<?php /*
<div class="box">
    <div class="box-header with-border">
        <h5 style="margin-bottom: 0px;"><?=(isset($title) ? $title:null)?></h5>
    </div>
    <div class="box-content">
        <div class="box-body">
            <div class="form-group fileupload"  id="<?=(isset($name) ? $name:'').((isset($lang)) ? '_'.$lang:'')?>">

                    <?=((isset($image_file['image']) and $image_file['image']) ?
                        '<img src="'.((isset($url)) ? $url:'')."/".((isset($image_file['image']) and $image_file['image']) ?
                            (($image_file['crop']=="true") ? 'crop_':'').$image_file['image']:'').'" class="img-prev uploaded-image">':
                        '<img src="" class="img-prev uploaded-image" style="    display: none;">' )?>
                <div id="<?=(isset($image_file['name']) ? $image_file['name']:'')?>" class="files col-md-6" style="display: none;"><?=(isset($image_file['image']) ? $image_file['image']:'')?></div>
                <div class="row">
                    <div class="col-sm-6">
                        <span class="btn btn-block btn-success fileinput-button ">
        <i class="mdi mdi-image-multiple"></i>
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

                        <a class="btn btn-success" data-target="#fileModal" data-toggle="modal">Modal AÇ</a>
                    </div>

                    <div class="col-sm-6">
                        <?
                        if (!isset($crop)){
                            ?>
                            <span class="btn btn-block btn-warning crop_file" data-id="<?=((isset($resimBoyut))? $resimBoyut:0)?>">
                                <i class="mdi mdi-image-filter-center-focus "></i>
                                <span>Resmi Kırp... </span>
                            </span>

                        <? } ?>

                    </div>
                </div>

<br>
                <?
                    if (isset($resimBoyut)) {
                ?>

                    <span class="help-block">
                        <table class="table" style="margin-bottom: 0px;">

                            <tbody>
                                <tr>
                                    <td style=" padding:5px;">Önerilen Resim Boyutu</td>
                                    <th style="font-weight: 600; padding:5px;"><?=$resimBoyut?></th>
                                </tr>
                                <tr>
                                     <td style=" padding:5px;">İzin Verilen Resim Türleri</td>
                                    <th style="font-weight: 600;  padding:5px;"><?=strtoupper($filea)?></th>
                                </tr>
                            </tbody>
                        </table>
                    </span>

                <?
                    }
                ?>



            </div>
        </div>
    </div>

</div>
*/ ?>

<div class=" <?= (isset($lang) && $langCount > 1) ? "" : "box" ?>">
    <div class="box-header with-border">
        <h5 style="margin-bottom: 0px;"><?= (isset($title) ? $title : null) ?> <?= (isset($lang) && $langCount > 1) ? "[" . $this->langSelect($lang) . "]" : "" ?></h5>
        <?
        if (isset($resimBoyut) && !empty($resimBoyut)) {
            list($genislik, $yukseklik) = explode("x", $resimBoyut);
            if ($genislik > 1400) {
                $oran = 4;
            } elseif ($genislik < 500) {
                $oran = 2;
            } else {
                $oran = 3;
            }
            $pGenislik = floor($genislik / $oran);
            $pYukseklik = floor($yukseklik / $oran);
        } else {
            $genislik = 600;
            $yukseklik = 400;
            $pGenislik = 200;
            $pYukseklik = 133;
        }
        ?>


    </div>
    <div class="box-content">
        <div class="box-body">
            <?php
            if (isset($resimBoyut) && !empty($resimBoyut)) {
                $cropper = new \AdminPanel\AppCropper();
                $cropper->name = $name . ((isset($lang)) ? "_$lang" : "");
                $cropper->uniqueId = $name . ((isset($lang)) ? "_$lang" : "");


                if (isset($src) && !empty($src)) $cropper->imageUrl = "$url/$src";
                $cropper->cropperOptions = [
                    'uniqueId' => 'image',
                    'width' => $genislik,
                    'height' => $yukseklik,
                    'preview' => [
                        'url' => (isset($src)) ? $src : null,
                        'path' => $url . "/",
                        'width' => $pGenislik . "px",
                        'height' => $pYukseklik . "px",
                    ],
                    'buttonCssClass' => "btn " . ((isset($buttonCssClass)) ? $buttonCssClass : ' btn-primary btn-block btn-lg'),
                ];
                $cropper->assetUrl = $this->themeFile() . '/assets/';
                echo $cropper->run();
            }
            ?>

            <span class="help-block">
                <table class="table" style="margin-bottom: 0px; margin-top: 15px;">
                    <tbody>
                        <?php if (isset($resimBoyut) && !empty($resimBoyut)): ?>
                        <tr>
                            <td style=" padding:5px;">Önerilen Resim Boyutu</td>
                            <th style="font-weight: 600; padding:5px;"><?= $resimBoyut ?></th>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td style=" padding:5px;">İzin Verilen Resim Türleri</td>
                            <th style="font-weight: 600;  padding:5px;"><?= strtoupper($filea) ?></th>
                        </tr>
                        <?
                        if (!empty($src)) {
                            if (!isset($deleteButton)) {
                                if ($folder != "slayt") {
                        ?>
                                    <tr>
                                        <td style=" padding:5px;" colspan="2"><a class="remove-image-btn btn btn-danger" href="#" data-column="<?= $name ?>" <?= ((isset($lang)) ? 'data-lang="' . $lang . '"' : '') ?> data-table="<?= (isset($table) ? $table : $folder) ?>" data-id="<?= $id ?>"><i class="fa fa-times-circle"></i> Resmi Sil</a> </td>
                                    </tr>
                        <? }
                            }
                        } ?>
                    </tbody>
                </table>
            </span>

        </div>
    </div>
</div>