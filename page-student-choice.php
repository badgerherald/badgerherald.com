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

get_header(); ?>

		<div id="content" class="site-content" role="main">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						
					</header><!-- .entry-header -->

					<div class="entry-content">
					<?php
						$display_form = true;
						if($display_form):
					?>
						<form action="" method="post" class="quiz-container">
						<?php
							for($i = 0; $i < 6; $i++){
								echo '<div class="quiz-question clearfix">';
								echo '<div class="question-title"><img src="http://www.placecage.com/c/640/180"></div>';
								echo '<ul class="answer-list">';
								for($j = 0; $j < 6; $j++){
									echo '<li class="inactive answer-box quiz_shadow"><input name="hrld_student_choice_'.$i.'" id="hrld_student_choice_'.$i.'_'.$j.'" type="radio" value="question: '.$i.'; answer: '.$j.'"><label for="hrld_student_choice_'.$i.'_'.$j.'"><img src="http://placecage.com/180/180" /><span class="description-wrap"><span class="checkmark-wrap quiz_shadow"><span class="answer-checkmark">&#10003;</span></span><span class="answer-description">The Badger Herald</span></span></label></li>';
									if($j == 2) echo '</ul><ul class="answer-list">';
								}
								echo '</ul>';
								echo '</div>';
							}
						?>
						<label for="hrld_student_choice_email" class="email-input-label">Insert your email. Only valid @wisc.edu emails will be eligible for prizes.</label>
						<input name="hrld_student_choice_email" id="hrld_student_choice_email" class="email-input" type="text" placeholder="Email">
						<input type="submit" class="quiz-submit" value="Submit">
						</form>
					<?php
						else:
					?>
						<div class="quiz-success-wrap clearfix quiz_shadow">
							<p class="quiz-success">Thank you for voting.</p>
							<div class="social-plug">
								<p>Follow us on Twitter and Facebook to be updated on the winners.</p>
								<div class="social-buttons">
									<div class="twitter">
										<a href="https://twitter.com/badgerherald" class="twitter-follow-button" data-show-count="false">Follow @badgerherald</a>
										<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
									</div><!-- .twitter -->

									<div class="facebook">
										<div class="fb-like" data-href="http://facebook.com/badgerherald" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
									</div><!-- .facebook -->
								</div>
							</div>
						</div>
					<?php
						endif;
					?>
					</div><!-- .entry-content -->
				</article><!-- #post -->

		</div><!-- #content -->
<?php get_footer(); ?>