<?php 

if ($teaser) {

    $thumbnail = render($content['thumbnail']);
?>

<article class="card card-medium node-<?php print $node->nid; ?> <?php print $classes; ?> "<?php print $attributes; ?>">
    <?php
        if (strlen($thumbnail) > 0) {
            ?>
    <div class="card_image">
        <?php echo l($thumbnail, 'node/' . $node->nid, array('html' => true)); ?>
    </div>
            <?php
        }
    ?>
    <div class="card_content">
        <h2 class="c-title c-title-small">
            <?php echo l($node->title, 'node/' . $node->nid); ?>
        </h2>
        <?php 
            echo render($content['body']);
        ?>
    </div>
    <div class="card_action">
        <?php echo l('Read more', 'node/' . $node->nid); ?>
    </div>
</article>

<?php

} else {

?>

<article class="nbacontent node-<?php print $node->nid; ?> <?php print $classes; ?> "<?php print $attributes; ?>>
    <?php
        echo render($content['banners']);
        echo render($content['nba_cat']);
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
            echo theme('nbacontentauthorinfo', array('author' => $node_author));
        ?>
    </div>
</article>
<div class="region-sidebar">
    <?php echo render($content['documents']); ?>
</div>
<?php

}