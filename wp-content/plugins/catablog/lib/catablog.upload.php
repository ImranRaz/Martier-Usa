<?php
/**
 * CataBlog Media Upload script
 *
 * @package CataBlog
 * @author Zachary Segal
 */

/**
 * This variable is an override for the absolute path
 * to your WordPress directory on your server. If someone
 * has customized the location of wp-content, please make
 * sure to set this variable accordingly
 *
 * example: '/var/www/wordpress/';
 */
$WP_ABS_PATH = '/var/www/wordpress';


/* WordPress Administration Bootstrap */
define('WP_ADMIN', true);
if ( !defined('WP_LOAD_PATH') ) {
	/** standard path for wordpress base folder */
	$default = dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/' ;
	
	if (file_exists( $default . 'wp-load.php') )
		define( 'WP_LOAD_PATH', $default);
	else
		if (file_exists( $WP_ABS_PATH . 'wp-load.php') )
			define( 'WP_LOAD_PATH', $WP_ABS_PATH);
		else
			die("<li class='error'>Cannot locate wp-load.php. Please read more at <a href='http://catablog.illproductions.com' target='_blank'>catablog.illproductions.com</a></li>");
}


// load WordPress
require_once( WP_LOAD_PATH . 'wp-load.php');


// Flash fails to send cookies with the upload, so pass it in GET or POST instead
if ( is_ssl() && empty($_COOKIE[SECURE_AUTH_COOKIE]) && !empty($_REQUEST['auth_cookie']) )
	$_COOKIE[SECURE_AUTH_COOKIE] = $_REQUEST['auth_cookie'];
elseif ( empty($_COOKIE[AUTH_COOKIE]) && !empty($_REQUEST['auth_cookie']) )
	$_COOKIE[AUTH_COOKIE] = $_REQUEST['auth_cookie'];
if ( empty($_COOKIE[LOGGED_IN_COOKIE]) && !empty($_REQUEST['logged_in_cookie']) )
	$_COOKIE[LOGGED_IN_COOKIE] = $_REQUEST['logged_in_cookie'];


unset($current_user);


require_once( ABSPATH . '/wp-admin/admin.php');


header('Content-Type: text/plain; charset='.get_option('blog_charset'));


// make sure the attempting uploader is logged into WordPress
if (!is_user_logged_in()) {
	die("<li class='error'>".__('Login failure. You must be logged into the WordPress Admin section.', 'catablog')."</li>");
}

// make sure the attempting uploader has permission to edit posts
if ( !current_user_can('edit_posts')) {
	die("<li class='error'>".__('Your Admin account does not have permission to "edit_posts".', 'catablog')."</li>");
}

// make sure the attempting uploader had passed the correct nonce value
check_admin_referer('catablog_swfupload');


// create global variable for catablog class
global $wp_plugin_catablog_class;

$tmp_name = $_FILES['Filedata']['tmp_name'];
$_FILES['new_image'] = $_FILES['Filedata'];
if (strlen($tmp_name) < 1) {
	die("<li class='error'>".__('Image could not be uploaded to the server, please try again.', 'catablog')."</li>");
}

$new_item    = new CataBlogItem();
$valid_image = $new_item->validateImage($tmp_name);
if ($valid_image === true) {
	$new_item_title = $_FILES['Filedata']['name'];
	$new_item_title = preg_replace('/\.[^.]+$/','',$new_item_title);
	$new_item_title = str_replace(array('_','-','.'), ' ', $new_item_title);
	$new_item_order = wp_count_posts($new_item->getCustomPostName())->publish + 1;
	
	$new_item->setOrder($new_item_order);
	$new_item->setTitle($new_item_title);
	
	$new_item->setImage($tmp_name);
	$new_item->setSubImages(array());
	
	$default_term = $wp_plugin_catablog_class->get_default_term();
	$new_item->setCategories(array($default_term->term_id=>$default_term->name));
	
	$new_item->save();
	
	$html  = "<li>";
	
	$html .= "<div class='button-elements'>";
	$html .= "<img src='".$wp_plugin_catablog_class->urls['thumbnails'] . '/' . $new_item->getImage()."' />";
	$html .= "</div>";
	
	$html .= "<div class='text-elements'>";
	$html .= "<input type='text' name='title' class='title' value='".$new_item->getTitle()."' />";
	$html .= "<input type='hidden' name='id' class='id' value='".$new_item->getId()."' />";
	$html .= "<textarea name='description' class='description'>".$new_item->getDescription()."</textarea>";
	$html .= "<input type='button' class='button-primary' name='submit' value='".__('Save Changes', 'catablog')."' />";
	$html .= "</div>";
	
	$html .= "</li>";
	
	die($html);
}
else {
	die("<li class='error'>".$valid_image."</li>");
}
