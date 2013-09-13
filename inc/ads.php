<?php
/**
 * Outputs the Google dfp script tag for the header of a website.
 * 
 * @since Sept 11, 2013
 * @author Will Haynes
 *
 * @return null
 */

function hrld_dfp_header() {

	echo "

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
		googletag.defineSlot('/8653162/v6.homepage.leaderboard.top', [728, 90], 'div-gpt-ad-1379013535352-0').addService(googletag.pubads());
		googletag.defineSlot('/8653162/v6.shoutout.leaderboard.top', [728, 90], 'div-gpt-ad-1379013535352-1').addService(googletag.pubads());
		googletag.defineSlot('/8653162/v6.sitewide.leaderboard.bottom', [728, 90], 'div-gpt-ad-1379013535352-2').addService(googletag.pubads());
		googletag.defineSlot('/8653162/v6.sitewide.leaderboard.top', [728, 90], 'div-gpt-ad-1379013535352-3').addService(googletag.pubads());
		googletag.defineSlot('/8653162/v6.sitewide.sidebar.lower', [[300, 100], [300, 250]], 'div-gpt-ad-1379013535352-4').addService(googletag.pubads());
		googletag.defineSlot('/8653162/v6.sitewide.sidebar.upper', [[300, 250], [300, 600]], 'div-gpt-ad-1379013535352-5').addService(googletag.pubads());
		googletag.pubads().enableSingleRequest();
		googletag.enableServices();
		});
		</script>

	";

}


function hrld_top_leaderboard_ad() { 

	// Homepage
	echo "<div id='ad-leaderboard'>";
	if(is_front_page()) {

		echo "
			<!-- v6.homepage.leaderboard.top -->
			<div id='div-gpt-ad-1379013535352-0' style='width:728px; height:90px;'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1379013535352-0'); });
			</script>
			</div>
		";

	}

	// Shoutouts
	else if(is_page("shoutouts")) {
		echo "
			<!-- v6.shoutout.leaderboard.top -->
			<div id='div-gpt-ad-1379013535352-1' style='width:728px; height:90px;'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1379013535352-1'); });
			</script>
			</div>
		";
	}
	
	// Other
	else {

		echo "
			<!-- v6.sitewide.leaderboard.top -->
			<div id='div-gpt-ad-1379013535352-3' style='width:728px; height:90px;'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1379013535352-3'); });
			</script>
			</div>	
		";

	}

	echo "</div>";

}

function hrld_bottom_leaderboard_ad() { 


	echo "
		<!-- v6.sitewide.leaderboard.bottom -->
		<div id='div-gpt-ad-1379013535352-2' style='width:728px; height:90px;'>
		<script type='text/javascript'>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1379013535352-2'); });
		</script>
		</div>
	";

}

function hrld_sidebar_ad() { 

	echo "
		<!-- v6.sitewide.sidebar.upper -->
		<div id='div-gpt-ad-1379013535352-5'>
		<script type='text/javascript'>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1379013535352-5'); });
		</script>
		</div>
	";

}

function hrld_sidebar_lower_ad() { 

	echo "
		<!-- v6.sitewide.sidebar.lower -->
		<div id='div-gpt-ad-1379013535352-4'>
		<script type='text/javascript'>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1379013535352-4'); });
		</script>
		</div>
	";

}