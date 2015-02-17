<div class="block cover-2-column-block">
    <span class="context-label">COVER 2 COLUMN BLOCK</span>
    <div class="wrapper">
    <?php
        while ($args["query"]->have_posts()) : $args["query"]->the_post(); 
    ?>
        <div class="cover-block">
            <?php the_title(); ?>
        </div>
    <?php
        endwhile;
    ?>
    </div>
</div>