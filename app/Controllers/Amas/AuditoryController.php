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
    protected $CaseModel;
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
        $this->CaseModel = new CasesModel();
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
        $data = $this->CaseModel->listCaseID($this->session->get('USER_PK'));           //utiliza el metodo listar() del modelo plan() para traer los datos de todos los planes 
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" => $data->getNumRows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->getNumRows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->getResultArray()                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;
        $data = $this->CaseModel->listCaseID();
    }
}
