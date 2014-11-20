<?php
/**
 * Class that groups common DFP functions together.
 * 
 * Contents:
 * ----------------------------------------------------------------
 *
 * hrld_dfp_header() : outputs tags to embed ad units on the page.
 * 
 * ----------------------------------------------------------------
 * 
 * @since Nov 2013
 * @author Will Haynes
 *
 */
class dfp {

	private static $adUnits = array();
	private static $initialized = false;
	private static $placement = "misc";

	private static function initialize() {

		if (self::$initialized)
			return;

		if( !hrld_is_production('ads') ) {
				self::$placement = "development";
		} else {
				self::$placement = "homepage";
		}

		self::$initialized = true;

	}

	function hrld_dfp_header() {

		self::initialize();

		switch (self::$placement) {
					
			case "development":

				echo "<!-- DFP tags for development site -->";
				$ran = rand(0,1)+1;

				self::$adUnits['top-leaderboard'] = "
						
						<img src='" . get_bloginfo('template_directory') . "/img/ads/728x90-$ran.jpg' />

				";

				self::$adUnits['small-sidekick'] = "

						<img src='" . get_bloginfo('template_directory') . "/img/ads/300x250.jpg' />

				";

				self::$adUnits['tall-sidekick'] = "

						<img src='" . get_bloginfo('template_directory') . "/img/ads/300x250.jpg' />

				";

				self::$adUnits['variable-sidekick'] = "

						<img src='" . get_bloginfo('template_directory') . "/img/ads/300x250.jpg' />

				";

				break;        

			default:

				echo "<!-- DFP tags for Homepage -->

					<script type='text/javascript'>
					var googletag = googletag || {};
					googletag.cmd = googletag.cmd || [];
					(function() {
					var gads = document.createElement('script');
					gads.async = true;
					gads.type = 'text/javascript';
					var useSSL = 'https:' == document.location.protocol;
					gads.src = (useSSL ? 'https:' : 'http:') + 
					'//www.googletagservices.com/tag/js/gpt.js';
					var node = document.getElementsByTagName('script')[0];
					node.parentNode.insertBefore(gads, node);
					})();
					</script>
					
					<script type='text/javascript'>
					googletag.cmd.push(function() {
					googletag.defineSlot('/8653162/small-sidekick//300x250', [300, 250], 'div-gpt-ad-1416460552718-0').addService(googletag.pubads());
					googletag.defineSlot('/8653162/tall-sidekick//300x600', [300, 600], 'div-gpt-ad-1416460552718-1').addService(googletag.pubads());
					googletag.defineSlot('/8653162/top-leaderboard//768x90//site-wide', [728, 90], 'div-gpt-ad-1416460552718-2').addService(googletag.pubads());
					googletag.defineSlot('/8653162/variable-sidekick//300x250.300x600', [[300, 250], [300, 600]], 'div-gpt-ad-1416460552718-3').addService(googletag.pubads());
					// Keep this off! Unless you want to generate multiple headers.
					// googletag.pubads().enableSingleRequest();
					googletag.enableServices();
					});
					</script>

				";

				self::$adUnits['top-leaderboard'] = "

					<!-- Top Leaderboard -->
					<div id='div-gpt-ad-1416460552718-2' style='width:728px; height:90px;'>
					<script type='text/javascript'>
					googletag.cmd.push(function() { googletag.display('div-gpt-ad-1416460552718-2'); });
					</script>
					</div>

				";

				self::$adUnits['small-sidekick'] = "

					<!-- Small Sidekick -->
					<div id='div-gpt-ad-1416460552718-0' style='width:300px; height:250px;'>
					<script type='text/javascript'>
					googletag.cmd.push(function() { googletag.display('div-gpt-ad-1416460552718-0'); });
					</script>
					</div>

				";

				self::$adUnits['variable-sidekick'] = "

					<!-- Variable Sidekick -->
					<div id='div-gpt-ad-1416460552718-3'>
					<script type='text/javascript'>
					googletag.cmd.push(function() { googletag.display('div-gpt-ad-1416460552718-3'); });
					</script>
					</div>

				";   

				self::$adUnits['tall-sidekick'] = "

					<!-- Tall Sidekick -->
					<div id='div-gpt-ad-1416460552718-1' style='width:300px; height:600px;'>
					<script type='text/javascript'>
					googletag.cmd.push(function() { googletag.display('div-gpt-ad-1416460552718-1'); });
					</script>
					</div>

				";

				break;        


			}

	}

	function tall_sidekick() { 

			echo "<div id='ad-leaderboard' class='tall-sidekick'>";
			echo self::$adUnits['tall-sidekick'];
			echo "</div>";

	}

	function variable_sidekick() { 
			
			echo "<div id='ad-leaderboard' class='variable-sidekick'>";
			echo self::$adUnits['variable-sidekick'];
			echo "</div>";

	} 

	function small_sidekick() { 

			echo "<div id='ad-leaderboard' class='small-sidekick'>";
			echo self::$adUnits['small-sidekick'];
			echo "</div>";

	}

	function top_leaderboard() { 

			echo "<div id='ad-leaderboard' class='top-leaderboard'>";
			echo self::$adUnits['top-leaderboard'];
			echo "</div>";

	}

}
