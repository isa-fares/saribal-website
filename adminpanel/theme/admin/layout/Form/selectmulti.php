
<div class="form-group ">
    <label class="d-flex justify-content-between" style="font-size: 14px;" for="<?=((isset($id) ? $id :'')).((isset($lang)) ? '_'.$lang:'')?>">
        <span>
            <?=(isset($title)) ? $title : ""?> <?=(isset($lang)) ? "<small>[".$this->langSelect($lang)."]</small>" : ""?>
            <?=(isset($required)) ? '<span class="text-danger">*</span>':null?>
        </span>

        <? if (isset($selectAll) && $selectAll):?>
            <div class="controls">
                <? $rand = rand(1111,9999);?>
                <input type="checkbox" id="check_<?=$rand?>" class="select_all_button filled-in" data-selectname="<?=((isset($name) ? $name :'')).((isset($lang)) ? '_'.$lang:'')?>">
                <label for="check_<?=$rand?>" style="padding-left: 30px">Tümünü Seç </label>
            </div>
        <? endif; ?>

    </label>
    <div class="controls">
        <select class="form-control  select2 <?=(isset($class) ? $class : "")?>"
                data-url="<?=(isset($url) ? $url : "")?>"
                name="<?=((isset($name) ? $name :'')).((isset($lang)) ? '_'.$lang:'')?>[]"
                id="<?=((isset($name))? $name:null).((isset($lang)) ? '_'.$lang:'')?>"
                multiple
            <?=(isset($required)) ? 'required'." data-validation-required-message=\"En Az Bir Seçenek Seçiniz.\" ":null?>
        >
            <?=(isset($data) ? $data:null)?>
        </select>
        <div class="help-block" style="width: 100% !important;"></div>
    </div>



</div>

