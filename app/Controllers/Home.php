<?php

namespace App\Controllers;

use Throwable;

class Home extends BaseController
{
    /**
     * The function generates an HTML menu based on predefined options for user and role management.
     */
    public function index()
    {
        // Define your menu options in a clear and concise way
        $menu_opciones = [
            [
                'id' => '2P',
                'texto' => 'USUARIO',
                'icono' => 'bi bi-person',
                'subopciones' => [
                    ['id' => 'listUsersView', 'texto' => 'CONSULTAR', 'icono' => 'bi bi-journal-text'],
                    ['id' => 'createUserView', 'texto' => 'CREAR', 'icono' => 'bi bi-plus-lg']
                ]
            ],
            [
                'id' => '1P',
                'texto' => 'ROLES',
                'icono' => 'bi bi-person',
                'subopciones' => [
                    ['id' => 'listUsersView', 'texto' => 'CONSULTAR', 'icono' => 'bi bi-journal-text'],
                    ['id' => 'createUserView', 'texto' => 'CREAR', 'icono' => 'bi bi-plus-lg']
                ]
            ]
        ];
    
        // Generate the HTML of the menu using the helper or manually
        $menu_html = generate_menu($menu_opciones);
        
        // Return or echo the menu HTML
        echo $menu_html;
    }    
}
