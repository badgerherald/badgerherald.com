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




<?php /* The loop */ ?>

<div class="error-404">

<img src="<?php bloginfo('template_url') ?>/img/4-doge-4.png"/>
<div class="error-404-message">
	<h1>Such Error. Much Embarrasing.</h1>
	<p><strong>4-doge-4</strong> – Sorry, We can't find what you're looking for. Doge really screwed the pooch on this one.</p>
	<p><a href="http://badgerherald.com/">Visit our homepage</a>.</p>
</div>


</div>

<?php get_footer(); ?>

