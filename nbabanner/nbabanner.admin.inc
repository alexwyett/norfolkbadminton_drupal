<?php

/**
 * Implements hook_form().
 */
function nbabanner_config_form()
{
    $form['config'] = array(
        '#type' => 'fieldset',
        '#title' => t('Banner config')
    );

    $form['config']['nbabanner_randomise'] = array(
        '#type' => 'checkbox',
        '#title' => t('Randomise banners?'),
        '#default_value' => variable_get('nbabanner_randomise', 0)
    );

    $form['config']['nbabanner_autoplay'] = array(
        '#type' => 'checkbox',
        '#title' => t('Auto play banners?'),
        '#description' => t('This will auto scroll the banners every 5 seconds.'),
        '#default_value' => variable_get('nbabanner_autoplay', 0)
    );

    $form['config']['nbabanner_autoplay_duration'] = array(
        '#type' => 'textfield',
        '#title' => t('Auto play duration in nano seconds'),
        '#default_value' => variable_get('nbabanner_autoplay_duration', 5000),
        '#states' => array(
            'visible' => array(
                ':input[name=nbabanner_autoplay]' => array(
                    'checked' => true
                )
            ),
        )
    );
    
    return system_settings_form($form);
}