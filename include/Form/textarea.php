<? $rand = rand(000,999)?>
<?
    if (isset($col) and !empty($col)){
        echo "<div class='".$col."'>";
    }
?>
<? if (isset($form_group) && $form_group !== false){?>
    <div class="form-group">
<? } ?>
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

    <textarea style="resize:none;" <?=((isset($required) and $required) ? "required" : "")?> <?=((isset($placeholder) and !empty($placeholder)) ? "placeholder='".$placeholder.((isset($required) and $required) ? " *" : "")."'" : "")?> name="<?=$name?>" class=" <?=((isset($class) and $class) ? $class : "")?>" rows="<?=(isset($rows) ? $rows : "3")?>" id="<?=$name?>_<?=$rand?>"><?=(isset($value) ? $value : "")?></textarea>

<? if (isset($form_group) && $form_group !== false){?>
    </div>>
<? } ?>

<?
if (isset($col) and !empty($col)){
    echo "</div>";
}
?>