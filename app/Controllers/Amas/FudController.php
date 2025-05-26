<?php

namespace App\Controllers\Amas;

use App\Controllers\BaseController;
use App\Models\Amas\CasesModel;

class FudController extends BaseController
{

    protected $casesModel;
    public function __construct()
    {
        $this->casesModel = new CasesModel();
    }

    public function index()
    {
        return view('private/views_ajax/fud/consultarFudAjax', ['title' => 'Consulta FUD']);
    }    

    public function searchFud() 
    {
        $fudNumber = $this->request->getPost('FUD_number');    
        
        $infoFud = $this->FudRuvModel->getFudByNumber($fudNumber)->getResultArray();
        $infoAA = $this->FudSiravModel->getFudByNumber($fudNumber)->getResultArray();
        $infoConsecutive = $this->FudSiravModel->getConsecutivesByNumber($fudNumber)->getResultArray();
        $auditFud = $this->FudRuvModel->getFudAuditRuv($fudNumber)->getResultArray();
        $cases = $this->casesModel->listCaseDocument($fudNumber);

        return json_encode([
            "info" => $infoFud,
            "infoAA" => $infoAA,
            "infoConsecutive" => $infoConsecutive,
            "auditFud" => $auditFud,
            "cases" => $cases,
        ]);
        
        //return json_encode($auditFud) ;
    }
}
   
