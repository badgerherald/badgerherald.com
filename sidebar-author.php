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
<?php echo '<pre>'.$author->twitter_handle.'</pre>'; ?>
<div id="sidebar" class="stream-sidebar author-sidebar post-sidebar">
    <div class="sidebar-inner meta-author">
        <a class="meta-author-avatar" title="<?php echo exa_properize($author->display_name); ?> Profile" href="<?php echo get_bloginfo('url'); ?>/author/<?php echo $author->user_login; ?>">
			<?php echo get_wp_user_avatar(get_the_author_meta('ID'), 'small-thumbnail'); ?>
		</a>
        <h1 class="author-title"><?php printf( __( '%s', 'twentythirteen' ), $author->display_name ); ?></h2>
        <span class="author-position">The Badger Herald</span>
		<span class="author-twitter">@willhaynes</span>
        <div class="sidebar-scroll">
        	<div class="author-description">
                <p class="author-bio">
                    <?php echo $author->description; ?>
                </p>
            </div><!-- .author-description -->
        </div><!-- .author-info -->
    </div><!-- class="inner-sidebar" -->
</div><!-- id="sidebar" -->