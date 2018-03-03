<?php 
/**
 * Displays comments below the post
 * 
 */ 

$container = $GLOBALS['container'] ?: new container('student-comments');

?>

<div class="<?php echo $container->classes(); ?>">
	<div class="wrapper">
		here's comments!
	</div>
</div>