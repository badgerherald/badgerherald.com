<div id="pullout">
    <?php get_search_form( true );  ?>
    <div class="nav-list">
        <ul id="main-nav">
            <li class="popular-posts active" data-post-list="popular"><a>Popular</a></li>
            <li data-post-list="news"><a href="<?php echo (is_home() ? '#news' : get_bloginfo('url').'/news/'); ?>">News</a></li>
            <li data-post-list="oped"><a href="<?php echo (is_home() ? '#opinion' : get_bloginfo('url').'/oped/'); ?>">Opinion</a></li>
            <li data-post-list="artsetc"><a href="<?php echo (is_home() ? '#artsetc' : get_bloginfo('url').'/artsetc/'); ?>">ArtsEtc.</a></li>
            <li data-post-list="sports"><a href="<?php echo (is_home() ? '#sports' : get_bloginfo('url').'/sports/'); ?>">Sports</a></li>
            <li data-post-list="null"><a href="<?php bloginfo('url'); ?>/shoutouts/">Shoutouts</a></li>
            <li data-post-list="null" class="about-off"><a href="<?php bloginfo('url'); ?>/about/">About</a></li>
            <li data-post-list="null"><a href="http://themadisonmisnomer.com/">Misnomer</a></li>
            <li data-post-list="null"><a href="<?php bloginfo('url'); ?>/advertise/">Advertise</a></li>
        </ul>
    </div>
    <div class="nav-stream-container">
        <?php
        $beats_queries = array(
            'news' => array(),
            'artsetc' => array(),
            'oped' => array(),
            'sports' => array()
        );
        foreach ($beats_queries as $stream_beat => $stream_beat_query) {
        ?>
        <div class="nav-stream" data-post-list="<?php echo $stream_beat; ?>">
            <?php
            /* Get featured post */
            $args = array();
            $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => array($stream_beat),
                        'operator' => 'IN'
                    ), array(
                        'taxonomy' => 'importance',
                        'field' => 'slug',
                        'terms' => array('featured'),
                        'operator' => 'IN'
                    )
                );
            $args['posts_per_page'] = 1;
            $beats_queries[$stream_beat]['featured'] = new WP_Query( $args );
            $beats_queries[$stream_beat]['exclude'] = array();
            while( $beats_queries[$stream_beat]['featured']->have_posts() ) {
                $beats_queries[$stream_beat]['featured']->the_post();

                /* get content-block-featured.php */
                //get_template_part( 'content', 'block-featured' );

                $beats_queries[$stream_beat]['exclude'][] = $post->ID;
            }
            wp_reset_postdata();

            /* Get recent posts */
            $args = array();
            $args['posts_per_page'] = 5;
            $args['post__not_in'] = $beats_queries[$stream_beat]['exclude'];
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => array($stream_beat),
                    'operator' => 'IN'
                )
            );
            $beats_queries[$stream_beat]['recent'] = new WP_Query( $args );
            while( $beats_queries[$stream_beat]['recent']->have_posts() ) {
                $beats_queries[$stream_beat]['recent']->the_post();

                /* get content-block-thumb.php */
                //get_template_part( 'content', 'block-thumb' );
            }
            wp_reset_postdata();
            ?>
        </div>
        <?php
        } // End foreach
        ?>
    </div>
</div> <!-- END div#pullout -->