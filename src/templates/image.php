
<?php
/**
 * The default template for displaying image attachments.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

global $AnalyticBridge;
global $post;

?>

<?php get_template_part('header'); ?>

<div class="black" style="padding-top:18px;">
	<?php
		exa_container('leaderboard');
		exa_container('nameplate');
		exa_container('hero', 'image');	//main content of this page
	?>
</div>



<div class="container read-next-container" style="border-top: 1px solid #c7d0d5; margin-top: 64px;">
	<div class="wrapper" style="text-align: center;margin-top: 42px; ">
			<h2 style=" font-family: pt serif; text-transform: uppercase; font-style: italic; background: #2379d0; color: #fff; font-size: 42px; display:inline-container; padding: 12px 20px; line-height: 54px; text-align: center; margin: 0 auto;">Read Next</h2>
	</div>
</div>

<?php 

Exa::addShownId(get_the_ID());

exa_container('feature-widget'); 
exa_container('ad-and-two-dominant');
exa_container('list-and-banter');
get_template_part('footer');

