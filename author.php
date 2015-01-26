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


<?php get_sidebar('author'); ?>	
<div id="stream" class="author-stream">
		
		<?php
			$best_posts = get_the_author_meta( '_hrld_staff_best_posts', get_the_author_meta('ID', get_query_var('author')) );
			if(!empty($best_posts)):
		?>
	<div class="pinned-posts">
		<?php
			$args = array(
				'post__in' => $best_posts,
				'post_type' => 'any',
				'post_status' => array('publish', 'inherit'),
				'posts_per_page' => 3,
			);
			$query = new WP_Query( $args );
    		if ( $query->have_posts() ) : 
    		 /* The loop */ 
				while ( $query->have_posts() ) : $query->the_post();
					if( $post_category != '' && $post_category == ('attachment' || 'featured')) :
						if( exa_is_featured() && $post_category == 'attachment') continue;
						else if( get_post_type()  == 'attachment' && $post_category == 'featured') continue;
					endif;
				?>
				<div class="pinned-post">
				<?php
				get_template_part( 'content', 'block-featured' ); 
		?>
		</div>
				<?php endwhile; wp_reset_postdata(); ?>
			<?php endif;  ?>
	</articles>
	<?php 
	else:
		$best_posts = array();
	endif; ?>
	<articles>
		
		<?php
			$args = array(
				'post__not_in' => $best_posts,
				'author' => get_the_author_meta('ID', get_query_var('author')),
				'post_type' => 'post',
				'post_status' => 'publish'
			);
			$query = new WP_Query( $args );
    		if ( $query->have_posts() ) : 
    			$hasArticles = true;
    	 		echo "<h2>articles</h2>";
    		 /* The loop */ 
				while ( $query->have_posts() ) : $query->the_post();
				get_template_part( 'content', 'summary-endless-flow' ); 
		?>
		<hr />
				<?php endwhile;
		wp_reset_postdata(); ?>
		
		

		<?php 
			endif; 
		?>
	</articles>

</div><!-- id="stream" -->

<?php get_footer(''); ?>