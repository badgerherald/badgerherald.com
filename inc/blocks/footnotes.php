<?php 

global $block;
global $OnCampus;

?>

<div class="<?php echo $block->classes() ?>">

	<div class="wrapper">


		<div class="meta">

			<a class="facebook-button" target="_blank" href="<?php echo exa_facebook_link(); ?>">Share</a>
			<a class="tweet-button" target="_blank" href="<?php echo exa_tweet_link(); ?>">Tweet</a>

			<!-- Copy URL -->
			<input class="share-url" type="text" onclick="this.select()" value="<?php echo exa_short_url() ?>"/>

	
			<hr/>
	
			<?php /* LTE Disclaimer */ ?>
	
			<div class="fine-print">
				<?php if( get_the_author() == "Letter to the Editor" ) : ?>
				<p class="letter-to-editor-disclaimer"><em><strong>Letters to the editor</strong> are 	published on the discretion of the opinion desk and editor. They may not reflect the views of 	the Herald. Email your own letters to the editor to oped@badgerherald.com</em></p>
				<?php endif; ?>
		
				<p>This article was published <?php the_time("M j, Y") ?> at <?php the_time("g:i a"); ?> and 	last updated <?php the_modified_time("M j, Y") ?> at <?php the_modified_time("g:i a"); ?><p>
			</div>
	
			<a class="comment-button" href="#">Comments</a>
			<aside class="comments" style="display:none"><?php comments_template(); ?></aside>

		</div>

		<div class="tall-ad">
			<?php $OnCampus->place_ad(array("desktop" => "article-bottom")); ?>
		</div>


		<div class="more">
			<h1>Next in <a href="<?php echo exa_section_permalink() ?>" class="section"><?php echo exa_section(); ?></a></h1>

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
					    'terms' => array('dominant','hard')
					),
					array(
					    'taxonomy' => 'category',
					    'field' => 'slug',
					    'terms' => exa_section()
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

						<?php if( hrld_has_subhead(get_the_ID()) ) : ?>
							<h3 class="subhead"><?php hrld_the_subhead(); ?></h3>
						<?php else: ?>
							<h3 class="subhead"><?php the_excerpt(); ?></h3>
						<?php endif; ?>

					</a></li>
	
				<?	endwhile;

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

<?php exa_block('dirty-bird'); ?>