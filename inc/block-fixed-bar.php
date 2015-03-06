<div class="fixed-bar-block-placeholder"></div>
<div class="fixed-bar-block block">

	<?php /* container for the mobile hamburger icon */ ?>
	<div class="nav-control" alt="Menu"></div>

	<div class="wrapper bar-content">
			
		<a href="<?php echo bloginfo("url"); ?>"><div class="bar-logo">The Badger Herald</div></a>
		
		<div class="fixed-bar-dock">
			
			<a class="category" href="<?php echo home_url('/') . $wp_query->query_vars['category_name']; ?>">
			<?php
				if (!is_page()) {
					echo ucfirst($wp_query->query_vars['category_name']);
				} else {
					echo ucfirst($wp_query->query_vars['name']);
				}
			?>
			</a>
			<?php
			if (is_single()) :
			?>
			<span class="title">
			<?php
				$post_author = get_userdata($post->post_author);
				echo $post->post_title;
			?>
			</span>
			<?php echo '<span class="byline">by <a href="'. get_author_posts_url($post->post_author) .'">'.$post_author->display_name.'</a></span>'; 
			elseif (is_author()) :
		    ?>
		        <span class="title author-title">
		        <?php
		            $author = get_user_by('id', get_query_var('author'));
					$avatar_src = get_wp_user_avatar_src(get_the_author_meta('ID', get_query_var('author')), 'original');
            		$avatar_crop = hrld_resize(null, $avatar_src, 200, 200, true);
            	?>
            		<span class="avatar"><img src="<?php echo $avatar_crop['url']; ?>" alt="<?php echo $author->display_name;?>" width="<?php echo $avatar_crop['width'];?>" height="<?php echo $avatar_crop['height'];?>" /></span>
            	<?php
					echo '<span class="name">'.$author->display_name.'</span>';
				?>
				</span>
			<?php endif; ?>
			
		</div>

	</div>

	<?php /* Progress Bar */ ?>
	<?php
	if (is_single()) { ?>
		<div class="progress">
		  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
		  </div>
		</div>
	<?php } ?>

</div><!-- block -->