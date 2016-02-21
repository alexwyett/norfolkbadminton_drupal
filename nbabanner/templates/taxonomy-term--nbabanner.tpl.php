<?php

foreach ($nbabanner_image as $img) {
    $url = image_style_url('nba_banner', $img['uri']);
    echo l(
        sprintf(
            '<img src="%s" alt="%s" title="%s" longdesc="%s">',
            $url,
            $img['alt'],
            $img['title'],
            $description
        ),
        (count($nbabanner_link) > 0) ? $nbabanner_link[0]['value'] : '',
        array(
            'html' => true,
            'attributes' => array(
                'class' => array(
                    'nbabanner_banner'
                )
            )
        )
    );
}