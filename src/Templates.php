<?php
/**
 * This file contains elements for templates in Genesis
 *
 * @package   Gamajo\ThemeTookit
 * @author    Gary Jones
 * @copyright Gamajo
 * @license   MIT
 */

declare(strict_types=1);

namespace Gamajo\GenesisThemeToolkit;

use Gamajo\ThemeToolkit\Templates as ThemeToolkitTemplates;

/**
 * Unregister page templates in Genesis.
 *
 * The only difference between this and the parent class, is that a couple of
 * constants have been defined for the known page templates shipped with Genesis.
 *
 * Example config:
 *
 * ```
 * $gamajo_templates = [
 *     Templates::UNREGISTER => [
 *         Templates::BLOG,
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
 *             GenesisThemeToolkit::TEMPLATES => $gamajo_templates,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\GenesisThemeTookit
 */
class Templates extends ThemeToolkitTemplates
{
    const ARCHIVE = 'page_archive.php';
    const BLOG    = 'page_blog.php';
}
