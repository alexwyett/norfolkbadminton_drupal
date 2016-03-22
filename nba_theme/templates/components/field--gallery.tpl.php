<?php 
    if (count($items) > 0) {
        ?>
    <div class="cardlist">
        <?php
        foreach ($items as $delta => $item) {
            ?>
        <figure class="card">
            <div class="card_image">
                <?php
                    echo theme(
                        'image_style',
                        array(
                            'style_name' => 'large',
                            'path' => $item['#item']['uri'],
                            'alt' => $item['#item']['alt'],
                            'title' => $item['#item']['title']
                        )
                    );

                    if ($item['#item']['title'] != '') {
                        ?>
                <figcaption class="card_content"><?php echo $item['#item']['title']; ?></figcaption>
                        <?php
                    }
                ?>
                
            </div>
        </figure>
            <?php
        }
        ?>
    </div>
        <?php
    }