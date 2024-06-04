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
            FROM SIPOD.TBUSUARIOS U
            LEFT JOIN SIPOD.TBROLES_USUARIO RU ON RU.ID_USUARIO = U.ID
            LEFT JOIN SIPOD.TBROLES R ON R.ID = RU.ID_ROL
            WHERE U.IDENTIFICACION = '".$IDENTIFICACION."'
            GROUP BY U.IDENTIFICACION, U.ID, U.NOMBRE, U.USUARIO, U.CORREO_ELECTRONICO,U.ACTIVO,U.FECHA_INACTIVACION,U.CARGO,U.FECHALOGEADO";
        if ($query = $this->query($sql)) {
            return $query;
        } else {
            return false;
        }
    }
}
