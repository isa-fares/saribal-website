<?
$langCount =  count($this->settings->lang('lang'));
?>
<div class="form-group">

 <label style="font-size: 14px;" for="<?=((isset($id) ? $id :'')).((isset($lang)) ? '_'.$lang:'')?>">
     <?=(isset($title)) ? $title : ""?> <?=(isset($lang) && $langCount > 1) ? "<small>[".$this->langSelect($lang)."]</small>" : ""?>

 </label>

 <div class="controls">
    <textarea id="<?=((isset($id) ? $id :'')).((isset($lang)) ? '_'.$lang:'')?>"
              style="height:<?=((isset($height) ? $height :'140')).'px'?>"
              class="<?=((isset($class) ? $class :''))?> editor"
              name="<?=((isset($name) ? $name :'')).((isset($lang)) ? '_'.$lang:'')?>"><?=((isset($value) ? $value :''))?></textarea>

     <?
     if (isset($help)) {
         ?>
         <div class="form-control-feedback">
             <small><?=$help?></small>
         </div>
         <?
     }
     ?>

 </div>
</div>