<?php

namespace App\Models\Amas;

use CodeIgniter\Model;

use App\Entities\Amas\DocumentspersonsEntity;

class DocumentsPersonsModel extends Model
{
    protected $table        = 'documentspersons';
    protected $primaryKey   = 'DCPR_PK';
    protected $returnType   = DocumentspersonsEntity::class;

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
        return $this->insert($data);
    }

    public function viewDocumentPersons($personId)
    {
        return $this->where('DCPR_FK_userauditory',$personId)->findAll();
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
