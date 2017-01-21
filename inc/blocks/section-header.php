<?php 

global $DoubleClick;

?>

<header class="block section-header">
	<?php
	if(is_author()) :
	?>
		<div class="author-mug">
			<?php exa_mug(null, 'square'); ?>
		</div>
	<?php endif; ?>
	<div class='bottom-divider'>
	<h1>
		<?php 

		if(is_author()) {
			echo get_the_author_meta('display_name');
		} else {
			single_cat_title(); 
		}

		?>
	</h1> 
	<?php 
	if(is_author() && exa_author_current_role()) {
		echo "<h3 class='role'>" . exa_author_current_role() . "</h3>";
	} else {
		do_action('exa_after_category_title');
	}
	?>
	</div>

	<?php 
	if( is_author() && exa_author_bio() ) {
		echo "<p class='bottom-divider'>" . exa_author_bio() . "</p>";
	} else if( category_description() != "" ) {
		echo "<span class='bottom-divider'>" . category_description() . "</span>";
	}

	$cat = get_query_var( 'cat' );
	$cat = $cat ? get_category( get_query_var( 'cat' ) ) : null;
	$editors = $cat ? exa_staff_editors_for_category($cat) : null;

	if(!empty($editors)) {
		foreach ($editors as $editor_id) {
			$user = get_user_by('id',$editor_id);
		?>
			<a class="editor" href="<?php echo get_author_posts_url($editor_id) ?>" title="<?php echo exa_properize(get_the_author()); ?> Profile">
				
				<div class="mug">
					<?php exa_mug($editor_id,'small-thumbnail') ?>
				</div>
			
				<span class="name"><?php echo $user->display_name; ?></span>
				<?php //if(exa_author_current_role() != '') : ?>
					<span class="position"><?php echo exa_author_current_role($editor_id); ?></span>
				<?php // endif; ?>

			</a>
			<div class="clearfix"></div>

			<?php 
		}
	}
	?>

</header>

<div class="ad sidebar-thing" style="background:white">
	<?php 
	$DoubleClick->place_ad(
					'bhrld.dev-upper-sidekick',
					array(
						'phone'=>'',
						'desktop'=>'300x600,300x250'
						)
					);
	?>
</div>

<?php if (is_category() || is_tax('topic') ) : ?>

<div class="block section-footer">

	<?php 
	$args = array();
	
	if( is_tax('topic') ) {
		$args['tax_query'] = array(
		array(
			'taxonomy' => 'topic',
			'field' => 'slug',
			'terms' => array('explainers',get_query_var( 'topic' )),
			'operator' => 'AND'
			),
		);
	} else {
		$args['tax_query'] = array(
		array(
			'taxonomy' => 'topic',
			'field' => 'slug',
			'terms' => array('explainers'),
			'operator' => 'IN'
			),
		array(
			'taxonomy' => 'category',
			'field' => 'id',
			'terms' => get_query_var('cat'),
			'operator' => 'IN'
			),
		);
	}
	$args['posts_per_page'] = 5;
	$query = new WP_Query( $args );
	?>


	<?php if ( $query->have_posts($query) ) : ?>
	
	<div class="explainers">	

		<h4>Explainers</h4>
		<ol>
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
		<?php endwhile; ?>
		</ol>
	
	</div>
	<?php endif; ?>

</div>

<?php endif; ?>

<div class="ad sidebar-thing" style="background:white;padding-top:24px">
	<?php 
	$DoubleClick->place_ad(
					'bhrld.dev-lower-sidekick',
					array(
						'phone'=>'',
						'desktop'=>'300x600,300x250'
						)
					);
	?>
</div>

