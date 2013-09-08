<?php

/** REQUIRE the config file.  This differs from including, because it
 *  makes sure only one instance is included.  (If two config files are
 *  loaded, shit fucks up).
 */
require("../config.php");


$og['title'] = "A Shoutout For Your Significant Other.";
$og['type'] = "website";
$og['img'] = "http://badgerherald.com/vday/bh-val.jpg";
$og['url'] = "http://badgerherald.com/vday/";
$og['description'] = "The Badger Herald &mdash; makin' matches since '69.";

/* The shoutout # that was requested (from the URL ?s=) */
$soid = $_GET['id'];

/* First, we fetch the current set of shoutouts 'setid', from the export date table */
$setid = mysql_fetch_assoc(mysql_query('SELECT MAX(setidofexported) as "setid" FROM shoutouts_exports'));
$setid = (int)$setid[setid];

/* We write a query to fetch all APPROVED shoutouts from the current SETID */
$sql = "SELECT text, `date`, `id`, `sonum`, `setid` FROM shoutouts_new WHERE id='$soid' AND approved=1 ORDER BY `date` DESC";

$result = mysql_query($sql);

$lastset = false;
$indexed = false;


?>



<?php include('/var/www/phi/components/header.php'); ?>

<div id="top-duck" class="duck duck-bottom-12">
<?include("/var/www/phi/ads/leaderboard.top.728x90.php");?>
</div>

<?php include("../functions.php") ?>
<?php 

$page = mysql_real_escape_string($_GET['page']);

if($page==NULL)
	$page = 1;
$shoutouts = new ShoutoutList($page,40); 

?>

<div class="full-width" id="content-box">

<div id="shoutout-header">
	<div class="shoutout-num"><?php echo $shoutouts->numShoutouts(); ?></div>
	
	<div class="shoutout-title">
	
		<span class="shoutout-tagline">Shoutouts this week</span><br />
		<span class="shoutout-sub-tag">Keep 'Em Coming</span>
	
	</div>

	<a href="<?php echo SITE_ROOT . SHOUTOUT_ROOT; ?>" class="button" id="new-shoutout-link">Back to Browsing</a>	
	
	<div style="clearfix"></div>
</div> 

<article id="article-page">  

<h2>Buy your SO a SO</h2>
<p>Have something sweet to say to your significant other or crush from afar this V-Day? Sponsor a SO for your SO this Thursday on The Badger Herald's special V-Day Shout Out page for just $3. <span style="color:#cb01bf"><strong>Purchase your SO to show that special someone just how much you care.</span> </strong></p>

<p>Valentine's Day SOs are <span style="color:#cb01bf"><strong>$3</strong></span> and are guaranteed to be printed.  As always, your Shoutout will be printed anonymously.  All shoutouts will run in a special section of the Thursday, Feb. 14 2013 issue of The Badger Herald</p>




<h3>$3 - Purchase one:</h3>
<p>We're sorry, the deadline has passed</p>
<?php /*
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="6ELGBU4TYWAML">
<table>
<tr><td><input type="hidden" name="on0" value="Enter your Shoutout:">Enter your Shoutout:</td></tr><tr><td><input style="margin-bottom:12px;" type="text" name="os0" maxlength="200"></td></tr>
<tr><td><input type="hidden" name="on1" value="Email Address">Email Address</td></tr><tr><td><input style="margin-bottom:12px;" type="text" name="os1" maxlength="200"></td></tr>
</table>
<!--
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"> -->

<input type="submit" class="button" value="Pay with Paypal" />
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
<br/>

*/ ?>
<p><i>The Badger Herald &mdash; makin' matches since '69. </i></p>
<p><div class="fb-like" data-href="http://badgerherald.com/shoutouts/vday/" data-send="true" data-width="450" data-show-faces="true"></div></p>
	
	<div class="clearfix"></div>
	</article>  
<div id='page-sidebar'>




<div id="sidebar-ducks">

	<div id="sidebar-square-duck" class="duck">
	
		<a href="#">
			<?include("/var/www/phi/ads/rect.336x280.php");?>
	
		</a>
	</div>
	<?php /*
	<div id="sidebar-duck-column" class="duck">
	
		<a href="#">
			<?include("/var/www/phi/ads/skyscraper.160x600.php");?>
		</a>
	
	</div>
	
	<div id="sidebar-duck-column" class="duck-left-margin">
		<div class="duck duck-bottom-12">
			<a href="#">
				<?include("/var/www/phi/ads/square.160x160.php");?>
			</a>
		</div>
		
		<a href="http://badgerherald.com/ads" class="duck-link">Advertise With The Herald</a>
		
		<div class="duck">
			<a href="#">
				<?include("/var/www/phi/ads/skyscraper.160x400.php");?>
			</a>
		</div>
			
	</div>
	*/ ?>
	<div class="clearfix"></div>
	
	<div id="sidebar-duck-text" class="duck">
<?include("/var/www/phi/ads/ads.text.php");?>
	</div>
	
</div>




<div class="clearfix" style="clear:both;"> </div>
</div><!-- Sidebar -->
  <script>
  $(document).ready(function() {
	  
	  /* Event that binds click to submit SO to open new box */
	  
	//  $("#new-shoutout-link").click(function(e) {
	//	  e.preventDefault();

	//	  $(this).siblings('#new-shoutout-box').slideDown();
		  
	//	  $(this).html("Post it");
		  /* we must now bind this button to submit the form */
	//	  $(this).click(function(f) {
			  
	//		  f.preventDefault();
	//		  addShoutout();
			  
	//	  });

	//  });
	  
	  /* Event that binds close to close the box */
	  
	//  $("#shoutout-box-close").click(function(e) {
	//	  e.preventDefault();

	//	  $(this).parent('#new-shoutout-box').slideUp();

	//  });
	  
	  /* Function that makes the call to add the shoutout. */

	//  function addShoutout() {
	//	  $.ajax({
	//		  type: 'POST',
	//		  url: 'add.php',
	//		  dataType: 'text',
	//		  data: { shoutout_text:$('form[name=newshoutout]').find("textarea[name=shoutout_text]").val()},
	//		  success: function(data) {
	//			  data = $.parseJSON(data);
	//			 if(data.success) {
	//				 alert('sent!');
	//			 }
	//			 else
	//			 	 alert("Message Not Sent");
	//			} // FUNCTION
	//   });	// AJAX
	// }
	   
	  
	  /* Function the updates necessary elements on ajax return */
	  
	  
	  /* Function that inserts social media links */
	  
	  
  });
  

  </script>
  
  <div class="clearfix"></div>
  </div><!-- full-width -->
  </div><!-- Wrap -->
  

<br />
<div id="top-duck" class="duck duck-bottom-12">
<?include("/var/www/phi/ads/leaderboard.bottom.728x90.php");?>
</div>

  <?php include('/var/www/phi/components/footer.php'); ?>
  </body>
</html>