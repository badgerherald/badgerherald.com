<?php 

function exa_get_snippet_js($post) {
	$post = get_post($post);
	$js = get_post_meta($post->ID, '_exa_snippet_js', true);
	return $js;
}

function exa_get_snippet_css($post) {
	$post = get_post($post);
	$css = get_post_meta($post->ID, '_exa_snippet_css', true);
	return $css;
}

function exa_get_snippet_html($post) {
	$post = get_post($post);
	$html = get_post_meta($post->ID, '_exa_snippet_html', true);
	return $html;
}

function exa_snippet_js($post) {
	echo exa_get_snippet_js($post);
}

function exa_snippet_css($post) {
	echo exa_get_snippet_css($post);
}

function exa_snippet_html($post) {
	echo exa_get_snippet_html($post);
}

function exa_snippet_shortcode($atts) {
	if(!array_key_exists("id",$atts)) {
		return;
	}
	$post_id = $atts["id"];
	?>
    <script>
		jQuery(document).ready(function($) {
			var iframe = document.getElementById("snippet-<?php echo $post_id; ?>")
        	var frameDoc = iframe.document;
        	if (iframe.contentWindow) {
            	frameDoc = iframe.contentWindow.document;
        	}


        	<?php 

        	$html = exa_get_snippet_html($post_id);
        	$css = exa_get_snippet_css($post_id);
        	$js = exa_get_snippet_js($post_id) ? exa_get_snippet_js($post_id) : "";

        	?>
        	var css    = <?php echo $css ? json_encode($css) : "\"\""; ?>;
        	var script = <?php echo $js ? json_encode($js) : "\"\""; ?>;
        	var html   = <?php echo $html ? json_encode($html) : "\"\""; ?>;
        	
        	frameDoc.open();
        	frameDoc.writeln("<!DOCTYPE html>");
        	frameDoc.writeln("<html>");
        	frameDoc.writeln("<head>");
        	frameDoc.writeln("<style type='text/css'>" + css + "</style>");
        	frameDoc.writeln("</head>");
        	frameDoc.writeln("<body>");
        	frameDoc.writeln(html);
        	frameDoc.writeln("<script type='text/javascript'>" + script + "</scri\pt>");
        	frameDoc.writeln("</body>");
        	frameDoc.writeln("</html>");
        	frameDoc.close();

			$(iframe.contentWindow).on('resize', function(){ 
				var newheight;
    			if(document.getElementById){
        			newheight=this.document.body.scrollHeight;
    			}
    			this.document.height = (newheight) + "px";
			});
		});
	</script>

	<iframe width="100%" height="300px" id="snippet-<?php echo $post_id; ?>" frameborder="0">#document</iframe>
    <?php
}
add_shortcode("snippet","exa_snippet_shortcode");

/**
 * Registers the snippet post type
 * 
 * @since v0.6
 */
function _exa_snippets_register_post_type() {
	$labels = array(
		'name'                  => _x( 'Post Types', 'Post Type General Name', 'Exa' ),
		'singular_name'         => _x( 'Post Type', 'Post Type Singular Name', 'Exa' ),
		'menu_name'             => __( 'Snippets', 'Exa' ),
		'name_admin_bar'        => __( 'Snippet', 'Exa' ),
		'archives'              => __( 'Snippet Archives', 'Exa' ),
		'attributes'            => __( 'Snippet Attributes', 'Exa' ),
		'parent_item_colon'     => __( 'Parent Snippet:', 'Exa' ),
		'all_items'             => __( 'All Snippets', 'Exa' ),
		'add_new_item'          => __( 'Create New Snippet', 'Exa' ),
		'add_new'               => __( 'Create New', 'Exa' ),
		'new_item'              => __( 'New Snippet', 'Exa' ),
		'edit_item'             => __( 'Edit Snippet', 'Exa' ),
		'update_item'           => __( 'Update Snippet', 'Exa' ),
		'view_item'             => __( 'View Snippet', 'Exa' ),
		'view_items'            => __( 'View Snippets', 'Exa' ),
		'search_items'          => __( 'Search Snippet', 'Exa' ),
		'not_found'             => __( 'Not found', 'Exa' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'Exa' ),
		'featured_image'        => __( 'Featured Image', 'Exa' ),
		'set_featured_image'    => __( 'Set featured image', 'Exa' ),
		'remove_featured_image' => __( 'Remove featured image', 'Exa' ),
		'use_featured_image'    => __( 'Use as featured image', 'Exa' ),
		'insert_into_item'      => __( 'Insert into Snippet', 'Exa' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Snippet', 'Exa' ),
		'items_list'            => __( 'Snippets list', 'Exa' ),
		'items_list_navigation' => __( 'Snippets list navigation', 'Exa' ),
		'filter_items_list'     => __( 'Filter Snippets list', 'Exa' ),
	);
	$args = array(
		'label'                 => __( 'Post Type', 'Exa' ),
		'description'           => __( 'Post Type Description', 'Exa' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-editor-code',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => false,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'rewrite'   			=> array( 'slug' => false, 'with_front' => false ), 
		'capability_type'       => 'post',
		'show_in_rest'          => false,

	);
	register_post_type( 'snippet', $args );
}
add_action( 'init', '_exa_snippets_register_post_type', 0 );


function _exa_snippet_enqueue_admin_scripts( $hook ) {
    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'snippet' === $post->post_type ) {     
            wp_enqueue_script( 'exa_snippet', get_template_directory_uri().'/js/admin/snippets.js' );
            wp_enqueue_script( 'exa_snippet_ace', get_template_directory_uri().'/js/admin/ace/ace.js' );
            wp_enqueue_script( 'exa_snippet_ace-lang-ext', get_template_directory_uri().'/js/admin/ace/ext-language_tools.js' );
            wp_enqueue_script( 'exa_snippet_ace-theme', get_template_directory_uri().'/js/admin/ace/theme-monokai.js' );
        }
    }
}
add_action( 'admin_enqueue_scripts', '_exa_snippet_enqueue_admin_scripts', 10, 1 );

