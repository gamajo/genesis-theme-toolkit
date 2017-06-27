<?php
/**
 * Genesis Widget Areas
 *
 * @package   Gamajo\GenesisThemeTookit
 * @author    Gary Jones
 * @copyright Gamajo
 * @license   MIT
 */

declare(strict_types=1);

namespace Gamajo\GenesisThemeToolkit;

use Gamajo\ThemeToolkit\WidgetAreas as ThemeToolkitWidgetAreas;

/**
 * Register or unregister widget areas for a Genesis child theme.
 *
 * The difference between this class and the parent Gamajo\ThemeToolkit\WidgetAreas
 * is that registration is passed through a Genesis function so the new widget area
 * markup is consistent with existing Genesis widget areas.
 *
 * Example config:
 *
 * ```
 * $gamajo_genesis_widget_areas = [
 *     WidgetAreas::UNREGISTER => [
 *         WidgetAreas::HEADER_RIGHT,
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
 *             GenesisThemeToolkit::WIDGETAREAS => $gamajo_genesis_widget_areas,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\GenesisThemeToolkit
 */
class WidgetAreas extends ThemeToolkitWidgetAreas
{
    const HEADER_RIGHT = 'header-right';
    const SIDEBAR      = 'sidebar';
    const SIDEBAR_ALT  = 'sidebar-alt';
    /**
     * Register widget areas.
     */
    public function register(array $widget_areas)
    {
        array_walk($widget_areas, function ($widget_area) {
            \genesis_register_widget_area($widget_area);
        });
    }
}
