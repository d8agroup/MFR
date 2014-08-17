<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="logo" href="<?php echo site_url(); ?>"><img src="<?php echo site_url('assets/themes/bootstrap/img/logo.png'); ?>" alt="MFR" /></a>
        </div>
        <div class="navbar-collapse collapse">
            <?php if(!$logged_in) : ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo site_url('users/register'); ?>">Sign Up</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sign in <b class="caret"></b></a>
                        <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo form_open('users/login', 'accept-charset="UTF-8" id="login-nav" role="form"'); ?>
                                            <div class="form-group">
                                                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" name="identity" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" name="password" required>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Remember me
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-block">Sign in</button>
                                            </div>
                                            <div><a href="<?php echo site_url('users/forgot_password'); ?>">Forgot password</a></div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </li>
                            <!-- TODO: Sign in with google: -->
                            <!--
                            <li class="divider"></li>
                            <li>
                                <input class="btn btn-primary btn-block" type="button" id="sign-in-google" value="Sign In with Google">
                            </li>
                            -->
                        </ul>
                    </li>
                </ul>
            <?php else : ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>

                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('users/edit_user/'.$user_id); ?>">My Profile</a></li>
                            <?php if(!$is_organization) : ?>
                                <li><a href="<?php echo site_url('home/my_organizations/'); ?>">My Organizations</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo site_url('home'); ?>">My Projects</a></li>
                        </ul>
                    </li>

                    <li><a href="<?php echo site_url('users/logout'); ?>">Logout</a></li>

                    <?php if($is_admin) : ?>
                        <li><a href="<?php echo site_url('users'); ?>">Users</a></li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
