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
 * Date: 15-01-2018
 * Time: 04:47 PM
 */


new WPSFramework_Quick_Edit(array(

    /* The below code works only when WooCommerce is installed */
    array(
        'id'        => '_wpsf_wc_metabox1',
        'post_type' => 'product',
        'column'    => 'product_type',
        'fields'    => array(

            array(
                'id'    => 'section_4_switcher',
                'type'  => 'switcher',
                'after'    => '<br/><p>This switcher field is from products metabox.</p>',
                'title' => 'Upload A File ?',
                'label' => 'Yes, Please do it.',
            ),
            array(
                'id'      => 'section4_multi_checkbox',
                'type'    => 'checkbox',
                'after'    => '<p>This checkbox field is from products metabox.</p>',
                'title'   => 'Checkbox',
                'options' => array(
                    'option1' => 'Option 1',
                    'option2' => 'Option 2',
                    'option3' => 'Option 3',
                ),
            ),
        ),
    ),


));