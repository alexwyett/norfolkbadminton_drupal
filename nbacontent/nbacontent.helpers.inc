<?php

/**
 * Implements hook_theme_registry_alter()
 *
 * @param array $theme_registry
 *
 * @return void
 */
function nbacontent_theme_registry_alter(&$theme_registry)
{
    _nbacontent_theme_registry_alter($theme_registry, 'nbacontent');
}

/**
 * Return a specified taxonomy.  This function will store the taxonomy in memory to save
 * repeated requests to the database.
 * 
 * @param string  $taxName    Taxonomy name
 * @param boolean $returnTerm Return a term object instead
 * 
 * @return array
 */
function nbacontent_get_vocabulary($taxName, $returnTerm = false)
{
    static $nbaVocab;
    if (!isset($nbaVocab)) {
        $nbaVocab = array();
    }
    
    if (!isset($nbaVocab[$taxName])) {
        $nbaVocab[$taxName] = array();
        $vocab = taxonomy_vocabulary_machine_name_load($taxName);
        
        foreach (taxonomy_get_tree($vocab->vid) as $tax) {
            $term = taxonomy_term_load($tax->tid);
            
            if ($returnTerm === false) {
                $nbaVocab[$taxName][$tax->tid] = entity_metadata_wrapper('taxonomy_term', $term);
            } else {
                $nbaVocab[$taxName][$tax->tid] = $term;
            }
        }
    }
    
    return $nbaVocab[$taxName];
}

/**
 * Implements hook_theme_registry_alter()
 * 
 * @param array $theme_registry
 * 
 * @return void
 */
function _nbacontent_theme_registry_alter(&$theme_registry, $module_name) {
    $mod_path = drupal_get_path('module', $module_name);
    $theme_registry_copy = $theme_registry; // munge on a copy
    _theme_process_registry(
        $theme_registry_copy,
        'phptemplate',
        'theme_engine',
        'pow',
        $mod_path . '/templates'
    );
    
    $theme_registry += array_diff_key($theme_registry_copy, $theme_registry);
    
    $hooks = array('node');
    foreach ($hooks as $h) {
        _nbacontent_insert_after_first_element(
            $theme_registry[$h]['theme paths'],
            $mod_path
        );
    }
}

/**
 * Helper function for re-ordering arrays (needed by theme_registry_alter)
 * 
 * @return void
 */
function _nbacontent_insert_after_first_element(&$a, $element)
{
    if (is_array($a)) {
        $first_element = array_shift($a);
        array_unshift($a, $first_element, $element);
    }
}

/**
 * Get the title from the current menu object
 *
 * @param string $path System path
 *
 * @return boolean|string
 */
function _nbacontent_get_menu_object_title($path = null)
{
    $item = menu_get_item($path);
    $title = false;
    if (isset($item['title_callback']) && isset($item['page_arguments'])) {
        $title = call_user_func_array(
            $item['title_callback'],
            $item['page_arguments']
        );
    }

    return $title;
}