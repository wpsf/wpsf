<?php if( ! defined('ABSPATH') ) {
    die;
} // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// CUSTOMIZE SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

// -----------------------------------------
// Customize Core Fields                   -
// -----------------------------------------
$options[] = array(
    'name'     => 'wp_core_fields',
    'title'    => 'WP Core Fields',
    'settings' => array(

        // color
        array(
            'name'    => 'color_option_with_default',
            'default' => '#d80039',
            'control' => array(
                'label' => 'Color',
                'type'  => 'color',
            ),
        ),

        // text
        array(
            'name'    => 'text_option',
            'control' => array(
                'label' => 'Text',
                'type'  => 'text',
            ),
        ),

        // text with default
        array(
            'name'    => 'text_option_with_default',
            'default' => 'bla bla bla',
            'control' => array(
                'label' => 'Text with Default',
                'type'  => 'text',
            ),
        ),

        // textarea
        array(
            'name'    => 'textarea_option',
            'control' => array(
                'label' => 'Textarea',
                'type'  => 'textarea',
            ),
        ),

        // checkbox
        array(
            'name'    => 'checkbox_option',
            'control' => array(
                'label' => 'Checkbox',
                'type'  => 'checkbox',
            ),
        ),

        // radio
        array(
            'name'    => 'radio_option',
            'control' => array(
                'label'   => 'Radio',
                'type'    => 'radio',
                'choices' => array(
                    'key1' => 'value 1',
                    'key2' => 'value 2',
                    'key3' => 'value 3',
                ),
            ),
        ),

        // select
        array(
            'name'    => 'select_option',
            'control' => array(
                'label'   => 'Select',
                'type'    => 'select',
                'choices' => array(
                    ''     => '- Select a value -',
                    'key1' => 'value 1',
                    'key2' => 'value 2',
                    'key3' => 'value 3',
                ),
            ),
        ),

        // dropdown-pages
        array(
            'name'    => 'dropdown_pages_option',
            'control' => array(
                'label' => 'Dropdown-Pages',
                'type'  => 'dropdown-pages',
            ),
        ),

        // upload
        array(
            'name'    => 'upload_option',
            'control' => array(
                'label' => 'Upload',
                'type'  => 'upload',
            ),
        ),

        // image
        array(
            'name'    => 'image_option',
            'control' => array(
                'label' => 'Image',
                'type'  => 'image',
            ),
        ),

        // media
        array(
            'name'    => 'media_option',
            'control' => array(
                'label' => 'Media',
                'type'  => 'media',
            ),
        ),

    ),
);

// -----------------------------------------
// Customize WPSF Fields               -
// -----------------------------------------
$options[] = array(
    'name'     => 'wpsf_fields',
    'title'    => 'WPSF Framework Fields',
    'settings' => array(

        // wpsf color picker
        array(
            'name'    => 'wpsf_color_picker',
            'default' => '#3498db',
            'control' => array(
                'type'    => 'wpsf_field',
                'options' => array(
                    'type'  => 'color_picker',
                    'title' => 'Color Picker Field',
                ),
            ),
        ),

        // wpsf text
        array(
            'name'    => 'wpsf_text',
            'control' => array(
                'type'    => 'wpsf_field',
                'options' => array(
                    'type'  => 'text',
                    'desc'  => 'WPSF Switcher Field',
                    'title' => 'Text Field',
                ),
            ),
        ),

        // wpsf textarea
        array(
            'name'    => 'wpsf_textarea',
            'control' => array(
                'type'    => 'wpsf_field',
                'options' => array(
                    'type'  => 'textarea',
                    'title' => 'Text Area',
                ),
            ),
        ),

        // wpsf switcher
        array(
            'name'    => 'wpsf_switcher',
            'control' => array(
                'type'    => 'wpsf_field',
                'options' => array(
                    'type'  => 'switcher',
                    'title' => 'WPSF Switcher Field',
                    'label' => 'Do you want to ?',
                    'help'  => 'Lorem Ipsum Dollar',
                ),
            ),
        ),

        // wpsf upload
        array(
            'name'    => 'wpsf_upload',
            'control' => array(
                'type'    => 'wpsf_field',
                'options' => array(
                    'type'  => 'upload',
                    'title' => 'WPSF Upload Field',
                ),
            ),
        ),

        // wpsf image
        array(
            'name'    => 'wpsf_image',
            'control' => array(
                'type'    => 'wpsf_field',
                'options' => array(
                    'type'  => 'image',
                    'title' => 'WPSF Image Field',
                ),
            ),
        ),

        // wpsf gallery
        array(
            'name'    => 'wpsf_gallery',
            'control' => array(
                'type'    => 'wpsf_field',
                'options' => array(
                    'type'  => 'gallery',
                    'title' => 'WPSF Gallery Field',
                ),
            ),
        ),

        // wpsf icon
        array(
            'name'    => 'wpsf_icon',
            'control' => array(
                'type'    => 'wpsf_field',
                'options' => array(
                    'type'  => 'icon',
                    'title' => 'WPSF Icon Field',
                ),
            ),
        ),

        // wpsf image select
        array(
            'name'    => 'wpsf_image_select',
            'control' => array(
                'type'    => 'wpsf_field',
                'options' => array(
                    'type'    => 'image_select',
                    'title'   => 'WPSF Image Select Field',
                    'options' => array(
                        'value-1' => 'http://codestarframework.com/assets/images/placeholder/65x65-2ecc71.gif',
                        'value-2' => 'http://codestarframework.com/assets/images/placeholder/65x65-e74c3c.gif',
                        'value-3' => 'http://codestarframework.com/assets/images/placeholder/65x65-3498db.gif',
                    ),
                    'radio'   => TRUE,
                ),
            ),
        ),

        // wpsf heading
        array(
            'name'    => 'wpsf_heading',
            'control' => array(
                'type'    => 'wpsf_field',
                'options' => array(
                    'type'    => 'heading',
                    'content' => 'WPSF Heading',
                ),
            ),
        ),

        // wpsf subheading
        array(
            'name'    => 'wpsf_subheading',
            'control' => array(
                'type'    => 'wpsf_field',
                'options' => array(
                    'type'    => 'subheading',
                    'content' => 'WPSF Sub-Heading',
                ),
            ),
        ),

        // wpsf notice:success
        array(
            'name'    => 'wpsf_notice_success',
            'control' => array(
                'type'    => 'wpsf_field',
                'options' => array(
                    'type'    => 'notice',
                    'class'   => 'success',
                    'content' => 'Notice Success: Lorem Ipsum...',
                ),
            ),
        ),

        // wpsf notice:info
        array(
            'name'    => 'wpsf_notice_info',
            'control' => array(
                'type'    => 'wpsf_field',
                'options' => array(
                    'type'    => 'notice',
                    'class'   => 'info',
                    'content' => 'Notice Info: Lorem Ipsum...',
                ),
            ),
        ),

        // wpsf notice:danger
        array(
            'name'    => 'wpsf_notice_danger',
            'control' => array(
                'type'    => 'wpsf_field',
                'options' => array(
                    'type'    => 'notice',
                    'class'   => 'danger',
                    'content' => 'Notice Danger: Lorem Ipsum...',
                ),
            ),
        ),

        // wpsf content
        array(
            'name'    => 'wpsf_content',
            'control' => array(
                'type'    => 'wpsf_field',
                'options' => array(
                    'type'    => 'content',
                    'content' => 'Simple Content Field...',
                ),
            ),
        ),

    ),
);

