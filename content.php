<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/* This is a change */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		
 		<div class="post-sidebar">
			<div class="post-sidebar-scroll fixed-sidebar-container">
			<div class="meta-author">

				<a class="meta-author-avatar" title="<?php echo exa_properize(get_the_author()); ?> Profile" href="<?php exa_the_author_link() ?>">
					<?php echo get_wp_user_avatar(get_the_author_meta('ID'), 'small-thumbnail'); ?>
				</a>
				<span class="author">by <a href="<?php exa_the_author_link() ?>" title="<?php echo exa_properize(get_the_author()); ?> Profile"><?php the_author() ?></a></span>
				<span class="author-position">The Badger Herald</span>
				
				<?php // If twitter // TODO: if the username is too long, hide it.
				if(hrld_author_has("hrld_twitter_handle",$staff)) {
					$twitter_handle = get_hrld_author("hrld_twitter_handle",$staff);
					echo "<a href='https://twitter.com/$twitter_handle' class='twitter-follow-button' data-show-count='false'>Follow @$twitter_handle</a>";
					echo "<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>";
				} ?>

			</div>

			<div class="post-sidebar-ad">
				<?php dfp::hrld_sidebar_lower_ad(); ?>
			</div>
            </div>

		</div>

		<article class="article-post">

		<div class="post-meta content-meta-data">
			<span class="meta-time">Posted <strong><?php the_time("M j, Y") ?></strong> at <strong><?php the_time("g:i a"); ?></strong></span>
		</div>
		
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<h2 class="entry-excerpt"><?php if(hrld_has_subhead(get_the_ID())){hrld_the_subhead();} ?></h2>

		<div class="mobile-post-meta post-meta">
				<a class="meta-author-avatar" title="<?php echo exa_properize(get_the_author()); ?> Profile" href="<?php exa_the_author_link() ?>">
					<?php echo get_wp_user_avatar(get_the_author_meta('ID'), 'small-thumbnail'); ?>
				</a>
				<span class="meta-author">by <a href="<?php exa_the_author_link() ?>" title="<?php echo exa_properize(get_the_author()); ?> Profile"><?php the_author() ?></a></span><br/>
				<span class="meta-time">Posted <strong><?php the_time("M j, Y") ?></strong> at <strong><?php the_time("g:i a"); ?></strong></span>
				<div class="clearfix"></div>
		</div>

		<!-- AddThis Button BEGIN -->
		<div class="addthis_toolbox addthis_default_style ">
		<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
		<a class="addthis_button_tweet"></a>
		</div>
		<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=badgerherald"></script>
		<!-- AddThis Button END -->
		
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		
		<div class="entry-post-featured">

			<div class="entry-img-featured">

				<?php the_post_thumbnail('image-post-size'); ?>
			
				<?php
				$thumb_id = get_post_thumbnail_id($post->ID);
				$args = array(
					'post_type' => 'attachment',
					'post_status' => null,
					'post_parent' => $post->ID,
					'include'  => $thumb_id
				); 

	   			$thumb_image = get_post($thumb_id);

	   			$credit = get_hrld_media_credit($thumb_id);
	   			$exerpt = $thumb_image->post_excerpt;

	   			if($credit != "") :
		   			if(get_user_by('login', $credit)){
						$hrld_user = get_user_by('login', $credit);
						$html_text = '<span class="hrld-media-credit"><span class="hrld-media-credit-name"><a href="'.get_bloginfo('url').'/author/'.$credit.'">'.$hrld_user->display_name.'</a></span><span class="hrld-media-credit-org">/The Badger Herald</span></span>'; 
					} else{
						$hrld_credit_name_org = explode("/", $credit);
						if($hrld_credit_name_org[1]){
							$html_text = '<span class="hrld-media-credit"><span class="hrld-media-credit-name">'.$hrld_credit_name_org[0].'</span><span class="hrld-media-credit-org">/'.$hrld_credit_name_org[1].'</span></span>';
						}
						else{
							$html_text = '<span class="hrld-media-credit"><span class="hrld-media-credit-org">'.$hrld_credit_name_org[0].'</span></span>';
						}
					}
				?>
	   			<div class="entry-post-featured-credit">
	   				<?php echo $html_text; ?>
	   			</div>
	   				
	   			<?php endif; ?>

	   		</div><!-- class="entry-img-featured" -->

			<?php if($exerpt != "") : ?>
				<div class="entry-post-featured-caption">
					<?php echo $exerpt; ?>
  				</div><!-- class="entry-post-thumbnail-caption" -->
			<?php endif; ?> 
   			
   		</div><!-- class="entry-post-featured" -->


		<?php endif; /* has post thumbnail */ ?>

		<div id="content">

			<div class="article-content">

			<?php the_content(); ?>

			<?php /* Bottom sharebar */ ?>

			<div class="sharebar">

				<span class="sharetag">Share</span>
				<input class="sharebarurl" type="text" onclick="$(this).select()" value="<?php echo exa_short_url() ?>"/>
				

				
				<div class="sharebarfb">
				<div  class="fb-like" 
					  data-href="<?php echo the_permalink(); ?>" 
					  data-layout="button_count" 
					  data-action="like" 
					  data-width="90"
					  data-show-faces="false" 
					  data-share="true">
				</div>
				</div>
				<div class="sharebartwitter">
				<a  href="https://twitter.com/share" 
					class="twitter-share-button " 
					data-url="<?php echo exa_short_url(); ?>" 
					data-text="<?php echo the_title(); ?>." 
					data-via="badgerherald" 
					data-related="badgerherald">Tweet</a>
				</div>

				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				
			</div>
			

			<?php /* Simple widget to show Editorial Board members */ ?>
			<?php if( get_the_author() == "Badger Herald Editorial Board" ) : ?>
				
				<h4 class="article-signature edboard-signature"> &mdash; The Badger Herald Editorial Board </h4>
				<?php hrld_edboard::printEdboardList(); ?>

			<?php endif; ?>


			<?php /* Simple LTE disclaimer */ ?>
			<?php if( get_the_author() == "Letter to the Editor" ) : ?>
				<p class="letter-to-editor-disclaimer"><em><strong>Letters to the editor</strong> are published on the discretion of the opinion desk and editor. They may not reflect the views of the Herald. Email your own letters to the editor to oped@badgerherald.com</em></p>
			<?php endif; ?>


			</div>

		</div><!-- id="content" -->

		</article>
	
</article><!-- #post -->
