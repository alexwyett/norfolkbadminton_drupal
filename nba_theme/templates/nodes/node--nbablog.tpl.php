<?php 

if ($teaser) {
    $thumbnail = render($content['thumbnail']);
    $hasThumbnail = strlen($thumbnail) > 0;
?>

<article class="media nbacontent blog-item nbacontent-teaser <?php echo ($hasThumbnail) ? 'nbacontent-thumbnail' : ''; ?> node-<?php print $node->nid; ?> <?php print $classes; ?>  clearfix"<?php print $attributes; ?>">
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
                'nbacontentauthorname',
                array(
                    'author' => $node_author,
                    'node' => $node,
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
        <h2 class="blog_title">
            <?php echo $title; ?>
            <time class="blog_date" itemprop="datePublished">
                <strong><?php echo date('j', $node->created); ?></strong>
                <small><?php echo date('M', $node->created); ?></small>
            </time>
        </h2>

        <?php
            echo theme('nbacontentsocialtags');
        ?>
        <?php 
            echo render($content['body']);
            
            // We hide the comments and links now so that we can render them later.
            hide($content['comments']);
            hide($content['links']);
            hide($content['tags']);
            hide($content['thumbnail']);
            print render($content);
        ?>
    </div>
</article>

<?php

}