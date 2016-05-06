<div class="media authorname">
    <?php
        if ($author->picture) {
            ?>
    <div class="pull-left">
        <?php
            echo theme_image_style(
                array(
                    'style_name' => 'thumbnail',
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
            <time class="<?php echo $dateClass; ?>" itemprop="datePublished">
                <span class="c-date_day"><?php echo date('j', $date); ?></span>
                <span class="c-date_month"><?php echo date('M', $date); ?></span>
                <span class="c-date_year"><?php echo date('Y', $date); ?></span>
            </time>
        </h4>
        <p>
            <?php
                echo  strip_tags($author->signature, ',<br><a><strong><em>') ;
            ?>
        </p>
    </div>
</div>