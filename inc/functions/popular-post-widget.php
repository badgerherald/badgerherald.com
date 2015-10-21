<?php

/**
 * Popular post widget extended from the plugins.
 * 
 */

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
			<ul>

			<?php

			$popPosts = new AnayticBridgePopularPosts();
			$popPosts->size = 7;
			$outof = 0;
			foreach($popPosts as $r) : ?>
				<?php if(!$outof) $outof = $r->weighted_pageviews + $r->weighted_pageviews*.1; ?>
				<li><a href="<?php echo get_permalink($r->post_id); ?>" title="<?php echo get_the_title($r->post_id); ?>" class="">
					<?php echo get_the_title($r->post_id); ?>
				</a>
				<div class="graph-bar" style="width:<?php echo ((double)$r->weighted_pageviews/(double)$outof)*100; ?>%"></div>
				</li>
				
			<?php endforeach; ?>
	
			</ul>

		</div>


	<? }

}

add_action( 'widgets_init', function(){
     register_widget( 'Popular_Post_Widget' );
});