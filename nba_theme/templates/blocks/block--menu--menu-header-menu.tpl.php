<nav class="c-block c-expandable <?php echo $block->delta; ?> block-menu-block">
    <?php if (isset($block->title) && $block->title && $block->title != '<none>'): ?>
        <?php echo render($title_prefix); ?>
        <h2 class="c-title c-expandable_toggle c-block_title"><?php print $block->title; ?></h2>
        <?php echo render($title_suffix); ?>
    <?php endif; ?>
    <div class="c-block_content c-expandable_toggletarget">
        <?php print $content; ?>
    </div>
</nav>