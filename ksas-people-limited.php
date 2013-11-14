<?php
/*
Plugin Name: KSAS People Directory
Plugin URI: http://krieger2.jhu.edu/comm/web/plugins/people
Description: Creates a custom post type for people.  Use only on sites.krieger.jhu.edu websites.
Version: 1.0
Author: Cara Peckens
Author URI: mailto:cpeckens@jhu.edu
License: GPL2
*/

// registration code for people post type
	function register_people_posttype() {
		$labels = array(
			'name' 				=> _x( 'People', 'post type general name' ),
			'singular_name'		=> _x( 'Person', 'post type singular name' ),
			'add_new' 			=> _x( 'Add New', 'Person'),
			'add_new_item' 		=> __( 'Add New Person '),
			'edit_item' 		=> __( 'Edit Person '),
			'new_item' 			=> __( 'New Person '),
			'view_item' 		=> __( 'View Person '),
			'search_items' 		=> __( 'Search People '),
			'not_found' 		=>  __( 'No Person found' ),
			'not_found_in_trash'=> __( 'No People found in Trash' ),
			'parent_item_colon' => ''
		);
		
		$taxonomies = array();
		
		$supports = array('title','revisions','thumbnail');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Person'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type'   => 'person',
			'capabilities' => array(
				'publish_posts' => 'publish_persons',
				'edit_posts' => 'edit_persons',
				'edit_others_posts' => 'edit_others_persons',
				'delete_posts' => 'delete_persons',
				'delete_others_posts' => 'delete_others_persons',
				'read_private_posts' => 'read_private_persons',
				'edit_post' => 'edit_person',
				'delete_post' => 'delete_person',
				'read_post' => 'read_person',),			
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'directory', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('people',$post_type_args);
	}
	add_action('init', 'register_people_posttype');

// registration code for role taxonomy
function register_role_tax() {
	$labels = array(
		'name' 					=> _x( 'Roles', 'taxonomy general name' ),
		'singular_name' 		=> _x( 'Role', 'taxonomy singular name' ),
		'add_new' 				=> _x( 'Add New Role', 'Role'),
		'add_new_item' 			=> __( 'Add New Role' ),
		'edit_item' 			=> __( 'Edit Role' ),
		'new_item' 				=> __( 'New Role' ),
		'view_item' 			=> __( 'View Role' ),
		'search_items' 			=> __( 'Search Roles' ),
		'not_found' 			=> __( 'No Role found' ),
		'not_found_in_trash' 	=> __( 'No Role found in Trash' ),
	);
	
	$pages = array('people');
				
	$args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Role'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'hierarchical' 		=> true,
		'show_tagcloud' 	=> false,
		'show_in_nav_menus' => false,
		'rewrite' 			=> array('slug' => 'role', 'with_front' => false ),
	 );
	register_taxonomy('role', $pages, $args);
}
add_action('init', 'register_role_tax');

function add_role_terms() {
	wp_insert_term('faculty', 'role',  array('description'=> 'Faculty Member','slug' => 'faculty'));
	wp_insert_term('post-doc', 'role',  array('description'=> 'Postdoctoral Fellow','slug' => 'post-doc'));
	wp_insert_term('graduate', 'role',  array('description'=> 'Graduate Student','slug' => 'graduate'));
	wp_insert_term('undergraduate', 'role',  array('description'=> 'Undergraduate Student','slug' => 'undergraduate'));
	wp_insert_term('other', 'role',  array('description'=> 'Other','slug' => 'other'));
}
add_action('init', 'add_role_terms');


