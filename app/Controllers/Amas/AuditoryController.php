<?php

namespace App\Controllers\Amas;

use App\Controllers\BaseController;
use App\Entities\Amas\CasesEntity;
use CodeIgniter\HTTP\ResponseInterface;
//--- MODELS-----//
use App\Models\Amas\CasesModel;
use App\Models\Amas\ActionsModel;
use App\Models\Amas\AppsModel;
use App\Models\Amas\CategoriescaseModel;
use App\Models\Amas\DependenciesModel;
use App\Models\Amas\EntitiesModel;
use App\Models\Amas\GroupsModel;
use App\Models\Amas\ObservationsModel;
use App\Models\Amas\StatescasesModel;
use App\Models\Amas\TipescasesModel;

class AuditoryController extends BaseController
{
    protected $CasesModel;
    protected $ActionsModel;
    protected $AppsModel;
    protected $CategoriescaseModel;
    protected $DependenciesModel;
    protected $EntitiesModel;
    protected $GroupsModel;
    protected $ObservationsModel;
    protected $StatescasesModel;
    protected $TipescasesModel;

    protected $CasesEntity;

    public function __construct()
    {
        $this->CasesModel = new CasesModel();
        $this->ActionsModel = new ActionsModel();
        $this->AppsModel = new AppsModel();
        $this->CategoriescaseModel = new CategoriescaseModel();
        $this->DependenciesModel = new DependenciesModel();
        $this->EntitiesModel = new EntitiesModel();
        $this->GroupsModel = new GroupsModel();
        $this->ObservationsModel = new ObservationsModel();
        $this->StatescasesModel = new StatescasesModel();
        $this->TipescasesModel = new TipescasesModel();
        
        $this->CasesEntity = new CasesEntity();

    }

    /**
        * The index function returns a view for listing cases with the title "Mis casos".
        * 
        * @return A view named 'listMyCaseAjax' located in the 'private/views_ajax/Amas' directory is being
        * returned with the title 'Mis casos' passed as data.
    */
    public function index()
    {
        //

        return view('private/views_ajax/Amas/listMyCaseAjax', ['title' => 'Mis casos']);
    }

    /**
     * The function `listAllCaseView` returns a view for listing all case views with the title
     * "Auditoria casos".
     * 
     * @return A view named 'listAllCaseAjax' located in the 'private/views_ajax/Amas' directory is
     * being returned with the title 'Auditoria casos' passed as data.
    */
    public function listAllCaseView()
    {
        return view('private/views_ajax/Amas/listAllCaseAjax', ['title' => 'Auditoria casos']);
    }

    /**
        * The function `getCaseFormData` returns an array of data from various models related to different
        * categories of cases.
        * 
        * @return An array is being returned with data from various models such as CategoriescaseModel,
        * DependenciesModel, EntitiesModel, GroupsModel, StatescasesModel, TipescasesModel, and AppsModel.
        * Each model provides a list of specific data related to categories, dependencies, entities,
        * groups, states, types, and apps.
    **/
    private function getCaseFormData()
    {
        return [
            'categoriescase' => $this->CategoriescaseModel->listCategoriecase(),
            'dependencies'   => $this->DependenciesModel->listDependencies(),
            'entities'       => $this->EntitiesModel->listEntities(),
            'groups'         => $this->GroupsModel->listGroups(),
            'statescases'    => $this->StatescasesModel->listStatescases(),
            'tipescases'     => $this->TipescasesModel->listTipescases(),
            'apps'           => $this->AppsModel->listApps(),
        ];
    }


    
    /**
     * The function `listMyCaseView` retrieves case form data and sets the title before returning a
     * view for displaying the user's cases.
     * 
     * @return A view named 'listMyCaseAjax' located in the 'private/views_ajax/Amas' directory with
     * the data retrieved from the 'getCaseFormData' method. The view will have a title set to 'Mis
     * casos'.
     */
    public function listMyCaseView()
    {
        $data = $this->getCaseFormData();
        $data['title'] = 'Mis casos';
    
        return view('private/views_ajax/Amas/listMyCaseAjax', $data);
    }
    
    /**
     * The function `updateCaseView` retrieves case data and displays it for editing in a view.
     * 
     * @param CASE_PK The `CASE_PK` parameter in the `updateCaseView` function is likely an identifier
     * for a specific case in a system or database. It is used to retrieve information about a
     * particular case that needs to be updated. This parameter is passed to the function to fetch the
     * relevant case data and then prepare
     * 
     * @return The `updateCaseView` function is returning a view called `updateCaseAjax` located in the
     * `private/views_ajax/Amas` directory. The view is being passed the `` array, which includes
     * the title "Editar caso No. " followed by the `CASE_number` from the `` object, as well as
     * the `` object itself.
     */
    public function updateCaseView($CASE_PK)
    {
        $data = $this->getCaseFormData();
        $case = $this->CasesModel->listCasePk($CASE_PK);
    
        $data['title'] = 'Editar caso No. ' . $case->CASE_number;
        $data['case'] = $case;
    
        return view('private/views_ajax/Amas/updateCaseAjax', $data);
    }
/**
 * The function `updateCase` updates a case with data provided through POST requests and returns an
 * error message if the update fails.
 * 
 * @return If the `` is falsy (evaluates to false), the function will return a response with a
 * status code of 401 and a message indicating an error occurred while updating the case.
 */

