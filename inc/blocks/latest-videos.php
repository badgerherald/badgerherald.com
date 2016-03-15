<div class="block latest-videos-block">
    <div class="wrapper">
        <div class="block-title">
            <h2>Latest Videos</h2>
            <hr />
            <div class="subscribers">
                <script src="https://apis.google.com/js/platform.js"></script>
                <div class="g-ytsubscribe" data-channel="badgerherald" data-layout="default" data-count="default"></div>
            </div>
        </div>
        <div class="videos">
        <?php 
            /* Build query for posts with video post-format */
            $args = array();
            $args['post_type'] = 'post';
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'exa_layout',
                    'field' => 'slug',
                    'terms' => array('media-video')
                    )
                );
            $args['posts_per_page'] = 5;

            $latest_videos_query = new WP_Query($args);

            while ($latest_videos_query->have_posts()) : $latest_videos_query->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="post">
                    <div class="video-post">
                        <div class="thumbnail">
                            <?php the_post_thumbnail('post-thumbnail'); ?>
                        </div>
                        <h3 class="title"><?php the_title() ?></h3>
                    </div>
                </a>
                <?php
            endwhile;
        ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>