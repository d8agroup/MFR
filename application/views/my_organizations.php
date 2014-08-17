<div class="row">
    <div class="col-md-12">
        <div class="row">
            <?php foreach($organizations as $organization) : ?>
                <div class="col-md-4">
                    <div class="project-bg">
                        <h3><i class="fa fa-dot-circle-o"></i><?php echo $organization->name; ?></h3>
                        <p><?php echo $organization->description; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if(count($organizations) == 0) : ?>
        <div class="alert alert-info">You have no organizations yet</div>
    <?php endif; ?>
</div>