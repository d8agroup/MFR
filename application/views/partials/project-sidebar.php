<div class="sidebar">
    <h3><i class="fa fa-bars"></i> Operations</h3>
    <?php echo form_open('project/search_projects', 'accept-charset="UTF-8" id="login-nav" role="form"'); ?>

        <?php if(isset($project_id)) : ?>
            <div class="form-group">
                <a href="<?php echo site_url('project/dashboard/'.$project_id); ?>" class="btn btn-success btn-block">Project Dashboard</a>
            </div>

            <div class="form-group">
                <a href="<?php echo site_url('project/view/'.$project_id); ?>" class="btn btn-success btn-block">Project Home</a>
            </div>
        <?php endif; ?>

        <p>Search:</p>

        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2">Search for a Project</label>
            <input type="text" class="form-control" id="search_terms" placeholder="Search terms" name="search_terms" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">Search</button>
        </div>
    <?php echo form_close(); ?>
</div>