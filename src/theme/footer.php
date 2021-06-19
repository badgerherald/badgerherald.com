<?php 

exa_container('colophon');
wp_footer();

?>

<script>
  /// Inject webpress context into theme components
  var elements = document.querySelectorAll('.webpress-contextual')
  elements.forEach(el => {
    el.global = webpress
  });

  var elements = document.querySelectorAll('webpress-theme')
  elements.forEach(el => {
    el.global = webpress
  });
</script>

</body>
</html>