<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */


/* check if they weren't looking for an old school url */


function pageURL() {

 $pageURL .= $_SERVER["REQUEST_URI"];

 return preg_replace("#/bhrld#", "", $pageURL);
}


$args = array(
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => '_mt_url',
            'value' => pageURL(),
            'compare' => 'LIKE'
        )
    ),
    'post_type' => 'any'
);


// query_posts($args);

// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		header('Location: ' . get_permalink());
		//header('Location: http://google.com');
		?>
		<script type='text/javascript'>
			<!--
			window.location = "<?php the_permalink() ?>";
			//-->
		</script>

		<?php
		exit;
	}
}
/* Restore original Post Data */
wp_reset_postdata();


get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<header class="page-header">
				<h1 class="page-title"><?php _e( 'Not found', 'twentythirteen' ); ?></h1>
			</header>

			<div class="page-wrapper">
				<div class="page-content">
					<h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentythirteen' ); ?></h2>
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentythirteen' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</div><!-- .page-wrapper -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>