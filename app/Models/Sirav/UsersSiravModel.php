<?php

namespace App\Models\Sirav;

use CodeIgniter\Model;

class UsersSiravModel extends Model
{

    protected $table = 'USUARIO';
    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'PRIMER_NOMBRE',
        'SEGUNDO_NOMBRE',
        'PRIMER_APELLIDO',
        'SEGUNDO_APELLIDO',
        'ID_TIPO_DOCUMENTO',
        'DOCUMENTO',
        'TELEFONO',
        'DIRECCION',
        'CORREO',
        'USERNAME',
        'ACTIVO',
        'INTENTOS',
        'ID_RAZON_INACTIVO',
        'FIRMA',
        'REQUIERE_CAMBIO_CLAVE',
        'FECHA_ULTIMO_ACCESO',
        'FECHA_INACTIVACION',
        'FECHA_CREACION',
        'USUARIO_CREACION',
        'FECHA_MODIFICACION',
        'USUARIO_MODIFICACION',
        'FECHA_REACTIVADO',
        'REACTIVADO',
        'ID_MUNICIPIO',
        'ID_ENTIDAD',
        'ID_TIPO_VICULACION',
        'CARGO',
        'ID_PROGRAMA',


    ];

    protected $useTimestamps = false;
    protected $DBGroup = 'bd_sirav';

    /**
     * The function `listUsersDoc` retrieves user information based on a provided identification number
     * in a PHP application.
     * 
     * @param IDENTIFICACION The `listUsersDoc` function is a PHP function that retrieves user
     * information based on the provided identification number (`IDENTIFICACION`). The SQL query
     * selects various fields from the `USUARIO` table and joins the `RAZON_INACTIVO` table to get
     * additional information. The function then executes
     * 
     * @return The `listUsersDoc` function returns a query result containing information about a user
     * based on their identification number (`IDENTIFICACION`). The query selects various fields from
     * the `USUARIO` table, including ID, DOCUMENTO, CORREO, USUARIO, FIRMA, CARGO, ACTIVO,
     * FECHA_INACTIVACION, FECHA_ULTIMO_ACCESO, NOMBRE
     */
    public function listUsersDoc($IDENTIFICACION)
    {
        $sql = "
            SELECT
                U.ID,
                U.DOCUMENTO AS IDENTIFICACION,
                U.CORREO AS CORREO_ELECTRONICO,
                U.USERNAME AS USUARIO,
                U.FIRMA,
                U.CARGO,
                U.ACTIVO,
                U.FECHA_INACTIVACION,
                U.FECHA_ULTIMO_ACCESO,
                RA.NOMBRE AS NOMBRE_INACTIVO,
                CONCAT(U.PRIMER_NOMBRE, ' ', U.SEGUNDO_NOMBRE, ' ', U.PRIMER_APELLIDO, ' ', U.SEGUNDO_APELLIDO) AS NOMBRE,
                STUFF((SELECT DISTINCT ', ' + R.NOMBRE
                        FROM SIRAVAdmin.dbo.ROL_USUARIO RU
                        JOIN SIRAVAdmin.dbo.ROL R ON R.ID = RU.ID_ROL
                        WHERE RU.ID_USUARIO = U.ID
                        FOR XML PATH(''), TYPE
                    ).value('.', 'NVARCHAR(MAX)'), 1, 2, '') AS ROLES,
                'SIRAV' AS APLICATIVO
            FROM SIRAVAdmin.DBO.USUARIO U
            LEFT JOIN SIRAVAdmin.dbo.RAZON_INACTIVO RA ON RA.ID = U.ID_RAZON_INACTIVO
            WHERE U.DOCUMENTO = '".$IDENTIFICACION."'
        ";
                
        $query = $this->query($sql);
        
        return $query ?: false;
    }
}
