<?php

return [
    'name' => 'Glacerie Receipt Calculator',
    'manifest' => [
        'name' => env('APP_NAME', 'My PWA App'),
        'short_name' => 'Glacerie R&C',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation'=> 'portrait',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => '/images/icons/glacerie-icon-72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/images/icons/glacerie-icon-96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/images/icons/glacerie-icon-128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/images/icons/glacerie-icon-144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/images/icons/glacerie-icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/images/icons/glacerie-icon-192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/images/icons/glacerie-icon-512x512.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/images/icons/glacerie-icon-512x512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/images/icons/glacerie-icon-1024x1024.png',
            '750x1334' => '/images/icons/glacerie-icon-1024x1024.png',
            '828x1792' => '/images/icons/glacerie-icon-1024x1024.png',
            '1125x2436' => '/images/icons/glacerie-icon-1024x1024.png',
            '1242x2208' => '/images/icons/glacerie-icon-1024x1024.png',
            '1242x2688' => '/images/icons/glacerie-icon-1024x1024.png',
            '1536x2048' => '/images/icons/glacerie-icon-1024x1024.png',
            '1668x2224' => '/images/icons/glacerie-icon-1024x1024.png',
            '1668x2388' => '/images/icons/glacerie-icon-1024x1024.png',
            '2048x2732' => '/images/icons/glacerie-icon-1024x1024.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutlink1',
                'icons' => [
                    "src" => "/images/icons/glacerie-icon-72x72.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutlink2'
            ]
        ],
        'custom' => []
    ]
];
