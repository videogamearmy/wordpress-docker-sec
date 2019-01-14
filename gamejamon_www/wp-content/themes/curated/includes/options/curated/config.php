<?php
	/**
	 * Curated Config File
	 */

	if ( ! class_exists( 'Redux' ) ) {
		return;
	}


	// This is your option name where all the Redux data is stored.
	$opt_name = "curated";

	/*
	 *
	 * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
	 *
	 */

	$sampleHTML = '';
	if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
		Redux_Functions::initWpFilesystem();

		global $wp_filesystem;

		$sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
	}

	// Background Patterns Reader
	$sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
	$sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
	$sample_patterns      = array();

	if ( is_dir( $sample_patterns_path ) ) {

		if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
			$sample_patterns = array();

			while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

				if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
					$name              = explode( '.', $sample_patterns_file );
					$name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
					$sample_patterns[] = array(
						'alt' => $name,
						'img' => $sample_patterns_url . $sample_patterns_file
					);
				}
			}
		}
	}

	/**
	 * ---> SET ARGUMENTS
	 * All the possible arguments for Redux.
	 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
	 * */

	$theme = wp_get_theme(); // For use with some settings. Not necessary.

	$args = array(
		// TYPICAL -> Change these values as you need/desire
		'opt_name'             => $opt_name,
		// This is where your data is stored in the database and also becomes your global variable name.
		'display_name'         => $theme->get( 'Name' ),
		// Name that appears at the top of your panel
		'display_version'      => $theme->get( 'Version' ),
		// Version that appears at the top of your panel
		'menu_type'            => 'menu',
		//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
		'allow_sub_menu'       => true,
		// Show the sections below the admin menu item or not
		'menu_title'           => $theme->get( 'Name' ),
		'page_title'           => $theme->get( 'Name' ),
		// You will need to generate a Google API key to use this feature.
		// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
		'google_api_key'       => '',
		// Set it you want google fonts to update weekly. A google_api_key value is required.
		'google_update_weekly' => false,
		// Must be defined to add google fonts to the typography module
		'async_typography'     => true,
		// Use a asynchronous font on the front end or font string
		//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
		'admin_bar'            => false,
		// Show the panel pages on the admin bar
		'admin_bar_icon'       => 'dashicons-portfolio',
		// Choose an icon for the admin bar menu
		'admin_bar_priority'   => 50,
		// Choose an priority for the admin bar menu
		'global_variable'      => '',
		// Set a different name for your global variable other than the opt_name
		'dev_mode'             => false,
		// Show the time the page took to load, etc
		'update_notice'        => false,
		// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
		'customizer'           => true,
		// Enable basic customizer support
		//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
		//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

		// OPTIONAL -> Give you extra features
		'page_priority'        => 30,
		// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
		'page_parent'          => 'themes.php',
		// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
		'page_permissions'     => 'manage_options',
		// Permissions needed to access the options panel.
		'menu_icon'            => '',
		// Specify a custom URL to an icon
		'last_tab'             => '',
		// Force your panel to always open to a specific tab (by id)
		'page_icon'            => 'icon-themes',
		// Icon displayed in the admin panel next to your menu_title
		'page_slug'            => 'maha_options',
		// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
		'save_defaults'        => true,
		// On load save the defaults to DB before user clicks save or not
		'default_show'         => false,
		// If true, shows the default value next to each field that is not the default value.
		'default_mark'         => '',
		// What to print by the field's title if the value shown is default. Suggested: *
		'show_import_export'   => true,
		// Shows the Import/Export panel when not used as a field.

		// CAREFUL -> These options are for advanced use only
		'transient_time'       => 60 * MINUTE_IN_SECONDS,
		'output'               => true,
		// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
		'output_tag'           => true,
		// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
		// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

		// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
		'database'             => '',
		// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
		'use_cdn'              => true,
		// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

		// HINTS
		'hints'                => array(
			'icon'          => 'el el-question-sign',
			'icon_position' => 'right',
			'icon_color'    => 'lightgray',
			'icon_size'     => 'normal',
			'tip_style'     => array(
				'color'   => 'red',
				'shadow'  => true,
				'rounded' => false,
				'style'   => '',
			),
			'tip_position'  => array(
				'my' => 'top left',
				'at' => 'bottom right',
			),
			'tip_effect'    => array(
				'show' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'mouseover',
				),
				'hide' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'click mouseleave',
				),
			),
		)
	);

	Redux::setArgs( $opt_name, $args );

	/*
	 * ---> END ARGUMENTS
	 */


	/*
	 * ---> START HELP TABS
	 */

	$tabs = array(
		array(
			'id'      => 'redux-help-tab-1',
			'title'   => __( 'Theme Information 1', 'curated' ),
			'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'curated' )
		),
		array(
			'id'      => 'redux-help-tab-2',
			'title'   => __( 'Theme Information 2', 'curated' ),
			'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'curated' )
		)
	);
	Redux::setHelpTab( $opt_name, $tabs );

	// Set the help sidebar
	$content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'curated' );
	Redux::setHelpSidebar( $opt_name, $content );


	/*
	 * <--- END HELP TABS
	 */


	/*
	 *
	 * ---> START SECTIONS
	 *
	 */

/*

As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


*/


// CUSTOM CODE
$maha_options = get_option('curated');

if ( $maha_options['google_fonts_on'] == true ) {
	$opt_fonts = true;
} else {
	$opt_fonts = false;
}



