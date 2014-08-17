<div class="row">
    <div class="col-md-3">
        <?php echo $organization_sidebar; ?>
    </div>

    <div class="col-md-9">
        <div class="article">

            <h3>Project Users</h3>
            <hr/>

            <?php if((count($users['project']) > 0) || count($users['organization']) > 0) : ?>
                <div class="row" style="padding:20px;">
                    <?php foreach($users['project'] as $user) : ?>
                        <img class="img-user-thumbnail" src="<?php echo $user->gravatar; ?>"
                             title="<?php echo $user->first_name." ".$user->last_name ?>"/>
                    <?php endforeach; ?>
                    <?php foreach($users['organization'] as $user) : ?>
                        <img class="img-user-thumbnail" src="<?php echo $user->gravatar; ?>"
                             title="<?php echo $user->first_name." ".$user->last_name ?>"/>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="alert alert-info">No users exist</div>
            <?php endif; ?>

            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#project_user_modal">
                <i class="fa fa-plus"></i> Add Project User
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="project_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add a new Project User</h4>
            </div>
            <?php echo form_open('organization/add_project_user', 'role="form"'); ?>
            <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="EMail Address" name="email_address"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>