function _exa_snippet_print_editors($post) {
	if($post->post_type != "snippet") {
		return;
	}
	wp_nonce_field(basename(__FILE__),'_exa_snippet_code');
	?>
	<style> 
		.editors {
			box-sizing: border-box;
			font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
			font-size: 12px;
			line-height: 1.42857143;
			color: #333;
			margin: 0px 0px 0 0px;
		    position: relative;
		    background: #F6F6F6;
		}
		
		.btn .caret {
		    margin: 6px 0px 0px 3px;
		    float: right;
		}
		
		.top, .bottom {
		    width: 100%;
		    height: 50%;
		    overflow: hidden;
		}
		
		.editor-box {
		    width: 50%;
		    float: left;
		    box-sizing: border-box;
		    border: 1px solid #212121;
		    height: 400px;
		}
		
		.editor {
		    height: 400px;
		    width: 100%;
		    margin: 0;
		}
	</style>

	<input type="button" id="btnRun" value="Run">
	<div class="editors">
        <div class="top">
            <!-- HTML Editor -->
            <input type="hidden" name="_exa_snippet_html" style="display: none;">
            <div class="editor-box"><pre class="editor" id="html-editor"><?php echo htmlentities(get_post_meta($post->ID, '_exa_snippet_html', true)); ?></pre></div>
            <!-- CSS Editor -->
            <input type="hidden" name="_exa_snippet_css" style="display: none;">
            <div class="editor-box">
                <div class="editor" id="css-editor"><?php exa_snippet_css($post); ?></div>
            </div>
        </div>
        <div class="bottom">
            <!-- JS Editor -->
            <input type="hidden" name="_exa_snippet_js" style="display: none;">
            <div class="editor-box">
                <div class="editor" id="js-editor"><?php exa_snippet_js($post); ?></div>
            </div>
            <!-- Preview -->
            <div class="editor-box">
                <iframe class="editor" id="preview" name="result" sandbox="allow-forms allow-popups allow-scripts allow-same-origin" frameborder="0">
                    #document
                </iframe>
            </div>
        </div>
    </div>

	<?php
	
}
add_action('edit_form_after_title', '_exa_snippet_print_editors');

/**
 * Removes slug metabox from appearing on snippet CPT
 * 
 * @since v0.6
 */
function _exa_snippets_remove_slug_box() {
    remove_meta_box( 'slugdiv', 'snippet', 'normal' );
}
add_action( 'add_meta_boxes', '_exa_snippets_remove_slug_box' );


/** 
 * Save our custom data when the post is saved
 */
function _exa_snippet_save_editors($post_id) {
	error_log(print_r($_POST,true));
	if(array_key_exists("_exa_snippet_code",$_POST) && !wp_verify_nonce($_POST['_exa_snippet_code'], basename(__FILE__))) {
		return;
	}

	$new_html = array_key_exists('_exa_snippet_html',$_POST) ? $_POST['_exa_snippet_html'] : "";

	if($new_html == '') {
		delete_post_meta($post_id, '_exa_snippet_html');
	} else {
		update_post_meta($post_id, '_exa_snippet_html', $new_html);
	}

	$new_css = array_key_exists('_exa_snippet_css',$_POST) ? $_POST['_exa_snippet_css'] : "";

	if($new_css == '') {
		delete_post_meta($post_id, '_exa_snippet_css');
	} else {
		update_post_meta($post_id, '_exa_snippet_css', $new_css);
	}

	$new_js = array_key_exists('_exa_snippet_js',$_POST) ? $_POST['_exa_snippet_js'] : "";

	if($new_js == '') {
		delete_post_meta($post_id, '_exa_snippet_js');
	} else {
		update_post_meta($post_id, '_exa_snippet_js', $new_js);
	}

}
add_action('save_post', '_exa_snippet_save_editors');
