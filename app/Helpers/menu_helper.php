<?php
if (!function_exists('generate_menu')) {
    function generate_menu($permissions)
    {
        // Map the permissions array to improve lookup speed
        $permissions = array_flip($permissions);
        
        
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
                        'id' => '../persons/consultarUsersAppsView',
                        'title' => 'CONSULTAR',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'C_USERS_APP',
                    ],
                    [
                        'id' => '../persons/personsAdminView',
                        'title' => 'ADMINISTRAR',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'CR_CASO',
                    ]
                ]
            ],
            [
                'id' => '6P',
                'title' => 'FUD',
                'icon' => 'bi-file-ruled',
                'permissions' => 'C_USERS_APP',
                'children' => [
                    [
                        'id' => '../fud/consultarFudView',
                        'title' => 'CONSULTAR',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'C_USERS_APP',
                    ],
                    /*[
                        'id' => '',
                        'title' => 'ADMINISTRAR',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => '',
                    ]*/
                ]
            ],
            [
                'id' => '7P',
                'title' => 'RUV',
                'icon' => 'bi-r-circle',
                'permissions' => 'E_RUV_FUD_ENTITY',
                'children' => [
                    [
                        'id' => '../Ruv/changeEntitiesView',
                        'title' => 'CAMBIO ENTIDAD',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'E_RUV_FUD_ENTITY',
                    ],
                ]
            ],
            [
                'id' => '8P',
                'title' => 'AUDITORIA',
                'icon' => 'bi-file-earmark-arrow-down',
                'permissions' => 'C_AUDITORY',
                'children' => [
                    [
                        'id' => '../audit/listMyCaseView',
                        'title' => 'MIS CASOS',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'C_AUDITORY',
                    ],
                    [
                        'id' => '../audit/listAllCaseView',
                        'title' => 'AUD. MESA',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'C_AUDITORY_ALL',
                    ],
                    [
                        'id' => '../audit/listReportPowerBiview',
                        'title' => 'PB TABLEROS',
                        'icon' => 'bi-journal-text',
                        'permissions_CH' => 'C_AUDITORY_ALL',
                    ],
                   
                   
                ]
            ],
        ];

        $html = '';

        foreach ($menuItems as $item) {
            // Check if the user has permission for the parent item
            if (isset($permissions[$item['permissions']])) {
                $html .= '<div class="contenido-padre">';
                $html .= '<a class="buton-menu-padre" id="' . htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') . '"><i class="bi ' . htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8') . '"></i> &nbsp;' . htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') . '</a>';
                $html .= '</div>';
        
                // Check for children and add the children menu
                if (!empty($item['children'])) {
                    $html .= '<div class="contenido-hijo oculto" id="contenido' . htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') . '" style="display: none;">';
                    
                    foreach ($item['children'] as $child) {
                        // Check if the user has permission for the child item
                        if (isset($permissions[$child['permissions_CH']])) {
                            $html .= '<a class="buton-menu-hijo" id="' . htmlspecialchars($child['id'], ENT_QUOTES, 'UTF-8') . '"><i class="bi ' . htmlspecialchars($child['icon'], ENT_QUOTES, 'UTF-8') . '"></i> &nbsp;' . htmlspecialchars($child['title'], ENT_QUOTES, 'UTF-8') . '</a>';
                        }
                    }
                    
                    $html .= '</div>';
                }
            } else {
                // Optionally handle parent item without permissions
                $html .= '<div class="contenido-padre hidden">';
                $html .= '<a class="buton-menu-padre disabled" href="javascript:void(0);"><i class="bi ' . htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8') . '"></i> &nbsp;' . htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') . ' (No Access)</a>';
                $html .= '</div>';
            }
        }
        
        // If no items are available based on permissions, display a message
        if (empty($html)) {
            $html = '<p>No menu items available based on your permissions.</p>';
        }

        return $html;
    }
}
