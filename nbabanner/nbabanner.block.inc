<?php

/**
 * Implements hook_block_info().
 * 
 * @return array
 */
function nbabanner_block_info()
{
    $blocks['nbabanner_block'] = array(
        'info' => t('NBA Banners: Block'),
        'cache' => DRUPAL_CACHE_PER_ROLE
    );
    return $blocks;
}

/**
 * Implements hook_block_view().
 *
 * Prepares the contents of the block.
 * 
 * @return array
 */
function nbabanner_block_view($delta = '')
{
    $block = array();
    
    switch($delta) {
    case 'nbabanner_block':        
        $block['subject'] = t('NBA Banners: Block');
        $block['content'] = array(
            'container' => array(
                '#type' => 'fieldset',
                '#title' => 'NBA Banners: Block',
                '#attributes' => array(
                    'class' => array(
                        'nbabanners'
                    )
                )
            )
        );
        
        foreach (_nbabanner_get_banners((variable_get('nbabanner_randomise', 0) == '1')) as $index => $banner) {
            $term = taxonomy_term_view($banner);
            $block['content']['container']['nbabanner' . $index] = array(
                '#markup' => render($term)
            );
        }
        
        
        $block['content']['#attached']['css'][] = drupal_get_path(
            'module',
            'nbabanner'
        ) . '/vendor/flickity.css';
        $block['content']['#attached']['css'][] = drupal_get_path(
            'module',
            'nbabanner'
        ) . '/css/nbabanner.css';
        
        $block['content']['#attached']['js'][] = drupal_get_path(
            'module',
            'nbabanner'
        ) . '/vendor/flickity.js';
        $block['content']['#attached']['js'][] = array(
            'data' => array(
                'nbabanner' => array(
                    'autoplay' => variable_get('nbabanner_autoplay', 0),
                    'autoplay_duration' => (float) variable_get('nbabanner_autoplay_duration', 5000)
                )
            ),
            'type' => 'setting'
        );
        $block['content']['#attached']['js'][] = drupal_get_path(
            'module',
            'nbabanner'
        ) . '/js/nbabanner.js';
        
        break;
    }
    
    return $block;
}

/**
 * Return the banner taxonomy
 * 
 * @return array
 */
function _nbabanner_get_banners($randomise = false)
{
    $banners = nbacontent_get_vocabulary('nbabanner', true);
    
    $filteredBanners = array_filter($banners, function($ele) {
        return $ele->nbabanner_link_live['und'][0]['value'] == 1;
    });
    
    if ($randomise === true) {
        shuffle($filteredBanners);
    }
    
    return $filteredBanners;
}