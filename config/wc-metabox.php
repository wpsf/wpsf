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
 * Date: 08-01-2018
 * Time: 07:25 PM
 */

$fields = array(
    array(
        'id'       => 'section_4_texts',
        'type'     => 'text',
        'title'    => 'Text Field With Help',
        'help'     => 'Some help text here',
        'hide'     => 'downloadable|virtual',
        'desc'     => 'This field will be hidden if product type selected as virtual / downloadable',
        'validate' => 'required',
    ),

    array(
        'id'    => 'section_4_textarea',
        'type'  => 'textarea',
        'title' => 'Textarea Field',
    ),

    array(
        'id'    => 'section_4_switcher',
        'type'  => 'switcher',
        'after' => '<br/><p>This switcher field will be shown in products quick edit view.</p>',
        'title' => 'Upload A File ?',
        'label' => 'Yes, Please do it.',
    ),

    array(
        'id'         => 'section_4_upload',
        'type'       => 'upload',
        'title'      => 'Upload Field',
        'dependency' => array(
            'section_4_switcher',
            '==',
            'true',
        ),
    ),

    array(
        'id'      => 'section_4_select',
        'type'    => 'select',
        'title'   => 'Select',
        'options' => array(
            'option1' => 'Option 1',
            'option2' => 'Option 2',
            'option3' => 'Option 3',
        ),
    ),

    array(
        'id'       => 'section_4_multi_select',
        'type'     => 'select',
        'title'    => 'Multi Select',
        'multiple' => TRUE,
        'options'  => array(
            'option1' => 'Option 1',
            'option2' => 'Option 2',
            'option3' => 'Option 3',
        ),
    ),

    array(
        'id'      => 'section4_multi_radio',
        'type'    => 'radio',
        'title'   => 'Radio',
        'options' => array(
            'option1' => 'Option 1',
            'option2' => 'Option 2',
            'option3' => 'Option 3',
        ),
    ),

    array(
        'id'      => 'section4_multi_checkbox',
        'type'    => 'checkbox',
        'after'   => '<p>This checkbox field will be shown in products quick edit view.</p>',
        'title'   => 'Checkbox',
        'options' => array(
            'option1' => 'Option 1',
            'option2' => 'Option 2',
            'option3' => 'Option 3',
        ),
    ),
);

new WPSFramework_WC_Metabox(array(
    array(
        'id'       => '_wpsf_wc_metabox1',
        'sections' => array(
            array(
                'group'    => 'general',
                'wc_style' => FALSE,
                'fields'   => $fields,
            ),

            array(
                'name'     => 'section1',
                'title'    => 'WPSF Section1',
                'wc_style' => FALSE,
                'hide'     => 'downloadable|virtual',
                'fields'   => array(
                    array(
                        'class'   => 'info',
                        'type'    => 'notice',
                        'content' => "This section will be hidden if product type selected as downloadable / virtual",
                    ),
                    array(
                        'type'  => 'text',
                        'title' => 'Sample Text',
                        'desc'  => 'This text box will be hidden if product type selected as grouped',
                        'hide'  => 'grouped',
                    ),
                ),
            ),

            array(
                'name'         => 'section_variable',
                'title'        => 'WPSF Variable',
                'is_variation' => TRUE,
                'wc_style'     => FALSE,
                'hide'         => 'downloadable|virtual',
                'fields'       => array(
                    array(
                        'class'   => 'info',
                        'type'    => 'notice',
                        'content' => "This section will shown for both parent product and child products (variations)   ",
                    ),
                    array(
                        'id'    => '_wpsf_wc_variation_1',
                        'type'  => 'text',
                        'title' => 'Sample Text',
                        'desc'  => 'This text box will be hidden if product type selected as grouped',
                        'hide'  => 'grouped',
                    ),
                ),
            ),
        ),
    ),
));