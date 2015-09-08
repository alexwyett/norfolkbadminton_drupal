<?php 
    if (count($items) > 0) {
        ?>
<section class="gallery">
        <?php
        foreach ($items as $delta => $item) {
            echo sprintf(
                '<figure class="gallery_item">%s%s</figure>',
                theme(
                    'image_style',
                    array(
                        'style_name' => 'nbabanner',
                        'path' => $item['#item']['uri'],
                        'alt' => $item['#item']['alt'],
                        'title' => $item['#item']['title']
                    )
                ),
                strlen($item['#item']['title']) > 0 ? '<figcaption class="gallery_item_caption"><p>' . $item['#item']['title'] . '</p></figcaption>' : ''
            );
        }
        ?>
</section>
        <?php
    }