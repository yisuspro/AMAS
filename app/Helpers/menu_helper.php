<?php
namespace App\Helpers;
// any_in_array() is not in the Array Helper, so it defines a new function

if (! function_exists('generar_menu')) {
    function generar_menu($opciones) {
        $menu_html = '<div class="contenido-padre">';
        foreach ($opciones as $opcion) {
            $menu_html .= '<a class="buton-menu-padre" id="' . $opcion['id'] . '"><i class="' . $opcion['icono'] . '"></i>' . $opcion['texto'] . '</a>';
            if (isset($opcion['subopciones']) && !empty($opcion['subopciones'])) {
                $menu_html .= generar_submenu($opcion['subopciones'], $opcion['id']);
            }
        }
        $menu_html .= '</div>';
        return $menu_html;
    }

    function generar_submenu($subopciones, $id_padre) {
        $submenu_html = '<div class="contenido-hijo oculto" id="contenido' . $id_padre . '" style="display: none;" >';
        foreach ($subopciones as $subopcion) {
            $submenu_html .= '<a class="buton-menu-hijo" id="' . $subopcion['id'] . '"><i class="' . $subopcion['icono'] . '"></i>' . $subopcion['texto'] . '</a>';
        }
        $submenu_html .= '</div>';
        return $submenu_html;
    }
}