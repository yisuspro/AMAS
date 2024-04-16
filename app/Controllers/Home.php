<?php

namespace App\Controllers;

use Throwable;

use function App\Helpers\generar_menu;

class Home extends BaseController
{


    public function index()
    {
        
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
        ]; // Define tus opciones de menú aquí

        // Genera el HTML del menú utilizando el helper o manualmente
        $menu_html = generar_menu($menu_opciones);
        echo $menu_html;
    }
}
