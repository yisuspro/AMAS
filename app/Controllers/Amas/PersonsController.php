<?php

namespace App\Controllers\Amas;

use App\Controllers\BaseController;
use App\Models\Amas\AppspersonsModel;
use App\Models\Amas\PersonsModel;
use App\Models\Amas\DocumentsPersonsModel;
use App\Entities\Amas\AppspersonsEntity;
use App\Entities\Amas\PersonsEntity;
use App\Models\Amas\CasesModel;

class PersonsController extends BaseController
{
    protected $personsModel;
    protected $documentPerson;
    protected $appsPersonsModel;
    protected $casesModel;
    
    protected $appsPersonsEntity;
    protected $personsEntity;

    public function __construct()
    {
        $this->personsModel = new PersonsModel();
        $this->documentPerson = new DocumentsPersonsModel();
        $this->appsPersonsModel = new AppspersonsModel();
        $this->casesModel = new CasesModel();

        $this->appsPersonsEntity = new AppspersonsEntity();
        $this->personsEntity = new PersonsEntity();
    }
    /**
     * The index function returns a view for managing persons with the title "Administración Personas".
     * 
     * @return A view named 'adminPersons' located in the 'private/views_ajax/persons' directory is being
     * returned with the title 'Administración Personas'.
     */

    public function index()
    {
        return view('private/views_ajax/persons/adminPersons', ['title' => 'Administración Personas']);
    }

   
    /**
     * The function `createPerson` creates a new person entity with specified details and uploads
     * associated documents, returning a success message or an error message accordingly.
     * 
     * @return If the `insertPersons` method in the `personsModel` is successful in inserting the
     * person entity data and returns a person ID, then the function will upload documents for that
     * person and return a response with status code 201 indicating that the documents were uploaded
     * successfully.
     */
    public function createPerson()
    {
        $this->personsEntity->fill([
            'PRSN_name' => $this->request->getPost('PRSN_name'),
            'PRSN_document' => $this->request->getPost('PRSN_document'),
            'PRSN_email' => $this->request->getPost('PRSN_email'),
            'PRSN_phone' => $this->request->getPost('PRSN_phone'),
            'PRSN_position' => $this->request->getPost('PRSN_position')
        ]);

        if ($personId = $this->personsModel->insertPersons($this->personsEntity)) {
            $this->uploadDocuments($personId);
            return $this->response->setStatusCode(201, 'Documentos cargados satisfactoriamente');
        }

        return $this->response->setStatusCode(401, 'Error al crear la persona');
    }

    /**
     * The function `uploadDocuments` uploads documents for a specific person based on the provided
     * person ID and document types.
     * 
     * @param int personId The `personId` parameter is an integer value that represents the unique
     * identifier of a person for whom the documents are being uploaded. It is used to associate the
     * uploaded documents with the specific person in the system.
     */
    private function uploadDocuments(int $personId)
    {
        $uploadPath = realpath(ROOTPATH . '../') . DIRECTORY_SEPARATOR . getenv('app.uploadPath');
        
        foreach ([1, 2] as $docType) {
            if ($file = $this->request->getFile("DCPR_name_$docType")) {
                $this->uploadDocument($file, $personId, $uploadPath, $docType);
            }
        }
    }


   /**
    * The function `uploadDocument` uploads a file to a specified path and inserts document data into a
    * database table related to a specific person.
    * 
    * @param file The `file` parameter in the `uploadDocument` function represents the file that is
    * being uploaded. It is typically an instance of a file uploaded through a form in a web
    * application.
    * @param personId The `personId` parameter in the `uploadDocument` function represents the unique
    * identifier of the person for whom the document is being uploaded. It is used to associate the
    * uploaded document with the specific person in the system.
    * @param uploadPath The `uploadPath` parameter in the `uploadDocument` function represents the
    * directory path where the uploaded document will be stored on the server. This is the location
    * where the file will be moved to after it has been successfully uploaded.
    * @param documentType The `documentType` parameter in the `uploadDocument` function represents the
    * type of document being uploaded. It is used to specify the category or type of the document being
    * uploaded, such as identification card, passport, driver's license, etc. This information is
    * important for categorizing and organizing the documents
    */
    private function uploadDocument($file, $personId, $uploadPath, $documentType)
    {
        if ($file->isValid() && !$file->hasMoved()) {
            $filename = $file->getRandomName();
            $file->move($uploadPath, $filename);

            $this->documentPerson->insertDocumentPersons([
                'DCPR_name' => $filename,
                'DCPR_description' => '',
                'DCPR_location' => $uploadPath,
                'DCPR_state' => 1,
                'DCPR_FK_person' => $personId,
                'DCPR_FK_typedocument' => $documentType,
            ]);
        }
    }

