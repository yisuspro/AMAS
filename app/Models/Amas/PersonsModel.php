<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\PersonsEntity;

class PersonsModel extends Model
{
    protected $table        = 'persons';
    protected $primaryKey   = 'PRSN_PK';
    protected $returnType   = PersonsEntity::class;

    protected $allowedFields = [
        'PRSN_document',
        'PRSN_name',
        'PRSN_email',
        'PRSN_phone',
        'PRSN_position',
    ];

    protected $useTimestamps = false;

    /**
     * List all persons in the database
     * 
     * @return mixed
     */
    public function listPersons()
    {
        return $this->select('*')->findAll();
    }
    
    /**
     * Insert a new person record into the database
     * 
     * @param array $data
     * @return int|string
     */
    public function insertPersons($data)
    {
        return $this->insert($data);
    }

    /**
     * View a single person's details by their ID
     * 
     * @param int $personId
     * @return PersonsEntity|null
     */
    public function viewPersons($personId)
    {
        return $this->find($personId);
    }

    /**
     * Get person by their document
     * 
     * @param string $document
     * @return PersonsEntity|null
     */
    public function getPersonbyDocument($document)
    {
        return $this->where('PRSN_document', $document)->first();
    }

    /**
     * Update a person's record in the database
     * 
     * @param PersonsEntity $data
     * @return bool
     */
    public function updatePersons($data)
    {
        // Ensure the record exists before attempting to update
        $person = $this->find($data->PRSN_PK);
        if ($person) {
            return $this->update($data->PRSN_PK, $data);
        }
        return false;
    }
}
