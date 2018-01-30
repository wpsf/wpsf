<?php
/**
 * Created by PhpStorm.
 * User: varun
 * Date: 30-01-2018
 * Time: 10:13 AM
 */

$wpsf_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';

new WPSFramework_Help_Tabs(array(
    'toplevel_page_wpsf-modern' => array(
        array(
            'id'     => 'tab1',
            'title'  => 'TAB 1',
            'fields' => array(
                array(
                    'type'    => 'heading',
                    'content' => 'MyHeading',
                ),
                array( 'type' => 'content', 'content' => $wpsf_content, ),
                array(
                    'type'    => 'subheading',
                    'content' => 'Sub Heading',
                ),
                array( 'type' => 'content', 'content' => $wpsf_content, ),
                array(
                    'type'            => 'accordion',
                    'accordion_title' => 'Accordion 1',
                    'fields'          => array( array( 'type' => 'content', 'content' => $wpsf_content, ), ),
                ),
                array(
                    'type'            => 'accordion',
                    'accordion_title' => 'Accordion 2',
                    'fields'          => array(
                        array(
                            'type'    => 'heading',
                            'content' => 'MyHeading',
                        ),
                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                        array(
                            'type'    => 'subheading',
                            'content' => 'Sub Heading',
                        ),
                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                    ),
                ),

                array(
                    'type'     => 'tab',
                    'sections' => array(
                        array(
                            'name'   => 'section1',
                            'title'  => 'Section1',
                            'fields' => array(
                                array( 'type' => 'content', 'content' => $wpsf_content ),
                                array(
                                    'type'    => 'heading',
                                    'content' => 'MyHeading',
                                ),
                                array( 'type' => 'content', 'content' => $wpsf_content, ),
                                array(
                                    'type'    => 'subheading',
                                    'content' => 'Sub Heading',
                                ),
                                array( 'type' => 'content', 'content' => $wpsf_content, ),
                            ),
                        ),
                        array(
                            'name'   => 'section2',
                            'title'  => 'Section2',
                            'fields' => array(
                                array(
                                    'type'            => 'accordion',
                                    'accordion_title' => 'Accordion 1',
                                    'fields'          => array(
                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                    ),
                                ),
                                array(
                                    'type'            => 'accordion',
                                    'accordion_title' => 'Accordion 2',
                                    'fields'          => array(
                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                    ),
                                ),
                                array(
                                    'type'            => 'accordion',
                                    'accordion_title' => 'Accordion 3',
                                    'fields'          => array(
                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                    ),
                                ),
                                array(
                                    'type'            => 'accordion',
                                    'accordion_title' => 'Accordion 4',
                                    'fields'          => array(
                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'name'   => 'section3',
                            'title'  => 'Section3',
                            'fields' => array(
                                array(
                                    'type'            => 'accordion',
                                    'accordion_title' => 'Accordion 1',
                                    'fields'          => array(
                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                        array( 'type' => 'content', 'content' => $wpsf_content ),

                                        array(
                                            'type'            => 'accordion',
                                            'accordion_title' => 'Accordion -> 1',
                                            'fields'          => array(
                                                array( 'type' => 'content', 'content' => $wpsf_content, ),
                                                array( 'type' => 'content', 'content' => $wpsf_content ),

                                                array(
                                                    'type'            => 'accordion',
                                                    'accordion_title' => 'Accordion -> 1 -> 1',
                                                    'fields'          => array(
                                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'name'   => 'section4',
                            'title'  => 'section 4',
                            'fields' => array(
                                array(
                                    'type'     => 'tab',
                                    'sections' => array(
                                        array(
                                            'name'   => 'Ssection1',
                                            'title'  => 'Section1',
                                            'fields' => array(
                                                array( 'type' => 'content', 'content' => $wpsf_content ),
                                                array( 'type' => 'content', 'content' => $wpsf_content ),
                                                array( 'type' => 'content', 'content' => $wpsf_content ),
                                            ),
                                        ),
                                        array(
                                            'name'   => 'Ssection2',
                                            'title'  => 'Section2',
                                            'fields' => array(
                                                array(
                                                    'type'            => 'accordion',
                                                    'accordion_title' => 'Accordion 1',
                                                    'fields'          => array(
                                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                                    ),
                                                ),
                                                array(
                                                    'type'            => 'accordion',
                                                    'accordion_title' => 'Accordion 2',
                                                    'fields'          => array(
                                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                                    ),
                                                ),
                                                array(
                                                    'type'            => 'accordion',
                                                    'accordion_title' => 'Accordion 3',
                                                    'fields'          => array(
                                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                                    ),
                                                ),
                                                array(
                                                    'type'            => 'accordion',
                                                    'accordion_title' => 'Accordion 4',
                                                    'fields'          => array(
                                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name'   => 'Ssection3',
                                            'title'  => 'Section2',
                                            'fields' => array(
                                                array(
                                                    'type'            => 'accordion',
                                                    'accordion_title' => 'Accordion 1',
                                                    'fields'          => array(
                                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                                        array( 'type' => 'content', 'content' => $wpsf_content ),

                                                        array(
                                                            'type'            => 'accordion',
                                                            'accordion_title' => 'Accordion -> 1',
                                                            'fields'          => array(
                                                                array(
                                                                    'type'    => 'content',
                                                                    'content' => $wpsf_content,
                                                                ),
                                                                array(
                                                                    'type'    => 'content',
                                                                    'content' => $wpsf_content,
                                                                ),

                                                                array(
                                                                    'type'            => 'accordion',
                                                                    'accordion_title' => 'Accordion -> 1 -> 1',
                                                                    'fields'          => array(
                                                                        array(
                                                                            'type'    => 'content',
                                                                            'content' => $wpsf_content,
                                                                        ),
                                                                        array(
                                                                            'type'    => 'content',
                                                                            'content' => $wpsf_content,
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
                            ),
                        ),
                    ),
                ),
                array(
                    'type'      => 'tab',
                    'tab_style' => 'box',
                    'sections'  => array(
                        array(
                            'name'   => 'section1',
                            'title'  => 'Section1',
                            'fields' => array(
                                array( 'type' => 'content', 'content' => $wpsf_content ),
                                array(
                                    'type'    => 'heading',
                                    'content' => 'MyHeading',
                                ),
                                array( 'type' => 'content', 'content' => $wpsf_content, ),
                                array(
                                    'type'    => 'subheading',
                                    'content' => 'Sub Heading',
                                ),
                                array( 'type' => 'content', 'content' => $wpsf_content, ),
                            ),
                        ),
                        array(
                            'name'   => 'section2',
                            'title'  => 'Section2',
                            'fields' => array(
                                array(
                                    'type'            => 'accordion',
                                    'accordion_title' => 'Accordion 1',
                                    'fields'          => array(
                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                    ),
                                ),
                                array(
                                    'type'            => 'accordion',
                                    'accordion_title' => 'Accordion 2',
                                    'fields'          => array(
                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                    ),
                                ),
                                array(
                                    'type'            => 'accordion',
                                    'accordion_title' => 'Accordion 3',
                                    'fields'          => array(
                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                    ),
                                ),
                                array(
                                    'type'            => 'accordion',
                                    'accordion_title' => 'Accordion 4',
                                    'fields'          => array(
                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'name'   => 'section3',
                            'title'  => 'Section3',
                            'fields' => array(
                                array(
                                    'type'            => 'accordion',
                                    'accordion_title' => 'Accordion 1',
                                    'fields'          => array(
                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                        array( 'type' => 'content', 'content' => $wpsf_content ),

                                        array(
                                            'type'            => 'accordion',
                                            'accordion_title' => 'Accordion -> 1',
                                            'fields'          => array(
                                                array( 'type' => 'content', 'content' => $wpsf_content, ),
                                                array( 'type' => 'content', 'content' => $wpsf_content ),

                                                array(
                                                    'type'            => 'accordion',
                                                    'accordion_title' => 'Accordion -> 1 -> 1',
                                                    'fields'          => array(
                                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'name'   => 'section4',
                            'title'  => 'section 4',
                            'fields' => array(
                                array(
                                    'type'     => 'tab',
                                    'sections' => array(
                                        array(
                                            'name'   => 'Ssection1',
                                            'title'  => 'Section1',
                                            'fields' => array(
                                                array( 'type' => 'content', 'content' => $wpsf_content ),
                                                array( 'type' => 'content', 'content' => $wpsf_content ),
                                                array( 'type' => 'content', 'content' => $wpsf_content ),
                                            ),
                                        ),
                                        array(
                                            'name'   => 'Ssection2',
                                            'title'  => 'Section2',
                                            'fields' => array(
                                                array(
                                                    'type'            => 'accordion',
                                                    'accordion_title' => 'Accordion 1',
                                                    'fields'          => array(
                                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                                    ),
                                                ),
                                                array(
                                                    'type'            => 'accordion',
                                                    'accordion_title' => 'Accordion 2',
                                                    'fields'          => array(
                                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                                    ),
                                                ),
                                                array(
                                                    'type'            => 'accordion',
                                                    'accordion_title' => 'Accordion 3',
                                                    'fields'          => array(
                                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                                    ),
                                                ),
                                                array(
                                                    'type'            => 'accordion',
                                                    'accordion_title' => 'Accordion 4',
                                                    'fields'          => array(
                                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                                        array( 'type' => 'content', 'content' => $wpsf_content ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name'   => 'Ssection3',
                                            'title'  => 'Section2',
                                            'fields' => array(
                                                array(
                                                    'type'            => 'accordion',
                                                    'accordion_title' => 'Accordion 1',
                                                    'fields'          => array(
                                                        array( 'type' => 'content', 'content' => $wpsf_content, ),
                                                        array( 'type' => 'content', 'content' => $wpsf_content ),

                                                        array(
                                                            'type'            => 'accordion',
                                                            'accordion_title' => 'Accordion -> 1',
                                                            'fields'          => array(
                                                                array(
                                                                    'type'    => 'content',
                                                                    'content' => $wpsf_content,
                                                                ),
                                                                array(
                                                                    'type'    => 'content',
                                                                    'content' => $wpsf_content,
                                                                ),

                                                                array(
                                                                    'type'            => 'accordion',
                                                                    'accordion_title' => 'Accordion -> 1 -> 1',
                                                                    'fields'          => array(
                                                                        array(
                                                                            'type'    => 'content',
                                                                            'content' => $wpsf_content,
                                                                        ),
                                                                        array(
                                                                            'type'    => 'content',
                                                                            'content' => $wpsf_content,
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
                            ),
                        ),
                    ),
                ),
            ),
        ),

    ),
));