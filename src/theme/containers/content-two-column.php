<?php 

$container = $GLOBALS['container'] ?: new container('article-display');
$container->default_args(
	array('layout' => 'standard')
	);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php 
$args = array();
$args['center'] = ( exa_layout() == 'feature' );

exa_container('headline',$args);
?>

    <div class="<?php echo $container->classes(); ?> article-display <?php echo $container->args['layout']; ?>">
        <div class="wrapper">
            <main class="article-content">

                <?php if( !is_page()): // display byline and date on if it's not a page.?>
                <div class="meta">
                    <?php /* Mug: */ ?>
                    <div class="mug-box">
                        <?php exa_mug(get_the_author_meta('ID'),'small-thumbnail') ?>
                    </div>

                    <?php /* Byline: */ ?>
                    <span class="byline">
                        by <a class="author-link" href="<?php exa_the_author_link() ?>"
                            title="<?php echo exa_properize(get_the_author()); ?> Profile">
                            <?php the_author() ?>
                        </a>
                    </span> &middot; <span class="meta-time"><?php the_time("M j, Y") ?></span>


                    <a class="facebook-button" target="_blank" href="<?php echo exa_facebook_link(); ?>">Share</a>
                    <a class="tweet-button" target="_blank" href="<?php echo exa_tweet_link(); ?>">Tweet</a>
                </div>
                <?php endif; ?>


                <?php
			if (exa_hero_style() == "standard" && exa_hero_media() != "none") :		
			?>
                <div class="hero">
                    <?php the_post_thumbnail('image-post-size'); ?>
                    <?php exa_hero_caption(); ?>

                    <div class="clearfix"></div>

                </div>

                <?php 
			endif; 
			?>

                <section class="article-text">

                    <?php the_content(); ?>

                </section>

            </main>

            <?php if($container->args['layout'] == 'standard') : ?>
            <hrld-article-sidebar class="sidebar"></hrld-article-sidebar>

            <?php endif; ?>

            <div class="clearfix"></div>



        </div><!-- .wrapper -->

    </div><!-- .container -->

</article><!-- #post-xx -->

<?php 

if( !is_page()) {
	exa_container('footnotes');
}