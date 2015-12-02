<?php
/**
 * Block: search result block
 * Description: Things my block does.
 *
 */
?>
<div class="block alert-banner-block">
    
    <div class="wrapper">
    <script>
		(function() {
		  var cx = '017748836545253253952:wjly4mzvsyu'; // Insert your own Custom Search engine ID here
		  var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
		  gcse.src = (document.location.protocol == 'https' ? 'https:' : 'http:') +
		      '//cse.google.com/cse.js?cx=' + cx;
		  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
		})();
	</script>
	
	<!-- Place this tag where you want both of the search box and the search results to render -->
	<gcse:search></gcse:search>

		<div class="gcs_container">

			<gcse:searchresults-only
				gname="largoGCSE"
				overlayResults="false"
				queryParameterName="s"></gcse:searchresults-only>

			<script>

				(function() {
					var cx = '017748836545253253952:wjly4mzvsyu';

					var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
					gcse.src = (document.location.protocol == 'https' ? 'https:' : 'http:') +
					    '//cse.google.com/cse.js?cx=' + cx;
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
					})();

			</script>

		</div>

    </div>
</div>
