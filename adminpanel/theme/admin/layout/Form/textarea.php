<?
$langCount =  count($this->settings->lang('lang'));
?>
<div class="form-group">

    <label style="font-size: 14px;" for="<?=((isset($id) ? $id :'')).((isset($lang)) ? '_'.$lang:'')?>">
        <?=(isset($title)) ? $title : ""?> <?=(isset($lang) && $langCount > 1) ? "<small>[".$this->langSelect($lang)."]</small>" : ""?>

        <?
            if (isset($required)) {
                if (is_array($required)) {
                    if (in_array($lang, $required)) {
                        echo '<span class="text-danger">*</span>';
                    }
                }
                else {
                    echo '<span class="text-danger">*</span>';
                }
            }
        ?>
    </label>



    <div class="controls">
        <div class="input-group">

            <?
            if (isset($icon) && $icon != "") {
                ?>
                <div class="input-group-addon">
                    <i class="<?=$icon?>"></i>
                </div>
                <?
            }
            ?>
        <textarea id="<?=((isset($id) ? $id :'')).((isset($lang)) ? '_'.$lang:'')?>"
           style="height:<?=((isset($height) ? $height :'90')).'px'?>; margin:0px;"
           class="form-control <?=((isset($class) ? $class :''))?>"
            <?
            if (isset($required)){
                if (is_array($required)){
                    if (in_array($lang, $required)){
                        echo " required";
                    }
                }
                else {
                    echo " required";
                }

                if (isset($min)){
                    echo ' minlength="'.$min.'"';
                }
                if (isset($max)){
                    echo ' maxlength="'.$max.'"';
                }

                echo ' data-validation-required-message="Bu Alanın Doldurulması Zorunludur"';
            }

            if (isset($min)){
                echo ' minlength="'.$min.'"';
            }
            if (isset($max)){
                echo ' maxlength="'.$max.'"';
            }
            ?>
           name="<?=((isset($name) ? $name :'')).((isset($lang)) ? '_'.$lang:'')?>"><?=((isset($value) ? $value :''))?></textarea>
            <div class="help-block" style="width: 100%"></div>

        <?
        if (isset($help)) {
            ?>
            <div class="form-control-feedback" style="width: 100%;">
                <div class="form-control-feedback" style="padding:8px 0 0; font-size:12px;">
                    <i class="fa fa-info-circle"></i> <?=$help?>
                </div>
            </div>
            <?
        }
        ?>
        </div>

    </div>
</div>
