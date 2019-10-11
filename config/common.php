<?php

return [
    'roles' => [
        'super_admin' => 1,
        'admin' => 2,
        'editor' => 3,
        'member' => 4,
    ],
    'active' => [
        'is_active' => 1,
        'not_active' => 0,
    ],
    'login' => [
        'background' => 'bower_components/metronic/app/media/img/bg/bg-2.jpg',
        'logo' => 'bower_components/metronic/app/media/img//logos/logo-1.png',
    ],
    'pagination' => [
        'default' => 10,
    ],
    'images' => [
        'default' => 'images/default.png'
    ],
    'uploads' => [
        'languages' => '/uploads/languages',
        'rooms' => '/uploads/rooms',
    ],
    'languages' => [
        'default' => 1,
    ]
];
