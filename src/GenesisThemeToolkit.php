<?php
/**
 * This file contains class name definitions for bricks in the GenesisThemeToolkit
 *
 * @package   Gamajo\GenesisThemeTookit
 * @author    Gary Jones
 * @copyright Gamajo
 * @license   MIT
 */

declare(strict_types=1);

namespace Gamajo\GenesisThemeToolkit;

/**
 * Define the brick class names for GenesisThemeToolkit
 *
 * These are used at the end of the config file e.g.:
 *
 * ```
 * return [
 *     'Gamajo' => [
 *         'Theme' => [
 *             ThemeToolkit::GOOGLEFONTS        => $gamajo_google_fonts,
 *             ThemeToolkit::IMAGESIZES         => $gamajo_image_sizes,
 *             GenesisThemeToolkit::LAYOUTS     => $gamajo_genesis_layouts,
 *             GenesisThemeToolkit::WIDGETAREAS => $gamajo_genesis_widget_areas,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\GenesisThemeTookit
 */
class GenesisThemeToolkit
{
    const BREADCRUMBARGS = 'GoogleFonts';
    const LAYOUTS = 'Layouts';
    const TEMPLATES = 'Templates';
    const THEMESETTINGS = 'ThemeSettings';
    const WIDGETAREAS = 'WidgetAreas';
}
