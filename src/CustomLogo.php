<?php
/**
 * This file contains elements for using WordPress Custom Logo functionality with Genesis.
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
 * Adds support for a custom logo set using the customizer with WP's built in add_theme_support( 'custom-logo' );
 *
 * Flex height and flex width parameters are set true by default, but they can be overwritten in config.
 *
 * Setting SITE_DESCRIPTION to false will hide `.site-description` using `.screen-reader-text`.
 *
 * Example config:
 *
 * ```
 * $generico_custom_logo = [
 *     CustomLogo::HEIGHT           => 600,
 *     CustomLogo::WIDTH            => 160,
 *     CustomLogo::FLEX_HEIGHT      => false,
 *     CustomLogo::SITE_DESCRIPTION => false,
 * ];
 * ```
 *
 * And then:
 *
 * ```
 * return [
 *     'Gamajo' => [
 *         'Theme' => [
 *             Gamajo::CUSTOMLOGO => $gamajo_custom_logo,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\GenesisThemeToolkit
 */
class CustomLogo extends Brick
{
    const HEIGHT = 'height';
    const WIDTH = 'width';
    const FLEX_HEIGHT = 'flex_height';
    const FLEX_WIDTH = 'flex_width';
    const SITE_DESCRIPTION = 'show_site_description';

    /**
     * Apply filters and hooks.
     */
    public function apply()
    {
        if (!($this->config->hasKey(self::HEIGHT) && $this->config->hasKey(self::WIDTH))) {
            return;
        }

        add_theme_support('custom-logo', [
            'height'      => $this->config->getKey(self::HEIGHT),
            'width'       => $this->config->getKey(self::WIDTH),
            'flex-height' => $this->config->hasKey(self::FLEX_HEIGHT) ? $this->config->getKey(self::FLEX_HEIGHT) : true,
            'flex-width'  => $this->config->hasKey(self::FLEX_WIDTH) ? $this->config->getKey(self::FLEX_WIDTH) : true,
        ]);

        add_filter('genesis_seo_title', [$this, 'inlineLogoMarkup'], 10, 3);

        if (false === $this->config->getKey(self::SITE_DESCRIPTION)) {
            add_filter('genesis_attr_site-description', [$this, 'hideSiteDescription']);
        }
    }

    /**
     * Add an image inline in the site title element for the logo.
     *
     * @author @_AlphaBlossom
     * @author @_neilgee
     * @author @_JiveDig
     * @author @_srikat
     *
     * @param string $title Current markup of title.
     * @param string $inside Markup inside the title.
     * @param string $wrap Wrapping element for the title.
     *
     * @return string Updated site title markup.
     */
    public function inlineLogoMarkup($title, $inside, $wrap): string
    {
        if (!$this->hasCustomLogo()) {
            return $title;
        }

        $inside = sprintf(
            '<span class="screen-reader-text">%s</span>%s',
            esc_html(get_bloginfo('name')),
            get_custom_logo()
        );

        // Build the title.
        $title = genesis_markup(array(
            'open'    => sprintf("<{$wrap} %s>", genesis_attr('site-title')),
            'close'   => "</{$wrap}>",
            'content' => $inside,
            'context' => 'site-title',
            'echo'    => false,
            'params'  => array(
                'wrap' => $wrap,
            ),
        ));

        return $title;
    }

    /**
     * Add class for screen readers to site description.
     *
     * This will keep the site description markup but will not have any visual presence on the page
     * This runs if there is a logo image set in the Customizer.
     *
     * @author @_neilgee
     * @author @_srikat
     *
     * @param array $attributes Current attributes.
     *
     * @return array Array of attributes.
     */
    public function hideSiteDescription($attributes): array
    {
        if ($this->hasCustomLogo()) {
            $attributes['class'] .= ' screen-reader-text';
        }

        return $attributes;
    }

    /**
     * Check whether we're using a custom logo.
     *
     * @return bool
     */
    protected function hasCustomLogo(): bool
    {
        return function_exists('has_custom_logo') && has_custom_logo();
    }
}
