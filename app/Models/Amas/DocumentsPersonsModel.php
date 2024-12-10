<?php

namespace App\Models\Amas;

use CodeIgniter\Model;

class DocumentsPersonsModel extends Model
{
    protected $table = 'documentsDocumentPersons';
    protected $primaryKey = 'DCPR_PK';

    protected $allowedFields = [
        'DCPR_name',
        'DCPR_description',
        'DCPR_location',
        'DCPR_state',
        'DCPR_FK_person',
        'DCPR_FK_typedocument',
    ];

    protected $useTimestamps = false;

    public function listDocumentPersons()
    {
        return $this->select('*')->get();
    }
    
    public function insertDocumentPersons($data)
    {
        $this->insert($data);
        return $this->insert_id();
    }

    public function viewDocumentPersons($personId)
    {
        return $this->find($personId);
    }
    
    
    public function updateDocumentPersons($data)
    {
        $person = $this->find($data['DCPR_PK']);
        if ($person) {
            $this->update($data['DCPR_PK'], $data);
            return true;
        }
        return false;
    }

}
