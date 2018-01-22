<?php
/*-------------------------------------------------------------------------------------------------
- This file is part of the WPSF package.                                                         -
- This package is Open Source Software. For the full copyright and license                       -
- information, please view the LICENSE file which was distributed with this                      -
- source code.                                                                                   -
-                                                                                                -
- @package    WPSF                                                                               -
- @author     Varun Sridharan <varunsridharan23@gmail.com>                                       -
-------------------------------------------------------------------------------------------------*/ // Silence is golden.


$_POST = array(
    'order_id' => 49,
    'email'    => 'kk@gmail.com',
    'requests' => array(
        '34' => array(
            'variation_id'       => 80,
            'request_type'       => 'exchange',
            'quantity'           => 1,
            'product_attributes' => array(
                'product_attr_size'  => 'small',
                'product_attr_size2' => 'small2',
            ),
            'comments'           => 'small',
        ),

        '34' => array(
            'variation_id' => 80,
            'request_type' => 'exchange',
            'quantity'     => 1,
            'reason'       => 'other',
            'comments'     => 'small',
        ),
    ),

);