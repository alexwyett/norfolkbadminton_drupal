<?php

echo l(
    '<i class="icon icon-' . $type . '"></i><span>' . t($name) . '</span>',
    $link,
    array(
        'attributes' => array(
            'class' => array(
                'smlink-' . $type,
                'smlink'
            ),
            'rel' => 'nofollow',
            'target' => '_blank'
        ),
        'html' => true
    )
);