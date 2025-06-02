<?php

return [
    'roles' => [
        'super_admin' => [
            'name' => 'Super Admin',
            'permissions' => ['antrian', 'stokobat', 'riwayat', 'user_management', 'settings'],
            'widgets' => [
                'antrian_stats',
                'stokobat_stats',
                'riwayat_stats',
                'user_stats',
                'system_stats'
            ],
            'menu_items' => [
                [
                    'label' => 'Dashboard',
                    'route' => 'dashboard',
                    'icon' => 'heroicon-o-home',
                    'sort' => 1
                ],
                [
                    'label' => 'Antrian',
                    'route' => 'antrian.index',
                    'icon' => 'heroicon-o-users',
                    'sort' => 2
                ],
                [
                    'label' => 'Stok Obat',
                    'route' => 'stokobat.index',
                    'icon' => 'heroicon-o-cube',
                    'sort' => 3
                ],
                [
                    'label' => 'Riwayat',
                    'route' => 'riwayat.index',
                    'icon' => 'heroicon-o-clock',
                    'sort' => 4
                ],
                [
                    'label' => 'Manajemen User',
                    'route' => 'admin.users.index',
                    'icon' => 'heroicon-o-user-group',
                    'sort' => 5
                ]
            ]
        ],
        'petugas' => [
            'name' => 'Petugas',
            'permissions' => ['antrian', 'stokobat', 'riwayat'],
            'widgets' => [
                'antrian_stats',
                'stokobat_stats',
                'riwayat_stats'
            ],
            'menu_items' => [
                [
                    'label' => 'Dashboard',
                    'route' => 'dashboard',
                    'icon' => 'heroicon-o-home',
                    'sort' => 1
                ],
                [
                    'label' => 'Antrian',
                    'route' => 'antrian.index',
                    'icon' => 'heroicon-o-users',
                    'sort' => 2
                ],
                [
                    'label' => 'Stok Obat',
                    'route' => 'stokobat.index',
                    'icon' => 'heroicon-o-cube',
                    'sort' => 3
                ],
                [
                    'label' => 'Riwayat',
                    'route' => 'riwayat.index',
                    'icon' => 'heroicon-o-clock',
                    'sort' => 4
                ]
            ]
        ],
        'admin' => [
            'name' => 'Admin',
            'permissions' => ['stokobat', 'riwayat'],
            'widgets' => [
                'stokobat_stats',
                'riwayat_stats'
            ],
            'menu_items' => [
                [
                    'label' => 'Dashboard',
                    'route' => 'dashboard',
                    'icon' => 'heroicon-o-home',
                    'sort' => 1
                ],
                [
                    'label' => 'Stok Obat',
                    'route' => 'stokobat.index',
                    'icon' => 'heroicon-o-cube',
                    'sort' => 2
                ],
                [
                    'label' => 'Riwayat',
                    'route' => 'riwayat.index',
                    'icon' => 'heroicon-o-clock',
                    'sort' => 3
                ]
            ]
        ]
    ]
];
