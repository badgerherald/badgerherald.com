
<?php 
   global $DoubleClick;
?>

<bh-grid class="above-the-fold">
   <div class="features">
      <?php
         $key = serialize($roles);
         $query_args = array(
         	'post_status'	=> 'publish',
         	'tax_query' => array(
         		array(
         			'taxonomy' => 'importance',
         			'field' => 'slug',
         			'terms' => 'featured'
         		)
         	),
         	'no_found_rows' => true,
         );
         
         if ( ! $my_query = wp_cache_get("exa_feature-widget-query") ) {
         	$my_query = new WP_Query( $query_args );
         	wp_cache_set("exa_feature-widget-query",$my_query,'',0);
         }
         $count = 0;
         if ( $my_query->have_posts() ) {
         	while ( $my_query->have_posts() ) : $my_query->the_post(); 	
         		if (Exa::postHasBeenSeen(get_the_ID())) {
         			continue;
         		}
         
         		$count++;
         		if ($count > 1) {
         			break;
         		}
         		Exa::addShownId(get_the_ID()); 
         		?>
      <div  class="story">
         <bh-headline-unit 
            headline="<?php the_title(); ?>"
            subhead="<?php exa_subhead(); ?>"
            url="<?php the_permalink(); ?>"
            image-src="<?php the_post_thumbnail_url(); ?>"
            time="<?php exa_time(); ?>"
            topic="<?php exa_topic( $post->ID ); ?>"
            header-tag="h3"
            hard="true"
            ></bh-headline-unit>
      </div>
      <?php	
         endwhile;
         }
         ?>
      <?php
         $query_args = array(
         	'post_status'	=> 'publish',
         	'tax_query' => array(
         		array(
         			'taxonomy' => 'importance',
         			'field' => 'slug',
         			'terms' => array('featured','cover')
         		)
         	),
         	'no_found_rows' => true,
         );
         
         if ( ! $my_query = wp_cache_get("exa_ad-two-dominant") ) {
         	$my_query = new WP_Query( $query_args );
         	wp_cache_set("exa_ad-two-dominant",$my_query,'',0);
         }
         
         $count = 0;
         if ( $my_query->have_posts() ) {
         	while ( $my_query->have_posts() ) : $my_query->the_post(); 
         		if(Exa::postHasBeenSeen(get_the_ID())) {
         			continue;
         		}
         			
         		$count++;
         		if($count > 2) {
         			continue;
         		}
         		Exa::addShownId(get_the_ID()); 
         ?>
      <div class="story story-<?php echo $count ?>">
         <a href="<?php the_permalink(); ?>">
         </a>
         <bh-headline-unit 
            headline="<?php the_title(); ?>"
            subhead="<?php exa_subhead(); ?>"
            url="<?php the_permalink(); ?>"
            image-src="<?php the_post_thumbnail_url(); ?>"
            time="<?php exa_time(); ?>"
            topic="<?php exa_topic( $post->ID ); ?>"
            header-tag="h4"
            hard="true"
            ></bh-headline-unit>
      </div>
      <?php endwhile;
         } else {
         	// todo: test this output.
         	echo "No Posts";
         }
         ?>
   </div>
   <bh-sticky-container class="recent-widget">
      <bh-archive-grouping-header slot="header" header-text="Most Recent"></bh-archive-grouping-header>
      <div slot="content">
         
         <?php
            $count = 0;
            while( have_posts() ) : 
            $count++;
            if($count>4) {
            break;
            }

            if($count==3) {
            	?>
         <div class="sidekick-ad">
            <bh-ad-unit>
            <?php 
               $DoubleClick->place_ad(
               			'badgerherald.com-upper-sidekick',
               			array(
               				'phone'=>'300x250'
               				)
               			);
            ?>
            </bh-ad-unit>
         </div>
         <?php
            }
            the_post(); 
            ?>
         <li class="recent-post">
            <bh-headline-unit 
               headline="<?php the_title(); ?>"
               subhead="<?php exa_subhead(); ?>"
               url="<?php the_permalink(); ?>"
               image-src="<?php the_post_thumbnail_url(); ?>"
               time="<?php exa_time(); ?>"
               topic="<?php exa_topic( $post->ID ); ?>"
               header-tag="h4"
               hard="true"
               ></bh-headline-unit>
         </li>
         <?php 
            endwhile 
            ?>
      </div>
   </bh-sticky-container>
   <div class="leaderboard">
   <bh-ad-unit>
      <?php 
         global $DoubleClick;
         
         $DoubleClick->place_ad(
         	'badgerherald.com-leaderboard',
         	array(
         		'mobile' => '300x50,300x250',
         		'tablet' => '728x90',
         	),
         	array (
         		'lazyLoad' => false
         		)
         	); 
         ?> 
         </bh-ad-unit>
   </div>
</bh-grid>

