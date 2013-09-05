<?php $article['title'] = "Shoutouts"; include('../phi/components/header.php'); ?>
<?php include("functions.php") ?>
<?php 

$page = mysql_real_escape_string($_GET['page']);

if($page==NULL)
	$page = 1;
$shoutouts = new ShoutoutList($page,40); 

?>

<a href="http://badgerherald.com/artsetc/2013/02/10/the_badger_herald_li.php"
	style="
		font-family:'Yanone Kaffeesatz', sans-serif;
		margin-bottom:20px;
		text-transform:uppercase;
		text-align:center;
		width:980px;
		display:block;
		font-size:40px;
	">
	Watching the Grammys?  We are live-blogging! &rarr;</a>

<div class="full-width" id="content-box">


<a href="#" onMouseOver="this.style.opacity=1" onMouseOut="this.style.opacity=.8" style="letter-spacing:1px;opacity:.8;color:#fff;text-shadow:-1px 1px 0px rgba(0,0,0,.4);background:#a9a413;width:980px;height:36px;display:block;text-align:center;font-family:'Yanone Kaffeesatz', sans-serif;text-transform:uppercase;font-size:18px;">

<div class="announcement" style="padding:6px 0"><span style="color:#000">(Video)</span> Gearing up for the Oscars?  Arts Editor Tim Haddick tells you What to Look For Tonight.</div>

</a>


<div id="shoutout-header">
	<div class="shoutout-num"><?php echo $shoutouts->numShoutouts(); ?></div>
	
	<div class="shoutout-title">
	
		<span class="shoutout-tagline">Shoutouts this week</span><br />
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
			$pos = rand(1,2)*10;
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



				<?php if($count==$pos) { ?>
				
		
				<a href="http://badgerherald.com/vday" target="_top">
				
				<div class="shoutout-container sponsored-so">
					
						<img src="http://badgerherald.com/vday/bh-val.jpg" height="82px" style="float:right;margin-left:20px;margin-bottom:12px;margin-right:20px;margin-top:18px;" />				

	<p class="shout-out-sponsored-title" >
							SPONSORED
					</p>
					

					
					<p>HMFASO to finding the right valentine's day gift for that SO. But DSO to The Badger Herald's Valentine's Day Gift Guide! \ Via <span style="color:#c72987">The Badger Herald</span>.</p>

				<div class="clearfix"></div>
				</div><!-- shoutout container -->
				
				</a>



<?php }  ?>
				
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
<?include("/var/www/phi/ads/leaderboard.bottom.728x90.php");?>
</div>

  </div><!-- Wrap -->
  

  <?php include('/var/www/phi/components/footer.php'); ?>
  </body>
</html>