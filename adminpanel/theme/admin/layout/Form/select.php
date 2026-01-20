<?
$langCount =  count($this->settings->lang('lang'));
?>

<div class="form-group ">
    <label style="font-size: 14px;" for="<?=((isset($id) ? $id :'')).((isset($lang)) ? '_'.$lang:'')?>">
        <?=(isset($title)) ? $title : ""?> <?=(isset($lang) && $langCount > 1) ? "<small>[".$this->langSelect($lang)."]</small>" : ""?>
        <?=(isset($required)) ? '<span class="text-danger">*</span>':null?>
    </label>
    <div class="controls">
        <select class="form-control  select2 <?=(isset($class) ? $class : "")?>"
                data-url="<?=(isset($url) ? $url : "")?>"
                name="<?=((isset($name) ? $name :'')).((isset($lang)) ? '_'.$lang:'')?>"

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

                echo ' data-validation-required-message="Bir Seçenek Seçiniz."';
            }
            ?>
        >
            <option value="" >Lütfen Seçiniz</option>
            <?=(isset($data) ? $data:null)?>
        </select>
        <div class="help-block" style="width: 100% !important;"></div>
    </div>

</div>