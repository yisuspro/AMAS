<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\ObservationsEntity;

class ObservationsModel extends Model
{
    protected $table            = 'observations';
    protected $primaryKey       = 'OBSV_PK';
    protected $useAutoIncrement = true;
    protected $returnType       = ObservationsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "OBSV_name",
        "OBSV_description",
        "OBSV_FK_case",
    ];


   /**
    * The insertObservation function inserts multiple records into a database table in PHP.
    * 
    * @param data The `insertObservation` function seems to be a method that inserts multiple
    * observations into a database table at once using the `insertBatch` method. The `` parameter
    * likely contains an array of observation data that needs to be inserted into the database table.
    * 
    * @return The `insertBatch` method is being called with the `` parameter and its return value
    * is being returned from the `insertObservation` method.
    */
    public function insertObservation($data)
    {
      
       return $this->insertBatch($data);
    }
}
