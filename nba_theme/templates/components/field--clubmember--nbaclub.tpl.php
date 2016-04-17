<?php 
    if (count($items) > 0) {
        ?>
<div class="cardlist cardlist-two-col">
    <h2 class="c-title c-title-medium">Club Members</h2>
    <?php
        foreach ($items as $delta => $item) {
            $ids = array_keys($item['node']);
            $item['node'][$ids[0]]['#node']->title = '<span>' . strip_tags($item['#prefix']) . '</span>' . $item['node'][$ids[0]]['#node']->title;
            unset($item['#prefix']);
            echo render($item);
        }
    ?>
</div>
        <?php
    }