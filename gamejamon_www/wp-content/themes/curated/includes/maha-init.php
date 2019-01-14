<?php

/* --------------------------------------------------------------------------

	A Mahathemes Framework - Copyright (c) 2017

	@init - Options
	@init - Functions
	@init - Widgets
	@init - Plugins

	- Meta Init - Mark 1.0.0

 ---------------------------------------------------------------------------*/


/* --------------------------------------------------------------------------
 * [@init - Options]
 ---------------------------------------------------------------------------*/
if ( !class_exists( 'ReduxFramework' ) && file_exists( MAHA_PATH . '/includes/options/ReduxCore/framework.php' ) ) {
	require_once( MAHA_PATH . '/includes/options/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( MAHA_PATH . '/includes/options/curated/config.php' ) ) {
	require_once( MAHA_PATH . '/includes/options/curated/config.php' );
}


/* --------------------------------------------------------------------------
 * [@init - Plugins Required]
 ---------------------------------------------------------------------------*/
require_once dirname( __FILE__ ) . '/plugins/class-tgm-plugin-activation.php';


/* --------------------------------------------------------------------------
 * [@init - Widgets]
 ---------------------------------------------------------------------------*/
require_once (MAHA_PATH . '/includes/widgets/maha-posts.php');					// Post
require_once (MAHA_PATH . '/includes/widgets/maha-popular-post.php');			// Popular Post
require_once (MAHA_PATH . '/includes/widgets/maha-top-reviews.php');			// Top Reviews
require_once (MAHA_PATH . '/includes/widgets/maha-recent-posts.php');			// Recent Posts with thumbnail
require_once (MAHA_PATH . '/includes/widgets/maha-ads.php');							// Ads Widget
require_once (MAHA_PATH . '/includes/widgets/maha-menus.php');							// Ads Widget


/* -------------------------------------------------------------------------
 * [Theme Function]
 --------------------------------------------------------------------------*/
require_once (MAHA_PATH . '/includes/functions/maha-mega-menu.php');
require_once (MAHA_PATH . '/includes/functions/maha-functions.php');
require_once (MAHA_PATH . '/includes/functions/maha-posts-filter.php');
require_once (MAHA_PATH . '/includes/functions/maha-posts-view.php');



/* -------------------------------------------------------------------------
 * Mashsharer - Custom
 --------------------------------------------------------------------------*/
 // Custom networks & default options
if ( maha_plugin_active( 'mashsharer/mashshare.php' ) && ! maha_plugin_active( 'mashshare-networks/mashshare-networks.php' ) ) {
	add_filter( 'mashsb_array_networks', 'maha_mashsharer_array_networks' );
	add_action( 'init', 'maha_mashsharer_set_defaults' );
	add_action( 'init', 'maha_mashsharer_register_new_networks' );
	add_action( 'plugins_loaded', 'maha_mashsharer_add_networks_class' );
}

// Networks addon loaded : remove custom networks
if ( maha_plugin_active( 'mashsharer/mashshare.php' ) && maha_plugin_active( 'mashshare-networks/mashshare-networks.php' ) ) {
	add_action( 'init', 'maha_mashsharer_deregister_new_networks' );
}


/* -------------------------------------------------------------------------
 * [Custom Fields]
 --------------------------------------------------------------------------*/
if (!class_exists('Acf')) {
    require_once (MAHA_PATH . '/includes/acf/acf.php');
}

// die();
	// Include Field Type For ACF4
	function register_fields_sidebar_selector() {
		include_once('acf/core/fields/sidebar_selector-v4.php');
	}
	add_action('acf/register_fields', 'register_fields_sidebar_selector');

// }

require_once (MAHA_PATH . '/includes/acf/acf-fields.php');

?>
