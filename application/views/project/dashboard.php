<div class="row">

    <div class="col-md-3">
        <?php if(isset($organization_sidebar)) : ?>
            <?php echo $organization_sidebar; ?>
            <hr/>
        <?php endif; ?>
        <?php echo $project_sidebar; ?>
    </div>

    <div class="col-md-9">
        <div class="article">
            <a class="btn btn-default pull-right" href="<?php echo site_url('home'); ?>"><i class="fa fa-step-backward"></i> Back to Projects</a>
            <h3><i class="fa fa-dot-circle-o"></i> Project A</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>

            <div class="row">
                <div class="col-md-4">
                    <p><a href="#" class="btn btn-block btn-default"><i class="fa fa-check-square-o"></i> View Progress</a></p>
                    <p><a href="#" class="btn btn-block btn-default"><i class="fa fa-comments"></i> Start a discussion</a></p>
                    <p><a href="#" class="btn btn-block btn-default"><i class="fa fa-file"></i> View Files</a></p>
                </div>
                <div class="col-md-4">
                    <p><a href="#" class="btn btn-block btn-default"><i class="fa fa-edit"></i> Enter Data</a></p>
                    <p><a href="#" class="btn btn-block btn-default"><i class="fa fa-upload"></i> Upload a File</a></p>
                </div>
                <div class="col-md-4">
                    <p><a href="#" class="btn btn-block btn-default"><i class="fa fa-bar-chart-o"></i> Generate Reports</a></p>
                    <p><a href="#" class="btn btn-block btn-default"><i class="fa fa-"></i> View Reports</a></p>
                </div>
            </div>

            <hr />

            <h3><i class="fa fa-users"></i> Team Members</h3>
            <div class="member">
                <img class="img-member" src="assets/img/member.jpg" title="Murad" alt="murad" />
                <img class="img-member" src="assets/img/member.jpg" title="Murad" alt="murad" />
                <img class="img-member" src="assets/img/member.jpg" title="Murad" alt="murad" />
                <img class="img-member" src="assets/img/member.jpg" title="Murad" alt="murad" />
            </div>
        </div>
    </div>
</div>