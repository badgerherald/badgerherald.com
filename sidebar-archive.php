<?php
/**
 * The sidebar for the front page, archive pages and taxonomy pages.
 * Listing of the top stories of the week, via the Wordpress
 * Popular Posts plugin.
 *
 * @package WordPress
 * @subpackage exa
 * @since 9/30/2013
 */

?>
<div id="sidebar" class="stream-sidebar">
    <div class="sidebar-inner fixed-sidebar-container">
        <h2 id="categories-headline" class="categories-headline">Categories</h2>
        <div class="sidebar-scroll">
            <ul class="categories-list">
				<?php
					$category = get_post_type();
					$beats_list = exa_get_beats_slug_list($category);
					foreach($beats_list as $beat):
					$beat_obj = get_term_by('slug',$beat,$category.'-beats');
                ?>
                	<li><a href="<?php bloginfo('url'); ?>/<?php echo $category; ?>/beats/<?php echo $beat; ?>/"><?php echo $beat_obj->name; ?></a></li>
                <?php
                	endforeach;
                ?>
            </ul>
        </div><!-- class="sidebar-scroll" -->
    </div><!-- class="inner-sidebar" -->
</div><!-- id="sidebar" -->