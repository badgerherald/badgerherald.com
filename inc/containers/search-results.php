<?php
/**
 * Block: search result block
 * Description: Things my block does.
 *
 */

global $block;
if(!$block) {
	$block = new Block('search');
}

?>
<div class="<?php echo $block->classes(); ?>">
    
    <div class="wrapper">
    <script>
		(function() {
		  var cx = '017748836545253253952:wjly4mzvsyu'; // Insert your own Custom Search engine ID here
		  var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
		  gcse.src = '//cse.google.com/cse.js?cx=' + cx;
		  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
		})();
	</script>

		<div class="gcs_container">

			<gcse:search 
				gname="largoGCSE"
				overlayResults="false"
				queryParameterName="s"></gcse:searchresults-only>

		</div>

    </div>
</div>