// -----------------------------------------
// Customize Panel Options Fields          -
// -----------------------------------------
$options[] = array(
    'name'        => 'wpsf_panel_1',
    'title'       => 'WPSF Framework Panel',
    'description' => 'WPSF customize panel description.',
    'sections'    => array(

        // begin: section
        array(
            'name'     => 'section_1',
            'title'    => 'Section 1',
            'settings' => array(

                array(
                    'name'    => 'color_option_1',
                    'default' => '#ffbc00',
                    'control' => array(
                        'type'    => 'wpsf_field',
                        'options' => array(
                            'type'  => 'color_picker',
                            'title' => 'Color Option 1',
                        ),
                    ),
                ),

                array(
                    'name'    => 'color_option_2',
                    'default' => '#2ecc71',
                    'control' => array(
                        'type'    => 'wpsf_field',
                        'options' => array(
                            'type'  => 'color_picker',
                            'title' => 'Color Option 2',
                        ),
                    ),
                ),

                array(
                    'name'    => 'color_option_3',
                    'default' => '#e74c3c',
                    'control' => array(
                        'type'    => 'wpsf_field',
                        'options' => array(
                            'type'  => 'color_picker',
                            'title' => 'Color Option 3',
                        ),
                    ),
                ),

                array(
                    'name'    => 'color_option_4',
                    'default' => '#3498db',
                    'control' => array(
                        'type'    => 'wpsf_field',
                        'options' => array(
                            'type'  => 'color_picker',
                            'title' => 'Color Option 4',
                        ),
                    ),
                ),

                array(
                    'name'    => 'color_option_5',
                    'default' => '#555555',
                    'control' => array(
                        'type'    => 'wpsf_field',
                        'options' => array(
                            'type'  => 'color_picker',
                            'title' => 'Color Option 5',
                        ),
                    ),
                ),

            ),
        ),
        // end: section

        // begin: section
        array(
            'name'     => 'section_2',
            'title'    => 'Section 2',
            'settings' => array(

                array(
                    'name'    => 'text_option_1',
                    'control' => array(
                        'type'    => 'wpsf_field',
                        'options' => array(
                            'type'  => 'text',
                            'title' => 'Text Option 1',
                        ),
                    ),
                ),

                array(
                    'name'    => 'text_option_2',
                    'control' => array(
                        'type'    => 'wpsf_field',
                        'options' => array(
                            'type'  => 'text',
                            'title' => 'Text Option 2',
                        ),
                    ),
                ),

                array(
                    'name'    => 'text_option_3',
                    'control' => array(
                        'type'    => 'wpsf_field',
                        'options' => array(
                            'type'  => 'text',
                            'title' => 'Text Option 3',
                        ),
                    ),
                ),

            ),
        ),
        // end: section

    ),
    // end: sections
);

new WPSFramework_Customize($options, '_wpsf_customizer_demo1');
new WPSFramework_Customize(array(
    array(
        'name'     => '1wp_core_fields',
        'title'    => '1WP Core Fields',
        'settings' => array(

            // color
            array(
                'name'    => '1color_option_with_default',
                'default' => '#d80039',
                'control' => array(
                    'label' => 'Color',
                    'type'  => 'color',
                ),
            ),

        ),
    ),
), '_wpsf_customizer_demo2');