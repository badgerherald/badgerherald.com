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

	<!-- clearfix the content -->
	<div class="clearfix"></div>
		

	<div class="block footer-block">
    	<div class="wrapper">
			<p>All Content &copy; The Badger Herald, <?php echo date("Y"); ?></p>
			<p>Proudly powered by WordPress. <a href="http://github.com/badgerherald/">Fork us on Github</a>.
		</div>
	</div>

</div><!-- END div#page -->
	
<?php wp_footer(); ?>

</body>
</html>