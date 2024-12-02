<?php

namespace App\Controllers\Vivanto;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Vivanto\RegistroPoblacionalModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpParser\Node\NullableType;

class RegistroPoblacionalController extends BaseController
{
    protected $RegistroPoblacionalModel;
    /**
     * The function is a PHP constructor that initializes a new instance of the
     * RegistroPoblacionalModel class.
     */
    public function __construct()
    {
        $this->RegistroPoblacionalModel = new RegistroPoblacionalModel();
    }
    
    public function index()
    {
        //echo json_encode($this->RegistroPoblacionalModel->updateStateCenso(242));
    }
    
    /**
     * The function `loadingFileCensoView` returns a view for loading a file related to a census with
     * the title "Cargar censo".
     * 
     * @return A view named 'loadingFileCensoAjax' located in the 'private/views_ajax/Vivanto'
     * directory is being returned with the title 'Cargar censo'.
     */
    public function loadingFileCensoView()
    {
        return view('private/views_ajax/Vivanto/loadingFileCensoAjax', ['title' => 'Cargar censo']);
    }

    /**
     * The function `loadingFileCensoUbicaView` returns a view for loading a file related to census
     * location with a specified title.
     * 
     * @return A view named 'loadingFileCensoUbicaView' located in the 'private/views_ajax/Vivanto'
     * directory is being returned with the title 'Cargar ubicacion censo'.
     */
    public function loadingFileCensoUbicaView()
    {
        return view('private/views_ajax/Vivanto/loadingFileCensoUbicaAjax', ['title' => 'Cargar ubicacion censo']);
    }
    public function loadingFileCensoIntView()
    {
        return view('private/views_ajax/Vivanto/loadingFileCensoIntAjax', ['title' => 'Cargar integrantes censo']);
    }



