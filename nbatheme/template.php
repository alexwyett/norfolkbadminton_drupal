<?php


/**
 * Override or insert variables into the html template.
 *
 * @param array $vars Template variables
 */
function nbatheme_preprocess_html(&$vars)
{
    drupal_add_js(
        '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js',
        array(
            'type' => 'external'
        )
    );
}

/**
 * Update jQuery
 * 
 * @param type $javascript
 * 
 * @return void
 */
function nbatheme_js_alter(&$javascript)
{
    $jquery_path = drupal_get_path('theme', 'nbatheme') . '/js/vendor/jquery-1.11.3.min.js';
    $javascript[$jquery_path] = $javascript['misc/jquery.js'];
    $javascript[$jquery_path]['version'] = '1.11.3';
    $javascript[$jquery_path]['data'] = $jquery_path;
    unset($javascript['misc/jquery.js']);
}