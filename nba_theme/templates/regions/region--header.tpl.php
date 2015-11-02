<?php

/**
 * @file
 * Default theme implementation to display a region.
 *
 * Available variables:
 * - $content: The content for this region, typically blocks.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the following:
 *   - region: The current template type, i.e., "theming hook".
 *   - region-[name]: The name of the region with underscores replaced with
 *     dashes. For example, the page_top region would have a region-page-top class.
 * - $region: The name of the region variable as defined in the theme's .info file.
 *
 * Helper variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $is_admin: Flags true when the current user is an administrator.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 *
 * @see template_preprocess()
 * @see template_preprocess_region()
 * @see template_process()
 *
 * @ingroup themeable
 */

global $base_path;
global $theme;
$themePath = $base_path  . drupal_get_path('theme', 'nbatheme');
$localThemePath = $base_path  . drupal_get_path('theme', $theme);

?>
<?php if ($content): ?>
    <header class="header header-main <?php print $classes; ?>" itemtype="http://schema.org/WebPage" itemscope>
    	<div class="o-wrapper">
            <a href="<?php echo url('<front>'); ?>" class="main-header_logo logo">
                <img src="<?php echo $localThemePath; ?>/assets/img/logo.png">
            </a>
	    
            <?php print $content; ?>
    	</div>
  </header>
<?php endif;
