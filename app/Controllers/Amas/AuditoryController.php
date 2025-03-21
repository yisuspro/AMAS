<?php

namespace App\Controllers\Amas;

use App\Controllers\BaseController;
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
        //

        return view('private/views_ajax/Amas/listAllCaseAjax', ['title' => 'Auditoria casos']);
    }

 /**
  * The function `listMyCaseView` retrieves various lists of categories, dependencies, entities,
  * groups, states, and types of cases for display in a view.
  * 
  * @return The `listMyCaseView` function is returning a view named
  * 'private/views_ajax/Amas/listMyCaseAjax' with the following data:
  */
 
    public function listMyCaseView()
    {
        
        $categoriescase = $this->CategoriescaseModel->listCategoriecase();
        $dependencies = $this->DependenciesModel->listDependencies();
        $entities =$this->EntitiesModel->listEntities();
        $groups = $this->GroupsModel->listGroups();
        $statescases =$this->StatescasesModel->listStatescases();
        $tipescases =$this->TipescasesModel->listTipescases();
        $apps = $this->AppsModel->listApps();

        return view('private/views_ajax/Amas/listMyCaseAjax', ['title' => 'Mis casos',
                                                                'categoriescase'=>$categoriescase,
                                                                'dependencies'=> $dependencies,
                                                                'entities'=>$entities,
                                                                'groups'=> $groups,
                                                                'statescases' => $statescases,
                                                                'tipescases'=> $tipescases,
                                                                'apps' => $apps
                                                            ]);
    }

    public function updateCaseView($CASE_PK)
    {
        //
        $categoriescase = $this->CategoriescaseModel->listCategoriecase();
        $dependencies = $this->DependenciesModel->listDependencies();
        $entities =$this->EntitiesModel->listEntities();
        $groups = $this->GroupsModel->listGroups();
        $statescases =$this->StatescasesModel->listStatescases();
        $tipescases =$this->TipescasesModel->listTipescases();
        $apps = $this->AppsModel->listApps();
        $case = $this->CasesModel->listCasePk($CASE_PK);
        return view('private/views_ajax/Amas/updateCaseAjax', ['title' => 'Editar caso No.'.$case->CASE_number,
                                                                'categoriescase'=>$categoriescase,
                                                                'dependencies'=> $dependencies,
                                                                'entities'=>$entities,
                                                                'groups'=> $groups,
                                                                'statescases' => $statescases,
                                                                'tipescases'=> $tipescases,
                                                                'apps' => $apps,
                                                                'case' => $case
                                                            ]);

        
    }

    
 /**
  * The function `listMyCase` returns a view for listing cases with the title "Mis casos".
  * 
  * @return A view named 'listMyCaseAjax' located in the 'private/views_ajax/Amas' directory is being
  * returned with the title 'Mis casos' passed as data.
  */
    public function listMyCase()
    {
        
        $draw   = intval($this->request->getPost("draw"));             //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
        $data = $this->CasesModel->listCaseID($this->session->get('USER_PK'));           //utiliza el metodo listar() del modelo plan() para traer los datos de todos los planes 
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" => $data->getNumRows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->getNumRows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->getResultArray()                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;
        
    }
    public function listAllCase()
    {
        
        $draw   = intval($this->request->getPost("draw"));             //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
        $data = $this->CasesModel->listCases();           //utiliza el metodo listar() del modelo plan() para traer los datos de todos los planes 
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" => $data->getNumRows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->getNumRows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->getResultArray()                                 //envia todos los datos de la tabla
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
        $caseData = [
            'CASE_FK_agent' => $this->session->get('USER_PK'),
            'CASE_number' => $this->request->getPost('CASE_number') ?? 'Correo' ,
            'CASE_date_reception' => $this->request->getPost('CASE_date_reception'),
            'CASE_date_solution' => $this->request->getPost('CASE_date_solution'),
            'CASE_FK_app' => $this->request->getPost('CASE_FK_app'),
            'CASE_FK_case_categorie' => $this->request->getPost('CASE_FK_case_categorie'),
            'CASE_FK_entities' => $this->request->getPost('CASE_FK_entities'),
            'CASE_FK_dependence' => $this->request->getPost('CASE_FK_dependence'),
            'CASE_FK_state_case' => $this->request->getPost('CASE_FK_state_case'),
            'CASE_FK_tipe_case' => $this->request->getPost('CASE_FK_tipe_case'),
        ];
        if ($idCase = $this->CasesModel->insertCase($caseData)) {
            if($this->request->getPost('form_actions')){
                $actionsArray = array_filter(array_map('trim', explode(',', $this->request->getPost('form_actions'))));
                foreach ($actionsArray as $habilactionArrayidad) {
                    $actionsData[] = [
                        'ACTN_FK_case' => $idCase,
                        'ACTN_modified_record' => $habilactionArrayidad,
                        'ACTN_description' => $this->request->getPost('CASE_FK_tipe_case')??'aranda',
                    ];
                }
                if($this->ActionsModel->insertActions($actionsData)){
                    $this->response->setStatusCode(201);
                }else{
                    $this->response->setStatusCode(401,'Error al cargar las acciones');
                }
            }
            if($this->request->getPost('form_observations')){
                $observationsData[] = [
                    'OBSV_FK_case' => $idCase,
                    'OBSV_name' =>'',
                    'OBSV_description' => $this->request->getPost('form_observations')
                ];
                if($this->ObservationsModel->insertObservation($observationsData)){
                    $this->response->setStatusCode(201);
                }else{
                    $this->response->setStatusCode(401,'Error al cargar las observaciones');
                }
            }
            $this->response->setStatusCode(201);
        } else {
            $this->response->setStatusCode(401,'Error al crear el caso');
        }
    }
}

