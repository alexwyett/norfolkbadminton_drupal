<div class="o-media authorname">
    <?php
        if ($author->picture) {
            ?>
    <div class="o-media_left">
        <?php
            echo theme_image_style(
                array(
                    'style_name' => 'thumbnail',
                    'height' => '100',
                    'width' => '100',
                    'path' => $author->picture->uri,
                    'alt' => $author->name,
                    'attributes' => array(
                        'class' => 'circle'
                    )
                )
            );
        ?>
    </div>
            <?php
        }

    ?>
    <div class="o-media_body">
        <?php
            if ($author && $author->name != '') {
        ?>
        <h4 class="c-title c-title-small">
            <small>Written by</small><span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                <span itemprop="name">
                    <?php echo $author->name; ?>
                </span>
            </span>
        </h4>
        <p>
            <?php
                echo strip_tags($author->signature, ',<br><a><strong><em>') ;
            ?>
        </p>
        <?php
            }
        ?>

        <?php
            echo theme('nbacontentsocialtags');
        ?>
    </div>
</div>