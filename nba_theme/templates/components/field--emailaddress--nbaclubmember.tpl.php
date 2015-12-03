<?php 
    if (count($items) > 0) {
        ?>
<h3 class="c-title c-title-medium">Email address</h3>
        <?php
        foreach ($items as $delta => $item) {
            echo render($item);
        }
    }