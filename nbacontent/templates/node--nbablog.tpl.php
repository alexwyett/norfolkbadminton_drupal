<?php if ($teaser) {
    $thumbnail = render($content['thumbnail']);
    $hasThumbnail = strlen($thumbnail) > 0;
    ?>
    <article class="media nbablog nbablog-teaser <?php echo ($hasThumbnail) ? 'nbablog-thumbnail' : ''; ?> node-<?php print $node->nid; ?> <?php print $classes; ?>  clearfix"<?php print $attributes; ?>">
        <?php
            if ($hasThumbnail) {
                ?>
        <div class="pull-left media-left">
            <a href="<?php echo url('node/' . $node->nid); ?>">
                <?php echo $thumbnail; ?>
            </a>
        </div>
                <?php
            }
        ?>
        <div class="media-body">
            <h2 class="media-heading">
                <a href="<?php echo url('node/' . $node->nid); ?>">
                    <?php echo $title; ?>
                </a>
                <?php
                    echo theme(
                        'nbacontentauthorname',
                        array(
                            'author' => $node_author,
                            'node' => $node,
                        )
                    );
                ?>
            </h2>
            <?php 
                echo render($content['body']);
            ?>
        </div>
    </article>

<?php } else { ?>

    <article class="nbablog node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
        <?php
            echo theme(
                'nbacontentauthorname',
                array(
                    'author' => $node_author,
                    'node' => $node,
                )
            );
        
        echo render($content['banners']);
        
        // We hide the comments and links now so that we can render them later.
        hide($content['comments']);
        hide($content['links']);
        hide($content['tags']);
        hide($content['thumbnail']);
        print render($content);

        echo render($content['tags']);
        if ($node_author->uid != '0') {
            echo theme('nbacontentsocialtags');
            echo theme(
                'nbacontentauthorinfo',
                array(
                    'author' => $node_author
                )
            );
        }
    ?>
    </article>

<?php }