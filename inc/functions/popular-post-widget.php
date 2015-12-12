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
					"ids" => $popPosts->ids,
					"posts_per_page" => $popPosts->size
				)
			);

		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post(); ?>

				<?php $r = $popPosts->current(); ?>

				<a href="<?php the_permalink() ?>">
					<?php the_post_thumbnail('post-thumbnail'); ?>
					<span class="topic"><?php echo exa_topic(); ?></span>
					<h2><span><?php the_title(); ?></span></h2>
					<div class="clearfix"></div>
					<div class="graph-bar" style="width:<?php echo (/*(double)$r->weighted_pageviews/ */(double)$outof)*100; ?>%"></div>				
				</a>
				

				<?php $r = $popPosts->next(); ?>
		<?php $outof = $outof*.8; endwhile;
		endif;
		?>


		</div>


	<? }

}

add_action( 'widgets_init', function(){
     register_widget( 'Popular_Post_Widget' );
});

endif;