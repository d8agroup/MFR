<div class="row">
    <div class="well well-small col-lg-6 col-md-offset-3">

        <?php if(trim($message) != "") : ?>
            <div class="alert alert-danger"><?php echo $message;?></div>
        <?php endif; ?>

        <?php echo form_open(uri_string(), 'role="form"');?>
            <legend><?php echo lang('edit_user_heading');?></legend>
            <p><?php echo lang('edit_user_subheading');?></p>
            <hr/>

            <div class="form-group">
                <label for='first_name'><?php echo lang('create_user_fname_label', 'first_name');?></label>
                <?php echo form_input($first_name, '', 'class="form-control" id="first_name" placeholder="First Name"');?>
            </div>

            <div class="form-group">
                <label for='last_name'><?php echo lang('create_user_lname_label', 'last_name');?></label>
                <?php echo form_input($last_name, '', 'class="form-control" id="last_name" placeholder="Last Name"');?>
            </div>

            <div class="form-group">
                <label for='company'><?php echo lang('create_user_company_label', 'company');?></label>
                <?php echo form_input($company, '', 'class="form-control" id="company" placeholder="Company"');?>
            </div>

            <div class="form-group">
                <label for='user_name'><?php echo lang('create_user_name_label', 'first_name');?></label>
                <?php echo form_input($user_name, '', 'class="form-control" id="user_name" placeholder="User Name"');?>
            </div>

            <div class="form-group">
                <label for='email'><?php echo lang('create_user_email_label', 'email');?></label>
                <?php echo form_input($email, '', 'class="form-control" id="email" placeholder="Email"');?>
            </div>

            <div class="form-group">
                <label for='phone'><?php echo lang('create_user_phone_label', 'phone');?></label>
                <?php echo form_input($phone, '', 'class="form-control" id="phone" placeholder="Phone"');?>
            </div>

            <div class="form-group">
                <label for='password'><?php echo lang('create_user_password_label', 'password');?></label>
                <?php echo form_input($password, '', 'class="form-control" id="password" placeholder="Password"');?>
            </div>

            <div class="form-group">
                <label for='confirm_password'><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
                <?php echo form_input($password_confirm, '', 'class="form-control" id="confirm_password" placeholder="Confirm Password"');?>
            </div>

            <?php if ($this->ion_auth->is_admin()): ?>

                <h3><?php echo lang('edit_user_groups_heading');?></h3>
                <?php foreach ($groups as $group):?>
                    <label class="checkbox">
                        <?php
                        $gID=$group['id'];
                        $checked = null;
                        $item = null;
                        foreach($currentGroups as $grp) {
                            if ($gID == $grp->id) {
                                $checked= ' checked="checked"';
                                break;
                            }
                        }
                        ?>
                        <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                        <?php echo $group['name'];?>
                    </label>
                <?php endforeach?>

            <?php endif ?>

            <?php echo form_hidden('id', $user->id);?>
            <?php echo form_hidden($csrf); ?>

            <p><?php echo form_submit('submit', lang('edit_user_submit_btn'), 'class="btn btn-primary"');?></p>
        <?php echo form_close();?>
    </div>
</div>


