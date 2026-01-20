<?
$langCount =  count($this->settings->lang('lang'));
?>
<?
if (isset($col) && !empty($col)){
    echo "<div class='col-md-".$col."'>";
}
?>
    <div class="form-group <?=(isset($inline)) ? "row" : ""?>">


        <label class="<?=(isset($inline)) ? "col-sm-2" : ""?>" style="font-size: 15px; <?=(isset($inline)) ? "margin-bottom:0px; line-height:36px;" : ""?>" for="<?=((isset($id) ? $id :'')).((isset($lang)) ? '_'.$lang:'')?>">
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



        <div class="input-group <?=(isset($inline)) ? "col-sm-10" : ""?>">

            <?
                if (isset($icon) && $icon != "") {
            ?>
                    <div class="input-group-addon">
                        <i class="<?=$icon?>"></i>
                    </div>
            <?
                }
            ?>


            <input
                    type="text"
                    name="<?=((isset($name) ? $name :'')).((isset($lang) and $lang) ? '_'.$lang:'')?>[]"
                    data-role="tagsinput"
                    class="form-control <?=isset($lang) ? $lang : ''?> <?=((isset($class) ? $class :''))?>"
                    value="<?=((isset($value)) ? $value :'')?>"
            >





            <?
            if (isset($yardim) && $yardim != "") {
                ?>
                <div class="input-group-addon info-addon">
                    <i class="fa fa-question-circle"></i>
                    <p><?=$yardim?></p>
                </div>
                <?
            }
            ?>

            <div class="help-block" style="width: 100% !important;"></div>

        </div>

        <?
            if (isset($help) && $help != "") {
        ?>

            <div class="form-control-feedback" style="padding:8px 0 0; font-size:12px;">
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



