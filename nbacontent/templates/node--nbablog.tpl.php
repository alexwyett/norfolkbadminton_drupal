<?php if ($teaser) {
    $thumbnail = render($content['thumbnail']);
    $hasThumbnail = strlen($thumbnail) > 0;
    ?>
    <article class="media nbablog blog-item nbablog-teaser <?php echo ($hasThumbnail) ? 'nbablog-thumbnail' : ''; ?> node-<?php print $node->nid; ?> <?php print $classes; ?>  clearfix"<?php print $attributes; ?>">
        <time class="date" itemprop="datePublished">
            <strong><?php echo date('j', $node->created); ?></strong>
            <small><?php echo date('M', $node->created); ?></small>
        </time>
        <div class="article-body">
            <h2 class="title">
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