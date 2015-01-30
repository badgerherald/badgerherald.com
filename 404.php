<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */


/* check if they weren't looking for an old school url */


$start = microtime(true);

function pageURL() {

 $pageURL = $_SERVER["REQUEST_URI"];
 return $pageURL;

}


//Redirects /oped(/) requests to /opinion/, 
//including opinion articles.
if( stripos(pageURL(), "/oped/") == 0 ){

	if( pageURL() == '/oped')
		wp_redirect( home_url()."/opinion/", 301 );
	else{
		$split_url = explode("/oped/", pageURL());
		if(isset($split_url[0]) && $split_url[0] != "")
			wp_redirect( home_url()."/opinion/".$split_url[0], 301 );
	}
	exit;
}


$args = array(
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => '_mt_url',
            'value' => 'http://badgerherald.com' . pageURL(),
            'compare' => '='
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
		$ru = getrusage();
		
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
error_log("This process used " . microtime(true) - $start .
    		" ms for its computations\n");

get_header(); ?>




<?php /* The loop */ ?>

<div class="error-404">

<img src="<?php bloginfo('template_url') ?>/img/4-doge-4.png"/>
<div class="error-404-message">
	<h1>Such Error. Much Embarrassing.</h1>
	<p><strong>4-doge-4</strong> – Sorry, We can't find what you're looking for. Doge really screwed the pooch on this one.</p>
	<p><a href="http://badgerherald.com/">Visit our homepage</a>.</p>
</div>


</div>

<?php get_footer(); ?>

