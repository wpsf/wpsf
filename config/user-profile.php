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
 * Date: 16-01-2018
 * Time: 02:41 PM
 */

new WPSFramework_User_Profile(array(
    array(
        'id'     => '_custom_user_meta',
        'title'  => 'Custom User meta',
        'fields' => array(
            array(
                'id'      => 'unique_color_scheme',
                'title'   => 'Color Scheme',
                'type'    => 'color_scheme',
                'options' => array(
                    'Cool White'  => array( '222', '333', '0073aa', '#00a0d2' ),
                    'Blue Red'    => array( 'e5e5e5', '999', 'd64e07', '04a4cc' ),
                    'Blue White'  => array( 'e5e5e5', '999', 'd64e07', '04a4cc', '222', '333' ),
                    'Cool White1' => array( '222', '333', '0073aa', '#00a0d2' ),
                    'Blue Red1'   => array( 'e5e5e5', '999', 'd64e07', '04a4cc' ),
                    'Blue White1' => array( 'e5e5e5', '999', 'd64e07', '04a4cc', '222', '333' ),
                ),
            ),
            array(
                'type'     => 'text',
                'title'    => 'Text Field',
                'validate' => 'required',
                'id'       => 'section_1_text_field',
            ),
            array(
                'type'  => 'switcher',
                'title' => 'Switcher',
                'id'    => 'section_1_switcher_field',
            ),
        ),
    ),

    array(
        'id'     => '_custom_user_meta_1',
        'style'  => 'modern',
        'title'  => 'Custom User meta',
        'fields' => array(
            array(
                'type'     => 'text',
                'title'    => 'Text Field',
                'validate' => 'required',
                'id'       => 'section_1_text_field',
            ),
        ),
    ),
));