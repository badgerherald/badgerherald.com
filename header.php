<?php
/**
 * The Header for our theme.
 */

?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	
	<meta name="viewport" content="width=device-width, 
	minimum-scale=1.0, maximum-scale=1.0">

	<?php /* Remove 300ms tap delay for mobile zoom */ ?>
	<meta name="viewport" content="width=device-width, user-scalable=no">

	<!-- Chartbeat timestamp -->
	<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>

	<title><?php echo wp_title("&middot;",true,"right"); ?></title>


	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php /* Facebook like button javascript tag */ ?>

<?php /* #page opened here, closed in footer.php */ ?>
<div id="page">


<?php
function jp_debug_rewrite_rules($where = 'head') {
    // only do this on public side
    if( is_admin() ) return false;

    global $wp_rewrite, $wp, $template;

    if (!empty($wp_rewrite->rules)) { ?>

        <style>h5{background:#000!important;color:#fff!important;padding:1em!important;margin:1em!important}table{margin:1em!important}table td{border:1px solid silver;padding:5px}tr.matchedrule td{border-color:transparent}tr.matchedrule>td{background:HSLA(52,96%,67%,1)}tr.matchedrule+tr.matchedrule>td{background:HSLA(52,96%,67%,.5)}tr.matchedrule table td+td{font-weight:700}</style>

        <h5>Rewrite Rules</h5>
        <table>
            <thead>
                <tr>
                    <td>
                    <td>Rule
                    <td>Rewrite
                </tr>
            </thead>
            <tbody>
        <?php
        $i = 1;
        var_dump($wp);
        foreach ($wp_rewrite->rules as $name => $value) {
            
            if( $name == $wp->matched_rule ) {

                echo '<tr class="matchedrule">
                    <td>' . $i . '
                    <td>'.$name.'
                    <td>' . $value . '
                    </tr>
                    <tr class="matchedrule">
                    <td colspan="3">
                        <table>
                            <tr><td>Request
                                <td>' . $wp->request . '
                            <tr><td>Matched Rewrite Query
                                <td title="'.urldecode($wp->matched_query).'">' . $wp->matched_query . '
                            <tr><td>Loaded template
                                <td>'. basename($template) . '
                        </table>
                    </td>
                    </tr>';

            } else {
                echo '<tr>
                    <td>'.$i.'
                    <td>'.$name.'
                    <td>'.$value.'
                  </tr>';
            }
            $i++;
        }
        ?>
            </tbody>
        </table>

    <?php

	}
}    

jp_debug_rewrite_rules();

?>