<?php

    echo render($page['header']);

    echo render($page['nav']);

    $sidebar = render($page['sidebar']);
    $cols = (strlen($sidebar) > 0) ? 'two' : 'one';

?>

<div class="<?php echo $cols; ?>-column clearfix">
	<?php echo render($page['content']); ?>
	<?php echo $sidebar; ?>
</div>

<?php
    
    include_once 'components/footer.tpl.php';