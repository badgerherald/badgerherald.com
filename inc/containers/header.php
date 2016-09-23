<?php 

$container = $GLOBALS['container'] ?: new container('header');
$container->default_args(
	array(
		'background' => 'grey',
		'breakpoint' => array(),
		'flex' => false
	)
);

?>

<div class="<?php echo $container->classes(); ?>">
	<div class="wrapper <?php echo $container->args['flex'] ? "flex": ""; ?>">
		<a id="logo" href="<?php bloginfo('url'); ?>">
			<?php if($container->args['background'] == 'black') : ?>
				<img src="<?php bloginfo('template_url') ?>/img/logo/header-horizontal-white.png" />
			<?php else : ?>
				<img src="<?php bloginfo('template_url') ?>/img/logo/header-horizontal.png" />
			<?php endif; ?>
		</a>

		<div class="header-charm">
			<?php do_action('exa_header_charm'); ?>
		</div>
	</div>
</div>