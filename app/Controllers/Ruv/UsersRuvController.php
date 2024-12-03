<?php

namespace App\Controllers\Ruv;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Ruv\UsersRuvModel;

class UsersRuvController extends BaseController
{
    protected $UsersRuvModel;

    /**
     * The function creates a new instance of the UsersRuvModel class in PHP.
     */
    public function __construct()
    {
        $this->UsersRuvModel = new UsersRuvModel();
    }

    /**
     * The index function returns a view for listing users with a specified title.
     * 
     * @return A view named 'listUserAjax' located in the 'private/views_ajax/Ruv' directory is being
     * returned with the title 'Consulta usuarios apps'.
     */
    public function index()
    {
        return view('private/views_ajax/Ruv/listUserAjax', ['title' => 'Consulta usuarios apps']);
    }

    /**
     * The function `listUser` retrieves user data based on a specified type and parameter, then
     * prepares and returns a JSON response.
     * 
     * @param tipo The `tipo` parameter in the `listUser` function is used to determine the type of
     * search to be performed. If `tipo` is `0`, it indicates that the search should be based on a
     * document number (``), and if `tipo` is not `0`,
     * @param parametro The `parametro` parameter in the `listUser` function is used to determine the
     * specific parameter based on the value of ``. If `` is 0, then `parametro` is used to
     * list users by document number (`listUsersDoc` method is called). If `$
     */
    public function listUser($tipo, $parametro)
    {
      /*  // Retrieve the common parameters
        $draw = intval($this->request->getPost("draw"));
        $data = ($tipo == 0) 
            ? $this->UsersRuvModel->listUsersDoc($parametro)
            : $this->UsersRuvModel->listUsersName($parametro);
    
        // Prepare the response data
        $output = [
            "draw" => $draw,
            "recordsTotal" => $data->getNumRows(),
            "recordsFiltered" => $data->getNumRows(),
            "data" => $data->getResultArray()
        ];*/
        $output = $this->UsersRuvModel->listUsersDoc($parametro);
        // Return the JSON response
        //echo $output;
        echo json_encode($output);
        exit;
    }
    
}
