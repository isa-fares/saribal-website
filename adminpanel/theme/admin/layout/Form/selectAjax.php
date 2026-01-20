<div class="form-group">
    <label style="font-size: 14px;">
        <?=(isset($title)) ? $title : ""?>
    </label>

    <div class="search-block">
        <div class="search-block-input">Seçiniz</div>
        <div class="search-area">
            <div class='search-default-text'>Seçiniz</div>
            <input type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" class="search-input" data-type="<?=$type?>" placeholder="<?=$place?>" autocomplete="off">
            <input type="hidden" name="<?=$name?>" class="d-none return_value" value="">
            <i class="text-center fa fa-spinner fa-spin loading-result"></i>
            <ul class="search-result" data-selected="0"></ul>
        </div>
    </div>
</div>