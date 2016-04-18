<?php 

if ($teaser) {
?>

<article class="card card-small node-<?php print $node->nid; ?> <?php print $classes; ?> "<?php print $attributes; ?>">
    <div class="card_content">
        <h2 class="c-title c-title-small">
            <?php echo l($node->title, 'node/' . $node->nid); ?>
        </h2>
        <?php 
            echo render($content['body']);
        ?>
    </div>
    <div class="card_action">
        <?php echo l('View Club', 'node/' . $node->nid); ?>
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
            // We hide the comments and links now so that 
            // we can render them later.
            print render($content['body']);
            print render($content['clubvenue']);
            print render($content['clubnight']);
            print render($content['clubmember']);
        ?>
    </div>
</article>
<?php

}