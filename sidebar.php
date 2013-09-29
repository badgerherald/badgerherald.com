<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */


$args = array(
	'post_type'=> is_home() ? array('oped','sports','news','artsetc') : array(get_post_type()),
	'posts_per_page' => 40
);
// The Query
$sidebarquery = new WP_Query( $args );

?>

<div id="sidebar">
<div class="sidebar-inner">

<h1 class="most-recent-headline">Happening Now</h1>

<div class="sidebar-scroll">
<ul class="sidebar-posts">
<?php 
// The Loop
if ( $sidebarquery->have_posts() ) :
	$adcount = 0;
	while ( $sidebarquery->have_posts() ) : 
		$sidebarquery->the_post();

	if($adcount==3&&hrld_is_production()) :
		hrld_sidebar_ad();

	elseif($adcount==6&&hrld_is_production()) : 

		hrld_sidebar_lower_ad();
		
	endif;
	?>
	
		<li class="post-in-sidebar">
		<?php exa_list_categories(false,true) ?>

		<a class="post-permalink" href="<?php the_permalink() ?>"><?php the_title() ?></a>

		</li>

<?php 
	$adcount+=1;
	endwhile;
else : 
	echo "No posts yet";
endif; 
/* Restore original Post Data */
wp_reset_postdata();
?>
</ul><!-- class="sidebar-posts" -->

</div><!-- class="sidebar-scroll" -->
</div><!-- class="inner-sidebar" -->
</div><!-- id="sidebar" -->