<?php
/**
 * This file contains elements for managing Genesis footer creds text.
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
 * Sets the footer credits content.
 *
 * Example config:
 *
 * ```
 * $gamajo_genesis_footer_creds = [
 *     FooterCreds::CREDS => sprintf(
 *         // translators: %s: URL for Incipio.
 *         __( 'Built on <a href="%s" rel="nofollow">Incipio</a> theme for Genesis Framework.', 'your-theme' ),
 *         esc_url( 'https://gamajo.com/incipio' )
 *     ),
 * ];
 * ```
 *
 * And then:
 *
 * ```
 * return [
 *     'Gamajo' => [
 *         'Theme' => [
 *             GenesisThemeToolkit::FOOTERCREDS => $gamajo_genesis_footer_creds,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\GenesisThemeToolkit
 */
class FooterCreds extends Brick
{
    const CREDS = 'creds';

    /**
     * Apply filters and hooks.
     */
    public function apply()
    {
        add_filter('genesis_footer_creds_text', [$this, 'credsText']);
    }

    /**
     * Change the footer text.
     *
     * @return string Footer credentials.
     */
    public function credsText(): string
    {
        return $this->config->getKey('creds');
    }
}
