<div class="block <?php echo $block->delta; ?> sitesearch">
    <?php if (isset($block->title) && $block->title && $block->title != '<none>'): ?>
        <h2 class="title"><?php print $block->title; ?></h2>
    <?php endif; ?>
    <div class="block_content">
        <?php print $content; ?>
        <a href="#" class="sitesearch_btn icon icon-search" id="dosearch"></a>
    </div>
</div>