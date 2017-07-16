<?php 

$container = $GLOBALS['container'] ?: new Container('gallery');
$container->default_args(
	array(
		'background' => 'black',
	)
);
?>

<div class="<?php echo $container->classes() ?>">

	<div class="left-toggle"></div>
	<div class="right-toggle"></div>
	<div class="close-bar">
		<div class="close"></div>
	</div>


	<div class="image-wrapper">
	<?php 
	$first = true;
	if ( have_posts() ) :
		
		while ( have_posts() ) : the_post();

		$image = wp_get_attachment_image_src( $post->ID, "jumbo" );
		$src = $image[0];

		echo $first ? "<div class='image-slide active'>" : "<div class='image-slide'>";
		echo "<img src='$src' />";
		echo "<div class='caption'>" . get_the_excerpt() . "</div>";
		echo "</div>";

		$first = false;

		endwhile;

	endif;

	?>
	</div>

</div>