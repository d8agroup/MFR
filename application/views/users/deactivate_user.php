<div class="row">
    <div class="well well-small col-lg-6 col-md-offset-3" style="width:400px;">
        <?php echo form_open("users/deactivate/".$user->id, 'role="form"');?>
            <legend><?php echo lang('deactivate_heading');?></legend>

            <p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>
            <hr/>

            <p>
                <?php echo lang('deactivate_confirm_y_label', 'confirm');?>
                <input type="radio" name="confirm" value="yes" checked="checked" />&nbsp;
                <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
                <input type="radio" name="confirm" value="no" />
            </p>

            <?php echo form_hidden($csrf); ?>
            <?php echo form_hidden(array('id'=>$user->id)); ?>

            <p><?php echo form_submit('submit', lang('deactivate_submit_btn'), lang('create_user_submit_btn').' class="btn btn-primary"');?></p>
        <?php echo form_close();?>
    </div>
</div>