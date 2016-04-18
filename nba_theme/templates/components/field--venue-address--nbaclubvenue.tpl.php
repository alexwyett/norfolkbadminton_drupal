<?php 
    if (count($items) > 0) {
    ?>
<h2 class="c-title c-title-medium">Venue Address</h2>
    <?php
        foreach ($items as $delta => $item) {
            echo '<address class="c-address">' . render($item) . '</address>';
        }
    }