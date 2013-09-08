<?php $article['title'] = "Shoutouts";  include('../phi/components/header.homepage.php'); ?>
<?php include("functions.php") ?>
<?php 

$page = mysql_real_escape_string($_GET['page']);

if($page==NULL)
	$page = 1;
$shoutouts = new ShoutoutList($page,40); 

?>


<div id="top-duck" class="duck duck-bottom-12">
<?php// include("/var/www/phi/ads/leaderboard.top.728x90.php"); ?>
</div>

<div class="full-width" id="content-box">



<!--
<span  style="letter-spacing:1px;opacity:.8;color:#fff;text-shadow:-1px 1px 0px rgba(0,0,0,.4);background:#da1c44;width:980px;height:36px;display:block;text-align:center;font-family:'Yanone Kaffeesatz', sans-serif;text-transform:uppercase;font-size:18px;">

<div class="announcement" style="padding:6px 0"><span style="color:#ffdbe3">HMFASO</span> to software issues keeping us from delivering shoutouts recently.  We're back up and running!</div>

</span> -->


<div id="shoutout-header" style="position:relative">
	<div class="shoutout-num"><?php echo $shoutouts->numShoutouts(); ?></div>
	
	<div class="shoutout-title">
	
		<span class="shoutout-tagline">Shoutouts</span><br />
		<span class="shoutout-sub-tag">Keep 'Em Coming</span>
	
	</div>

	<a href="<?php echo SITE_ROOT . SHOUTOUT_ROOT; ?>add.php" class="button" id="new-shoutout-link">Add shoutout</a>	
	
	<div style="clearfix"></div>
</div> 


<article id="article-page">



  <?php echo $shoutouts->getNav('?page='); ?>
			
			
	<?php
		if (!$shoutouts->hasShoutouts()) { 
			echo '<p>HMFASO to there not being any shoutouts yet.  Why not submitting one?</p>';
		}
		else {
			$count=1;
			$pos = rand(1,2)*8;
			foreach($shoutouts->getArray() as $shoutout) {
	 ?>
				
				<!-- THIS IS WHERE EACH SHOUTOUT LIVES -->

				<div class="shoutout-container" id="<?php echo $shoutout->getNum() ?>">
					<p class="shout-out-title" >
						<?php echo "<a class='shoutout-number-link' href='" . SITE_ROOT . SHOUTOUT_ROOT  . "so.php?id=" . $shoutout->getID() . "' title='Shoutout #" . $shoutout->getNum() . "'>"; ?>#<?php echo $shoutout->getNum(); ?></a>
						<?php echo $shoutout->getDate() ?>
					</p>
					<p><?php echo $shoutout->getText(); ?></p>
					<!--<fb:like href="http://"<?php echo (SITE_ROOT . SHOUTOUT_ROOT); ?>/so.php?id=<?php echo $soid; ?>" send="false" layout="button_count" width="100" show_faces="true"></fb:like> -->
				</div><!-- shoutout container -->



				<?php if($count==$pos) { /* ?>
				
				<a href="http://badgerherald.com/shoutouts/vday/" target="_top">
				<div class="shoutout-container sponsored-so">
						<img src="http://badgerherald.com/vday/bh-val.jpg" height="82px" style="float:right;margin-left:20px;margin-bottom:12px;margin-right:20px;margin-top:18px;" />	
	<p class="shout-out-sponsored-title" >
							SPONSORED
					</p>	
					<p>7p.m. tonight is the deadline for purchasing your significant other a SO in Thurday's paper.  Get your shoutout in Thursday's paper for only $3! \ Via <span style="color:#c72987">The Badger Herald</span>.</p>
				<div class="clearfix"></div>
				</div><!-- shoutout container -->
				</a>
				<?php */  ?>

<div style="padding:12px 0;width:624px;height:250px;background:#000;margin-left:-20px;">
<div style="width:300px;height:250px;margin:0 auto">		
<script type="text/javascript"><!--
google_ad_client = "ca-pub-2162610591110839";
/* retangle.300.250 */
google_ad_slot = "5447265713";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
</div>


				<?php  } ?>
				

				<?php
				$count+=1;
			} /* For each shoutout */
		} /* else */
	?>
	
	<?php echo $shoutouts->getNav('?page='); ?>
	
	<div class="clearfix"></div>
	</article>
  
  

<div id='page-sidebar'>





<?include("/var/www/phi/ads/ad.chunk.php");?>

<div id="galleries">
	<a href="http://badgerherald.com/news/2013/05/05/may_4th_the_day_in_p.php">
	<img src="http://badgerherald.com/mifflin.jpg" width="336px" style="margin-bottom:24px"/>
</a>
</div>

<div id="trending-stick"></div>
<div id="trending">

<h2>Trending Now</h2>
<br/>
<!-- AddThis Trending Content BEGIN -->
<div id="addthis_trendingcontent"></div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50a9ae9076eb245c"></script>
<script type="text/javascript">
addthis.box("#addthis_trendingcontent", {
    feed_title : "",
    feed_type : "trending",
    feed_period : "week",
    num_links : 7,
    height : "auto",
    width : "auto",
    domain : "badgerherald.com"});
</script>
<!-- AddThis Trending Content END -->

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

<br />
<div id="top-duck" class="duck duck-bottom-12">
<?php include("/var/www/phi/ads/leaderboard.bottom.728x90.php"); ?>
</div>

  </div><!-- Wrap -->
  

  <?php include('/var/www/phi/components/footer.php'); ?>
  </body>
</html>