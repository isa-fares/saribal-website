<div class='box-footer <?=(is_array($appendButon)) ? "d-flex justify-content-between flex-grow-all" : ""?>'>
    <button type="submit" name="<?=$name?>" value="<?=$value?>" class="btn  <?=((isset($class) ? $class :''))?> <?=((isset($color) ? $color :'dark'))?>">
        <?=((isset($icon)) ? "<i class='".$icon."'></i>" : "")?>
        <?=((isset($submit) ? $submit :'Gönder'))?>
    </button>
    <? if (is_array($appendButon)):?>
        <button  name="<?=$name?>" type="submit" value="<?=$appendButon["value"]?>" class="btn  <?=((isset($appendButon["class"]) ? $appendButon["class"] :''))?>">
            <?=((isset($appendButon["icon"])) ? "<i class='".$appendButon["icon"]."'></i>" : "")?>
            <?=((isset($appendButon["text"]) ? $appendButon["text"] :'Gönder'))?>
        </button>
    <? endif; ?>
</div>