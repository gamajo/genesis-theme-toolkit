<?php
/**
 * Utility Pro.
 *
 * @package   Gamajo\GenesisThemeTookit
 * @author    Gary Jones
 * @copyright Gamajo
 * @license   MIT
 */

declare(strict_types=1);

namespace Gamajo\GenesisThemeToolkit;

use Gamajo\ThemeToolkit\Brick;

/**
 * Set defaults, or force Genesis theme settings to specific values, set in config/defaults.php
 *
 * Default values will be used before Genesis theme settings are saved, or when they are reset.
 *
 * Forced values will be used regardless of what the User tries to change the setting to. A future
 * version of Genesis should make these settings disabled.
 *
 * Example config:
 *
 * ```
 * $gamajo_genesis_theme_settings = [
 *     ThemeSettings::FORCE   => [
 *         ThemeSettings::POSTS_NAV         => 'numeric',
 *         ThemeSettings::SEMANTIC_HEADINGS => 0,
 *     ],
 *     ThemeSettings::DEFAULTS => [
 *         ThemeSettings::SITE_LAYOUT => 'full-width-content',
 *     ],
 * ];
 * ```
 *
 * And then:
 *
 * ```
 * return [
 *     'Gamajo' => [
 *         'Theme' => [
 *             GenesisThemeToolkit::THEMESETTINGS => $gamajo_genesis_theme_settings,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\GenesisThemeToolkit
 */
class ThemeSettings extends Brick
{
	const DEFAULTS = 'defaults';
	const FORCE = 'force';

	const UPDATE = 'update';
	const UPDATE_EMAIL = 'update_email';
	const UPDATE_EMAIL_ADDRESS = 'update_email_address';
	const BLOG_TITLE = 'blog_title';
	const STYLE_SELECTION = 'style_selection';
	const SITE_LAYOUT = 'site_layout';
	const SUPERFISH = 'superfish';
	const NAV_EXTRAS = 'nav_extras';
	const NAV_EXTRAS_TWITTER_ID = 'nav_extras_twitter_id';
	const NAV_EXTRAS_TWITTER_TEXT = 'nav_extras_twitter_text';
	const FEED_URI = 'feed_uri';
	const REDIRECT_FEED = 'redirect_feed';
	const COMMENTS_FEED_URI = 'comments_feed_uri';
	const REDIRECT_COMMENTS_FEED = 'redirect_comments_feed';
	const COMMENTS_PAGES = 'comments_pages';
	const COMMENTS_POSTS = 'comments_posts';
	const TRACKBACKS_PAGES = 'trackbacks_pages';
	const TRACKBACKS_POSTS = 'trackbacks_posts';
	const BREADCRUMB_HOME = 'breadcrumb_home';
	const BREADCRUMB_FRONT_PAGE = 'breadcrumb_front_page';
	const BREADCRUMB_POSTS_PAGE = 'breadcrumb_posts_page';
	const BREADCRUMB_SINGLE = 'breadcrumb_single';
	const BREADCRUMB_PAGE = 'breadcrumb_page';
	const BREADCRUMB_ARCHIVE = 'breadcrumb_archive';
	const BREADCRUMB_404 = 'breadcrumb_404';
	const BREADCRUMB_ATTACHMENT = 'breadcrumb_attachment';
	const CONTENT_ARCHIVE = 'content_archive';
	const CONTENT_ARCHIVE_THUMBNAIL = 'content_archive_thumbnail';
	const IMAGE_SIZE = 'image_size';
	const IMAGE_ALIGNMENT = 'image_alignment';
	const POSTS_NAV = 'posts_nav';
	const BLOG_CAT = 'blog_cat';
	const BLOG_CAT_EXCLUDE = 'blog_cat_exclude';
	const BLOG_CAT_NUM = 'blog_cat_num';
	const HEADER_SCRIPTS = 'header_scripts';
	const FOOTER_SCRIPTS = 'footer_scripts';
	const THEME_VERSION = 'theme_version';
	const DB_VERSION = 'db_version';
	const FIRST_VERSION = 'first_version';
	const SEMANTIC_HEADINGS = 'semantic_headings';

    /**
     * Apply filters and hooks.
     */
    public function apply()
    {
        // Change the theme settings defaults.
        add_filter( 'genesis_theme_settings_defaults', [ $this, 'theme_settings_defaults' ] );

        // Force specific values to be returned.
        $this->force_values();
    }

    /**
     * Change the theme settings defaults.
     *
     * @param array $defaults Existing theme settings defaults.
     * @return array Theme settings defaults.
     */
    public function theme_settings_defaults( $defaults ): array
    {
        foreach ($this->config->getSubConfig(self::DEFAULTS)->getArrayCopy() as $key => $value) {
            $defaults[ $key ] = $value;
        }

        return $defaults;
    }

    /**
     * Force specific values to be returned.
     */
    public function force_values()
    {
        foreach ($this->config->getSubConfig(self::FORCE)->getArrayCopy() as $key => $value) {
            add_filter("genesis_pre_get_option_{$key}", function () use ($value) {
                return $value;
            });
        }
    }
}
