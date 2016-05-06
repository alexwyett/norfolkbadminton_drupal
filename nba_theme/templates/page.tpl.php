<?php

global $base_path;
global $theme;
$themePath = $base_path  . drupal_get_path('theme', 'nbatheme');
$localThemePath = $base_path  . drupal_get_path('theme', $theme);

?>
<header class="header main_header <?php print $classes; ?>" itemtype="http://schema.org/WebPage" itemscope>
    <a href="<?php echo url('<front>'); ?>" class="main-header_logo logo">
        <img src="<?php echo $localThemePath; ?>/assets/img/logo.png">
    </a>
    
    <?php echo render($page['header_nav']); ?>
</header>

<main class="main">
    <?php echo render($page['search']); ?>
    <?php echo render($page['nav']); ?>
    <?php

        $sidebar = render($page['sidebar']);
        $cols = (strlen($sidebar) > 0) ? 'two' : 'one';

        if (!empty($node) && property_exists($node, 'type')) {
            node_build_content($node);
            foreach (array('banners', 'nba_cat') as $key) {
                if (isset($node->content[$key])) {
                    echo render($node->content[$key]);
                }
            }
        }

    ?>

    <?php echo render($page['content_top']); ?>
    <div class="main_body <?php echo $cols; ?>-column clearfix">
        <?php echo render($page['content']); ?>
        <?php echo $sidebar; ?>
    </div>

    <?php echo render($page['pre_footer']); ?>
    <?php echo render($page['footer']); ?>
</main>