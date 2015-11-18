<figure class="<?php echo $align; ?> card">
    <div class="card_image">
        <?php
            echo theme(
                'image_style',
                array(
                    'style_name' => $imagestyle,
                    'path' => $image->uri,
                    'alt' => $alt,
                    'title' => $title
                )
            );
        ?>
    </div>
    <?php
        if ($title != '') {
            ?>
    <figcaption class="card_content"><?php echo $title; ?></figcaption>
            <?php
        }
    ?>
</figure>