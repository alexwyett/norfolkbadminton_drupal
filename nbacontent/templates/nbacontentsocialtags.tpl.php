<?php
    $links = nbacontent_get_social_media_links(
        url(
            current_path(),
            array('absolute' => true)
        )
    );
    
    if (count($links) > 0) {
        echo theme(
            'nbacontent_sm_links',
            array(
                'links' => $links,
                'attrs' => array(
                    'class' => 'sharingicons'
                ),
                'container_tag' => 'div'
            )
        );
    }