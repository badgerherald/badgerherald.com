<?php 

$container = $GLOBALS['container'] ?: new container('masthead');
$masthead = exa_masthead_postmeta();

?>

<div class="<?php echo $container->classes(); ?>">
	<div class="wrapper">
		<h1 class="title">Masthead <?php the_title() ?></h1>


	<ol class="masthead">

	<?php 

	$lastIndex = 0;
	foreach( $masthead as $section ) :

		echo "<li><ol>";
		if( !empty($section['title']) ) {
			echo "<h2>" . $section['title'] . "</h2>";
		}

		foreach ($section['staff'] as $staff) {
			$user = get_userdata( $staff['uid'] );
			$name = $user ? $user->display_name : '';
			$position = $staff['position'];
			$profile_link = get_author_posts_url( $staff['uid'] );

			echo "<li><a href='$profile_link' class='name'>$name</a>";
			if($position != null) {
				echo " <span class='position'>$position</span>";
			}
			echo "</li>";
		}

		echo "</ol></li>";

	endforeach;
	?>

	</ol>
	</div>
</div>
