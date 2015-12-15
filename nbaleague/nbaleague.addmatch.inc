<?php

function nbaleague_addmatch_config_form($form, &$form_state)
{
    $form['home_team'] = array(
        '#type' => 'select',
        '#title' => 'Home team',
        '#description' => 'Select the team playing the match at their home venue.',
        '#options' => nbaleague_get_clubteams_assoc(),
        '#required' => true
    );
    
    $form['away_team'] = array(
        '#type' => 'select',
        '#title' => 'Away team',
        '#description' => 'Select the home teams opponents.',
        '#options' => nbaleague_get_clubteams_assoc(),
        '#required' => true
    );
    
    $form['league'] = array(
        '#type' => 'select',
        '#title' => 'League',
        '#description' => 'Target league.  Select a league you want to add this match to.',
        '#options' => nbaleague_get_leagues_assoc(),
        '#required' => true
    );
    
    $form['season'] = array(
        '#type' => 'select',
        '#title' => 'Season',
        '#description' => 'Target season.  Select a season you want to add this match to.',
        '#options' => nbaleague_get_seasons_assoc(),
        '#required' => true
    );

    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Submit'),
    );

    return $form;
}