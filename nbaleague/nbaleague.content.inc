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
                'Back to matches',
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
        
        while ($match = $matches->fetch()) {
            $match = array(
                date('dS m Y', $match->match_date),
                nbaleague_get_team_by_id($match->hometeam_id)->name->value(),
                nbaleague_get_team_by_id($match->awayteam_id)->name->value(),
                ''
            );
            
            if ($admin === true) {
                array_push(
                    $match, 
                    l('Add score', '')
                );
            }
            
            $match_rows[] = $match;
        }
        
        return array(
            'intro' => array(
                '#type' => 'html_tag',
                '#tag' => 'p',
                '#value' => t('Showing all matches in date order')
            ),
            'matches' => array(
                '#markup' => theme_table(
                    array(
                        'header' => array(
                            'Date',
                            'Home Team',
                            'Away Team',
                            'Results'
                        ),
                        'rows' => $match_rows,
                        'attributes' => array(
                            'class' => array(
                                'c-table',
                                'c-table-matches'
                            )
                        ),
                        'caption' => '',
                        'colgroups' => array(),
                        'sticky' => true
                    )
                )
            ),
            'back' => array(
                '#markup' => l(
                    'Back to Seasons',
                    'nbaleague/matches/list/' . $league_id
                )
            )
        );
    } else {
        return array(
            'nonefound' => array(
                '#type' => 'html_tag',
                '#tag' => 'p',
                '#value' => t('No matches found')
            )
        );
    }
}