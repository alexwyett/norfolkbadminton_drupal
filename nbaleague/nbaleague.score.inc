<?php

function nbaleague_score_config_form($form, &$form_state, $match_id, $score_id = null)
{
    $match = nbaleague_get_match_from_data(array('match_id' => $match_id));
    $score = null;
    
    if (count($match) > 0) {
        $form['match_id'] = array(
            '#type' => 'hidden'
        );
    }
    
    $form['hometeam_score'] = array(
        '#type' => 'number',
        '#title' => 'Home team score',
        '#description' => 'Select the score in games the home team received.',
        '#required' => true
    );
    
    $form['awayteam_score'] = array(
        '#type' => 'number',
        '#title' => 'Home team score',
        '#description' => 'Select the score in games the home team received.',
        '#required' => true
    );
    
    foreach (array_keys($form) as $key) {
        
    }

    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => ($score) ? t('Update') : t('Submit'),
    );

    return $form;
}

/**
 * Validate a score entry
 * 
 * @param array $form       Form array
 * @param array $form_state Form state (values)
 * 
 * @return void
 */
function nbaleague_score_config_form_validate($form, &$form_state)
{
    
}

/**
 * Submit a score entry
 * 
 * @param array $form       Form array
 * @param array $form_state Form state (values)
 * 
 * @return void
 */
function nbaleague_score_config_form_submit($form, &$form_state)
{
    if (isset($form_state['values']['score_id'])) {
        $numUpdated = nbaleague_update_score(
            $form_state['values']['match_id'],
            $form_state['values']
        );
        
        if ($numUpdated === 1) {
            drupal_set_message('Score updated!');
        }
    } else if (nbaleague_add_score($form_state['values'])) {
        drupal_set_message('Score added!');
    }
}

/**
 * Delete a score entry
 * 
 * @param array $form       Form array
 * @param array $form_state Form state (values)
 * 
 * @return void
 */
function nbaleague_deletescore_form($form, &$form_state, $score_id = null)
{
    $form['score_id'] = array(
        '#type' => 'value',
        '#value' => $score_id,
    );

    return confirm_form(
        $form,
        t('Are you sure you want to delete this score?'),
        'admin/config/nba/score/' . $score_id,
        t('This action cannot be undone.'),
        t('Delete'),
        t('Cancel')
    );
}

/**
 * Delete a score entry submit handler
 * 
 * @param array $form       Form array
 * @param array $form_state Form state (values)
 * 
 * @return void
 */
function nbaleague_deletescore_form_submit($form, &$form_state)
{
    if (nbaleague_delete_score($form_state['values']['score_id'])) {
        drupal_set_message('Score deleted!');
    }

    $form_state['redirect'] = 'admin/config/nba/scores';
}