<?php
/**
 * Class to manage Genesis breadcrumbs arguments
 *
 * @package   Gamajo\GenesisThemeToolkit
 * @author    Gary Jones
 * @copyright Gamajo
 * @license   MIT
 */

declare(strict_types=1);

namespace Gamajo\GenesisThemeToolkit;

use Gamajo\ThemeToolkit\Brick;

/**
 * Merges configured breadcrumbs arguments with defaults.
 *
 * Example config:
 *
 * ```
 * $gamajo_genesis_breadcrumb_args = [
 *     BreadcrumbArgs::SEP    => ' <span class="dashicons dashicons-arrow-right-alt2"></span> ',
 *     BreadcrumbArgs::LABELS => [
 *         BreadcrumbArgs::PREFIX => '',
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
 *             GenesisThemeToolkit::BREADCRUMBARGS => $gamajo_genesis_breadcrumb_args,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\GenesisThemeToolkit
 */
class BreadcrumbArgs extends Brick
{
    const HOME = 'home';
    const SEP = 'sep';
    const LIST_SEP = 'list_sep';
    const PREFIX = 'prefix';
    const SUFFIX = 'suffix';
    const HIERARCHICAL_ATTACHMENTS = 'heirarchial_attachments'; // Note: string value has typos in Genesis.
    const HIERARCHICAL_CATEGORIES = 'heirarchial_categories'; // Note: string value has typos in Genesis.
    const LABELS = 'labels';
    const AUTHOR = 'author';
    const CATERGORY = 'category';
    const TAG = 'tag';
    const DATE = 'date';
    const SEARCH = 'search';
    const TAX = 'tax';
    const POST_TYPE = 'post_type';
    const FOUROHFOUR = '404';

    /**
     * Apply filters and hooks.
     */
    public function apply()
    {
        add_filter( 'genesis_breadcrumb_args', [$this, 'breadcrumb_args']);
    }

    /**
     * Filter breadcrumb args to remove prefix and add Dashicon separator.
     *
     * @param array $args Existing breadcrumb args.
     * @return mixed Amended breadcrumb args.
     */
    public function breadcrumb_args(array $args)
    {
        return array_replace_recursive($args, $this->config->getArrayCopy());
    }
}
