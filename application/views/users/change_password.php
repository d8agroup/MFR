<div class="row">
    <div class="well well-small col-lg-6 col-md-offset-3"">

        <?php if(trim($message) != "") : ?>
            <div class="alert alert-danger"><?php echo $message;?></div>
        <?php endif; ?>

        <?php echo form_open("users/change_password", 'role="form"');?>
            <legend><?php echo lang('change_password_heading');?></legend>

            <div class="form-group">
                <label for="old_password"><?php echo lang('change_password_old_password_label', 'old_password');?></label>
                <?php echo form_input($old_password, '', 'class="form-control" id="old_password" placeholder="Old Password"');?>
            </div>

            <div class="form-group">
                <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label>
                <?php echo form_input($new_password, '', 'class="form-control" id="new_password" placeholder="New Password"');?>
            </div>

            <div class="form-group">
                <label for="new_password_confirm"><?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?></label>
                <?php echo form_input($new_password_confirm, '', 'class="form-control" id="new_password_confirm" placeholder="New Password"');?>
            </div>

            <?php echo form_input($user_id);?>
            <p><?php echo form_submit('submit', lang('change_password_submit_btn'), 'class="btn btn-primary"');?></p>
        <?php echo form_close();?>
    </div>
</div>

