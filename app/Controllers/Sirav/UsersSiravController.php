<?php

namespace App\Controllers\Sirav;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Sirav\UsersSiravModel;

class UsersSiravController extends BaseController
{

    protected $UsersSiravModel;

    /**
     * The function creates a new instance of the UsersSiravModel class in PHP.
     */
    public function __construct()
    {
        $this->UsersSiravModel = new UsersSiravModel();
    }

    public function index()
    {
        
    }

    /**
     * The function `listUser` retrieves user data based on a specified type and parameter, and returns
     * the results in a JSON format.
     * 
     * @param tipo The `tipo` parameter in the `listUser` function is used to determine which method to
     * call based on its value. If `tipo` is equal to 0, the method `listUsersDoc()` from the
     * `UsersSiravModel` is called. Otherwise, if `
     * @param parametro The `parametro` parameter in the `listUser` function is used to determine the
     * specific parameter value based on the `` parameter. Depending on the value of ``,
     * either `listUsersDoc` or `listUsersName` method from the `UsersSiravModel` model is
     */
    public function listUser($tipo, $parametro)
    {
        // Retrieve the 'draw' parameter
        $draw = intval($this->request->getPost("draw"));
    
        // Determine the appropriate method based on $tipo
        $data = ($tipo == 0) 
            ? $this->UsersSiravModel->listUsersDoc($parametro)
            : $this->UsersSiravModel->listUsersName($parametro);
    
        // Prepare and send the JSON response
        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => $data->getNumRows(),
            "recordsFiltered" => $data->getNumRows(),
            "data" => $data->getResultArray()
        ]);
        exit;
    }
    
}
