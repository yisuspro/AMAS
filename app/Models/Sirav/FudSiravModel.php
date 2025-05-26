<?php

namespace App\Models\Sirav;

use CodeIgniter\Model;
use Config\Database;

class FudSiravModel extends Model
{
    protected $table = 'CONCEPTO_VALORACION';
    protected $primaryKey = 'id';

    protected $allowedFields = [
    ];

    protected $useTimestamps = false;
    protected $DBGroup = 'bd_sirav';

    public function getFudByNumber($NUMBER)
    {

        $sql = "
            SELECT	
                CV.CodigoDeclaracion,
                CV.id,
                CV.Resolucion,
                --CE.id ESTADO_ID,
                CE.descripcion ESTADO,
                U.ID,
                CV.TipoValoracionId,
                CONVERT(VARCHAR(100),U.PRIMER_NOMBRE) as PRIMER_NOMBRE,
                CONVERT(VARCHAR(100),U.SEGUNDO_NOMBRE) as SEGUNDO_NOMBRE,
                CONVERT(VARCHAR(100),U.PRIMER_APELLIDO)as PRIMER_APELLIDO,
                CONVERT(VARCHAR(100),U.SEGUNDO_APELLIDO) as SEGUNDO_APELLIDO,
                cv.Observaciones,

                CV.Dia_Valoracion,
                CV.Mes_Valoracion,
                CV.Año_Valoracion,

                cv.ORFEO_RESOLUCION
            FROM SIRAVActosAdmin.dbo.CONCEPTO_VALORACION CV
            LEFT JOIN SIRAVActosAdmin.dbo.CONCEPTO_ESTADOS CE ON CE.id = CV.estadoID
            LEFT JOIN SIRAVAdmin.dbo.USUARIO U ON U.ID = CV.ValoradorId
            WHERE CV.CodigoDeclaracion IN ('".$NUMBER."')
        ";

        $query = $this->query($sql);
        return $query ?: false;
        
    }
}
