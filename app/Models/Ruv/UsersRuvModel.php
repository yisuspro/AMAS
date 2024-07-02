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

   

    public function listUsersDoc($IDENTIFICACION)
    {
        $sql = "select DISTINCT
            U.IDENTIFICACION,
            U.ID ,
            U.NOMBRE,
            U.USUARIO,
            U.CORREO_ELECTRONICO,
            U.ACTIVO,
            U.CARGO,
            U.FECHA_INACTIVACION,
            U.FECHALOGEADO,
            LISTAGG(R.nombre, ', ') WITHIN GROUP (ORDER BY R.nombre) AS roles
            FROM TBUSUARIOS U
            LEFT JOIN TBROLES_USUARIO RU ON RU.ID_USUARIO = U.ID
            LEFT JOIN TBROLES R ON R.ID = RU.ID_ROL
            WHERE U.IDENTIFICACION = '".$IDENTIFICACION."'
            GROUP BY U.IDENTIFICACION, U.ID, U.NOMBRE, U.USUARIO, U.CORREO_ELECTRONICO,U.ACTIVO,U.CARGO,U.FECHA_INACTIVACION,U.FECHALOGEADO";
        if ($query = $this->query($sql)) {
            return $query;
        } else {
            return false;
        }
    }

    public function listUsersName($NAME)
    {
        $sql = "select DISTINCT
            U.IDENTIFICACION,
            U.ID ,
            U.NOMBRE,
            U.USUARIO,
            U.CORREO_ELECTRONICO,
            U.ACTIVO,
            U.CARGO,
            U.FECHA_INACTIVACION,
            U.FECHALOGEADO,
            LISTAGG(R.nombre, ', ') WITHIN GROUP (ORDER BY R.nombre) AS roles
            FROM TBUSUARIOS U
            LEFT JOIN TBROLES_USUARIO RU ON RU.ID_USUARIO = U.ID
            LEFT JOIN TBROLES R ON R.ID = RU.ID_ROL
            WHERE U.NOMBRE like '%".$NAME."%'
            GROUP BY U.IDENTIFICACION, U.ID, U.NOMBRE, U.USUARIO, U.CORREO_ELECTRONICO,U.ACTIVO,U.CARGO,U.FECHA_INACTIVACION,U.FECHALOGEADO";
        if ($query = $this->query($sql)) {
            return $query;
        } else {
            return false;
        }
    }

    public function prueba()
    {
       
    }
}
