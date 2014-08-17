<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        foreach($js as $file){
            echo "\n\t\t";
            ?><script src="<?php echo $file; ?>"></script><?php
        } echo "\n\t";
        ?>
        <?php

        foreach($css as $file){
            echo "\n\t\t";
            ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
        } echo "\n\t";
        ?>
        <?php
        if(!empty($meta))
            foreach($meta as $name=>$content){
                echo "\n\t\t";
                ?><meta name="<?php echo $name; ?>" content="<?php echo is_array($content) ? implode(", ", $content) : $content; ?>" /><?php
            }
        ?>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu+Mono|Open+Sans' rel='stylesheet' type='text/css'>
        <title>Monitor for Results</title>
    </head>
    <body>
        <?php echo $this->load->get_section('nav_bar'); ?>

        <div class="pages-bg">
            <div class="container">
                <?php echo $output; ?>
            </div>
        </div>

        <div class="footer">
            <p>&copy; 2014 - Monitor For Results. All Rights Reserved</p>
        </div>
    </body>
</html>