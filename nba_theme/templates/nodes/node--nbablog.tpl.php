<?php 

if ($teaser) {

    $thumbnail = render($content['thumbnail']);
?>

<article class="card card-medium node-<?php print $node->nid; ?> <?php print $classes; ?> "<?php print $attributes; ?>">
    <?php
        echo render($content['nba_cat']);
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
    <div class="article-body nbacontent_body">
        <h2 class="c-title c-title-main">
            <?php 
                echo $title;
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
            hide($content['banners']);
            hide($content['nba_cat']);
            print render($content);
        ?>
    </div>
</article>
<?php

}