    public function updateCase()
    {

        $this->CasesEntity->fill([
                'CASE_PK'                => $this->request->getPost('CASE_PK'),
                'CASE_FK_agent'          => $this->session->get('USER_PK'),
                'CASE_number'            => $this->request->getPost('CASE_number') ?? 'Correo',
                'CASE_date_reception'    => $this->request->getPost('CASE_date_reception'),
                'CASE_date_solution'     => $this->request->getPost('CASE_date_solution'),
                'CASE_FK_app'            => $this->request->getPost('CASE_FK_app'),
                'CASE_FK_case_categorie' => $this->request->getPost('CASE_FK_case_categorie'),
                'CASE_FK_entities'       => $this->request->getPost('CASE_FK_entities'),
                'CASE_FK_dependence'     => $this->request->getPost('CASE_FK_dependence'),
                'CASE_FK_state_case'     => $this->request->getPost('CASE_FK_state_case'),
                'CASE_FK_tipe_case'      => $this->request->getPost('CASE_FK_tipe_case'),
            ]
        );
       
        if (!$this->CasesModel->updateCase($this->CasesEntity)) {
            return $this->response->setStatusCode(401, 'Error al actualizar el caso');
        }
    }
    
   /**
    * The `listMyCase` function retrieves case data based on the user's ID and returns it in a JSON
    * format for use in a table display.
    */
    public function listMyCase()
    {
        
        $draw   = intval($this->request->getPost("draw"));                      //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
        $data = $this->CasesModel->listCaseID($this->session->get('USER_PK'));  //utiliza el metodo listar() del modelo plan() para traer los datos de todos los planes 
        $output = array(                                                        //creacion del vector de salida
            "draw" => $draw,                                                    //envio la variable de dibujo de la tabla                    
            "recordsTotal" => $data->getNumRows(),                              //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->getNumRows(),                           //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->getResultArray()                                   //envia todos los datos de la tabla
        );
        echo json_encode($output);                                              //envio del vector de salida con los parametros correspondientes
        exit;
    }

   /**
    * The `listAllCase` function retrieves data from a CasesModel and outputs it in JSON format for use
    * in creating a table.
    */
    public function listAllCase()
    {
        
        $draw   = intval($this->request->getPost("draw"));  //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
        $data = $this->CasesModel->listCases();             //utiliza el metodo listar() del modelo plan() para traer los datos de todos los planes 
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" => $data->getNumRows(),          //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->getNumRows(),       //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->getResultArray()               //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;
    }


    /**
     * The function `createCases` in PHP creates a new case with associated actions and observations if
     * provided, and returns appropriate status codes based on success or failure.
     */
    public function createMyCases()
    {
        $caseData = $this->CasesEntity->fill([ 
            'CASE_FK_agent'          => $this->session->get('USER_PK'),
            'CASE_number'            => $this->request->getPost('CASE_number') ?? 'Correo',
            'CASE_date_reception'    => $this->request->getPost('CASE_date_reception'),
            'CASE_date_solution'     => $this->request->getPost('CASE_date_solution'),
            'CASE_FK_app'            => $this->request->getPost('CASE_FK_app'),
            'CASE_FK_case_categorie' => $this->request->getPost('CASE_FK_case_categorie'),
            'CASE_FK_entities'       => $this->request->getPost('CASE_FK_entities'),
            'CASE_FK_dependence'     => $this->request->getPost('CASE_FK_dependence'),
            'CASE_FK_state_case'     => $this->request->getPost('CASE_FK_state_case'),
            'CASE_FK_tipe_case'      => $this->request->getPost('CASE_FK_tipe_case'),
        ]);
    
        $idCase = $this->CasesModel->insertCase($this->CasesEntity);
    
        if (!$idCase) {
            return $this->response->setStatusCode(401, 'Error al crear el caso');
        }
    
        $formActions = $this->request->getPost('form_actions');
        if ($formActions) {
            $actions = array_filter(array_map('trim', explode(',', $formActions)));
            $actionsData = array_map(function ($action) use ($idCase, $caseData) {
                return [
                    'ACTN_FK_case'         => $idCase,
                    'ACTN_modified_record' => $action,
                    'ACTN_description'     => $caseData->CASE_FK_tipe_case ?? 'aranda',
                ];
            }, $actions);
    
            if (!$this->ActionsModel->insertActions($actionsData)) {
                return $this->response->setStatusCode(401, 'Error al cargar las acciones');
            }
        }
    
        $observation = $this->request->getPost('form_observations');
        if ($observation) {
            $observationsData = [[
                'OBSV_FK_case'     => $idCase,
                'OBSV_name'        => '',
                'OBSV_description' => $observation,
            ]];
    
            if (!$this->ObservationsModel->insertObservation($observationsData)) {
                return $this->response->setStatusCode(401, 'Error al cargar las observaciones');
            }
        }
    
        return $this->response->setStatusCode(201);
    }
    
}
