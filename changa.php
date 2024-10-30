<?php
/*
Plugin Name: Changa : Personalized short-video feeds
Description: We help you curate your posts/pages with most liked, trending and most relevent short-videos.
Plugin URI: https://changa.in/blog/what-is-changa-biz/
Author URI: https://changa.in
Author: Changa
Version: 1.4
*/

//if called directly abort
if(!defined('ABSPATH')){
	die;
}


//changa class 
class Changa{
	function __construct(){
			add_action('admin_menu', array($this, 'add_menu_page'));
			add_action('init', array($this, 'init_actions'));
			add_shortcode('changa', array($this, 'get_short_code'));
			add_filter( 'script_loader_tag', array($this, 'defer_script'), 10, 3 );

	}
	function defer_script( $tag, $handle, $src ) {
	
		if ( $handle == 'wp_changa' ) {
			return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
		}	
		return $tag;
	} 	
	function get_short_code($args){
		$appid = 'invalid';
		$slidertype = 'vertical';

		$shortCode = is_array($args) ? join(' ', $args) : $args;
		$shortCode = trim(strtolower($shortCode));

		if($shortCode){
			$feeds = get_option('changa_feeds', false);
			if($feeds){
				$feeds = json_decode($feeds);
				foreach($feeds as $feed){
					if($shortCode ==  trim(strtolower($feed->name))){
						$appid = $feed->id;
						break;
					}
				}
			}
		}
		if(defined( 'AMP_QUERY_VAR' ) && is_amp_endpoint())
			return $this->get_amp_iframe($appid);


		return ('<div id="changa-slider" appid="'.$appid.'" slider-type="'.$slidertype.'" type = "short_code"></div>');
	}


	function get_amp_iframe($appid){
		return('<amp-iframe layout="responsive" width = "400" height = "400" max-height = "400" max-width= "400" sandbox="allow-scripts"  src2 = "https://google.com" src = "https://changa.in/app/changa-lite?appid='.$appid.'&selected=0" style = "margin: 0 auto; max-height:400px; max-width: 400px;"><amp-img layout="responsive" src="https://cdn-bz.changa.in/bz_uploads/staging/admin/2020-09-10/1599730996258_819362883.png" placeholder style = "height: 50px; width: 100%; "></amp-img></amp-iframe>');
	}

	function add_generic_div(){
		 global $page;
		 global $post;
		$generic_appid = get_option('changa_generic_feed_appid', false);
		$generic_para = get_option('changa_generic_para', false);

		if($generic_appid && $generic_para){
			 print('<div amp data-ampdevmode  id = "changa_generic" data_appid = "'.$generic_appid.'" data_para = "'.$generic_para.'"></div>');
			 return;
		}
		
		/*AMP CODE >>>
		if($generic_appid && $generic_para){
			if(defined( 'AMP_QUERY_VAR' ) && is_amp_endpoint()){
				 if(
				 	($page && !has_shortcode($page->page_content, 'changa')) ||
				 	($post && !has_shortcode($post->post_content, 'changa')))
				 {
				 	add_action('wp_footer', $this->get_amp_iframe($generic_appid));
				 	return;
				 }

			}else{
			 print('<div amp data-ampdevmode  id = "changa_generic" data_appid = "'.$generic_appid.'" data_para = "'.$generic_para.'"></div>');
			}
		}
		*/
	}


	function init_actions (){
		$this->redirect();
		$this->handle_feed_response();
		$this->handle_generic_response();
		add_action('wp_head', array($this, 'add_generic_div'));

		//add scripts for changa dashboard
		add_action( 'admin_enqueue_scripts', array($this, 'enqueue_admin_scripts' ));

		// add scripts for other pags/blogs 
		$this->enqueue_scripts();

	}
	function enqueue_scripts (){
		// wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js', '', false);
		wp_enqueue_script('jquery', '', array(), false,true);

		wp_enqueue_style('changacss', plugins_url('assets/css/all_css_minified.css', __FILE__), '', false, false);
		wp_enqueue_script('wp_changa', plugins_url( 'assets/js/all_scripts_minified.js', __FILE__ ), array('jquery'),  false, true);

		// wp_enqueue_script('wp_changa', plugins_url( 'assets/js/wp_changa_script.js', __FILE__ ), array('jquery'),  false, true);

		// wp_enqueue_script('slick_min', plugins_url( 'assets/js/slick-min.js', __FILE__ ), array('jquery'), false,  true);
		// wp_enqueue_script('changa_main', plugins_url( 'assets/js/changa-main.js', __FILE__ ), array('jquery', 'slick_min'), false,  true);


		// wp_enqueue_script('changa-lite_amp', plugins_url( 'assets/js/changa-lite.js', __FILE__ ) , '', 'jquery', true );
	}


	function enqueue_admin_scripts ($hook){
		if($hook == "toplevel_page_changa_setting_page"){
			$this->enqueue_scripts();
		}


	}
	

	function redirect(){
		if(get_option('changa_needs_redirection', false)){
			delete_option('changa_needs_redirection');
			exit(wp_redirect(esc_url(admin_url('admin.php?page=changa_setting_page'))));
		}
	}

	function add_menu_page(){
		add_menu_page('Changa Short Video', 'Changa', 'manage_options', 'changa_setting_page', array($this, 'render_changa_setting_page'), esc_url(plugins_url('assets/img/changa2.png', __FILE__)), 1);
	}

	function render_changa_setting_page(){
			require_once plugin_dir_path( __FILE__ ) . '/pages/dashboard.php';
	}

	
	function handle_generic_response(){
		if(array_key_exists('changa_generic_feed', $_POST)){
			$feed_appid = sanitize_text_field($_POST['feed_appid']);
			$para = sanitize_text_field($_POST['para']);

			if( ($feed_appid == '__false__' || $para == '__false__')) {
				delete_option('changa_generic_feed_appid');
				delete_option('changa_generic_para');
			}else{
				update_option('changa_generic_feed_appid', $feed_appid);
				update_option('changa_generic_para', $para);
			}
		}
	}
	function handle_feed_response(){
		if(array_key_exists('feed', $_GET)){
			$input =  sanitize_text_field(stripslashes($_GET['feed']));

			//try decoding the json and only save to db it it can be decoded. 
			try{
				$decoded = json_decode($input);
				delete_option('changa_feeds');
				add_option('changa_feeds', $input);
			}catch (Exception $e) {
				return;
			}
		}
	}

	function on_activation(){
		update_option('changa_needs_redirection', true);
	}
	
	function on_deactivation(){
		//delete all options;
		delete_option('changa_feeds');
		delete_option('changa_needs_redirection');
		
		delete_option('changa_generic_feed_appid');
		delete_option('changa_generic_para');		
	}



}

if(class_exists('Changa')){
	$changa = new Changa();
}


register_activation_hook(__FILE__, array($changa, 'on_activation'));
register_deactivation_hook(__FILE__, array($changa, 'on_deactivation'));

?>