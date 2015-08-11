<div class="block header-block">
	
	<div class="wrapper">
		
		<a id="logo" href="<?php echo bloginfo('url'); ?>">
			<img src="<?php bloginfo('template_url') ?>/img/logo/logo.png" />
		</a>

		<div class="header-right">

			<div class="top-bar">
				<div class="tagline"><?php bloginfo('description'); ?></div>
				<?php 
					wp_nav_menu( array(
							'theme_location' => 'header'
						)
					);
				?>
				<div class="clearfix"></div>
			</div>

			<div class="story-container">
				<?php
				$query_args = array(
					'showposts' 	=> 2,
					'post_status'	=> 'publish',
					'tax_query' => array(
						array(
						    'taxonomy' => 'importance',
						    'field' => 'slug',
						    'terms' => 'header-bar'
						)
					)
				);
				$my_query = new WP_Query( $query_args );

				if ( $my_query->have_posts() ) {
					while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

					<a href="<?php the_permalink(); ?>" class="story">
					
						<div class="dotted-overlay-container">
							<?php the_post_thumbnail('post-thumbnail'); ?>
						</div>

						<div class="block-headline-container">
							<h2 class="block-headline"><span><?php the_title(); ?></span></h2>
						</div>  <rect x="2" y="2" width="1" height="1" style="fill:red" />
					</a>
						
				<?	endwhile;
				} else {
					// todo: test this output.
					echo "No Posts";
				}
				?>
			</div>

			<div class="social-buttons">

				<h3 class="follow-us">Follow Us!</h3>	
				<div class="facebook">
					<div class="fb-like" data-href="http://facebook.com/badgerherald" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
				</div><!-- .facebook -->
				<div class="twitter">
					<a href="https://twitter.com/badgerherald" class="twitter-follow-button" data-show-count="false">Follow @badgerherald</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				</div><!-- .twitter -->
			</div>

		</div>
	</div>
</div>