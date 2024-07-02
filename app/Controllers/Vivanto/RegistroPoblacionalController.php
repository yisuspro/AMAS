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
    public function __construct()
    {
        $this->RegistroPoblacionalModel = new RegistroPoblacionalModel();
    }
    public function index()
    {

        //echo json_encode($this->RegistroPoblacionalModel->updateStateCenso(242));
    }
    public function loadingFileCensoView()
    {
        return view('private/views_ajax/Vivanto/loadingFileCensoAjax', ['title' => 'Cargar censo']);
    }

    public function loadingFileCensoUbicaView()
    {
        return view('private/views_ajax/Vivanto/loadingFileCensoUbicaView', ['title' => 'Cargar ubicacion censo']);
    }


    public function loadingFileCenso()
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
                    'P_CS_ID' => Null, // Ejemplo del parámetro de salida ID del censo
                    'P_TRANS' => Null, // Ejemplo del parámetro de salida de transacción
                    'P_MENSAJE' => Null // Ejemplo del parámetro de salida de mensaje
                ];
                
                $result = $this->RegistroPoblacionalModel->insertarCensoPoblacional($params);
                $params['P_CS_ID'] =  $result['CS_ID'];
                $updateCenso = $this->RegistroPoblacionalModel->updateStateCenso($result['CS_ID']);
                $allParams[] = $params;
             }
                echo json_encode($allParams);
        }
    }

    public function loadingFileCensoUbica()
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
                    'P_CSU_ID' => '0'
                ];
                if($result = $this->RegistroPoblacionalModel->insertarUbicaCensoPoblacional($params)){
                    $params['P_CSU_ID'] =  $result['CSU_ID'];
                    $allParams[] = $params;
                
                }
                
                //echo json_encode($params);
             }
                echo json_encode($allParams);
        }

    }
}
