<?php 

if ($teaser) {
?>

<article class="card card-medium node-<?php print $node->nid; ?> <?php print $classes; ?> "<?php print $attributes; ?>">
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
            // We hide the comments and links now so that we can render them later.
            hide($content['comments']);
            print render($content);
        ?>

        <?php
            echo theme('nbacontentauthorinfo', array('author' => $node_author));
        ?>
    </div>
</article>
<?php

}