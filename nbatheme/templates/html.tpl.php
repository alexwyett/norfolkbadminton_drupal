<?php

global $base_path;
global $theme;
$themePath = $base_path  . drupal_get_path('theme', 'nbatheme');
$localThemePath = $base_path  . drupal_get_path('theme', $theme);

?><!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $head_title; ?></title>
    
    <?php echo $head; ?>
    <?php echo $styles; ?>
    <?php echo $scripts; ?>

    <!-- CSS  -->
    <link rel="icon" href="<?php echo $localThemePath; ?>/favicon.ico" type="image/x-icon" />
</head>
<body>

    <?php
        global $user;
        if (!empty($tabs) && user_is_logged_in()) {
            echo sprintf(
                '<nav class="main-header_tabs">%s</div>',
                render($tabs)
            );
        }
    ?>

    <div class="main-window">
        <div class="main-wrapper">
            <?php
                echo $page_top;
                echo $page;
                echo $page_bottom;
            ?>
        </div>
    </div>

</body>
</html>