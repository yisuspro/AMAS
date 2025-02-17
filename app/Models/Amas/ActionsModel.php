<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\ActionsEntity;

use function PHPUnit\Framework\returnSelf;

class ActionsModel extends Model
{
    protected $table            = 'actions';
    protected $primaryKey       = 'ACTN_PK';
    protected $useAutoIncrement = true;
    protected $returnType       = ActionsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "ACTN_modified_record",
        "ACTN_description",
        "ACTN_description",
        "ACTN_FK_case"
    ];



    /**
     * The insertActions function inserts multiple rows of data into a database table using batch
     * insertion.
     * 
     * @param data The `insertActions` function appears to be a method that inserts multiple records
     * into a database table using batch insertion. The `` parameter likely contains an array of
     * data to be inserted into the database table.
     * 
     * @return The `insertActions` function is returning the result of calling the `insertBatch` method
     * with the `` parameter.
     */
    public function insertActions($data)
    {
      
       return $this->insertBatch($data);
    }
}
