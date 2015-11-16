<?php
    $links = nbacontent_get_social_media_links(
        url(
            current_path(),
            array('absolute' => true)
        )
    );
    
    if (count($links) > 0) {
        ?>
<h3 class="c-title c-title-small spreadtheword">Spread the word</h3>
        <?php
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