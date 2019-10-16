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
        'posts' => '/uploads/posts',
        'rooms' => '/uploads/rooms',
        'libraries' => '/uploads/libraries',
        'logo' => '/uploads/logo',
    ],
    'languages' => [
        'default' => 1,
    ],
    'categories' => [
        'default_parent_id' => 0
    ],
    'posts' => [
        'undefined_category' => 'Danh mục không xác định',
        'approve' => [
            '-1' => 'Từ chối phê duyệt',
            '0' => 'Chưa được duyệt',
            '1' => 'Đã được duyệt'
        ]
    ],
    'currency' => [
        'vi' => 0,
        'en' => 1,
    ],
];
