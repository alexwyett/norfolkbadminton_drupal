<div class="c-block <?php echo $block->delta; ?>">
    <?php if (isset($block->title) && $block->title && $block->title != '<none>'): ?>
        <h2 class="c-title c-block_title"><?php print $block->title; ?></h2>
    <?php endif; ?>
    <div class="c-block_content">
        <?php print $content; ?>
    </div>
</div>