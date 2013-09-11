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
<!-- Sitewide.Rectangle.Sidebar.336x280 -->
<div id='div-gpt-ad-1378705451226-2'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1378705451226-2'); });
</script>
</div>
	</div>

<?php
}


function exa_include_article_square_ad() { ?>

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

function exa_the_author_link() {
	echo get_bloginfo('url')."/author/".get_the_author_meta("user_nicename");

}

function exa_get_beats_dropdown($beats_slug_list, $category, $term_slug = 'Beats'){
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

function exa_include_top_leaderboard_ad() { 

	if( is_front_page() ) :
	?>
	<div id="ad-leaderboard">
<!-- front-leaderboard -->
<div id='div-gpt-ad-1378705451226-0' style='width:728px; height:90px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1378705451226-0'); });
</script>
</div>
	</div>

	<? else : ?>
	<div id="ad-leaderboard">
<!-- sitewide.leaderboard.top.728x90 -->
<div id='div-gpt-ad-1378705451226-1' style='width:728px; height:90px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1378705451226-1'); });
</script>
</div>
	</div>

	<?php endif; ?>
<?php } ?>
}