//Add Personal details metabox
$personaldetails_3_metabox = array( 
	'id' => 'personaldetails',
	'title' => 'Personal Details',
	'page' => array('people'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

				
				array(
					'name' 			=> 'Last Name (For Indexing)',
					'desc' 			=> '',
					'id' 			=> 'ecpt_people_alpha',
					'class' 		=> 'ecpt_people_alpha',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0,
					'std'			=> ''													
				),
															
				array(
					'name' 			=> 'Position/Title',
					'desc' 			=> '',
					'id' 			=> 'ecpt_position',
					'class' 		=> 'ecpt_position',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0,
					'std'			=> ''													
				),
															
				array(
					'name' 			=> 'Degrees',
					'desc' 			=> '',
					'id' 			=> 'ecpt_degrees',
					'class' 		=> 'ecpt_degrees',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0,
					'std'			=> ''													
				),
															
				array(
					'name' 			=> 'Expertise/Research Interests',
					'desc' 			=> '',
					'id' 			=> 'ecpt_expertise',
					'class' 		=> 'ecpt_expertise',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0,
					'std'			=> ''													
				),
															
				array(
					'name' 			=> 'Phone Number',
					'desc' 			=> '',
					'id' 			=> 'ecpt_phone',
					'class' 		=> 'ecpt_phone',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0,
					'std'			=> ''													
				),
				array(
					'name' 			=> 'Email Address',
					'desc' 			=> '',
					'id' 			=> 'ecpt_email',
					'class' 		=> 'ecpt_email',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0,
					'std'			=> ''													
				),
															
				array(
					'name' 			=> 'Office Location',
					'desc' 			=> '',
					'id' 			=> 'ecpt_office',
					'class' 		=> 'ecpt_office',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0,
					'std'			=> ''													
				),
																														
				array(
					'name' 			=> 'Website/Profile Link',
					'desc' 			=> '',
					'id' 			=> 'ecpt_website',
					'class' 		=> 'ecpt_website',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0,
					'std'			=> ''													
				),
				)
);			
			
add_action('admin_menu', 'ecpt_add_personaldetails_3_meta_box');
function ecpt_add_personaldetails_3_meta_box() {

	global $personaldetails_3_metabox;		

	foreach($personaldetails_3_metabox['page'] as $page) {
		add_meta_box($personaldetails_3_metabox['id'], $personaldetails_3_metabox['title'], 'ecpt_show_personaldetails_3_box', $page, 'normal', 'high', $personaldetails_3_metabox);
	}
}

// function to show meta boxes
function ecpt_show_personaldetails_3_box()	{
	global $post;
	global $personaldetails_3_metabox;
	global $ecpt_prefix;
	global $wp_version;
	
	// Use nonce for verification
	echo '<input type="hidden" name="ecpt_personaldetails_3_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($personaldetails_3_metabox['fields'] as $field) {
		// get current post meta data

		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '">';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', $field['desc'];
				break;
		}
		echo     '<td>',
			'</tr>';
	}
	
	echo '</table>';
}	

add_action('save_post', 'ecpt_personaldetails_3_save');

// Save data from meta box
function ecpt_personaldetails_3_save($post_id) {
	global $post;
	global $personaldetails_3_metabox;
	
	// verify nonce
	if (!isset($_POST['ecpt_personaldetails_3_meta_box_nonce']) || !wp_verify_nonce($_POST['ecpt_personaldetails_3_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($personaldetails_3_metabox['fields'] as $field) {
	
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = ecpt_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				update_post_meta($post_id, $field['id'], $new);
				
				
			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}


//CREATE COLUMNS IN ADMIN

add_filter( 'manage_edit-people_columns', 'my_people_columns' ) ;

function my_people_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Name' ),
		'role' => __( 'Role' ),
		'date' => __( 'Date' ),
		'thumbnail' => __('Thumbnail' )
	);

	return $columns;
}

add_action( 'manage_people_posts_custom_column', 'my_manage_people_columns', 10, 2 );

function my_manage_people_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'role' column. */
		case 'role' :

			/* Get the roles for the post. */
			$terms = get_the_terms( $post_id, 'role' );

			/* If terms were found. */
			if ( !empty( $terms ) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'role' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'role', 'display' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			/* If no terms were found, output a default message. */
			else {
				_e( 'No Role Assigned' );
			}

			break;
		case 'thumbnail' :
			
			/* Get the thumbnail */
			$thumbnail = get_post_thumbnail_id();

			if ( empty( $thumbnail ) )
				echo __( 'No Photo' );

			/* If there is a duration, append 'minutes' to the text string. */
			else
				
				the_post_thumbnail('directory');

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

// CREATE FILTERS WITH CUSTOM TAXONOMIES


function people_add_taxonomy_filters() {
	global $typenow;

	// An array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('role', 'filter');
 
	// must set this to the post type you want the filter(s) displayed on
	if ( $typenow == 'people' ) {
 
		foreach ( $taxonomies as $tax_slug ) {
			$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
			$tax_obj = get_taxonomy( $tax_slug );
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if ( count( $terms ) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>$tax_name</option>";
				foreach ( $terms as $term ) {
					echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
				}
				echo "</select>";
			}
		}
	}
}

add_action( 'restrict_manage_posts', 'people_add_taxonomy_filters' );
?>