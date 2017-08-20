<form autocomplete="off" class="appForm clearfix" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n50 border">
            <label<?= $this->labelFloat('Name') ?>><?= $text_label_Name ?></label>
            <input required type="text" name="Name" id="Name" maxlength="50" value="<?= $this->showValue('Name') ?>">
        </div>
        <div class="input_wrapper_other padding n50 select">
            <select required name="CategoryId">
                <option value=""><?= $text_label_CategoryId ?></option>
                <?php if (false !== $categories): foreach ($categories as $category): ?>
                    <option value="<?= $category->CategoryId ?>" <?= $this->selectedIf('CategoryId', $category->CategoryId) ?>><?= $category->Name ?></option>
                <?php endforeach;endif; ?>
            </select>
        </div>
        <div class="input_wrapper n20 border">
            <label<?= $this->labelFloat('Quantity') ?>><?= $text_label_Quantity ?></label>
            <input required type="number" name="Quantity" id="Quantity" min="1" step="1" value="<?= $this->showValue('Quantity') ?>">
        </div>
        <div class="input_wrapper n20 border padding">
            <label<?= $this->labelFloat('BuyPrice') ?>><?= $text_label_BuyPrice ?></label>
            <input required type="number" name="BuyPrice" id="BuyPrice" min="1" step="0.01" value="<?= $this->showValue('BuyPrice') ?>">
        </div>
        <div class="input_wrapper n20 border padding">
            <label<?= $this->labelFloat('SellPrice') ?>><?= $text_label_SellPrice ?></label>
            <input required type="number" name="SellPrice" id="SellPrice" min="1" step="0.01" value="<?= $this->showValue('SellPrice') ?>">
        </div>
        <div class="input_wrapper_other padding n40 select">
            <select required name="Unit">
                <option value=""><?= $text_label_Unit ?></option>
                <option value="1" <?= $this->selectedIf('Unit', 1) ?>><?= $text_unit_1 ?></option>
                <option value="2" <?= $this->selectedIf('Unit', 2) ?>><?= $text_unit_2 ?></option>
                <option value="3" <?= $this->selectedIf('Unit', 3) ?>><?= $text_unit_3 ?></option>
                <option value="4" <?= $this->selectedIf('Unit', 4) ?>><?= $text_unit_4 ?></option>
            </select>
        </div>
        <div class="input_wrapper n100">
            <label class="floated"><?= $text_label_Image ?></label>
            <input type="file" name="image" accept="image/*">
        </div>

        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>