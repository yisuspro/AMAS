<?php

if (!function_exists('generate_menu')) {
    function generate_menu($permissions)
    {
        $menuItems = [
            [
                'id' => '2P',
                'title' => 'USUARIO',
                'icon' => 'bi-person',
                'permissions' => 'C_USERS',
                'children' => [
                    [
                        'id' => 'listUsersView',
                        'title' => 'CONSULTAR',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'C_USERS',
                    ],
                    [
                        'id' => 'createUserView',
                        'title' => 'CREAR',
                        'icon' => 'bi-plus-lg',
                        'permissions_CH' => 'CR_USERS',
                    ]
                ]
            ],
            [
                'id' => '3P',
                'title' => 'ROLES',
                'icon' => 'bi-person-vcard',
                'permissions' => 'C_ROLES',
                'children' => [
                    [
                        'id' => '../roles/listRolesView',
                        'title' => 'CONSULTAR',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'C_ROLES',
                    ]
                ]
            ],
            [
                'id' => '4P',
                'title' => 'PERMISOS',
                'icon' => 'bi-person-dash',
                'permissions' => 'C_PERMI',
                'children' => [
                    [
                        'id' => '../permissions/listPermissionsView',
                        'title' => 'CONSULTAR',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'C_PERMI',
                    ]
                ]
            ],
            [
                'id' => '5P',
                'title' => 'PERSONAS',
                'icon' => 'bi-person-dash',
                'permissions' => 'C_USERS_APP',
                'children' => [
                    [
                        'id' => 'consultarUsersAppsView',
                        'title' => 'CONSULTAR',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'C_USERS_APP',
                    ],
                    [
                        'id' => '../persons/personsAdminView',
                        'title' => 'ADMINISTRAR',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'C_USERS_APP',
                    ]
                ]
            ],
            [
                'id' => '6P',
                'title' => 'REG. POBLACIONAL',
                'icon' => 'bi-person-dash',
                'permissions' => 'REG_POBLA',
                'children' => [
                    [
                        'id' => '../Vivanto/loadingFileCensoView',
                        'title' => 'CREAR CENSO',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'M_CEN_REG_POBLA',
                    ],
                    [
                        'id' => '../Vivanto/loadingFileCensoUbicaView',
                        'title' => 'CREAR UBICACION CENSO',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'M_CEN_REG_POBLA',
                    ],
                    [
                        'id' => '../Vivanto/loadingFileCensoIntView',
                        'title' => 'CREAR INTEGRANTES CENSO',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'M_CEN_REG_POBLA',
                    ]
                ]
            ],
            [
                'id' => '7P',
                'title' => 'AUDITORIA',
                'icon' => 'bi-file-earmark-arrow-down',
                'permissions' => 'C_AUDITORY',
                'children' => [
                    [
                        'id' => '../audit/listMyCase',
                        'title' => 'CONSULTAR',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'C_AUDITORY',
                    ],
                ]
            ],
        ];
        $html = '';

        foreach ($menuItems as $item) {
            if (in_array($item['permissions'], $permissions)) {
                $html .= '<div class="contenido-padre">';
                $html .= '<a class="buton-menu-padre" id="' . $item['id'] . '"><i class="bi ' . $item['icon'] . '"></i> &nbsp;' . $item['title'] . '</a>';
                $html .= '</div>';

                if (!empty($item['children'])) {
                    $html .= '<div class="contenido-hijo oculto" id="contenido' . $item['id'] . '" style="display: none;">';
                    foreach ($item['children'] as $child) {
                        if (in_array($child['permissions_CH'], $permissions)) {
                            $html .= '<a class="buton-menu-hijo" id="' . $child['id'] . '"><i class="bi ' . $child['icon'] . '"></i> &nbsp;' . $child['title'] . '</a>';
                        }
                    }
                    $html .= '</div>';
                }
            }
        }

        return $html;
    }
}
