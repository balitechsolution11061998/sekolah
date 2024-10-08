<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'administrator' => [
            'users' => 'c,r,u,d',
            'role' => 'c,r,u,d',
            'permissions' => 'c,r,u,d',
            'profile' => 'r,u',
            'home' => 's,u',
        ],
        'siswa' => [
            'profile' => 'r,u',
        ],
        'guru' => [
            'profile' => 'r,u',
        ],


    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        's' => 'show',
    ],
];
