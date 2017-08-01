<div class="container">
    <a href="/clients/create" class="button"><i class="fa fa-plus"></i> <?= $text_new_item ?></a>
    <table class="data">
        <thead>
            <tr>
                <th><?= $text_table_name ?></th>
                <th><?= $text_table_email ?></th>
                <th><?= $text_table_phone_number ?></th>
                <th><?= $text_table_control ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(false !== $clients): foreach ($clients as $supplier): ?>
            <tr>
                <td><?= $supplier->Name ?></td>
                <td><?= $supplier->Email ?></td>
                <td><?= $supplier->PhoneNumber ?></td>
                <td>
                    <a href="/clients/edit/<?= $supplier->ClientId ?>"><i class="fa fa-edit"></i></a>
                    <a href="/clients/delete/<?= $supplier->ClientId ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>