<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n100">
            <label><?= $text_label_group_title ?></label>
            <input required type="text" name="GroupName" id="GroupName" maxlength="20">
        </div>
        <div class="input_wrapper_other">
            <label><?= $text_label_privileges ?></label>
            <?php if ($privileges !== false): foreach ($privileges as $privilege): ?>
                <label class="checkbox block">
                    <input type="checkbox" name="privileges[]" id="privileges" value="<?= $privilege->PrivilegeId ?>">
                    <div class="checkbox_button"></div>
                    <span><?= $privilege->PrivilegeTitle ?></span>
                </label>
            <?php endforeach; endif; ?>
        </div>
        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>