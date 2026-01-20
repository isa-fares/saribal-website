<? $rand = rand(000,999)?>
<?
if (isset($col) and !empty($col)){
    echo "<div class='".$col."'>";
}
?>
    <div class="form-group">
        <? if (isset($label) and !empty($label)){?>
        <label for="<?=$name?>" class="<?=(isset($label_class)) ? $label_class : ""?>">
            <?=$label?> <?=((isset($required) and $required) ? "<sup class='text-danger'>*</sup>" : "")?>
            <? } ?>
            <? if (isset($info) && !empty($info)){?>
                <i class="badge badge-dark" data-toggle="tooltip" data-placement="top" title="<?=$info?>">i</i>
            <? } ?>

            <? if (isset($label) and !empty($label)){?>
        </label>
    <? } ?>

        <select name="<?=$name?>" <?=((isset($required) and $required) ? "required" : "")?> <?=((isset($placeholder) and !empty($placeholder)) ? "placeholder='".$placeholder.((isset($required) and $required) ? " *" : "")."'" : "")?> class="form-control custom-select <?=((isset($class) and $class) ? $class : "")?>" id="<?=$name?>_<?=$rand?>">
        <option value="">Seçiniz <?=((isset($required) and $required) ? " *" : "")?></option>
            <?
                if (isset($options) && is_array($options)){
                    foreach ($options as $key=>$item){
                        echo "<option value='".$item["value"]."'".((isset($selected) && $selected == $item["value"]) ? "selected" : "").">".$item["title"]."</option>";
                    }
                }
            ?>

            <?
            if (isset($database) && is_array($database)){

                foreach ($database["veri"] as $key=>$item){
                    echo "<option value='".$item[$database["value"]]."'".((isset($selected) && $selected == $item["value"]) ? "selected" : "").">".$item[$database["title"]]."</option>";
                }
            }
            ?>

        </select>
    </div>

<?
if (isset($col) and !empty($col)){
    echo "</div>";
}
?>