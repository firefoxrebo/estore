<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_employee_details ?></legend>
        <div class="input_wrapper n40 border">
            <label class="floated"><?= $text_label_name ?></label>
            <input required type="text" name="name" id="name" maxlength="50" value="<?= $employee->name ?>">
        </div>
        <div class="input_wrapper n40 padding border">
            <label class="floated"><?= $text_label_address ?></label>
            <input required type="text" id="address" name="address" maxlength="100" value="<?= $employee->address ?>">
        </div>
        <div class="input_wrapper_other n20 padding">
            <label><?= $text_label_gender ?></label>
            <label class="radio">
                <input type="radio" name="gender" id="gender" value="1" <?= $employee->gender == 1 ? 'checked' : '' ?>>
                <div class="radio_button"></div>
                <span><?= $text_label_gender_male ?></span>
            </label>
            <label class="radio">
                <input type="radio" name="gender" id="gender" value="2" <?= $employee->gender == 2 ? 'checked' : '' ?>>
                <div class="radio_button"></div>
                <span><?= $text_label_gender_female ?></span>
            </label>
        </div>
        <div class="input_wrapper n30 border">
            <label class="floated"><?= $text_label_age ?></label>
            <input required type="number" min="22" max="60" name="age" id="age" value="<?= $employee->age ?>">
        </div>
        <div class="input_wrapper n20 padding border">
            <label class="floated"><?= $text_label_salary ?></label>
            <input required type="number" id="salary" step="0.01" name="salary" min="1500" max="9000" value="<?= $employee->salary ?>">
        </div>
        <div class="input_wrapper n20 padding border">
            <label class="floated"><?= $text_label_tax ?></label>
            <input required type="number" id="tax" step="0.01" name="tax" min="1" max="5" value="<?= $employee->tax ?>">
        </div>
        <div class="input_wrapper_other n30 padding select">
            <select required name="type" id="type">
                <option value=""><?= $text_label_choose_employee_type ?></option>
                <option value="1" <?= $employee->theType == 1 ? 'selected' : '' ?>><?= $text_label_type_part_time ?></option>
                <option value="2" <?= $employee->theType == 2 ? 'selected' : '' ?>><?= $text_label_type_full_time ?></option>
            </select>
        </div>
        <div class="input_wrapper_other">
            <label><?= $text_label_os ?></label>
            <label class="checkbox block">
                <input type="checkbox" name="os[]" id="os" value="1" <?= (@in_array(1, $employee->os)) ? 'checked' : '' ?>>
                <div class="checkbox_button"></div>
                <span><?= $text_label_os_windows ?></span>
            </label>
            <label class="checkbox block">
                <input type="checkbox" name="os[]" id="os" value="2" <?= (@in_array(2, $employee->os)) ? 'checked' : '' ?>>
                <div class="checkbox_button"></div>
                <span><?= $text_label_os_linux ?></span>
            </label>
            <label class="checkbox block">
                <input type="checkbox" name="os[]" id="os" value="3" <?= (@in_array(3, $employee->os)) ? 'checked' : '' ?>>
                <div class="checkbox_button"></div>
                <span><?= $text_label_os_mac ?></span>
            </label>
        </div>
        <div class="input_wrapper_other">
            <label><?= $text_label_notes ?></label>
            <textarea name="notes" id="notes" cols="30" rows="10"><?= $employee->notes ?></textarea>
        </div>
        <input type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>