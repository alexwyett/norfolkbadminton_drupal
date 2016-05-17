<?php

/**
 * Return a leagues list
 * 
 * @return array
 */
function nbaleague_get_divisions_list()
{
    $divs = nbaleague_get_divisions_assoc();
    $divs_list = array();
    
    foreach ($divs as $id => $name) {
        $divs_list[] = array(
            'href' => 'nbaleague/matches/list/' . $id,
            'title' => $name
        );
    }
    
    return array(
        'intro' => array(
            '#type' => 'html_tag',
            '#tag' => 'p',
            '#value' => t('Click on a division below to view.')
        ),
        'list' => array(
            '#markup' => theme(
                'links',
                array(
                    'links' => $divs_list
                )
            )
        )
    );
}

/**
 * Return a seasons list
 * 
 * @param integer $division_id Div id
 * 
 * @return array
 */
function nbaleague_get_seasons_list($division_id)
{
    $seasons = nbaleague_get_seasons_assoc();
    $seasons_list = array();
    
    $division = nbaleague_get_division_by_id($division_id);
    
    foreach ($seasons as $id => $name) {
        $seasons_list[] = array(
            'href' => 'nbaleague/matches/list/' . $division_id . '/' . $id,
            'title' => $name
        );
    }
    
    return array(
        'title' => array(
            '#type' => 'html_tag',
            '#tag' => 'h3',
            '#value' => t($division->name->value())
        ),
        'intro' => array(
            '#type' => 'html_tag',
            '#tag' => 'p',
            '#value' => t('Click on a season below to view all the leagues for that season.')
        ),
        'list' => array(
            '#markup' => theme(
                'links',
                array(
                    'links' => $seasons_list
                )
            )
        ),
        'links' => array(
            '#markup' => theme(
                'links',
                array(
                    'links' => _nbaleague_get_links_list($division_id),
                    'attributes' => array()
                )
            )
        )
    );
}

/**
 * Return a leagues list
 * 
 * @param integer $div_id    Division id
 * @param integer $season_id Season id
 * 
 * @return array
 */
function nbaleague_get_leagues_list($div_id, $season_id)
{
    $leagues = nbaleague_get_leagues_assoc();
    $leagues_list = array();
    
    foreach ($leagues as $id => $name) {
        $leagues_list[] = array(
            'href' => 'nbaleague/matches/list/' . $div_id . '/' . $season_id . '/' . $id,
            'title' => $name
        );
    }
    $season = nbaleague_get_season_by_id($season_id);
    
    if (!$season) {
        drupal_not_found();
        drupal_exit();
    }
    
    return array(
        'title' => array(
            '#type' => 'html_tag',
            '#tag' => 'h3',
            '#value' => t($season->name->value() . ' Season')
        ),
        'intro' => array(
            '#type' => 'html_tag',
            '#tag' => 'p',
            '#value' => t('Click on a league below to view.')
        ),
        'list' => array(
            '#markup' => theme(
                'links',
                array(
                    'links' => $leagues_list
                )
            )
        ),
        'links' => array(
            '#markup' => theme(
                'links',
                array(
                    'links' => _nbaleague_get_links_list($div_id),
                    'attributes' => array()
                )
            )
        )
    );
}

/**
 * Return a seasons list
 * 
 * @param integer $division_id Division id
 * @param integer $season_id   Season id
 * @param integer $league_id   League id
 * 
 * @return array
 */
function nbaleague_get_matches_list($division_id, $season_id, $league_id)
{
    $matches = nbaleague_get_matches_from_data(array(
        'league_id' => $league_id,
        'season_id' => $season_id
    ));

    $league = nbaleague_get_league_by_id($league_id);
    $season = nbaleague_get_season_by_id($season_id);
    
    if (!$league || !$season) {
        drupal_not_found();
        drupal_exit();
    }
    
    $admin = user_access('nbaleague_score');
    $matchadmin = user_access('nbaleague_match');
    
    $match_rows = array();

    $header = array(
        'Date',
        'Home Team',
        'Away Team',
        'Results'
    );

    if ($admin === true || $matchadmin === true) {
        array_push(
            $header, 
           t('Admin')
        );
    }

    while ($match = $matches->fetch()) {
        $score = nbaleague_get_formatted_scores_from_match_id($match->match_id);

        $match_row = array(
            date('jS M Y', $match->match_date),
            nbaleague_get_team_by_id($match->hometeam_id)->name->value(),
            nbaleague_get_team_by_id($match->awayteam_id)->name->value(),
            $score
        );
        
        $adminLinks = '';

        if ($admin === true) {
            $adminLinks .= l(
                (strlen($score) > 0 ? 'Edit' : 'Add') . ' score',
                'nbaleague/score/' . $match->match_id
            );
        }
        
        if ($matchadmin === true) {
            $adminLinks .= ' ' . l(
                'Edit match',
                'nbaleague/match/' . $match->match_id
            );
        }

        if (strlen($adminLinks) > 0) {
            array_push($match_row, $adminLinks);
        }

        $match_rows[] = $match_row;
    }

    return array(
        'title' => array(
            '#type' => 'html_tag',
            '#tag' => 'h3',
            '#value' => t($league->name->value())
        ),
        'intro' => array(
            '#type' => 'html_tag',
            '#tag' => 'p',
            '#value' => t('League fixtures for the ' . $season->name->value() . ' season.')
        ),
        'links' => _nbaleague_match_list_links(
            $matches,
            $division_id,
            $season_id,
            $league_id,
            'table'
        ),
        'matches' => array(
            '#markup' => theme_table(
                array(
                    'header' => $header,
                    'rows' => $match_rows,
                    'attributes' => array(
                        'class' => array(
                            'c-table',
                            'c-table-bordered',
                            'c-table-striped'
                        )
                    ),
                    'caption' => '',
                    'colgroups' => array(),
                    'sticky' => false,
                    'empty' => 'No matches found'
                )
            )
        )
    );
}

/**
 * Return a league table
 * 
 * @param integer $division_id Division id
 * @param integer $season_id   Season id
 * @param integer $league_id   League id
 * 
 * @return array
 */
function nbaleague_get_matches_table($division_id, $season_id, $league_id)
{
    $matches = nbaleague_get_matches_from_data(array(
        'league_id' => $league_id,
        'season_id' => $season_id
    ));

    $league = nbaleague_get_league_by_id($league_id);
    $season = nbaleague_get_season_by_id($season_id);
    
    if (!$league || !$season) {
        drupal_not_found();
        drupal_exit();
    }
    
    $header = array(
        'Team',
        'Matches played',
        'Games for',
        'Games Against',
        'Points'
    );

    return array(
        'title' => array(
            '#type' => 'html_tag',
            '#tag' => 'h3',
            '#value' => t($league->name->value())
        ),
        'intro' => array(
            '#type' => 'html_tag',
            '#tag' => 'p',
            '#value' => t('League table for the ' . $season->name->value() . ' season.')
        ),
        'links' => _nbaleague_match_list_links(
            $matches,
            $division_id,
            $season_id,
            $league_id,
            'list'
        ),
        'matches' => array(
            '#markup' => theme_table(
                array(
                    'header' => $header,
                    'rows' => nbaleague_get_league_table_data($matches),
                    'attributes' => array(
                        'class' => array(
                            'c-table',
                            'c-table-bordered',
                            'c-table-fixed',
                            'c-table-striped'
                        )
                    ),
                    'caption' => '',
                    'colgroups' => array(),
                    'sticky' => false,
                    'empty' => 'No matches found'
                )
            )
        )
    );
}
