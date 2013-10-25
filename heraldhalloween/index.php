<?php
/**
 * Template for #heraldhalloween
 *
 * @package WordPress
 * @subpackage exa
 * 
 */

function show_block_user_box() {

}

function show_delete_entry() {

}

get_header();
?>

<?php /* The loop */ ?>

<?php while ( have_posts() ) : the_post(); ?>
        if (is_user_logged_in()) {
           show_block_user_box();
        }

        

?>

<?php endwhile; ?>
<?php get_footer(); ?>