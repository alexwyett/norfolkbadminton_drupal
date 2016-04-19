<?php 
    if (count($items) > 0) {
        foreach ($items as $delta => $item) {
            echo theme(
                'image_style',
                array(
                    'style_name' => 'medium',
                    'path' => $item['#item']['uri'],
                    'alt' => $item['#item']['alt'],
                    'title' => $item['#item']['title']
                )
            );
        }
    }