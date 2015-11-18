<?php 

if ($teaser) {
    $thumbnail = render($content['thumbnail']);
    $hasThumbnail = strlen($thumbnail) > 0;
?>

<article class="card media nbacontent blog-item nbacontent-teaser <?php echo ($hasThumbnail) ? 'nbacontent-thumbnail' : ''; ?> node-<?php print $node->nid; ?> <?php print $classes; ?>  clearfix"<?php print $attributes; ?>">
    <time class="blog_date" itemprop="datePublished">
        <strong><?php echo date('j', $node->created); ?></strong>
        <small><?php echo date('M', $node->created); ?></small>
    </time>
    <div class="article-body nbacontent_body">
        <h2 class="blog_title">
            <a href="<?php echo url('node/' . $node->nid); ?>">
                <?php echo $title; ?>&nbsp;&raquo;
                <?php
                    if ($hasThumbnail) {
                        echo $thumbnail;
                    }
                ?>
            </a>
        </h2>
        <?php
            echo theme(
                'nbacontentauthorinfo',
                array(
                    'author' => $node_author
                )
            );
        ?>
        <?php 
            echo render($content['body']);
        ?>
    </div>
</article>

<?php

} else {

?>

<article class="nbacontent node-<?php print $node->nid; ?> <?php print $classes; ?> "<?php print $attributes; ?>>
    <?php
        echo render($content['banners']);
    ?>
    <div class="article-body nbacontent_body">
        <h2 class="c-title c-title-main">
            <?php 
                echo $title;
                
                $date = $node->created;
                $dateClass = 'c-date';
                if ($node->changed > $node->created) {
                    $date = $node->changed;
                    $dateClass .= ' c-date-updated';
                } else { 
                    $dateClass .= ' c-date-created';
                }
            ?>
        </h2>
        <?php 
            echo render($content['body']);
            
            // We hide the comments and links now so that we can render them later.
            hide($content['comments']);
            hide($content['links']);
            hide($content['tags']);
            hide($content['thumbnail']);
            hide($content['documents']);
            print render($content);
        ?>

        <time class="<?php echo $dateClass; ?>" itemprop="datePublished">
            <span class="c-date_day"><?php echo date('j', $date); ?></span>
            <span class="c-date_month"><?php echo date('M', $date); ?></span>
            <span class="c-date_year"><?php echo date('Y', $date); ?></span>
        </time>

        <?php
            echo theme('nbacontentsocialtags');
        ?>
    </div>
</article>

<?php

    echo render($content['documents']);

}