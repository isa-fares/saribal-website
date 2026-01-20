<div class="form-group form-md-line-input">
    <label class="col-md-2 control-label" for="form_control_1" style="padding-left: 0px !important;">
        <img src="https://cdn.vemedya.com/admin/assets/flags/tr.png" width="25px" style="margin-right:10px;"><?=isset($title) ? $title : ""?></label>
    <div class="col-md-4">
        <input type="text" id="baslik_<?=$filter_id?>" class="form-control tr " value="<?=$value_tr?>"  name="detay_tr[]">
        <input type="hidden" name="filter_id[]" value="<?=$filter_id?>">
        <input type="hidden" name="edit_id[]" value="<?=$id?>">
        <div class="form-control-focus"> </div>
        <span class="help-block" style="clear: both; width: 100%;"></span>
    </div>


    <label class="col-md-2 control-label" for="form_control_1" style="padding-left: 0px !important;">
        <img src="https://cdn.vemedya.com/admin/assets/flags/en.png" width="25px" style="margin-right:10px;"><?=isset($title) ? $title : ""?></label>
    <div class="col-md-4">
        <input type="text" id="baslik_<?=$filter_id?>'" value="<?=$value_en?>" class="form-control en " placeholder="" name="detay_en[]">

        <div class="form-control-focus"> </div>
        <span class="help-block" style="clear: both; width: 100%;"></span>
    </div>

</div>
<br clear="all">