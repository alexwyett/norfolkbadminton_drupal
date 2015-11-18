<?php

/**
 * Implements hook_theme()
 *
 * Defines the theme hooks provided by this module
 */
function nba_theme_theme($existing, $type, $theme, $path)
{
    return array(
        'nbacontentsocialtags' => array(
            'variables' => array(),
            'template' => 'templates/components/nbasocialtags'
        ),
        'nbacontentauthorinfo' => array(
            'variables' => array(
                'author' => NULL
            ),
            'template' => 'templates/components/nbacontentauthorinfo'
        )
    );
}