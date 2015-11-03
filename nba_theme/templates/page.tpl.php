<?php

global $base_path;
global $theme;
$themePath = $base_path  . drupal_get_path('theme', 'nbatheme');
$localThemePath = $base_path  . drupal_get_path('theme', $theme);

?>
<header class="header header-main <?php print $classes; ?>" itemtype="http://schema.org/WebPage" itemscope>
    <div class="o-padder">
        <?php echo render($page['header_nav']); ?>
        
        <a href="<?php echo url('<front>'); ?>" class="main-header_logo logo">
            <img src="<?php echo $localThemePath; ?>/assets/img/logo.png">
        </a>
        
    </div>
</header>

<main class="main">
    <?php echo render($page['search']); ?>
    <?php echo render($page['nav']); ?>
    <?php

        $sidebar = render($page['sidebar']);
        $cols = (strlen($sidebar) > 0) ? 'two' : 'one';

    ?>

    <div class="<?php echo $cols; ?>-column clearfix">
        <?php echo render($page['content']); ?>
        <?php echo $sidebar; ?>
    </div>

    <?php echo render($page['footer']); ?>
</main>