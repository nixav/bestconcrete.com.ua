<?php
/**
* Plugin Name: WP Post Rating 
* Plugin URI: https://wordpress.org/plugins/wpcr-comment-rating/
* Description: A simple plugin for adding rating functionality to WordPress Post with comments.
* Version: 1.3
* Author: Shoaib Saleem
* Author URI: https://profiles.wordpress.org/shoaib88/
*/

add_action('admin_init', 'wpcr_register_options');  // register options for the form
add_action('admin_menu', 'wpcr_admin_links');  // register admin menu hyperlinks

	//include necessary files
		
	include_once(  plugin_dir_path( __FILE__ ) . 'inc/setting.php');	
	include_once(  plugin_dir_path( __FILE__ ) . 'inc/function.php');	
	
/////// admin enqueue scripts ///////
function wpcr_admin_enqueue() {
	wp_enqueue_style( 'wpcr_custom_style', plugin_dir_url( __FILE__ ) . 'css/adminstyle.css' );
	wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wpcr-script-handle', plugin_dir_url( __FILE__ ).'js/admin-script.js', array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'wpcr_admin_enqueue' );

////// wp enqueue scripts //////
function wpcr_enqueue_style() {
	global $wpdb;
    $results = $wpdb->get_results( "SELECT option_value FROM ".$wpdb->prefix."options WHERE option_name = 'wpcr_settings'");
	$val = unserialize($results[0]->option_value);
	$enable_bt_files = $val['wpcr_btsrpfiles'];
	
	wp_enqueue_script( 'wpcr_js', plugin_dir_url( __FILE__ ) . 'js/custom.js', array('jquery'),'1.0' , true );
    wp_enqueue_style( 'wpcr_font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.css' );
	wp_enqueue_style( 'wpcr_style', plugin_dir_url( __FILE__ ) . 'css/style.css' );
	
	if($enable_bt_files == 1){
		wp_enqueue_style( 'wpcr_min_css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css' );
		wp_enqueue_script( 'wpcr_min_js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js' );
	}	
}
add_action( 'wp_enqueue_scripts', 'wpcr_enqueue_style' );

///// Function to register form fields //////
function wpcr_register_options(){
    register_setting('wpcr_options_group', 'wpcr_settings', 'wpcr_validate');
}

///// Function to add hyperlinks to the admin menus using hooks and filters //////
function wpcr_admin_links() {
  add_options_page('Rating Setup', 'Post Rating', 'manage_options', 'commentrating', 'wpcr_admin_page' );  // add link to settings page
}

///// Validate User Input ///////
function wpcr_validate($input) {
  return array_map('wp_filter_nohtml_kses', (array)$input);
}

function wpcr_admin_page() { ?>
<div class="wpcsr_wrapper">
  <h2><?php _e('Settings');?></h2>
  <div class="left-area">
  <form method="post" action="options.php">
  <?php
  settings_fields('wpcr_options_group');
  $wpcr_options = get_option('wpcr_settings');
  ?>
  <div class="left-main-sec">
	  <div class="row-outer">
	  <div class="col-1">
	  <span><?php _e('Enable rating with comment form');?></span>
	  </div>
	  <div class="col-2">
	  <input type="checkbox" name="wpcr_settings[checkbox1]" value="yes" <?php checked('yes', $wpcr_options['checkbox1']); ?> />
	  </div>
	  </div>
	  
	  <div class="row-outer">
	  <div class="col-1">
	  <span><?php _e('Show average rating after post title');?></span>
	  </div>
	  <div class="col-2">
	  <input type="checkbox" name="wpcr_settings[checkbox2]" value="yes" <?php checked('yes', $wpcr_options['checkbox2']); ?> />
	  <span class="averagerating_info"><?php _e('Add "the_tags()" function after title if average rating is not shown.');?></span>
	  </div>
	  </div>
	  
	  <div class="row-outer">
	  <div class="col-1">
	  <span><?php _e('Rating label');?></span>
	  </div>
	  <div class="col-2">
	  <input type="text" name="wpcr_settings[rtlabel]" placeholder="Please rate" value="<?php echo esc_attr( $wpcr_options['rtlabel']); ?>"  />
	  </div>
	  </div>
  
	<div class="row-outer">
	  <div class="col-1">
	  <span><?php _e('Rating label Color');?></span>
	  </div>
	  <div class="col-2">
	  <input type="text" class="wpcrcolor-field" name="wpcr_settings[txtcolor]" value="<?php echo sanitize_hex_color( $wpcr_options['txtcolor'])?>" data-default-color="#ccc" />
	  </div>
	</div>
  
	  <div class="row-outer">
	  <div class="col-1">
	  <span><?php _e('Ratings Image');?></span>
	  </div>
	  <div class="col-2">
	  <div class="imgrow">
	  <input type="radio" name="wpcr_settings[rateimage]" value="grateimg" <?php checked('grateimg', $wpcr_options['rateimage']); ?>  />
	  <span class="enable_grateimg"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/star1.png'?>" alt=""/></span>
	  </div>
	  <div class="imgrow">
	  <input type="radio" name="wpcr_settings[rateimage]" value="orateimg" <?php checked('orateimg', $wpcr_options['rateimage']); ?>  />
	  <span class="enable_orateimg"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/star2.png'?>" alt=""/></span>
	  </div>
	  </div>
	  </div>
  
	  <div class="row-outer">
	  <div class="col-1">
	  <span><?php _e('Show average rating as');?></span>
	  </div>
	  <div class="col-2">
	  <div class="aggr_options">
	  <input type="radio" name="wpcr_settings[tooltip_inline]" value="1" <?php checked(1, $wpcr_options['tooltip_inline']); ?>  />
	  <span class="aggr_label"><?php _e('Tooltip');?></span>
	  </div>
	  <div class="aggr_options">
	  <input type="radio" name="wpcr_settings[tooltip_inline]" value="0" <?php checked(0, $wpcr_options['tooltip_inline']); ?>  />
	  <span class="aggr_label"><?php _e('Inline');?></span>
	  </div>
	  </div>
	  </div>
		  
	</div> <!-- left sec end -->
  <div class="right-main-sec">
	<div class="wpcr_pagioptions">
			<h3><?php _e('Floating Links');?></h3>
		  <div class="row-outer">
		  <div class="colright-1">
		  <span><?php _e('Enable next/prev links?');?></span>
		  </div>
		  <div class="colright-2">
		  <div class="navlinks_options">
		  <input type="checkbox" name="wpcr_settings[shownav]" value="1" <?php checked(1, $wpcr_options['shownav']); ?>  />
		  </div>
		  </div>
		  </div>
		  
		  <div class="row-outer">
		  <div class="colright-1">
		  <span><?php _e('Enable social share links?');?></span>
		  </div>
		  <div class="colright-2">
		  <div class="navlinks_options">
		  <input type="checkbox" name="wpcr_settings[wpcr_social]" value="1" <?php checked(1, $wpcr_options['wpcr_social']); ?>  />
		  </div>
		  </div>
		  </div>
		  
		  <div class="row-outer">
		  <div class="colright-1">
		  <span><?php _e('Enable bootstrap files');?></span>
		  </div>
		  <div class="colright-2">
		  <div class="navlinks_options">
		  <input type="checkbox" name="wpcr_settings[wpcr_btsrpfiles]" value="1" <?php checked(1, $wpcr_options['wpcr_btsrpfiles']); ?>  />
		  </div>
		  </div>
		  </div>
		  
		  <div class="row-outer">
		  <div class="colright-1">
		  <span><?php _e('Position');?></span>
		  </div>
		  <div class="colright-2">
		  <div class="nav_position">
		  <input type="radio" name="wpcr_settings[navpos]" value="1" <?php checked(1, $wpcr_options['navpos']); ?>  />
		  <span class="nav_label"><?php _e('Left');?></span>
		  </div>
		  <div class="nav_position">
		  <input type="radio" name="wpcr_settings[navpos]" value="0" <?php checked(0, $wpcr_options['navpos']); ?>  />
		  <span class="nav_label"><?php _e('Right');?></span>
		  </div>
		  </div>
		</div>
						
		</div>
  </div>
 
  <?php submit_button(); ?>
  </form>
  <div class="donate-message" style="float:right;">
	<?php include (  plugin_dir_path( __FILE__ ) . 'inc/message.php');	?>
  </div>
  </div>
  </div>
<?php } 
