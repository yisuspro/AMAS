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

    /**
     * The function `updateStateCenso` updates the value of the 'PMT_ESTADO' field to 557 where the
     * 'CS_ID' matches the provided value.
     * 
     * @param CS_ID The `CS_ID` parameter in the `updateStateCenso` function is used to specify the
     * value that will be used to update the `PMT_ESTADO` field in the database table.
     * 
     * @return The `updateStateCenso` function is returning the result of the update operation on the
     * database table where the `CS_ID` matches the provided ``. It sets the value of the
     * `PMT_ESTADO` column to 557. If the update operation is successful, it returns `true`. If the
     * update operation fails or encounters an error, it returns `false`.
     */
    public function updateStateCenso($CS_ID)
    {
         return $this->set('PMT_ESTADO',557)->where('CS_ID', $CS_ID)->update() ?? false;
    }

     /**
      * The function `insertarCensoPoblacional` inserts census population data into a database using a
      * stored procedure and returns the ID of the last inserted record.
      * 
      * @param params The `insertarCensoPoblacional` function you provided seems to be inserting data into a
      * database using a stored procedure. The function takes an array of parameters `` which are
      * used to bind values to the stored procedure.
      * 
      * @return The function `insertarCensoPoblacional` is returning the last inserted record ID from the
      * `ME_CENSOS` table as an associative array.
      */
    public function insertarCensoPoblacional($params)
     {
          // Establish the database connection
          $db = Database::connect($this->DBGroup);

          // Prepare the SQL statement for calling the stored procedure
          $sql = "
               DECLARE
                    P_CS_ID NUMBER;
                    P_TRANS NUMBER;
                    P_MENSAJE VARCHAR2(4000);
               BEGIN
                    PKG_DAE_CENSOS.PROC_INST_ME_CENSOS (
                         P_USUARIO => :P_USUARIO,
                         P_F_CENSO => :P_F_CENSO,
                         P_ENT_ID => :P_ENT_ID,
                         P_PMT_TIPO_CENSO => :P_PMT_TIPO_CENSO,
                         P_PMT_TIPO_POBLACION => :P_PMT_TIPO_POBLACION,
                         P_OTRA_POBLACION => :P_OTRA_POBLACION,
                         P_PMT_TIPO_DOC => :P_PMT_TIPO_DOC,
                         P_NUM_DOC => :P_NUM_DOC,
                         P_NOM1 => :P_NOM1,
                         P_NOM2 => :P_NOM2,
                         P_APE1 => :P_APE1,
                         P_APE2 => :P_APE2,
                         P_CARGO_RELA => :P_CARGO_RELA,
                         P_MAIL => :P_MAIL,
                         P_MOVIL => :P_MOVIL,
                         P_CS_ID => P_CS_ID,
                         P_TRANS => P_TRANS,
                         P_MENSAJE => P_MENSAJE
                    );
               END;
          ";

          // Bind the parameters to avoid SQL injection
          $db->query($sql, [
               ':P_USUARIO' => $params['P_USUARIO'],
               ':P_F_CENSO' => $params['P_F_CENSO'],
               ':P_ENT_ID' => $params['P_ENT_ID'],
               ':P_PMT_TIPO_CENSO' => $params['P_PMT_TIPO_CENSO'],
               ':P_PMT_TIPO_POBLACION' => $params['P_PMT_TIPO_POBLACION'],
               ':P_OTRA_POBLACION' => $params['P_OTRA_POBLACION'],
               ':P_PMT_TIPO_DOC' => $params['P_PMT_TIPO_DOC'],
               ':P_NUM_DOC' => $params['P_NUM_DOC'],
               ':P_NOM1' => $params['P_NOM1'],
               ':P_NOM2' => $params['P_NOM2'],
               ':P_APE1' => $params['P_APE1'],
               ':P_APE2' => $params['P_APE2'],
               ':P_CARGO_RELA' => $params['P_CARGO_RELA'],
               ':P_MAIL' => $params['P_MAIL'],
               ':P_MOVIL' => $params['P_MOVIL']
          ]);

          // Retrieve the last inserted record ID
          $resultId = $db->table('ME_CENSOS')->selectMax('CS_ID')->get();

          return $resultId->getRowArray();
     }

     /**
      * The function `insertarUbicaCensoPoblacional` inserts data into a database table using a stored
      * procedure and returns the ID of the last inserted record.
      * 
      * @param params The `insertarUbicaCensoPoblacional` function is designed to insert data into a
      * database table using a stored procedure. The parameters passed to this function are used to
      * bind values to the input parameters of the stored procedure.
      * 
      * @return The function `insertarUbicaCensoPoblacional` is returning the last inserted record ID
      * from the `MED_CENSOS_UBICACION` table as an associative array.
      */
     public function insertarUbicaCensoPoblacional($params)
     {
         // Establish the database connection
         $db = Database::connect($this->DBGroup);
     
         // Prepare the SQL statement for calling the stored procedure
         $sql = "
             DECLARE
                 P_CSU_ID NUMBER;
                 P_TRANS NUMBER;
                 P_MENSAJE VARCHAR2(4000);
             BEGIN
                 PKG_DAE_CENSOS.PROC_INST_MED_CENSOS_UBIC (
                     P_USUARIO => :P_USUARIO,
                     P_CS_ID => :P_CS_ID,
                     P_UBIC_ID => :P_UBIC_ID,
                     P_PMT_ENTORNO => :P_PMT_ENTORNO,
                     P_PMT_ZONA1 => :P_PMT_ZONA1,
                     P_DESC_ZONA1 => :P_DESC_ZONA1,
                     P_PMT_ZONA2 => :P_PMT_ZONA2,
                     P_DESC_ZONA2 => :P_DESC_ZONA2,
                     P_DIRECCION => :P_DIRECCION,
                     P_PMT_GRUPO_ETNICO => :P_PMT_GRUPO_ETNICO,
                     P_PMT_PUEBLO_ETNICO => :P_PMT_PUEBLO_ETNICO,
                     P_PMT_ORGAN_ETNICO => :P_PMT_ORGAN_ETNICO,
                     P_PMT_TERRIT_ETNICO => :P_PMT_TERRIT_ETNICO,
                     P_CABILDO => :P_CABILDO,
                     P_PMT_RETORNO => :P_PMT_RETORNO,
                     P_F_RETORNO => :P_F_RETORNO,
                     P_CSU_ID => P_CSU_ID,
                     P_TRANS => P_TRANS,
                     P_MENSAJE => P_MENSAJE
                 );
             END;
         ";
     
         // Bind the parameters to avoid SQL injection
         $db->query($sql, [
             ':P_USUARIO' => $params['P_USUARIO'],
             ':P_CS_ID' => $params['P_CS_ID'],
             ':P_UBIC_ID' => $params['P_UBIC_ID'],
             ':P_PMT_ENTORNO' => $params['P_PMT_ENTORNO'],
             ':P_PMT_ZONA1' => $params['P_PMT_ZONA1'],
             ':P_DESC_ZONA1' => $params['P_DESC_ZONA1'],
             ':P_PMT_ZONA2' => $params['P_PMT_ZONA2'],
             ':P_DESC_ZONA2' => $params['P_DESC_ZONA2'],
             ':P_DIRECCION' => $params['P_DIRECCION'],
             ':P_PMT_GRUPO_ETNICO' => $params['P_PMT_GRUPO_ETNICO'],
             ':P_PMT_PUEBLO_ETNICO' => $params['P_PMT_PUEBLO_ETNICO'],
             ':P_PMT_ORGAN_ETNICO' => $params['P_PMT_ORGAN_ETNICO'],
             ':P_PMT_TERRIT_ETNICO' => $params['P_PMT_TERRIT_ETNICO'],
             ':P_CABILDO' => $params['P_CABILDO'],
             ':P_PMT_RETORNO' => $params['P_PMT_RETORNO'],
             ':P_F_RETORNO' => $params['P_F_RETORNO']
         ]);
     
         // Retrieve the last inserted record ID from the MED_CENSOS_UBICACION table
         $resultId = $db->table('MED_CENSOS_UBICACION')->selectMax('CSU_ID')->get();
     
         return $resultId->getRowArray();
     }
     
}
