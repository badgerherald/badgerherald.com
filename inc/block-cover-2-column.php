<?php
/** 
 * Two column cover block
 * 
 */

global $block;

?>
<div class="block cover-2-column-block">
    <span class="context-label">COVER 2 COLUMN BLOCK</span>
    <div class="wrapper">
    <?php
        while ($block->query->have_posts()) : $block->query->the_post(); 
    ?>
        <div class="cover-block">
            <?php the_title(); ?>
        </div>
    <?php
        endwhile;
    ?>
    </div>
</div>