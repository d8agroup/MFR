<div class="article">
    <h2><?php echo lang('index_heading');?></h2>
    <hr/>
    <p><?php echo lang('index_subheading');?></p>

    <?php if(trim($message) != "") : ?>
        <div class="alert alert-error"><?php echo $message;?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <tr>
            <th><?php echo lang('index_fname_th');?></th>
            <th><?php echo lang('index_lname_th');?></th>
            <th><?php echo lang('index_email_th');?></th>
            <th><?php echo lang('index_groups_th');?></th>
            <th><?php echo lang('index_status_th');?></th>
            <th><?php echo lang('index_action_th');?></th>
        </tr>
        <?php foreach ($users as $user):?>
            <tr>
                <td><?php echo $user->first_name;?></td>
                <td><?php echo $user->last_name;?></td>
                <td><?php echo $user->email;?></td>
                <td>
                    <?php foreach($user->groups as $group) : ?>
                        <span class="label label-default"><?php echo $group->name; ?></span>
                    <?php endforeach; ?>
                </td>
                <td><?php echo ($user->active) ? anchor("users/deactivate/".$user->id, lang('index_active_link'), 'class="btn btn-danger"') : anchor("users/activate/". $user->id, lang('index_inactive_link'), 'class="btn btn-primary"');?></td>
                <td><?php echo anchor("users/edit_user/".$user->id, 'Edit', 'class="btn btn-primary"') ;?></td>
            </tr>
        <?php endforeach;?>
    </table>

    <p><?php echo anchor('users/create_user', lang('index_create_user_link'), 'class="btn btn-default"')?> &nbsp;</p>
</div>
