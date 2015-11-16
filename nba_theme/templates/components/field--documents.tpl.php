<?php 
    if (count($items) > 0) {
        ?>
<div class="c-block documents">
    <h2 class="c-block_title c-title">Documents available for download</h2>
    <div class="c-block_content">
        <?php
            foreach ($items as $delta => $item) {
                echo render($item);
            }
        ?>
    </div>
</div>
        <?php
    }