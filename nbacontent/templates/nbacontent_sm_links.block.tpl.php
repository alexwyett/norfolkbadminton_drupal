<?php if (count($links) > 0) { ?>

    <?php if (!$attrs) { $attrs = array(); } ?>

    <<?php echo $container_tag; ?> <?php echo drupal_attributes($attrs); ?>>
        <?php
            echo implode('', $links);
        ?>
    </<?php echo $container_tag; ?>>

<?php }