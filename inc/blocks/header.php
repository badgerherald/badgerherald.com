<?php 

global $block;

if(!$block) {
	$block = new Block('header');
}

$block->default_args(
	array(
		'background' => 'grey',
		'breakpoint' => array()
	)
);

?>

<div class="<?php echo $block->classes(); ?>">
	<div class="wrapper">
		<a id="logo" href="<?php bloginfo('url'); ?>">
			<?php if($block->args['background'] == 'black') : ?>
				<img src="<?php bloginfo('template_url') ?>/img/logo/header-horizontal-white.png" />
			<?php else : ?>
				<img src="<?php bloginfo('template_url') ?>/img/logo/header-horizontal.png" />
			<?php endif; ?>
		</a>

		<div class="social-buttons">

			<h3 class="follow-us">Follow Us!</h3>	
			<div class="facebook">
				<div class="fb-like" data-href="http://facebook.com/badgerherald" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
			</div><!-- .facebook -->
			<div class="twitter">
				<a href="https://twitter.com/badgerherald" class="twitter-follow-button" data-show-count="false">Follow @badgerherald</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			</div><!-- .twitter -->

		</div>
	</div>
</div>