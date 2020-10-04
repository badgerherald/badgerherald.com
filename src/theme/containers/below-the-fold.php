<?php
/**
 * container: List & Banter
 * Description: Four posts on the left, and banter widget on
 * 				the right.
 *
 */

$container = $GLOBALS['container'] ?: new container('l');

?>

<bh-grid class="below-the-fold">	
    <div class="list">

		<?php
		$query_args = array(
			'posts_per_page' => 10,
			'post_status'	=> 'publish',
			'tax_query' => array(
				array(
				    'taxonomy' => 'importance',
				    'field' => 'slug',
				    'terms' => array('featured','cover')
				)
			)
		);

		if ( ! $my_query = wp_cache_get("exa_list-and-banter") ) {
			$my_query = new WP_Query( $query_args );
			wp_cache_set("exa_list-and-banter",$my_query,'',0);
		}

			$count = 0;
			if ( $my_query->have_posts() ) :
				while ( $my_query->have_posts() ) : $my_query->the_post(); 
				if (Exa::postHasBeenSeen(get_the_ID())) {
					continue;
				}
				$count++;
				if ($count > 4) {
					continue;
				}
				Exa::addShownId(get_the_ID()); 
				?>

			<bh-headline-unit 
				headline="<?php the_title(); ?>"
				subhead="<?php exa_subhead(); ?>"
				url="<?php the_permalink(); ?>"
				image-src="<?php the_post_thumbnail_url(); ?>"
				time="<?php exa_time(); ?>"
				topic="<?php exa_topic( $post->ID ); ?>"
				header-tag="h4"
				hard="true"
				></bh-headline-unit>

			<?php endwhile; endif; ?>
    	</div>
    	
    	<bh-sticky-container class="banter">
			<div slot="header">
    			<h3><a href="<?php echo get_category_link( get_cat_ID( 'banter' ) ); ?>">UW Banter</a></h3>
			</div>
			<div slot="content">
 				<?php
				$query_args = array(
					'post_status'	=> 'publish',
					'tax_query' => array(
						array(
						    'taxonomy' => 'category',
						    'field' => 'slug',
						    'terms' => array('banter')
						)
					)
				);
				if ( ! $my_query = wp_cache_get("exa_list-and-banter-banter") ) {
					$my_query = new WP_Query( $query_args );
					wp_cache_set("exa_list-and-banter-banter",$my_query,'',0);
				}
				$count = 0;
				if ( $my_query->have_posts() ) :
					while ( $my_query->have_posts() ) : $my_query->the_post(); 
					if(Exa::postHasBeenSeen(get_the_ID())) {
						continue;
					}
					Exa::addShownId(get_the_ID()); 
					$count++;
					if($count > 5) {
						continue;
					}
				?>
			
				<bh-headline-unit 
					headline="<?php the_title(); ?>"
					subhead="<?php exa_subhead(); ?>"
					url="<?php the_permalink(); ?>"
					image-src="<?php the_post_thumbnail_url(); ?>"
					time="<?php exa_time(); ?>"
					topic="<?php exa_topic( $post->ID ); ?>"
					header-tag="h4"
					hard="true"
					></bh-headline-unit>
			   
			<?php endwhile; endif; ?>
				</div>
    </bh-sticky-container>
</bh-grid >