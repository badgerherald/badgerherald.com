<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<?php ?>
<article id="post-<?php the_ID(); ?>" <?php post_class("pullout-inline"); ?>>
    <a class="post-link clearfix" href="<?php the_permalink(); ?>" rel="bookmark">
        
        
        <div class="entry-thumbnail col-2">
            <?php the_post_thumbnail(); ?>
        </div>

        <header class="entry-header col-4">
        
        <span class="topic-label small-topic-label"><?php echo exa_topic( $post->ID ); ?></span>
        
        <h2 class="entry-title">
            <?php the_title(); ?>
        </h2>
    </header><!-- .entry-header -->
        <!-- <div class="clearfix"></div> -->

    </a>

    <div class="clearfix"></div>


</article><!-- #post -->
