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
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>

						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<form action="" method="post" class="quiz-container">
						<?php
							for($i = 0; $i < 6; $i++){
								echo '<div class="quiz-question clearfix">';
								echo '<div class="question-title"><h3>Question '.$i.'</h3><br /></div>';
								echo '<ul class="answer-list">';
								for($j = 0; $j < 6; $j++){
									echo '<li class="inactive answer-box quiz_shadow"><input name="hrld_student_choice_'.$i.'" id="hrld_student_choice_'.$i.'_'.$j.'" type="radio" value="question: '.$i.'; answer: '.$j.'"><label for="hrld_student_choice_'.$i.'_'.$j.'"><img src="http://placekitten.com/180/180" /><span class="answer-description">The Badger Herald</span></label></li>';
									if($j == 2) echo '</ul><ul class="answer-list">';
								}
								echo '</ul>';
								echo '</div>';
							}
						?>
						</form>
					</div><!-- .entry-content -->
				</article><!-- #post -->

		</div><!-- #content -->
<?php get_footer(); ?>