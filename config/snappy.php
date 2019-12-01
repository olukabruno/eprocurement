<?php

return array(

    'pdf' => array(
        'enabled' => true,
        'binary' => base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf'),
        // 'binary' => '"C:\wkhtmltopdf\bin\wkhtmltopdf"',
        'options' => array(
            "footer-right" => "Page [page] of [topage]",
            "footer-font-size" => 6,
            'margin-top'    => 5,
            'margin-right'  => 10,
            'margin-bottom' => 6,
            'margin-left'   => 10,
            'page-size' => 'A4',
            'orientation' => 'landscape'
        ),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary' => base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltoimage'),
        // 'binary' => '"C:\wkhtmltopdf\bin\wkhtmltoimage"',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
