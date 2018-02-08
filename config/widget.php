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

/**
 * Created by PhpStorm.
 * User: varun
 * Date: 25-01-2018
 * Time: 02:56 PM
 */
class wpsf_sample_1 extends WPSFramework_Widget {
    public function __construct() {
        parent::__construct('wpsf_sample_1', 'WPSF Sample 1');
    }

    /**
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance) {
    }

    /**
     * @return array
     */
    public function form_fields() {
        return array(
            array(
                'id'       => 'title',
                'type'     => 'text',
                'validate' => 'required',
                'title'    => __("Title"),
            ),array(
                'id'       => 'image',
                'type'     => 'upload',
                'title'    => __("Upload"),
            ),
        );
    }
}
