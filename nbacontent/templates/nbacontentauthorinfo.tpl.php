<div class="media">
    <?php
        if ($author->picture) {
            ?>
    <div class="pull-left">
        <?php
            echo theme_image_style(
                array(
                    'style_name' => 'author',
                    'height' => '100',
                    'width' => '100',
                    'path' => $author->picture->uri,
                    'alt' => $author->name
                )
            );
        ?>
    </div>
            <?php
        }

    ?>
    <div class="media-body">
        <h4 class="media-heading">
            <small>Written by</small><span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                <span itemprop="name">
                    <?php echo $author->name; ?>
                </span>
            </span>
        </h4>
        <p>
            <?php
                echo  strip_tags($author->signature, ',<br><a><strong><em>') ;
            ?>
        </p>
    </div>
</div>