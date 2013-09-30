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
			 edit_post_link( __( 'Edit Post' . $post->ID ),  '<li class="edit-link-right">', '</li>' ); 
		} elseif($showtime) {
			echo '<li class="edit-link-right">' . exa_human_time_diff(get_the_time('U')) . '</li>';
		}
		?>
	</ul>
	<?php
	
}

function exa_include_sidebar_square_ad() { ?>

	<div id="ad-leaderboard">
<!-- Sitewide.Rectangle.Sidebar.336x280 -->
<div id='div-gpt-ad-1378705451226-2'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1378705451226-2'); });
</script>
</div>
	</div>

<?php
}


function exa_include_article_square_ad() {


	if(hrld_is_production()) :

 ?>

	<div id="ad-leaderboard">
<!-- Sitewide.Rectangle.Sidebar.336x280 -->
<div id='div-gpt-ad-1378705451226-2'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1378705451226-2'); });
</script>
</div>
	</div>

<?php

	endif;
}

function exa_the_author_link() {
	echo get_bloginfo('url')."/author/".get_the_author_meta("user_nicename");

}

// Massively ugly, but beats should be kept out of the templates
function exa_get_beats_slug_list($category) {
	if ($category == 'news') {
		$beats_slug_list = array('madison','higher-edu','wisconsin','student-gov','us','campus','uw-research','uw-system');
	} elseif ($category == 'oped') {
		$beats_slug_list = array('column','editorial','opinion-desk','letter','public-editor','oped-top-story');
	} elseif ($category == 'sports') {
		$beats_slug_list = array('baseball','sports-column','football','mens-basketball','mens-hockey','mens-swimming','softball','volleyball','womens-basketball','womens-hockey','womens-swimming');
	} elseif ($category == 'artsetc') {
		$beats_slug_list = array('art','corner','books','chew-on-this','arts-column','film','food','herald-arcade','hump-day','low-fat-tue','arts-media','music','arts-point-counterpoint','tv');
	} else {
		$beats_slug_list = array();
	}
	return $beats_slug_list;
}

function exa_get_beats_dropdown($category, $term_slug = 'Beats'){
	$beats_slug_list = exa_get_beats_slug_list($category);
	$key = array_search($term_slug, $beats_slug_list);
	if(false !== $key){
		unset($beats_slug_list[$key]);
		$curr_term = get_term_by('slug', $term_slug, $category.'-beats');
	}
	?>
	<ul class="beats-menu">
        <li><a href="#" class="transparent"><?php if($curr_term){ echo $curr_term->name;} else{ echo $term_slug;} ?> <span class="arrow">&#9662;</span></a>
            <ul>
            <?php foreach($beats_slug_list as $beat_slug): 
				$beat = get_term_by('slug', $beat_slug, $category.'-beats');
				$beat_link = get_term_link($beat);
				if(is_wp_error($beat_link)) continue;
				?>
                <li><a href="<?php echo $beat_link; ?>"><?php echo $beat->name; ?></a></li>
            <?php endforeach; ?>
            </ul>
        </li>
    </ul>
	<?php 
}