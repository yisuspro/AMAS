<?php

namespace App\Models\Vivanto;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use Config\Database;

class RegistroPoblacionalModel extends Model
{

    protected $table = 'ME_CENSOS';
    protected $DBGroup = 'bd_reg_poblacional';
    protected $allowedFields = ['PMT_ESTADO'];

    

    

    public function updateStateCenso($CS_ID)
    {
        $query = $this->set('PMT_ESTADO',557)->where('CS_ID', $CS_ID);

        if ($query->update()) {
            return $query;
        } else {
            return false;
        }
    }

    public function insertarCensoPoblacional($params)
    {
        $db = Database::connect($this->DBGroup);
        // Construir la consulta SQL para llamar al procedimiento almacenado
       $sql = "
       DECLARE
            P_CS_ID NUMBER;
            P_TRANS NUMBER;
            P_MENSAJE VARCHAR2(4000);
       begin
                PKG_DAE_CENSOS.PROC_INST_ME_CENSOS ( 
                P_USUARIO =>".$params['P_USUARIO'].",
                P_F_CENSO =>".$params['P_F_CENSO'].",
                P_ENT_ID =>".$params['P_ENT_ID'].",
                P_PMT_TIPO_CENSO =>".$params['P_PMT_TIPO_CENSO'].",
                P_PMT_TIPO_POBLACION =>".$params['P_PMT_TIPO_POBLACION'].",
                P_OTRA_POBLACION =>".$params['P_OTRA_POBLACION'].",
                P_PMT_TIPO_DOC =>".$params['P_PMT_TIPO_DOC'].",
                P_NUM_DOC =>".$params['P_NUM_DOC'].",
                P_NOM1 =>".$params['P_NOM1'].",
                P_NOM2 =>".$params['P_NOM2'].",
                P_APE1 =>".$params['P_APE1'].",
                P_APE2 =>".$params['P_APE2'].",
                P_CARGO_RELA =>".$params['P_CARGO_RELA'].",
                P_MAIL =>".$params['P_MAIL'].",
                P_MOVIL =>".$params['P_MOVIL'].",
                P_CS_ID => P_CS_ID,
                P_TRANS => P_TRANS,
                P_MENSAJE=> P_MENSAJE);
        end; ";
        
       if ($query = $db->query($sql)){
            $resultId = $db->table('ME_CENSOS')->selectMax('CS_ID')->get();
       }
       return $resultId->getRowArray();
    }

    public function insertarUbicaCensoPoblacional($params)
    {
        $db = Database::connect($this->DBGroup);
        // Construir la consulta SQL para llamar al procedimiento almacenado
       $sql = "
       DECLARE
            P_CSU_ID NUMBER;
            P_TRANS NUMBER;
            P_MENSAJE VARCHAR2(4000);
       begin
            PKG_DAE_CENSOS.PROC_INST_MED_CENSOS_UBIC ( 
            P_USUARIO => ".$params['P_USUARIO'].",
            P_CS_ID => ".$params['P_CS_ID'].",
            P_UBIC_ID => ".$params['P_UBIC_ID'].", 
            P_PMT_ENTORNO => ".$params['P_PMT_ENTORNO'].", 
            P_PMT_ZONA1 => ".$params['P_PMT_ZONA1'].", 
            P_DESC_ZONA1 => ".$params['P_DESC_ZONA1'].", 
            P_PMT_ZONA2 => ".$params['P_PMT_ZONA2'].",
            P_DESC_ZONA2 => ".$params['P_DESC_ZONA2'].",
            P_DIRECCION => ".$params['P_DIRECCION'].",
            P_PMT_GRUPO_ETNICO => ".$params['P_PMT_GRUPO_ETNICO'].",
            P_PMT_PUEBLO_ETNICO => ".$params['P_PMT_PUEBLO_ETNICO'].",
            P_PMT_ORGAN_ETNICO => ".$params['P_PMT_ORGAN_ETNICO'].", 
            P_PMT_TERRIT_ETNICO => ".$params['P_PMT_TERRIT_ETNICO'].",
            P_CABILDO => ".$params['P_CABILDO'].",
            P_PMT_RETORNO => ".$params['P_PMT_RETORNO'].",
            P_F_RETORNO => ".$params['P_F_RETORNO'].",
            P_CSU_ID => P_CSU_ID,
            P_TRANS => P_TRANS, 
            P_MENSAJE => P_MENSAJE);
        end; ";
        
   
       if ($query = $db->query($sql)){
        $resultId = $db->table('MED_CENSOS_UBICACION')->selectMax('CSU_ID')->get();
       }
       return $resultId->getRowArray();  

    }
}
