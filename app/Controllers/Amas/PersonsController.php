<?php

namespace App\Controllers\Amas;

use App\Controllers\BaseController;
use App\Models\Amas\AppspersonsModel;
use App\Models\Amas\PersonsModel;
use App\Models\Amas\DocumentsPersonsModel;
use App\Entities\Amas\AppspersonsEntity;
use App\Entities\Amas\PersonsEntity;

class PersonsController extends BaseController
{
    protected $personsModel;
    protected $documentPerson;
    protected $appsPersonsModel;
    protected $appsPersonsEntity;
    protected $personsEntity;

    public function __construct()
    {
        $this->personsModel = new PersonsModel();   
        $this->documentPerson = new DocumentsPersonsModel();   
        $this->appsPersonsModel = new AppspersonsModel();   
        $this->appsPersonsEntity = new AppspersonsEntity();   
        $this->personsEntity = new PersonsEntity();   
    }

    public function index()
    {
        return view('private/views_ajax/persons/adminPersons', ['title' => 'Administración Personas']);
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

            $this->uploadDocument($file1, $saveId, $uploadPath, 1);
            $this->uploadDocument($file2, $saveId, $uploadPath, 2);

            $this->response->setStatusCode(201, $uploadPath);
        } else {
            $this->response->setStatusCode(401, 'Error al crear la persona');
        }
    }

    private function uploadDocument($file, $personId, $uploadPath, $documentType)
    {
        if ($file && $file->isValid()) {
            $filename = $file->getRandomName();
            $file->move($uploadPath, $filename);

            $documentData = [
                'DCPR_name' => $filename,
                'DCPR_description' => '',
                'DCPR_location' => $uploadPath,
                'DCPR_state' => 1,
                'DCPR_FK_person' => $personId,
                'DCPR_FK_typedocument' => $documentType,
            ];

            $this->documentPerson->insertDocumentPersons($documentData);
        }
    }

    public function consultarUsersAppsView()
    {
        return view('private/views_ajax/persons/consultarUsuariosAjax', ['title' => 'Consulta usuarios Aplicaciones']);
    }


    private function setApps($document,$person){
        $aplicaciones = [];

        $ruvUser = $this->UsersRuvModel->listUsersDoc($document)->getResultArray();
        if($ruvUser){
            $aplicaciones = array_merge($aplicaciones, $ruvUser);

            $this->appsPersonsEntity->APPR_FK_app = 1 ;
            $this->appsPersonsEntity->APPR_FK_person = $person;
            $this->appsPersonsEntity->APPR_state = 1;
            $this->appsPersonsEntity->APPR_confidentiality = 1;
            $this->appsPersonsEntity->APPR_date_validity = date('Y-m-d H:i:s');
            $this->appsPersonsEntity->APPR_ID_app = $ruvUser[0]['ID'];
            $this->appsPersonsModel->save($this->appsPersonsEntity);
        }

        $siravUser = $this->UsersSiravModel->listUsersDoc($document)->getResultArray();
        if($siravUser){
            $aplicaciones = array_merge($aplicaciones, $siravUser);

            $this->appsPersonsEntity->APPR_FK_app = 2;
            $this->appsPersonsEntity->APPR_FK_person = $person;
            $this->appsPersonsEntity->APPR_state = 1;
            $this->appsPersonsEntity->APPR_confidentiality = 1;
            $this->appsPersonsEntity->APPR_date_validity = date('Y-m-d H:i:s');
            $this->appsPersonsEntity->APPR_ID_app = $siravUser[0]['ID'];
            $this->appsPersonsModel->save($this->appsPersonsEntity);
        }

        $sipodUser = $this->UsersSipodModel->listUsersDoc($document)->getResultArray();
        if($sipodUser){
            $aplicaciones = array_merge($aplicaciones, $sipodUser);

            $this->appsPersonsEntity->APPR_FK_app = 3;
            $this->appsPersonsEntity->APPR_FK_person = $person;
            $this->appsPersonsEntity->APPR_state = 1;
            $this->appsPersonsEntity->APPR_confidentiality = 1;
            $this->appsPersonsEntity->APPR_date_validity = date('Y-m-d H:i:s');
            $this->appsPersonsEntity->APPR_ID_app = $sipodUser[0]['ID'];
            $this->appsPersonsModel->save($this->appsPersonsEntity);
        }

        return $aplicaciones;
    }

    public function searchPersonWithUsers()
    {
        $document = $this->request->getPost('PRSN_document');
        $aplicaciones = [];

        // Merge results from different user models

        $localPerson = $this->personsModel->getPersonbyDocument($document);


        if ($localPerson) {
            $apps = $this->appsPersonsModel->getAppsByPerson($localPerson->PRSN_PK);

            if($apps) {
                foreach($apps as $app) {
                    if($app->APPR_FK_app == 1)
                        $aplicaciones = array_merge($aplicaciones, $this->UsersRuvModel->getUserById($app->APPR_ID_app)->getResultArray());
                    if($app->APPR_FK_app == 2)
                        $aplicaciones = array_merge($aplicaciones, $this->UsersSiravModel->getUserById($app->APPR_ID_app)->getResultArray());
                    if($app->APPR_FK_app == 3)
                        $aplicaciones = array_merge($aplicaciones, $this->UsersSipodModel->getUserById($app->APPR_ID_app)->getResultArray());
                }   
            } else {
                $aplicaciones = $this->setApps($document,$localPerson->PRSN_PK);
                
            }
        } else {
            $aplicaciones = array_merge($aplicaciones, $this->UsersRuvModel->listUsersDoc($document)->getResultArray());
            $aplicaciones = array_merge($aplicaciones, $this->UsersSiravModel->listUsersDoc($document)->getResultArray());
            $aplicaciones = array_merge($aplicaciones, $this->UsersSipodModel->listUsersDoc($document)->getResultArray());

            if (count($aplicaciones)) {
                $this->personsEntity->PRSN_name = $aplicaciones[0]['NOMBRE'];
                $this->personsEntity->PRSN_document = $document;
                $this->personsEntity->PRSN_email = $aplicaciones[0]['CORREO_ELECTRONICO'];
                $this->personsEntity->PRSN_phone = 0;
                $this->personsEntity->PRSN_position = $aplicaciones[0]['CARGO'];

                $this->personsModel->save($this->personsEntity);


                $aplicaciones = $this->setApps($document,$this->personsModel->insertID());
            }

        }

        return json_encode($aplicaciones);

    }
}
