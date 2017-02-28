<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',

    'sizes' => array(
        'thumbnail' => array(
            'width' => 600,
            'height' => 600,
            'crop' => true
        ),
        'small' => array(
            'width' => 740,
            'height' => 1200,
            'fit' => true
        ),
        'medium' => array(
            'width' => 1024,
            'height' => 768,
            'fit' => true
        ),
        'large' => array(
            'width' => 1440,
            'height' => 900,
            'fit' => true
        ),
        'xlarge' => array(
            'width' => 1920,
            'height' => 1080,
            'fit' => true
        ),
        'email' => array(
            'width' => 640,
            'height' =>360,
            'fit' => true
        )
    )

);
