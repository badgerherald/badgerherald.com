<?php 

global $OnCampus;
$container = $GLOBALS['container'] ?: new container('footnotes');

?>

<div class="<?php echo $container->classes(); ?>">

	<div class="wrapper">


		<div class="meta">

			<a class="facebook-button" target="_blank" href="<?php echo exa_facebook_link(); ?>">Share</a>
			<a class="tweet-button" target="_blank" href="<?php echo exa_tweet_link(); ?>">Tweet</a>

			<!-- Copy URL -->
			<input class="share-url" type="text" onclick="this.select()" value="<?php echo exa_short_url() ?>"/>

	
			<hr/>
	
			<div class="fine-print">
		
				<p>This article was published <?php the_time("M j, Y") ?> at <?php the_time("g:i a"); ?> and 	last updated <?php the_modified_time("M j, Y") ?> at <?php the_modified_time("g:i a"); ?><p>
			</div>
	
			<a class="comment-button" href="#">Comments</a>
			<aside class="comments" style="display:none"><?php comments_template(); ?></aside>

		</div>

		<div class="tall-ad">
			<?php $OnCampus->place_ad(array("desktop" => "article-bottom")); ?>
		</div>


		<div class="more">
			<h1>Next in <a href="<?php exa_section_permalink() ?>" class="section"><?php echo ucfirst( get_exa_section()); ?></a></h1>

			<?php

			Exa::addShownId($post->ID);
			$query_args = array(
				'showposts' 	=> 4,
				'post_status'	=> 'publish',
				'post__not_in'	=> Exa::shownIds(),
				'tax_query' => array(
					array(
					    'taxonomy' => 'importance',
					    'field' => 'slug',
					    'terms' => array('featured','cover')
					),
					array(
					    'taxonomy' => 'category',
					    'field' => 'slug',
					    'terms' => get_exa_section()
					),
				)
			);

			$my_query = new WP_Query( $query_args );
			$first = true; 

			echo "<ul>";

			if ( $my_query->have_posts() ) {
				while ( $my_query->have_posts() ) : $my_query->the_post(); Exa::addShownId(get_the_ID()); ?>
	
					<li><a href="<?php the_permalink(); ?>" class="story">
					
						<?php

						if($first) :
							$first = false;
							the_post_thumbnail('post-thumbnail');
						endif;
						?>

						<h2 class="headline"><?php the_title(); ?></h2>

						<?php if( exa_has_subhead(get_the_ID()) ) : ?>
							<h3 class="subhead"><?php exa_subhead(); ?></h3>
						<?php else: ?>
							<h3 class="subhead"><?php the_excerpt(); ?></h3>
						<?php endif; ?>

					</a></li>
	
				<?php	endwhile;

			echo "</ul>";

			} else {
				// todo: test this output.
				echo "No Posts";
			}
			?>


		</div>
		<div class="clearfix"></div>
	</div>
</div>
<?php wp_reset_postdata() ?>