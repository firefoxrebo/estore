<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n50 padding border">
            <label<?= $this->labelFloat('PhoneNumber', $user) ?>><?= $text_label_PhoneNumber ?></label>
            <input required type="text" name="PhoneNumber" value="<?= $this->showValue('PhoneNumber', $user) ?>">
        </div>
        <div class="input_wrapper_other padding n50 select">
            <select required name="GroupId">
                <option value=""><?= $text_user_GroupId ?></option>
                <?php if (false !== $groups): foreach ($groups as $group): ?>
                    <option value="<?= $group->GroupId ?>" <?= $this->selectedIf('GroupId', $group->GroupId, $user) ?>><?= $group->GroupName ?></option>
                <?php endforeach;endif; ?>
            </select>
        </div>
        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>