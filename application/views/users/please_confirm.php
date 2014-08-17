<div class="row">
    <div class="well well-small col-lg-6 col-md-offset-3">

        <div class="alert alert-info">
            An email has been sent to you with the confirmation code. Please copy and paste the confirmation code or click on the confirmation link
        </div>

        <?php echo form_open("users/confirm_register/".$user_id, 'role="form"');?>
            <legend>Supply confirmation code</legend>
            <hr/>

            <div class="form-group">
                <label for="identity">Confirmation Code:</label>
                <?php echo form_input('confirmation_code', '', 'class="form-control" id="identity" placeholder="Confirmation Code"');?>
            </div>

            <p><?php echo form_submit('submit', 'Confirm', 'class="btn btn-primary"');?></p>
        <?php echo form_close();?>
    </div>
</div>