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
/*
function open_db($dbstr, $username, $password, $options) {
    $dbh = new PDO($dbstr, $username, $password);
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
    $index_stmt = $dbh->prepare("SELECT MAX(id) FROM Participants");
    $index_stmt->execute(array());
    $new_id = $index_stmt->fetchAll()[0][0] + 1;
    $add_stmt = $dbh->prepare("INSERT INTO Participants (id, email, quiz) VALUES (?, ?, ?)");
    $add_stmt->execute(array($new_id, $email, $quiz_name));
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
    $index_stmt = $dbh->prepare("SELECT MAX(id) FROM Votes");
    $index_stmt->execute(array());
    $new_id = $index_stmt->fetchAll()[0][0] + 1;
    $add_stmt = $dbh->prepare("INSERT INTO Votes (id, participant_id, option_id) VALUES (?, ?, ?)");
    $add_stmt->execute(array($new_id, $participant_id, $option_id));
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
} */

?>


		<div id="page" class="page-container-fixed-inside">

		<div class="header-sca-2014">
            <a href="http://badgerherald.com"><div class="student-herald-logo">
               
            </div></a>
		</div>

		</div> <!-- #page -->

		<div id="page" class="student-choice-content">
		<div id="wrapper">
		<div id="primary">
		<div id="main" class="site-main">

		<div id="content" class="site-content" role="main">

       

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						 <img src="<?php echo bloginfo("template_url"); ?>/img/student-choice/2014/student-choice.png" class="student-logo"/>
					</header><!-- .entry-header -->

					<div class="entry-content">

                        <p class="tagline">Think you know Madison? Tell us what you think is the <strong>best of Madison</strong> and get entered to <strong>win one of 8 $20 Amazon giftcards!</strong></p>
                        <p style="text-align:center;margin-bottom:12px;"><em>Voting has closed. Raffle winners and results will be released in Monday's Badger Herald.</em></p>

                        <div class="social-plug" style="text-align:center">
                            <p>Follow us on Twitter and Facebook for contest updates</p>
                            <div class="social-buttons">
                                <div class="twitter">
                                    <a href="https://twitter.com/badgerherald" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @badgerherald</a>
                                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                </div><!-- .twitter -->

                                <div class="facebook">
                                    <div class="fb-like" data-href="http://facebook.com/badgerherald" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false" data-height="28" data-width="120"></div>
                                </div><!-- .facebook -->
                            </div>
                            <div class="clearfix"></div>
                            <p><a href="http://badgerherald.com">Back to badgerherald.com</a></p>
                        </div>

					</div><!-- .entry-content -->
				</article><!-- #post -->

		</div><!-- #content -->
<?php get_footer(); ?>  
