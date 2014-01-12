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
<?php $author = get_user_by('id', get_query_var('author')); ?>
<div id="sidebar" class="stream-sidebar author-sidebar post-sidebar">
    <div class="sidebar-inner meta-author">
        <a class="meta-author-avatar" title="<?php echo exa_properize($author->display_name); ?> Profile" href="<?php echo get_bloginfo('url'); ?>/author/<?php echo $author->user_login; ?>">
			<?php echo get_wp_user_avatar(get_the_author_meta('ID'), 'small-thumbnail'); ?>
		</a>
        <h1 class="author-title"><?php printf( __( '%s', 'twentythirteen' ), $author->display_name ); ?></h2>
        <span class="author-position"><?php echo (hrld_author_has('hrld_current_position', $author->ID) ? get_hrld_author('hrld_current_position', $author->ID):'The Badger Herald'); ?></span>
        <?php if(hrld_author_has('hrld_twitter_handle', $author->ID)){ ?><a href="https://twitter.com/<?php hrld_author('hrld_twitter_handle', $author->ID); ?>"><span class="author-twitter">@<?php hrld_author('hrld_twitter_handle', $author->ID); ?></span></a><?php } ?>
        <div class="sidebar-scroll clearfix">
			<?php if(hrld_author_has('hrld_staff_description', $author->ID)){ ?><span class="author-description"><?php hrld_author('hrld_staff_description', $author->ID); ?></span><?php } ?>
            <?php if(hrld_author_has('hrld_staff_extension', $author->ID)){ ?><span class="author-extension">Extension <?php hrld_author('hrld_staff_extension', $author->ID); ?></span><?php } ?>
            <?php if(hrld_author_has('hrld_staff_semesters', $author->ID)){ ?><span class="author-semesters"><?php hrld_author('hrld_staff_semesters', $author->ID); ?> semesters at The Badger Herald.</span><?php } ?>
        </div>
    </div><!-- class="inner-sidebar" -->
</div><!-- id="sidebar" -->