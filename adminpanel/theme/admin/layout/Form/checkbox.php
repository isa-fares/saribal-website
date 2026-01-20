<?
    $rand = rand(1111,9999);
?>
<div class="form-group form-md-line-input">
    <label style="font-size:14px;"><?=((isset($help) ? $help :''))?></label>

    <div class="controls">

        <input
                type="checkbox"
                id="<?=(isset($id) ? $id : "check_".$rand).((isset($lang)) ? '_'.$lang:'')?>"
                class="filled-in <?=((isset($class) ? $class :''))?>"
                value="1" <?=((isset($checked) && $checked == "checked") ? "checked" : "")?> <?=((isset($value) and $value == 1) ? 'checked':'')?>
                name="<?=((isset($name) ? $name :'')).((isset($lang) and $lang) ? '_'.$lang:'')?>"/>

        <label for="<?=(isset($id) ? $id : "check_".$rand)?>"><?=(isset($title) ? $title:null)?> <?=(isset($required)) ? '<span class="text-danger">*</span>':null?></label>

    </div>

</div>

