<?php

/**
 * Remove the taxonomy term description field
 * 
 * Implements hook_form_FORM_ID_alter
 */
function toccresponsivebanner_form_taxonomy_form_term_alter(&$form, &$form_state)
{
    if (is_array($form['#term'])
        && array_key_exists('vocabulary_machine_name', $form['#term'])
        && (
            $form['#term']['vocabulary_machine_name'] == 'toccrb'
        )
    ) {
        $form['relations']['#access'] = false;
        $form['redirect']['#access'] = false;
        $form['path']['#access'] = false;
        @$form['metatags']['#access'] = false;
        
        $form['toccrb_strapline_position'][LANGUAGE_NONE]['#title'] = 'Link text position';
        $form['toccrb_strapline_position']['#weight'] = 46;
        $form['toccrb_strapline_position']['und']['#description'] = t('This option determines where the link text should be positioned in order to show the image better in a responsive environment');
    }
}