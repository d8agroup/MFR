<div class="row">

    <div class="col-md-3">
        <?php echo $projects_sidebar; ?>
    </div>

    <div class="col-md-9">
        <div class="row">
            <?php foreach($projects as $project) : ?>
                <div class="col-md-4">
                    <div class="project-bg">
                        <h3><i class="fa fa-dot-circle-o"></i><?php echo $project->name; ?></h3>
                        <p><?php echo $project->description; ?></p>
                        <a href="<?php echo site_url('project/view/'.$project->id); ?>" class="btn btn-block btn-default">View Project</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if(count($projects) == 0) : ?>
        <div class="alert alert-info">You have no projects yet</div>
    <?php endif; ?>
</div>