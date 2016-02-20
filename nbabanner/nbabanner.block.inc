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
        $block['content']['#markup'] = theme(
            $delta,
            array(
                'content' => 'nbabanner_block',
                'banners' => _nbabanner_get_banners(
                    (variable_get('nbabanner_randomise', 0) == '1')
                )
            )
        );
        
        $block['content']['#attached']['js'][] = array(
            'data' => array(
                'nbabanner' => array(
                    'autoplay' => variable_get('nbabanner_autoplay', 0),
                    'autoplay_duration' => (float) variable_get('nbabanner_autoplay_duration', 5000)
                )
            ),
            'type' => 'setting'
        );
        
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
    $banners = nbacontent_get_vocabulary('nbabanner');
    
    $filteredBanners = array_filter($banners, function($ele) {
        return $ele->nbabanner_link_live->value() == 1;
    });
    
    if ($randomise === true) {
        shuffle($filteredBanners);
    }
    
    return $filteredBanners;
}