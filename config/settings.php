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
 * Date: 09-01-2018
 * Time: 07:57 PM
 */

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();
// ----------------------------------------
// a option section for options overview  -
// ----------------------------------------
$options[] = array(
    'name'   => 'overwiew',
    'title'  => 'Overview',
    'icon'   => 'fa fa-star',
    // begin: fields
    'fields' => array(
        array(
            'id'      => 'content_font',
            'type'    => 'typography_advanced',
            'title'   => __('Typography Advanced', ''),
            'chosen'  => TRUE,
            'select2' => FALSE,
            'default' => array(
                'family'  => 'Indie Flower',
                'variant' => 'regular',
                'font'    => 'google',
                'size'    => '20',
                'height'  => '18',
                'color'   => '#e2e2e2',
            ),
            'preview' => TRUE,
            //Enable or disable preview box
            //'preview_text' => 'hello world', //Replace preview text with any text you like.
        ),
        array(
            'id'      => 'unique_color_scheme',
            'title'   => 'Color Scheme',
            'type'    => 'color_scheme',
            'options' => array(
                'Cool Black' => array(
                    '222',
                    '333',
                    '0073aa',
                    '00a0d2',
                ),
                'Blue'       => array(
                    '096484',
                    '4796b3',
                    '52accc',
                    '74B6CE',
                    '222',
                ),
                'Sun Rise'   => array(
                    'b43c38',
                    'cf4944',
                    'dd823b',
                    'ccaf0b',
                ),
            ),
        ),
        // begin: a field
        array(
            'id'    => 'text_1',
            'type'  => 'text',
            'title' => 'Text',
            'limit' => 10,
        ),
        // end: a field
        array(
            'id'         => 'textarea_1',
            'type'       => 'textarea',
            'title'      => 'Textarea',
            'limit'      => 10,
            'limit_type' => 'word',
            'help'       => 'This option field is useful. You will love it!',
        ),
        array(
            'id'    => 'upload_1',
            'type'  => 'upload',
            'title' => 'Upload',
            'help'  => 'Upload a site logo for your branding.',
        ),
        array(
            'id'    => 'switcher_1',
            'type'  => 'switcher',
            'title' => 'Switcher',
            'label' => 'You want to update for this framework ?',
        ),
        array(
            'id'      => 'color_picker_1',
            'type'    => 'color_picker',
            'title'   => 'Color Picker',
            'default' => '#3498db',
        ),
        array(
            'id'    => 'checkbox_1',
            'type'  => 'checkbox',
            'title' => 'Checkbox',
            'label' => 'Did you like this framework ?',
        ),
        array(
            'id'      => 'radio_1',
            'type'    => 'radio',
            'title'   => 'Radio',
            'options' => array(
                'yes' => 'Yes, Please.',
                'no'  => 'No, Thank you.',
            ),
            'help'    => 'Are you sure for this choice?',
        ),
        array(
            'id'             => 'select_1',
            'type'           => 'select',
            'title'          => 'Select',
            'options'        => array(
                'bmw'        => 'BMW',
                'mercedes'   => 'Mercedes',
                'volkswagen' => 'Volkswagen',
                'other'      => 'Other',
            ),
            'default_option' => 'Select your favorite car',
        ),
        array(
            'id'      => 'number_1',
            'type'    => 'number',
            'title'   => 'Number',
            'default' => '10',
            'after'   => ' <i class="cs-text-muted">$ (dollars)</i>',
        ),
        array(
            'id'      => 'image_select_1',
            'type'    => 'image_select',
            'title'   => 'Image Select',
            'options' => array(
                'value-1' => 'http://codestarframework.com/assets/images/placeholder/100x80-2ecc71.gif',
                'value-2' => 'http://codestarframework.com/assets/images/placeholder/100x80-e74c3c.gif',
                'value-3' => 'http://codestarframework.com/assets/images/placeholder/100x80-ffbc00.gif',
                'value-4' => 'http://codestarframework.com/assets/images/placeholder/100x80-3498db.gif',
                'value-5' => 'http://codestarframework.com/assets/images/placeholder/100x80-555555.gif',
            ),
        ),
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => 'This is info notice field for your highlight sentence.',
        ),
        array(
            'id'    => 'background_1',
            'type'  => 'background',
            'title' => 'Background',
        ),
        array(
            'type'    => 'notice',
            'class'   => 'warning',
            'content' => 'This is info warning field for your highlight sentence.',
        ),
        array(
            'id'    => 'icon_1',
            'type'  => 'icon',
            'title' => 'Icon',
            'desc'  => 'Some description here for this option field.',
        ),
        array(
            'id'    => 'text_2',
            'type'  => 'text',
            'title' => 'Text',
            'desc'  => 'Some description here for this option field.',
        ),
        array(
            'id'        => 'textarea_2',
            'type'      => 'textarea',
            'title'     => 'Textarea',
            'info'      => 'Some information here for this option field.',
            'shortcode' => TRUE,
        ),
        array(
            'id'    => 'image_size',
            'type'  => 'image_size',
            'title' => 'Image Size',
        ),
        array(
            'id'    => 'links',
            'type'  => 'links',
            'title' => 'WP Link Picker',
        ),
    ),
    // end: fields
);

