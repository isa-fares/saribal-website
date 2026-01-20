<? $rand = rand(000,999)?>

<div class="form-group <?=$class?>">
    <div class="custom-file">
        <input type="file" name="<?=$name?>" class="custom-file-input " id="<?=$name."_".$rand?>" lang="<?=$lang?>">
        <label class="custom-file-label" data-browse="<?=$browse?>" for="<?=$name."_".$rand?>"><?=$label?></label>
    </div>
</div>

