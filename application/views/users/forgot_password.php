<div class="row">
    <div class="well well-small col-lg-6 col-md-offset-3">

        <?php if(trim($message) != "") : ?>
            <div class="alert alert-danger"><?php echo $message;?></div>
        <?php endif; ?>

        <?php echo form_open("users/forgot_password", 'role="form"');?>
            <legend><?php echo lang('forgot_password_heading');?></legend>
            <p<?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?>></p>
            <hr/>

            <div class="form-group">
                <label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?></label> <br />
                <?php echo form_input($email, '', 'class="form-control"');?>
            </div>

            <p><?php echo form_submit('submit', lang('forgot_password_submit_btn'), 'class="btn btn-primary"');?></p>
        <?php echo form_close();?>
    </div>
</div>

