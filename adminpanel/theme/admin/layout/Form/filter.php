<div class="form-group form-md-line-input" style="margin-bottom: 0px;">
    <select class="form-control select2 <?=(isset($class) ? $class : "")?>" data-url="<?=(isset($url) ? $url : "")?>" name="<?=((isset($name) ? $name :'')).((isset($lang)) ? '_'.$lang:'')?>">
        <option value="" ><?=(isset($title)) ? $title : ""?></option>
        <?=(isset($data) ? $data:null)?>
    </select>
</div>

