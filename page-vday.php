<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */


get_header('vday'); 

?>

	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="header-box">
			<h1>Herald Valentine</h1>
			<h2>Send a SO to your SO</h2>
		</div>

<div id="stream">
<?php
	$to = 'soc@badgerherald.com';
	$messageSubject = 'VDay SO';
	$name = '';
	$soTo = '';
	$message = '';
	if($_POST){
		$name = stripslashes($_POST['so_name']);
		$soTo = stripslashes($_POST['soTo']);
		$message = stripslashes($_POST['shoutout_text']);
		if($name && $soTo && $message){
			$name = str_replace(array("\r","\n"),array(" "," "),$name);
			$soTo = str_replace(array("\r","\n"),array(" "," "),$soTo);
			$message = str_replace(array("\r","\n"),array(" "," "),$message);
			$message = wordwrap($message, 70, "\r\n");
			$formContent = "Name: $name \n SO is to: $soTo \n SO Message: $message \n";
			if(mail($to, $messageSubject, $formContent, "From: VDAY SO\r\n")){
				echo '<p>SO sent successfully.</p>';
			}
			else{
				echo '<p>We\'re sorry. Your SO could not be sent. Please try again.</p>';
			}
		}
	}
?>
<form id="shoutout-form" method="POST" action="">
		<input class="so-name" name="so_name" placeholder="Your Name" value="<?php echo htmlspecialchars($name); ?>" />
		<input class="so-name-to" name="so_name_to" placeholder="Their Name" value="<?php echo htmlspecialchars($soTo); ?>" />
		<textarea class="so-text" name="shoutout_text" wrap="virtual" placeholder="SO to..."><?php echo strip_tags($message); ?></textarea>

		<input class="so-button submit-so-button" name="" type="submit" value="Shout it out"/>


	</form>
	<img class="so-avatar" src="<?php bloginfo('template_url') ?>/img/icons/shoutout.png" />

</div>


<?php 
endwhile;
get_footer(); ?>