<? $rand = rand(0000000,9999999)?>

<div class="col-sm-6">
    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input value="<?=$label?>" type="checkbox" name="<?=$name?>[]" class="custom-control-input" id="<?=$name."_".$rand?>">
            <label class="custom-control-label" for="<?=$name."_".$rand?>"><?=$label?></label>
        </div>
    </div>
</div>

