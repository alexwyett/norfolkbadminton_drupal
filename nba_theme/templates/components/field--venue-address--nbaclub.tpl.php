<?php 
    if (count($items) > 0) {
        ?>
<h2 class="c-title c-title-medium">Club venue</h2>
<address class="c-address"><?php
        foreach ($items as $delta => $item) {
            echo render($item);
        }
    ?></address>
        <?php
    }