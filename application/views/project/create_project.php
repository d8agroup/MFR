<div class="row">
    <div class="col-md-12">

        <div class="container" style="margin-top:30px">
            <div class="col-md-4 col-md-offset-4">

                <?php if(isset($messages)) : ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close pull-right" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <ul>
                            <?php foreach($messages as $message) : ?>
                                <li><?php echo $message; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if($show_create_form) : ?>
                    <?php echo form_open('project/create_project'); ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title"><b><i class="fa fa-dot-circle-o"></i> Create New Project</b></h2>
                            </div>
                            <div class="panel-body">
                                <p>Create a new project and assign members to work on it on the form below. </p>
                                <form role="form">
                                    <div class="form-group">
                                        <label for="ProjectName">Project Name</label>
                                        <input type="text" class="form-control" id="ProjectName" placeholder="Enter Project" name="project_name">
                                    </div>

                                    <div class="form-group">
                                        <label for="ProjectDescription">Project Description</label>
                                        <textarea rows="5" class="form-control" id="ProjectDescription" placeholder="Input your project description here..." name="project_description"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-default">Create Project</button>
                                </form>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>