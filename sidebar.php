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

	if($adcount==3) :
		exa_include_sidebar_square_ad();
	endif;

	if($adcount==9) : ?>

		<script type="text/javascript"><!--
		google_ad_client = "ca-pub-2162610591110839";
		/* verticle.banner.300x600 */
		google_ad_slot = "8444431319";
		google_ad_width = 300;
		google_ad_height = 600;
		//-->
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
		
	<?php
	endif;
	?>
	
		<li class="post-in-sidebar">
		<?php exa_list_categories(false,true) ?>

		<?php if ( has_post_thumbnail() && ! post_password_required() ) : $full_width = true; ?>
			<a class="post-permalink" href="<?php the_permalink() ?>">
			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			</a>

		<?php endif; ?>


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