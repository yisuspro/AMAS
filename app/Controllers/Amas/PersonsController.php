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

        $files = [
            $this->request->getFile('DCPR_name_1'),
            $this->request->getFile('DCPR_name_2')
        ];

        if ($saveId = $this->personsModel->insertPersons($personData)) {
            $uploadPath = realpath(ROOTPATH . '../') . DIRECTORY_SEPARATOR . getenv('app.uploadPath');
            foreach ($files as $index => $file) {
                $this->uploadDocument($file, $saveId, $uploadPath, $index + 1);
            }
            $this->response->setStatusCode(201, 'Documentos cargados satisfactoriamente');
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

    private function setApps($document, $person)
    {
        $aplicaciones = [];
        $apps = [
            1 => $this->UsersRuvModel,
            2 => $this->UsersSiravModel,
            3 => $this->UsersSipodModel,
        ];

        foreach ($apps as $appId => $model) {
            $user = $model->listUsersDoc($document)->getResultArray();
            if ($user) {
                $aplicaciones = array_merge($aplicaciones, $user);

                $this->appsPersonsEntity->APPR_FK_app = $appId;
                $this->appsPersonsEntity->APPR_FK_person = $person;
                $this->appsPersonsEntity->APPR_state = 1;
                $this->appsPersonsEntity->APPR_confidentiality = 1;
                $this->appsPersonsEntity->APPR_date_validity = date('Y-m-d H:i:s');
                $this->appsPersonsEntity->APPR_ID_app = $user[0]['ID'];
                $this->appsPersonsModel->save($this->appsPersonsEntity);
            }
        }

        return $aplicaciones;
    }

    public function searchPersonWithUsers()
    {
        $document = $this->request->getPost('PRSN_document');
        $aplicaciones = [];
    
        // Try to find the person based on the document
        $localPerson = $this->personsModel->getPersonbyDocument($document);
    
        if ($localPerson) {
            // If the person exists, fetch associated apps
            $apps = $this->appsPersonsModel->getAppsByPerson($localPerson->PRSN_PK);
    
            // Fetch users based on app type
            foreach ($apps as $app) {

                if($app->APPR_FK_app == 1)
                    $aplicaciones = array_merge($aplicaciones, $this->UsersRuvModel->getUserById($app->APPR_ID_app)->getResultArray());
                if($app->APPR_FK_app == 2)
                    $aplicaciones = array_merge($aplicaciones, $this->UsersSiravModel->getUserById($app->APPR_ID_app)->getResultArray());
                if($app->APPR_FK_app == 3)
                    $aplicaciones = array_merge($aplicaciones, $this->UsersSipodModel->getUserById($app->APPR_ID_app)->getResultArray());
            }
    
            // If no apps are found, set new apps
            if (!$apps) {
                $aplicaciones = $this->setApps($document, $localPerson->PRSN_PK);
            }
    
        } else {
            // If no local person found, try to fetch users from other models
            $aplicaciones = array_merge(
                $this->UsersRuvModel->listUsersDoc($document)->getResultArray(),
                $this->UsersSiravModel->listUsersDoc($document)->getResultArray(),
                $this->UsersSipodModel->listUsersDoc($document)->getResultArray()
            );
    
            // If users are found, save the person and associate new apps
            if (count($aplicaciones)) {
                $this->personsEntity->PRSN_name = $aplicaciones[0]['NOMBRE'];
                $this->personsEntity->PRSN_document = $document;
                $this->personsEntity->PRSN_email = $aplicaciones[0]['CORREO_ELECTRONICO'];
                $this->personsEntity->PRSN_phone = 0; // No phone in the response
                $this->personsEntity->PRSN_position = $aplicaciones[0]['CARGO'];
    
                $this->personsModel->save($this->personsEntity);
    
                // Set new apps for the newly created person
                $aplicaciones = $this->setApps($document, $this->personsModel->insertID());
                
                $localPerson = $this->personsModel->getPersonbyDocument($document);
            }
        }
    
        return json_encode(["info" => $localPerson,"data"=>$aplicaciones]);
    }
}
