<?php
/**
 * SETTINGS TAB
 **/
$ipanel_piemont_tabs[] = array(
	'name' => esc_html__('Main Settings', 'piemont'),
	'id' => 'main_settings'
);

$ipanel_piemont_option[] = array(
	"type" => "StartTab",
	"id" => "main_settings"
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Enable theme CSS3 animations", 'piemont'),
	"id" => "enable_theme_animations",
	"std" => true,
	"desc" => esc_html__("Enable colors and background colors fade effects", 'piemont'),
	"type" => "checkbox",
);

$ipanel_piemont_option[] = array(
	"type" => "EndTab"
);
/**
 * Header TAB
 **/
$ipanel_piemont_tabs[] = array(
	'name' => esc_html__('Header', 'piemont'),
	'id' => 'header_settings'
);

$ipanel_piemont_option[] = array(
	"type" => "StartTab",
	"id" => "header_settings"
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Header layout", 'piemont'),
	"type" => "StartSection",
	"field_options" => array(
		"show" => true // Set true to show items by default.
	)
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Disable Header", 'piemont'),
	"id" => "disable_header",
	"std" => false,
	"desc" => esc_html__("This option will disable ALL header (with menu below header, logo, etc). Useful for minimalistic themes with left/right sidebar used to show logo and menu.", 'piemont'),
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Header height in pixels", 'piemont'),
	"id" => "header_height",
	"std" => "200",
	"desc" => esc_html__("Default: 200", 'piemont'),
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Disable top menu", 'piemont'),
	"id" => "disable_top_menu",
	"std" => false,
	"desc" => esc_html__("This option will disable top menu (first menu with social icons, search and additional links)", 'piemont'),
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Top menu style", 'piemont'),
	"id" => "header_top_menu_style",
	"std" => "menu_white",
	"options" => array(
		"menu_white" => esc_html__("White menu", 'piemont'),
		"menu_black" => esc_html__("Black menu", 'piemont'),
	),
	"desc" => "",
	"type" => "select",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Disable search in top menu", 'piemont'),
	"id" => "disable_top_menu_search",
	"std" => false,
	"desc" => esc_html__("This option will disable search form in top menu", 'piemont'),
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
	"type" => "htmlpage",
	"name" => wp_kses_post(__('<div class="ipanel-label">
	    <label>Logo upload</label>
	  </div><div class="ipanel-input">
	    You can upload your website logo in <a href="customize.php" target="_blank">WordPress Customizer</a> (in "Header Image" section at the left sidebar).<br/><br/><br/>
	  </div>', 'piemont'))
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Logo width (px)", 'piemont'),
	"id" => "logo_width",
	"std" => "415",
	"desc" => esc_html__("Default: 415. Upload retina logo (2x size) and input your regular logo width here. For example if your retina logo have 400px width put 200 value here. If you does not use retina logo input regular logo width here (your logo image width).", 'piemont'),
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Sticky/Fixed top header (with menu, search, social icons)", 'piemont'),
	"id" => "enable_sticky_header",
	"std" => false,
	"desc" => esc_html__("Top Header will be fixed to top if enabled", 'piemont'),
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Enable right side offcanvas floating sidebar menu", 'piemont'),
	"id" => "enable_offcanvas_sidebar",
	"std" => false,
	"desc" => esc_html__("Sidebar can be opened by toggle button near header mini cart. You can add widgets to this sidebar in 'Offcanvas Right sidebar' in Appearance > Widgets", 'piemont'),
	"type" => "checkbox",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("MainMenu style", 'piemont'),
	"id" => "header_menu_style",
	"std" => "menu_light",
	"options" => array(
		"menu_light" => esc_html__("Light menu", 'piemont'),
		"menu_bordered" => esc_html__("Bordered menu", 'piemont'),
	),
	"desc" => "",
	"type" => "select",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("MainMenu font decoration", 'piemont'),
	"id" => "header_menu_font_decoration",
	"std" => "uppercase",
	"options" => array(
		"uppercase" => esc_html__("Uppercase letters", 'piemont'),
		"italic" => esc_html__("Italic letters", 'piemont'),
		"none" => esc_html__("None", 'piemont'),
	),
	"desc" => "",
	"type" => "select",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("MainMenu font size", 'piemont'),
	"id" => "header_menu_font_size",
	"std" => "normalfont",
	"options" => array(
		"largefont" => esc_html__("Large font", 'piemont'),
		"normalfont" => esc_html__("Normal font", 'piemont')
	),
	"desc" => "",
	"type" => "select",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("MainMenu dropdown arrows style for submenus", 'piemont'),
	"id" => "header_menu_arrow_style",
	"std" => "downarrow",
	"options" => array(
		"rightarrow" => esc_html__("Right arrow", 'piemont'),
		"downarrow" => esc_html__("Down arrow", 'piemont'),
		"noarrow" => esc_html__("Disable arrow", 'piemont')
	),
	"desc" => "",
	"type" => "select",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("MainMenu horizontal align", 'piemont'),
	"id" => "header_menu_align",
	"std" => "menu_center",
	"options" => array(
		"menu_left" => esc_html__("Left", 'piemont'),
		"menu_center" => esc_html__("Center", 'piemont'),
	),
	"desc" => esc_html__("This option will change menu align if MainMenu located below header", 'piemont'),
	"type" => "select",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Header Logo position", 'piemont'),
	"id" => "header_logo_position",
	"options" => array(
		'left' => array(
			"image" => IPANEL_URI . 'option-images/header_logo_position_1.png',
			"label" => esc_html__('Left', 'piemont')
		),
		'center' => array(
			"image" => IPANEL_URI . 'option-images/header_logo_position_2.png',
			"label" => esc_html__('Center', 'piemont')
		),
		'right' => array(
			"image" => IPANEL_URI . 'option-images/header_logo_position_3.png',
			"label" => esc_html__('Right', 'piemont')
		),
	),
	"std" => "center",
	"desc" => "",
	"type" => "image",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Header Banner position", 'piemont'),
	"id" => "header_banner_position",
	"options" => array(
		'left' => array(
			"image" => IPANEL_URI . 'option-images/header_banner_position_1.png',
			"label" => esc_html__('Left', 'piemont')
		),
		'right' => array(
			"image" => IPANEL_URI . 'option-images/header_banner_position_2.png',
			"label" => esc_html__('Right', 'piemont')
		),
		'disable' => array(
			"image" => IPANEL_URI . 'option-images/header_banner_position_3.png',
			"label" => esc_html__('Disable', 'piemont')
		)
	),
	"std" => "disable",
	"desc" => esc_html__("You can show banner image or some text in your header. Make sure that you use different positions for logo and your banner (for example logo at the left and banner at the right).", 'piemont'),
	"type" => "image",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Header Banner content", 'piemont'),
	"id" => "header_banner_editor",
	"std" => '',
	"desc" => esc_html__("If you selected Header banner position below you can use any HTML here to show your banner or other content in header.", 'piemont'),
	"field_options" => array(
		'media_buttons' => true
	),
	"type" => "wp_editor",
);
$ipanel_piemont_option[] = array(
		"type" => "EndSection"
);
$ipanel_piemont_option[] = array(

	"name" => esc_html__("Social icons", 'piemont'),
	"type" => "StartSection",
	"field_options" => array(
		"show" => true // Set true to show items by default.
	)
);
$ipanel_piemont_option[] = array(
	"type" => "info",
	"name" => esc_html__("Leave URL fields blank to hide this social icons", 'piemont'),
	"field_options" => array(
		"style" => 'alert'
	)
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Facebook Page url", 'piemont'),
	"id" => "facebook",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Vkontakte page url", 'piemont'),
	"id" => "vk",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Twitter Page url", 'piemont'),
	"id" => "twitter",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Google+ Page url", 'piemont'),
	"id" => "google-plus",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("LinkedIn Page url", 'piemont'),
	"id" => "linkedin",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Dribbble Page url", 'piemont'),
	"id" => "dribbble",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Behance Page url", 'piemont'),
	"id" => "behance",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Instagram Page url", 'piemont'),
	"id" => "instagram",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Tumblr page url", 'piemont'),
	"id" => "tumblr",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Pinterest page url", 'piemont'),
	"id" => "pinterest",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Vimeo page url", 'piemont'),
	"id" => "vimeo-square",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("YouTube page url", 'piemont'),
	"id" => "youtube",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Skype url", 'piemont'),
	"id" => "skype",
	"std" => "",
	"desc" => "",
	"type" => "text",
);
$ipanel_piemont_option[] = array(
		"type" => "EndSection"
);
$ipanel_piemont_option[] = array(
	"type" => "EndTab"
);
/**
 * FOOTER TAB
 **/
$ipanel_piemont_tabs[] = array(
	'name' => esc_html__('Footer', 'piemont'),
	'id' => 'footer_settings'
);
$ipanel_piemont_option[] = array(
	"type" => "StartTab",
	"id" => "footer_settings"
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Display Instagram feed in Footer", 'piemont'),
	"id" => "footer_instagram_display",
	"std" => false,
	"desc" => wp_kses_post(__("<a href='https://wordpress.org/plugins/instagram-feed/' target='_blank'>Instagram Feed</a> plugin must be installed and configured by theme documentation before enabling this option.", 'piemont')),
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Footer Instagram title", 'piemont'),
	"id" => "footer_instagram_title",
	"std" => "Follow us @ Instagram",
	"desc" => esc_html__("Leave empty if you don't want to show text title.", 'piemont'),
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Display Newsletter signup form above Footer", 'piemont'),
	"id" => "footer_signup_display",
	"std" => false,
	"desc" => wp_kses_post(__("<a href='https://wordpress.org/plugins/mailchimp-for-wp/' target='_blank'>https://wordpress.org/plugins/mailchimp-for-wp/screenshots/</a> plugin must be installed and configured by theme documentation before enabling this option.", 'piemont')),
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Footer style", 'piemont'),
	"id" => "footer_style",
	"std" => "mini",
	"options" => array(
		"mini" => esc_html__("Minimalistic", 'piemont'),
		"big" => esc_html__("Big with large links", 'piemont'),
	),
	"desc" => esc_html__("This option will change your footer style", 'piemont'),
	"type" => "select",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Upload Footer logo", 'piemont'),
	"id" => "footer_logo",
	"field_options" => array(
		"std" => get_template_directory_uri().'/img/footer_logo.png'
	),
	"desc" => esc_html__("Upload your site footer logo. Remove image if you dont want to show logo in footer.", 'piemont'),
	"type" => "qup",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Footer Logo width (px)", 'piemont'),
	"id" => "footer_logo_width",
	"std" => "102",
	"desc" => esc_html__("Default: 102. Upload retina logo (2x size) and input your regular logo width here. For example if your retina logo have 400px width put 200 value here. If you does not use retina logo input regular logo width here (your logo image width).", 'piemont'),
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Show big Scroll page to top button in footer", 'piemont'),
	"id" => "footer_top_button",
	"std" => false,
	"desc" => esc_html__("We recommend to use this option with Big Footer Style", 'piemont'),
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Show 'Footer light sidebar' only on homepage", 'piemont'),
	"id" => "footer_sidebar_1_homepage_only",
	"std" => true,
	"desc" => "",
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Footer copyright text", 'piemont'),
	"id" => "footer_copyright_editor",
	"std" => esc_html__("Powered by <a href='http://themeforest.net/user/dedalx/' target='_blank'>Piemont - Premium Wordpress Theme</a>", 'piemont'),
	"desc" => "",
	"field_options" => array(
		'media_buttons' => false
	),
	"type" => "wp_editor",
);

$ipanel_piemont_option[] = array(
	"type" => "EndTab"
);

/**
 * SIDEBARS TAB
 **/
$ipanel_piemont_tabs[] = array(
	'name' => esc_html__('Sidebars', 'piemont'),
	'id' => 'sidebar_settings'
);

$ipanel_piemont_option[] = array(
	"type" => "StartTab",
	"id" => "sidebar_settings"
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Blog page sidebar position", 'piemont'),
	"id" => "blog_sidebar_position",
	"options" => array(
		'left' => array(
			"image" => IPANEL_URI . 'option-images/sidebar_position_1.png',
			"label" => esc_html__('Left', 'piemont')
		),
		'right' => array(
			"image" => IPANEL_URI . 'option-images/sidebar_position_2.png',
			"label" => esc_html__('Right', 'piemont')
		),
		'disable' => array(
			"image" => IPANEL_URI . 'option-images/sidebar_position_3.png',
			"label" => esc_html__('Disable sidebar', 'piemont')
		),
	),
	"std" => "disable",
	"desc" => "",
	"type" => "image",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Pages sidebar position", 'piemont'),
	"id" => "page_sidebar_position",
	"options" => array(
		'left' => array(
			"image" => IPANEL_URI . 'option-images/sidebar_position_1.png',
			"label" => esc_html__('Left', 'piemont')
		),
		'right' => array(
			"image" => IPANEL_URI . 'option-images/sidebar_position_2.png',
			"label" => esc_html__('Right', 'piemont')
		),
		'disable' => array(
			"image" => IPANEL_URI . 'option-images/sidebar_position_3.png',
			"label" => esc_html__('Disable sidebar', 'piemont')
		),
	),
	"std" => "disable",
	"desc" => "",
	"type" => "image",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Blog Archive page sidebar position", 'piemont'),
	"id" => "archive_sidebar_position",
	"options" => array(
		'left' => array(
			"image" => IPANEL_URI . 'option-images/sidebar_position_1.png',
			"label" => esc_html__('Left', 'piemont')
		),
		'right' => array(
			"image" => IPANEL_URI . 'option-images/sidebar_position_2.png',
			"label" => esc_html__('Right', 'piemont')
		),
		'disable' => array(
			"image" => IPANEL_URI . 'option-images/sidebar_position_3.png',
			"label" => esc_html__('Disable sidebar', 'piemont')
		),
	),
	"std" => "right",
	"desc" => "",
	"type" => "image",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Blog Search page sidebar position", 'piemont'),
	"id" => "search_sidebar_position",
	"options" => array(
		'left' => array(
			"image" => IPANEL_URI . 'option-images/sidebar_position_1.png',
			"label" => esc_html__('Left', 'piemont')
		),
		'right' => array(
			"image" => IPANEL_URI . 'option-images/sidebar_position_2.png',
			"label" => esc_html__('Right', 'piemont')
		),
		'disable' => array(
			"image" => IPANEL_URI . 'option-images/sidebar_position_3.png',
			"label" => esc_html__('Disable sidebar', 'piemont')
		),
	),
	"std" => "right",
	"desc" => "",
	"type" => "image",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Blog post sidebar position", 'piemont'),
	"id" => "post_sidebar_position",
	"options" => array(
		'left' => array(
			"image" => IPANEL_URI . 'option-images/sidebar_position_1.png',
			"label" => esc_html__('Left', 'piemont')
		),
		'right' => array(
			"image" => IPANEL_URI . 'option-images/sidebar_position_2.png',
			"label" => esc_html__('Right', 'piemont')
		),
		'disable' => array(
			"image" => IPANEL_URI . 'option-images/sidebar_position_3.png',
			"label" => esc_html__('Disable sidebar', 'piemont')
		),
	),
	"std" => "disable",
	"desc" => "",
	"type" => "image",
);

$ipanel_piemont_option[] = array(
	"type" => "EndTab"
);
/**
 * BLOG TAB
 **/
$ipanel_piemont_tabs[] = array(
	'name' => esc_html__('Blog', 'piemont'),
	'id' => 'blog_settings'
);
$ipanel_piemont_option[] = array(
	"type" => "StartTab",
	"id" => "blog_settings"
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Main Blog settings", 'piemont'),
	"type" => "StartSection",
	"field_options" => array(
		"show" => true // Set true to show items by default.
	)
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Blog style", 'piemont'),
	"id" => "blog_style",
	"options" => array(
		'1' => array(
			"image" => IPANEL_URI . 'option-images/blog_style_1.png',
			"label" => esc_html__('Style 1 - Default, Centered title', 'piemont')
		),
		'2' => array(
			"image" => IPANEL_URI . 'option-images/blog_style_2.png',
			"label" => esc_html__('Style 2 - Left aligned titles, minimalistic design, another styles', 'piemont')
		),
		'3' => array(
			"image" => IPANEL_URI . 'option-images/blog_style_3.png',
			"label" => esc_html__('Style 3 - Posts blocks with background and padding, shadows, another styles', 'piemont')
		),
		'4' => array(
			"image" => IPANEL_URI . 'option-images/blog_style_4.png',
			"label" => esc_html__('Style 4 - Rounded elements, another styles', 'piemont')
		),
		'5' => array(
			"image" => IPANEL_URI . 'option-images/blog_style_5.png',
			"label" => esc_html__('Style 5 - Minimalistic', 'piemont')
		),
	),
	"std" => "1",
	"desc" => esc_html__("This option will completely change design, styles for your blog listing, widgets styles and blog listing styles. This option does not change colors (you can change colors for theme in 'Colors' tab).", 'piemont'),
	"type" => "image",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Blog layout", 'piemont'),
	"id" => "blog_layout",
	"options" => array(
		'layout_default' => array(
			"image" => IPANEL_URI . 'option-images/blog_layout_1.png',
			"label" => esc_html__('Default layout', 'piemont')
		),
		'layout_vertical_design' => array(
			"image" => IPANEL_URI . 'option-images/blog_layout_2.png',
			"label" => esc_html__('Show every third post in vertical design', 'piemont')
		),
		'layout_2column_design' => array(
			"image" => IPANEL_URI . 'option-images/blog_layout_3.png',
			"label" => esc_html__('Show second and next posts in 2 columns', 'piemont')
		),
		'layout_list' => array(
			"image" => IPANEL_URI . 'option-images/blog_layout_4.png',
			"label" => esc_html__('List with short posts blocks', 'piemont')
		),
		'layout_masonry' => array(
			"image" => IPANEL_URI . 'option-images/blog_layout_5.png',
			"label" => esc_html__('Masonry layout', 'piemont')
		),
	),
	"std" => "layout_default",
	"desc" => esc_html__("This option will completely change blog listing layout and posts display.", 'piemont'),
	"type" => "image",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Post info separator symbol", 'piemont'),
	"id" => "post_info_separator",
	"std" => "*",
	"desc" => esc_html__("Used to separate post date, author, comments, etc in posts listings and blog post. For example: /, *, -.", 'piemont'),
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Show blog posts in listing as", 'piemont'),
	"id" => "blog_post_loop_type",
	"std" => "content",
	"options" => array(
		"content" => esc_html__("Full content (You will add More tag manually)", 'piemont'),
		"excerpt" => esc_html__("Excerpt (Auto crop by words)", 'piemont'),
	),
	"desc" => esc_html__("We recommend you to use Fullwidth layout for Slider Style 3", 'piemont'),
	"type" => "select",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Post excerpt length (words)", 'piemont'),
	"id" => "post_excerpt_legth",
	"std" => "40",
	"desc" => esc_html__("Used by WordPress for post shortening. Default: 40", 'piemont'),
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Show author name ('by author') in blog posts after post date", 'piemont'),
	"id" => "blog_post_show_author",
	"std" => true,
	"desc" => "",
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Show related posts on posts listing page", 'piemont'),
	"id" => "blog_list_show_related",
	"std" => false,
	"desc" => esc_html__("Will show 3 related posts after every post in posts list. Does not available in Masonry layout and 2 column layout.", 'piemont'),
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
		"type" => "EndSection"
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Featured Posts slider settings", 'piemont'),
	"type" => "StartSection",
	"field_options" => array(
		"show" => true // Set true to show items by default.
	)
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Show Featured posts slider on homepage", 'piemont'),
	"id" => "blog_enable_homepage_slider",
	"std" => true,
	"desc" => esc_html__("You can mark posts as featured in post edit screen at the bottom settings box to display it in slider in homepage header.", 'piemont'),
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Featured posts slider layout and style", 'piemont'),
	"id" => "blog_homepage_slider_style",
	"options" => array(
		'1' => array(
			"image" => IPANEL_URI . 'option-images/posts_slider_1.png',
			"label" => esc_html__('Style 1 - Single Post Slider', 'piemont')
		),
		'2' => array(
			"image" => IPANEL_URI . 'option-images/posts_slider_2.png',
			"label" => esc_html__('Style 2 - Single Post Slider', 'piemont')
		),
		'3' => array(
			"image" => IPANEL_URI . 'option-images/posts_slider_3.png',
			"label" => esc_html__('Style 3 - Multi Post Gallery Slider', 'piemont')
		),
		'4' => array(
			"image" => IPANEL_URI . 'option-images/posts_slider_4.png',
			"label" => esc_html__('Style 4 - News Portal. Display 3 latest featured posts (without slider)', 'piemont')
		),
	),
	"std" => "1",
	"desc" => esc_html__("You can change how will look your posts slider with predefined layouts and styles.</ul>", 'piemont'),
	"type" => "image",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Featured posts slider width", 'piemont'),
	"id" => "blog_homepage_slider_fullwidth",
	"std" => "0",
	"options" => array(
		"1" => esc_html__("Fullwidth", 'piemont'),
		"0" => esc_html__("Boxed", 'piemont'),
	),
	"desc" => esc_html__("We recommend you to use Fullwidth layout for Slider Style 3", 'piemont'),
	"type" => "select",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Featured posts slider autoplay", 'piemont'),
	"id" => "blog_homepage_slider_autoplay",
	"std" => "1",
	"options" => array(
		"1" => esc_html__("Enable", 'piemont'),
		"0" => esc_html__("Disable", 'piemont'),
	),
	"desc" => "",
	"type" => "select",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Featured posts slider navigation arrows", 'piemont'),
	"id" => "blog_homepage_slider_navigation",
	"std" => "1",
	"options" => array(
		"1" => esc_html__("Enable", 'piemont'),
		"0" => esc_html__("Disable", 'piemont'),
	),
	"desc" => "",
	"type" => "select",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Featured posts slider pagination buttons", 'piemont'),
	"id" => "blog_homepage_slider_pagination",
	"std" => "0",
	"options" => array(
		"1" => esc_html__("Enable", 'piemont'),
		"0" => esc_html__("Disable", 'piemont'),
	),
	"desc" => "",
	"type" => "select",
);
$ipanel_piemont_option[] = array(
		"type" => "EndSection"
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Homepage Welcome Block", 'piemont'),
	"type" => "StartSection",
	"field_options" => array(
		"show" => true // Set true to show items by default.
	)
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Show Homepage Welcome block 1", 'piemont'),
	"id" => "blog_enable_homepage_welcome_block",
	"std" => false,
	"desc" => esc_html__("You can display any HTML content in this block below your slider or header.", 'piemont'),
	"type" => "checkbox",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Homepage Welcome block 1 content", 'piemont'),
	"id" => "blog_homepage_welcome_block_content",
	"std" => '<div class="text-center">
<h2>My story</h2>
<span>CREATE DELICIUOIS MEMORIES</span>
<p>Hello, my name is Amanda. I am a food blogger based in Los Angeles. This is a blog, where I post my photos, recipes  and tips about cooking. I started with Piemont to provide you with my favourite dishes, new ideas and news.</p>
<a class="btn" href="#">About me</a>
</div>',
	"desc" => esc_html__("You can use any HTML here to display any content in your welcome block with predefined layout.", 'piemont'),
	"field_options" => array(
		'media_buttons' => true
	),
	"type" => "wp_editor",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Homepage Welcome block 1 image", 'piemont'),
	"id" => "blog_homepage_welcome_block_image",
	"field_options" => array(
		"std" => ''
	),
	"desc" => esc_html__("Upload your homepage welcome block image in PNG or JPG format (430x390px). Remove image if you don't want to display it (only block content will be used)", 'piemont'),
	"type" => "qup",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Show Homepage Welcome block 2", 'piemont'),
	"id" => "blog_enable_homepage_welcome_block_2",
	"std" => false,
	"desc" => esc_html__("You can display any HTML content in this block below your slider or header with any layout.", 'piemont'),
	"type" => "checkbox",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Homepage Welcome block 2 content", 'piemont'),
	"id" => "blog_homepage_welcome_block_2_content",
	"std" => '<div class="col-md-4"><a href="category/food/"><div class="welcome-image"><img src="http://wp.magnium-themes.com/piemont-demo/wp-content/uploads/2015/07/promo_3.jpg" alt="promo_3" width="360" height="280" class="size-full wp-image-187" /><div class="welcome-image-overlay">Food</div></div></a></div>
<div class="col-md-4"><a href="about-us/"><div class="welcome-image"><img src="http://wp.magnium-themes.com/piemont-demo/wp-content/uploads/2015/07/promo_2.jpg" alt="promo_2" width="360" height="280" class="size-full wp-image-188" /><div class="welcome-image-overlay">About me</div></div></a></div>
<div class="col-md-4"><a href="category/recipes/"><div class="welcome-image"><img src="http://wp.magnium-themes.com/piemont-demo/wp-content/uploads/2015/07/promo_1.jpg" alt="promo_1" width="360" height="280" class="size-full wp-image-189" /><div class="welcome-image-overlay">Recipes</div></div></a></div>',
	"desc" => "You can use any HTML here to display any content in your welcome block with any layout.",
	"field_options" => array(
		'media_buttons' => true
	),
	"type" => "wp_editor",
);

$ipanel_piemont_option[] = array(
		"type" => "EndSection"
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Single Post page settings", 'piemont'),
	"type" => "StartSection",
	"field_options" => array(
		"show" => true // Set true to show items by default.
	)
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Show author info and avatar after single blog post", 'piemont'),
	"id" => "blog_enable_author_info",
	"std" => true,
	"desc" => "",
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Show related posts on single post page", 'piemont'),
	"id" => "blog_post_show_related",
	"std" => false,
	"desc" => "",
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Hide post featured image on single post page", 'piemont'),
	"id" => "blog_post_hide_featured_image",
	"std" => false,
	"desc" => esc_html__("Enable this if you don't want to see featured post image on single post page.", 'piemont'),
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Show prev/next posts navigation links on single post page", 'piemont'),
	"id" => "blog_post_navigation",
	"std" => true,
	"desc" => "",
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
		"type" => "EndSection"
);
$ipanel_piemont_option[] = array(
	"type" => "EndTab"
);

/**
 * FONTS TAB
 **/

$ipanel_piemont_tabs[] = array(
	'name' => esc_html__('Fonts', 'piemont'),
	'id' => 'font_settings'
);

$ipanel_piemont_option[] = array(
	"type" => "StartTab",
	"id" => "font_settings"
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Headers font", 'piemont'),
	"id" => "header_font",
	"desc" => esc_html__("Font used in headers. Default: Playball", 'piemont'),
	"options" => array(
		"font-sizes" => array(
			" " => esc_html__("Font Size", 'piemont'),
			'11' => '11px',
			'12' => '12px',
			'13' => '13px',
			'14' => '14px',
			'15' => '15px',
			'16' => '16px',
			'17' => '17px',
			'18' => '18px',
			'19' => '19px',
			'20' => '20px',
			'21' => '21px',
			'22' => '22px',
			'23' => '23px',
			'24' => '24px',
			'25' => '25px',
			'26' => '26px',
			'27' => '27px',
			'28' => '28px',
			'29' => '29px',
			'30' => '30px',
			'31' => '31px',
			'32' => '32px',
			'33' => '33px',
			'34' => '34px',
			'35' => '35px',
			'36' => '36px',
			'37' => '37px',
			'38' => '38px',
			'39' => '39px',
			'40' => '40px',
			'41' => '41px',
			'42' => '42px',
			'43' => '43px',
			'44' => '44px',
			'45' => '45px',
			'46' => '46px',
			'47' => '47px',
			'48' => '48px',
			'49' => '49px',
			'50' => '50px'
		),
		"color" => false,
		"font-families" => iPanel::getGoogleFonts(),
		"font-styles" => false
	),
	"std" => array(
		"font-size" => '35',
		"font-family" => 'Playball'
	),
	"type" => "typography"
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Headers font parameters for Google Font", 'piemont'),
	"id" => "header_font_options",
	"std" => "400",
	"desc" => esc_html__("You can specify additional Google Fonts paramaters here, for example fonts styles to load. Default: 400", 'piemont'),
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Body font", 'piemont'),
	"id" => "body_font",
	"desc" => esc_html__("Font used in text elements. Default: Lora", 'piemont'),
	"options" => array(
		"font-sizes" => array(
			" " => esc_html__("Font Size", 'piemont'),
			'11' => '11px',
			'12' => '12px',
			'13' => '13px',
			'14' => '14px',
			'15' => '15px',
			'16' => '16px',
			'17' => '17px',
			'18' => '18px',
			'19' => '19px',
			'20' => '20px',
			'21' => '21px',
			'22' => '22px',
			'23' => '23px',
			'24' => '24px',
			'25' => '25px',
			'26' => '26px',
			'27' => '27px'
		),
		"color" => false,
		"font-families" => iPanel::getGoogleFonts(),
		"font-styles" => false
	),
	"std" => array(
		"font-size" => '14',
		"font-family" => 'Lora'
	),
	"type" => "typography"
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Body font parameters for Google Font", 'piemont'),
	"id" => "body_font_options",
	"std" => "400,400italic,700,700italic",
	"desc" => esc_html__("You can specify additional Google Fonts paramaters here, for example fonts styles to load. Default: 400,400italic,700,700italic", 'piemont'),
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Additional font", 'piemont'),
	"id" => "additional_font",
	"desc" => esc_html__("You can select any additional Google font here and use it in Custom CSS in theme.", 'piemont'),
	"options" => array(
		"font-sizes" => array(
			" " => "Font Size",
			'11' => '11px',
			'12' => '12px',
			'13' => '13px',
			'14' => '14px',
			'15' => '15px',
			'16' => '16px',
			'17' => '17px',
			'18' => '18px',
			'19' => '19px',
			'20' => '20px',
			'21' => '21px',
			'22' => '22px',
			'23' => '23px',
			'24' => '24px',
			'25' => '25px',
			'26' => '26px',
			'27' => '27px',
			'28' => '28px',
			'29' => '29px',
			'30' => '30px',
			'31' => '31px',
			'32' => '32px',
			'33' => '33px',
			'34' => '34px',
			'35' => '35px',
			'36' => '36px',
			'37' => '37px',
			'38' => '38px',
			'39' => '39px',
			'40' => '40px',
			'41' => '41px',
			'42' => '42px',
			'43' => '43px',
			'44' => '44px',
			'45' => '45px',
			'46' => '46px',
			'47' => '47px',
			'48' => '48px',
			'49' => '49px',
			'50' => '50px'
		),
		"color" => false,
		"font-families" => iPanel::getGoogleFonts(),
		"font-styles" => false
	),
	"std" => array(
		"font-size" => '48',
		"font-family" => 'Herr+Von+Muellerhoff'
	),
	"type" => "typography"
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Additional font parameters for Google Font", 'piemont'),
	"id" => "additional_font_options",
	"std" => "400,400italic,700,700italic",
	"desc" => esc_html__("You can specify additional Google Fonts paramaters here, for example fonts styles to load. Default: 400,400italic,700,700italic", 'piemont'),
	"type" => "text",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Enable Additional font", 'piemont'),
	"id" => "additional_font_enable",
	"std" => false,
	"desc" => esc_html__("Uncheck if you don't want to use Additional font. This will speed up your site.", 'piemont'),
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Disable ALL Google Fonts on site", "piemont"),
	"id" => "font_google_disable",
	"std" => false,
	"desc" => esc_html__("Use this if you want extra site speed or want to have regular fonts. Arial font will be used with this option.", 'piemont'),
	"type" => "checkbox",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Regular font (apply if you disabled Google Fonts below)", 'piemont'),
	"id" => "font_regular",
	"std" => "Arial",
	"options" => array(
		"Arial" => "Arial",
		"Tahoma" => "Tahoma",
		"Times New Roman" => "Times New Roman",
		"Verdana" => "Verdana",
		"Helvetica" => "Helvetica",
		"Georgia" => "Georgia",
		"Courier New" => "Courier New"
	),
	"desc" => esc_html__("Use this option if you disabled ALL Google Fonts.", 'piemont'),
	"type" => "select",
);
$ipanel_piemont_option[] = array(
	"type" => "EndTab"
);

/**
 * COLORS TAB
 **/

$ipanel_piemont_tabs[] = array(
	'name' => esc_html__('Colors & Skins', 'piemont'),
	'id' => 'color_settings'
);

$ipanel_piemont_option[] = array(
	"type" => "StartTab",
	"id" => "color_settings",
);
$ipanel_piemont_option[] = array(
	"name" => esc_html__("Predefined color skins", 'piemont'),
	"id" => "color_skin_name",
	"std" => "none",
	"options" => array(
		"none" => esc_html__("Use colors specified below", 'piemont'),
		"default" => "Piemont (Default)",
		"turquoise" => "Turquoise",
		"black" => "Black",
		"lightblue" => "Light blue",
		"blue" => "Blue",
		"red" => "Red",
		"green" => "Green",
		"magnium" => "Magnium",
		"fencer" => "Fencer",
		"perfectum" => "Perfectum",
		"simplegreat" => "Simplegreat",
		"simple" => "Simple",
	),
	"desc" => esc_html__("Select one of predefined skins or use your own colors. If you selected any predefined styles your specified colors below will NOT be applied.", 'piemont'),
	"type" => "select",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Body background color", 'piemont'),
	"id" => "theme_body_color",
	"std" => "#ffffff",
	"desc" => esc_html__("Used in many theme places, default: #ffffff", 'piemont'),
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Body text color", 'piemont'),
	"id" => "theme_text_color",
	"std" => "#000000",
	"desc" => esc_html__("Body text color, default: #000000", 'piemont'),
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Theme main color", 'piemont'),
	"id" => "theme_main_color",
	"std" => "#EC9F2E",
	"desc" => esc_html__("Used in many theme places, buttons, links, etc. Default: #EC9F2E", 'piemont'),
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Header background color", 'piemont'),
	"id" => "theme_header_bg_color",
	"std" => "#FFFFFF",
	"desc" => esc_html__("Default: #FFFFFF", 'piemont'),
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Category menu background color", 'piemont'),
	"id" => "theme_cat_menu_bg_color",
	"std" => "#FFFFFF",
	"desc" => esc_html__("This background will be used for main menu below header. Default: #FFFFFF", 'piemont'),
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Footer background color", 'piemont'),
	"id" => "theme_footer_color",
	"std" => "#262626",
	"desc" => esc_html__("Default: #262626", 'piemont'),
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Masonry/List blog layout blocks background color", 'piemont'),
	"id" => "theme_masonry_bg_color",
	"std" => "#F8F8F8",
	"desc" => esc_html__("Default: #F8F8F8", 'piemont'),
	"field_options" => array(
		//'desc_in_tooltip' => true
	),
	"type" => "color",
);

$ipanel_piemont_option[] = array(
	"type" => "EndTab"
);

/**
 * CUSTOM CODE TAB
 **/

$ipanel_piemont_tabs[] = array(
	'name' => esc_html__('Custom code', 'piemont'),
	'id' => 'custom_code'
);

$ipanel_piemont_option[] = array(
	"type" => "StartTab",
	"id" => "custom_code",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Custom JavaScript code", 'piemont'),
	"id" => "custom_js_code",
	"std" => '',
	"field_options" => array(
		"language" => "javascript",
		"line_numbers" => true,
		"autoCloseBrackets" => true,
		"autoCloseTags" => true
	),
	"desc" => esc_html__("This code will run in header", 'piemont'),
	"type" => "code",
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Custom CSS styles", 'piemont'),
	"id" => "custom_css_code",
	"std" => '',
	"field_options" => array(
		"language" => "json",
		"line_numbers" => true,
		"autoCloseBrackets" => true,
		"autoCloseTags" => true
	),
	"desc" => esc_html__("This CSS code will be included in header", 'piemont'),
	"type" => "code",
);

$ipanel_piemont_option[] = array(
	"type" => "EndTab"
);

/**
 * DOCUMENTATION TAB
 **/

$ipanel_piemont_tabs[] = array(
	'name' => esc_html__('Documentation', 'piemont'),
	'id' => 'documentation'
);

$ipanel_piemont_option[] = array(
	"type" => "StartTab",
	"id" => "documentation"
);

function get_plugin_version_number($plugin_name) {
        // If get_plugins() isn't available, require it
	if ( ! function_exists( 'get_plugins' ) )
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

        // Create the plugins folder and file variables
	$plugin_folder = get_plugins( '/' . $plugin_name );
	$plugin_file = $plugin_name.'.php';

	// If the plugin version number is set, return it
	if ( isset( $plugin_folder[$plugin_file]['Version'] ) ) {
		return $plugin_folder[$plugin_file]['Version'];

	} else {
	// Otherwise return null
		return 'Plugin not installed';
	}
}

$ipanel_piemont_option[] = array(
	"type" => "htmlpage",
	"name" => '<div class="documentation-icon"><img src="'.esc_url(IPANEL_URI) . 'assets/img/documentation-icon.png" alt="Documentation"/></div><p>We recommend you to read <a href="http://magniumthemes.com/go/piemont-docs/" target="_blank">Theme Documentation</a> before you will start using our theme to building your website. It covers all steps for site configuration, demo content import, theme features usage and more.</p>
<p>If you have face any problems with our theme feel free to use our <a href="http://support.magniumthemes.com/" target="_blank">Support System</a> to contact us and get help for free.</p>
<a class="button button-primary" href="http://magniumthemes.com/go/piemont-docs/" target="_blank">Theme Documentation</a>
<a class="button button-primary" href="http://support.magniumthemes.com/" target="_blank">Support System</a><h3>Technical information (paste it to your support ticket):</h3><textarea style="width: 500px; height: 160px;font-size: 12px;">Theme Version: '.wp_get_theme()->get( 'Version' ).'
WordPress Version: '.get_bloginfo( 'version' ).'</textarea>'
);

$ipanel_piemont_option[] = array(
	"type" => "EndTab"
);

/**
 * EXPORT TAB
 **/

$ipanel_piemont_tabs[] = array(
	'name' => esc_html__('Export', 'piemont'),
	'id' => 'export_settings'
);

$ipanel_piemont_option[] = array(
	"type" => "StartTab",
	"id" => "export_settings"
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Export with Download Possibility", 'piemont'),
	"type" => "export",
	"desc" => esc_html__("Export theme admin panel settings to file.", 'piemont')
);

$ipanel_piemont_option[] = array(
	"type" => "EndTab"
);

/**
 * IMPORT TAB
 **/

$ipanel_piemont_tabs[] = array(
	'name' => esc_html__('Import', 'piemont'),
	'id' => 'import_settings'
);

$ipanel_piemont_option[] = array(
	"type" => "StartTab",
	"id" => "import_settings"
);

$ipanel_piemont_option[] = array(
	"name" => esc_html__("Import", 'piemont'),
	"type" => "import",
	"desc" => esc_html__("Select theme options import file or paste options string to import your settings from Export.", 'piemont')
);

$ipanel_piemont_option[] = array(
	"type" => "EndTab"
);

/**
 * CONFIGURATION
 **/

$ipanel_configs = array(
	'ID'=> 'PIEMONT_PANEL',
	'menu'=>
		array(
			'submenu' => false,
			'page_title' => esc_html__('Piemont Control Panel', 'piemont'),
			'menu_title' => esc_html__('Piemont Control Panel', 'piemont'),
			'capability' => 'manage_options',
			'menu_slug' => 'manage_theme_options',
			'icon_url' => IPANEL_URI . 'assets/img/panel-icon.png',
			'position' => 59
		),
	'rtl' => ( function_exists('is_rtl') && is_rtl() ),
	'tabs' => $ipanel_piemont_tabs,
	'fields' => $ipanel_piemont_option,
	'download_capability' => 'manage_options',
	'live_preview' => false
);

$ipanel_theme_usage = new IPANEL( $ipanel_configs );

