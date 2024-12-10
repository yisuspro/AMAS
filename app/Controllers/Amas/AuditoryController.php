<?php

namespace App\Controllers\Amas;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuditoryController extends BaseController
{

    public function __construct()
    {
       // $this->PermissionsModel = new PermissionsModel();
    }

    public function index()
    {
        //

        return view('private/views_ajax/Amas/listMyCaseAjax', ['title' => 'Mis casos']);
    }

    public function listMyCase()
    {
        //

        return view('private/views_ajax/Amas/listMyCaseAjax', ['title' => 'Mis casos']);
    }
}