// ------------------------------
// a seperator                  -
// ------------------------------
$options[] = array(
    'name'  => 'seperator_0',
    'title' => 'Input / UI Fields',
    'icon'  => 'fa fa-bookmark',
);
// ------------------------------
// a option section with tabs   -
// ------------------------------
$options[] = array(
    'name'     => 'options',
    'title'    => 'Options',
    'icon'     => 'fa fa-plus-circle',
    'sections' => array(
        // -----------------------------
        // begin: text options         -
        // -----------------------------
        array(
            'name'   => 'text_options',
            'title'  => 'Text',
            'icon'   => 'fa fa-check',
            // begin: fields
            'fields' => array(


                // begin: a field
                array(
                    'id'    => 'unique_text_1',
                    'type'  => 'text',
                    'title' => 'Text Field',
                ),
                // end: a field
                array(
                    'id'    => 'unique_text_2',
                    'type'  => 'text',
                    'title' => 'Text Field with Description',
                    'desc'  => 'Lets write some description for this text field.',
                ),
                array(
                    'id'    => 'unique_text_3',
                    'type'  => 'text',
                    'title' => 'Text Field with Help',
                    'help'  => 'I am a Tooltip helper. This field important for something.',
                ),
                array(
                    'id'      => 'unique_text_4',
                    'type'    => 'text',
                    'title'   => 'Text Field with Default',
                    'default' => 'some default value bla bla bla',
                ),
                array(
                    'id'         => 'unique_text_5',
                    'type'       => 'text',
                    'title'      => 'Text Field with Placeholder',
                    'attributes' => array(
                        'placeholder' => 'do stuff...',
                    ),
                ),
                array(
                    'id'    => 'unique_text_6',
                    'type'  => 'text',
                    'title' => 'Text Field with After-text',
                    'after' => ' <i class="cs-text-muted">( this option is optional )</i>',
                ),
                array(
                    'id'     => 'unique_text_7',
                    'type'   => 'text',
                    'title'  => 'Text Field with Before-text',
                    'before' => '<i class="cs-text-muted">( important )</i> ',
                ),
                array(
                    'id'    => 'unique_text_8',
                    'type'  => 'text',
                    'title' => 'Text Field with After-block-text',
                    'after' => '<p class="cs-text-info">Information: There is some description for option.</p> ',
                ),
                array(
                    'id'         => 'unique_text_9',
                    'type'       => 'text',
                    'title'      => 'Text Field with Ready-Only',
                    'attributes' => array(
                        'readonly' => 'only-key',
                    ),
                    'default'    => 'info@domain.com',
                ),
                array(
                    'id'         => 'unique_text_10',
                    'type'       => 'text',
                    'title'      => 'Text Field with Maxlength (5)',
                    'attributes' => array(
                        'maxlength' => '5',
                    ),
                    'default'    => 'Hello',
                ),
                array(
                    'id'         => 'unique_text_11',
                    'type'       => 'text',
                    'title'      => 'Text Field with Custom Style',
                    'attributes' => array(
                        'style' => 'width: 175px; height: 40px; border-color: #93C054;',
                    ),
                    'after'      => '<p class="cs-text-muted">There is custom css <strong>style="width: 175px; height: 40px; border-color: #93C054;"</strong></p>',
                ),
                array(
                    'id'         => 'unique_text_12',
                    'type'       => 'text',
                    'title'      => 'Text Field with Custom Style',
                    'attributes' => array(
                        'style' => 'width: 100%;',
                    ),
                    'after'      => '<p class="cs-text-muted">There is custom css <strong>style="width: 100%;"</strong></p>',
                ),
                array(
                    'id'     => 'unique_text_13',
                    'type'   => 'text',
                    'before' => '<h4>Text Field without left title</h4>',
                    'after'  => '<p class="cs-text-muted">This Text Field do not using left title, just using before text here. also you can remove it.</h4>',
                ),
            ),
            // end: fields
        ),
        // end: text options
        // -----------------------------
        // begin: textarea options     -
        // -----------------------------
        array(
            'name'   => 'textarea_options',
            'title'  => 'Textarea',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'    => 'unique_textarea_1',
                    'type'  => 'textarea',
                    'title' => 'Simple Textarea',
                ),
                array(
                    'id'        => 'unique_textarea_1_1',
                    'type'      => 'textarea',
                    'title'     => 'Textarea with Shortcoder',
                    'shortcode' => TRUE,
                ),
                array(
                    'id'    => 'unique_textarea_2',
                    'type'  => 'textarea',
                    'title' => 'Textarea Field with Description',
                    'desc'  => 'Lets write some description for this textarea field.',
                ),
                array(
                    'id'    => 'unique_textarea_3',
                    'type'  => 'textarea',
                    'title' => 'Textarea Field with Help',
                    'help'  => 'I am a Tooltip helper. This field important for something.',
                ),
                array(
                    'id'      => 'unique_textarea_4',
                    'type'    => 'textarea',
                    'title'   => 'Textarea Field with Default',
                    'default' => 'some default value bla bla bla',
                ),
                array(
                    'id'         => 'unique_textarea_5',
                    'type'       => 'textarea',
                    'title'      => 'Textarea Field with Placeholder',
                    'attributes' => array(
                        'placeholder' => 'do stuff...',
                    ),
                ),
                array(
                    'id'    => 'unique_textarea_6',
                    'type'  => 'textarea',
                    'title' => 'Textarea Field with After-text',
                    'after' => '<p class="cs-text-muted">Information: There is some description for option.</p> ',
                ),
                array(
                    'id'     => 'unique_textarea_7',
                    'type'   => 'textarea',
                    'title'  => 'Textarea Field with Before-text',
                    'before' => '<p class="cs-text-muted">Information: There is some description for option.</p> ',
                ),
                array(
                    'id'         => 'unique_textarea_8',
                    'type'       => 'textarea',
                    'title'      => 'Textarea Field with Before-text',
                    'attributes' => array(
                        'rows' => 10,
                    ),
                    'after'      => '<p class="cs-text-muted">custom textarea attribute rows=10</p> ',
                ),
                array(
                    'id'     => 'unique_textarea_13',
                    'type'   => 'textarea',
                    'before' => '<h4>Textarea Field without left title</h4>',
                    'after'  => '<p class="cs-text-muted">This Textarea Field do not using left title, just using before text here. also you can remove it.</h4>',
                ),
            ),
        ),
        // end: textarea options
        // -----------------------------
        // begin: checkbox options     -
        // -----------------------------
        array(
            'name'   => 'checkbox_options',
            'title'  => 'Checkbox',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'    => 'unique_checkbox_1',
                    'type'  => 'checkbox',
                    'title' => 'Checkbox',
                    'label' => 'Yes, Please.',
                ),
                array(
                    'id'      => 'unique_checkbox_2',
                    'type'    => 'checkbox',
                    'title'   => 'Checkbox with Default Value',
                    'label'   => 'Would you like something ?',
                    'default' => TRUE,
                ),
                array(
                    'id'    => 'unique_checkbox_3',
                    'type'  => 'checkbox',
                    'title' => 'Checkbox Field with Help',
                    'label' => 'I am an checkbox',
                    'help'  => 'I am a Tooltip helper. This field important for something.',
                ),
                array(
                    'id'      => 'unique_checkbox_4',
                    'type'    => 'checkbox',
                    'title'   => 'Checkbox Field with Options',
                    'options' => array(
                        'blue'   => array(
                            'label'      => 'Blue',
                            'disabled'   => TRUE,
                            'attributes' => array( 'data-help' => 'yes' ),
                        ),
                        'green'  => 'Green',
                        'yellow' => 'Yellow',
                    ),
                ),

                array(
                    'id'      => 'unique_checkbox_group_4',
                    'type'    => 'checkbox',
                    'title'   => 'Checkbox Field with Group Options',
                    'options' => array(
                        'Group 1' => array(
                            'blue'   => array(
                                'label'    => 'Blue',
                                'disabled' => TRUE,
                            ),
                            'green'  => 'Green',
                            'yellow' => 'Yellow',
                        ),
                        'Group 2' => array(
                            'red'   => 'Red',
                            'black' => 'Black',
                            'white' => 'White',
                        ),
                    ),
                ),
                array(
                    'id'      => 'unique_checkbox_5',
                    'type'    => 'checkbox',
                    'title'   => 'Checkbox Field with Options and Default',
                    'options' => array(
                        'bmw'      => 'BMW',
                        'mercedes' => 'Mercedes',
                        'jaguar'   => 'Jaguar',
                    ),
                    'default' => 'bmw',
                ),
                array(
                    'id'      => 'unique_checkbox_6',
                    'type'    => 'checkbox',
                    'title'   => 'Checkbox Field with Options Horizontal',
                    'class'   => 'horizontal',
                    'options' => array(
                        'blue'   => 'Blue',
                        'green'  => 'Green',
                        'yellow' => 'Yellow',
                        'red'    => 'Red',
                        'black'  => 'Black',
                    ),
                    'default' => array(
                        'green',
                        'yellow',
                        'red',
                    ),
                ),
                array(
                    'fields'          => array(
                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => 'Option1',
                                'option2' => 'Option2',
                                'option3' => 'Option3',
                            ),
                            'class'   => 'icheck horizontal',
                            'id'      => 'primary',
                            'type'    => 'checkbox',
                            'title'   => 'Default Style',
                        ),
                        array(
                            'default' => 'option2',
                            'options' => array(
                                'option1' => 'Option1',
                                'option2' => 'Option2',
                                'option3' => 'Option3',
                            ),
                            'class'   => 'icheck icheck-primary horizontal',
                            'id'      => 'primary',
                            'type'    => 'checkbox',
                            'title'   => 'Primary Style',
                        ),
                        array(
                            'default' => 'option3',
                            'options' => array(
                                'option1' => 'Option1',
                                'option2' => 'Option2',
                                'option3' => 'Option3',
                            ),
                            'class'   => 'icheck icheck-success horizontal',
                            'id'      => 'success',
                            'type'    => 'checkbox',
                            'title'   => 'Success Style',
                        ),
                        array(
                            'default' => 'option2',
                            'options' => array(
                                'option1' => 'Option1',
                                'option2' => 'Option2',
                                'option3' => 'Option3',
                            ),
                            'class'   => 'icheck icheck-info horizontal',
                            'id'      => 'info',
                            'type'    => 'checkbox',
                            'title'   => 'info Style',
                        ),
                        array(
                            'default' => 'option2',
                            'options' => array(
                                'option1' => 'Option1',
                                'option2' => 'Option2',
                                'option3' => 'Option3',
                            ),
                            'class'   => 'icheck icheck-danger horizontal',
                            'id'      => 'danger',
                            'type'    => 'checkbox',
                            'title'   => 'danger Style',
                        ),
                        array(
                            'default' => 'option2',
                            'options' => array(
                                'option1' => 'Option1',
                                'option2' => 'Option2',
                                'option3' => 'Option3',
                            ),
                            'class'   => 'icheck icheck-danger horizontal',
                            'id'      => 'danger',
                            'type'    => 'checkbox',
                            'title'   => 'danger Style',
                        ),
                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => array(
                                    'label'      => 'Option1',
                                    'attributes' => array( 'class' => 'icheck icheck-success' ),
                                ),
                                'option2' => array(
                                    'label'      => 'Option2',
                                    'attributes' => array( 'class' => 'icheck icheck-primary' ),
                                ),
                                'option3' => array(
                                    'label'      => 'Option3',
                                    'attributes' => array( 'class' => 'icheck icheck-danger' ),
                                ),
                            ),
                            'class'   => 'icheck icheck-warning horizontal',
                            'id'      => 'multiple_style',
                            'type'    => 'checkbox',
                            'title'   => 'Multiple Style',
                        ),
                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => array(
                                    'label'      => 'Option1',
                                    'attributes' => array( 'class' => 'icheck icheck-success icheck-xs' ),
                                ),
                                'option2' => array(
                                    'label'      => 'Option2',
                                    'attributes' => array( 'class' => 'icheck icheck-primary ' ),
                                ),
                                'option3' => array(
                                    'label'      => 'Option3',
                                    'attributes' => array( 'class' => 'icheck icheck-danger icheck-lg' ),
                                ),
                            ),
                            'class'   => 'icheck icheck-warning horizontal',
                            'id'      => 'multiple_style',
                            'type'    => 'checkbox',
                            'title'   => 'Multiple Size',
                        ),

                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => array( 'label' => 'Option1', ),
                                'option2' => array( 'label' => 'Option2', ),
                                'option3' => array( 'label' => 'Option3', ),
                            ),
                            'class'   => 'icheck icheck-lg horizontal',
                            'id'      => 'large_size',
                            'type'    => 'checkbox',
                            'title'   => 'Large Size',
                        ),
                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => array( 'label' => 'Option1', ),
                                'option2' => array( 'label' => 'Option2', ),
                                'option3' => array( 'label' => 'Option3', ),
                            ),
                            'class'   => 'icheck icheck-sm horizontal',
                            'id'      => 'small_size',
                            'type'    => 'checkbox',
                            'title'   => 'small Size',
                        ),
                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => array( 'label' => 'Option1', ),
                                'option2' => array( 'label' => 'Option2', ),
                                'option3' => array( 'label' => 'Option3', ),
                            ),
                            'class'   => 'icheck icheck-rounded horizontal',
                            'id'      => 'rounded',
                            'type'    => 'checkbox',
                            'title'   => 'Rounded Size',
                        ),
                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => array( 'label' => 'Option1', ),
                                'option2' => array( 'label' => 'Option2', ),
                                'option3' => array( 'label' => 'Option3', ),
                            ),
                            'class'   => 'icheck icheck-lg icheck-rounded horizontal',
                            'id'      => 'large_rounded',
                            'type'    => 'checkbox',
                            'title'   => 'Large Rounded Size',
                        ),
                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => array( 'label' => 'Option1', ),
                                'option2' => array( 'label' => 'Option2', ),
                                'option3' => array( 'label' => 'Option3', ),
                            ),
                            'class'   => 'icheck icheck-sm icheck-rounded horizontal',
                            'id'      => 'small_rounded',
                            'type'    => 'checkbox',
                            'title'   => 'Small Rounded Size',
                        ),

                    ),
                    'id'              => 'styled_checkbox',
                    'type'            => 'accordion',
                    'accordion_title' => 'Styled Checkbox',
                ),
                array(
                    'id'      => 'unique_checkbox_7',
                    'type'    => 'checkbox',
                    'title'   => 'Checkbox Field with Pages',
                    'options' => 'pages',
                ),
                array(
                    'id'      => 'unique_checkbox_8',
                    'type'    => 'checkbox',
                    'title'   => 'Checkbox Field with Posts',
                    'options' => 'posts',
                ),
                array(
                    'id'      => 'unique_checkbox_9',
                    'type'    => 'checkbox',
                    'title'   => 'Checkbox Field with Categories',
                    'options' => 'categories',
                ),
                array(
                    'id'      => 'unique_checkbox_10',
                    'type'    => 'checkbox',
                    'title'   => 'Checkbox Field with Tags',
                    'options' => 'tags',
                ),
                array(
                    'id'         => 'unique_checkbox_11',
                    'type'       => 'checkbox',
                    'title'      => 'Checkbox Field with Pages',
                    'options'    => 'pages',
                    'query_args' => array(
                        'sort_order'  => 'desc',
                        'sort_column' => 'post_title',
                    ),
                    'after'      => '<p class="cs-text-muted"><strong>query_args:</strong> sort_order=desc, sort_column=post_title</p>',
                ),
                array(
                    'id'         => 'unique_checkbox_12',
                    'type'       => 'checkbox',
                    'title'      => 'Checkbox Field with CPT Posts',
                    'options'    => 'posts',
                    'query_args' => array(
                        'post_type' => 'your_post_type_name',
                    ),
                    'after'      => '<div class="cs-text-muted"><strong>query_args:</strong> post_type=your_post_type_name</div>',
                ),
                array(
                    'id'         => 'unique_checkbox_13',
                    'type'       => 'checkbox',
                    'title'      => 'Checkbox Field with CPT Categories',
                    'options'    => 'categories',
                    'query_args' => array(
                        'type'     => 'your_post_type_name',
                        'taxonomy' => 'your_taxonomy_name',
                    ),
                    'after'      => '<div class="cs-text-muted"><strong>query_args:</strong> post_type=your_post_type_name, taxonomy=your_taxonomy_name</div>',
                ),
                array(
                    'id'         => 'unique_checkbox_14',
                    'type'       => 'checkbox',
                    'title'      => 'Checkbox Field with CPT Tags',
                    'options'    => 'tags',
                    'query_args' => array(
                        'taxonomies' => 'your_taxonomy_name',
                        'order'      => 'asc',
                        'orderby'    => 'name',
                    ),
                    'after'      => '<div class="cs-text-muted"><strong>query_args:</strong> taxonomies=your_taxonomy_name, order=asc, orderby=name</div>',
                ),
            ),
        ),
        // end: checkbox options
        // -----------------------------
        // begin. radio options        -
        // -----------------------------
        array(
            'name'   => 'radio_options',
            'title'  => 'Radio',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'      => 'unique_radio_1',
                    'type'    => 'radio',
                    'title'   => 'Radio Field',
                    'options' => array(
                        'yes' => 'Yes, Please.',
                        'no'  => 'No, Thank you.',
                    ),
                ),
                array(
                    'id'      => 'unique_radio_2',
                    'type'    => 'radio',
                    'title'   => 'Radio with Default Value',
                    'options' => array(
                        'yes'      => 'Yes, Please.',
                        'no'       => 'No, Thank you.',
                        'disabled' => array(
                            'label'      => 'Disabled',
                            'disabled'   => TRUE,
                            'attributes' => array( 'data-help' => 'yes' ),
                        ),
                        'nothing'  => 'I am not sure, yet!',
                    ),
                    'default' => 'nothing',
                    'help'    => 'Reference site about Lorem Ipsum, a random Lipsum generator.',
                ),

                array(
                    'id'      => 'unique_radio_group_4',
                    'type'    => 'radio',
                    'title'   => 'Radio Field with Group Options',
                    'options' => array(
                        'Group 1' => array(
                            'blue'   => array(
                                'label'      => 'Blue',
                                'disabled'   => TRUE,
                                'attributes' => array( 'data-help' => 'yes' ),
                            ),
                            'green'  => 'Green',
                            'yellow' => 'Yellow',
                        ),
                        'Group 2' => array(
                            'red'   => 'Red',
                            'black' => 'Black',
                            'white' => 'White',
                        ),
                    ),
                ),

                array(
                    'id'      => 'unique_radio_3',
                    'type'    => 'radio',
                    'title'   => 'Radio Field',
                    'class'   => 'horizontal',
                    'options' => array(
                        'yes' => 'Yes, Please.',
                        'no'  => 'No, Thank you.',
                    ),
                    'after'   => '<div class="cs-text-muted">Reference site about Lorem Ipsum, a random Lipsum generator.</div>',
                ),


                array(
                    'fields'          => array(
                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => 'Option1',
                                'option2' => 'Option2',
                                'option3' => 'Option3',
                            ),
                            'class'   => 'icheck horizontal',
                            'id'      => 'primary',
                            'type'    => 'radio',
                            'title'   => 'Default Style',
                        ),
                        array(
                            'default' => 'option2',
                            'options' => array(
                                'option1' => 'Option1',
                                'option2' => 'Option2',
                                'option3' => 'Option3',
                            ),
                            'class'   => 'icheck icheck-primary horizontal',
                            'id'      => 'primary',
                            'type'    => 'radio',
                            'title'   => 'Primary Style',
                        ),
                        array(
                            'default' => 'option3',
                            'options' => array(
                                'option1' => 'Option1',
                                'option2' => 'Option2',
                                'option3' => 'Option3',
                            ),
                            'class'   => 'icheck icheck-success horizontal',
                            'id'      => 'success',
                            'type'    => 'radio',
                            'title'   => 'Success Style',
                        ),
                        array(
                            'default' => 'option2',
                            'options' => array(
                                'option1' => 'Option1',
                                'option2' => 'Option2',
                                'option3' => 'Option3',
                            ),
                            'class'   => 'icheck icheck-info horizontal',
                            'id'      => 'info',
                            'type'    => 'radio',
                            'title'   => 'info Style',
                        ),
                        array(
                            'default' => 'option2',
                            'options' => array(
                                'option1' => 'Option1',
                                'option2' => 'Option2',
                                'option3' => 'Option3',
                            ),
                            'class'   => 'icheck icheck-danger horizontal',
                            'id'      => 'danger',
                            'type'    => 'radio',
                            'title'   => 'danger Style',
                        ),
                        array(
                            'default' => 'option2',
                            'options' => array(
                                'option1' => 'Option1',
                                'option2' => 'Option2',
                                'option3' => 'Option3',
                            ),
                            'class'   => 'icheck icheck-danger horizontal',
                            'id'      => 'danger',
                            'type'    => 'radio',
                            'title'   => 'danger Style',
                        ),
                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => array(
                                    'label'      => 'Option1',
                                    'attributes' => array( 'class' => 'icheck icheck-success' ),
                                ),
                                'option2' => array(
                                    'label'      => 'Option2',
                                    'attributes' => array( 'class' => 'icheck icheck-primary' ),
                                ),
                                'option3' => array(
                                    'label'      => 'Option3',
                                    'attributes' => array( 'class' => 'icheck icheck-danger' ),
                                ),
                            ),
                            'class'   => 'icheck icheck-warning horizontal',
                            'id'      => 'multiple_style',
                            'type'    => 'radio',
                            'title'   => 'Multiple Style',
                        ),
                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => array(
                                    'label'      => 'Option1',
                                    'attributes' => array( 'class' => 'icheck icheck-success icheck-xs' ),
                                ),
                                'option2' => array(
                                    'label'      => 'Option2',
                                    'attributes' => array( 'class' => 'icheck icheck-primary ' ),
                                ),
                                'option3' => array(
                                    'label'      => 'Option3',
                                    'attributes' => array( 'class' => 'icheck icheck-danger icheck-lg' ),
                                ),
                            ),
                            'class'   => 'icheck icheck-warning horizontal',
                            'id'      => 'multiple_style',
                            'type'    => 'radio',
                            'title'   => 'Multiple Size',
                        ),

                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => array( 'label' => 'Option1', ),
                                'option2' => array( 'label' => 'Option2', ),
                                'option3' => array( 'label' => 'Option3', ),
                            ),
                            'class'   => 'icheck icheck-lg horizontal',
                            'id'      => 'large_size',
                            'type'    => 'radio',
                            'title'   => 'Large Size',
                        ),
                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => array( 'label' => 'Option1', ),
                                'option2' => array( 'label' => 'Option2', ),
                                'option3' => array( 'label' => 'Option3', ),
                            ),
                            'class'   => 'icheck icheck-sm horizontal',
                            'id'      => 'small_size',
                            'type'    => 'radio',
                            'title'   => 'small Size',
                        ),
                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => array( 'label' => 'Option1', ),
                                'option2' => array( 'label' => 'Option2', ),
                                'option3' => array( 'label' => 'Option3', ),
                            ),
                            'class'   => 'icheck icheck-rounded horizontal',
                            'id'      => 'rounded',
                            'type'    => 'radio',
                            'title'   => 'Rounded Size',
                        ),
                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => array( 'label' => 'Option1', ),
                                'option2' => array( 'label' => 'Option2', ),
                                'option3' => array( 'label' => 'Option3', ),
                            ),
                            'class'   => 'icheck icheck-lg icheck-rounded horizontal',
                            'id'      => 'large_rounded',
                            'type'    => 'radio',
                            'title'   => 'Large Rounded Size',
                        ),
                        array(
                            'default' => 'option1',
                            'options' => array(
                                'option1' => array( 'label' => 'Option1', ),
                                'option2' => array( 'label' => 'Option2', ),
                                'option3' => array( 'label' => 'Option3', ),
                            ),
                            'class'   => 'icheck icheck-sm icheck-rounded horizontal',
                            'id'      => 'small_rounded',
                            'type'    => 'radio',
                            'title'   => 'Small Rounded Size',
                        ),

                    ),
                    'id'              => 'styled_checkbox',
                    'type'            => 'accordion',
                    'accordion_title' => 'Styled Checkbox',
                ),


                array(
                    'id'      => 'unique_radio_4',
                    'type'    => 'radio',
                    'title'   => 'Radio Field with Pages',
                    'options' => 'pages',
                ),
                array(
                    'id'      => 'unique_radio_5',
                    'type'    => 'radio',
                    'title'   => 'Radio Field with Posts',
                    'options' => 'posts',
                ),
                array(
                    'id'      => 'unique_radio_6',
                    'type'    => 'radio',
                    'title'   => 'Radio Field with Categories',
                    'options' => 'categories',
                ),
                array(
                    'id'      => 'unique_radio_7',
                    'type'    => 'radio',
                    'title'   => 'Radio Field with Tags',
                    'options' => 'tags',
                ),
                array(
                    'id'         => 'unique_radio_8',
                    'type'       => 'radio',
                    'title'      => 'Radio Field with Pages',
                    'options'    => 'pages',
                    'query_args' => array(
                        'sort_order'  => 'desc',
                        'sort_column' => 'post_title',
                    ),
                    'after'      => '<p class="cs-text-muted"><strong>query_args:</strong> sort_order=desc, sort_column=post_title</p>',
                ),
                array(
                    'id'         => 'unique_radio_9',
                    'type'       => 'radio',
                    'title'      => 'Radio Field with CPT Posts',
                    'options'    => 'posts',
                    'query_args' => array(
                        'post_type' => 'your_post_type_name',
                    ),
                    'after'      => '<div class="cs-text-muted"><strong>query_args:</strong> post_type=your_post_type_name</div>',
                ),
                array(
                    'id'         => 'unique_radio_10',
                    'type'       => 'radio',
                    'title'      => 'Radio Field with CPT Categories',
                    'options'    => 'categories',
                    'query_args' => array(
                        'type'     => 'your_post_type_name',
                        'taxonomy' => 'your_taxonomy_name',
                    ),
                    'after'      => '<div class="cs-text-muted"><strong>query_args:</strong> post_type=your_post_type_name, taxonomy=your_taxonomy_name</div>',
                ),
                array(
                    'id'      => 'unique_radio_11',
                    'type'    => 'radio',
                    'title'   => 'Radio Field',
                    'options' => array(
                        'yes'     => 'Yes, Please.',
                        'no'      => 'No, Thank you.',
                        'nothing' => 'Nothing.',
                    ),
                ),
            ),
        ),
        // end: radio options
        // -----------------------------
        // begin: select options       -
        // -----------------------------
        array(
            'name'   => 'select_options',
            'title'  => 'Select',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'      => 'unique_select_1',
                    'type'    => 'select',
                    'title'   => 'Select',
                    'options' => array(
                        'yes' => 'Yes, Please.',
                        'no'  => 'No, Thank you.',
                    ),
                ),

                array(
                    'id'      => 'unique_select_100',
                    'type'    => 'select',
                    'title'   => 'Select With Group',
                    'options' => array(
                        'Group 1' => array(
                            'yes' => 'Yes, Please',
                            'no'  => 'No Thank you',
                        ),
                        'Group 2' => array(
                            'yes' => 'Yes Please',
                            'no'  => 'No Thank you',
                        ),
                    ),
                ),
                array(
                    'id'             => 'unique_select_2',
                    'type'           => 'select',
                    'title'          => 'Select with First Empty Value',
                    'options'        => array(
                        'yes' => 'Yes, Please.',
                        'no'  => 'No, Thank you.',
                    ),
                    'default_option' => 'Select an option',
                    'help'           => 'I am a Tooltip helper. This field important for something.',
                ),
                array(
                    'id'             => 'unique_select_3',
                    'type'           => 'select',
                    'title'          => 'Select with Help',
                    'options'        => array(
                        'green'  => 'Green',
                        'red'    => 'Red',
                        'blue'   => 'Blue',
                        'yellow' => 'Yellow',
                        'black'  => 'Black',
                    ),
                    'default_option' => 'Select a color',
                    'info'           => 'Choose your favorite skin.',
                ),
                array(
                    'id'             => 'unique_select_4',
                    'type'           => 'select',
                    'title'          => 'Select with Default Value',
                    'options'        => array(
                        'primary'   => 'Primary Option',
                        'secondary' => 'Secondry Option',
                        'tertiary'  => 'Tertiary Option',
                    ),
                    'default'        => 'tertiary',
                    'default_option' => 'Select an option',
                ),
                array(
                    'id'         => 'unique_select_6',
                    'type'       => 'select',
                    'title'      => 'Select Field with Multi-select',
                    'options'    => array(
                        'bmw'      => 'BMW',
                        'mercedes' => 'Mercedes',
                        'jaguar'   => 'Jaguar',
                        'opel'     => 'Opel',
                        'golf'     => 'Golf',
                        'ferrari'  => 'Ferrari',
                        'subaru'   => 'Subaru',
                        'seat'     => 'Seat',
                    ),
                    'attributes' => array(
                        'multiple' => 'only-key',
                        'style'    => 'width: 150px; height: 125px;',
                    ),
                ),

                array(
                    'id'       => 'unique_select_101',
                    'type'     => 'select',
                    'title'    => 'Select Field With Multi Select Group',
                    'options'  => array(
                        'Group 1' => array(
                            'yes' => 'Yes, Please',
                            'no'  => 'No Thank you',
                        ),
                        'Group 2' => array(
                            'yes' => 'Yes Please',
                            'no'  => 'No Thank you',
                        ),
                    ),
                    'multiple' => TRUE,
                ),

                array(
                    'id'         => 'unique_select_7',
                    'type'       => 'select',
                    'title'      => 'Select Field with Multi-default',
                    'options'    => array(
                        'bmw'      => 'BMW',
                        'mercedes' => 'Mercedes',
                        'jaguar'   => 'Jaguar',
                        'opel'     => 'Opel',
                        'golf'     => 'Golf',
                        'ferrari'  => 'Ferrari',
                        'subaru'   => 'Subaru',
                        'seat'     => 'Seat',
                    ),
                    'attributes' => array(
                        'multiple' => 'only-key',
                        'style'    => 'width: 150px; height: 125px;',
                    ),
                    'default'    => array(
                        'bmw',
                        'mercedes',
                        'opel',
                    ),
                    'info'       => 'Choose your favorite cars.',
                ),
                array(
                    'id'             => 'unique_select_8',
                    'type'           => 'select',
                    'title'          => 'Select with Pages',
                    'options'        => 'pages',
                    'default_option' => 'Select a page',
                ),
                array(
                    'id'             => 'unique_select_9',
                    'type'           => 'select',
                    'title'          => 'Select with Posts',
                    'options'        => 'posts',
                    'default_option' => 'Select a post',
                ),
                array(
                    'id'             => 'unique_select_10',
                    'type'           => 'select',
                    'title'          => 'Select with Categories',
                    'options'        => 'categories',
                    'default_option' => 'Select a tag',
                ),
                array(
                    'id'             => 'unique_select_10_1',
                    'type'           => 'select',
                    'title'          => 'Select with Menus',
                    'options'        => 'menus',
                    'default_option' => 'Select a menu',
                ),
                array(
                    'id'         => 'unique_select_11',
                    'type'       => 'select',
                    'title'      => 'Select with Pages with Multi-Select',
                    'options'    => 'pages',
                    'attributes' => array(
                        'multiple' => 'only-key',
                        'style'    => 'width: 150px; height: 125px;',
                    ),
                ),

                array(
                    'content' => 'Select With Chosen',
                    'fields'  => array(
                        array(
                            'id'             => 'unique_select_12',
                            'type'           => 'select',
                            'title'          => 'Select with Chosen',
                            'options'        => array(
                                'bmw'      => 'BMW',
                                'mercedes' => 'Mercedes',
                                'jaguar'   => 'Jaguar',
                                'opel'     => 'Opel',
                                'golf'     => 'Golf',
                                'ferrari'  => 'Ferrari',
                                'subaru'   => 'Subaru',
                                'seat'     => 'Seat',
                            ),
                            'class'          => 'chosen',
                            'default_option' => 'Select your car',
                        ),
                        array(
                            'id'         => 'unique_select_13',
                            'type'       => 'select',
                            'title'      => 'Select with Chosen Multi-Select',
                            'options'    => array(
                                'bmw'      => 'BMW',
                                'mercedes' => 'Mercedes',
                                'jaguar'   => 'Jaguar',
                                'opel'     => 'Opel',
                                'golf'     => 'Golf',
                                'ferrari'  => 'Ferrari',
                                'subaru'   => 'Subaru',
                                'seat'     => 'Seat',
                            ),
                            'class'      => 'chosen',
                            'attributes' => array(
                                'data-placeholder' => 'Select your favrorite cars',
                                'multiple'         => 'only-key',
                                'style'            => 'width: 200px;',
                            ),
                        ),
                        array(
                            'id'             => 'unique_select_14',
                            'type'           => 'select',
                            'title'          => 'Select with Chosen with Pages',
                            'options'        => 'pages',
                            'class'          => 'chosen',
                            'default_option' => 'Select a page',
                        ),
                        array(
                            'id'         => 'unique_select_15',
                            'type'       => 'select',
                            'title'      => 'Select with Chosen with Posts Multi-Select',
                            'options'    => 'posts',
                            'class'      => 'chosen',
                            'attributes' => array(
                                'data-placeholder' => 'Select your favrorite posts',
                                'multiple'         => 'only-key',
                                'style'            => 'width: 200px;',
                            ),
                            'info'       => 'and much more select options for you!',
                        ),
                    ),
                    'id'      => 'unique_select_chosen_011',
                    'type'    => 'accordion',
                ),
                array(
                    'content' => 'Select With Select2',
                    'fields'  => array(
                        array(
                            'id'             => 'unique_select_112',
                            'type'           => 'select',
                            'title'          => 'Select with select2',
                            'options'        => array(
                                'bmw'      => 'BMW',
                                'mercedes' => 'Mercedes',
                                'jaguar'   => 'Jaguar',
                                'opel'     => 'Opel',
                                'golf'     => 'Golf',
                                'ferrari'  => 'Ferrari',
                                'subaru'   => 'Subaru',
                                'seat'     => 'Seat',
                            ),
                            'class'          => 'select2',
                            'default_option' => 'Select your car',
                        ),
                        array(
                            'id'         => 'unique_select_113',
                            'type'       => 'select',
                            'title'      => 'Select with select2 Multi-Select',
                            'options'    => array(
                                'bmw'      => 'BMW',
                                'mercedes' => 'Mercedes',
                                'jaguar'   => 'Jaguar',
                                'opel'     => 'Opel',
                                'golf'     => 'Golf',
                                'ferrari'  => 'Ferrari',
                                'subaru'   => 'Subaru',
                                'seat'     => 'Seat',
                            ),
                            'class'      => 'select2',
                            'attributes' => array(
                                'data-placeholder' => 'Select your favrorite cars',
                                'multiple'         => 'only-key',
                                'style'            => 'width: 50%;',
                            ),
                        ),
                        array(
                            'id'             => 'unique_select_114',
                            'type'           => 'select',
                            'title'          => 'Select with select2 with Pages',
                            'options'        => 'pages',
                            'class'          => 'select2',
                            'default_option' => 'Select a page',
                        ),
                        array(
                            'id'         => 'unique_select_115',
                            'type'       => 'select',
                            'title'      => 'Select with Chosen with Posts Multi-Select',
                            'options'    => 'posts',
                            'class'      => 'select2',
                            'attributes' => array(
                                'data-placeholder' => 'Select your favrorite posts',
                                'multiple'         => 'only-key',
                                'style'            => 'width: 50%;',
                            ),
                            'info'       => 'and much more select options for you!',
                        ),
                    ),
                    'id'      => 'unique_select_select2_011',
                    'type'    => 'accordion',
                ),

            ),
        ),
        // end: select options
        // -----------------------------
        // begin: switcher options     -
        // -----------------------------
        array(
            'name'   => 'switcher_options',
            'title'  => 'Switcher',
            'icon'   => 'fa fa-toggle-on',
            'fields' => array(
                array(
                    'id'    => 'unique_switcher_1',
                    'type'  => 'switcher',
                    'title' => 'Simple Switcher',
                ),
                array(
                    'id'    => 'unique_switcher_2',
                    'type'  => 'switcher',
                    'title' => 'Switcher Field with Label',
                    'label' => 'Yes, Please do it.',
                ),
                array(
                    'id'    => 'unique_switcher_3',
                    'type'  => 'switcher',
                    'title' => 'Switcher Field with Help',
                    'help'  => 'I am a Tooltip helper. This field important for something.',
                ),
                array(
                    'id'      => 'unique_switcher_4',
                    'type'    => 'switcher',
                    'title'   => 'Switcher Field with Default',
                    'default' => TRUE,
                ),
                array(
                    'id'        => 'unique_switcher_label_14',
                    'type'      => 'switcher',
                    'title'     => 'Switcher Field with Custom Label',
                    'on_label'  => 'Yea',
                    'off_label' => 'OMG',
                ),
            ),
        ),
        // end: switcher options
        // -----------------------------
        // begin: number options       -
        // -----------------------------
        array(
            'name'   => 'number_options',
            'title'  => 'Number',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'    => 'unique_number_1',
                    'type'  => 'number',
                    'title' => 'Simple Number',
                ),
                array(
                    'id'    => 'unique_number_2',
                    'type'  => 'number',
                    'title' => 'Number Field with Description',
                    'desc'  => 'Lets write some description for this number field.',
                ),
                array(
                    'id'    => 'unique_number_3',
                    'type'  => 'number',
                    'title' => 'Number Field with Help',
                    'help'  => 'I am a Tooltip helper. This field important for something.',
                ),
                array(
                    'id'      => 'unique_number_4',
                    'type'    => 'number',
                    'title'   => 'Number Field with Default',
                    'default' => '10',
                ),
                array(
                    'id'         => 'unique_number_5',
                    'type'       => 'number',
                    'title'      => 'Number Field with Placeholder',
                    'attributes' => array(
                        'placeholder' => '25',
                    ),
                ),
                array(
                    'id'    => 'unique_number_6',
                    'type'  => 'number',
                    'title' => 'Number Field with After-text',
                    'after' => ' <i class="cs-text-muted">(px)</i>',
                ),
            ),
        ),
        // end: number options
        // -----------------------------
        // begin: icon options       -
        // -----------------------------
        array(
            'name'   => 'icon_options',
            'title'  => 'Icons',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'    => 'unique_icon_1',
                    'type'  => 'icon',
                    'title' => 'Simple Icon',
                ),
                array(
                    'id'    => 'unique_icon_2',
                    'type'  => 'icon',
                    'title' => 'Icon Field with Description',
                    'desc'  => 'Lets write some description for this icon field.',
                ),
                array(
                    'id'    => 'unique_icon_3',
                    'type'  => 'icon',
                    'title' => 'Icon Field with Help',
                    'help'  => 'I am a Tooltip helper. This field important for something.',
                ),
                array(
                    'id'      => 'unique_icon_4',
                    'type'    => 'icon',
                    'title'   => 'Icon Field with Default',
                    'default' => 'fa fa-check',
                ),
                array(
                    'id'    => 'unique_icon_5',
                    'type'  => 'icon',
                    'title' => 'Icon Field with After-text',
                    'after' => '<p class="cs-text-muted">Lets write some description for this icon field.</i>',
                ),
            ),
        ),
        // end: icon options


        // -----------------------------
        // begin: upload options       -
        // -----------------------------
        array(
            'name'   => 'upload_options',
            'title'  => 'Upload',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'    => 'unique_upload_1',
                    'type'  => 'upload',
                    'title' => 'Simple Upload',
                ),
                array(
                    'id'    => 'unique_upload_2',
                    'type'  => 'upload',
                    'title' => 'Upload Field with Description',
                    'desc'  => 'Lets write some description for this upload field.',
                ),
                array(
                    'id'    => 'unique_upload_3',
                    'type'  => 'upload',
                    'title' => 'Upload Field with Help',
                    'help'  => 'I am a Tooltip helper. This field important for something.',
                ),
                array(
                    'id'      => 'unique_upload_4',
                    'type'    => 'upload',
                    'title'   => 'Upload Field with Default',
                    'default' => 'screenshot-1.png',
                ),
                array(
                    'id'    => 'unique_upload_5',
                    'type'  => 'upload',
                    'title' => 'Upload Field with After-text',
                    'after' => '<p class="cs-text-muted">You can use default value <strong>get_template_directory_uri()</strong>."/images/screenshot-1.png"</p>',
                ),
                array(
                    'id'         => 'unique_upload_6',
                    'type'       => 'upload',
                    'title'      => 'Upload Field with Placeholder',
                    'attributes' => array(
                        'placeholder' => 'http://',
                    ),
                ),
                array(
                    'id'       => 'unique_upload_7',
                    'type'     => 'upload',
                    'title'    => 'Upload Field with Custom Title',
                    'settings' => array(
                        'button_title' => 'Upload Logo',
                        'frame_title'  => 'Choose a image',
                        'insert_title' => 'Use this image',
                    ),
                ),
                array(
                    'id'       => 'unique_upload_8',
                    'type'     => 'upload',
                    'title'    => 'Upload Field with Video',
                    'settings' => array(
                        'upload_type'  => 'video',
                        'button_title' => 'Upload Video',
                        'frame_title'  => 'Choose a Video',
                        'insert_title' => 'Use This Video',
                    ),
                ),
            ),
        ),
        // end: upload options
        // -----------------------------
        // begin: background options   -
        // -----------------------------
        array(
            'name'   => 'background_options',
            'title'  => 'Background',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'    => 'unique_background_1',
                    'type'  => 'background',
                    'title' => 'Background',
                ),
                array(
                    'id'    => 'unique_background_2',
                    'type'  => 'background',
                    'title' => 'Background Field with Description',
                    'desc'  => 'Lets write some description for this background field.',
                    'help'  => 'I am a Tooltip helper. This field important for something.',
                ),
                array(
                    'id'      => 'unique_background_3',
                    'type'    => 'background',
                    'title'   => 'Background Field with Default',
                    'default' => array(
                        'image'      => 'something.png',
                        'repeat'     => 'repeat-x',
                        'position'   => 'center center',
                        'attachment' => 'fixed',
                        'color'      => '#ffbc00',
                    ),
                ),
                array(
                    'id'      => 'unique_background_4',
                    'type'    => 'background',
                    'title'   => 'Background Field with Description',
                    'after'   => '<p class="cs-text-muted">Information: There is some description for option.</p> ',
                    'default' => array(
                        'color' => '#222',
                    ),
                ),
            ),
        ),
        // end: background options
        // -----------------------------
        // begin: color picker options -
        // -----------------------------
        array(
            'name'   => 'color_picker_options',
            'title'  => 'Color Picker',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'      => 'unique_color_picker_1',
                    'type'    => 'color_picker',
                    'title'   => 'Color Picker',
                    'default' => '#dd3333',
                ),
                array(
                    'id'    => 'unique_color_picker_2',
                    'type'  => 'color_picker',
                    'title' => 'Color Picker RGBA disabled',
                    'rgba'  => FALSE,
                ),
                array(
                    'id'    => 'unique_color_picker_3',
                    'type'  => 'color_picker',
                    'title' => 'Color Picker Field with Description',
                    'desc'  => 'Lets write some description for this color picker field.',
                ),
                array(
                    'id'    => 'unique_color_picker_4',
                    'type'  => 'color_picker',
                    'title' => 'Color Picker Field with Help',
                    'help'  => 'I am a Tooltip helper. This field important for something.',
                ),
                array(
                    'id'      => 'unique_color_picker_5',
                    'type'    => 'color_picker',
                    'title'   => 'Color Picker Field with Default',
                    'default' => 'rgba(0, 0, 255, 0.25)',
                ),
                array(
                    'id'      => 'unique_color_picker_6',
                    'type'    => 'color_picker',
                    'title'   => 'Color Picker Field with Default',
                    'after'   => '<p class="cs-text-muted">Information: There is some description for option.</p> ',
                    'default' => 'rgba(0, 255, 0, 0.75)',
                ),
            ),
        ),
        // end: color picker options
        // -----------------------------
        // begin: image select options -
        // -----------------------------
        array(
            'name'   => 'image_select_options',
            'title'  => 'Image Select',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'      => 'unique_image_select_1',
                    'type'    => 'image_select',
                    'title'   => 'Image Select (Checkbox)',
                    'options' => array(
                        'value-1' => 'http://codestarframework.com/assets/images/placeholder/150x125-2ecc71.gif',
                        'value-2' => 'http://codestarframework.com/assets/images/placeholder/150x125-e74c3c.gif',
                        'value-3' => 'http://codestarframework.com/assets/images/placeholder/150x125-ffbc00.gif',
                        'value-4' => 'http://codestarframework.com/assets/images/placeholder/150x125-3498db.gif',
                    ),
                ),
                array(
                    'id'      => 'unique_image_select_2',
                    'type'    => 'image_select',
                    'title'   => 'Image Select (Checkbox) with Default',
                    'options' => array(
                        'value-1' => 'http://codestarframework.com/assets/images/placeholder/150x125-ffbc00.gif',
                        'value-2' => 'http://codestarframework.com/assets/images/placeholder/150x125-3498db.gif',
                        'value-3' => 'http://codestarframework.com/assets/images/placeholder/150x125-e74c3c.gif',
                        'value-4' => 'http://codestarframework.com/assets/images/placeholder/150x125-2ecc71.gif',
                        'value-5' => 'http://codestarframework.com/assets/images/placeholder/150x125-555555.gif',
                    ),
                    'default' => 'value-2',
                ),
                array(
                    'id'      => 'unique_image_select_3',
                    'type'    => 'image_select',
                    'title'   => 'Image Select (Radio) with Default',
                    'options' => array(
                        'value-1' => 'http://codestarframework.com/assets/images/placeholder/150x125-2ecc71.gif',
                        'value-2' => 'http://codestarframework.com/assets/images/placeholder/150x125-e74c3c.gif',
                        'value-3' => 'http://codestarframework.com/assets/images/placeholder/150x125-ffbc00.gif',
                        'value-4' => 'http://codestarframework.com/assets/images/placeholder/150x125-3498db.gif',
                    ),
                    'radio'   => TRUE,
                    'default' => 'value-3',
                ),
                array(
                    'id'      => 'unique_image_select_4',
                    'type'    => 'image_select',
                    'title'   => 'Image Select (Radio) with Default',
                    'options' => array(
                        'value-1' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
                        'value-2' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
                        'value-3' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
                        'value-4' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
                        'value-5' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
                        'value-6' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
                        'value-7' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
                        'value-8' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
                    ),
                    'radio'   => TRUE,
                    'default' => 'value-2',
                ),
                array(
                    'id'           => 'unique_image_select_5',
                    'type'         => 'image_select',
                    'title'        => 'Image Select with Multi Select',
                    'options'      => array(
                        'value-1' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
                        'value-2' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
                        'value-3' => 'http://codestarframework.com/assets/images/placeholder/80x80-e74c3c.gif',
                        'value-4' => 'http://codestarframework.com/assets/images/placeholder/80x80-ffbc00.gif',
                        'value-5' => 'http://codestarframework.com/assets/images/placeholder/80x80-3498db.gif',
                        'value-6' => 'http://codestarframework.com/assets/images/placeholder/80x80-2ecc71.gif',
                        'value-7' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
                        'value-8' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
                    ),
                    'multi_select' => TRUE,
                    'default'      => array(
                        'value-3',
                        'value-4',
                        'value-5',
                        'value-6',
                    ),
                ),
            ),
        ),
        // end: image select options
        // -----------------------------
        // begin: typography options   -
        // -----------------------------
        array(
            'name'   => 'typography_options',
            'title'  => 'Typography',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'      => 'unique_typography_1',
                    'type'    => 'typography',
                    'title'   => 'Typography with Default',
                    'chosen'  => TRUE,
                    'default' => array(
                        'family'  => 'Open Sans',
                        'font'    => 'google',
                        // this is helper for output ( google, websafe, custom )
                        'variant' => '800',
                    ),
                ),
                array(
                    'id'      => 'unique_typography_2',
                    'type'    => 'typography',
                    'title'   => 'Typography without Chosen',
                    'default' => array(
                        'family' => 'Ubuntu',
                        'font'   => 'google',
                    ),
                ),
                array(
                    'id'      => 'unique_typography_select2',
                    'type'    => 'typography',
                    'title'   => 'Typography Select2',
                    'default' => array(
                        'family' => 'Ubuntu',
                        'font'   => 'google',
                    ),
                    'variant' => FALSE,
                    'select2' => TRUE,
                ),
                array(
                    'id'      => 'unique_typography_3',
                    'type'    => 'typography',
                    'title'   => 'Typography without Chosen/Variant',
                    'default' => array(
                        'family' => 'Arial',
                        'font'   => 'websafe',
                    ),
                    'variant' => FALSE,
                ),
            ),
        ),
        // end: typography options
        // -----------------------------
        // begin: new fields options   -
        // -----------------------------
        array(
            'name'   => 'wysiwyg_options',
            'title'  => 'Wysiwyg',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'    => 'wysiwyg_1',
                    'type'  => 'wysiwyg',
                    'title' => 'Wysiwyg',
                ),
                array(
                    'id'       => 'wysiwyg_2',
                    'type'     => 'wysiwyg',
                    'title'    => 'Wysiwyg with Custom Settings',
                    'settings' => array(
                        'textarea_rows' => 5,
                        'tinymce'       => FALSE,
                        'media_buttons' => FALSE,
                    ),
                ),
            ),
        ),
        // end: new fields options
        // -----------------------------
        // begin: image options        -
        // -----------------------------
        array(
            'name'   => 'image_options',
            'title'  => 'Image',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'    => 'image_1',
                    'type'  => 'image',
                    'title' => 'Image',
                ),
                array(
                    'id'    => 'image_2',
                    'type'  => 'image',
                    'title' => 'Image with After Text',
                    'desc'  => 'Lets write some description for this image field.',
                    'help'  => 'This option field is useful. You will love it!',
                ),
                array(
                    'id'        => 'image_3',
                    'type'      => 'image',
                    'title'     => 'Image with Custom Title',
                    'add_title' => 'Add Logo',
                ),
            ),
        ),
        // end: image options
        // -----------------------------
        // begin: gallery options      -
        // -----------------------------
        array(
            'name'   => 'gallery_options',
            'title'  => 'Gallery',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'    => 'gallery_1',
                    'type'  => 'gallery',
                    'title' => 'Gallery',
                ),
                array(
                    'id'          => 'gallery_2',
                    'type'        => 'gallery',
                    'title'       => 'Gallery with Custom Title',
                    'add_title'   => 'Add Images',
                    'edit_title'  => 'Edit Images',
                    'clear_title' => 'Remove Images',
                ),
                array(
                    'id'          => 'gallery_3',
                    'type'        => 'gallery',
                    'title'       => 'Gallery with Custom Title',
                    'desc'        => 'Lets write some description for this image field.',
                    'help'        => 'This option field is useful. You will love it!',
                    'add_title'   => 'Add Image(s)',
                    'edit_title'  => 'Edit Image(s)',
                    'clear_title' => 'Clear Image(s)',
                ),
            ),
        ),
        // end: gallery options
        // -----------------------------
        // begin: sorter options       -
        // -----------------------------
        array(
            'name'   => 'sorter_options',
            'title'  => 'Sorter',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'      => 'sorter_1',
                    'type'    => 'sorter',
                    'title'   => 'Sorter',
                    'default' => array(
                        'enabled'  => array(
                            'bmw'        => 'BMW',
                            'mercedes'   => 'Mercedes',
                            'volkswagen' => 'Volkswagen',
                        ),
                        'disabled' => array(
                            'ferrari' => 'Ferrari',
                            'mustang' => 'Mustang',
                        ),
                    ),
                ),
                array(
                    'id'             => 'sorter_2',
                    'type'           => 'sorter',
                    'title'          => 'Sorter',
                    'default'        => array(
                        'enabled'  => array(
                            'blue'   => 'Blue',
                            'green'  => 'Green',
                            'red'    => 'Red',
                            'yellow' => 'Yellow',
                            'orange' => 'Orange',
                            'ocean'  => 'Ocean',
                        ),
                        'disabled' => array(
                            'black' => 'Black',
                            'white' => 'White',
                        ),
                    ),
                    'enabled_title'  => 'Active Colors',
                    'disabled_title' => 'Deactive Colors',
                ),
            ),
        ),
        // end: sorter options
        // -----------------------------
        // begin: sorter options       -
        // -----------------------------

        // end: sorter options
        // -----------------------------
        // begin: others options       -
        // -----------------------------
        array(
            'name'   => 'others_options',
            'title'  => 'Others',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'type'    => 'heading',
                    'content' => 'Heading',
                ),
                array(
                    'id'    => 'unique_others_text_1',
                    'type'  => 'text',
                    'title' => 'Others Text Field 1',
                ),
                array(
                    'id'    => 'unique_others_text_2',
                    'type'  => 'text',
                    'title' => 'Others Text Field 2',
                ),
                array(
                    'type'    => 'subheading',
                    'content' => 'Sub Heading',
                ),
                array(
                    'id'    => 'unique_others_text_3',
                    'type'  => 'text',
                    'title' => 'Others Text Field 3',
                ),
                array(
                    'type'    => 'notice',
                    'class'   => 'success',
                    'content' => 'Notice Success: Lorem Ipsum, a random Lipsum generator.',
                ),
                array(
                    'id'    => 'unique_others_text_4',
                    'type'  => 'text',
                    'title' => 'Others Text Field 4',
                ),
                array(
                    'type'    => 'notice',
                    'class'   => 'info',
                    'content' => 'Notice Info: Lorem Ipsum, a random Lipsum generator.',
                ),
                array(
                    'id'    => 'unique_others_text_5',
                    'type'  => 'text',
                    'title' => 'Others Text Field 5',
                ),
                array(
                    'type'    => 'notice',
                    'class'   => 'warning',
                    'content' => 'Notice Warning: Lorem Ipsum, a random Lipsum generator.',
                ),
                array(
                    'id'    => 'unique_others_text_6',
                    'type'  => 'text',
                    'title' => 'Others Text Field 6',
                ),
                array(
                    'type'    => 'notice',
                    'class'   => 'danger',
                    'content' => 'Notice Danger: Lorem Ipsum, a random Lipsum generator.',
                ),
                array(
                    'id'    => 'unique_others_text_7',
                    'type'  => 'text',
                    'title' => 'Others Text Field 7',
                ),
                array(
                    'id'    => 'unique_others_text_8',
                    'type'  => 'text',
                    'title' => 'Others Text Field 8',
                ),
                array(
                    'type'    => 'content',
                    'content' => 'Content Field: It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
                ),
                array(
                    'id'    => 'unique_others_text_9',
                    'type'  => 'text',
                    'title' => 'Others Text Field 9',
                    'after' => '<p class="cs-text-warning">This field using debug=true</p>',
                    'debug' => TRUE,
                ),
            ),
        ),
        // end: other options
    ),
);


