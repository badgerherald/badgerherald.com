<?php

function exa_list_categories($showedit = false, $showtime = false) {
	global $post;
	$beats = exa_get_beats(); 
	$category_base = get_bloginfo('url')."/".get_post_type()."/";
	$post_type = get_post_type_object(get_post_type());
	?>
	<ul class="category-bar">
		<li><a class="section-link" href="<?php echo $category_base; ?>"><?php echo $post_type->labels->name; ?></a></li>
		
		<?php foreach ($beats as $beat) : ?>

		<li><a class="beat-link" href="<?php echo $category_base . "beats/".$beat->slug ?>"> <?php echo $beat->name ?></a></li>

		<?php endforeach; 
		if($showedit) {
			 edit_post_link( __( 'Edit Post' ), '<li class="edit-link-right">', '</li>' ); 
		} elseif($showtime) {
			echo '<li class="edit-link-right">' . exa_human_time_diff(get_the_time('U')) . '</li>';
		}
		?>
	</ul>
	<?php
	
}

function exa_include_sidebar_square_ad() { ?>

	<div id="ad-leaderboard">
		<a href="#"><img width="300" height="250" src="<?php bloginfo('template_url'); ?>/img/temp/carbone.336x280.jpg"></a>
	</div>

<?php
}


function exa_include_article_square_ad() { ?>

	<div id="ad-leaderboard">
		<a href="#"><img width="300" height="250" src="<?php bloginfo('template_url'); ?>/img/temp/carbone.336x280.jpg"></a>
	</div>

<?php
}

function exa_the_author_link() {
	echo get_bloginfo('url')."/author/".get_the_author_meta("user_nicename");

}