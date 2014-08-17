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

            <hr />

            <h4>Project Updates</h4>
            <p><a href="#">Murad</a> Changed the UI for MFR</p>
            <p><a href="#">Jon</a> Created new task for Andrew</p>
            <p><a href="#">Jahne</a> Finished creating buttons</p>

            <hr />

            <h4>Project Discussions</h4>
            <div class="discussions">
                <img src="assets/img/member.jpg" class="img-member" alt="member" title="" />
                <h5>Project scope</h5><p class="discuss"><i>Apr 21</i> - Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                </p>

                <hr />

                <img src="assets/img/member.jpg" class="img-member" alt="member" title="" />
                <h5>Wireframes</h5>
                <p class="discuss"><i>Apr 21</i> - Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                </p>
            </div>

            <hr />

            <h4>Project Files</h4>
            <div class="row">
                <div class="thumbnail col-md-4">
                    <img src="assets/img/file-pic.png" class="img-responsive" alt="" title="" />
                </div>
                <div class="thumbnail col-md-4">
                    <img src="assets/img/file-pic.png" class="img-responsive" alt="" title="" />
                </div>
                <div class="thumbnail col-md-4">
                    <img src="assets/img/file-pic.png" class="img-responsive" alt="" title="" />
                </div>
            </div>
            <div class="row">
                <div class="thumbnail col-md-4">
                    <img src="assets/img/file-pic.png" class="img-responsive" alt="" title="" />
                </div>
                <div class="thumbnail col-md-4">
                    <img src="assets/img/file-pic.png" class="img-responsive" alt="" title="" />
                </div>
                <div class="thumbnail col-md-4">
                    <img src="assets/img/file-pic.png" class="img-responsive" alt="" title="" />
                </div>
            </div>

        </div>
    </div>
</div>