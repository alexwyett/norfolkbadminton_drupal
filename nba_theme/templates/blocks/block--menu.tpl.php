<nav class="block <?php echo $block->delta; ?> block-menu-block">
    <?php if (isset($block->title) && $block->title && $block->title != '<none>'): ?>
        <h2 class="title"><?php print $block->title; ?></h2>
    <?php endif; ?>
    <div class="block_content">
        <?php print $content; ?>
    </div>
</nav>