<?php
/**
 * Block: breaking news block
 * Description: Displays breaking news post if exists
 *
 */
    $query_args = array(
    'showposts'     => 1,
    'post_status'   => 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'importance',
            'field' => 'slug',
            'terms' => 'breaking'
            )
        )
    );
    $my_query = new WP_Query( $query_args );

    if ($my_query->have_posts()) :
        while ( $my_query->have_posts() ) : $my_query->the_post();  ?>
            
            <?php $currentTime = time(); 
            $local_timestamp = get_the_time('U');
            $seconds = 86400; 
            if (($currentTime - $local_timestamp)  < $seconds) : ?>
           
                <div class="block breaking-news-block" >
                    <div class="wrapper">
                        <span class="BreakingBox">
                         breaking news:
                           </span>    
                        <span class="postbox">
                            <a href="<?php the_permalink(); ?>" class="link">
                             <?php the_title(); ?>
                            </a>
        
                            <span class="updated">UPDATED: <?php the_time(); ?></span>
                                
                        </span>
                        <div style="clear: both;"></div>
                    </div>
                </div>
           <?php endif; ?>
    <?php
        endwhile;
    endif;
    ?>

