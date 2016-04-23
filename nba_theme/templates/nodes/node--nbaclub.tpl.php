<?php 

if ($teaser) {
?>
    <div class="c-flag c-clubteaser">
        <div class="c-flag_image c-flag_image-top">
            <?php echo render($content['clublogo']); ?>
        </div>
        <div class="c-flag_body c-flag_body-top">
            <h2 class="c-title">
                <?php echo l($node->title, 'node/' . $node->nid); ?>
            </h2>
            <div class="c-clubteaser_body">
                <?php 
                    echo render($content['body']);
                ?>
                <div class="grid-wrap nbclub_attributes columned clearfix">
                    <?php
                        if (isset($meta['venues']) && count($meta['venues']) > 0) {
                            ?>
                    <dl class="c-dlist grid-col md-col-half">
                        <?php
                            foreach ($meta['venues'] as $nid => $venue) {
                                echo sprintf(
                                    '<dt><i class="icon icon-location"></i></dt><dd>%s</dd>',
                                    l($venue, 'node/' . $nid)
                                );
                            }
                        ?>
                    </dl>
                            <?php
                            unset($meta['venues']);
                        }

                        if (count($meta) > 0) {
                            ?>
                    <dl class="c-dlist grid-col md-col-half">
                        <?php
                            if (isset($meta['juniors']) && $meta['juniors'] === true) {
                                echo '<dt class="juniors"><i class="icon icon-checkmark"></i></dt><dd>Junior club</dd>';
                            }
                            if (isset($meta['coaching']) && $meta['coaching'] === true) {
                                echo '<dt class="coaching"><i class="icon icon-checkmark"></i></dt><dd>Coaching available</dd>';
                            }
                            if (isset($meta['clubmarked'])) {
                                echo '<dt class="clubmarked"><i class="icon icon-checkmark"></i></dt><dd>' . $meta['clubmarked'] . ' accredited</dd>';
                            }
                        ?>
                    </dl>
                        <?php
                    }
                        ?>
                </div>
            </div>
        </div>
    </div>
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
            print render($content['body']);
        ?>
        <div class="nbclub_attributes clearfix">
            <?php
                if (count($meta) > 0) {
                    ?>
            <dl class="c-dlist">
                <?php
                    if (isset($meta['juniors']) && $meta['juniors'] === true) {
                        echo '<dt class="juniors"><i class="icon icon-checkmark"></i></dt><dd>Junior club</dd>';
                    }
                    if (isset($meta['coaching']) && $meta['coaching'] === true) {
                        echo '<dt class="coaching"><i class="icon icon-checkmark"></i></dt><dd>Coaching available</dd>';
                    }
                    if (isset($meta['clubmarked'])) {
                        echo '<dt class="clubmarked"><i class="icon icon-checkmark"></i></dt><dd>' . $meta['clubmarked'] . ' accredited</dd>';
                    }
                ?>
            </dl>
                <?php
                }
                ?>
        </div>
        <?php 
            print render($content['clubvenue']);
            print render($content['clubnight']);
            print render($content['clubmember']);
        ?>
    </div>
</article>
<?php

}