<article class="card card-small node-<?php print $node->nid; ?> <?php print $classes; ?> "<?php print $attributes; ?>">
    <div class="card_content">
        <h2 class="c-title c-title-small">
            <?php echo $node->title; ?>
        </h2>
        <?php 
            print render($content);
        ?>
    </div>
</article>