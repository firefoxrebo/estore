<div class="container">
    <a href="/productcategories/create" class="button"><i class="fa fa-plus"></i> <?= $text_new_item ?></a>
    <table class="data">
        <thead>
            <tr>
                <th><?= $text_table_group_name ?></th>
                <th><?= $text_table_control ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(false !== $categories): foreach ($categories as $category): ?>
            <tr>
                <td><?= $category->Name ?></td>
                <td>
                    <a href="/productcategories/edit/<?= $category->CategoryId ?>"><i class="fa fa-edit"></i></a>
                    <a href="/productcategories/delete/<?= $category->CategoryId ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>