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
 * Field: Backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Option_backup extends WPSFramework_Options {
    /**
     * WPSFramework_Option_backup constructor.
     * @param        $field
     * @param string $value
     * @param string $unique
     */
    public function __construct($field, $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output() {
        echo $this->element_before();

        echo '<textarea name="' . $this->unique . '[import]"' . $this->element_class() . $this->element_attributes() . '></textarea>';
        submit_button(esc_html__('Import a Backup', 'wpsf-framework'), 'primary wpsf-import-backup', 'backup', FALSE);
        echo '<small>( ' . esc_html__('copy-paste your backup string here', 'wpsf-framework') . ' )</small>';

        echo '<hr />';

        echo '<textarea name="_nonce"' . $this->element_class() . $this->element_attributes() . ' disabled="disabled">' . wpsf_encode_string(get_option($this->unique)) . '</textarea>';
        echo '<a href="' . admin_url('admin-ajax.php?action=wpsf-export-options') . '" class="button button-primary" target="_blank">' . esc_html__('Export and Download Backup', 'wpsf-framework') . '</a>';
        echo '<small>-( ' . esc_html__('or', 'wpsf-framework') . ' )-</small>';
        submit_button(esc_html__('Reset All Options', 'wpsf-framework'), 'wpsf-warning-primary wpsf-reset-confirm', $this->unique . '[resetall]', FALSE);
        echo '<small class="wpsf-text-warning">' . esc_html__('Please be sure for reset all of framework options.', 'wpsf-framework') . '</small>';

        echo $this->element_after();
    }
}
