<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Thirteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<?php 
    $author = get_user_by('id', get_query_var('author')); 
    $bio = get_the_author_meta('description', get_query_var('author'));

    $img_src_id = get_the_author_meta( '_hrld_staff_banner', get_query_var('author') );
    if ($img_src_id != '')  {
        $img_src = wp_get_attachment_image_src($img_src_id, 'author-banner');
        if( $img_src == false)
            $img_src = wp_get_attachment_image_src($img_src_id, 'full');
        exa_full_width_cover_image($img_src[0]);
    }
    $author_media = new HrldMediaQuery($author->user_login);
    $photo_count = $author_media->creditCount();
    $post_count = count_user_posts($author->ID);
    $is_Photographer = $photo_count > $post_count;
?>
<div class="author-info <?php if($img_src_id === '') echo 'no-banner'; ?>">
	<a class="author-avatar" title="<?php echo exa_properize($author->display_name); ?> Profile" href="<?php echo get_bloginfo('url'); ?>/author/<?php echo $author->user_login; ?>">
        <?php exa_mug(get_the_author_meta('ID')) ?>
    </a>
    <h1 class="author-title"><?php printf( __( '%s', 'twentythirteen' ), $author->display_name ); ?></h1>
    <h3 class="author-position"><?php echo (hrld_author_has('hrld_current_position', $author->ID) ? get_hrld_author('hrld_current_position', $author->ID):'The Badger Herald'); ?></h3>
    <?php
    if (hrld_author_has('hrld_twitter_handle', $author->ID)) {
        ?>
        <a href="https://twitter.com/<?php hrld_author('hrld_twitter_handle', $author->ID); ?>" class="twitter-follow-button" data-show-count="false">Follow @<?php hrld_author('hrld_twitter_handle', $author->ID); ?></a>
        <?php
    }
    ?>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    <?php
    if ($photo_count != 0) {
        ?>
        <a href="#media" class="author-media-link switch-view-link<?php if ($is_Photographer) echo ' hidden'; ?>">Photos <span class="count">(<?php echo $photo_count; ?>)</span></a>
        <?php
    }
    if ($post_count != 0) {
        ?>
        <a href="#posts" class="author-posts-link switch-view-link<?php if (!$is_Photographer) echo ' hidden'; ?>">Posts <span class="count">(<?php echo $post_count; ?>)</span></a>
        <?php
    }
    ?>

	<div class="author-detail">
            <?php if(hrld_author_has('hrld_staff_description', $author->ID)){ ?><span class="author-description"><?php hrld_author('hrld_staff_description', $author->ID); ?></span><?php } ?>
            <?php if(hrld_author_has('hrld_staff_extension', $author->ID)){ ?><span class="author-extension">Extension <?php hrld_author('hrld_staff_extension', $author->ID); ?></span><?php } ?>
            <?php if(hrld_author_has('hrld_staff_semesters', $author->ID)){ ?><span class="author-semesters"><?php hrld_author('hrld_staff_semesters', $author->ID); if(get_hrld_author('hrld_staff_semesters', $author->ID) == 1) echo ' semester'; else echo ' semesters';?>  at The Badger Herald.</span><?php } ?>
            <?php if($bio != '') echo '<span class=author-bio>'.$bio.'</span>'; ?>
        </div>
</div>
<?php
if ($is_Photographer) {
    ?>
    <div class="container author-media showcase-block">
        <div class="wrapper">
            <div class="media-list">
            <?php
                while($author_media->query->have_posts() ) : $author_media->query->the_post();
                    ?>
                    <div class="media-thumbnail">
                        <?php echo wp_get_attachment_image(get_the_ID(), 'square', false, array('class'=>'wp-image-'.get_the_ID())); ?>
                    </div>
                    <?php
                endwhile;
            ?>
            </div>
        </div>
    </div>
    <?php
}
if ($post_count != 0) {
?>
<div class="author-posts<?php if ($is_Photographer) echo ' hidden'; ?>">
    <?php
        if (!is_paged()) :
            $best_posts = get_the_author_meta( '_hrld_staff_best_posts', get_the_author_meta('ID', get_query_var('author')) );
            if(!empty($best_posts)):
                $args = array(
                    'post__in' => $best_posts,
                    'post_type' => 'any',
                    'post_status' => array('publish', 'inherit'),
                    'posts_per_page' => 2,
                );
                $query = new WP_Query( $args );
                exa_container('cover-2-column');
            else:
                $best_posts = array();
            endif; 
        endif; // End !is_paged()
    ?>
    <div id="stream" class="author-stream wrapper">

    	
    		
    		<?php
        		if ( have_posts() ) : 
        		 /* The loop */ 
    				while ( have_posts() ) : the_post();
    				get_template_part( 'content', 'summary-fullstream' ); 
    		?>
    		<hr />
    				<?php endwhile; ?>

    				<div class="all-link pagination-link">
                        <div class="author-pagination pagination-prev"><?php previous_posts_link( 'Newer' ); ?></div>
                        <div class="author-pagination pagination-next"><?php next_posts_link( 'Older' ); ?></div>
                    </div>
    		<?php 
    			endif; 
    		?>

    </div><!-- id="stream" -->
</div>
<?php 
} // end if
get_footer('');
?>