<?php 
    if (count($items) > 0) {
        foreach ($items as $delta => $item) {
            $tax = $item['#options']['entity'];
            ?>
<header class="c-category">
    <h3 class="c-category_title" style="background: <?php echo $tax->nba_colour[LANGUAGE_NONE][0]['value']; ?>;"><?php echo $item['#title']; ?></h3>
</header>
            <?php
        }
    }