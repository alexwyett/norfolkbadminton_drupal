<?php

/**
 * Form overrides
 * 
 * @param array $form       Form api array
 * @param array $form_state State of form
 * @param string $form_id   Form id
 * 
 * @return void
 */
function nba_theme_form_alter(&$form, &$form_state, $form_id)
{
    if ($form_id == 'search_block_form') {
        $form['search_block_form']['#attributes']['placeholder'] = 'Search';
        $form['search_block_form']['#attributes']['autocomplete'] = 'off';
    }
}