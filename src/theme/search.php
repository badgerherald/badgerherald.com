<?php
/**
 * The template for displaying search pages.
 *
 */

get_header();
exa_container('nameplate');
?>

<webpress-theme id="page">
	<div class="container">
		<div class="wrapper">
			<bh-search-results-page class="webpress-contextual"> </bh-search-results>
		</div>
	</div>
</webpress-theme>

<?php
get_footer(); 
