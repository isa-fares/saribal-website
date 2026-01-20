<?
/***
 * @var $value string
 */
?>

<button value="<?=$value?>" <?=(isset($attr) ? $attr : "")?> type="<?=(isset($type) ? $type : "button")?>" class="submit_button <?=(isset($class) ? $class: "")?>">
    <? if (isset($imageURL)){?>
        <img src="<?=$imageURL?>">
    <? } ?>
    <?=$value?>
</button>