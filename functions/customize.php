<?php
/*-------------------------------------------------------------------------------------------------
 - This file is part of the WPSF package.                                                         -
 - This package is Open Source Software. For the full copyright and license                       -
 - information, please view the LICENSE file which was distributed with this                      -
 - source code.                                                                                   -
 -                                                                                                -
 - @package    WPSF                                                                               -
 - @author     Varun Sridharan <varunsridharan23@gmail.com>                                       -
 -------------------------------------------------------------------------------------------------*/

if( ! defined('ABSPATH') ) {
    die ();
} // Cannot access pages directly.

/**
 *
 * WP Customize custom controls
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WP_Customize_wpsf_field_Control extends WP_Customize_Control {
    public $unique = '';
    public $type = 'wpsf_field';
    public $options = array();

    public function render_content() {
        $this->options ['id'] = $this->id;
        $this->options ['default'] = $this->setting->default;
        $this->options ['attributes'] ['data-customize-setting-link'] = $this->settings ['default']->id;
        echo wpsf_add_element($this->options, $this->value(), $this->unique);
    }
}
