<?php

    echo render($page['header']);

    $sidebar = render($page['sidebar']);
    $cols = (strlen($sidebar) > 0) ? 'two' : 'one';

?>
<div class="<?php echo $cols; ?>-column">
	<?php echo $sidebar; ?>
	<?php echo render($page['content']); ?>
</div>
<?php
    
    include_once 'components/footer.tpl.php';