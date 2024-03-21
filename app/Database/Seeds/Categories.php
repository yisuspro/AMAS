<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Categories extends Seeder
{
    public function run()
    {
        // cargamos datos base de la tabla para categorias de casos
        $dataCategoriesCases = [
            ['CTCS_name' => 'A', 'CTCS_description' => 'categoria A'],
            ['CTCS_name' => 'B', 'CTCS_description' => 'categoria B'],
            ['CTCS_name' => 'C', 'CTCS_description' => 'categoria C'],
            ['CTCS_name' => 'D', 'CTCS_description' => 'categoria D'],
            ['CTCS_name' => 'E', 'CTCS_description' => 'categoria E'],
            ['CTCS_name' => 'F', 'CTCS_description' => 'categoria F']

        ];
        $this->db->table('categoriescase')->insertBatch($dataCategoriesCases);


        // cargamos datos base de la tabla para grupo
        $dataGroups = [
            ['GRPS_name' => 'CRUZES', 'GRPS_description' => 'cruzes de informacion'],
            ['GRPS_name' => 'USUARIOS', 'GRPS_description' => 'gestion usuarios de las aplicaciones'],
            ['GRPS_name' => 'HERRAMIENTAS', 'GRPS_description' => 'ajutes a declaraciones y victimas']
        ];
        $this->db->table('groups')->insertBatch($dataGroups);

        // cargamos datos base de la tabla tipos de casos
        $dataTipesCases = [
            ['TPCS_name' => 'CRUZES RUV', 'TPCS_description' => 'cruzes de informacion RUV', 'TPCS_FK_group' => 1],
            ['TPCS_name' => 'CRUZES +  FUENTES', 'TPCS_description' => 'cruzes de informacion RUV + otra FUENTE', 'TPCS_FK_group' => 1],
            ['TPCS_name' => 'Creación de usuario', 'TPCS_description' => 'Creación de usuario', 'TPCS_FK_group' => 2],
            ['TPCS_name' => 'Activación usuario', 'TPCS_description' => 'Activación usuario', 'TPCS_FK_group' => 2],
            ['TPCS_name' => 'Cancelación o inactivación', 'TPCS_description' => 'Cancelación o inactivación', 'TPCS_FK_group' => 2],
            ['TPCS_name' => 'Asignación módulos o perfiles', 'TPCS_description' => 'Asignación módulos o perfiles', 'TPCS_FK_group' => 2],
            ['TPCS_name' => 'Ampliacion de vigencia', 'TPCS_description' => 'Ampliacion de vigencia', 'TPCS_FK_group' => 2],
            ['TPCS_name' => 'Actualizacion de usuario', 'TPCS_description' => 'ajustes a la informacion del usuario', 'TPCS_FK_group' => 2],
            ['TPCS_name' => 'Auditoria', 'TPCS_description' => 'consulta de informacion relacionada a un usuario', 'TPCS_FK_group' => 2],
            ['TPCS_name' => 'Agrupar Grupo Familiar', 'TPCS_description' => 'Agrupar Grupo Familiar', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Agrupar Hecho Victimizante', 'TPCS_description' => 'Agrupar Hecho Victimizante', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Anulación de consecutivos', 'TPCS_description' => 'Anulación de consecutivos', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Asignación Masiva', 'TPCS_description' => 'Asignación Masiva', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Auditorias', 'TPCS_description' => 'Auditorias', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Cambio de Declarante', 'TPCS_description' => 'Cambio de Declarante', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Cambio de estado de valoración (Activar/Inactivar)', 'TPCS_description' => 'Cambio de estado de valoración (Activar/Inactivar)', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Cambio de estado del Proceso', 'TPCS_description' => 'Cambio de estado del Proceso', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Reasignar fud', 'TPCS_description' => 'Reasignar fud', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Cargue Imágenes', 'TPCS_description' => 'Cargue Imágenes', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Consulta', 'TPCS_description' => 'Consulta', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Inactivación de FUD Duplicado', 'TPCS_description' => 'Inactivación de FUD Duplicado', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Inactivar Anexo', 'TPCS_description' => 'Inactivar Anexo', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Inactivar Duplicados de las Personas en los Hechos Victimizantes', 'TPCS_description' => 'Inactivar Duplicados de las Personas en los Hechos Victimizantes', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Inactivar Duplicados de los Hechos Victimizantes', 'TPCS_description' => 'Inactivar Duplicados de los Hechos Victimizantes', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Inactivar Persona de la Declaración', 'TPCS_description' => 'Inactivar Persona de la Declaración', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Insertar/cambiar/cargar Acto Administrativo', 'TPCS_description' => 'Insertar/cambiar/cargar Acto Administrativo', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Marca Relación Cercana y Suficiente', 'TPCS_description' => 'Marca Relación Cercana y Suficiente', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Modificar Autor', 'TPCS_description' => 'Modificar Autor', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Modificar Fecha Valoración', 'TPCS_description' => 'Modificar Fecha Valoración', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Modificar información victima', 'TPCS_description' => 'Modificar información victima', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Modificar Parentesco', 'TPCS_description' => 'Modificar Parentesco', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Modificar por AUTO 119', 'TPCS_description' => 'Modificar por AUTO 119', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Modificar Tipo Victima', 'TPCS_description' => 'Modificar Tipo Victima', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Activar FUD', 'TPCS_description' => 'Activar FUD', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Cambio de apellido por error vivanto', 'TPCS_description' => 'Cambio de apellido por error vivanto', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Cambio de tipo documento por error vivanto', 'TPCS_description' => 'Cambio de tipo documento por error vivanto', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'cambio de principio', 'TPCS_description' => 'cambio de principio', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Cambio entidad error vivanto', 'TPCS_description' => 'Cambio entidad error vivanto', 'TPCS_FK_group' => 3],
            ['TPCS_name' => 'Valoración Masiva', 'TPCS_description' => 'Valoración Masiva', 'TPCS_FK_group' => 3],

        ];
        $this->db->table('tipescases')->insertBatch($dataTipesCases);
    }
}
