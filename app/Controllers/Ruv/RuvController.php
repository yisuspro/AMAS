<?php

namespace App\Controllers\Ruv;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Ruv\FudRuvModel;
use App\Models\Amas\CasesModel;
use App\Models\Amas\ActionsModel;
use App\Models\Amas\ObservationsModel;

use App\Entities\Amas\CasesEntity;

class RuvController extends BaseController
{
    protected $FudRuvModel;
    protected $CasesModel;
    protected $CasesEntity;
    protected $ActionsModel;
    protected $ObservationsModel;

    public function __construct()
    {
        $this->FudRuvModel = new FudRuvModel();
        $this->CasesModel = new CasesModel();
        $this->ActionsModel = new ActionsModel();
        $this->ObservationsModel = new ObservationsModel();

        $this->CasesEntity = new CasesEntity();
    }

    public function index()
    {
        return view('private/views_ajax/Ruv/EditEntities', ['title' => 'Cambio de Entidad']);
    }

   /**
    * The function `searchEntity` retrieves entities from a model based on a form number input and
    * returns the result in JSON format.
    * 
    * @return The `searchEntity` function is returning a JSON-encoded array of entities retrieved from
    * the FudRuvModel based on the provided 'numeroformulario' input.
    */
    public function searchEntity()
    {
        $declaracion = $this->request->getPost('numeroformulario');

         return json_encode($this->FudRuvModel->getEntitiesFromFud($declaracion)->getResultArray());
    }
    
    /**
     * The function `changeEntity` processes a form submission to update an entity in a database and
     * creates related records in other tables if the update is successful.
     * 
     * @return a JSON-encoded response of the variable ``, which contains the result of the
     * `setNewEntityToFud` method call from the `FudRuvModel`. If the save operation is successful, it
     * will also insert a new case, actions, and observations related to the entity change. If any
     * errors occur during these insert operations, it will return an error response with the
     */
    public function changeEntity()
    {
        $declaracion = $this->request->getPost('numdeclaracion');
        $entidad = $this->request->getPost('entidad');
        
        $save = $this->FudRuvModel->setNewEntityToFud($declaracion,$entidad);

        if($save) {
            $CaseData = [
                'CASE_FK_agent'          => $this->session->get('USER_PK'),
                'CASE_number'            => 'Correo',
                'CASE_date_reception'    => date('Y-m-d'),
                'CASE_date_solution'     => date('Y-m-d'),
                'CASE_FK_app'            => 1,
                'CASE_FK_case_categorie' => 1,
                'CASE_FK_entities'       => 1,
                'CASE_FK_dependence'     => 12,
                'CASE_FK_state_case'     => 0,
                'CASE_FK_tipe_case'      => 38,
            ];
            $this->CasesEntity->fill($CaseData);
            $idCase = $this->CasesModel->insertCase($this->CasesEntity);

            $actionsData = [[
                'ACTN_FK_case'         => $idCase,
                'ACTN_modified_record' => $declaracion,
                'ACTN_description'     => "Acción realizada por SUSI",
            ]];

            if (!$this->ActionsModel->insertActions($actionsData)) {
                return $this->response->setStatusCode(401, 'Error al cargar las acciones');
            }

            $observation = $this->request->getPost('observations');

            $observationsData = [[
                'OBSV_FK_case'     => $idCase,
                'OBSV_name'        => '',
                'OBSV_description' => $observation,
            ]];
    
            if (!$this->ObservationsModel->insertObservation($observationsData)) {
                return $this->response->setStatusCode(401, 'Error al cargar las observaciones');
            }

        } 
        
        return json_encode($save);
    
    }
    
}
