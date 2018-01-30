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

    public function widget($args, $instance) {
    }

    public function form_fields() {
        return array(

            array(
                'type'            => 'fieldset',
                'id'              => 'sample_group',
                'button_title'    => 'Add ME+',
                'accordion_title' => " HIIIIIIIIIII",
                'fields'          => array(
                    array(
                        'id'    => 'text',
                        'type'  => 'text',
                        'title' => 'GP Txt',
                    ),
                    array(
                        'id'    => 'upload',
                        'type'  => 'upload',
                        'title' => 'GP upload',
                    ),
                ),
            ),

            array(
                'id'       => 'tab',
                'type'     => 'tab',
                'sections' => array(
                    array(
                        'name'   => 'section1',
                        'title'  => 'S1',
                        'icon'   => 'fa fa-star',
                        'fields' => array(
                            array(
                                'id'    => 'title',
                                'type'  => 'text',
                                'validate' => 'required',
                                'title' => __("Title"),
                            ),
                        ),
                    ),

                    array(
                        'name'   => 'section2',
                        'title'  => 'S2',
                        'icon'   => 'fa fa-star',
                        'fields' => array(
                            array(
                                'id'    => 'title2',
                                'type'  => 'textarea',
                                'title' => __("Title2"),
                            ),

                            array(
                                'id'    => 'gallery_1',
                                'type'  => 'gallery',
                                'title' => 'Gallery',
                            ),
                        ),
                    ),
                ),

            ),

            array(
                'id'    => 'title',
                'type'  => 'text',
                'validate' => 'required',
                'title' => __("Title"),
            ),

            array(
                'id'    => 'color_picker',
                'type'  => 'color_picker',
                'title' => 'Color',
            ),

            array(
                'id'    => 'switcher',
                'type'  => 'switcher',
                'title' => 'switcher',
            ),

            array(
                'id'    => 'icon',
                'type'  => 'icon',
                'title' => 'icon',
            ),

        );
    }
}