$options[] = array(
    'name'     => 'design-fields',
    'title'    => 'Design Fields',
    'icon'     => 'fa fa-pencil-square',
    'sections' => array(
        array(
            'name'   => 'css-builder',
            'title'  => 'CSS Builder',
            'icon'   => 'fa fa-css3',
            'fields' => array(
                array(
                    'id'      => 'css_builder',
                    'title'   => 'CSS Builder',
                    'type'    => 'css_builder',
                    'select2' => FALSE,
                    'chosen'  => FALSE,
                ),
                array(
                    'id'      => 'css_builder_select2',
                    'title'   => 'CSS Builder Select2',
                    'type'    => 'css_builder',
                    'select2' => TRUE,
                    'debug'   => TRUE,
                ),
                array(
                    'id'     => 'css_builder_chosen',
                    'title'  => 'CSS Builder Chosen',
                    'type'   => 'css_builder',
                    'chosen' => TRUE,
                    'debug'  => TRUE,
                ),
                array(
                    'id'      => 'css_builder_no_title',
                    'type'    => 'css_builder',
                    'select2' => FALSE,
                    'chosen'  => FALSE,
                ),
            ),

        ),
        array(
            'name'   => 'accordion',
            'title'  => 'Accordion',
            'icon'   => 'fa fa-list',
            'fields' => array(
                array(
                    'id'              => 'accordion_1',
                    'type'            => 'accordion',
                    'accordion_title' => 'Accordion 1',
                    'title'           => 'Accordion With Title',
                    'fields'          => array(
                        array(
                            'type'  => 'switcher',
                            'id'    => 'switcher',
                            'title' => 'Switcher',
                        ),
                        array(
                            'type'  => 'text',
                            'id'    => 'text',
                            'title' => 'Text',
                        ),
                    ),
                ),

                array(
                    'id'              => 'accordion_2',
                    'type'            => 'accordion',
                    'accordion_title' => 'Accordion Level 1',
                    'title'           => 'Nested Accordion',
                    'fields'          => array(
                        array(
                            'id'              => 'accordion_2_1',
                            'type'            => 'accordion',
                            'accordion_title' => 'Accordion Level 2',
                            'title'           => 'Nested Accordion',
                            'fields'          => array(

                                array(
                                    'id'     => 'accordion_2_1_1',
                                    'type'   => 'accordion',
                                    'title'  => 'Nested Accordion Level 3',
                                    'fields' => array(
                                        array(
                                            'id'              => 'accordion_2_1_1_1',
                                            'type'            => 'accordion',
                                            'accordion_title' => 'Accordion Level 4',
                                            'fields'          => array(
                                                array(
                                                    'type'  => 'switcher',
                                                    'id'    => 'switcher',
                                                    'title' => 'Switcher',
                                                ),
                                                array(
                                                    'type'  => 'text',
                                                    'id'    => 'text',
                                                    'title' => 'Text',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'type'  => 'switcher',
                                            'id'    => 'switcher',
                                            'title' => 'Switcher',
                                        ),
                                        array(
                                            'type'  => 'text',
                                            'id'    => 'text',
                                            'title' => 'Text',
                                        ),
                                    ),
                                ),

                                array(
                                    'type'  => 'switcher',
                                    'id'    => 'switcher',
                                    'title' => 'Switcher',
                                ),
                                array(
                                    'type'  => 'text',
                                    'id'    => 'text',
                                    'title' => 'Text',
                                ),
                            ),
                        ),
                        array(
                            'type'  => 'switcher',
                            'id'    => 'switcher',
                            'title' => 'Switcher',
                        ),
                        array(
                            'type'  => 'text',
                            'id'    => 'text',
                            'title' => 'Text',
                        ),
                    ),
                ),

                array(
                    'id'              => 'accordion_3',
                    'type'            => 'accordion',
                    'accordion_title' => 'Accordion 1',
                    'title'           => 'Accordion With Field Set',
                    'fields'          => array(
                        array(
                            'id'     => 'fieldset',
                            'type'   => 'fieldset',
                            'title'  => 'Fieldset',
                            'fields' => array(
                                array(
                                    'type'  => 'switcher',
                                    'id'    => 'switcher',
                                    'title' => 'Switcher',
                                ),
                                array(
                                    'type'  => 'text',
                                    'id'    => 'text',
                                    'title' => 'Text',
                                ),
                            ),
                        ),

                        array(
                            'id'     => 'fieldset_with_title',
                            'type'   => 'fieldset',
                            'title'  => 'Fieldset With Title',
                            'fields' => array(
                                array(
                                    'type'    => 'subheading',
                                    'content' => 'Title of Fieldset',
                                ),
                                array(
                                    'type'  => 'switcher',
                                    'id'    => 'switcher',
                                    'title' => 'Switcher',
                                ),
                                array(
                                    'type'  => 'text',
                                    'id'    => 'text',
                                    'title' => 'Text',
                                ),
                            ),
                        ),
                    ),
                ),

                array(
                    'id'              => 'accordion_3',
                    'type'            => 'accordion',
                    'accordion_title' => 'Accordion 1',
                    'title'           => 'Accordion With Group',
                    'fields'          => array(
                        array(
                            'id'              => 'group',
                            'type'            => 'group',
                            'title'           => 'Group',
                            'button_title'    => 'Add More',
                            'accordion_title' => 'Accordion With Group',
                            'fields'          => array(
                                array(
                                    'type'  => 'switcher',
                                    'id'    => 'switcher',
                                    'title' => 'Switcher',
                                ),
                                array(
                                    'type'  => 'text',
                                    'id'    => 'text',
                                    'title' => 'Text',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        array(
            'name'   => 'fieldset_options',
            'title'  => 'Fieldset',
            'icon'   => 'fa fa-check',
            'fields' => array(
                array(
                    'id'     => 'fieldset_1',
                    'type'   => 'fieldset',
                    'title'  => 'Fieldset Field',
                    'fields' => array(
                        array(
                            'id'    => 'fieldset_1_text',
                            'type'  => 'text',
                            'title' => 'Text Field',
                        ),
                        array(
                            'id'    => 'fieldset_1_upload',
                            'type'  => 'upload',
                            'title' => 'Upload Field',
                        ),
                        array(
                            'id'    => 'fieldset_1_textarea',
                            'type'  => 'textarea',
                            'title' => 'Textarea Field',
                        ),
                    ),
                ),
                array(
                    'id'      => 'fieldset_2',
                    'type'    => 'fieldset',
                    'title'   => 'Fieldset Field with Default',
                    'fields'  => array(
                        array(
                            'type'    => 'subheading',
                            'content' => 'Title of Fieldset',
                        ),
                        array(
                            'id'    => 'fieldset_2_text',
                            'type'  => 'text',
                            'title' => 'Text Field',
                        ),
                        array(
                            'id'    => 'fieldset_2_checkbox',
                            'type'  => 'checkbox',
                            'title' => 'Checkbox Field',
                            'label' => 'Are you sure?',
                        ),
                        array(
                            'id'    => 'fieldset_2_textarea',
                            'type'  => 'textarea',
                            'title' => 'Upload Field',
                        ),
                    ),
                    'default' => array(
                        'fieldset_2_text'     => 'Hello',
                        'fieldset_2_checkbox' => TRUE,
                        'fieldset_2_textarea' => 'Do stuff',
                    ),
                ),
            ),
        ),
        array(
            'name'   => 'tab_layout',
            'title'  => 'Tab',
            'icon'   => 'fa fa-book',
            'fields' => array(
                array(
                    'id'        => 'tab_1',
                    'type'      => 'tab',
                    'title'     => 'Tab (boxed)',
                    'tab_style' => 'box',
                    'sections'  => array(
                        array(
                            'name'   => 'section1',
                            'title'  => 'section 1',
                            'icon'   => 'fa fa-star',
                            'fields' => array(
                                array(
                                    'type'  => 'switcher',
                                    'id'    => 'switcher',
                                    'title' => 'Switcher',
                                ),
                                array(
                                    'type'  => 'text',
                                    'id'    => 'text',
                                    'title' => 'Text',
                                ),
                            ),
                        ),
                        array(
                            'name'   => 'tab_accordion',
                            'title'  => 'Tab Accordion',
                            'icon'   => 'fa fa-list',
                            'fields' => array(
                                array(
                                    'id'              => 'accordion_1',
                                    'type'            => 'accordion',
                                    'accordion_title' => 'Accordion 1',
                                    'title'           => 'Accordion With Title',
                                    'fields'          => array(
                                        array(
                                            'type'  => 'switcher',
                                            'id'    => 'switcher',
                                            'title' => 'Switcher',
                                        ),
                                        array(
                                            'type'  => 'text',
                                            'id'    => 'text',
                                            'title' => 'Text',
                                        ),
                                    ),
                                ),
                                array(
                                    'type'  => 'switcher',
                                    'id'    => 'switcher',
                                    'title' => 'Switcher',
                                ),
                                array(
                                    'type'  => 'text',
                                    'id'    => 'text',
                                    'title' => 'Text',
                                ),
                            ),
                        ),
                        array(
                            'name'   => 'tab_group',
                            'title'  => 'Tab group',
                            'icon'   => 'fa fa-object-group',
                            'fields' => array(
                                array(
                                    'id'              => 'group',
                                    'type'            => 'group',
                                    'title'           => 'Group',
                                    'button_title'    => 'Add More',
                                    'accordion_title' => 'Accordion With Group',
                                    'fields'          => array(
                                        array(
                                            'type'  => 'switcher',
                                            'id'    => 'switcher',
                                            'title' => 'Switcher',
                                        ),
                                        array(
                                            'type'  => 'text',
                                            'id'    => 'text',
                                            'title' => 'Text',
                                        ),
                                    ),
                                ),

                                array(
                                    'type'  => 'switcher',
                                    'id'    => 'switcher',
                                    'title' => 'Switcher',
                                ),
                                array(
                                    'type'  => 'text',
                                    'id'    => 'text',
                                    'title' => 'Text',
                                ),
                            ),
                        ),
                    ),
                ),

                array(
                    'id'        => 'tab_2',
                    'type'      => 'tab',
                    'title'     => 'Tab (left)',
                    'tab_style' => 'left',
                    'sections'  => array(
                        array(
                            'name'   => 'section1',
                            'title'  => 'section 1',
                            'icon'   => 'fa fa-star',
                            'fields' => array(
                                array(
                                    'type'  => 'switcher',
                                    'id'    => 'switcher',
                                    'title' => 'Switcher',
                                ),
                                array(
                                    'type'  => 'text',
                                    'id'    => 'text',
                                    'title' => 'Text',
                                ),
                            ),
                        ),
                        array(
                            'name'   => 'tab_accordion',
                            'title'  => 'Tab Accordion',
                            'icon'   => 'fa fa-list',
                            'fields' => array(
                                array(
                                    'id'              => 'accordion_1',
                                    'type'            => 'accordion',
                                    'accordion_title' => 'Accordion 1',
                                    'title'           => 'Accordion With Title',
                                    'fields'          => array(
                                        array(
                                            'type'  => 'switcher',
                                            'id'    => 'switcher',
                                            'title' => 'Switcher',
                                        ),
                                        array(
                                            'type'  => 'text',
                                            'id'    => 'text',
                                            'title' => 'Text',
                                        ),
                                    ),
                                ),
                                array(
                                    'type'  => 'switcher',
                                    'id'    => 'switcher',
                                    'title' => 'Switcher',
                                ),
                                array(
                                    'type'  => 'text',
                                    'id'    => 'text',
                                    'title' => 'Text',
                                ),
                            ),
                        ),
                        array(
                            'name'   => 'tab_group',
                            'title'  => 'Tab group',
                            'icon'   => 'fa fa-object-group',
                            'fields' => array(
                                array(
                                    'id'              => 'group',
                                    'type'            => 'group',
                                    'title'           => 'Group',
                                    'button_title'    => 'Add More',
                                    'accordion_title' => 'Accordion With Group',
                                    'fields'          => array(
                                        array(
                                            'type'  => 'switcher',
                                            'id'    => 'switcher',
                                            'title' => 'Switcher',
                                        ),
                                        array(
                                            'type'  => 'text',
                                            'id'    => 'text',
                                            'title' => 'Text',
                                        ),
                                    ),
                                ),
                                array(
                                    'type'  => 'switcher',
                                    'id'    => 'switcher',
                                    'title' => 'Switcher',
                                ),
                                array(
                                    'type'  => 'text',
                                    'id'    => 'text',
                                    'title' => 'Text',
                                ),
                            ),
                        ),
                    ),
                ),

                array(
                    'id'        => 'tab_3',
                    'type'      => 'tab',
                    'title'     => 'Tab (default)',
                    'tab_style' => 'default',
                    'sections'  => array(
                        array(
                            'name'   => 'section1',
                            'title'  => 'section 1',
                            'icon'   => 'fa fa-star',
                            'fields' => array(
                                array(
                                    'type'  => 'switcher',
                                    'id'    => 'switcher',
                                    'title' => 'Switcher',
                                ),
                                array(
                                    'type'  => 'text',
                                    'id'    => 'text',
                                    'title' => 'Text',
                                ),
                            ),
                        ),
                        array(
                            'name'   => 'tab_accordion',
                            'title'  => 'Tab Accordion',
                            'icon'   => 'fa fa-list',
                            'fields' => array(
                                array(
                                    'id'              => 'accordion_1',
                                    'type'            => 'accordion',
                                    'accordion_title' => 'Accordion 1',
                                    'title'           => 'Accordion With Title',
                                    'fields'          => array(
                                        array(
                                            'type'  => 'switcher',
                                            'id'    => 'switcher',
                                            'title' => 'Switcher',
                                        ),
                                        array(
                                            'type'  => 'text',
                                            'id'    => 'text',
                                            'title' => 'Text',
                                        ),
                                    ),
                                ),
                                array(
                                    'type'  => 'switcher',
                                    'id'    => 'switcher',
                                    'title' => 'Switcher',
                                ),
                                array(
                                    'type'  => 'text',
                                    'id'    => 'text',
                                    'title' => 'Text',
                                ),
                            ),
                        ),
                        array(
                            'name'   => 'tab_group',
                            'title'  => 'Tab group',
                            'icon'   => 'fa fa-object-group',
                            'fields' => array(
                                array(
                                    'id'              => 'group',
                                    'type'            => 'group',
                                    'title'           => 'Group',
                                    'button_title'    => 'Add More',
                                    'accordion_title' => 'Accordion With Group',
                                    'fields'          => array(
                                        array(
                                            'type'  => 'switcher',
                                            'id'    => 'switcher',
                                            'title' => 'Switcher',
                                        ),
                                        array(
                                            'type'  => 'text',
                                            'id'    => 'text',
                                            'title' => 'Text',
                                        ),
                                    ),
                                ),
                                array(
                                    'type'  => 'switcher',
                                    'id'    => 'switcher',
                                    'title' => 'Switcher',
                                ),
                                array(
                                    'type'  => 'text',
                                    'id'    => 'text',
                                    'title' => 'Text',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        array(
            'name'   => 'group',
            'title'  => 'Group',
            'icon'   => 'fa fa-object-group',
            'fields' => array(
                array(
                    'id'              => 'unique_group_2',
                    'type'            => 'group',
                    'title'           => 'Group Field with Default',
                    'button_title'    => 'Add New',
                    'accordion_title' => 'Add New Field',
                    'fields'          => array(
                        array(
                            'id'    => 'unique_group_2_text',
                            'type'  => 'text',
                            'title' => 'Text Field',
                        ),
                        array(
                            'id'    => 'unique_group_2_switcher',
                            'type'  => 'switcher',
                            'title' => 'Switcher Field',
                        ),
                        array(
                            'id'    => 'unique_group_2_textarea',
                            'type'  => 'textarea',
                            'title' => 'Upload Field',
                        ),
                    ),
                    'default'         => array(
                        array(
                            'unique_group_2_text'     => 'Some text',
                            'unique_group_2_switcher' => TRUE,
                            'unique_group_2_textarea' => 'Some content',
                        ),
                        array(
                            'unique_group_2_text'     => 'Some text 2',
                            'unique_group_2_switcher' => TRUE,
                            'unique_group_2_textarea' => 'Some content 2',
                        ),
                    ),
                ),

                array(
                    'id'              => 'nested_groups',
                    'title'           => 'Nested Groups',
                    'type'            => 'group',
                    'button_title'    => 'Add Nested Group',
                    'accordion_title' => 'Nested Group',
                    'fields'          => array(
                        array( 'title' => 'text', 'type' => 'text', 'id' => 'text' ),
                        array( 'title' => 'switcher', 'type' => 'switcher', 'id' => 'switcher' ),
                        array(
                            'type'            => 'group',
                            'id'              => 'nested_groups_1',
                            'button_title'    => 'Add',
                            'accordion_title' => 'Nested Group Level 1',
                            'fields'          => array(
                                array( 'title' => 'text', 'type' => 'text', 'id' => 'text' ),
                                array( 'title' => 'switcher', 'type' => 'switcher', 'id' => 'switcher' ),
                                array(
                                    'type'            => 'group',
                                    'id'              => 'nested_groups_1_1',
                                    'button_title'    => 'Add',
                                    'title'           => 'Nested Group With Title',
                                    'accordion_title' => 'Nested Group Level 2',
                                    'fields'          => array(
                                        array( 'title' => 'text', 'type' => 'text', 'id' => 'text' ),
                                        array( 'title' => 'switcher', 'type' => 'switcher', 'id' => 'switcher' ),

                                        array(
                                            'type'            => 'group',
                                            'id'              => 'nested_groups_1_1_1',
                                            'button_title'    => 'Add',
                                            'accordion_title' => 'Nested Group Level 3',
                                            'fields'          => array(
                                                array( 'title' => 'text', 'type' => 'text', 'id' => 'text' ),
                                                array(
                                                    'title' => 'switcher',
                                                    'type'  => 'switcher',
                                                    'id'    => 'switcher',
                                                ),

                                                array(
                                                    'type'            => 'group',
                                                    'id'              => 'nested_groups_1_1_1_1',
                                                    'button_title'    => 'Add',
                                                    'accordion_title' => 'Nested Group Level 4',
                                                    'fields'          => array(
                                                        array( 'title' => 'text', 'type' => 'text', 'id' => 'text' ),
                                                        array(
                                                            'title' => 'switcher',
                                                            'type'  => 'switcher',
                                                            'id'    => 'switcher',
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),

                    ),
                ),

                array(
                    'id'              => 'nested_gr11oups',
                    'type'            => 'group',
                    'button_title'    => 'Add Nested Group',
                    'accordion_title' => 'Nested Group',
                    'fields'          => array(
                        array( 'title' => 'text', 'type' => 'text', 'id' => 'text' ),
                        array( 'title' => 'switcher', 'type' => 'switcher', 'id' => 'switcher' ),
                        array(
                            'type'            => 'group',
                            'id'              => 'nes33ted_groups_1',
                            'button_title'    => 'Add',
                            'accordion_title' => 'Nested Group Level 1',
                            'fields'          => array(
                                array( 'title' => 'text', 'type' => 'text', 'id' => 'text' ),
                                array( 'title' => 'switcher', 'type' => 'switcher', 'id' => 'switcher' ),
                                array(
                                    'type'            => 'group',
                                    'id'              => 'nested_groups_1_1',
                                    'button_title'    => 'Add',
                                    'title'           => 'Nested Group With Title',
                                    'accordion_title' => 'Nested Group Level 2',
                                    'fields'          => array(
                                        array( 'title' => 'text', 'type' => 'text', 'id' => 'text' ),
                                        array( 'title' => 'switcher', 'type' => 'switcher', 'id' => 'switcher' ),

                                        array(
                                            'type'            => 'group',
                                            'id'              => 'nested_groups_1_1_1',
                                            'button_title'    => 'Add',
                                            'accordion_title' => 'Nested Group Level 3',
                                            'fields'          => array(
                                                array( 'title' => 'text', 'type' => 'text', 'id' => 'text' ),
                                                array(
                                                    'title' => 'switcher',
                                                    'type'  => 'switcher',
                                                    'id'    => 'switcher',
                                                ),

                                                array(
                                                    'type'            => 'group',
                                                    'id'              => 'nested_groups_1_1_1_1',
                                                    'button_title'    => 'Add',
                                                    'accordion_title' => 'Nested Group Level 4',
                                                    'fields'          => array(
                                                        array( 'title' => 'text', 'type' => 'text', 'id' => 'text' ),
                                                        array(
                                                            'title' => 'switcher',
                                                            'type'  => 'switcher',
                                                            'id'    => 'switcher',
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),

                    ),
                ),

                array(
                    'id'              => 'unique_group_12',
                    'type'            => 'group',
                    'title'           => 'Group Field with 1',
                    'button_title'    => 'Add New1',
                    'accordion_title' => 'Add New Field1',
                    'fields'          => array(

                        array(
                            'id'    => 'unique_group_12_text',
                            'type'  => 'text',
                            'title' => 'Text Field',
                        ),
                        array(
                            'id'    => 'unique_group_12_switcher',
                            'type'  => 'switcher',
                            'title' => 'Switcher Field',
                        ),
                        array(
                            'id'    => 'unique_group_12_textarea',
                            'type'  => 'textarea',
                            'title' => 'Upload Field',
                        ),
                    ),
                    'default'         => array(
                        array(
                            'unique_group_12_text'     => 'Some text',
                            'unique_group_12_switcher' => TRUE,
                            'unique_group_12_textarea' => 'Some content',
                        ),
                        array(
                            'unique_group_12_text'     => 'Some text 2',
                            'unique_group_12_switcher' => TRUE,
                            'unique_group_12_textarea' => 'Some content 2',
                        ),
                    ),
                ),
                array(
                    'id'              => 'unique_group_3',
                    'type'            => 'group',
                    'title'           => 'Group Field',
                    'info'            => 'You can use any option field on group',
                    'button_title'    => 'Add New Something',
                    'accordion_title' => 'Adding New Thing',
                    'fields'          => array(
                        array(
                            'id'    => 'unique_group_3_text',
                            'type'  => 'upload',
                            'title' => 'Text Field',
                        ),
                    ),
                ),
                array(
                    'id'              => 'unique_group_4',
                    'type'            => 'group',
                    'title'           => 'Group Field',
                    'desc'            => 'Accordion title using the ID of the field, for eg. "Text Field 2" using as accordion title here.',
                    'button_title'    => 'Add New',
                    'accordion_title' => 'unique_group_4_text_2',
                    'fields'          => array(
                        array(
                            'id'    => 'richtxt',
                            'type'  => 'wysiwyg',
                            'title' => 'wysiwyg',
                        ),
                        array(
                            'id'    => 'unique_group_4_text_1',
                            'type'  => 'text',
                            'title' => 'Text Field 1',
                        ),
                        array(
                            'id'    => 'unique_group_4_text_2',
                            'type'  => 'text',
                            'title' => 'Text Field 2',
                        ),
                        array(
                            'id'    => 'unique_group_4_text_3',
                            'type'  => 'text',
                            'title' => 'Text Field 3',
                        ),
                    ),
                ),
            ),
        ),

        array(
            'name'   => 'columns',
            'title'  => 'Columns',
            'icon'   => 'fa fa-columns',
            'fields' => array(
                array(
                    'content' => 'Columns With elements',
                    'type'    => 'subheading',
                ),
                array( 'title' => 'text', 'type' => 'text', 'id' => 'text', 'columns' => 4 ),
                array( 'title' => 'switcher', 'type' => 'switcher', 'id' => 'switcher', 'columns' => 4 ),
                array( 'title' => 'color_picker', 'type' => 'color_picker', 'id' => 'color_picker', 'columns' => 4 ),
                array(
                    'id'              => 'accordion_columns',
                    'type'            => 'accordion',
                    'accordion_title' => 'Accordion Columns',
                    'title'           => 'Accordion With Columns',
                    'fields'          => array(
                        array(
                            'type'    => 'switcher',
                            'id'      => 'switcher',
                            'title'   => 'Switcher',
                            'columns' => 6,
                        ),
                        array(
                            'type'    => 'text',
                            'id'      => 'text',
                            'title'   => 'Text',
                            'columns' => 6,
                        ),
                    ),
                ),
                array(
                    'id'     => 'fieldset_columns',
                    'type'   => 'fieldset',
                    'title'  => 'Fieldset Columns',
                    'fields' => array(
                        array(
                            'id'      => 'fieldset_1_text',
                            'type'    => 'text',
                            'title'   => 'Text Field',
                            'columns' => 4,
                        ),
                        array(
                            'id'      => 'fieldset_1_upload',
                            'type'    => 'upload',
                            'title'   => 'Upload Field',
                            'columns' => 4,
                        ),
                        array(
                            'id'      => 'fieldset_1_textarea',
                            'type'    => 'textarea',
                            'title'   => 'Textarea Field',
                            'columns' => 4,
                        ),
                    ),
                ),

                array(
                    'id'        => 'tab_1',
                    'type'      => 'tab',
                    'title'     => 'Tab (boxed)',
                    'tab_style' => 'box',
                    'sections'  => array(
                        array(
                            'name'   => 'section1',
                            'title'  => 'section 1',
                            'icon'   => 'fa fa-star',
                            'fields' => array(
                                array(
                                    'type'    => 'switcher',
                                    'id'      => 'switcher',
                                    'title'   => 'Switcher',
                                    'columns' => 6,
                                ),
                                array(
                                    'type'    => 'text',
                                    'id'      => 'text',
                                    'title'   => 'Text',
                                    'columns' => 6,
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),

        array(
            'name'   => 'spacing',
            'title'  => 'Spacing',
            'icon'   => 'fa fa-arrows',
            'fields' => array(
                array(
                    'title' => 'Spacing',
                    'type'  => 'spacing',
                    'id'    => 'spacing',
                ),
                array(
                    'title' => 'Date Picker',
                    'type'  => 'date_picker',
                    'id'    => 'date_picker',
                ),
            ),
        ),
    ),
);


// ------------------------------
// a seperator                  -
// ------------------------------
$options[] = array(
    'name'  => 'seperator_1',
    'title' => 'A Seperator',
    'icon'  => 'fa fa-bookmark',
);
// ------------------------------
// backup                       -
// ------------------------------
$options[] = array(
    'name'   => 'backup_section',
    'title'  => 'Backup',
    'icon'   => 'fa fa-shield',
    'fields' => array(
        array(
            'type'    => 'notice',
            'class'   => 'warning',
            'content' => 'You can save your current options. Download a Backup and Import.',
        ),
        array(
            'type' => 'backup',
        ),
    ),
);
// ------------------------------
// validate                     -
// ------------------------------
$options[] = array(
    'name'   => 'validate_section',
    'title'  => 'Validate',
    'icon'   => 'fa fa-check-circle',
    'fields' => array(
        array(
            'id'       => 'validate_text_1',
            'type'     => 'text',
            'title'    => 'Email Text',
            'desc'     => 'This text field only accepted email address.',
            'default'  => 'info@domain.com',
            'validate' => 'email',
        ),
        array(
            'id'       => 'numeric_text_1',
            'type'     => 'text',
            'title'    => 'Numeric Text',
            'desc'     => 'This text field only accepted numbers',
            'default'  => '123456',
            'validate' => 'numeric',
        ),
        array(
            'id'       => 'required_text_1',
            'type'     => 'text',
            'title'    => 'Requried Text',
            'after'    => ' <small class="cs-text-warning">( * required )</small>',
            'default'  => 'lorem ipsum',
            'validate' => 'required',
        ),
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => 'Also you can add your own validate from <strong>themename/cs-framework/functions/validate.php</strong>',
        ),
    ),
);
// ------------------------------
// sanitize                     -
// ------------------------------
$options[] = array(
    'name'   => 'sanitize_section',
    'title'  => 'Sanitize',
    'icon'   => 'fa fa-repeat',
    'fields' => array(
        array(
            'id'    => 'sanitie_text_1',
            'type'  => 'text',
            'title' => 'Sanitized Text',
            'after' => '<p class="cs-text-muted">This text field sanitized already, without any settings. we are using wordpress core.<br /> for eg. try too add <strong>&lt;p></strong> html tag</p>',
        ),
        array(
            'id'       => 'sanitie_text_2',
            'type'     => 'text',
            'title'    => 'Disable Sanitized Text',
            'after'    => '<p class="cs-text-muted">Disabled sanitize for this field (sanitize=false). try too add <strong>&lt;p></strong> html tag so, you can write anything</p>',
            'sanitize' => FALSE,
        ),
        array(
            'id'    => 'sanitie_textarea_1',
            'type'  => 'textarea',
            'title' => 'Sanitized Textarea',
            'after' => '<p class="cs-text-muted">This textarea field sanitized already, without any settings. we are using wordpress core.<br /> just allowing this tags wp core $allowedposttags</p>',
        ),
        array(
            'id'       => 'sanitie_textarea_2',
            'type'     => 'textarea',
            'title'    => 'Disabled Sanitized Textarea',
            'after'    => '<p class="cs-text-muted">Disabled sanitize for this field (sanitize=false). you can write anything</p>',
            'sanitize' => FALSE,
        ),
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => 'Custom Sanitize, Also you can add your own validate from <strong>themename/cs-framework/functions/sanitize.php</strong>',
        ),
        array(
            'id'       => 'sanitie_text_11',
            'type'     => 'text',
            'title'    => 'Custom Sanitize Text',
            'after'    => '<p class="cs-text-muted">This text field sanitized as slug title (sanitize="title")</p>',
            'sanitize' => 'title',
        ),
    ),
);
// ----------------------------------------
// dependencies                           -
// ----------------------------------------
$options[] = array(
    'name'   => 'dependencies',
    'title'  => 'Dependencies',
    'icon'   => 'fa fa-code-fork',
    'fields' => array(
        // ------------------------------------
        // Basic Dependencies
        // ------------------------------------
        array(
            'type'    => 'subheading',
            'content' => 'Basic Dependencies',
        ),
        // ------------------------------------
        array(
            'id'    => 'dep_1',
            'type'  => 'text',
            'title' => 'If text <u>not be empty</u>',
        ),
        array(
            'id'         => 'dummy_1',
            'type'       => 'notice',
            'class'      => 'info',
            'content'    => 'Done, this text option have something.',
            'dependency' => array(
                'dep_1',
                '!=',
                '',
            ),
        ),
        // ------------------------------------
        // ------------------------------------
        array(
            'id'    => 'dep_2',
            'type'  => 'switcher',
            'title' => 'If switcher mode <u>ON</u>',
        ),
        array(
            'id'         => 'dummy_2',
            'type'       => 'notice',
            'class'      => 'success',
            'content'    => 'Woow! Switcher is ON',
            'dependency' => array(
                'dep_2',
                '==',
                'true',
            ),
        ),
        // ------------------------------------
        // ------------------------------------
        array(
            'id'      => 'dep_3',
            'type'    => 'select',
            'title'   => 'Select color <u>black or white</u>',
            'options' => array(
                'blue'   => 'Blue',
                'yellow' => 'Yellow',
                'green'  => 'Green',
                'black'  => 'Black',
                'white'  => 'White',
            ),
        ),
        array(
            'id'         => 'dummy_3',
            'type'       => 'notice',
            'class'      => 'danger',
            'content'    => 'Well done!',
            'dependency' => array(
                'dep_3',
                'any',
                'black,white',
            ),
        ),
        // ------------------------------------
        // ------------------------------------
        array(
            'id'      => 'dep_4',
            'type'    => 'radio',
            'title'   => 'If set <u>No, Thanks</u>',
            'options' => array(
                'yes'      => 'Yes, Please',
                'no'       => 'No, Thanks',
                'not-sure' => 'I am not sure!',
            ),
            'default' => 'yes',
        ),
        array(
            'id'         => 'dummy_4',
            'type'       => 'notice',
            'class'      => 'info',
            'content'    => 'Uh why?!!!',
            'dependency' => array(
                'dep_4_no',
                '==',
                'true',
            ),
            //'dependency' => array( '{ID}_{VALUE}', '==', 'true' ),
        ),
        // ------------------------------------
        // ------------------------------------
        array(
            'id'      => 'dep_5',
            'type'    => 'checkbox',
            'title'   => 'If checked <u>danger</u>',
            'options' => array(
                'success' => 'Success',
                'danger'  => 'Danger',
                'info'    => 'Info',
                'warning' => 'Warning',
            ),
        ),
        array(
            'id'         => 'dummy_5',
            'type'       => 'notice',
            'class'      => 'danger',
            'content'    => 'Danger!',
            'dependency' => array(
                'dep_5_danger',
                '==',
                'true',
            ),
            //'dependency' => array( '{ID}_{VALUE}', '==', 'true' ),
        ),
        // ------------------------------------
        // ------------------------------------
        array(
            'id'      => 'dep_6',
            'type'    => 'image_select',
            'title'   => 'If check <u>Blue box</u> (checkbox)',
            'options' => array(
                'green'  => 'http://codestarframework.com/assets/images/placeholder/100x80-2ecc71.gif',
                'red'    => 'http://codestarframework.com/assets/images/placeholder/100x80-e74c3c.gif',
                'yellow' => 'http://codestarframework.com/assets/images/placeholder/100x80-ffbc00.gif',
                'blue'   => 'http://codestarframework.com/assets/images/placeholder/100x80-3498db.gif',
                'gray'   => 'http://codestarframework.com/assets/images/placeholder/100x80-555555.gif',
            ),
            'info'    => 'Image select field input="checkbox" model. in checkbox model unselected available.',
        ),
        array(
            'id'         => 'dummy_6',
            'type'       => 'notice',
            'class'      => 'info',
            'content'    => 'Blue box selected!',
            'dependency' => array(
                'dep_6_blue',
                '==',
                'true',
            ),
            //'dependency' => array( '{ID}_{VALUE}', '==', 'true' ),
        ),
        // ------------------------------------
        // ------------------------------------
        array(
            'id'         => 'dep_6_alt',
            'type'       => 'image_select',
            'title'      => 'If check <u>Green box or Blue box</u> (checkbox)',
            'options'    => array(
                'green'  => 'http://codestarframework.com/assets/images/placeholder/100x80-2ecc71.gif',
                'red'    => 'http://codestarframework.com/assets/images/placeholder/100x80-e74c3c.gif',
                'yellow' => 'http://codestarframework.com/assets/images/placeholder/100x80-ffbc00.gif',
                'blue'   => 'http://codestarframework.com/assets/images/placeholder/100x80-3498db.gif',
                'gray'   => 'http://codestarframework.com/assets/images/placeholder/100x80-555555.gif',
            ),
            'info'       => 'Multipel Image select field input="checkbox" model. in checkbox model unselected available.',
            'default'    => 'gray',
            'attributes' => array(
                'data-depend-id' => 'dep_6_alt',
            ),
        ),
        array(
            'id'         => 'dummy_6_alt',
            'type'       => 'notice',
            'class'      => 'success',
            'content'    => 'Green or Blue box selected!',
            'dependency' => array(
                'dep_6_alt',
                'any',
                'green,blue',
            ),
            //'dependency' => array( 'data-depend-id', 'any', 'value,value' ),
        ),
        // ------------------------------------
        // ------------------------------------
        array(
            'id'      => 'dep_7',
            'type'    => 'image_select',
            'title'   => 'If check <u>Green box</u> (radio)',
            'options' => array(
                'green'  => 'http://codestarframework.com/assets/images/placeholder/100x80-2ecc71.gif',
                'red'    => 'http://codestarframework.com/assets/images/placeholder/100x80-e74c3c.gif',
                'yellow' => 'http://codestarframework.com/assets/images/placeholder/100x80-ffbc00.gif',
                'blue'   => 'http://codestarframework.com/assets/images/placeholder/100x80-3498db.gif',
                'gray'   => 'http://codestarframework.com/assets/images/placeholder/100x80-555555.gif',
            ),
            'info'    => 'Image select field input="radio" model. in radio model unselected unavailable.',
            'radio'   => TRUE,
            'default' => 'gray',
        ),
        array(
            'id'         => 'dummy_7',
            'type'       => 'notice',
            'class'      => 'success',
            'content'    => 'Green box selected!',
            'dependency' => array(
                'dep_7_green',
                '==',
                'true',
            ),
            //'dependency' => array( '{ID}_{VALUE}', '==', 'true' ),
        ),
        // ------------------------------------
        // ------------------------------------
        array(
            'id'         => 'dep_7_alt',
            'type'       => 'image_select',
            'title'      => 'If check <u>Green box or Blue box</u> (radio)',
            'options'    => array(
                'green'  => 'http://codestarframework.com/assets/images/placeholder/100x80-2ecc71.gif',
                'red'    => 'http://codestarframework.com/assets/images/placeholder/100x80-e74c3c.gif',
                'yellow' => 'http://codestarframework.com/assets/images/placeholder/100x80-ffbc00.gif',
                'blue'   => 'http://codestarframework.com/assets/images/placeholder/100x80-3498db.gif',
                'gray'   => 'http://codestarframework.com/assets/images/placeholder/100x80-555555.gif',
            ),
            'info'       => 'Multipel Image select field input="radio" model. in radio model unselected unavailable.',
            'radio'      => TRUE,
            'default'    => 'gray',
            'attributes' => array(
                'data-depend-id' => 'dep_7_alt',
            ),
        ),
        array(
            'id'         => 'dummy_7_alt',
            'type'       => 'notice',
            'class'      => 'success',
            'content'    => 'Green or Blue box selected!',
            'dependency' => array(
                'dep_7_alt',
                'any',
                'green,blue',
            ),
            //'dependency' => array( 'data-depend-id', 'any', 'value,value' ),
        ),
        // ------------------------------------
        // ------------------------------------
        array(
            'id'    => 'dep_8',
            'type'  => 'image',
            'title' => 'Add a image',
        ),
        array(
            'id'         => 'dummy_8',
            'type'       => 'notice',
            'class'      => 'success',
            'content'    => 'Added a image!',
            'dependency' => array(
                'dep_8',
                '!=',
                '',
            ),
        ),
        // ------------------------------------
        // ------------------------------------
        array(
            'id'    => 'dep_9',
            'type'  => 'icon',
            'title' => 'Add a icon',
        ),
        array(
            'id'         => 'dummy_9',
            'type'       => 'notice',
            'class'      => 'success',
            'content'    => 'Added a icon!',
            'dependency' => array(
                'dep_9',
                '!=',
                '',
            ),
        ),
        // ------------------------------------
        // ------------------------------------
        // Advanced Dependencies
        // ------------------------------------
        array(
            'type'    => 'subheading',
            'content' => 'Advanced Dependencies',
        ),
        // ------------------------------------
        array(
            'id'    => 'dep_10',
            'type'  => 'text',
            'title' => 'If text string <u>hello</u>',
        ),
        array(
            'id'    => 'dep_11',
            'type'  => 'text',
            'title' => 'and this text string <u>world</u>',
        ),
        array(
            'id'    => 'dep_12',
            'type'  => 'checkbox',
            'title' => 'and checkbox mode <u>checked</u>',
            'label' => 'Check me!',
        ),
        array(
            'id'         => 'dummy_10',
            'type'       => 'notice',
            'class'      => 'info',
            'content'    => 'Done, Multiple Dependencies worked.',
            'dependency' => array(
                'dep_10|dep_11|dep_12',
                '==|==|==',
                'hello|world|true',
            ),
        ),
        // ------------------------------------
        // ------------------------------------
        // Another Dependencies
        // ------------------------------------
        array(
            'type'    => 'subheading',
            'content' => 'Another Dependencies',
        ),
        // ------------------------------------
        array(
            'id'      => 'dep_13',
            'type'    => 'select',
            'title'   => 'If color <u>black or white</u>',
            'options' => array(
                'blue'  => 'Blue',
                'black' => 'Black',
                'white' => 'White',
            ),
        ),
        array(
            'id'      => 'dep_14',
            'type'    => 'select',
            'title'   => 'If size <u>middle</u>',
            'options' => array(
                'small'  => 'Small',
                'middle' => 'Middle',
                'large'  => 'Large',
                'xlage'  => 'XLarge',
            ),
        ),
        array(
            'id'         => 'dep_15',
            'type'       => 'select',
            'title'      => 'If text is <u>world</u>',
            'options'    => array(
                'hello' => 'Hello',
                'world' => 'World',
            ),
            'dependency' => array(
                'dep_13|dep_14',
                'any|==',
                'black,white|middle',
            ),
        ),
        array(
            'id'         => 'dummy_11',
            'type'       => 'notice',
            'class'      => 'info',
            'content'    => 'Well done, Correctly!',
            'dependency' => array(
                'dep_15',
                '==',
                'world',
            ),
        ),
        // ------------------------------------
    ),
);
// ------------------------------
// a seperator                  -
// ------------------------------
$options[] = array(
    'name'  => 'seperator_2',
    'title' => 'Section Examples',
    'icon'  => 'fa fa-cog',
);
// ------------------------------
// normal section               -
// ------------------------------
$options[] = array(
    'name'   => 'normal_section',
    'title'  => 'Normal Section',
    'icon'   => 'fa fa-minus',
    'fields' => array(
        array(
            'type'    => 'content',
            'content' => 'This section is empty, add some options...',
        ),
    ),
);
// ------------------------------
// accordion sections           -
// ------------------------------
$options[] = array(
    'name'     => 'accordion_section',
    'title'    => 'Accordion Sections',
    'icon'     => 'fa fa-bars',
    'sections' => array(
        // sub section 1
        array(
            'name'   => 'sub_section_1',
            'title'  => 'Sub Sections 1',
            'icon'   => 'fa fa-minus',
            'fields' => array(
                array(
                    'type'    => 'content',
                    'content' => 'This section is empty, add some options...',
                ),
            ),
        ),
        // sub section 2
        array(
            'name'   => 'sub_section_2',
            'title'  => 'Sub Sections 2',
            'icon'   => 'fa fa-minus',
            'fields' => array(
                array(
                    'type'    => 'content',
                    'content' => 'This section is empty, add some options...',
                ),
            ),
        ),
        // sub section 3
        array(
            'name'   => 'sub_section_3',
            'title'  => 'Sub Sections 3',
            'icon'   => 'fa fa-minus',
            'fields' => array(
                array(
                    'type'    => 'content',
                    'content' => 'This section is empty, add some options...',
                ),
            ),
        ),
    ),
);
// ------------------------------
// a seperator                  -
// ------------------------------
$options[] = array(
    'name'  => 'seperator_3',
    'title' => 'Others',
    'icon'  => 'fa fa-gift',
);
// ------------------------------
// license                      -
// ------------------------------
$options[] = array(
    'name'   => 'license_section',
    'title'  => 'License',
    'icon'   => 'fa fa-info-circle',
    'fields' => array(
        array(
            'type'    => 'heading',
            'content' => '100% GPL License, Yes it is free!',
        ),
        array(
            'type'    => 'content',
            'content' => 'WPSF Framework is <strong>free</strong> to use both personal and commercial. If you used commercial, <strong>please credit</strong>. Read more about <a href="http://www.gnu.org/licenses/gpl-2.0.txt" target="_blank">GNU License</a>',
        ),
    ),
);

new WPSFramework_Settings(array(
    'menu_title'       => 'WPSF Modern',
    'menu_slug'        => 'wpsf-modern',
    'style'            => 'modern',
    'is_sticky_header' => FALSE,
    'is_single_page'   => FALSE,
    'option_name'      => '_wpsf_new_option',
), $options);
