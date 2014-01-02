<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		<div class="clearfix"></div>
		</div><!-- #primary -->
	</div><!-- #page -->
		<?php /* <footer id="colophon" class="site-footer" role="contentinfo">
			<?php get_sidebar( 'main' ); ?>

			<div class="site-info">
				<?php do_action( 'twentythirteen_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentythirteen' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentythirteen' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentythirteen' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->
	*/ ?>



	</div><!-- id="wrapper" -->
	
	<?php /* TODO:  Do this in a WP way */ ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/exa.js" type="text/javascript"></script>
	
	<?php wp_footer(); ?> 

	<?php /* TODO:  Only load this on the homepage */ ?>
	<script type="text/javascript">

		<?php 
		global $homepageSlider;
		if($homepageSlider == true) :
		/**
		 * Setup
		 * 
		 * Setup for swipe library.
		 */ ?>
		var speed = 600;
		var auto = 5000;
		window.mySwipe = new Swipe(document.getElementById('swipe'), {
			startSlide: 0,
			speed: speed,
			auto: auto,
			continuous: true,
			disableScroll: false,
			stopPropagation: false,
			callback: swiped,
			transitionEnd: function(index, elem) {}
		});

		swiped(0,document.getElementById('swipe'));

		<?php 
		/**
		 * Function: swiped
		 * 
		 * Callback function that highlights the new slider 
		 * position on the slider navigation.
		 *
		 * @param index the index of the now active slider 
		 * @param elem DOM element of the slider
		 */ ?>
		function swiped(index,elem) {
			$(".slider-nav").find('li').removeClass("active").eq(index).addClass("active");
		}

		<?php 
		/**
		 * Listener
		 * 
		 * Listens for clicks on the slider nav to change
		 * slider position.
		 */ ?>
		$(".slider-nav li").click(function() {

			var index = $(".slider-nav").find("li").index($(this));

			window.mySwipe.slide(index,speed);

		});

		<?php endif; /* homepageSlider */ ?>
		

	</script>


	<script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-2337436-1']);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();

	</script>
</body>
</html>