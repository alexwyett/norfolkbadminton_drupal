<div class="c-list <?php echo $block->delta; ?>">
    <?php if (isset($block->title) && $block->title && $block->title != '<none>'): ?>
    <h2 class="c-title"><?php echo l($block->title, 'news'); ?></small></h2>
    <?php endif; ?>
    <div class="block_content">
        <?php print $content; ?>
    </div>
</div>