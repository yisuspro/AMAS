<?php

namespace App\Controllers\Sipod;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UsersSipodController extends BaseController
{
    

    public function __construct()
    {
    }


    public function index()
    {
        //
    }

    /**
     * The function `listUser` retrieves user data based on a specified type and parameter, then prepares
     * and sends a JSON response with the data.
     * 
     * @param tipo The `tipo` parameter in the `listUser` function is used to determine which method to
     * call based on its value. If `tipo` is equal to 0, the `listUsersDoc` method from the
     * `UsersSipodModel` model is called with the parameter `
     * @param parametro The `parametro` parameter in the `listUser` function is used to determine the
     * specific parameter value based on which the user list will be filtered. Depending on the value of
     * ``, either the `listUsersDoc` method or the `listUsersName` method from the `UsersS
     */
    public function listUser($tipo, $parametro)
    {
        // Retrieve the common parameters
        $draw = intval($this->request->getPost("draw"));
        
        // Select the appropriate method based on $tipo
        $data = ($tipo == 0) 
            ? $this->UsersSipodModel->listUsersDoc($parametro)
            : $this->UsersSipodModel->listUsersName($parametro);
    
        // Prepare and send the response
        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => $data->getNumRows(),
            "recordsFiltered" => $data->getNumRows(),
            "data" => $data->getResultArray()
        ]);
        exit;
    }
    
}
