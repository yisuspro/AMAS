<?php

namespace App\Models\Ruv;

use CodeIgniter\Model;
use Config\Database;

class UsersRuvModel extends Model
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
        'IPCLIENTE',
        'SESIONES',
        'ID_USUARIO',
        'ID_UTERRITORIAL',
        'FECHA_INACTIVACION',
        'DESBLOQUEO_AUTOMATICO',
        'COD_MAC_USUARIO',
        'APLICA_FIRMADIGITAL',
        'APLICA_MAC_VAL',
        'SEUDONIMO',
        'US_FUENTECAMBIOCLAVE',
        'TERMINACIONCONTRATO',
        'ACUERDOCONFIDENCIALIDAD',
        'INICIOCONTRATO',
        'INTENTOSERRADOS',
        'SESIONES_RUV',
        'ID_PAIS',
        'ID_ENTIDADMUNICIPIO',
    ];

    protected $useTimestamps = false;
    protected $DBGroup = 'bd_ruv';

    public function getUserById($ID)
    {
        $sql = "
        select DISTINCT
            U.IDENTIFICACION,
            U.ID,
            CONVERT(U.NOMBRE, 'AL32UTF8') AS NOMBRE,
            CONVERT(U.USUARIO, 'AL32UTF8') AS USUARIO,
            U.CORREO_ELECTRONICO,
            U.ACTIVO,
            CONVERT(U.CARGO, 'AL32UTF8') AS CARGO,
            U.FECHA_INACTIVACION,
            U.FECHALOGEADO,
            CONVERT(LISTAGG(R.nombre, ', ') WITHIN GROUP (ORDER BY R.nombre),'AL32UTF8') AS roles,
            'N/A' AS NOMBRE_INACTIVO,
            'RUV' AS APLICATIVO
        FROM TBUSUARIOS U
        LEFT JOIN TBROLES_USUARIO RU ON RU.ID_USUARIO = U.ID
        LEFT JOIN TBROLES R ON R.ID = RU.ID_ROL
        WHERE U.ID =" . $ID . "
        GROUP BY 
            U.IDENTIFICACION, U.ID, U.NOMBRE, U.USUARIO, 
            U.CORREO_ELECTRONICO, U.ACTIVO, U.CARGO, 
            U.FECHA_INACTIVACION, U.FECHALOGEADO
        
        ";

        $query = $this->query($sql);
        return $query ?: false;
    }


    /**
     * The function `listUsersDoc` retrieves user information along with their roles based on a given
     * identification number.
     * 
     * @param IDENTIFICACION The `listUsersDoc` function is a PHP function that retrieves user information
     * based on the provided identification number (`IDENTIFICACION`). It fetches data from the
     * `TBUSUARIOS` table and joins it with the `TBROLES_USUARIO` and `TBROLES` tables to
     * 
     * @return The `listUsersDoc` function returns the result of a SQL query that fetches user information
     * based on the provided `IDENTIFICACION` parameter. The query selects distinct user details such as
     * identification, ID, name, username, email, active status, role, inactivation date, last login date,
     * and a list of roles associated with the user. The function then executes the query with the provided
     */
    public function listUsersDoc($IDENTIFICACION)
    {
        $sql = "select DISTINCT
            U.IDENTIFICACION,
            U.ID,
            CONVERT(U.NOMBRE, 'AL32UTF8') AS NOMBRE,
            CONVERT(U.USUARIO, 'AL32UTF8') AS USUARIO,
            U.CORREO_ELECTRONICO,
            U.ACTIVO,
            CONVERT(U.CARGO, 'AL32UTF8') AS CARGO,
            U.FECHA_INACTIVACION,
            U.FECHALOGEADO,
            CONVERT(LISTAGG(R.nombre, ', ') WITHIN GROUP (ORDER BY R.nombre),'AL32UTF8') AS roles,
            'N/A' AS NOMBRE_INACTIVO,
            'RUV' AS APLICATIVO
        FROM TBUSUARIOS U
        LEFT JOIN TBROLES_USUARIO RU ON RU.ID_USUARIO = U.ID
        LEFT JOIN TBROLES R ON R.ID = RU.ID_ROL
        WHERE U.IDENTIFICACION like '%" . $IDENTIFICACION . "%'
        GROUP BY 
            U.IDENTIFICACION, U.ID, U.NOMBRE, U.USUARIO, 
            U.CORREO_ELECTRONICO, U.ACTIVO, U.CARGO, 
            U.FECHA_INACTIVACION, U.FECHALOGEADO
        ";

        //$sql = "select U.id,CONVERT(U.NOMBRE, 'AL32UTF8') AS NOMBRE from TBUSUARIOS U where U.IDENTIFICACION like '1022418865'";
        $query = $this->query($sql);
        return $query;
    }


    /**
     * The function `listUsersName` retrieves user information based on a provided name parameter from a
     * database table and returns the result.
     * 
     * @param NAME The function `listUsersName` is a PHP function that retrieves user information based on
     * a provided name. It executes a SQL query to select distinct user details from the `TBUSUARIOS`
     * table, including user roles from related tables. The function uses a parameter `:NAME` in the
     * 
     * @return The `listUsersName` function returns the result of a SQL query that fetches user information
     * based on the provided name (``). The query selects distinct user details such as
     * identification, ID, name, username, email, active status, role, inactivation date, last login date,
     * and a concatenated list of roles associated with the user.
     */
    public function listUsersName($NAME)
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
                'RUV' AS APLICATIVO
            FROM TBUSUARIOS U
            LEFT JOIN TBROLES_USUARIO RU ON RU.ID_USUARIO = U.ID
            LEFT JOIN TBROLES R ON R.ID = RU.ID_ROL
            WHERE U.NOMBRE like " . $NAME . "
            GROUP BY 
                U.IDENTIFICACION, U.ID, U.NOMBRE, U.USUARIO, U.CORREO_ELECTRONICO,
                U.ACTIVO,U.CARGO,U.FECHA_INACTIVACION,U.FECHALOGEADO
        ";
        $query = $this->query($sql);

        return $query ?: false;
    }
}
