<?php 
    if (count($items) > 0) {
        ?>
<div class="cardlist">
    <h2 class="c-title c-title-medium">Club Members</h2>
    <?php
        foreach ($items as $delta => $item) {

            $ids = array_keys($item['node']);

            $item['node'][$ids[0]]['#node']->title = strip_tags($item['#prefix']) . $item['node'][$ids[0]]['#node']->title;
            unset($item['#prefix']);
            echo render($item);
        }
    ?>
</div>
        <?php
    }