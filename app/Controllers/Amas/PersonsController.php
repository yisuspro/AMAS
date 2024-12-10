<?php

namespace App\Controllers\Amas;

use App\Controllers\BaseController;
use App\Models\Amas\PersonsModel;
use App\Models\Amas\DocumentsPersonsModel;

class PersonsController extends BaseController
{

    protected $personsModel;
    protected $documentPerson;

    public function __construct()
    {
        $this->personsModel = new PersonsModel();   
        $this->documentPerson = new DocumentsPersonsModel();   
    }


    public function index()
    {
        return view('private/views_ajax/persons/listPersons', ['title' => 'Administración Personas']);
    }

    public function createPerson() 
    {
        $personData = [
            'PRSN_name' => $this->request->getPost('PRSN_name'),
            'PRSN_document' => $this->request->getPost('PRSN_document'),
            'PRSN_email' => $this->request->getPost('PRSN_email'),
            'PRSN_phone' => $this->request->getPost('PRSN_phone'),
            'PRSN_position' => $this->request->getPost('PRSN_position')
        ];

    
        $file1 = $this->request->getFile('DCPR_name_1');
        $file2 = $this->request->getFile('DCPR_name_2');
        
        if ($saveId = $this->personsModel->insertPersons($personData)) {
            $uploadPath = realpath(ROOTPATH . '../') . DIRECTORY_SEPARATOR . getenv('app.uploadPath');

            if ($file1 && $file1->isValid()) {
                $filename1 = $file1->getRandomName();
                $file1->move($uploadPath, $filename1);

                $documentData = [
                    'DCPR_name' => $filename1,
                    'DCPR_description' => "",
                    'DCPR_location' => $uploadPath,
                    'DCPR_state' => 1,
                    'DCPR_FK_person' => $saveId,
                    'DCPR_FK_typedocument' => 1,
                ];

                $this->documentPerson->insertDocumentPersons($documentData);
            }
            
            if ($file2 && $file2->isValid()) {
                $filename2 = $file1->getRandomName();
                $file2->move($uploadPath, $filename2);
                $documentData = [
                    'DCPR_name' => $filename2,
                    'DCPR_description' => "",
                    'DCPR_location' => $uploadPath,
                    'DCPR_state' => 1,
                    'DCPR_FK_person' => $saveId,
                    'DCPR_FK_typedocument' => 1,
                ];

                $this->documentPerson->insertDocumentPersons($documentData);
            }

            $this->response->setStatusCode(201,$uploadPath);



        } else {
            $this->response->setStatusCode(401,'Error al crear la persona');
        }
    }

}
