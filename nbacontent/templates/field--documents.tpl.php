<?php 
    if (count($items) > 0) {
        ?>
<section class="documents">
    <h2 class="title">Documents available for download</h2>
    <?php
        foreach ($items as $delta => $item) {
            echo render($item);
        }
    ?>
</section>
        <?php
    }