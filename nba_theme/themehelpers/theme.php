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


/**
 * Implements theme_double_field().
 * 
 * @return string
 */
function nba_theme_double_field($vars)
{
    $element = $vars['element'];
    $settings = $element['#display']['settings'];

    if ($settings['style'] == 'link') {
        $output = l($element['#item']['first'], $element['#item']['second']);
    } else if ($settings['style'] == 'block') {
        $class = $settings['style'] == 'block' ? 'clearfix' : 'container-inline';
        $output = '<div class="' . $class . '">';
        $output .= '<div class="double-field-first">' . $element['#item']['first'] . '</div>';
        $output .= '<div class="double-field-second">' . $element['#item']['second'] . '</div>';
        $output .= '</div>';
    } else {
        $output = '<span class="double-field-first">';
        $output .= strip_tags($element['#item']['first']);
        $output .= '</span><span class="double-field-second">';
        $output .= strip_tags($element['#item']['second']);
        $output .= '</span>';
    }
    return $output;
}