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

<?php exa_container('colophon'); ?>

</wp-theme><!-- END wp-theme#page -->

<?php wp_footer(); ?>

<script>
  var element = document.getElementById('page')
  element.context = webpress
</script>
</body>
</html>