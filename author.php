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

get_header('author'); ?>

<script>
jQuery(document).ready(function(){
	var banner = jQuery('#hrld_author_top_banner'),
		target_width = banner.parent().width(),
		target_height = (banner.attr('banner_ratio')) * target_width;
	
	banner.css( 'width', '100%');
	banner.css( 'height', target_height);
	
	jQuery('html, body').animate({
		scrollTop: (banner.offset().top) - (jQuery('.page-container-masthead').height()),
	},800);
	
	if( jQuery('.endless-flow-link').length == 0){
		jQuery('#stream articles').append('<article class="article-post"><h1 class="entry-title">There are not articles or posts to load here.</h1></article>');
	}
	
	var sidebar_height = jQuery('#sidebar').css('height');
	jQuery('#stream').css('min-height',sidebar_height);
	
	
	jQuery('#author-stream-nav a').click(function(e){
		e.preventDefault();
		var postType = jQuery(this).attr('post'),
			author = "<?php echo get_the_author_meta( 'user_login', get_query_var('author') ); ?>";
		
		window.location.replace('/author/'+author+'/'+postType);
	});
});

</script>
<?php 
	$img_src_id = get_the_author_meta( '_hrld_staff_banner', get_query_var('author') );
	if ($img_src_id != '')	{
		$img_src = wp_get_attachment_image_src($img_src_id, 'author-banner');
		if( $img_src == false)
			$img_src = wp_get_attachment_image_src($img_src_id, 'full');
		$url = $img_src[0];
		$width = $img_src[1];
		$height = $img_src[2];
		$hwRatio = $height/$width;
		if( $hwRatio > 0.31 )
			$hwRatio = 0.31;
		/**
		*
		* his is now being taken care of through jQuery.
		*
		* if ( isset( $content_width ) ) {
		* 	$width = $content_width - 10;
		* 	$height = $hwRatio * $width;
		* }
		*
		**/
		echo '<div id=hrld_author_top_banner banner_ratio ='.$hwRatio. ' class=hrld_author_top_banner style="background-position: center; background-repeat: no-repeat; background-position: center; background-image: url(\''.$url.'\'); background-size: cover; width: 100%; height: '.$height.'px"> </div>';
	}
?>

<?php get_sidebar('author'); ?>	
<div id="stream" class="author-stream">
		<?php
			$attachments = array();
			$args = array(
				'post_type' => 'attachment',
				'post_status' => 'inherit',
				'meta_key' => '_hrld_media_credit',
				'meta_value' => get_the_author_meta('user_nicename', get_query_var('author')),
				'posts_per_page' => -1,
				'nopaging' => true,
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) : 
			?>
			<div class="author-stream-gallery">
			<?php
				/* The loop */ 
				while ( $query->have_posts() ) : 
					$query->the_post();
					$attachments[] = get_the_ID();
					?>
					<div><a href="<?php the_permalink(); ?>" class="" target="_blank">
					<?php
					echo wp_get_attachment_image($post->ID, array(150,150));
					?>
					</a></div>
					<?php 
				endwhile;?>
			</div>
			<?php	
			endif;
			wp_reset_postdata();
		?>
		<?php
			$hasArticles = false;
			$best_posts = get_the_author_meta( '_hrld_staff_best_posts', get_the_author_meta('ID', get_query_var('author')) );
			if(!empty($best_posts)):
		?>
	<articles class="best-articles">
		<?php
			$args = array(
				'post__in' => get_the_author_meta( '_hrld_staff_best_posts', get_the_author_meta('ID', get_query_var('author')) ),
				'post_type' => 'any',
				'post_status' => array('publish', 'inherit'),
				'posts_per_page' => 3,
				'nopaging' => true,
			);
			$query = new WP_Query( $args );
    		if ( $query->have_posts() ) : 
    			$hasArticles = true;
    	 		echo "<h2>best articles</h2>";
    		 /* The loop */ 
				while ( $query->have_posts() ) : $query->the_post();
					if( $post_category != '' && $post_category == ('attachment' || 'featured')) :
						if( exa_is_featured() && $post_category == 'attachment') continue;
						else if( get_post_type()  == 'attachment' && $post_category == 'featured') continue;
					endif;
				get_template_part( 'content', 'summary-endless-flow' ); 
		?>
		<hr />
				<?php endwhile; ?>
			<?php endif; wp_reset_postdata(); ?>
	</articles>
	<?php endif; ?>
	<articles>
		
		<?php
			$args = array(
				'post__not_in' => get_the_author_meta( '_hrld_staff_best_posts', get_the_author_meta('ID', get_query_var('author')) ),
				'author' => get_the_author_meta('ID', get_query_var('author')),
				'post_type' => 'post',
				'posts_per_page' => 3,
				'nopaging' => true,
			);
			$query = new WP_Query( $args );
    		if ( $query->have_posts() ) : 
    			$hasArticles = true;
    	 		echo "<h2>articles</h2>";
    		 /* The loop */ 
				while ( $query->have_posts() ) : $query->the_post();
					if( $post_category != '' && $post_category == ('attachment' || 'featured')) :
						if( exa_is_featured() && $post_category == 'attachment') continue;
						else if( get_post_type()  == 'attachment' && $post_category == 'featured') continue;
						else if( in_array(get_the_ID(), $attachments)) continue;
					endif;
				get_template_part( 'content', 'summary-endless-flow' ); 
		?>
		<hr />
				<?php endwhile; ?>
		
		

		<?php 
			endif; 
		wp_reset_postdata();
		if( !$hasArticles){
			echo '<article class="status-inherit hentry stream-post endless-flow no-post">Unfortunately, this author doesn\'t have any posts under this category.</article>';
		}
		?>
	</articles>

</div><!-- id="stream" -->

<?php get_footer(''); ?>