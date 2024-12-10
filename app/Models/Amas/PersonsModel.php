<?php

namespace App\Models\Amas;

use CodeIgniter\Model;

class PersonsModel extends Model
{
    protected $table = 'persons';
    protected $primaryKey = 'PRSN_PK';

    protected $allowedFields = [
        'PRSN_document',
        'PRSN_name',
        'PRSN_email',
        'PRSN_phone',
        'PRSN_position',
    ];

    protected $useTimestamps = false;

    public function listPersons()
    {
        return $this->select('*')->get();
    }
    
    public function insertPersons($data)
    {
        return $this->insert($data);
    }

    public function viewPersons($personId)
    {
        return $this->find($personId);
    }
    
    
    public function updatePersons($data)
    {
        $person = $this->find($data['PRSN_PK']);
        if ($person) {
            $this->update($data['PRSN_PK'], $data);
            return true;
        }
        return false;
    }

}
