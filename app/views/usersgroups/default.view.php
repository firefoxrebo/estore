<div class="container">
    <a href="/usersgroups/create" class="button"><i class="fa fa-plus"></i> <?= $text_new_item ?></a>
    <table class="data">
        <thead>
            <tr>
                <th><?= $text_table_group_name ?></th>
                <th><?= $text_table_control ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(false !== $groups): foreach ($groups as $group): ?>
            <tr>
                <td><?= $user->GroupName ?></td>
                <td>

                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>