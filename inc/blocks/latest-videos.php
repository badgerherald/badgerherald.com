<div class="block latest-videos-block">
    <div class="wrapper">
        <h1>Latest Videos</h1>
        <div class="video-list">
        <?php 
            /* Build query for posts with video post-format */
            $args = array();
            $args['post_type'] = 'post';
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'exa_layout',
                    'field' => 'slug',
                    'terms' => array('video')
                    )
                );
            $args['posts_per_page'] = 5;

            $latest_videos_query = new WP_Query($args);

            while ($latest_videos_query->have_posts()) : $latest_videos_query->the_post();

                /* Get the first youtube link within the post */
                $embed_URL = explode(" ", get_the_content());
                $video_ID = explode("?v=", $embed_URL[0]);
                $video_ID = $video_ID[1];
                $thumb_SRC = 'https://img.youtube.com/vi/' . $video_ID . '/hqdefault.jpg';
                $post_title = get_the_title();
                ?>
                <div class="video-post-cotainer">
                    <div class="thumbnail-container">
                        <img src="<?php echo $thumb_SRC; ?>" title="<?php echo $post_title; ?>"
                    </div>
                    <h2 class="video-title"><?php echo $post_title; ?></h2>
                </div>
                <?php
            endwhile;
        ?>
        </div>
    </div>
</div>