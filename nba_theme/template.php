<?php

require_once 'themehelpers/theme.php';
require_once 'themehelpers/form.php';

/**
 * Override or insert variables into the html template.
 *
 * @param array $vars Template variables
 */
function nba_theme_preprocess_html(&$vars)
{
    drupal_add_js(
        drupal_get_path('theme', 'nba_theme') . '/js/vendor/modernizr.min.js'
    );
}

/**
 * Update jQuery
 * 
 * @param type $javascript
 * 
 * @return void
 */
function nba_theme_js_alter(&$javascript)
{
    $jquery_path = drupal_get_path('theme', 'nba_theme') . '/js/vendor/jquery-1.11.3.min.js';
    $javascript[$jquery_path] = $javascript['misc/jquery.js'];
    $javascript[$jquery_path]['version'] = '1.11.3';
    $javascript[$jquery_path]['data'] = $jquery_path;
    unset($javascript['misc/jquery.js']);
}