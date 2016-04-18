<?php 

if ($teaser) {
    echo render($content);
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
            // We hide the comments and links now so that we can render them later.
            hide($content['comments']);
            print render($content);
        ?>
    </div>
</article>
<?php

}