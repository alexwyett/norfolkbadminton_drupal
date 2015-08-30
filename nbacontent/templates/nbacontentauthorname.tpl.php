<?php if ($author->uid != '0') { ?>
	<p class="meta">
	    <span class="authorname" itemprop="author">Written by <?php echo $author->name; ?> on </span>
	    <?php if ($node->created): ?>
	        <time>
	            <span class="day-l"><?php echo date('l', $node->created); ?> </span>
	            <span class="day-j"><?php echo date('j', $node->created); ?><sup><?php echo date('S', $node->created); ?></sup></span>
	            <span class="day-M"><?php echo date('M', $node->created); ?> </span>
	            <span class="day-Y"><?php echo date('Y', $node->created); ?></span>
	        </time>
	    <?php endif; ?>
    </p>
<?php }