    /**
     * The function `consultarUsersAppsView` returns a view for querying users in applications.
     * 
     * @return A view named 'consultarUsuariosAjax' located in the 'private/views_ajax/persons' directory
     * is being returned with the title 'Consulta usuarios Aplicaciones'.
     */
    public function consultarUsersAppsView()
    {
        return view('private/views_ajax/persons/consultarUsuariosAjax', ['title' => 'Consulta usuarios Aplicaciones']);
    }

    /**
     * The `setApps` function iterates over a list of models to retrieve user data based on a document
     * number and saves the information to a database table while returning the collected user data.
     * 
     * @param document The `document` parameter in the `setApps` function seems to represent some kind of
     * document identifier or reference. It is used within the function to retrieve user information from
     * different models based on the document provided.
     * @param person The `setApps` function you provided seems to be setting applications for a specific
     * person based on their document number. It loops through an array of models representing different
     * applications, retrieves users for each application, and then saves the application information for
     * the person in the `appsPersonsEntity`.
     * 
     * @return The `setApps` function is returning an array of applications (``) after
     * iterating through the `` array and merging user data from different models into the
     * `` array.
     */
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
    
    /**
     * The function `searchPersonWithUsers` searches for a person by document, retrieves associated apps
     * and users, and sets new apps if needed.
     * 
     * @return The `searchPersonWithUsers` function returns a JSON response containing information about a
     * person and associated applications. The response includes two main keys:
     * 1. "info": Contains information about the local person retrieved based on the provided document.
     * 2. "data": Contains an array of users associated with the person's applications.
     */

    public function searchPersonWithUsers()  
    {
        $document = $this->request->getPost('PRSN_document');
        $aplicaciones = [];
        $localPerson = $this->personsModel->getPersonbyDocument($document);

        if ($localPerson) {
            // If the person exists, fetch associated apps
            $apps = $this->appsPersonsModel->getAppsByPerson($localPerson->PRSN_PK);
            // Fetch users based on app type
            foreach ($apps as $app) {

                if($app->APPR_FK_app == 1){
                    $aplicaciones = array_merge($aplicaciones, $this->UsersRuvModel->getUserById($app->APPR_ID_app)->getResultArray());
                }elseif($app->APPR_FK_app == 2){
                    $aplicaciones = array_merge($aplicaciones, $this->UsersSiravModel->getUserById($app->APPR_ID_app)->getResultArray());
                }elseif($app->APPR_FK_app == 3){
                    $aplicaciones = array_merge($aplicaciones, $this->UsersSipodModel->getUserById($app->APPR_ID_app)->getResultArray());
                }
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
                $this->personsEntity->fill([
                    'PRSN_name'     => $aplicaciones[0]['NOMBRE'],
                    'PRSN_document' => $document,
                    'PRSN_email'    => $aplicaciones[0]['CORREO_ELECTRONICO'],
                    'PRSN_phone'    => 0,
                    'PRSN_position' => $aplicaciones[0]['CARGO'],
                ]);
    
                $this->personsModel->save($this->personsEntity);
    
                // Set new apps for the newly created person
                $aplicaciones = $this->setApps($document, $this->personsModel->insertID());
                
                $localPerson = $this->personsModel->getPersonbyDocument($document);
            }
        }
    
        $cases = $this->casesModel->listCaseDocument($document);

        $documents = $this->documentPerson->viewDocumentPersons($localPerson->PRSN_PK);

        return json_encode([
            "info"      => $localPerson,
            "data"      => $aplicaciones,
            "cases"     => $cases,
            "documents" => $documents
        ]);
    }
}
   
