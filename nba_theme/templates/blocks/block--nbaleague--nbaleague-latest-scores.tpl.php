<div class="c-list <?php echo $block->delta; ?>">
    <?php if (isset($block->title) && $block->title && $block->title != '<none>'): ?>
        <h2 class="c-title"><?php print $block->title; ?></h2>
    <?php endif; ?>
    <div class="c-list_content">
        <?php print $content; ?>
    </div>
</div>