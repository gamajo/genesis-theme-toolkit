<?php
/**
 * This file contains elements for managing Genesis Layouts.
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
 * Register or unregister Genesis layouts.
 *
 * Example config:
 *
 * ```
 * $gamajo_genesis_layouts = [
 *     Layouts::UNREGISTER => [
 *         Layouts::CONTENT_SIDEBAR_SIDEBAR,
 *         Layouts::SIDEBAR_CONTENT_SIDEBAR,
 *         Layouts::SIDEBAR_SIDEBAR_CONTENT,
 *     ],
 *     Layouts::DEFAULTLAYOUT => __genesis_return_full_width_content()
 * ];
 * ```
 *
 * And then:
 *
 * ```
 * return [
 *     'Gamajo' => [
 *         'Theme' => [
 *             GenesisThemeToolkit::LAYOUTS => $gamajo_genesis_layouts,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\GenesisThemeToolkit
 */
class Layouts extends Brick
{
    const REGISTER   = 'register';
    const UNREGISTER = 'unregister';
    const DEFAULTLAYOUT = 'default-layout';

    const FULL_WIDTH_CONTENT = 'full-width-content';
    const CONTENT_SIDEBAR = 'content-sidebar';
    const SIDEBAR_CONTENT = 'sidebar-content';
    const CONTENT_SIDEBAR_SIDEBAR = 'content-sidebar-sidebar';
    const SIDEBAR_CONTENT_SIDEBAR = 'sidebar-content-sidebar';
    const SIDEBAR_SIDEBAR_CONTENT = 'sidebar-sidebar-content';

    /**
     * Apply layout registrations and unregistrations.
     */
    public function apply()
    {
        if ($this->config->hasKey(self::REGISTER)) {
            $registerConfig = $this->config->getSubConfig(self::REGISTER);
            $this->register($registerConfig->getArrayCopy());
        }

        if ($this->config->hasKey(self::UNREGISTER)) {
            $unregisterConfig = $this->config->getSubConfig(self::UNREGISTER);
            $this->unregister($unregisterConfig->getArrayCopy());
        }

        if ($this->config->hasKey(self::DEFAULTLAYOUT)) {
            $this->setDefault($this->config->getKey(self::DEFAULTLAYOUT));
        }
    }

    /**
     * Register a new Genesis layout for given keys and values.
     *
     * @param array $args Keys and their values.
     */
    protected function register(array $args)
    {
        array_walk($args, function (array $value, string $key) {
            \genesis_register_layout($key, $value);
        });
    }

    /**
     * Unregister a Genesis layout for given keys.
     *
     * @param array $args Keys.
     */
    protected function unregister(array $args)
    {
        array_walk($args, function (string $value) {
            \genesis_unregister_layout($value);
        });
    }

    /**
     * Set a default Genesis layout.
     *
     * Allow a user to identify a layout as being the default layout on a new install, as well as serve as the fallback layout.
     *
     * @param string $layout Layout handle.
     */
    protected function setDefault(string $layout)
    {
        \genesis_set_default_layout($layout);
    }
}
