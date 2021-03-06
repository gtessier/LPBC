<?php
/*if (! function_exists("wt_home_page_process")) {
	function wt_home_page_process($option,$value) {
		update_option( 'page_on_front', $value );
		if(!empty($value)){
			update_option( 'show_on_front', 'page' );
		}else{
			if(!get_option('page_for_posts')){
				update_option( 'show_on_front', 'posts' );
			}
		}
		return $value;
	}
}*/
$wt_options = array(
	array(
		"class" => "nav-tab-wrapper",
		"default" => '',
		"options" => array(
			"general_settings" => esc_html__('General','wt_admin'),
			"homepage_settings" => esc_html__('Homepage','wt_admin'),
			"custom_favicons" => esc_html__('Custom Favicons','wt_admin'),
			"google_analytics" => esc_html__('Google Analytics','wt_admin'),
			"custom_stylesheet" => esc_html__('Custom Css','wt_admin'),
		),
		"type" => "wt_navigation",
	),	
	array(
		"type" => "wt_group_start",
		"group_id" => "general_settings",
	),
		array(
			"name" => esc_html__("General Settings",'wt_admin'),
			"type" => "wt_open"
		),		
		array(
			"name" => esc_html__("Enable Responsive",'wt_admin'),
			"desc" => sprintf( esc_html__('Set ON to enable responsive mode.','wt_admin')),
			"id" => "enable_responsive",
			"default" => true,
			"type" => "wt_toggle"
		),	
		array(
			"name" => esc_html__("Custom Logo",'wt_admin'),
			"desc" => esc_html__( "Enter the full URL of your logo image: e.g http://www.site.com/logo.png",'wt_admin'),
			"id" => "logo",
			"default" =>  "http://whoathemes.com/files/pics/logos/simple.png",
			"type" => "wt_upload",
			"crop" => "false"
		),
		array(
			"name" => esc_html__("Custom Logo High-DPI (retina) ",'wt_admin'),
			"desc" => esc_html__( "Enter the full URL of your logo image: e.g http://www.site.com/logo@2x.png",'wt_admin'),
			"id" => "logo_retina",
			"default" =>  "http://whoathemes.com/files/pics/logos/simple-alt.png",
			"type" => "wt_upload",
			"crop" => "false"
		),
		array(
			"name" => esc_html__("Display Text Logo",'wt_admin'),
			"desc" => sprintf( esc_html__('Set ON if you want to use plain logo','wt_admin')),
			"id" => "display_logo",
			"default" => false,
			"type" => "wt_toggle"
		),
		array(
			"name" => esc_html__("Enter Plain Text Logo",'wt_admin'),
			"desc" => sprintf( esc_html__('Please insert a text here to use a plain text logo rather than an image.','wt_admin')),
			"id" => "plain_logo",
			"default" => 'Simple',
			"type" => "wt_text"
		),
		array(
			"name" => esc_html__("Display Site Description",'wt_admin'),
			"desc" => sprintf( esc_html__('This enables site description, only if you disable custom logo.','wt_admin'),get_option('siteurl')),
			"id" => "display_site_desc",
			"default" => true,
			"type" => "wt_toggle"
		),
		array(
			"name" => esc_html__("Color Schemes",'wt_admin'),
			"desc" => esc_html__("Select which color schemes type to use.",'wt_admin'),
			"id" => "skin",
			"default" => 'default',
			"options" => array(
				"default" => esc_html__('Default','wt_admin'),
				"amethyst" => esc_html__('Amethyst','wt_admin'),
				"bluesky" => esc_html__('Blue Sky','wt_admin'),
				"carrot" => esc_html__('Carrot','wt_admin'),
				"green" => esc_html__('Green','wt_admin'),
				"orange" => esc_html__('Orange','wt_admin'),
				"pink" => esc_html__('Pink','wt_admin'),
				"red" => esc_html__('Red','wt_admin'),
				"turquoise" => esc_html__('Turquoise','wt_admin'),
				"yellow" => esc_html__('Yellow','wt_admin'),
			),
			"chosen" => "true",
			"type" => "wt_select",
		),
		array(
			"name" => esc_html__("Custom Skin",'wt_admin'),
			"desc" => esc_html__("Create your own skin. This option creates skins which affects only colors, background colors and border colors. Unfortunatelly for images/background images doesn't work. So you need to edit the images with your own color skin and paste them in 'img' folder from theme root with the same names as the older ones. You can keep the older ones under different names.") . "<br><code>" . esc_html__("Please use the HEX format here. Ex: \"#000000\"") . "</code>", esc_html__('wt_admin'),
			"id" => "custom_skin",
			"default" => "",
			"format" => "hex",
			"type" => "wt_color"
		),
		/*array(
			"name" => esc_html__("Skin Type",'wt_admin'),
			"desc" => esc_html__("Select a skin type to use.",'wt_admin'),
			"id" => "skin_type",
			"light" => 'light',
			"options" => array(
				"light" => esc_html__('Light','wt_admin'),
				"dark" => esc_html__('Dark','wt_admin'),
			),
			"chosen" => "true",
			"type" => "wt_select",
		),
		/*
		array(
			"name" => esc_html__("Menu Position",'wt_admin'),
			"desc"=> esc_html__('Which side would you like your navigation? ','wt_admin'),
			"id" => "menu_position",
			"options" => array( "top" => "Top", "side" => "Side"),
			"default" => "top",
			"type" => "wt_radio"
		),
		*/		
		array(
			"name" => esc_html__("Disable Breadcrumbs",'wt_admin'),
			"desc" => esc_html__("This option disables your website's breadcrumb navigation.",'wt_admin'),
			"id" => "disable_breadcrumb",
			"default" => 0,
			"type" => "wt_toggle"
		),		
		array(
			"name" => esc_html__("Sticky Header",'wt_admin'),
			"desc" => esc_html__("This option enables the sticky header when scrolling down.",'wt_admin'),
			"id" => "sticky_header",
			"default" => true,
			"type" => "wt_toggle"
		),			
		array(
			"name" => esc_html__("Disable Sticky Header On Smaller Screens",'wt_admin'),
			"desc" => esc_html__("This option disables sticky header on smaller screens.",'wt_admin'),
			"id" => "no_sticky_on_ss",
			"default" => false,
			"type" => "wt_toggle"
		),
		array(
			"name" => esc_html__("Show Responsive Navigation under:",'wt_admin'),
			"desc" => "Here you can set when (which window size) the responsive navigation should be displayed.",
			"id" => "responsive_nav",
			"default" => '767',
			"options" => array(
				"991" => esc_html__('< 991 px','wt_admin'),
				"767" => esc_html__('< 767 px','wt_admin'),
				//"480" => esc_html__('< 480 px','wt_admin'),
			),
			"type" => "wt_select",
		),	
		array(
			"name" => esc_html__("Nice Scrolling",'wt_admin'),
			"desc" => sprintf( esc_html__('Set ON to enable a better and nice scroll on desktop and mobile device.', 'wt_admin' )),
			"id" => "nice_scroll",
			"default" => false,
			"type" => "wt_toggle"
		),	
		array(
			"name" => esc_html__("Smooth Scrolling",'wt_admin'),
			"desc" => sprintf( esc_html__('Set ON to enable smooth scroll (a Google Chrome extension for smooth scrolling with the mouse wheel and keyboard buttons). This disables the above Nice Scroll option.', 'wt_admin' )),
			"id" => "smooth_scroll",
			"default" => false,
			"type" => "wt_toggle"
		),		
		array(
			"name" => esc_html__("Page Loader Animation",'wt_admin'),
			"desc" => esc_html__("This option enables the page loader animation.",'wt_admin'),
			"id" => "page_loader",
			"default" => false,
			"type" => "wt_toggle"
		),
		array(
			"name" => esc_html__("Scroll to Top",'wt_admin'),
			"desc" => esc_html__("This option enables a scroll to top button at the right bottom corner of site pages.",'wt_admin'),
			"id" => "scroll_to_top",
			"default" => false,
			"type" => "wt_toggle"
		),
		array(
			"name" => esc_html__("WooCommerce",'wt_admin'),
			"desc"=> esc_html__('Set ON if you want to use woocommerce.','wt_admin'),
			"id" => "woocommerce",
			"default" => false,
			"type" => "wt_toggle"
		),
		array(
			"name" => esc_html__("Shop page layout",'wt_admin'),
			"desc" => esc_html__("Select which layout do you want for your Shop page.",'wt_admin'),
			"id" => "woo_layout",
			"default" => 'right',
			"options" => array(
				"full" => esc_html__('Full Layout','wt_admin'),
				"right" => esc_html__('Right Sidebar','wt_admin'),
				"left" => esc_html__('Left Sidebar','wt_admin'),
			),
			"chosen" => "true",
			"type" => "wt_select",
		),
		array(
			"name" => esc_html__("Enable Animations",'wt_admin'),
			"desc" => esc_html__("This option enables site animations.",'wt_admin'),
			"id" => "enable_animation",
			"default" => false,
			"type" => "wt_toggle"
		),

		array(
			"name" => esc_html__("High-DPI (retina) images",'wt_admin'),
			"desc" => esc_html__("This option allows you to use High-DPI (retina) images.",'wt_admin'),
			"id" => "enable_retina",
			"default" => false,
			"type" => "wt_toggle"
		),
		array(
			"type" => "wt_close"
		),	
		array(
			"type" => "wt_reset"
		),
	array(
		"type" => "wt_group_end",
	),	
	array(
		"type" => "wt_group_start",
		"group_id" => "homepage_settings",
	),	
		array(
			"name" => esc_html__("Homepage Settings",'wt_admin'),
			"type" => "wt_open"
		),
		array(
			"name" => esc_html__("Home Page",'wt_admin'),
			"desc" => esc_html__("The selected page here will be displayed in the homepage.",'wt_admin'),
			"id" => "home_page",
			"page" => 0,
			"default" => 0,
			"prompt" => esc_html__("None",'wt_admin'),
			"chosen" => "true",
			"type" => "wt_select",
			//"process" => "wt_home_page_process"
			),
		
		/*array(
			"name" => esc_html__("Home Section Overlay Type",'wt_admin'),
			"desc" => esc_html__("Select an overlay type to use into home section.",'wt_admin'),
			"id" => "overlay_type",
			"pattern" => 'Pattern',
			"options" => array(
				"none" => esc_html__('None','wt_admin'),
				"pattern" => esc_html__('Pattern','wt_admin'),
				"color" => esc_html__('Color','wt_admin'),
			),
			"chosen" => "true",
			"type" => "wt_select",
		),*/
		array(
			"type" => "wt_close"
		),
		array(
			"type" => "wt_reset"
		),
		/*array(
			"name" => esc_html__("Home Area Text",'wt_admin'),
			"type" => "wt_open",
		),	
		array(
			"name" => esc_html__("Home Text",'wt_admin'),
			"one_col" => "true",
			//"desc" => esc_html__("The text you enter here will display on the home section",'wt_admin'),
			"id" => "editor",
			"default" => "",
			"type" => "wt_editor",
		),
		array(
			"type" => "wt_close"
		),
		array(
			"type" => "wt_reset"
		),*/
	array(
		"type" => "wt_group_end",
	),	
	array(
		"type" => "wt_group_start",
		"group_id" => "custom_favicons",
	),	
		array(
			"name" => esc_html__("Favicons",'wt_admin'),
			"type" => "wt_open"
		),					
			array(	
				"name" => esc_html__("Favicon", 'wt_admin'),
				"desc" => esc_html__("Enter the full URL of your favicon e.g. http://www.site.com/favicon.ico", 'wt_admin'),
				"id" => "favicon",
				"default" => 'http://whoathemes.com/files/pics/favicons/crossway/favicon.ico',
				"type" => "wt_upload",
				"crop" => "false"
			),			
			array(	
				"name" => esc_html__("Apple Touch Icon 57x57", 'wt_admin'),
				"desc" => esc_html__("Enter the full URL of your favicon e.g. http://www.site.com/favicon_57.png", 'wt_admin'),
				"id" => "favicon_57",
				"default" => 'http://whoathemes.com/files/pics/favicons/crossway/favicon_57.png',
				"type" => "wt_upload",
				"crop" => "false"
			),		
			array(	
				"name" => esc_html__("Apple Touch Icon 72x72", 'wt_admin'),
				"desc" => esc_html__("Enter the full URL of your favicon e.g. http://www.site.com/favicon_72.png", 'wt_admin'),
				"id" => "favicon_72",
				"default" => 'http://whoathemes.com/files/pics/favicons/crossway/favicon_72.png',
				"type" => "wt_upload",
				"crop" => "false"
			),		
			array(	
				"name" => esc_html__("Apple Touch Icon 114x114", 'wt_admin'),
				"desc" => esc_html__("Enter the full URL of your favicon e.g. http://www.site.com/favicon_114.png", 'wt_admin'),
				"id" => "favicon_114",
				"default" => 'http://whoathemes.com/files/pics/favicons/crossway/favicon_114.png',
				"type" => "wt_upload",
				"crop" => "false"
			),	
			array(	
				"name" => esc_html__("Apple Touch Icon 144x144", 'wt_admin'),
				"desc" => esc_html__("Enter the full URL of your favicon e.g. http://www.site.com/favicon_144.png", 'wt_admin'),
				"id" => "favicon_144",
				"default" => 'http://whoathemes.com/files/pics/favicons/crossway/favicon_144.png',
				"type" => "wt_upload",
				"crop" => "false"
			),
		array(
			"type" => "wt_close"
		),
		array(
			"type" => "wt_reset"
		),
	array(
		"type" => "wt_group_end",
	),
	array(
		"type" => "wt_group_start",
		"group_id" => "google_analytics",
	),	
		array(
			"name" => esc_html__("Google Analytics",'wt_admin'),
			"type" => "wt_open"
		),			
			array(
				"name" => esc_html__("Google Analytics Code",'wt_admin'),
				"desc" => esc_html__("Paste your <a href='http://www.google.com/analytics/' target='_blank'>analytics code</a> here and it will be applied to each page.",'wt_admin'),
				"id" => "analytics",
				"default" => "",
				"elastic" => "true",
				"type" => "wt_textarea"
			),	
		array(
			"type" => "wt_close"
		),
		array(
			"type" => "wt_reset"
		),
	array(
		"type" => "wt_group_end",
	),	
	array(
		"type" => "wt_group_start",
		"group_id" => "custom_stylesheet",
	),	
		array(
			"name" => esc_html__("Custom Css",'wt_admin'),
			"type" => "wt_open"
		),			
			array(	
				"name" => esc_html__("Custom Css", 'wt_admin'),
				//"desc" => esc_html__("Custom Css", 'wt_admin'),
				"id" => "custom_css",
				"default" => "",
				"elastic" => "true",
				"type" => "wt_textarea"
			),
		array(
			"type" => "wt_close"
		),
		array(
			"type" => "wt_reset"
		),
	array(
		"type" => "wt_group_end",
	),	
);
return array(
	'auto' => true,
	'name' => 'general',
	'options' => $wt_options
);