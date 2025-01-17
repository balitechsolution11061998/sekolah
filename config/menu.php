<?php

return [
    # Menus
    'KT_MENU_MODE' => 'auto',
    /** 'manual' or 'auto' */
    'KT_MENUS' => [
        // Dashboard menu item (previously Profile)
        [
            'label'          => 'Dashboard',               // Menu label updated to Dashboard
            'type'           => 'item',                    // Type (item represents a clickable menu option)
            'permission'     => [],                        // Permissions required to view this item
            'permissionType' => 'gate',                    // Permission type (gate or policy)
            'icon'           => 'fas',                     // Font Awesome Solid icons (FA class)
            'iconName'       => 'fa-tachometer-alt',        // Updated icon for the dashboard (optional)
            'route'          => 'home',    // Route updated to dashboard (replace with your dashboard route)
            'active'         => [],                        // Define conditions when this item is active
            'iconPath'       => 4,
        ],

        // Pages section heading
        [
            'label' => 'Pages',
            'type'  => 'heading' // This represents a section heading (non-clickable)
        ],
        [
            'label'          => 'Master Data',          // Main menu label
            'type'           => 'item',                 // Type item (clickable menu item)
            'permission'     => [],                     // Permissions (empty implies no restrictions)
            'permissionType' => 'gate',                 // Permission type (gate or policy)
            'icon'           => 'fas',                  // Font Awesome icons class
            'iconName'       => 'fa-database',          // Updated icon name for this main item
            'iconPath'       => 4,                      // Optional icon size/path
            'children'       => [                       // Sub-items (children)

                [
                    'label'          => 'Siswa',         // Siswa management
                    'type'           => 'item',
                    'permission'     => [],               // Permissions required for this item
                    'permissionType' => 'gate',           // Permission type
                    'icon'           => 'fas',            // FontAwesome solid icon
                    'iconName'       => 'fa-user',        // Icon for students
                    'route'          => 'students.index',  // Route for Siswa management
                    'active'         => [],                // Define when this item is active
                    'iconPath'       => 4,
                ],
                [
                    'label'          => 'Guru',          // Guru management
                    'type'           => 'item',
                    'permission'     => [],               // Permissions required for this item
                    'permissionType' => 'gate',           // Permission type
                    'icon'           => 'fas',            // FontAwesome solid icon
                    'iconName'       => 'fa-chalkboard-teacher', // Icon for teachers
                    'route'          => 'teachers.index',  // Route for Guru management
                    'active'         => [],                // Define when this item is active
                    'iconPath'       => 4,
                ],
                [
                    'label'          => 'Kelas',          // New child item for Kelas management
                    'type'           => 'item',
                    'permission'     => [],                 // Permissions required for this item
                    'permissionType' => 'gate',             // Permission type
                    'icon'           => 'fas',              // FontAwesome solid icon
                    'iconName'       => 'fa-chalkboard',    // Icon for Kelas (using fa-chalkboard)
                    'route'          => 'kelas.index',      // Route for Kelas management
                    'active'         => [],                 // Define when this item is active
                    'iconPath'       => 4,                  // Optional icon size/path
                ],
                [
                    'label'          => 'Bank',           // New child item for Bank management
                    'type'           => 'item',
                    'permission'     => [],                 // Permissions required for this item
                    'permissionType' => 'gate',             // Permission type
                    'icon'           => 'fas',              // FontAwesome solid icon
                    'iconName'       => 'fa-university',    // Icon for Bank (using fa-university)
                    'route'          => 'banks.index',      // Route for Bank management
                    'active'         => [],                 // Define when this item is active
                    'iconPath'       => 4,                  // Optional icon size/path
                ],
                [
                    'label'          => 'Biaya',              // New child item for Biaya management
                    'type'           => 'item',
                    'permission'     => [],                   // Permissions required for this item
                    'permissionType' => 'gate',               // Permission type
                    'icon'           => 'fas',                // FontAwesome solid icon
                    'iconName'       => 'fa-money-bill-wave', // Icon for Biaya (using fa-money-bill-wave)
                    'route'          => 'biayas.index',       // Route for Biaya management
                    'active'         => [],                   // Define when this item is active
                    'iconPath'       => 4,                    // Optional icon size/path
                ],
                [
                    'label'          => 'Tahun Pelajaran',    // New child item for Tahun Pelajaran management
                    'type'           => 'item',
                    'permission'     => [],                   // Permissions required for this item
                    'permissionType' => 'gate',               // Permission type
                    'icon'           => 'fas',                // FontAwesome solid icon
                    'iconName'       => 'fa-calendar',        // Icon for Tahun Pelajaran (using fa-calendar)
                    'route'          => 'tahun-pelajarans.index',  // Route for Tahun Pelajaran management
                    'active'         => [],                   // Define when this item is active
                    'iconPath'       => 4,                    // Optional icon size/path
                ],
                [
                    'label'          => 'Mata Pelajaran',    // Mata Pelajaran management (new item)
                    'type'           => 'item',
                    'permission'     => [],                   // Permissions required for this item
                    'permissionType' => 'gate',               // Permission type
                    'icon'           => 'fas',                // FontAwesome solid icon
                    'iconName'       => 'fa-book',            // Icon for Mata Pelajaran
                    'route'          => 'mapels.index',       // Route for Mata Pelajaran management
                    'active'         => [],                   // Define when this item is active
                    'iconPath'       => 4,                    // Optional icon size/path
                ],

            ]
        ],
        [
            'label'          => 'Transaksi',          // Main menu label
            'type'           => 'item',               // Type item (clickable menu item)
            'permission'     => [],                   // Permissions (empty implies no restrictions)
            'permissionType' => 'gate',               // Permission type (gate or policy)
            'icon'           => 'fas',                // Font Awesome icons class
            'iconName'       => 'fa-exchange-alt',    // Updated icon name for transactions (fa-exchange-alt)
            'iconPath'       => 4,                    // Optional icon size/path
            'children'       => [                     // Sub-items (children)

                // Siswa Transaksi
                [
                    'label'          => 'Transaksi Siswa',    // Siswa management (transactions)
                    'type'           => 'item',
                    'permission'     => [],                   // Permissions required for this item
                    'permissionType' => 'gate',               // Permission type
                    'icon'           => 'fas',                // FontAwesome solid icon
                    'iconName'       => 'fa-user',            // Icon for Transaksi Siswa
                    'route'          => 'students.index',  // Route for Siswa transactions
                    'active'         => [],                   // Define when this item is active
                    'iconPath'       => 4,                    // Optional icon size/path
                ],

                // Biaya Siswa
                [
                    'label'          => 'Biaya Siswa',        // Biaya management (student fees)
                    'type'           => 'item',
                    'permission'     => [],                   // Permissions required for this item
                    'permissionType' => 'gate',               // Permission type
                    'icon'           => 'fas',                // FontAwesome solid icon
                    'iconName'       => 'fa-money-bill-wave', // Icon for Biaya Siswa
                    'route'          => 'biayas.siswa',  // Route for Siswa fees
                    'active'         => [],                   // Define when this item is active
                    'iconPath'       => 4,                    // Optional icon size/path
                ],

            ]
        ],



        // Management User menu item with sub-items (children)
        [
            'label'          => 'Management User',       // Main menu label
            'type'           => 'item',                  // Type item (clickable menu item)
            'permission'     => [],                      // Permissions (empty implies no restrictions)
            'permissionType' => 'gate',                  // Permission type (gate or policy)
            'icon'           => 'fas',                   // Font Awesome icons class
            'iconName'       => 'fa-users',              // Icon name for this main item
            'iconPath'       => 4,                       // Optional icon size/path
            'children'       => [                        // Sub-items (children)
                [
                    'label'          => 'User',          // Child item label
                    'type'           => 'item',          // Type item (clickable)
                    'route'          => 'management.users.index', // Route for user management
                    'active'         => [],              // Define when this item is active
                    'permission'     => [],              // Permissions required for this item
                    'permissionType' => 'gate',          // Permission type
                    'icon'           => 'dot',           // Optional small icon for child items

                ],
                [
                    'label'          => 'Roles',         // Child item for managing roles
                    'type'           => 'item',
                    'route'          => 'roles.index',  // Route for role management
                    'active'         => [],
                    'permission'     => [],
                    'permissionType' => 'gate',
                    'icon'           => 'dot',           // Dot icon for sub-items
                ],
                [
                    'label'          => 'Permissions',
                    'type'           => 'item',
                    'route'          => 'permissions.index',
                    'active'         => [],
                    'permission'     => [],
                    'permissionType' => 'gate', // Using Laravel's gate for permission checking
                    'icon'           => 'dot',
                ],

            ]
        ],

        // Profile item (this one can be removed if it's redundant)
        [
            'label'          => 'Profile',
            'type'           => 'item',
            'permission'     => [],
            'permissionType' => 'gate',
            'icon'           => 'fas',
            'iconName'       => 'fa-user',
            'route'          => 'management.users.profile',
            'active'         => [],
            'iconPath'       => 4,

        ],
        [
            'label'          => 'School Profile',
            'type'           => 'item',
            'permission'     => [], // Specify permission if needed
            'permissionType' => 'gate', // Using Laravel Gate for permission control
            'icon'           => 'fas',
            'iconName'       => 'fa-school', // Icon for the school profile (you can use 'fa-user' if preferred)
            'route'          => 'schoolprofile.index', // Route to the school profile page
            'active'         => ['school/profile*'], // Define which routes make this menu item active
            'iconPath'       => 4, // Path for icon display, adjust based on your implementation
        ],

    ],

    //     [

    //         'label'          => 'User Profile',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-address-book',
    //         'iconPath'       => 3,
    //         'children'       => [
    //             [
    //                 'label'          => 'Overview',
    //                 'type'           => 'item',
    //                 'route'          => 'example.user-profile.overview',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Projects',
    //                 'type'           => 'item',
    //                 'route'          => 'example.user-profile.projects',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Campaigns',
    //                 'type'           => 'item',
    //                 'route'          => 'example.user-profile.campaigns',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Documents',
    //                 'type'           => 'item',
    //                 'route'          => 'example.user-profile.documents',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Followers',
    //                 'type'           => 'item',
    //                 'route'          => 'example.user-profile.followers',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Activity',
    //                 'type'           => 'item',
    //                 'route'          => 'example.user-profile.activity',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ]
    //     ],
    //     [
    //         'label'          => 'Account',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-element-plus',
    //         'iconPath'       => 5,
    //         'children'       => [
    //             [
    //                 'label'          => 'Overview',
    //                 'type'           => 'item',
    //                 'route'          => 'example.account.overview',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Settings',
    //                 'type'           => 'item',
    //                 'route'          => 'example.account.settings',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Security',
    //                 'type'           => 'item',
    //                 'route'          => 'example.account.security',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Activity',
    //                 'type'           => 'item',
    //                 'route'          => 'example.account.activity',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Billing',
    //                 'type'           => 'item',
    //                 'route'          => 'example.account.billing',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Statements',
    //                 'type'           => 'item',
    //                 'route'          => 'example.account.statements',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Referrals',
    //                 'type'           => 'item',
    //                 'route'          => 'example.account.referrals',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'API Keys',
    //                 'type'           => 'item',
    //                 'route'          => 'example.account.api-keys',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Logs',
    //                 'type'           => 'item',
    //                 'route'          => 'example.account.logs',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ]
    //     ],
    //     [
    //         'label'          => 'Authentication',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-user',
    //         'iconPath'       => 2,
    //         'children'       => [
    //             [
    //                 'label'          => 'Corporate Layout',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'Sign-in',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.corporate-layout.sign-in',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Sign-up',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.corporate-layout.sign-up',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Two-Factor',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.corporate-layout.two-factor',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Reset Password',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.corporate-layout.reset-password',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'New Password',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.corporate-layout.new-password',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                 ]
    //             ],
    //             [
    //                 'label'          => 'Overlay Layout',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'Sign-in',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.overlay-layout.sign-in',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Sign-up',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.overlay-layout.sign-up',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Two-Factor',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.overlay-layout.two-factor',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Reset Password',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.overlay-layout.reset-password',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'New Password',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.overlay-layout.new-password',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                 ]
    //             ],
    //             [
    //                 'label'          => 'Creative Layout',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'Sign-in',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.creative-layout.sign-in',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Sign-up',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.creative-layout.sign-up',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Two-Factor',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.creative-layout.two-factor',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Reset Password',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.creative-layout.reset-password',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'New Password',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.creative-layout.new-password',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                 ]
    //             ],
    //             [
    //                 'label'          => 'Fancy Layout',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'Sign-in',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.fancy-layout.sign-in',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Sign-up',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.fancy-layout.sign-up',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Two-Factor',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.fancy-layout.two-factor',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Reset Password',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.fancy-layout.reset-password',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'New Password',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.fancy-layout.new-password',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                 ]
    //             ],
    //             [
    //                 'label'          => 'Email Templates',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'Welcome Message',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.email-templates.welcome-message',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Reset Password',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.email-templates.reset-password',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Subscription Confirmed',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.email-templates.subscription-confirmed',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Credit Card Declined',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.email-templates.credit-card-declined',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Promo 1',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.email-templates.promo-1',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Promo 2',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.email-templates.promo-2',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Promo 3',
    //                         'type'           => 'item',
    //                         'route'          => 'example.authentication.email-templates.promo-3',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                 ]
    //             ],
    //             [
    //                 'label'          => 'Multi-steps Sign-up',
    //                 'type'           => 'item',
    //                 'route'          => 'example.authentication.multi-steps-sign-up',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Welcome Message',
    //                 'type'           => 'item',
    //                 'route'          => 'example.authentication.welcome-message',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Verify Email',
    //                 'type'           => 'item',
    //                 'route'          => 'example.authentication.verify-email',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Coming Soon',
    //                 'type'           => 'item',
    //                 'route'          => 'example.authentication.coming-soon',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Password Confirmation',
    //                 'type'           => 'item',
    //                 'route'          => 'example.authentication.password-confirmation',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Account Deactivation',
    //                 'type'           => 'item',
    //                 'route'          => 'example.authentication.account-deactivation',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Error 404',
    //                 'type'           => 'item',
    //                 'route'          => 'example.authentication.error-404',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Error 500',
    //                 'type'           => 'item',
    //                 'route'          => 'example.authentication.error-500',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ]
    //     ],
    //     [
    //         'label'          => 'Corporate',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-file',
    //         'iconPath'       => 2,
    //         'children'       => [
    //             [
    //                 'label'          => 'About',
    //                 'type'           => 'item',
    //                 'route'          => 'example.corporate.about',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Our Team',
    //                 'type'           => 'item',
    //                 'route'          => 'example.corporate.our-team',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Contact Us',
    //                 'type'           => 'item',
    //                 'route'          => 'example.corporate.contact-us',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Licenses',
    //                 'type'           => 'item',
    //                 'route'          => 'example.corporate.licenses',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Sitemap',
    //                 'type'           => 'item',
    //                 'route'          => 'example.corporate.sitemap',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ],
    //     ],
    //     [
    //         'label'          => 'Social',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-abstract-39',
    //         'iconPath'       => 2,
    //         'children'       => [
    //             [
    //                 'label'          => 'Feeds',
    //                 'type'           => 'item',
    //                 'route'          => 'example.social.feeds',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Activty',
    //                 'type'           => 'item',
    //                 'route'          => 'example.social.activity',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Followers',
    //                 'type'           => 'item',
    //                 'route'          => 'example.social.followers',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Settings',
    //                 'type'           => 'item',
    //                 'route'          => 'example.social.settings',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ],
    //     ],
    //     [
    //         'label'          => 'Blog',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-bank',
    //         'iconPath'       => 2,
    //         'children'       => [
    //             [
    //                 'label'          => 'Blog Home',
    //                 'type'           => 'item',
    //                 'route'          => 'example.blog.blog-home',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Blog Post',
    //                 'type'           => 'item',
    //                 'route'          => 'example.blog.blog-post',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ],
    //     ],
    //     [
    //         'label'          => 'FAQ',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-chart-pie-3',
    //         'iconPath'       => 3,
    //         'children'       => [
    //             [
    //                 'label'          => 'FAQ Classic',
    //                 'type'           => 'item',
    //                 'route'          => 'example.faq.faq-classic',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'FAQ Extended',
    //                 'type'           => 'item',
    //                 'route'          => 'example.faq.faq-extended',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ],
    //     ],
    //     [
    //         'label'          => 'Pricing',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-bucket',
    //         'iconPath'       => 4,
    //         'children'       => [
    //             [
    //                 'label'          => 'Column Pricing',
    //                 'type'           => 'item',
    //                 'route'          => 'example.pricing.column-pricing',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Table Pricing',
    //                 'type'           => 'item',
    //                 'route'          => 'example.pricing.table-pricing',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ],
    //     ],
    //     [
    //         'label'          => 'Careers',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-call',
    //         'iconPath'       => 8,
    //         'children'       => [
    //             [
    //                 'label'          => 'Careers List',
    //                 'type'           => 'item',
    //                 'route'          => 'example.careers.careers-list',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Careers Apply',
    //                 'type'           => 'item',
    //                 'route'          => 'example.careers.careers-apply',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ],
    //     ],
    //     [
    //         'label'          => 'Utilities',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-color-swatch',
    //         'iconPath'       => 21,
    //         'children'       => [
    //             [
    //                 'label'          => 'Modals',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'General',
    //                         'type'           => 'item',
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                         'children'       => [
    //                             [
    //                                 'label'          => 'Invite Friends',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.general.invite-friends',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                             [
    //                                 'label'          => 'View Users',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.general.view-users',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                             [
    //                                 'label'          => 'Select Users',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.general.select-users',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                             [
    //                                 'label'          => 'Upgrade Plan',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.general.upgrade-plan',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                             [
    //                                 'label'          => 'Share & Earn',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.general.share-earn',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                         ]
    //                     ],
    //                     [
    //                         'label'          => 'Forms',
    //                         'type'           => 'item',
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                         'children'       => [
    //                             [
    //                                 'label'          => 'New Target',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.forms.new-target',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                             [
    //                                 'label'          => 'New Card',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.forms.new-card',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                             [
    //                                 'label'          => 'New Address',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.forms.new-address',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                             [
    //                                 'label'          => 'Create API Key',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.forms.create-api-key',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                             [
    //                                 'label'          => 'Bidding',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.forms.bidding',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                         ]
    //                     ],
    //                     [
    //                         'label'          => 'Wizards',
    //                         'type'           => 'item',
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                         'children'       => [
    //                             [
    //                                 'label'          => 'Create App',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.wizards.create-app',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                             [
    //                                 'label'          => 'Create Campaign',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.wizards.create-campaign',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                             [
    //                                 'label'          => 'Create Business Acc',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.wizards.create-account',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                             [
    //                                 'label'          => 'Create Project',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.wizards.create-project',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                             [
    //                                 'label'          => 'Top Up Wallet',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.wizards.topup-wallet',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                             [
    //                                 'label'          => 'Two Factor Auth',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.wizards.two-factor-auth',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                         ]
    //                     ],
    //                     [
    //                         'label'          => 'Search',
    //                         'type'           => 'item',
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                         'children'       => [
    //                             [
    //                                 'label'          => 'Users',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.search.users',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                             [
    //                                 'label'          => 'Select Location',
    //                                 'type'           => 'item',
    //                                 'route'          => 'example.utilities.modals.search.select-location',
    //                                 'active'         => [],
    //                                 'permission'     => [],
    //                                 'permissionType' => 'gate',
    //                                 'icon'           => 'dot',
    //                             ],
    //                         ]
    //                     ],
    //                 ]
    //             ],
    //             [
    //                 'label'          => 'Search',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'Horizontal',
    //                         'type'           => 'item',
    //                         'route'          => 'example.utilities.search.horizontal',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Vertical',
    //                         'type'           => 'item',
    //                         'route'          => 'example.utilities.search.vertical',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Users',
    //                         'type'           => 'item',
    //                         'route'          => 'example.utilities.search.users',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Location',
    //                         'type'           => 'item',
    //                         'route'          => 'example.utilities.search.location',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                 ]
    //             ],
    //             [
    //                 'label'          => 'Wizards',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'Horizontal',
    //                         'type'           => 'item',
    //                         'route'          => 'example.utilities.wizards.horizontal',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Vertical',
    //                         'type'           => 'item',
    //                         'route'          => 'example.utilities.wizards.vertical',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Two Factor Auth',
    //                         'type'           => 'item',
    //                         'route'          => 'example.utilities.wizards.two-factor-auth',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Create App',
    //                         'type'           => 'item',
    //                         'route'          => 'example.utilities.wizards.create-app',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Create Campaign',
    //                         'type'           => 'item',
    //                         'route'          => 'example.utilities.wizards.create-campaign',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Create Account',
    //                         'type'           => 'item',
    //                         'route'          => 'example.utilities.wizards.create-account',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Create Project',
    //                         'type'           => 'item',
    //                         'route'          => 'example.utilities.wizards.create-project',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Top Up Wallet',
    //                         'type'           => 'item',
    //                         'route'          => 'example.utilities.wizards.topup-wallet',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Offer a Deal',
    //                         'type'           => 'item',
    //                         'route'          => 'example.utilities.wizards.offer-a-deal',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                 ]
    //             ],
    //         ],
    //     ],
    //     [
    //         'label'          => 'Widgets',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-element-7',
    //         'iconPath'       => 2,
    //         'children'       => [
    //             [
    //                 'label'          => 'Lists',
    //                 'type'           => 'item',
    //                 'route'          => 'example.widgets.lists',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Statistics',
    //                 'type'           => 'item',
    //                 'route'          => 'example.widgets.statistics',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Charts',
    //                 'type'           => 'item',
    //                 'route'          => 'example.widgets.charts',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Mixed',
    //                 'type'           => 'item',
    //                 'route'          => 'example.widgets.mixed',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Tables',
    //                 'type'           => 'item',
    //                 'route'          => 'example.widgets.tables',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Feeds',
    //                 'type'           => 'item',
    //                 'route'          => 'example.widgets.feeds',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ]
    //     ],
    //     [
    //         'label' => 'Apps',
    //         'type' => 'heading'
    //     ],
    //     [
    //         'label'          => 'Projects',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-abstract-41',
    //         'iconPath'       => 2,
    //         'children'       => [
    //             [
    //                 'label'          => 'My Projects',
    //                 'type'           => 'item',
    //                 'route'          => 'example.projects.my-projects',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'View Projects',
    //                 'type'           => 'item',
    //                 'route'          => 'example.projects.view-project',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Targets',
    //                 'type'           => 'item',
    //                 'route'          => 'example.projects.targets',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Budget',
    //                 'type'           => 'item',
    //                 'route'          => 'example.projects.budget',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Users',
    //                 'type'           => 'item',
    //                 'route'          => 'example.projects.users',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Files',
    //                 'type'           => 'item',
    //                 'route'          => 'example.projects.files',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Activity',
    //                 'type'           => 'item',
    //                 'route'          => 'example.projects.activity',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Settings',
    //                 'type'           => 'item',
    //                 'route'          => 'example.projects.settings',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ]
    //     ],
    //     [
    //         'label'          => 'eCommerce',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-basket',
    //         'iconPath'       => 4,
    //         'children'       => [
    //             [
    //                 'label'          => 'Catalog',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'Products',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.catalog.product',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Categories',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.catalog.categories',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Add Product',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.catalog.add-product',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Edit Product',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.catalog.edit-product',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Add Category',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.catalog.add-category',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Edit Category',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.catalog.edit-category',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                 ]
    //             ],
    //             [
    //                 'label'          => 'Sales',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'Orders Listing',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.sales.listing',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Orders Details',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.sales.details',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Add Order',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.sales.add-order',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Edit Order',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.sales.edit-order',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                 ],
    //             ],
    //             [
    //                 'label'          => 'Customers',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'Customers Listing',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.customers.listing',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Customers Details',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.customers.details',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ]
    //                 ]
    //             ],
    //             [
    //                 'label'          => 'Reports',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'Products Viewed',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.reports.view',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Sales',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.reports.sales',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Returns',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.reports.returns',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Customer Orders',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.reports.customer-orders',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Shipping',
    //                         'type'           => 'item',
    //                         'route'          => 'example.ecommerce.reports.shipping',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                 ]
    //             ],
    //             [
    //                 'label'          => 'Settings',
    //                 'type'           => 'item',
    //                 'route'          => 'example.ecommerce.settings',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ]
    //         ],
    //     ],
    //     [
    //         'label'          => 'Contacts',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-abstract-25',
    //         'iconPath'       => 2,
    //         'children'       => [
    //             [
    //                 'label'          => 'Getting Started',
    //                 'type'           => 'item',
    //                 'route'          => 'example.contacts.getting-started',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Add Contact',
    //                 'type'           => 'item',
    //                 'route'          => 'example.contacts.add-contact',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Edit Contact',
    //                 'type'           => 'item',
    //                 'route'          => 'example.contacts.edit-contact',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'View Contact',
    //                 'type'           => 'item',
    //                 'route'          => 'example.contacts.view-contact',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ]
    //     ],
    //     [
    //         'label'          => 'Support Center',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-chart',
    //         'iconPath'       => 2,
    //         'children'       => [
    //             [
    //                 'label'          => 'Overview',
    //                 'type'           => 'item',
    //                 'route'          => 'example.support-center.overview',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Tickets',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'Ticket List',
    //                         'type'           => 'item',
    //                         'route'          => 'example.support-center.tickets.list',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'View Ticket',
    //                         'type'           => 'item',
    //                         'route'          => 'example.support-center.tickets.view',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                 ]
    //             ],
    //             [
    //                 'label'          => 'Tutorials',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'Tutorials List',
    //                         'type'           => 'item',
    //                         'route'          => 'example.support-center.tutorials.list',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Tutorial Posts',
    //                         'type'           => 'item',
    //                         'route'          => 'example.support-center.tutorials.post',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ]
    //                 ]
    //             ],
    //             [
    //                 'label'          => 'FAQ',
    //                 'type'           => 'item',
    //                 'route'          => 'example.support-center.faq',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Licenses',
    //                 'type'           => 'item',
    //                 'route'          => 'example.support-center.licenses',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Contact Us',
    //                 'type'           => 'item',
    //                 'route'          => 'example.support-center.contact',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ]
    //     ],
    //     [
    //         'label'          => 'User Management',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-abstract-28',
    //         'iconPath'       => 2,
    //         'children'       => [
    //             [
    //                 'label'          => 'Users',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'User List',
    //                         'type'           => 'item',
    //                         'route'          => 'example.user-management.users.list',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'View User',
    //                         'type'           => 'item',
    //                         'route'          => 'example.user-management.users.view',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                 ]
    //             ],
    //             [
    //                 'label'          => 'Roles',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'Role List',
    //                         'type'           => 'item',
    //                         'route'          => 'example.user-management.roles.list',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'View Role',
    //                         'type'           => 'item',
    //                         'route'          => 'example.user-management.roles.view',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                 ]
    //             ],
    //             [
    //                 'label'          => 'Permissions',
    //                 'type'           => 'item',
    //                 'route'          => 'example.user-management.permissions',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ]
    //     ],
    //     [
    //         'label'          => 'Customers',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-abstract-38',
    //         'iconPath'       => 2,
    //         'children'       => [
    //             [
    //                 'label'          => 'Getting Started',
    //                 'type'           => 'item',
    //                 'route'          => 'example.customers.getting-started',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Customer Listing',
    //                 'type'           => 'item',
    //                 'route'          => 'example.customers.list',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Customer Details',
    //                 'type'           => 'item',
    //                 'route'          => 'example.customers.view',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ]
    //     ],
    //     [
    //         'label'          => 'Subscriptions',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-map',
    //         'iconPath'       => 3,
    //         'children'       => [
    //             [
    //                 'label'          => 'Getting Started',
    //                 'type'           => 'item',
    //                 'route'          => 'example.subscriptions.getting-started',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Subscription List',
    //                 'type'           => 'item',
    //                 'route'          => 'example.subscriptions.list',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Add Subscription',
    //                 'type'           => 'item',
    //                 'route'          => 'example.subscriptions.add',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'View Subscription',
    //                 'type'           => 'item',
    //                 'route'          => 'example.subscriptions.view',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ]
    //     ],
    //     [
    //         'label'          => 'Invoice manager',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-credit-cart',
    //         'iconPath'       => 2,
    //         'children'       => [
    //             [
    //                 'label'          => 'View Invoice',
    //                 'type'           => 'item',
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //                 'children'       => [
    //                     [
    //                         'label'          => 'Invoice 1',
    //                         'type'           => 'item',
    //                         'route'          => 'example.invoices.view.invoice-1',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Invoice 2',
    //                         'type'           => 'item',
    //                         'route'          => 'example.invoices.view.invoice-2',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                     [
    //                         'label'          => 'Invoice 3',
    //                         'type'           => 'item',
    //                         'route'          => 'example.invoices.view.invoice-3',
    //                         'active'         => [],
    //                         'permission'     => [],
    //                         'permissionType' => 'gate',
    //                         'icon'           => 'dot',
    //                     ],
    //                 ]
    //             ],
    //             [
    //                 'label'          => 'Create Invoice',
    //                 'type'           => 'item',
    //                 'route'          => 'example.invoices.create',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ]
    //     ],
    //     [
    //         'label'          => 'File Manager',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-switch',
    //         'iconPath'       => 2,
    //         'children'       => [
    //             [
    //                 'label'          => 'Folders',
    //                 'type'           => 'item',
    //                 'route'          => 'example.file-manager.folders',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Files',
    //                 'type'           => 'item',
    //                 'route'          => 'example.file-manager.files',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Blank Directory',
    //                 'type'           => 'item',
    //                 'route'          => 'example.file-manager.blank',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Settings',
    //                 'type'           => 'item',
    //                 'route'          => 'example.file-manager.settings',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ],
    //     ],
    //     [
    //         'label'          => 'Inbox',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-sms',
    //         'iconPath'       => 2,
    //         'children'       => [
    //             [
    //                 'label'          => 'Messages',
    //                 'type'           => 'item',
    //                 'route'          => 'example.inbox.listing',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Compose',
    //                 'type'           => 'item',
    //                 'route'          => 'example.inbox.compose',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'View & Reply',
    //                 'type'           => 'item',
    //                 'route'          => 'example.inbox.reply',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //         ],
    //     ],
    //     [
    //         'label'          => 'Chat',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-message-text-2',
    //         'iconPath'       => 3,
    //         'children'       => [
    //             [
    //                 'label'          => 'Private Chat',
    //                 'type'           => 'item',
    //                 'route'          => 'example.chat.private',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Group Chat',
    //                 'type'           => 'item',
    //                 'route'          => 'example.chat.group',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ],
    //             [
    //                 'label'          => 'Drawer Chat',
    //                 'type'           => 'item',
    //                 'route'          => 'example.chat.drawer',
    //                 'active'         => [],
    //                 'permission'     => [],
    //                 'permissionType' => 'gate',
    //                 'icon'           => 'dot',
    //             ]
    //         ],
    //     ],
    //     [
    //         'label'          => 'Calendar',
    //         'type'           => 'item',
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-calendar-8',
    //         'iconPath'       => 6,
    //     ],
    //     [
    //         'label'          => 'Help',
    //         'type'           => 'heading',
    //     ],
    //     [
    //         'label'          => 'Components',
    //         'type'           => 'item',
    //         'url'            => 'https://preview.keenthemes.com/html/metronic/docs/base/utilities',
    //         'active'         => [],
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-rocket',
    //         'iconPath'       => 2,
    //     ],
    //     [
    //         'label'          => 'Documentation',
    //         'type'           => 'item',
    //         'url'            => 'https://preview.keenthemes.com/html/metronic/docs',
    //         'active'         => [],
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-abstract-26',
    //         'iconPath'       => 2,
    //     ],
    //     [
    //         'label'          => 'Changelog v8.2.1',
    //         'type'           => 'item',
    //         'url'            => 'https://preview.keenthemes.com/html/metronic/docs/getting-started/changelog',
    //         'active'         => [],
    //         'permission'     => [],
    //         'permissionType' => 'gate',
    //         'icon'           => 'ki',
    //         'iconName'       => 'ki-code',
    //         'iconPath'       => 4,
    //     ],
    // ],
];
