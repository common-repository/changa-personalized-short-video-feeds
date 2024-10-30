if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

delete_option('changa_feeds');
delete_option('changa_needs_redirection');
delete_option('changa_generic_feed_appid');
delete_option('changa_generic_para');	