/**

	General ++++++++++++++++++++++++++++++++

**/
Redux::setSection( $opt_name, array(
	'title'			=> __( 'General', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> 'el-icon-cog',
	'fields'		=> array(
			array(
				'id'		=> 'thefavicon',
				'type'		=> 'media',
				'url'		=> true,
				'title'		=> __('Favicon', 'curated'),
				'subtitle'	=> __('Please upload your favicon here.', 'curated'),
				'desc'		=> __('Recommended size is (16px -Width) and (16px -Height).', 'curated'),
				'default'	=> array('url'=>get_template_directory_uri().'/images/tm-icon.ico'),
			),
			array(
				'id'		=> 'thefavicon_ios_76',
				'type'		=> 'media',
				'url'		=> true,
				'title'		=> __('IOS Bookmarklet 76x76', 'curated'),
				'subtitle'	=> __('Please upload your favicon here.', 'curated'),
				'desc'		=> __('Recommended size is (76px -Width) and (76px -Height).', 'curated'),
				'default'	=> array('url'=>get_template_directory_uri().'/images/tm-icon-76.png'),
			),
			array(
				'id'		=> 'thefavicon_ios_114',
				'type'		=> 'media',
				'url'		=> true,
				'title'		=> __('IOS Bookmarklet 114x114', 'curated'),
				'subtitle'	=> __('Please upload your favicon here.', 'curated'),
				'desc'		=> __('Recommended size is (114px -Width) and (114px -Height).', 'curated'),
				'default'	=> array('url'=>get_template_directory_uri().'/images/tm-icon-114.png'),
			),
			array(
				'id'		=> 'thefavicon_ios_144',
				'type' 		=> 'media',
				'url'		=> true,
				'title'		=> __('IOS Bookmarklet 144x144', 'curated'),
				'subtitle'	=> __('Please upload your favicon here.', 'curated'),
				'desc'		=> __('Recommended size is (144px -Width) and (144px -Height).', 'curated'),
				'default'	=> array('url'=>get_template_directory_uri().'/images/tm-icon-144.png'),
			),





			array(
				'id'		=> 'animati_on',
				'type'		=> 'switch',
				'title'		=> __('Animation', 'curated'),
				'subtitle'	=> __('some elements transition when it\'s appear', 'curated'),
				'default'	=> true,
			),
			array(
				'id'		=> 'responsive_on',
				'type'		=> 'switch',
				'title'		=> __('Responsive', 'curated'),
				'subtitle'	=> __('Responsive layout on small devices', 'curated'),
				'default'	=> true,
			),
			array(
				'id'		=> 'top_bar_on',
				'type'		=> 'switch',
				'title'		=> __('Top Bar', 'curated'),
				'subtitle'	=> __('Top Bar on dekstop', 'curated'),
				'default'	=> true,
			),


			// array(
			// 	'id'		=> 'body_background',
			// 	'type'		=> 'background',
			// 	'title'		=> __('Body Background', 'curated'),
			// 	'subtitle'	=> __('Body background with image, color, etc.', 'curated'),
			// 	'default'	=> array( 'background-color' => '#f7f7f7' )
			// ),



			array(
				'id'		=> 'google_fonts_on',
				'type'		=> 'switch',
				'title'		=> __('Google Fonts', 'curated'),
				'subtitle'	=> __('Google Fonts', 'curated'),
				'default'	=> true,
			),


			array(
				'id'		=> 'boxed_on',
				'type'		=> 'switch',
				'title'		=> __('Boxed Layout', 'curated'),
				'subtitle'	=> __('When it enabled, layout will show in boxed style.', 'curated'),
				'default'	=> false
			),

			array(
				'id'       => 'full-background',
				'type'     => 'background',
				'title'    => __('Body Background', 'redux-framework-demo'),
				'subtitle' => __('Body background with image, color, etc.', 'redux-framework-demo'),
				'desc'     => __('Background will not affect if Boxed mode is OFF', 'redux-framework-demo'),
				'default'  => array(
					'background-color' => '#1e73be',
				)
			),


		)
) );



/**

	Header ++++++++++++++++++++++++++++++++

**/
Redux::setSection( $opt_name, array(
	'title'			=> __( 'Header', 'curated'),
	'desc'			=> __( '<p class="description">All Header related options are listed here.</p>', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> 'el-icon-asterisk',
	'fields'		=> array(
			/**
			SECTION START - SEARCH
			**/
			array(
				'id'		=> 'section-search-start',
				'type'		=> 'section',
				'title'		=> __('Search', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 'search_on',
				'type'		=> 'switch',
				'title'		=> __('Search', 'curated'),
				'subtitle'	=> __('When in disabled search will not show', 'curated'),
				'default'	=> true,
			),
			array(
				'id'		=> 'search_option',
				'type'		=> 'select',
				'title'		=> __('Search Result Option', 'curated'),
				'subtitle'	=> __('Please select option for search results.', 'curated'),
				'options'	=> array(
					'post'		=> 'Posts',
					'page'		=> 'Pages',
					'all'		=> 'Posts & Pages'
				),
				'default'	=> 'post'
			),
			array(
				'id'		=> 'ajax_search_on',
				'type'		=> 'switch',
				'title'		=> __('Ajax Search', 'curated'),
				'subtitle'	=> __('When in disabled ajax search will not show', 'curated'),
				'default'	=> true,
			),
			array(
				'id'		=>'ajax_search_number_post',
				'type'		=> 'text',
				'title'		=> __('Ajax Search Number of Post', 'curated'),
				'subtitle'	=> __('Please select number of ajax search post.', 'curated'),
				'validate'	=> 'numeric',
				'default'	=> 4,
			),
			array(
				'id'		=> 'section-search-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
			SECTION END - SEARCH
			**/


			/**
			SECTION START - TOP NAVIGATION
			**/
			array(
				'id'		=> 'section-topnav-opt-start',
				'type'		=> 'section',
				'title'		=> __('Top Navigation - Header', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 'th_social_network',
				'type'		=> 'text',
				'title'		=> __('Social Network', 'curated'),
				'subtitle'	=> __('Enter your Social Netowork URL. Leave blank if you don\'t wanna show', 'curated'),
				'options'	=> array(
					'facebook_f'	=> '<i class="icon-facebook"></i> Facebook ',
					'facebook_sign'	=> '<i class="icon-facebook-squared"></i> Fb Square',
					'twitter'		=> '<i class="icon-twitter"></i> Twitter',
					'instagram'		=> '<i class="icon-instagrem"></i> Instagram',
					'pinterest'		=> '<i class="icon-pinterest"></i> Pinterest',
					'youtube'		=> '<i class="icon-play"></i> Youtube',
					'gplus'			=> '<i class="icon-gplus"></i> Google+',
					'linkedin'		=> '<i class="icon-linkedin"></i> LinkedIn',
					'flickr'		=> '<i class="icon-flickr"></i> Flickr',
					'tumblr'		=> '<i class="icon-tumblr"></i> Tumblr',
					'vimeo'			=> '<i class="icon-vimeo"></i> Vimeo',
					'behance'		=> '<i class="icon-behance"></i> Behance',
					'dribbble'		=> '<i class="icon-dribbble"></i> Dribbble',
					'github'		=> '<i class="icon-github"></i> Github',
					'stumble'		=> '<i class="icon-stumbleupon"></i> StumbleUpon',
					'vkontakte'		=> '<i class="icon-vkontakte"></i> Vkonkakte',
					'scloud'		=> '<i class="icon-soundcloud"></i> Soundcloud',
					'skype'			=> '<i class="icon-skype"></i> Skype',
					'spotify'		=> '<i class="icon-spotify"></i> Spotify',
					'lastfm'		=> '<i class="icon-lastfm"></i> Lastfm',
				),
				'default'	=> array(
					'facebook_f'	=> '#',
					'facebook_sign'	=> '',
					'twitter'		=> '#',
					'instagram'		=> '#',
					'pinterest'		=> '',
					'youtube'		=> '',
					'gplus'			=> '',
					'linkedin'		=> '',
					'flickr'		=> '',
					'tumblr'		=> '',
					'vimeo'			=> '',
					'behance'		=> '',
					'dribbble'		=> '',
					'github'		=> '',
					'stumble'		=> '',
					'vkontakte'		=> '',
					'scloud'		=> '',
					'skype'			=> '',
					'spotify'		=> '',
					'lastfm'		=> ''
				),
			),
			// array(
			// 	'id'		=> 'th_bg_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Background color', 'curated'),
			// 	'subtitle'	=> __('Pick Top navigation background color.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#212121',
			// ),
			// array(
			// 	'id'		=> 'th_bg_mob_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Mobile Background #active color', 'curated'),
			// 	'subtitle'	=> __('Pick a background color for Mobile active menu.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#181818',
			// ),
			// array(
			// 	'id'		=> 'th_txt_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Text Color', 'curated'),
			// 	'subtitle'	=> __('Pick a color for Top navigation text.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#EAEAEA',
			// ),
			array(
				'id'		=> 'section-topnav-opt-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
			SECTION END - TOP NAVIGATION
			**/


			/**
			SECTION START - MAIN NAVIGATION
			**/
			array(
				'id'		=> 'section-mainnav-start',
				'type'		=> 'section',
				'title'		=> __('Main Menu - Header', 'curated'),
				'indent'	=> true
			),
			// array(
			// 	'id'		=> 'header_alignment',
			// 	'type'		=> 'select',
			// 	'title'		=> __('Header Alignment', 'curated'),
			// 	'subtitle'	=> __('Please select header alignment', 'curated'),
			// 	'options'	=> array(
			// 		'normal'	=> 'Normal',
			// 		'center'	=> 'Center'
			// 	),
			// 	'default'	=> 'normal'
			// ),
			array(
				'id'		=> 'thelogo',
				'type'		=> 'media',
				'title'		=> __('Logo', 'curated'),
				'subtitle'	=> __('Please upload your logo here.', 'curated'),
				'desc'		=> __('Recommended size is less than (270px Width) and (90px Height).', 'curated'),
				'url'		=> true,
				'default'	=> array('url'=>get_template_directory_uri().'/images/logo.png'),
			),
			array(
				'id'		=> 'thelogoretina',
				'type'		=> 'media',
				'title'		=> __('Logo Retina', 'curated'),
				'subtitle'	=> __('Please upload your logo (retina) here.', 'curated'),
				'desc'		=> __('Recommended size is less than (540px Width) and (180px Height).', 'curated'),
				'url'		=> true,
				'default'	=> array('url'=>get_template_directory_uri().'/images/logo-retina.png'),
			),
			array(
				'id'		=> 'logomainnav',
				'type'		=> 'media',
				'title'		=> __('Small Logo', 'curated'),
				'subtitle'	=> __('Please upload your logo for small navigation here.', 'curated'),
				'desc'		=> __('Recommended size is less than (50px Height).', 'curated'),
				'url'		=> true,
				'default'	=> array('url'=>get_template_directory_uri().'/images/small-logo.png'),
			),
			array(
				'id'		=> 'logomainnavretina',
				'type'		=> 'media',
				'title'		=> __('Small Logo Retina', 'curated'),
				'subtitle'	=> __('Please upload your logo (retina) for small navigation here.', 'curated'),
				'desc'		=> __('Recommended size is less than (100px Height).', 'curated'),
				'url'		=> true,
				'default'	=> array('url'=>get_template_directory_uri().'/images/logo-retina-small.png'),
			),
			// array(
			// 	'id'		=> 'font_3',
			// 	'type'		=> 'typography',
			// 	'title'		=> __('Navigation Typography', 'curated'),
			// 	'subtitle'	=> __('Select the Navigation Typography.', 'curated'),
			// 	'google'	=> $opt_fonts,
			// 	'color'		=> false,
			// 	'font-size'	=> false,
			// 	'text-align' => false,
			// 	'line-height' => false,
			// 	'font-backup' => false,
			// 	'default'	=> array(
			// 		'font-family'	=> 'Oswald',
			// 		'font-weight'	=> 400,
			// 		'subsets'		=> 'latin',
			// 	),
			// ),
			// array(
			// 	'id'		=> 'mh_txt_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Primary Menu Text color', 'curated'),
			// 	'subtitle'	=> __('Pick a color for Primary Menu text color.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#333333',
			// ),
			// array(
			// 	'id'		=> 'mh_sub_bg_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Sub Menu Background Color', 'curated'),
			// 	'subtitle'	=> __('Pick a background color for Sub menus.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#ffffff',
			// ),
			// array(
			// 	'id'		=> 'mh_sub_txt_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Sub Menu Text Color', 'curated'),
			// 	'subtitle'	=> __('Pick a color for Sub menus text color.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#333333',
			// ),
			// array(
			// 	'id'		=> 'mh_sub_txt_hover_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Sub Menu Hover Text Color', 'curated'),
			// 	'subtitle'	=> __('Pick a color for Sub menus #hover text color.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#333333',
			// ),
			// array(
			// 	'id'		=> 'mh_search_background_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Search Background Color', 'curated'),
			// 	'subtitle'	=> __('Pick a color for Search background color.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#ffffff',
			// ),
			// array(
			// 	'id'		=> 'mh_search_text_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Search Text Color', 'curated'),
			// 	'subtitle'	=> __('Pick a color for Search text color.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#DADADA',
			// ),
			array(
				'id'		=> 'section-mainnav-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
			SECTION END - MAIN NAVIGATION
			**/


			/**
			SECTION START - HEADER ADS
			**/
			array(
				'id'		=> 'section-headerads-start',
				'type'		=> 'section',
				'title'		=> __('Ads - Header', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 'ah_ads_768',
				'type'		=> 'ace_editor',
				'title'		=> __('Ads Code for 768x90', 'curated'),
				'subtitle'	=> __('Paste your Ads 768x90 pixel code here.', 'curated'),
				'desc'		=> __('Possible use < html >, < img >, < script > here.', 'curated'),
				'mode'		=> 'html',
				'theme'		=> 'chrome',
				'default'	=> ''
			),
			array(
				'id'		=> 'ah_ads_468',
				'type'		=> 'ace_editor',
				'title'		=> __('Ads Code for 468x60', 'curated'),
				'subtitle'	=> __('Paste your Ads 468x60 pixel code here.', 'curated'),
				'desc'		=> __('Plase Use < script > tag to add Javascript code, and it\'s possible to use < html >, < img >, < style > here.', 'curated'),
				'mode'		=> 'html',
				'theme'		=> 'chrome',
				'default'	=> ''
			),
			array(
				'id'		=> 'ah_ads_320',
				'type'		=> 'ace_editor',
				'title'		=> __('Ads Code for 320x50', 'curated'),
				'subtitle'	=> __('Paste your Ads 320x50 pixel code here.', 'curated'),
				'desc'		=> __('Plase Use < script > tag to add Javascript code, and it\'s possible to use < html >, < img >, < style > here.', 'curated'),
				'mode'		=> 'html',
				'theme'		=> 'chrome',
				'default'	=> ''
			),
			array(
				'id'		=> 'section-headerads-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
			SECTION END - HEADER ADS
			**/
		)
) );



/**

	----------------------------------------------

**/
Redux::setSection( $opt_name, array(
	'id' => 'divide_1',
	'type' => 'divide',
) );



/**

	Content ++++++++++++++++++++++++++++++++

**/
Redux::setSection( $opt_name, array(
	'title'			=> __( 'Content', 'curated'),
	'desc'			=> __( '<p class="description">All Content related options are listed here.</p>', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> 'el-icon-file',
	'fields'		=> array(
			/**
			SECTION START - MODULE
			**/
			array(
				'id'		=> 'section-module-start',
				'type'		=> 'section',
				'title'		=> __('Modules and Blocked layout', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 'module_meta',
				'type'		=> 'checkbox',
				'title'		=> __('Module & Blocked Meta', 'curated'),
				'subtitle'	=> __('Uncheck for hide module & blocked meta.', 'curated'),
				'options'	=> array(
						'category'	=> 'Category',
						'view'		=> 'Viewer',
						'comment'	=> 'Comment',
						'author'	=> 'Author',
						'date'		=> 'Date'
					),
				'default'	=> array(
						'category'	=> true,
						'view' 		=> true,
						'comment' 	=> true,
						'author'	=> true,
						'date'		=> true
					),
			),
			// array(
			// 	'id'		=> 'module_3_on',
			// 	'type'		=> 'switch',
			// 	'title'		=> __('\'Read more\' on Module 3 / Blocked 3', 'curated'),
			// 	'subtitle'	=> __('When in disabled read more will now show', 'curated'),
			// 	'default'	=> false,
			// ),
			array(
				'id'		=> 'section-module-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
			SECTION END - MODULE
			**/


			/**
			SECTION START - RUNNING TEXT
			**/
			array(
				'id'		=> 'section-running-start',
				'type'		=> 'section',
				'title'		=> __('Running Text', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 'running_text_on',
				'type'		=> 'switch',
				'title'		=> __('Running Text', 'curated'),
				'subtitle'	=> __('When in disabled running text will not show', 'curated'),
				'default'	=> false,
			),
			array(
				'id'		=> 'running_text_number_post',
				'type'		=> 'slider',
				'title'		=> __('Running Text Number of Post', 'curated'),
				'subtitle'	=> __('Please select number of running text post.', 'curated'),
				'min'		=> 5,
				'step'		=> 1,
				'max'		=> 10,
				'default'	=> 6,
			),
			array(
				'id'		=> 'running_text_tag_filter',
				'type'		=> 'select',
				'title'		=> __('Running Text Tag Filter', 'curated'),
				'subtitle'	=> __('Please check tag for running text filter.', 'curated'),
				'multi'		=> true,
				'data'		=> 'tags',
			),
			array(
				'id'		=> 'running_text_cat_filter',
				'type'		=> 'checkbox',
				'title'		=> __('Running Text Category Filter', 'curated'),
				'subtitle'	=> __('Please check category for running text filter.', 'curated'),
				'data'		=> 'categories',
				'default'	=> '',
			),
			array(
				'id'		=> 'running_text_filter',
				'type'		=> 'select',
				'title'		=> __('Running Text Filter', 'curated'),
				'subtitle'	=> __('Please select the running text filter.', 'curated'),
				'options'	=> array(
					'latest'	=> 'Latest',
					'featured'	=> 'Featured',
					'random'	=> 'Random',
					'popular_all' => 'Popular All-time',
					'popular_month' => 'Popular This Month',
					'popular_week' => 'Popular This Week',
					'top_all'	=> 'Top All-time',
					'top_month'	=> 'Top This Month',
					'top_week'	=> 'Top This Week'
				),
				'default'	=> 'latest'
			),
			array(
				'id'		=> 'section-running-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
			SECTION END - RUNNING TEXT
			**/


			/**
			SECTION START - BREADCRUMB
			**/
			array(
				'id'		=> 'section-breadcrumb-start',
				'type'		=> 'section',
				'title'		=> __('Breadcrumb', 'curated'),
				'indent'	=> true
			),
			// array(
			// 	'id'		=> 'breadcrumb',
			// 	'type'		=> 'checkbox',
			// 	'title'		=> __('Enable Breadcrumb', 'curated'),
			// 	'subtitle'	=> __('When it disabled, breadcrumb will not show.', 'curated'),
			// 	'default'	=> '1'// 1 = on | 0 = off
			// ),
			array(
				'id'		=> 'breadcrumb',
				'type'		=> 'switch',
				'title'		=> __('Breadcrumb', 'curated'),
				'subtitle'	=> __('When it disabled, breadcrumb will not show.', 'curated'),
				'default'	=> true,
			),
			array(
				'id'		=> 'section-breadcrumb-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
			SECTION END - BREADCRUMB
			**/


			/**
			SECTION START - USER PHOTO STYLE
			**/
			array(
				'id'		=> 'section-photostyle-start',
				'type'		=> 'section',
				'title'		=> __('User Photo Style (Author and comment)', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 'profile_style',
				'type'		=> 'select',
				'title'		=> __('Author Profile style', 'curated'),
				'subtitle'	=> __('Please select the Author and Comment avatar photo style', 'curated'),
				'options'	=> array(
					'left'		=> 'Left',
					'center'	=> 'Center',
				),
				'default'	=> 'left'
			),
			array(
				'id'		=> 'section-photostyle-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
			SECTION END - USER PHOTO STYLE
			**/


			array(
				'id'		=> 'section-page-start',
				'type'		=> 'section',
				'title'		=> __('Single Page & Builder', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 'page_affix',
				'type'		=> 'switch',
				'title'		=> __('Affix Sidebar', 'curated'),
				'subtitle'	=> __('affix sidebar on single page & builder.', 'curated'),
				'default'	=> false,
			),
			array(
				'id'		=> 'section-page-end',
				'type'		=> 'section',
				'indent'	=> false
			),


			/**
			SECTION START - SINGLE
			**/
			array(
				'id'		=> 'section-single-start',
				'type'		=> 'section',
				'title'		=> __('Single Post', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 'single_meta_count',
				'type'		=> 'checkbox',
				'title'		=> __('Meta Count on Single Post', 'curated'),
				'subtitle'	=> __('Uncheck to hide meta count.', 'curated'),
				'options'	=> array(
						'view' => 'Viewer',
						'comment' => 'Comment'
					),
				'default'	=> array(
						'view' => true,
						'comment' => true
					),
			),
			// array(
			// 	'id'		=> 'single_playr',
			// 	'type'		=> 'checkbox',
			// 	'title'		=> __('Enable Play button text on Single Post', 'curated'),
			// 	'subtitle'	=> __('When it disabled, Text on the bottom button will not show', 'curated'),
			// 	'default'	=> '0'// 1 = on | 0 = off
			// ),
			array(
				'id'		=> 'single_playr',
				'type'		=> 'switch',
				'title'		=> __('Play button text on Single Post', 'curated'),
				'subtitle'	=> __('When it disabled, Text on the bottom button will not show', 'curated'),
				'default'	=> false,
			),
			array(
				'id'		=> 'play_button_text',
				'type'		=> 'text',
				'title'		=> __('Play Button Text', 'curated'),
				'subtitle'	=> __('Please enter the play button text.', 'curated'),
				'validate'	=> 'no_html',
				'default'	=> 'Play'
			),
			array(
				'id'		=> 'single_regular_feat_image',
				'type'		=> 'select',
				'title'		=> __('Global - Featured image on Regular Cover style', 'curated'),
				'subtitle'	=> __('When it disabled, featured image on Regular Cover will disappear even the single post setting is enable ', 'curated'),
				'options'	=> array(
					'enable'	=> 'Enable',
					'disable'	=> 'Disable',
					'custom'	=> 'Custom',
				),
				'default'	=> 'custom'
			),
			array(
				'id'		=> 'related_place',
				'type'		=> 'select',
				'title'		=> __('Related Posts Position', 'curated'),
				'subtitle'	=> __('Please select the Related Posts position', 'curated'),
				'options'	=> array(
					'tags'		=> 'Below Post Tags',
					'author'	=> 'Below Post Author',
				),
				'default'	=> 'author'
			),
			array(
				'id'		=> 'single_affix',
				'type'		=> 'switch',
				'title'		=> __('Affix Sidebar', 'curated'),
				'subtitle'	=> __('affix sidebar on single post.', 'curated'),
				'default'	=> false,
			),
			array(
				'id'		=> 'section-single-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
			SECTION END - SINGLE
			**/


			/**
			SECTION START - TOP STICKY
			**/
			array(
				'id'		=> 'section-top_sticky-start',
				'type'		=> 'section',
				'title'		=> __('Top Sticky Posts', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 'top_sticky_number_post',
				'type'		=> 'slider',
				'title'		=> __('Number of Sticky Posts', 'curated'),
				'subtitle'	=> __('Please select number of top sticky post.', 'curated'),
				'min'		=> 4,
				'step'		=> 1,
				'max'		=> 10,
				'default'	=> 6,
			),
			array(
				'id'		=> 'top_sticky_tag_filter',
				'type'		=> 'select',
				'title'		=> __('Tag Filter', 'curated'),
				'subtitle'	=> __('Please check tag for top sticky filter.', 'curated'),
				'multi'		=> true,
				'data'		=> 'tags',
			),
			array(
				'id'		=> 'top_sticky_cat_filter',
				'type'		=> 'checkbox',
				'title'		=> __('Category Filter', 'curated'),
				'subtitle'	=> __('Please check category for top sticky filter.', 'curated'),
				'data'		=> 'categories',
				'default'	=> '',
			),
			array(
				'id'		=> 'top_sticky_filter',
				'type'		=> 'select',
				'title'		=> __('Sorting', 'curated'),
				'subtitle'	=> __('Please select the top sticky filter.', 'curated'),
				'options'	=> array(
					'latest'	=> 'Latest',
					'featured'	=> 'Featured',
					'random'	=> 'Random',
					'popular_all' => 'Popular All-time',
					'popular_month' => 'Popular This Month',
					'popular_week' => 'Popular This Week',
					'top_all'	=> 'Top All-time',
					'top_month'	=> 'Top This Month',
					'top_week'	=> 'Top This Week'
				),
				'default'	=> 'latest'
			),
			array(
				'id'		=> 'section-top_sticky-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
			SECTION END - TOP STICKY
			**/


			/**
			SECTION START - CONTENT PRIMARY COLOR
			**/
			// array(
			// 	'id'		=> 'section-content_primary-start',
			// 	'type'		=> 'section',
			// 	'title'		=> __('Content Primary Color', 'curated'),
			// 	'indent'	=> true
			// ),
			// array(
			// 	'id'		=> 'co_txt_color_1',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Content Heading Color', 'curated'),
			// 	'subtitle'	=> __('Pick a Heading color, it\'s for: Title, Metas, Name.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#333333',
			// ),
			// array(
			// 	'id'		=> 'co_txt_color_2',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Content Text Color', 'curated'),
			// 	'subtitle'	=> __('Pick a Content text color, it\'s for: text content.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#595858',
			// ),
			// array(
			// 	'id'		=> 'co_txt_color_meta',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Content Meta Color', 'curated'),
			// 	'subtitle'	=> __('Pick a meta color, it\'s for: meta text color.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#9a9a9a',
			// ),
			// array(
			// 	'id'		=> 'co_cat_bg_text',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Category Background Text', 'curated'),
			// 	'subtitle'	=> __('Pick a color for category background text.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#eaeaea',
			// ),
			// array(
			// 	'id'		=> 'section-content_primary-end',
			// 	'type'		=> 'section',
			// 	'indent'	=> false
			// ),
			/**
			SECTION END - CONTENT PRIMARY COLOR
			**/


			/**
			SECTION START - ELEMENTS COLOR
			**/
			// array(
			// 	'id'		=> 'section-elcolor-start',
			// 	'type'		=> 'section',
			// 	'title'		=> __('Elements Color', 'curated'),
			// 	'indent'	=> true
			// ),
			// array(
			// 	'id'		=> 'coe_button_bg_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Button Background Color', 'curated'),
			// 	'subtitle'	=> __('Pick a button background color.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#333333',
			// ),
			// array(
			// 	'id'		=> 'coe_button_text_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Button Text Color', 'curated'),
			// 	'subtitle'	=> __('Pick a button text color.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#ffffff',
			// ),
			// array(
			// 	'id'		=> 'section-elcolor-end',
			// 	'type'		=> 'section',
			// 	'indent'	=> false
			// ),
			/**
			SECTION END - ELEMENTS COLOR
			**/
		)
) );



/**

	Homepage ++++++++++++++++++++++++++++++++

**/
Redux::setSection( $opt_name, array(
	'title'			=> __('Homepage', 'curated'),
	'desc'			=> __('<p class="description"> All Homepage related options are listed here.</p>', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> ' el-icon-home',
	'fields'		=> array(
			array(
				'id'		=> 'homepage_module',
				'type'		=> 'image_select',
				'title'		=> __('Latest Post Layout', 'curated'),
				'subtitle'	=> __('Please select the Latest Post layout when open the posts by Tag & Date', 'curated'),
				'desc'		=> '',
				'options'	=> array(
					'module-1'	=> array('alt' => 'Module 1', 'img' => get_template_directory_uri().'/images/partial/module-1.png'),
					'module-2'	=> array('alt' => 'Module 2', 'img' => get_template_directory_uri().'/images/partial/module-2.png'),
					'module-3'	=> array('alt' => 'Module 3', 'img' => get_template_directory_uri().'/images/partial/module-3.png'),
					'module-4'	=> array('alt' => 'Module 4', 'img' => get_template_directory_uri().'/images/partial/module-4.png')
				),
				'default'	=> 'module-3'
			)
		)
) );



/**

	Author ++++++++++++++++++++++++++++++++

**/
Redux::setSection( $opt_name, array(
	'title'			=> __('Author', 'curated'),
	'desc'			=> __('<p class="description"> All Author related options are listed here.</p>', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> 'el-icon-user',
	'fields'		=> array(
			array(
				'id'		=> 'author_module',
				'type'		=> 'image_select',
				'title'		=> __('Posts by Author Layout', 'curated'),
				'subtitle'	=> __('Please select the Module layout when open the posts by an Author', 'curated'),
				'options'	=> array(
					'module-1'	=> array('alt' => 'Module 1', 'img' => get_template_directory_uri().'/images/partial/module-1.png'),
					'module-2'	=> array('alt' => 'Module 2', 'img' => get_template_directory_uri().'/images/partial/module-2.png'),
					'module-3'	=> array('alt' => 'Module 3', 'img' => get_template_directory_uri().'/images/partial/module-3.png'),
					'module-4'	=> array('alt' => 'Module 4', 'img' => get_template_directory_uri().'/images/partial/module-4.png')
				),
				'default'	=> 'module-2'
			),
			array(
				'id'		=> 'author_summary_on',
				'type'		=> 'switch',
				'title'		=> __('Author Post Summary', 'curated'),
				'subtitle'	=> __('When it disabled, author post summary will not show.', 'curated'),
				'default'	=> true,
			),
		)
) );



/**

	Archive ++++++++++++++++++++++++++++++++

**/
Redux::setSection( $opt_name, array(
	'title'			=> __('Archive', 'curated'),
	'desc'			=> __('<p class="description">All Archive related options are listed here.</p>', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> 'el-icon-book',
	'fields'		=> array(
			array(
				'id'		=> 'archive_module',
				'type'		=> 'image_select',
				'title'		=> __('Posts by Tag & Date Layout', 'curated'),
				'subtitle'	=> __('Please select the Module layout when open the posts by Tag & Date', 'curated'),
				'options'	=> array(
					'module-1'	=> array('alt' => 'Module 1', 'img' => get_template_directory_uri().'/images/partial/module-1.png'),
					'module-2'	=> array('alt' => 'Module 2', 'img' => get_template_directory_uri().'/images/partial/module-2.png'),
					'module-3'	=> array('alt' => 'Module 3', 'img' => get_template_directory_uri().'/images/partial/module-3.png'),
					'module-4'	=> array('alt' => 'Module 4', 'img' => get_template_directory_uri().'/images/partial/module-4.png')
				),
				'default'	=> 'module-2'
			),
			array(
				'id'		=> 'archive_summary_on',
				'type'		=> 'switch',
				'title'		=> __('Archive Post Summary', 'curated'),
				'subtitle'	=> __('When it disabled, archive post summary will not show.', 'curated'),
				'default' 	=> true,
			),
			array(
				'id'		=> 'category_summary_on',
				'type'		=> 'switch',
				'title'		=> __('Category Post Summary', 'curated'),
				'subtitle'	=> __('When it disabled, category post summary will not show.', 'curated'),
				'default'	=> true,
			),



			array(
				'id'		=> 'category_sidebar_select',
				'type'		=> 'select',
				'title'		=> __('Sidebar', 'curated'),
				'subtitle'	=> __('Select sidebar for archive pages', 'curated'),
				'data'		=> 'sidebar',
				'default'	=> '0-curated-sidebar'
			),

		)
) );



/**

	404 ++++++++++++++++++++++++++++++++

**/
Redux::setSection( $opt_name, array(
	'title'			=> __('404 Page', 'curated'),
	'desc'			=> __('<p class="description"> All 404 Page related options are listed here.</p>', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> 'el-icon-compass',
	'fields'		=> array(
			array(
				'id'		=> 'nf404_title',
				'type'		=> 'text',
				'title'		=> __('404 Page Title', 'curated'),
				'subtitle'	=> __('Please enter the 404 Page title to give information to your audience.', 'curated'),
				'validate'	=> 'no_html',
				'default'	=> 'Whoops! Bad News...'
			),
			array(
				'id'		=> 'nf404_desc',
				'type'		=> 'textarea',
				'title'		=> __('404 Page Information', 'curated'),
				'subtitle'	=> __('Please enter the 404 Page description that useful information for your audience.', 'curated'),
				'validate'	=> 'html',
				'default'	=> "We couldn't find the page you were looking for. Perhaps searching will help.",
			),
			array(
				'id'		=> 'nf404_button',
				'type'		=> 'text',
				'title'		=> __('Button Back to Home', 'curated'),
				'subtitle'	=> __('Please enter the Text Button that will return to Homepage.', 'curated'),
				'validate'	=> 'no_html',
				'default'	=> 'Please, Take me back to home!',
			),
		)
) );



/**

	Footer ++++++++++++++++++++++++++++++++

**/
Redux::setSection( $opt_name, array(
	'title'			=> __('Footer', 'curated'),
	'desc'			=> __('<p class="description"> All Footer related options are listed here.</p>', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> 'el-icon-photo',
	'fields'		=> array(
			/**
				SECTION START - FOOTER WIDGET
			**/
			array(
				'id'		=> 'section-footerwidget-start',
				'type'		=> 'section',
				'title'		=> __('Footer Widget', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 'footer_widget',
				'type'		=> 'switch',
				'title'		=> __('Show Footer Widget', 'curated'),
				'subtitle'	=> __('When it disabled, Footer will disappear from footer', 'curated'),
				'default'	=> false,
			),
			array(
				'id'		=> 'section-footerwidget-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			// array(
			// 	'id'		=> 'fwa_bg_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Wigets Area Background Color', 'curated'),
			// 	'subtitle'	=> __('Pick a background color for the footer widgets area.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#151515',
			// ),
			// array(
			// 	'id'		=> 'fwa_txt_color_1',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Widgets Heading Color', 'curated'),
			// 	'subtitle'	=> __('Pick a footer heading color for the footer widgets area.', 'curated'),
			// 	'transparent'	=> false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#dcdcdc',
			// ),
			// array(
			// 	'id'		=> 'fwa_txt_color_2',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Widgets content Color', 'curated'),
			// 	'subtitle'	=> __('Pick a footer content color for the footer widgets area.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#7d7d7d',
			// ),
			// array(
			// 	'id'		=> 'section-footer_widget-end',
			// 	'type'		=> 'section',
			// 	'indent'	=> false
			// ),
			/**
			SECTION END - FOOTER WIDGET
			**/


			/**
			SECTION START - FOOTER COPYRIGHT & MENU
			**/
			array(
				'id'		=> 'section-copyright-start',
				'type'		=> 'section',
				'title'		=> __('Footer Copyright & Menus', 'curated'),
				'indent'	=> true
			),
			// array(
			// 	'id'		=> 'fc_bg_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Footer Copyright Background', 'curated'),
			// 	'subtitle'	=> __('Pick a background color for Footer copyright background.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#000000',
			// ),
			// array(
			// 	'id'		=> 'fc_txt_color_1',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Text Color', 'curated'),
			// 	'subtitle'	=> __('Pick a footer text color for the footer copyright area.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#595858',
			// ),
			array(
				'id'		=> 'fc_copyright',
				'type'		=> 'editor',
				'title'		=> __('Copyright', 'curated'),
				'subtitle'	=> __('Enter your copyright text, it\'s possible for shortcode too.', 'curated'),
				'default'	=> '&copy; Copyright 2017. Curated - by Maha Themes.',
			),
			array(
				'id'		=> 'fc_menu',
				'type'		=> 'select',
				'title'		=> __('Additional menu', 'curated'),
				'subtitle'	=> __('Please select one of the menu if you want to show a menu on the footer', 'curated'),
				'desc'		=> __('It\'s just support for 1st level menu, so the 2nd level of menu will not appear.', 'curated'),
				'data'		=> 'menus',
			),
			array(
				'id'		=> 'fc_link_color',
				'type'		=> 'select',
				'title'		=> __('Menus Link Color', 'curated'),
				'subtitle'	=> __('Please select an options for Menu link #hover', 'curated'),
				'desc'		=> __('It\'s mean when the #hover a link, the color will change as defined this option.', 'curated'),
				'options'	=> array(
					'accent-1'		=> 'Primary Accent Color',
					'accent-2'		=> 'Secondary Accent Color',
					'default'		=> 'Default - Footer Copyright Text Color',
				),
				'default'	=> 'default'
			),
			array(
				'id'		=> 'section-copyright-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
			SECTION END - FOOTER COPYRIGHT & MENU
			**/


		)
) );



/**
	Social ++++++++++++++++++++++++++++++++
**/
/*
Redux::setSection( $opt_name, array(
	'title'			=> __('Social Media', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> 'el-icon-twitter',
	'fields'		=> array(
			array(
				'id'		=> 'social-facebook',
				'type'		=> 'text',
				'title'		=> __('Facebook Token', 'curated'),
				'desc'		=> __('If you do not have a Facebook App, you can follow this video (<a target="_blank" href="http://youtu.be/oyjh40d_zbY">http://youtu.be/oyjh40d_zbY</a>) to create a Facebook App via <a target="_blank" href="https://developers.facebook.com">https://developers.facebook.com</a> </br></br>
				There is 2 way to get your Facebook token :</br>
				<strong>1. Merge your "App ID" + "|" + "App Secret"</strong></br>
				<span>&nbsp;&nbsp;&nbsp;</span> by adding "|" character between your "App ID" and "App Secret"</br></br>

				<strong>2. Generate via Facebook Graph API Explorer</strong></br>
				<span>&nbsp;&nbsp;&nbsp;</span> On Facebook Developers Page, Go to menu "Tools & Support > Graph API Explorer" </br></br>

				You can see both of them via this video <a target="_blank" href="http://youtu.be/oyjh40d_zbY">http://youtu.be/oyjh40d_zbY</a></br>', 'curated'),
				'default'	=> '906750036058241|bf2f43b495afef7a064d8d48a8cd8e8f',
			),
			array(
				'id'		=> 'social-google',
				'type'		=> 'text',
				'title'		=> __('Google API Key (Google+ & Youtube)', 'curated'),
				'desc'		=> __('If you do not have a Google Project, you can follow this video (<a target="_blank" href="https://www.youtube.com/watch?v=NENb_klOR3w">https://www.youtube.com/watch?v=NENb_klOR3w</a>) to create a Google project and get the Google+ API Key via <a target="_blank" href="https://console.developers.google.com/">https://console.developers.google.com/</a> </br></br>', 'curated'),
				'default' 	=> 'AIzaSyAqL8iRM2QFCum2pkcpyhY3ORe0Ye9hXms',
			),
			array(
				'id'		=> 'social-twitter-key',
				'type'		=> 'text',
				'title'		=> __('Twitter - Consumer Key', 'curated'),
				'desc'		=> __('If you do not have a Twitter App, you can follow this video (<a target="_blank" href="https://youtu.be/dnad-jfJXaw">https://youtu.be/dnad-jfJXaw</a>) to create a Twitter App to get the Twitter Consumer Key and Consumer Secret via <a target="_blank" href="https://apps.twitter.com/">https://apps.twitter.com/</a> </br></br>', 'curated'),
				'default'	=> 'd587cQyByWbGtukMDdqSRn4jT',
			),
			array(
				'id'		=> 'social-twitter-secret',
				'type'		=> 'text',
				'title'		=> __('Twitter - Consumer Secret', 'curated'),
				'default'	=> 'EpmYu2VU365swi5Emsj85MJ2gtvsI0HmKLevLGZg3uQovHe6xa',
			),
			array(
				'id'		=> 'social-instagram',
				'type'		=> 'text',
				'title'		=> __('Instagram Token', 'curated'),
				'desc'		=> __('If you do not have an Instagram Client, you can get your Instagram Token code by login to our "Instagram Token Generator". Get your Instagram token via this link <a target="_blank" href="http://mahathemes.com/instagram/">http://mahathemes.com/instagram/</a> </br></br>

				(We never collect your data, It is Safe)', 'curated'),
				'default'	=> '1316998486.94c7f68.2005c19e4e0a4d839a541610226e4f69',
			),
			array(
				'id'		=> 'social-pinterest',
				'type'		=> 'text',
				'title'		=> __('Pinterest Token', 'curated'),
				'desc'		=> __('Get your Pinterest token via this link <a target="_blank" href="https://developers.pinterest.com/tools/access_token/">https://developers.pinterest.com/tools/access_token/</a> </br></br>
				Note: Check read_public only for security reason.', 'curated'),
				'default'	=> 'AWhvA7mQVr9nGHPB913F9md1blZZFBWbNoSLC19CoEt7z0A3qAAAAAA',
			),
			array(
				'id'		=> 'social-tumblr-key',
				'type'		=> 'text',
				'title'		=> __('Tumblr - Token', 'curated'),
				'desc'		=> __('If you do not have a Tumblr Token get the Tumblr Token and Token Secret via <a target="_blank" href="http://mahathemes.com/tumblr/">http://mahathemes.com/tumblr/</a> </br></br>(We never collect your data, It is Safe)', 'curated'),
				'default'	=> '',
			),
			array(
				'id'		=> 'social-tumblr-secret',
				'type'		=> 'text',
				'title'		=> __('Tumblr - Token Secret', 'curated'),
				'default'	=> '',
			),
		)
) );
*/


/**

	----------------------------------------------

**/
Redux::setSection( $opt_name, array(
	'id' => 'divide_2',
	'type' => 'divide',
) );



/**

	Woocommerce ++++++++++++++++++++++++++++++++

**/
Redux::setSection( $opt_name, array(
	'title'			=> __('Woocommerce', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> 'el-icon-shopping-cart',
	'fields'		=> array(
			array(
				'id'		=> 'woo_number_products',
				'type'		=> 'text',
				'title'		=> __('Number of products per page', 'curated'),
				'subtitle'	=> __('Enter number of products', 'curated'),
				'default'	=> '8',
			),
		)
) );



/**

	BBPress ++++++++++++++++++++++++++++++++

**/
Redux::setSection( $opt_name, array(
	'title'			=> __('BBPress', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> 'el-icon-group',
	'fields'		=> array(
			array(
				'id'		=> 'bbpress_sidebar_on',
				'type'		=> 'switch',
				'title'		=> __('BBPress Sidebar', 'curated'),
				'subtitle'	=> __('BBPress sidebar', 'curated'),
				'default'	=> false,
			),
			array(
				'id'		=> 'bbpress_sidebar_select',
				'type'		=> 'select',
				'title'		=> __('Select BBPress Sidebar', 'curated'),
				'subtitle'	=> __('Select sidebar for BBPress', 'curated'),
				'data'		=> 'sidebar',
				'default'	=> '0-curated-sidebar'
			),
		)
) );



/**

	BuddyPress ++++++++++++++++++++++++++++++++

**/
Redux::setSection( $opt_name, array(
	'title'			=> __('BuddyPress', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> 'el-icon-group-alt',
	'fields'		=> array(
			array(
				'id'		=> 'buddypress_sidebar_on',
				'type'		=> 'switch',
				'title'		=> __('BuddyPress Sidebar', 'curated'),
				'subtitle'	=> __('BuddyPress Sidebar', 'curated'),
				'default'	=> false,
			),
			array(
				'id'		=> 'buddypress_sidebar_select',
				'type'		=> 'select',
				'title'		=> __('Select BuddyPress Sidebar', 'curated'),
				'subtitle'	=> __('Select Sidebar for BuddyPress', 'curated'),
				'data'		=> 'sidebar',
				'default'	=> '0-curated-sidebar'
			),
		),
) );



/**

	----------------------------------------------

**/
Redux::setSection( $opt_name, array(
	'id' => 'divide_3',
	'type' => 'divide',
) );



/**

Editable Text ++++++++++++++++++++++++++++++++

**/
Redux::setSection( $opt_name, array(
	'title'			=> __('Editable Text', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> 'el-icon-pencil',
	'fields'		=> array(
			/**
				SECTION START - SINGLE POST
			**/
			array(
				'id'		=> 'section-editsingle-start',
				'type'		=> 'section',
				'title'		=> __('Single Post', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 's_editor_review',
				'type'		=> 'text',
				'title'		=> __('Editor Review', 'curated'),
				'subtitle'	=> __('Change this text', 'curated'),
				'default'	=> 'Editor\'s Review',
			),
			array(
				'id'		=> 's_related',
				'type'		=> 'text',
				'title'		=> __('Related Articles', 'curated'),
				'subtitle'	=> __('Change this text', 'curated'),
				'default'	=> 'Related Articles',
			),
			array(
				'id'		=> 's_next_article',
				'type'		=> 'text',
				'title'		=> __('Next Article', 'curated'),
				'subtitle'	=> __('Change this text', 'curated'),
				'default'	=> 'Next Article',
			),
			array(
				'id'		=> 's_prev_article',
				'type'		=> 'text',
				'title'		=> __('Previous Article', 'curated'),
				'subtitle'	=> __('Change this text', 'curated'),
				'default'	=> 'Previous Article',
			),
			array(
				'id'		=> 's_about_author',
				'type'		=> 'text',
				'title'		=> __('About Auhtor', 'curated'),
				'subtitle'	=> __('Change this text', 'curated'),
				'default'	=> 'Author',
			),
			array(
				'id'		=> 's_leave_reply',
				'type'		=> 'text',
				'title'		=> __('Leave A Reply', 'curated'),
				'subtitle'	=> __('Change this text', 'curated'),
				'default'	=> 'Leave A Reply',
			),
			array(
				'id'		=> 's_cancel_reply',
				'type'		=> 'text',
				'title'		=> __('Cancel Reply', 'curated'),
				'subtitle'	=> __('Change this text', 'curated'),
				'default'	=> 'Cancel Reply',
			),
			array(
				'id'		=> 's_submit_reply',
				'type'		=> 'text',
				'title'		=> __('Post Comment', 'curated'),
				'subtitle'	=> __('Change this text', 'curated'),
				'default'	=> 'Post Comment',
			),
			array(
				'id'		=> 'section-editsingle-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
				SECTION END - SINGLE POST
			**/
		),
) );



/**

	Sidebar ++++++++++++++++++++++++++++++++

**/
Redux::setSection( $opt_name, array(
	'title'			=> __('Sidebar', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> 'el-icon-th-list',
	'fields'		=> array(
			array(
				'id'		=> 'theme_sidebar',
				'type'		=> 'multi_text',
				'title'		=> __('Theme Sidebars', 'curated'),
				'subtitle'	=> __('Click \'Add More\' to create new sidebar, click \'Remove\' to delete the sidebar', 'curated'),
				'desc'		=> __('Enter new Sidebar Name or edit the Sidebar Name', 'curated'),
				'default'	=> array(
					'0'			=> 'Curated Sidebar',
				),
			),
		)
) );



/**

	Additional ++++++++++++++++++++++++++++++++

**/
Redux::setSection( $opt_name, array(
	'title'			=> __('Additional', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> 'el-icon-cogs',
	'fields'		=> array(
			array(
				'id'		=> 'custom_css',
				'type'		=> 'ace_editor',
				'title'		=> __('Custom CSS', 'curated'),
				'subtitle'	=> __('Paste your custom CSS code', 'curated'),
				'mode'		=> 'css',
				'theme'		=> 'chrome',
				'desc'		=> __('Don\'t use < style > tag , just put the CSS code.', 'curated'),
				'default'	=> ''
			),
			array(
				'id'		=> 'custom_js',
				'type'		=> 'ace_editor',
				'title'		=> __('Tracking Code / Additional JS Code', 'curated'),
				'subtitle'	=> __('Paste your Google Analytics (or other) tracking code here or another additonal Javascript code.', 'curated'),
				'mode'		=> 'html',
				'theme'		=> 'chrome',
				'desc'		=> __('Please use < script > tag before write the javascript code.', 'curated'),
				'default'	=> '',
			),
		)
) );





/**

	----------------------------------------------

**/
Redux::setSection( $opt_name, array(
	'id' => 'divide_4',
	'type' => 'divide',
) );





/**

	Styling Settings ++++++++++++++++++++++++++++++++

**/
Redux::setSection( $opt_name, array(
	'title'			=> __('Styling', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'icon'			=> 'el el-magic',
	'fields'		=> array(

			array(
				'id'		=> 'section-general-start',
				'type'		=> 'section',
				'indent'	=> true
			),



			array(
				'id'		=> 'body_background',
				'type'		=> 'background',
				'title'		=> __('Body Background', 'curated'),
				'subtitle'	=> __('Body background with image, color, etc.', 'curated'),
				'default'	=> array( 'background-color' => '#212121' )
			),


			array(
				'id'		=> 'font_1',
				'type'		=> 'typography',
				'title'		=> __('Heading Font', 'curated'),
				'subtitle'	=> __('Select the Heading font type.', 'curated'),
				'google'	=> $opt_fonts,
				'color'		=> false,
				'font-size' => false,
				'line-height' => false,
				'text-align'=> false,
				'font_family_clear' => false,
				'default' 	=> array(
					'font-family' => 'Poppins',
					'font-weight' => 600,
					'subsets'	=> 'latin',
				),
			),
			array(
				'id'		=> 'font_2',
				'type'		=> 'typography',
				'title'		=> __('Content Font', 'curated'),
				'subtitle'	=> __('Select the Content font type.', 'curated'),
				'google'	=> $opt_fonts,
				'color'		=> false,
				'line-height' => false,
				'text-align'=> false,
				'font_family_clear' => false,
				'default'	=> array(
					'font-size'	=> '15px',
					'font-family' => 'Roboto',
					'font-weight' => 400,
					'subsets'	=> 'latin',
				),
			),

			array(
				'id'		=> 'accent_1',
				'type'		=> 'color',
				'title'		=> __('Primary Color', 'curated'),
				'subtitle'	=> __('Pick a Global primary color, it\'s for: text #hover, url, button.', 'curated'),
				'default'	=> '#31bb89',
				'transparent' => false,
				'validate'	=> 'color',
			),
			array(
				'id'		=> 'accent_2',
				'type'		=> 'color',
				'title'		=> __('Secondary Color', 'curated'),
				'subtitle'	=> __('Pick a Global secondary color, it\'s for: text #hover, url, button.', 'curated'),
				'default'	=> '#e55234',
				'transparent' => false,
				'validate'	=> 'color',
			),


			array(
				'id'		=> 'section-general-end',
				'type'		=> 'section',
				'indent'	=> false
			),


		)
) );


Redux::setSection( $opt_name, array(
	'title'			=> __('Header', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'subsection' => true,
	'icon'			=> '',
	'fields'		=> array(



			array(
				'id'		=> 'section-topnav-start',
				'type'		=> 'section',
				'title'		=> __('Top Navigation - Header', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 'th_bg_color',
				'type'		=> 'color',
				'title'		=> __('Background color', 'curated'),
				'subtitle'	=> __('Pick a color for top navigation background color.', 'curated'),
				'transparent' => false,
				'validate'	=> 'color',
				'default'	=> '#212121',
			),
			array(
				'id'		=> 'th_txt_color',
				'type'		=> 'link_color',
				'title'		=> __('Text Color', 'curated'),
				'subtitle'	=> __('Pick a color for top navigation text.', 'curated'),
				'visited'	=> false,
				'active'	=> false,
				'validate'	=> 'color',
				'default'	=> array(
						'regular'	=> '#eaeaea',
						'hover'		=> '#31bb89'
					)
			),


			// array(
			// 	'id'		=> 'th_bg_mob_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Mobile Background #active color', 'curated'),
			// 	'subtitle'	=> __('Pick a background color for Mobile active menu.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#181818',
			// ),
			array(
				'id'		=> 'section-topnav-end',
				'type'		=> 'section',
				'indent'	=> false
			),


			/**
			SECTION START - MAIN NAVIGATION
			**/
			array(
				'id'		=> 'section-mainnav-style-start',
				'type'		=> 'section',
				'title'		=> __('Main Menu - Header', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 'header_alignment',
				'type'		=> 'select',
				'title'		=> __('Header Alignment', 'curated'),
				'subtitle'	=> __('Please select header alignment', 'curated'),
				'options'	=> array(
					'normal'	=> 'Normal',
					'center'	=> 'Center'
				),
				'default'	=> 'normal'
			),
			array(
				'id'		=> 'font_3',
				'type'		=> 'typography',
				'title'		=> __('Navigation Typography', 'curated'),
				'subtitle'	=> __('Select the Navigation Typography.', 'curated'),
				'google'	=> $opt_fonts,
				'color'		=> false,
				'font-size'	=> false,
				'text-align' => false,
				'line-height' => false,
				'font-backup' => false,
				'default'	=> array(
					'font-family'	=> 'Poppins',
					'font-weight'	=> 600,
					'subsets'		=> 'latin',
				),
			),
			// array(
			// 	'id'		=> 'mh_txt_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Primary Menu Text color', 'curated'),
			// 	'subtitle'	=> __('Pick a color for Primary Menu text color.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#333333',
			// ),
			// array(
			// 	'id'		=> 'mh_txt_hvr_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Primary Menu Text Hover color', 'curated'),
			// 	'subtitle'	=> __('Pick a color for Primary Menu text hover color.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#333333',
			// ),

			array(
				'id'		=> 'mh_txt_color',
				'type'		=> 'link_color',
				'title'		=> __('Primary Text Color', 'curated'),
				'subtitle'	=> __('Pick a color for primary menu text color.', 'curated'),
				'visited'	=> false,
				'active'	=> false,
				'validate'	=> 'color',
				'default'	=> array(
						'regular'	=> '#333333',
						'hover'		=> '#31bb89'
					)
			),

			// array(
			// 	'id'		=> 'mh_sub_bg_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Sub Menu Background Color', 'curated'),
			// 	'subtitle'	=> __('Pick a background color for Sub menus.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#ffffff',
			// ),
			// array(
			// 	'id'		=> 'mh_sub_bg_hvr_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Sub Menu Background Hover Color', 'curated'),
			// 	'subtitle'	=> __('Pick a background hover color for Sub menus.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#ffffff',
			// ),

			array(
				'id'		=> 'mh_sub_txt_color',
				'type'		=> 'color',
				'title'		=> __('Submenu Text Color', 'curated'),
				'subtitle'	=> __('Pick a color for Submenu text color.', 'curated'),
				'transparent' => false,
				'validate'	=> 'color',
				'default'	=> '#333333',
			),
			array(
				'id'		=> 'mh_sub_bg_color',
				'type'		=> 'link_color',
				'title'		=> __('Submenu Background Color', 'curated'),
				'subtitle'	=> __('Pick a color for submenu background color.', 'curated'),
				'visited'	=> false,
				'active'	=> false,
				'validate'	=> 'color',
				'default'	=> array(
						'regular'	=> '#ffffff',
						'hover'		=> '#ebebeb'
					)
			),



			// array(
			// 	'id'		=> 'mh_sub_txt_hover_color',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Sub Menu Hover Text Color', 'curated'),
			// 	'subtitle'	=> __('Pick a color for Sub menus #hover text color.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#333333',
			// ),
			array(
				'id'		=> 'mh_search_background_color',
				'type'		=> 'color',
				'title'		=> __('Search Background Color', 'curated'),
				'subtitle'	=> __('Pick a color for Search background color.', 'curated'),
				'transparent' => false,
				'validate'	=> 'color',
				'default'	=> '#f6f6f6',
			),
			array(
				'id'		=> 'mh_search_text_color',
				'type'		=> 'color',
				'title'		=> __('Search Text Color', 'curated'),
				'subtitle'	=> __('Pick a color for Search text color.', 'curated'),
				'transparent' => false,
				'validate'	=> 'color',
				'default'	=> '#bebebe',
			),
			array(
				'id'		=> 'section-mainnav-style-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
			SECTION END - MAIN NAVIGATION
			**/



			/**
			SECTION START - CONTENT PRIMARY COLOR
			**/
			array(
				'id'		=> 'section-content_primary-start',
				'type'		=> 'section',
				'title'		=> __('Content Primary Color', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 'co_txt_color_1',
				'type'		=> 'color',
				'title'		=> __('Content Heading Color', 'curated'),
				'subtitle'	=> __('Pick a Heading color, it\'s for: Title, Metas, Name.', 'curated'),
				'transparent' => false,
				'validate'	=> 'color',
				'default'	=> '#333333',
			),
			array(
				'id'		=> 'co_txt_color_2',
				'type'		=> 'color',
				'title'		=> __('Content Text Color', 'curated'),
				'subtitle'	=> __('Pick a Content text color, it\'s for: text content.', 'curated'),
				'transparent' => false,
				'validate'	=> 'color',
				'default'	=> '#595858',
			),
			// array(
			// 	'id'		=> 'co_txt_color_meta',
			// 	'type'		=> 'color',
			// 	'title'		=> __('Content Meta Color', 'curated'),
			// 	'subtitle'	=> __('Pick a meta color, it\'s for: meta text color.', 'curated'),
			// 	'transparent' => false,
			// 	'validate'	=> 'color',
			// 	'default'	=> '#9a9a9a',
			// ),
			array(
				'id'		=> 'co_cat_bg_text',
				'type'		=> 'color',
				'title'		=> __('Category Background Text', 'curated'),
				'subtitle'	=> __('Pick a color for category background text.', 'curated'),
				'transparent' => false,
				'validate'	=> 'color',
				'default'	=> '#eaeaea',
			),
			array(
				'id'		=> 'section-content_primary-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
			SECTION END - CONTENT PRIMARY COLOR
			**/





		)
) );


// Redux::setSection( $opt_name, array(
// 	'title'			=> __('Content', 'curated'),
// 	// 'id'			=> 'basic-checkbox',
// 	'subsection' => true,
// 	'icon'			=> '',
// 	'fields'		=> array(

// 			/**
// 			SECTION START - CONTENT PRIMARY COLOR
// 			**/
// 			array(
// 				'id'		=> 'section-content_primary-start',
// 				'type'		=> 'section',
// 				'title'		=> __('Content Style', 'curated'),
// 				'indent'	=> true
// 			),
// 			array(
// 				'id'		=> 'color_scheme',
// 				'type'		=> 'switch',
// 				'title'		=> __('Color Scheme', 'curated'),
// 				'subtitle'	=> __('Choose your color scheme.', 'curated'),
// 				'on'		=> 'Light',
// 				'off'		=> 'Dark',
// 				'default'	=> true,
// 			),

// 			array(
// 				'id'		=> 'co_txt_color_1',
// 				'type'		=> 'color',
// 				'title'		=> __('Content Heading Color', 'curated'),
// 				'subtitle'	=> __('Pick a Heading color, it\'s for: Title, Metas, Name.', 'curated'),
// 				'transparent' => false,
// 				'validate'	=> 'color',
// 				'default'	=> '#333333',
// 			),
// 			array(
// 				'id'		=> 'co_txt_color_2',
// 				'type'		=> 'color',
// 				'title'		=> __('Content Text Color', 'curated'),
// 				'subtitle'	=> __('Pick a Content text color, it\'s for: text content.', 'curated'),
// 				'transparent' => false,
// 				'validate'	=> 'color',
// 				'default'	=> '#595858',
// 			),
// 			array(
// 				'id'		=> 'co_txt_color_meta',
// 				'type'		=> 'color',
// 				'title'		=> __('Content Meta Color', 'curated'),
// 				'subtitle'	=> __('Pick a meta color, it\'s for: meta text color.', 'curated'),
// 				'transparent' => false,
// 				'validate'	=> 'color',
// 				'default'	=> '#9a9a9a',
// 			),
// 			array(
// 				'id'		=> 'co_cat_bg_text',
// 				'type'		=> 'color',
// 				'title'		=> __('Category Background Text', 'curated'),
// 				'subtitle'	=> __('Pick a color for category background text.', 'curated'),
// 				'transparent' => false,
// 				'validate'	=> 'color',
// 				'default'	=> '#eaeaea',
// 			),

// 			array(
// 				'id'		=> 'section-content_primary-end',
// 				'type'		=> 'section',
// 				'indent'	=> false
// 			),
// 			/**
// 			SECTION END - CONTENT PRIMARY COLOR
// 			**/


// 			/**
// 			SECTION START - ELEMENTS COLOR
// 			**/

// 			array(
// 				'id'		=> 'section-elcolor-start',
// 				'type'		=> 'section',
// 				'title'		=> __('Elements Color', 'curated'),
// 				'indent'	=> true
// 			),
// 			array(
// 				'id'		=> 'coe_button_bg_color',
// 				'type'		=> 'color',
// 				'title'		=> __('Button Background Color', 'curated'),
// 				'subtitle'	=> __('Pick a button background color.', 'curated'),
// 				'transparent' => false,
// 				'validate'	=> 'color',
// 				'default'	=> '#000000',
// 			),
// 			array(
// 				'id'		=> 'coe_button_text_color',
// 				'type'		=> 'color',
// 				'title'		=> __('Button Text Color', 'curated'),
// 				'subtitle'	=> __('Pick a button text color.', 'curated'),
// 				'transparent' => false,
// 				'validate'	=> 'color',
// 				'default'	=> '#ffffff',
// 			),
// 			array(
// 				'id'		=> 'section-elcolor-end',
// 				'type'		=> 'section',
// 				'indent'	=> false
// 			),

// 			/**
// 			SECTION END - ELEMENTS COLOR
// 			**/
// 		)
// ) );


Redux::setSection( $opt_name, array(
	'title'			=> __('Footer', 'curated'),
	// 'id'			=> 'basic-checkbox',
	'subsection' => true,
	'icon'			=> '',
	'fields'		=> array(

			/**
				SECTION START - FOOTER WIDGET
			**/
			array(
				'id'		=> 'section-footer_widget-start',
				'type'		=> 'section',
				'title'		=> __('Footer Widgets Area Options', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 'fwa_bg_color',
				'type'		=> 'color',
				'title'		=> __('Widgets Area Background Color', 'curated'),
				'subtitle'	=> __('Pick a background color for the footer widgets area.', 'curated'),
				'transparent' => false,
				'validate'	=> 'color',
				'default'	=> '#151515',
			),
			array(
				'id'		=> 'fwa_txt_color_1',
				'type'		=> 'color',
				'title'		=> __('Widgets Heading Color', 'curated'),
				'subtitle'	=> __('Pick a footer heading color for the footer widgets area.', 'curated'),
				'transparent'	=> false,
				'validate'	=> 'color',
				'default'	=> '#dcdcdc',
			),
			array(
				'id'		=> 'fwa_txt_color_2',
				'type'		=> 'color',
				'title'		=> __('Widgets content Color', 'curated'),
				'subtitle'	=> __('Pick a footer content color for the footer widgets area.', 'curated'),
				'transparent' => false,
				'validate'	=> 'color',
				'default'	=> '#8b8b8b',
			),
			array(
				'id'		=> 'section-footer_widget-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
			SECTION END - FOOTER WIDGET
			**/


			/**
			SECTION START - FOOTER COPYRIGHT & MENU
			**/
			array(
				'id'		=> 'section-copyright-style-start',
				'type'		=> 'section',
				'title'		=> __('Footer Copyright & Menus', 'curated'),
				'indent'	=> true
			),
			array(
				'id'		=> 'fc_bg_color',
				'type'		=> 'color',
				'title'		=> __('Footer Copyright Background', 'curated'),
				'subtitle'	=> __('Pick a background color for Footer copyright background.', 'curated'),
				'transparent' => false,
				'validate'	=> 'color',
				'default'	=> '#000000',
			),
			array(
				'id'		=> 'fc_txt_color_1',
				'type'		=> 'color',
				'title'		=> __('Text Color', 'curated'),
				'subtitle'	=> __('Pick a footer text color for the footer copyright area.', 'curated'),
				'transparent' => false,
				'validate'	=> 'color',
				'default'	=> '#a1a1a1',
			),
			array(
				'id'		=> 'section-copyright-style-end',
				'type'		=> 'section',
				'indent'	=> false
			),
			/**
			SECTION END - FOOTER COPYRIGHT & MENU
			**/


		)
) );








	if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
		$section = array(
			'icon'   => 'el el-list-alt',
			'title'  => __( 'Documentation', 'curated' ),
			'fields' => array(
				array(
					'id'       => '17',
					'type'     => 'raw',
					'markdown' => true,
					'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
					//'content' => 'Raw content here',
				),
			),
		);
		Redux::setSection( $opt_name, $section );
	}
	/*
	 * <--- END SECTIONS
	 */


	/*
	 *
	 * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
	 *
	 */

	/*
	*
	* --> Action hook examples
	*
	*/

	// If Redux is running as a plugin, this will remove the demo notice and links
	//add_action( 'redux/loaded', 'remove_demo' );

	// Function to test the compiler hook and demo CSS output.
	// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
	//add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

	// Change the arguments after they've been declared, but before the panel is created
	//add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

	// Change the default value of a field after it's been set, but before it's been useds
	//add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

	// Dynamically add a section. Can be also used to modify sections/fields
	//add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

	/**
	 * This is a test function that will let you see when the compiler hook occurs.
	 * It only runs if a field    set with compiler=>true is changed.
	 * */
	if ( ! function_exists( 'compiler_action' ) ) {
		function compiler_action( $options, $css, $changed_values ) {
			echo '<h1>The compiler hook has run!</h1>';
			echo "<pre>";
			print_r( $changed_values ); // Values that have changed since the last save
			echo "</pre>";
			//print_r($options); //Option values
			//print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
		}
	}

	/**
	 * Custom function for the callback validation referenced above
	 * */
	if ( ! function_exists( 'redux_validate_callback_function' ) ) {
		function redux_validate_callback_function( $field, $value, $existing_value ) {
			$error   = false;
			$warning = false;

			//do your validation
			if ( $value == 1 ) {
				$error = true;
				$value = $existing_value;
			} elseif ( $value == 2 ) {
				$warning = true;
				$value   = $existing_value;
			}

			$return['value'] = $value;

			if ( $error == true ) {
				$return['error'] = $field;
				$field['msg']    = 'your custom error message';
			}

			if ( $warning == true ) {
				$return['warning'] = $field;
				$field['msg']      = 'your custom warning message';
			}

			return $return;
		}
	}

	/**
	 * Custom function for the callback referenced above
	 */
	if ( ! function_exists( 'redux_my_custom_field' ) ) {
		function redux_my_custom_field( $field, $value ) {
			print_r( $field );
			echo '<br/>';
			print_r( $value );
		}
	}

	/**
	 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
	 * Simply include this function in the child themes functions.php file.
	 * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
	 * so you must use get_template_directory_uri() if you want to use any of the built in icons
	 * */
	if ( ! function_exists( 'dynamic_section' ) ) {
		function dynamic_section( $sections ) {
			//$sections = array();
			$sections[] = array(
				'title'  => __( 'Section via hook', 'curated' ),
				'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'curated' ),
				'icon'   => 'el el-paper-clip',
				// Leave this as a blank section, no options just some intro text set above.
				'fields' => array()
			);

			return $sections;
		}
	}

	/**
	 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
	 * */
	if ( ! function_exists( 'change_arguments' ) ) {
		function change_arguments( $args ) {
			//$args['dev_mode'] = true;

			return $args;
		}
	}

	/**
	 * Filter hook for filtering the default value of any given field. Very useful in development mode.
	 * */
	if ( ! function_exists( 'change_defaults' ) ) {
		function change_defaults( $defaults ) {
			$defaults['str_replace'] = 'Testing filter hook!';

			return $defaults;
		}
	}

	/**
	 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
	 */
	if ( ! function_exists( 'remove_demo' ) ) {
		function remove_demo() {
			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
				remove_filter( 'plugin_row_meta', array(
					ReduxFrameworkPlugin::instance(),
					'plugin_metalinks'
				), null, 2 );

				// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
				remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
			}
		}
	}
