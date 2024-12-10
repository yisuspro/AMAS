<?php

namespace App\Controllers\Amas;

use App\Controllers\BaseController;
use App\Models\Amas\PersonsModel;

class PersonsController extends BaseController
{

    protected $personsModel;

    public function __construct()
    {
        $this->personsModel = new PersonsModel();   
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

        
//        $file = $this->request->getFiles();

        //$file2 = $this->request->getFile('DCPR_name_2');

        /*if ($file && $file->isValid()) {
            $post['DCPR_name'] = $file->getRandomName();
        } elseif ($file) {
            $this->response->setStatusCode(401,'Error al cargar los archivos');
        }*/

        if ($this->personsModel->insertPersons($personData)) {

            $uploadPath = "";
            //if ($file && $file->isValid()) {
                $uploadPath = realpath(ROOTPATH . '../') . DIRECTORY_SEPARATOR;
                //$file->move($uploadPath, $file->getRandomName());
                //$this->response->setStatusCode(201);
            //}

            $this->response->setStatusCode(201,$uploadPath);



        } else {
            $this->response->setStatusCode(401,'Error al crear la persona');
        }
    }

}
