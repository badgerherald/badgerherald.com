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


get_header("just-head");

function open_db($dbstr) {
    $dbh = new PDO($dbstr);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    return $dbh;
}

function get_questions($dbh, $quiz_name) {
    $quiz_stmt = $dbh->prepare('SELECT * FROM Questions WHERE quiz = ?');
    $quiz_stmt->execute(array($quiz_name));
    return $quiz_stmt->fetchAll();
}

function get_options($dbh, $question_id) {
    $options_stmt = $dbh->prepare("SELECT * FROM Options WHERE question_id = ?");
    $options_stmt->execute(array($question_id));
    return $options_stmt->fetchAll();
}

function find_participant($dbh, $email, $quiz_name) {
    $participant_stmt = $dbh->prepare("SELECT * FROM Participants WHERE email = ? AND quiz = ?");
    $participant_stmt->execute(array($email, $quiz_name));
    $results = $participant_stmt->fetchAll();
    if (count($results) < 1) {
        return NULL;
    }
    return $results[0]["id"];
}

function create_participant($dbh, $email, $quiz_name) {
    $add_stmt = $dbh->prepare("INSERT INTO Participants (email, quiz) VALUES (?, ?)");
    $add_stmt->execute(array($email, $quiz_name));
    // Ugly hack
    return find_participant($dbh, $email, $quiz_name);
}

function option_voted_on($dbh, $participant_id, $option_id) {
    $voted_stmt = $dbh->prepare("SELECT * FROM Votes WHERE participant_id = ? AND option_id = ?");
    $voted_stmt->execute(array($participant_id, $option_id));
    if (count($voted_stmt->fetchAll()) > 0) {
        return true;
    } else {
        return false;
    }
}

function add_vote($dbh, $participant_id, $option_id) {
    if ($option_id === null) {
        return;
    }
    $add_stmt = $dbh->prepare("INSERT INTO VOTES (participant_id, option_id) VALUES (?, ?)");
    $add_stmt->execute(array($participant_id, $option_id));
}

function valid_wisc($email) {
    $email = strtolower($email);
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        return FALSE;
    } else {
        if (strpos($email, "wisc.edu") === FALSE) {
            return FALSE;
        }
    }
    return TRUE;
}

?>


		<div id="page" class="page-container-fixed-inside">

		<div class="header-sca-2014">


		</div>

		</div> <!-- #page -->

		<div id="page" class="student-choice-content">
		<div id="wrapper">
		<div id="primary">
		<div id="main" class="site-main">

		<div id="content" class="site-content" role="main">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						
					</header><!-- .entry-header -->

					<div class="entry-content">
					<?php
                    $display_form = true;
                    $valid = true;
                    $quiz_name = "student-choice-2014";
                    $dbh = open_db("sqlite:/vagrant/wordpress/wp-content/themes/exa/votes.db");
                    $questions = get_questions($dbh, $quiz_name);
                    if ('POST' == $_SERVER['REQUEST_METHOD']) {
                        if (! array_key_exists("hrld_student_choice_email", $_POST)) {
                            $valid = false;
                        } else {
                            $email = $_POST["hrld_student_choice_email"];
                            if (valid_wisc($email)) {
                                $participant = find_participant($dbh, $email, $quiz_name);
                                if ($participant === NULL) {
                                    $participant = create_participant($dbh, $email, $quiz_name);
                                }
                            } else {
                                // TODO: Show invalid email alert
                                $valid = false;
                            }
                        }
                        if ($valid === true) {
                            $options = array();
                            for ($i = 0; $i < count($questions); $i++) {
                                if (array_key_exists("hrld_student_choice_$i", $_POST)) {
                                    $option_id = $_POST["hrld_student_choice_$i"];
                                } else {
                                    $option_id = NULL;
                                }
                                $options[$i] = $option_id;
                            }
                            
                            try {
                                foreach ($options as $option) {
                                    if (!option_voted_on($dbh, $participant, $option)) {
                                        add_vote($dbh, $participant, $option);
                                    }
                                }
                                $display_form = false;                      
                            } catch (Exception $e) {
                                echo '<p>There was an error!</p>';
                            }
                        }
                    }
                    
					if($display_form):
					?>
						<form action="" method="post" class="quiz-container">
						    <?php       
						    for($i = 0; $i < count($questions); $i++){
								echo '<div class="quiz-question clearfix">';
								echo '<div class="question-title"><img src="http://www.placecage.com/c/600/180"></div>';
								echo '<ul class="answer-list">';
      
                                $current_question = $questions[$i];
                                $question_id = $current_question["id"];
                                $options = get_options($dbh, $question_id);                                
								for($j = 0; $j < count($options); $j++){
                                    $current_option = $options[$j];
									echo '<li class="inactive answer-box"><input name="hrld_student_choice_'.$i.'" id="hrld_student_choice_'.$i.'_'.$j.'" type="radio" value="' . $current_option['id'] . '"><label for="hrld_student_choice_'.$i.'_'.$j.'"><img src="' . $current_option["photo_link"] . '" /><span class="answer-description">' . $current_option["text"] . '</span></label></li>';
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
						<div class="quiz-success-wrap clearfix">
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