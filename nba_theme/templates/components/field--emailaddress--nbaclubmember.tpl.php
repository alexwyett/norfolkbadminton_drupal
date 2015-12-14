<?php 
    if (count($items) > 0) {
        ?>
<h3 class="c-title c-title-small">Email address</h3>
<dl class="c-dlist">
    <?php
        foreach ($items as $delta => $item) {
            echo render($item);
        }
    ?>
</dl>
	<?php
    }