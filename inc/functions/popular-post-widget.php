<?php

/**
 * Popular post widget extended from the plugins.
 * 
 */

if( class_exists("AnalyticBridgePopularPostWidget")) :

Class Popular_Post_Widget extends AnalyticBridgePopularPostWidget {

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) { ?>
		
		<div class="popular-post-widget">

			<h3>Popular Posts</h3>

			<?php
			$popPosts = new AnayticBridgePopularPosts();
			$popPosts->size = 7;
			$outof = 0;
			$popPosts->query();
			$popPosts->rewind();
			$firstPopPost = $popPosts->current();
			$outof = $firstPopPost->weighted_pageviews + $firstPopPost->weighted_pageviews*.1;
			if($outof == 0) $outof = 1;
			$iter = 0;

			$query = new WP_Query( array(
					"post__in" => $popPosts->ids,
					"posts_per_page" => $popPosts->size,
					"post_status " => 'publish'
				)
			);

			foreach($popPosts as $r) { 
			?>
				<a href="<?php echo get_permalink($r->post_id) ?>">
				<?php get_the_post_thumbnail($r->post_id,'post-thumbnail'); ?>
					<span class="topic"><?php exa_topic($r->post_id); ?></span>
					<h2><span><?php echo get_the_title($r->post_id); ?></span></h2>
					<div class="clearfix"></div>
					<div class="graph-bar" style="width:<?php echo ((double)$r->weighted_pageviews/(double)$outof)*100; ?>%"></div>				
				</a>
			<?php
			}
			?> 
		</div>

	<?php
	}

}

add_action( 'widgets_init', function() {
     register_widget( 'Popular_Post_Widget' );
});

endif;