    /**
     * The function `loadingFileCenso` processes an uploaded Excel file containing census data, inserts
     * the data into a database, updates the census state, and returns the processed data as a JSON
     * response.
     * 
     * @return The function `loadingFileCenso()` processes an uploaded Excel file containing census
     * data. It reads the file, extracts data, inserts it into a database, updates the census state,
     * and then returns the processed data as a JSON response.
     */
    public function loadingFileCenso()
    {
        // Get the uploaded file
        $file = $this->request->getFile('file');

        // Check if the file is valid
        if (!$file->isValid() || $file->hasMoved()) {
            return; // Exit early if the file is not valid or has moved
        }

        // Load the Excel file
        $filePath = $file->getTempName();
        $reader = new Xlsx();
        $spreadsheet = $reader->load($filePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        // Initialize an array to store all processed data
        $allParams = [];

        // Loop through the rows, skipping the header (first row)
        foreach (array_slice($data, 1) as $row) {
            $params = [
                'P_USUARIO' => $row[1],
                'P_F_CENSO' => $row[2],
                'P_ENT_ID' => $row[3],
                'P_PMT_TIPO_CENSO' => $row[4],
                'P_PMT_TIPO_POBLACION' => $row[5],
                'P_OTRA_POBLACION' => $row[6],
                'P_PMT_TIPO_DOC' => $row[7],
                'P_NUM_DOC' => $row[8],
                'P_NOM1' => $row[9],
                'P_NOM2' => $row[10],
                'P_APE1' => $row[11],
                'P_APE2' => $row[12],
                'P_CARGO_RELA' => $row[13],
                'P_MAIL' => $row[14],
                'P_MOVIL' => $row[15],
                'P_CS_ID' => null, // Placeholder for census ID
                'P_TRANS' => null, // Placeholder for transaction
                'P_MENSAJE' => null // Placeholder for message
            ];

            // Insert the census data and retrieve the generated ID
            $result = $this->RegistroPoblacionalModel->insertarCensoPoblacional($params);
            $params['P_CS_ID'] = $result['CS_ID'];

            // Update census state
            $this->RegistroPoblacionalModel->updateStateCenso($result['CS_ID']);

            // Add processed data to the result array
            $allParams[] = $params;
        }

        // Return the results as a JSON response
        echo json_encode($allParams);
    }


    /**
     * The function `loadingFileCensoUbica` reads an uploaded Excel file, processes the data, inserts
     * it into a database, and returns the processed data as JSON.
     * 
     * @return The function `loadingFileCensoUbica()` processes an uploaded Excel file containing
     * census data. It reads the file, extracts data, prepares parameters for database insertion,
     * inserts data into the database, and stores the processed data in an array. Finally, it returns
     * the processed data as a JSON response.
     */
    public function loadingFileCensoUbica()
    {
        // Get the uploaded file
        $file = $this->request->getFile('file');

        // Check if the file is valid and has not moved
        if (!$file->isValid() || $file->hasMoved()) {
            return; // Exit early if the file is not valid or has moved
        }

        // Load the Excel file
        $filePath = $file->getTempName();
        $reader = new Xlsx();
        $spreadsheet = $reader->load($filePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        // Initialize the array for storing processed data
        $allParams = [];

        // Loop through the rows, skipping the first row (header)
        foreach (array_slice($data, 1) as $row) {
            // Prepare parameters for database insertion
            $params = [
                'P_USUARIO' => $row[1],
                'P_CS_ID' => $row[2],
                'P_UBIC_ID' => $row[3],
                'P_PMT_ENTORNO' => $row[4],
                'P_PMT_ZONA1' => $row[5],
                'P_DESC_ZONA1' => $row[6],
                'P_PMT_ZONA2' => $row[7],
                'P_DESC_ZONA2' => $row[8],
                'P_DIRECCION' => $row[9],
                'P_PMT_GRUPO_ETNICO' => $row[10],
                'P_PMT_PUEBLO_ETNICO' => $row[11],
                'P_PMT_ORGAN_ETNICO' => $row[12],
                'P_PMT_TERRIT_ETNICO' => $row[13],
                'P_CABILDO' => $row[14],
                'P_PMT_RETORNO' => $row[15],
                'P_F_RETORNO' => $row[16],
                'P_CSU_ID' => '0' // Default value for CSU_ID
            ];

            // Insert data into the database and get the result
            if ($result = $this->RegistroPoblacionalModel->insertarUbicaCensoPoblacional($params)) {
                // Store the generated CSU_ID in the params
                $params['P_CSU_ID'] = $result['CSU_ID'];
                $allParams[] = $params;
            }
        }

        // Return the processed data as JSON
        echo json_encode($allParams);
    }

<<<<<<< Updated upstream
=======
    public function loadingFileCensoInt()
    {

       $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $filePath = $file->getTempName();
            // Leer el archivo Excel
            $reader = new Xlsx();
            $spreadsheet = $reader->load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();
            // Recorrer las filas del Excel (omitir la primera fila si es un encabezado)
            foreach ($data as $key => $row) {
                if ($key === 0) continue; // Omite la primera fila si es un encabezado
                $params = [
                    'P_USUARIO' => $row[1], // Asumiendo que la columna A tiene P_USUARIO
                    'P_CSU_ID' => $row[2],
                    'P_NOM1' => $row[3],
                    'P_NOM2' => $row[4],
                    'P_APE1' => $row[5],
                    'P_APE2' => $row[6],
                    'P_PMT_TIPO_DOC' => $row[7],
                    'P_NUM_DOC' => $row[8],
                    'P_PMT_RELACION' => $row[9],
                    'P_F_NACIMIENTO' => $row[10],
                    'P_PMT_SEXO' => $row[11],
                    'P_PMT_ORIENT_SEXUAL' => $row[12],
                    'P_PMT_IDENT_GENERO' => $row[13],
                    'P_PMT_GRUPO_ETNICO' => $row[14],
                    'P_PMT_PUEBLO_ETNICO' => $row[15],
                    'P_PMT_ORGAN_ETNICO' => $row[16],
                    'P_PMT_TERRIT_ETNICO' => $row[17],
                    'P_CABILDO' => $row[18],
                    'P_PMT_DISCAPACIDAD' => $row[19],
                    'P_PMT_ENF_RUINOSA' => $row[20],
                    'P_PMT_VIVE_EXTER' => $row[21],
                    'P_DIR_EXTERIOR' => $row[22],
                    'P_PADRE_CSI_ID' => $row[23],
                    'CSI_ID' => '0'
                ];
                if($result = $this->RegistroPoblacionalModel->insertarIntegrantesCensoPoblacional($params)){
                   // $params['CSI_ID'] =  $result['CSI_ID'];
                    $allParams[] = $params;
                
                }
                
                echo json_encode($result);
             }
               // echo json_encode($allParams);
        }

    }
>>>>>>> Stashed changes
}
