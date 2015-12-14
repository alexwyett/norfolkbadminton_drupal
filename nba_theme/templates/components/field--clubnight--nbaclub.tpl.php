<?php 
    if (count($items) > 0) {
        ?>
<h2 class="c-title c-title-medium">Club nights</h2>
<dl class="c-dlist">
    <?php
        foreach ($items as $delta => $item) {
            echo render($item);
        }
    ?>
</dl>
        <?php
    }