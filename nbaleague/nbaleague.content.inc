<?php

/**
 * Return a leagues list
 * 
 * @return array
 */
function nbaleague_get_leagues_list()
{
    $leagues = nbaleague_get_leagues_assoc();
    $leagues_list = array();
    
    foreach ($leagues as $id => $name) {
        $leagues_list[] = array(
            'href' => 'nbaleague/matches/list/' . $id,
            'title' => $name
        );
    }
    
    return array(
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
        )
    );
}

/**
 * Return a seasons list
 * 
 * @param integer $league_id League id
 * 
 * @return array
 */
function nbaleague_get_seasons_list($league_id)
{
    $seasons = nbaleague_get_seasons_assoc();
    $seasons_list = array();
    
    foreach ($seasons as $id => $name) {
        $seasons_list[] = array(
            'href' => 'nbaleague/matches/list/' . $league_id . '/' . $id,
            'title' => $name
        );
    }
    
    return array(
        'intro' => array(
            '#type' => 'html_tag',
            '#tag' => 'p',
            '#value' => t('Click on a season below to view all the matches.')
        ),
        'list' => array(
            '#markup' => theme(
                'links',
                array(
                    'links' => $seasons_list
                )
            )
        ),
        'back' => array(
            '#markup' => l(
                'Back to leagues',
                'nbaleague/matches/list'
            )
        )
    );
}

/**
 * Return a seasons list
 * 
 * @param integer $league_id League id
 * @param integer $season_id Season id
 * 
 * @return array
 */
function nbaleague_get_matches_list($league_id, $season_id)
{
    $matches = nbaleague_get_matches_from_data(array(
        'league_id' => $league_id,
        'season_id' => $season_id
    ));
    
    $admin = user_access('nbaleague_score');
    
    if ($matches->rowCount() > 0) {
        $match_rows = array();
        
        $header = array(
            'Date',
            'Home Team',
            'Away Team',
            'Results'
        );
        
        if ($admin === true) {
            array_push(
                $header, 
               t('Admin')
            );
        }
        
        while ($match = $matches->fetch()) {
            
            $score = nbaleague_get_formatted_scores_from_match_id($match->match_id);
            
            $match_row = array(
                date('dS m Y', $match->match_date),
                nbaleague_get_team_by_id($match->hometeam_id)->name->value(),
                nbaleague_get_team_by_id($match->awayteam_id)->name->value(),
                $score
            );
            
            if ($admin === true) {
                array_push(
                    $match_row, 
                    l(
                        (strlen($score) > 0 ? 'Edit' : 'Add') . ' score',
                        'nbaleague/score/' . $match->match_id
                    ) . ' ' . l(
                        'Edit match',
                        'nbaleague/match/' . $match->match_id
                    )
                );
            }
            
            $match_rows[] = $match_row;
        }
        
        $league = nbaleague_get_league_by_id($league_id);
        $season = nbaleague_get_season_by_id($season_id);
        
        return array(
            'intro' => array(
                '#type' => 'html_tag',
                '#tag' => 'p',
                '#value' => t($league->name->value() . ' league fixtures for the ' . $season->name->value() . ' season.')
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
                        'sticky' => true,
                        'empty' => ''
                    )
                )
            ),
            'links' => _nbaleague_match_list_links($matches, $league_id, $season_id)
        );
    } else {
        return array(
            'nonefound' => array(
                '#type' => 'html_tag',
                '#tag' => 'p',
                '#value' => t('No matches found')
            ),
            'links' => _nbaleague_match_list_links(array(), $league_id, $season_id)
        );
    }
}

/**
 * Return a league table
 * 
 * @param integer $league_id League id
 * @param integer $season_id Season id
 * 
 * @return array
 */
function nbaleague_get_matches_table($league_id, $season_id)
{
    $matches = nbaleague_get_matches_from_data(array(
        'league_id' => $league_id,
        'season_id' => $season_id
    ));
    
    if ($matches->rowCount() > 0) {
        $header = array(
            'Team',
            'Matches played',
            'Games for',
            'Games Against',
            'Points'
        );
        
        $league = nbaleague_get_league_by_id($league_id);
        $season = nbaleague_get_season_by_id($season_id);
        
        return array(
            'intro' => array(
                '#type' => 'html_tag',
                '#tag' => 'p',
                '#value' => t($league->name->value() . ' league table for the ' . $season->name->value() . ' season.')
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
                                'c-table-striped'
                            )
                        ),
                        'caption' => '',
                        'colgroups' => array(),
                        'sticky' => true,
                        'empty' => ''
                    )
                )
            ),
            'links' => _nbaleague_match_list_links($matches, $league_id, $season_id, 'list')
        );
    } else {
        return array(
            'links' => _nbaleague_match_list_links(array(), $league_id, $season_id, 'list')
        );
    }
}