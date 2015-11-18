<nav class="c-block <?php echo $block->delta; ?> block-menu-block">
    <?php if (isset($block->title) && $block->title && $block->title != '<none>'): ?>
        <?php echo render($title_prefix); ?>
        <h2 class="c-title c-block_title"><?php print $block->title; ?></h2>
        <?php echo render($title_suffix); ?>
    <?php endif; ?>
    <div class="c-block_content">
        <?php print $content; ?>
    </div>
</nav>