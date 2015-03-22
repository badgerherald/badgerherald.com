
	
	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
		<div class="so-header-wrap">
			<header <?php if(!$error['success']) { ?> style="display:none" <?php } ?> class="entry-header shoutout-header">
				<h1 class="entry-title"><a href="<?php bloginfo('url'); ?>/shoutouts/"> <?php the_title(); ?></a></h1>
				<h2 class="shoutout-tagline"></h2>
				<a style="display:none" class="so-button add-so-button" href="http://badgerherald.com/shoutouts/add">Add a Shoutout</a>
			</header><!-- .entry-header -->

		</div>

<div id="stream">


	<?php else : // Single ?>

<?php

/* We make sure there is only one result */
//if(mysql_num_rows($result)!=1) {
//	echo "<p>Either that shoutout does not exist, or something got messed up in the tube.</p>";
//}

/* Else we only have one row */	
//else {
	

	<?php endif // $soSingle ?>


	<?php endwhile; // Wordpress while ?>

</div>



<div class="so-sidebar">

</div><!-- id="sidebar" -->



<?php get_footer(); ?>