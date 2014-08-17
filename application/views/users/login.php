<div class="row">
    <div class="well well-small col-lg-6 col-md-offset-3">

        <?php if(trim($message) != "") : ?>
            <div class="alert alert-danger"><?php echo $message;?></div>
        <?php endif; ?>

        <?php echo form_open("users/login", 'role="form"');?>
            <legend><?php echo lang('login_heading');?></legend>
            <p><?php echo lang('login_subheading');?></p>
            <hr/>

            <div class="form-group">
                <label for="identity"><?php echo lang('login_identity_label', 'identity');?></label>
                <?php echo form_input($identity, '', 'class="form-control" id="identity" placeholder="User name / email"');?>
            </div>

            <div class="form-group">
                <label for="password"><?php echo lang('login_password_label', 'password');?></label>
                <?php echo form_input($password, '', 'class="form-control" id="password" placeholder="Password"');?>
            </div>

            <div class="form-group">
                <label><?php echo lang('login_remember_label', 'remember');?></label>&nbsp;<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
            </div>

            <p><?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-primary"');?></p>
        <?php echo form_close();?>
        <p><a href="<?php echo(site_url('users/forgot_password')); ?>"><?php echo lang('login_forgot_password');?></a></p>
        <p>Don't have an account? <a href="<?php echo(site_url('users/register')); ?>">Register</a></p>
    </div>
</div>