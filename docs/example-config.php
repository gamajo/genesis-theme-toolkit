<?php
/**
 * Example theme configuration
 *
 * @package   Gamajo\ExampleTheme
 * @author    Gary Jones
 * @copyright 2017 Gamajo
 * @license   MIT
 */

declare( strict_types = 1 );

namespace Gamajo\ExampleTheme;

use Gamajo\GenesisThemeToolkit\BreadcrumbArgs;
use Gamajo\GenesisThemeToolkit\Layouts;
use Gamajo\GenesisThemeToolkit\Templates;
use Gamajo\GenesisThemeToolkit\ThemeSettings;
use Gamajo\GenesisThemeToolkit\WidgetAreas;
use Gamajo\GenesisThemeToolkit\GenesisThemeToolkit;
use Gamajo\ThemeToolkit\ImageSizes;
use Gamajo\ThemeToolkit\ThemeSupport;
use Gamajo\ThemeToolkit\ThemeToolkit;
use Gamajo\ThemeToolkit\Widgets;

$gamajo_theme_support = [
	ThemeSupport::ADD => [
		'html5'                           => [
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'search-form',
		],
		'genesis-accessibility'           => [
			'headings',
			'drop-down-menu',
			'rems',
			'search-form',
			'skip-links',
		],
		'genesis-responsive-viewport'     => '',
		'genesis-structural-wraps'        => [
			'header',
			'breadcrumb',
			'footer-widgets',
			'footer',
		],
		'genesis-menus'                   => [
			'header' => __( 'Header Navigation Menu', 'your-theme' ),
		],
		'genesis-style-selector'          => [
			'your-theme-red'   => _x( 'Red', 'Theme style', 'your-theme' ),
			'your-theme-green' => _x( 'Green', 'Theme style', 'your-theme' ),
			'your-theme-blue'  => _x( 'Blue', 'Theme style', 'your-theme' ),
		],
		'genesis-after-entry-widget-area' => '',
	],
];

$gamajo_image_sizes = [
	ImageSizes::ADD => [
		'article-grid'   => [ 480, 320, true ],
		'article-header' => [ 1200, 400, true ],
	],
];

$gamajo_google_fonts = [

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by this font, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	'Roboto:300,400,500,700' => _x( 'on', 'Roboto font: on or off', 'gamajo' ),
];

$gamajo_templates = [
	Templates::UNREGISTER => [
		'page-foobar.php',
	],
];

$gamajo_genesis_breadcrumb_args = [
	BreadcrumbArgs::SEP    => ' <span class="dashicons dashicons-arrow-right-alt2"></span> ',
	BreadcrumbArgs::LABELS => [
		BreadcrumbArgs::PREFIX => '',
	],
];

$gamajo_genesis_theme_settings = [
	ThemeSettings::FORCE   => [
		ThemeSettings::POSTS_NAV         => 'numeric',
		ThemeSettings::SEMANTIC_HEADINGS => 0,
	],
	ThemeSettings::DEFAULTS => [
		ThemeSettings::SITE_LAYOUT => 'full-width-content',
	],
];

$gamajo_genesis_layouts = [
	Layouts::UNREGISTER => [
		Layouts::CONTENT_SIDEBAR_SIDEBAR,
		Layouts::SIDEBAR_CONTENT_SIDEBAR,
		Layouts::SIDEBAR_SIDEBAR_CONTENT,
	],
];

$gamajo_widgets = [
	Widgets::UNREGISTER => [
		\Genesis_Featured_Page::class,
		\Genesis_Featured_Post::class,
		\Genesis_User_Profile_Widget::class,
	],
];

$gamajo_genesis_widget_areas = [
	WidgetAreas::UNREGISTER => [
		WidgetAreas::HEADER_RIGHT,
	],
];

return [
	'Gamajo' => [
		'ExampleTheme' => [
			ThemeToolkit::THEMESUPPORT          => $gamajo_theme_support,
			ThemeToolkit::IMAGESIZES            => $gamajo_image_sizes,
			ThemeToolkit::GOOGLEFONTS           => $gamajo_google_fonts,
			ThemeToolkit::WIDGETS               => $gamajo_widgets,
			GenesisThemeToolkit::TEMPLATES      => $gamajo_templates,
			GenesisThemeToolkit::BREADCRUMBARGS => $gamajo_genesis_breadcrumb_args,
			GenesisThemeToolkit::LAYOUTS        => $gamajo_genesis_layouts,
			GenesisThemeToolkit::THEMESETTINGS  => $gamajo_genesis_theme_settings,
			GenesisThemeToolkit::WIDGETAREAS    => $gamajo_genesis_widget_areas,
		],
	],
];
