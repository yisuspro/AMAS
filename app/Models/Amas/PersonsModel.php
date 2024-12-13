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

    public function listPersons()
    {
        return $this->select('*')->get();
    }
    
    public function insertPersons($data)
    {
        return $this->insert($data);
//        return $this->insert_id();
    }

    public function viewPersons($personId)
    {
        return $this->find($personId);
    }

    public function getPersonbyDocument($document) {
        return $this->where('PRSN_document',$document)
            //->join('appspersons', 'APPR_FK_person = PRSN_PK', 'left')
            //->join('apps', 'APPS_PK = APPR_FK_app', 'left')
            //->find()
            ->first();
    }
    
    
    public function updatePersons($data)
    {
        $person = $this->find($data->PRSN_PK);
        if ($person) {
            $this->update($data->PRSN_PK, $data);
            return true;
        }
        return false;
    }

}
