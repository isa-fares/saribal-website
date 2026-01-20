<?
$langCount =  count($this->settings->lang('lang'));
?>
<?
if (isset($col) && !empty($col)){
    echo "<div class='col-md-".$col."'>";
}
?>
    <div class="form-group">


        <label style="font-size: 14px;" for="<?=((isset($id) ? $id :'')).((isset($lang)) ? '_'.$lang:'')?>">
            <?=(isset($title)) ? $title : ""?> <?=(isset($lang) && $langCount > 1) ? "<small>[".$this->langSelect($lang)."]</small>" : ""?>
            <?
                if (isset($required)) {
                   echo '<span class="text-danger">*</span>';
                }
            ?>

        </label>




            <?
                if (isset($icon) && $icon != "") {
            ?>
                 <div class="input-group">
                    <div class="input-group-addon">
                        <i class="<?=$icon?>"></i>
                    </div>
            <?
                }
            ?>


                <input
            type="<?=((isset($type) ? $type :'text'))?>"
            name="<?=((isset($name) ? $name :'')).((isset($lang) and $lang) ? '_'.$lang:'')?>"
            id="<?=((isset($id) ? $id :'')).((isset($lang)) ? '_'.$lang:'')?>"
            class="form-control date-picker <?=isset($lang) ? $lang : ''?><?=((isset($class) ? $class :''))?>"
            <?=isset($required) ? "required data-validation-required-message=\"Tarih Seçiniz\"" : ""?>
            data-show-close="true" data-show-clear="true"
            data-format="<?=(isset($format)) ? $format : "DD.MM.YYYY H:mm" ?>"




            value="<?=(isset($value)) ? $value : ""?>">
                     <div class="help-block" style="width: 100%;"></div>


        <?
                if (isset($icon) && $icon != "") {
        ?>
                 </div>
    <?
    }
      ?>

        <?
        if (isset($help) && $help != "") {
            ?>
            <div class="form-control-feedback" style="padding:8px 0 0; font-size:11px;">
                <i class="fa fa-info-circle"></i> <?=$help?>
            </div>
            <?
        }
        ?>
</div>

<?
if (isset($col) && !empty($col)){
    echo "</div>";
}
?>


