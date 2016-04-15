<?php

function nbaleague_match_config_form(
    $form,
    &$form_state,
    $match_id = null,
    $div_id = null,
    $season_id = null,
    $league_id = null
) {
    $match = array();
    $match_date = null;
    if ($match_id) {
        $match = nbaleague_get_match_from_data(array('match_id' => $match_id));
        
        if (count($match) > 0) {
            $match_date = array(
                'year' => date('Y', $match['match_date']),
                'month' => date('n', $match['match_date']),
                'day' => date('d', $match['match_date'])
            );
            $league_id = $match['league_id'];
            $season_id = $match['season_id'];
            $form['match_id'] = array(
                '#type' => 'hidden'
            );
        }
    }
    
    $form['hometeam_id'] = array(
        '#type' => 'select',
        '#title' => 'Home team',
        '#description' => 'Select the team playing the match at their home venue.',
        '#options' => nbaleague_get_clubteams_assoc(),
        '#required' => true
    );
    
    $form['awayteam_id'] = array(
        '#type' => 'select',
        '#title' => 'Away team',
        '#description' => 'Select the home teams opponents.',
        '#options' => nbaleague_get_clubteams_assoc(),
        '#required' => true
    );
    
    if (!$div_id) {
        $form['division_id'] = array(
            '#type' => 'select',
            '#title' => 'Division',
            '#description' => 'Target division.',
            '#options' => nbaleague_get_divisions_assoc(),
            '#required' => true,
            '#default_value' => $div_id
        );
    } else {
        $form['division_id'] = array(
            '#type' => 'hidden',
            '#value' => $div_id
        );
    }
    
    $form['league_id'] = array(
        '#type' => 'select',
        '#title' => 'League',
        '#description' => 'Target league.  Select a league you want to add this match to.',
        '#options' => nbaleague_get_leagues_assoc(),
        '#required' => true,
        '#default_value' => $league_id
    );
    
    $form['season_id'] = array(
        '#type' => 'select',
        '#title' => 'Season',
        '#description' => 'Target season.  Select a season you want to add this match to.',
        '#options' => nbaleague_get_seasons_assoc(),
        '#required' => true,
        '#default_value' => $season_id
    );
    
    foreach (array_keys($form) as $key) {
        if (isset($match[$key])) {
            $form[$key]['#default_value'] = $match[$key];
        }
    }
    
    $form['match_date'] = array(
        '#type' => 'date',
        '#title' => 'Match date',
        '#description' => 'Date of match.',
        '#required' => true,
        '#default_value' => $match_date
    );

    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => (count($match) > 0) ? t('Update') : t('Submit'),
    );
    
    if ($season_id && $league_id) {
        $form['backtomatches'] = _nbaleague_match_list_links(
            array(),
            $div_id,
            $season_id,
            $league_id
        );
    }

    return $form;
}

/**
 * Validate a match entry
 * 
 * @param array $form       Form array
 * @param array $form_state Form state (values)
 * 
 * @return void
 */
function nbaleague_match_config_form_validate($form, &$form_state)
{
    if ($form_state['values']['hometeam_id'] == $form_state['values']['awayteam_id']) {
        form_set_error('home_team', 'Home and away teams must be different.');
    }
    
    $dupe_match = array(
        'hometeam_id' => $form_state['values']['hometeam_id'],
        'awayteam_id' => $form_state['values']['awayteam_id'],
        'league_id' => $form_state['values']['league_id'],
        'season_id' => $form_state['values']['season_id']
    );
    
    if (!isset($form_state['values']['match_id']) 
        && nbaleague_get_match_from_data($dupe_match)
    ) {
        form_set_error('home_team', 'There is already a match set between these teams in this league and season.');
    }
}

/**
 * Submit a match entry
 * 
 * @param array $form       Form array
 * @param array $form_state Form state (values)
 * 
 * @return void
 */
function nbaleague_match_config_form_submit($form, &$form_state)
{
    if (isset($form_state['values']['match_id'])) {
        $numUpdated = nbaleague_update_match(
            $form_state['values']['match_id'],
            $form_state['values']
        );
        
        if ($numUpdated === 1) {
            drupal_set_message('Match updated!');
        }
    } else if (nbaleague_add_match($form_state['values'])) {
        drupal_set_message('Match added!');
    }
}

/**
 * Delete a match entry
 * 
 * @param array $form       Form array
 * @param array $form_state Form state (values)
 * 
 * @return void
 */
function nbaleague_deletematch_form($form, &$form_state, $match_id = null)
{
    $form['match_id'] = array(
        '#type' => 'value',
        '#value' => $match_id,
    );

    return confirm_form(
        $form,
        t('Are you sure you want to delete this match?'),
        'nbaleague/match/' . $match_id,
        t('This action cannot be undone.'),
        t('Delete'),
        t('Cancel')
    );
}

/**
 * Delete a match entry submit handler
 * 
 * @param array $form       Form array
 * @param array $form_state Form state (values)
 * 
 * @return void
 */
function nbaleague_deletematch_form_submit($form, &$form_state)
{
    if (nbaleague_delete_match($form_state['values']['match_id'])) {
        drupal_set_message('Match deleted!');
    }

    $form_state['redirect'] = 'nbaleague/match';
}