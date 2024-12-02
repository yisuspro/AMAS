<?php

namespace App\Models;

use CodeIgniter\Model;

class StatesUsersModel extends Model
{
    protected $table = 'statesusers';
    protected $primaryKey = 'STTS_PK';

    protected $allowedFields = [
        'STTS_name',
        'STTS_description'
    ];

    protected $useTimestamps = false;
    
    /**
     * The function listStatesUsers returns all records from a database table.
     * 
     * @param data It looks like the `listStatesUsers` function is currently not using the ``
     * parameter in the method. If you want to use the `` parameter to filter the results or
     * perform any specific operations, you can modify the function to utilize the `` parameter in
     * the query.
     * 
     * @return all columns from the database table without any specific conditions or filters applied.
     */
    public function listStatesUsers($data)
    {
        return $this->select('*')->get();
    }
}
