<?php

function nbaleague_import_config_form($form, &$form_state)
{
    $form['matches'] = array(
        '#title' => t('CSV matches import file'),
        '#type' => 'managed_file',
        '#description' => t(
            'You can add a csv file of matches in here.  If the first row and first cell of the csv 
            file is not a date, it is assumed that the first line of the csv is a header.
            The columns must be match_date, hometeam_id, awayteam_id.'
        ),
        '#upload_validators' => array(
            'file_validate_extensions' => array('csv')
        ),
    	'#process' => array('nbaleague_upload_element_process'),
        '#required' => true
    );
    
    $form['league'] = array(
        '#type' => 'select',
        '#title' => 'League',
        '#description' => 'Target league.  Select a league you wish to import fixtures for.',
        '#options' => nbaleague_get_leagues_assoc(),
        '#required' => true
    );
    
    $form['season'] = array(
        '#type' => 'select',
        '#title' => 'Season',
        '#description' => 'Target season.  Select a season you wish to import fixtures for.',
        '#options' => nbaleague_get_seasons_assoc(),
        '#required' => true
    );

    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Submit'),
    );

    return $form;
}

/**
 * Remove the upload button.
 */
function nbaleague_upload_element_process($element, &$form_state, $form)
{
  	$element = file_managed_file_process($element, $form, $form_state);
  	$element['upload_button']['#access'] = FALSE;
  	return $element;
}