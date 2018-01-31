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
 * Time: 01:53 PM
 */

new WPSFramework_Taxonomy(array(
    array(
        'id'       => '_custom_taxonomy_options',
        'taxonomy' => 'category',
        // category, post_tag or your custom taxonomy name
        'fields'   => array(
            array(
                'id'       => 'section_1_text',
                'type'     => 'text',
                'title'    => 'Text Field',
                'validate' => 'required',

            ),
            array(
                'id'       => 'section_1_textarea',
                'type'     => 'textarea',
                'title'    => 'Textarea Field',
                'validate' => 'required',
            ),
        ),
    ),

    array(
        'id'       => '_custom_taxonomy_options',
        'taxonomy' => 'post_tag',
        // category, post_tag or your custom taxonomy name
        'fields'   => array(
            array(
                'id'    => 'section_1_text',
                'type'  => 'text',
                'title' => 'Text Field',
            ),
        ),
    ),
));