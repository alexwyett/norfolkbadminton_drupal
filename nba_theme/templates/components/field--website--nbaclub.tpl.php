<?php 
    if (count($items) > 0) {
        ?>
<h2 class="c-title c-title-medium">Website</h2>
    <?php
        foreach ($items as $delta => $item) {
            $website = parse_url(render($item));
            
            if (!isset($website['scheme'])) {
                $website['scheme'] = 'http';
            }
            
            if (!isset($website['path'])) {
                $website['path'] = '';
            }
            
            if (!isset($website['host'])) {
                $website['host'] = '';
            }
            
            $url = $website['scheme'] . '://' . $website['host'] . $website['path'];
            
            echo sprintf(
                '<p><a href="%s" target="_new">%s</a></p>',
                $url,
                $url
            );
        }
    }