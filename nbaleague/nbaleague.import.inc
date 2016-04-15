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
    
    $form['division'] = array(
        '#type' => 'select',
        '#title' => 'Division',
        '#description' => 'Target division.  Select a division you wish to import fixtures for.',
        '#options' => nbaleague_get_divisions_assoc(),
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
 * Submit handler for the import form
 * 
 * @param array $form       Form array
 * @param array $form_state Form state (values)
 * 
 * @return void
 */
function nbaleague_import_config_form_submit($form, &$form_state)
{
    if (isset($form_state['values']['matches'])) {
        $file = file_load($form_state['values']['matches']);
        if ($file && property_exists($file, 'uri')) {
            $path = drupal_realpath($file->uri);
            $csv = array_map('str_getcsv', file($path));
            array_walk($csv, function(&$a) use ($csv) {
              $a = array_combine($csv[0], $a);
            });
            array_shift($csv);
            
            // To save memory, get all teams, Leagues and Seasons here
            $leagues = nbaleague_get_leagues_assoc();
            array_walk($leagues, function(&$ele, $i) {
                $ele = strtolower($ele);
            });
            $league_id = $form_state['values']['league'];
            
            $seasons = nbaleague_get_seasons_assoc();
            array_walk($seasons, function(&$ele, $i) {
                $ele = strtolower($ele);
            });
            $season_id = $form_state['values']['season'];
            
            $teams = nbaleague_get_teams_assoc();
            array_walk($teams, function(&$ele, $i) {
                $ele = strtolower($ele);
            });
            
            if (count($leagues) == 0) {
                form_set_error(
                    'league',
                    'Division does not contain any leagues.  Make sure you have selected the correct division.'
                );
            }
            
            if ($csv) {
                $pointer = 0;
                $rows = array();
                foreach ($csv as $row) {
                    if ($pointer == 0 && !isset($row['Date'])) {
                        form_set_error(
                            'matches',
                            'Date header not present in first row of csv.'
                        );
                        return;
                    }
                    
                    $data = array();
                    $data['match_date'] = $row['Date'];
                    if (isset($row['League'])) {
                        if (in_array(strtolower($row['League']), $leagues)) {
                            $league_id = array_flip($leagues)[strtolower($row['League'])];
                        } else {
                            form_set_error(
                                'matches',
                                'Import error! Row ' . $pointer . ' has an invalid league (' . $row['League'] . ')' 
                            );
                            return;
                        }
                        if (isset($row['Season'])) {
                            if (in_array(strtolower($row['Season']), $seasons)) {
                                $season_id = array_flip($seasons)[strtolower($row['Season'])];
                            } else {
                                form_set_error(
                                    'matches',
                                    'Import error! Row ' . $pointer . ' has an invalid season (' . $row['Season'] . ')' 
                                );
                                return;
                            }
                        }
                    }
                    $data['league_id'] = $league_id;
                    $data['season_id'] = $season_id;
                    $data['division_id'] = intval($form_state['values']['division']);
                    
                    if (isset($row['Home Team'])) {
                        if (in_array(strtolower($row['Home Team']), $teams)) {
                            $data['hometeam_id'] = array_flip($teams)[strtolower($row['Home Team'])];
                        } else {
                            form_set_error(
                                'matches',
                                'Import error! Row ' . $pointer . ', the home team cannot be found (' . $row['Home Team'] . ')' 
                            );
                            return;
                        }
                    } else {
                        form_set_error(
                            'matches',
                            'Import error! Row ' . $pointer . ' has no home team (' . $row['Home Team'] . ')' 
                        );
                        return;
                    }
                    
                    if (isset($row['Away Team'])) {
                        if (in_array(strtolower($row['Away Team']), $teams)) {
                            $data['awayteam_id'] = array_flip($teams)[strtolower($row['Away Team'])];
                        } else {
                            form_set_error(
                                'matches',
                                'Import error! Row ' . $pointer . ', the away team cannot be found (' . $row['Away Team'] . ')' 
                            );
                            return;
                        }
                    } else {
                        form_set_error(
                            'matches',
                            'Import error! Row ' . $pointer . ' has no away team (' . $row['Away Team'] . ')' 
                        );
                        return;
                    }
                    
                    if (isset($data['hometeam_id']) 
                        && isset($data['awayteam_id'])
                        && $data['hometeam_id'] == $data['awayteam_id']
                    ) {
                        form_set_error(
                            'matches',
                            'Import error! Row ' . $pointer . ' Home and Away teams are the same (' . $row['Away Team'] . ')' 
                        );
                        return;
                    }
                    
                    if (isset($row['Home Team Score']) 
                        && isset($row['Away Team Score'])
                        && strlen($row['Home Team Score']) > 0
                        && strlen($row['Away Team Score']) > 0
                        && is_numeric($row['Home Team Score'])
                        && is_numeric($row['Away Team Score'])
                    ) {
                        $data['hometeam_score'] = $row['Home Team Score'];
                        $data['awayteam_score'] = $row['Away Team Score'];
                    }
                    
                    $rows[$pointer] = $data;
                    $pointer++;
                }
                
                foreach ($rows as $row) {
                    $match_id = nbaleague_add_match($row);
                    
                    if (isset($row['hometeam_score'])) {
                        nbaleague_add_score($match_id, $row);
                    }
                }
                
                drupal_set_message(count($rows) . ' added!');
            } else {
                form_set_error(
                    'matches',
                    'Unable to parse CSV data.'
                );
                return;
            }
        } else {
            form_set_error(
                'matches',
                'Unable to parse CSV data.'
            );
            return;
        }
    }
}

/**
 * Remove the upload button.
 */
function nbaleague_upload_element_process($element, &$form_state, $form)
{
    $element = file_managed_file_process($element, $form_state, $form);
    $element['upload_button']['#access'] = FALSE;
    return $element;
}