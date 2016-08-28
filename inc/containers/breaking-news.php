<?php
/**
 * container: breaking news container
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
$container = $GLOBALS['container'] ?: new container('breaking-news');

if ($my_query->have_posts()) :
    while ( $my_query->have_posts() ) : $my_query->the_post();  ?>
        
        <?php $currentTime = time(); 
        $local_timestamp = get_the_modified_time('U');
        $seconds = 86400; 
        if (($currentTime - $local_timestamp)  < $seconds) : ?>
       
            <div class="<?php echo $container->classes(); ?>">
                <div class="wrapper">
                    <a href="<?php the_permalink(); ?>" class="link">
                        <span class="breaking-tag">Breaking:</span>    
                        <?php the_title(); ?>
                        <span class="updated">Updated: <?php the_modified_time() ?></span>
                    </a>  
                </div>
            </div>

<?php 
        endif;
        
    endwhile;
endif;
