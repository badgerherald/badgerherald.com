<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<?php 
    $author = get_user_by('id', get_query_var('author')); 
    $bio = get_the_author_meta('description', get_query_var('author'));
?>
<div id="sidebar" class="author-sidebar">
    <div class="sidebar-inner meta-author">
        <a class="meta-author-avatar" title="<?php echo exa_properize($author->display_name); ?> Profile" href="<?php echo get_bloginfo('url'); ?>/author/<?php echo $author->user_login; ?>">
            <?php echo get_wp_user_avatar(get_the_author_meta('ID', get_query_var('author')), 'small-thumbnail')?>
            <?php //echo get_wp_user_avatar($author->ID, 'small-thumbnail')?>
        </a>
        <h1 class="author-title"><?php printf( __( '%s', 'twentythirteen' ), $author->display_name ); ?></h1>
        <span class="author-position"><?php echo (hrld_author_has('hrld_current_position', $author->ID) ? get_hrld_author('hrld_current_position', $author->ID):'The Badger Herald'); ?></span>
        <?php if(hrld_author_has('hrld_twitter_handle', $author->ID)){ ?>
        
        <a href="https://twitter.com/<?php hrld_author('hrld_twitter_handle', $author->ID); ?>" class="twitter-follow-button" data-show-count="false">Follow @<?php hrld_author('hrld_twitter_handle', $author->ID); ?></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <?php } ?>
        <div class="sidebar-scroll author-detail clearfix">
            <?php if(hrld_author_has('hrld_staff_description', $author->ID)){ ?><span class="author-description"><?php hrld_author('hrld_staff_description', $author->ID); ?></span><?php } ?>
            <?php if(hrld_author_has('hrld_staff_extension', $author->ID)){ ?><span class="author-extension">Extension <?php hrld_author('hrld_staff_extension', $author->ID); ?></span><?php } ?>
            <?php if(hrld_author_has('hrld_staff_semesters', $author->ID)){ ?><span class="author-semesters"><?php hrld_author('hrld_staff_semesters', $author->ID); if(get_hrld_author('hrld_staff_semesters', $author->ID) == 1) echo ' semester'; else echo ' semesters';?>  at The Badger Herald.</span><?php } ?>
            <?php if($bio != '') echo '<br /><span class=author-bio style=padding-right:40px;>'.$bio.'</span>'; ?>
        </div>
    </div><!-- class="inner-sidebar" -->
    <?php
        //author-gallery
            $attachments = array();
            $args = array(
                'post_type' => 'attachment',
                'post_status' => 'inherit',
                'meta_key' => '_hrld_media_credit',
                'meta_value' => get_the_author_meta('user_nicename', get_query_var('author')),
                'posts_per_page' => 6
            );
            $query = new WP_Query( $args );
            $author = get_user_by('id', get_query_var('author')); 

            if ( $query->have_posts() ) : 
            ?>
            <div class="author-gallery">
            <h3>Photos by <?php printf( __( '%s', 'twentythirteen' ), $author->display_name ); ?> <a href="#">View All</a></h3>
            <ul>
            <?php
                /* The loop */ 
                while ( $query->have_posts() ) : 
                    $query->the_post();
                    $attachments[] = $post->ID;
                    ?>
                    <li><a href="<?php the_permalink(); ?>" class="" target="_blank">
                    <?php
                    echo wp_get_attachment_image($post->ID, array(150,150));
                    ?>
                    </a></li>
                    <?php 
                endwhile;
            wp_reset_postdata(); ?>
            </ul>
            </div>
            <?php   
            endif;
        ?>
   

</div><!-- id="sidebar" -->

