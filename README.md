# Genesis Theme Toolkit

Building blocks to develop a config-based Genesis Framework child theme for WordPress.

When building a theme, wouldn't it be nice to separate out the implementation-specific config, from the reusable logic? This is the premise upon which the [Using a Config to Write Reusable Code](https://www.alainschlesser.com/config-files-for-reusable-code/) series articles are written, and which this package enables.

Specifically, this packages builds upon the [Theme Toolkit](https://github.com/gamajo/theme-toolkit) package, and adds _bricks_ that are specific to Genesis child theme development. It provides an easy way to:

- Filtering the default Genesis breadcrumb arguments.
- Registering and unregistering Genesis layouts.
- Unregistering templates inherited from Genesis (extends Theme Toolkit functionality)
- Filters Genesis theme settings defaults, or forces them to specific values.
- Register and unregister widget areas, added by Genesis (extends Theme Toolkit functionality)
- Customise the footer credits string.

## Why?

The ThemeToolkit and GenesisThemeToolkit packages are for theme customisations - what theme support to add, what CSS/JS dependencies to add in, how many footer widgets to allow, what layouts to add/remove, what image sizes there should be - all stuff that would historically gone into `functions.php` or some other include file.

When that is all set in `functions.php` though, the important values are often lost in a mixture of logic (what to do with those values), and boilerplate (opening and closing functions, hooking in to filters etc.), and that can make it harder for end theme authors to seek out and configure those important values to their liking.

By following a sort of _separation of concerns_ principle, we use a config file to keep the important values all in one place (easy to tell people where and how to edit), and then keep the rest of the logic and boilerplate away from those who are less confident with PHP. They get a single place to make amendments, and you don't have to maintain the default logic.

Any theme can use the ThemeToolkit, and Genesis child theme can use this GenesisThemeToolkit.

For premium themes, you would set the toolkit(s) as a composer dependency, to pull it in locally for development, and then just be sure to include `vendor/gamajo/...` within your distributable theme zip.

## Installation

Requires PHP 7.1.

In a terminal, browse to the directory with your theme in and then:

```sh
composer require gamajo/genesis-theme-toolkit
```

You can then autoload (PSR-4) or require the files as needed.

## Usage

See the [example-config.php](docs/example-config.php). This would typically live in your theme, at `config/defaults.php`.

Your theme would then contain a function, in the `functions.php`, to pull in this config, and load up the individual components, which are referred to as _bricks_:

```php
// functions.php

namespace Gamajo\ExampleTheme;

use BrightNucleus\Config\ConfigFactory;
use Gamajo\GenesisThemeToolkit\BreadcrumbArgs;
use Gamajo\GenesisThemeToolkit\FooterCreds;
use Gamajo\GenesisThemeToolkit\Layouts;
use Gamajo\GenesisThemeToolkit\Templates;
use Gamajo\GenesisThemeToolkit\ThemeSettings;
use Gamajo\GenesisThemeToolkit\WidgetAreas;
use Gamajo\ThemeToolkit\GoogleFonts;
use Gamajo\ThemeToolkit\ImageSizes;
use Gamajo\ThemeToolkit\Templates;
use Gamajo\ThemeToolkit\ThemeSupport;
use Gamajo\ThemeToolkit\Widgets;
use Gamajo\ThemeToolkit\WidgetAreas;
use Gamajo\ThemeToolkit\ThemeToolkit;

add_action( 'after_setup_theme', __NAMESPACE__ . '\setup' );
/**
 * Theme setup.
 *
 * Compose the theme toolkit bricks.
 */
function setup() {
	$config_file = __DIR__ . '/config/defaults.php';
	$config = ConfigFactory::createSubConfig( $config_file, 'Gamajo\ExampleTheme' );

	// These bricks are run in admin and front-end.
	$bricks = [
		ImageSizes::class,
		Templates::class,
		ThemeSupport::class,
		Widgets::class,
		Layouts::class,
		ThemeSettings::class,
		WidgetAreas::class,
	];

	// Apply logic in bricks, with configuration defined in config/defaults.php.
	ThemeToolkit::applyBricks($config, ...$bricks);


	if ( ! is_admin() ) {
		// Only front-end bricks.
		$bricks = [
			FooterCreds::class,
			BreadcrumbArgs::class,
			GoogleFonts::class,
		];

		ThemeToolkit::applyBricks($config, ...$bricks);

	}
}
```

The `'Gamajo\ExampleTheme'` string matches the two keys in the `return` at the bottom of the config file. Change this in the config and the function to be your company name and theme name.

You don't have to use all of the bricks in this package; pick and choose.

You can add your own bricks to your theme (in your `src/` or similar directory), and then make use of them in the function above.

If you're not using the Genesis Framework, see the [Theme Toolkit](https://github.com/gamajo/theme-toolkit) which has just the bricks applicable for building themes in general.

## Change Log

Please see [CHANGELOG.md](CHANGELOG.md).

## Credits

Built by [Gary Jones](https://twitter.com/GaryJ)  
Copyright 2017 [Gamajo](https://gamajo.com)
