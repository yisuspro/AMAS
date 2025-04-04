<?php

namespace App\Models\Sipod;

use CodeIgniter\Model;

class UsersSipodModel extends Model
{
    protected $table = 'TBUSUARIOS';
    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'NOMBRE',
        'CARGO',
        'USUARIO',
        'ID_MUNICIPIO',
        'ID_UTRERRITORIAL',
        'ID_ENTIDAD',
        'IDENTIFICACION',
        'CORREO_ELECTRONICO',
        'DIRECCION',
        'TELEFONO',
        'ID_DEPARTAMENTO',
        'TIPO_CLIENTE',
        'ACTIVO',
        'BLOQUEADO',
        'ID_TIPO_VINCULACION',
        'CODIGO_ANALISTA',
        'CLAVE',
        'ULTIMA_FECHA_PASSWORD',
        'ID_REGION',
        'FECHACREACION',
        'LOGEADO',
        'FECHALOGEADO',
        'SESIONES',
        'ID_USUARIO',
        'ID_UTERRITORIAL',
        'FECHA_INACTIVACION',
        'DESBLOQUEO_AUTOMATICO',
        'APLICA_MAC_VAL',
        'COD_MAC_USUARIO',
        'APLICA_FIRMADIGITAL',
        'US_FUENTECAMBIOCLAVE',
        'SEUDONIMO'
    ];

    protected $useTimestamps = false;
    protected $DBGroup = 'bd_sipod';
/**
 * The function `getUserById` retrieves user information based on the provided ID from a database table
 * in PHP.
 * 
 * @param ID The code you provided is a PHP function that retrieves user information based on the
 * provided ID from a database. It constructs a SQL query to select specific columns from the tables
 * TBUSUARIOS, TBROLES_USUARIO, and TBROLES in the SIPOD database.
 * 
 * @return The function `getUserById` is returning the result of a SQL query that fetches user
 * information based on the provided ``. The query selects various fields from the
 * `SIPOD.TBUSUARIOS` table and performs some conversions and aggregations. The result is grouped by
 * certain fields and returned by executing the query using the `query` method. If the query is
 * successful, the function
 */

    public function getUserById($ID) {
        $sql = "
        SELECT DISTINCT
            U.IDENTIFICACION,
            U.ID ,
            CONVERT(U.NOMBRE, 'AL32UTF8') AS NOMBRE,
            CONVERT(U.USUARIO, 'AL32UTF8') AS USUARIO,
            U.CORREO_ELECTRONICO,
            U.ACTIVO,
            CONVERT(U.CARGO, 'AL32UTF8') AS CARGO,
            U.FECHA_INACTIVACION,
            U.FECHALOGEADO,
            CONVERT(LISTAGG(R.nombre, ', ') WITHIN GROUP (ORDER BY R.nombre),'AL32UTF8') AS roles,
            'N/A' AS NOMBRE_INACTIVO,
            'SIPOD' AS APLICATIVO
        FROM SIPOD.TBUSUARIOS U
        LEFT JOIN SIPOD.TBROLES_USUARIO RU ON RU.ID_USUARIO = U.ID
        LEFT JOIN SIPOD.TBROLES R ON R.ID = RU.ID_ROL
        WHERE U.ID= '".$ID."'
        GROUP BY 
            U.IDENTIFICACION, U.ID, U.NOMBRE, U.USUARIO, 
            U.CORREO_ELECTRONICO,U.ACTIVO,U.FECHA_INACTIVACION,
            U.CARGO,U.FECHALOGEADO
    ";


    return $this->query($sql) ?: false;
    }

    /**
     * The function `listUsersDoc` retrieves user information based on identification from a database
     * table and returns the result.
     * 
     * @param IDENTIFICACION The function `listUsersDoc` is a PHP function that retrieves user
     * information based on the provided identification number (`IDENTIFICACION`). It executes a SQL
     * query to select distinct user details from the database tables `SIPOD.TBUSUARIOS`,
     * `SIPOD.TBROLES_USUARIO
     * 
     * @return The function `listUsersDoc` returns the result of a SQL query that fetches user
     * information based on the provided identification number (``). The query selects
     * distinct user details such as identification, name, username, email, active status, role,
     * inactivation date, last login date, and a concatenated list of roles associated with the user.
     */
    public function listUsersDoc($IDENTIFICACION)
    {
        $sql = "
            SELECT DISTINCT
                U.IDENTIFICACION,
                U.ID ,
                CONVERT(U.NOMBRE, 'AL32UTF8') AS NOMBRE,
                CONVERT(U.USUARIO, 'AL32UTF8') AS USUARIO,
                U.CORREO_ELECTRONICO,
                U.ACTIVO,
                CONVERT(U.CARGO, 'AL32UTF8') AS CARGO,
                U.FECHA_INACTIVACION,
                U.FECHALOGEADO,
                CONVERT(LISTAGG(R.nombre, ', ') WITHIN GROUP (ORDER BY R.nombre),'AL32UTF8') AS roles,
                'N/A' AS NOMBRE_INACTIVO,
                '' AS FIRMA,
                'SIPOD' AS APLICATIVO
            FROM SIPOD.TBUSUARIOS U
            LEFT JOIN SIPOD.TBROLES_USUARIO RU ON RU.ID_USUARIO = U.ID
            LEFT JOIN SIPOD.TBROLES R ON R.ID = RU.ID_ROL
            WHERE U.IDENTIFICACION = '".$IDENTIFICACION."'
            GROUP BY 
                U.IDENTIFICACION, U.ID, U.NOMBRE, U.USUARIO, 
                U.CORREO_ELECTRONICO,U.ACTIVO,U.FECHA_INACTIVACION,
                U.CARGO,U.FECHALOGEADO
        ";

    
        return $this->query($sql) ?: false;
    }
}
