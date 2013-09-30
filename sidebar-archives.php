<?php
/**
 * The general sidebar for an archive or taxonomy page
 *
 * @package WordPress
 * @subpackage exa
 * @since 9/30/2013
 */

?>
<div id="sidebar">
<div class="sidebar-inner">

<h1 class="most-recent-headline">Beats</h1>

<div class="sidebar-scroll">
<ul class="sidebar-posts">

<?php

$post_type = get_post_type();
$beats_slug_list = exa_get_beats_slug_list($post_type);
?>
<ul class="beats-menu">
    <?php foreach($beats_slug_list as $beat_slug):
	$beat = get_term_by('slug', $beat_slug, $post_type.'-beats');
	$beat_link = get_term_link($beat);
	if(is_wp_error($beat_link)) continue;
	?>
	<li <?php if (get_query_var('term') == $beat_slug) { echo "class='active'"; }?>><a href="<?php echo $beat_link; ?>"><?php echo $beat->name; ?></a></li>
    <?php endforeach; ?>
</ul>
</ul><!-- class="sidebar-posts" -->

</div><!-- class="sidebar-scroll" -->
</div><!-- class="inner-sidebar" -->
</div><!-- id="sidebar" -->