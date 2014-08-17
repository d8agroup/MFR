<div class="row">
    <div class="well well-small col-lg-6 col-md-offset-3">

        <?php if(trim($message) != "") : ?>
            <div class="alert alert-danger"><?php echo $message;?></div>
        <?php endif; ?>

        <?php echo form_open('users/reset_password/' . $code, 'role="form"');?>
            <legend><?php echo lang('reset_password_heading');?></legend>

            <p>
                <label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label>
                <?php echo form_input($new_password, '', 'class="form-control"');?>
            </p>

            <p>
                <label for="new_password_confirm"><?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?></label>
                <?php echo form_input($new_password_confirm, '', 'class="form-control" id="new_password_conform"');?>
            </p>

            <?php echo form_input($user_id);?>
            <?php echo form_hidden($csrf); ?>

            <p><?php echo form_submit('submit', lang('reset_password_submit_btn'), 'class="btn btn-primary"');?></p>
        <?php echo form_close();?>
    </div>
</div>
