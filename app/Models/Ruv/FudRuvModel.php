<?php

namespace App\Models\Ruv;

use CodeIgniter\Model;
use Config\Database;

class FudRuvModel extends Model
{
    protected $table = 'TBDECLARACIONES';
    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'ENTREVISTAPREVIA',
        'EXPLICACIONALCANCE',
        'PARAM_TIPODESPLAZAMIENTO',
        'ID_MUNICIPIODECLARACION',
        'ID_DEPARTAMENTODECLARACION',
        'PARAM_ENTIDADATIENDE',
        'FECHADECLARACION',
        'ID_MUNICIPIOACTUAL',
        'ID_DEPARTAMENTOACTUAL',
        'PARAM_ENTORNOACTUAL',
        'PARAM_TIPOENTORNOACTUAL',
        'ID_POBLADOACTUAL',
        'CUALPOBLADOACTUAL',
        'FECHAARRIBO',
        'DIRECCIONCORRESPONDENCIA',
        'TELEFONOACTUAL',
        'PARAM_TIPOENTORNODESPLAZ',
        'PARAM_ENTORNODESPLAZ',
        'ID_DEPARTAMENTODESPLAZ',
        'ID_MUNICIPIODESPLAZ',
        'ID_POBLADODESPLAZ',
        'CUALPOBLADODESPLAZ',
        'ANHOSRESIDENCIA',
        'MESESRESIDENCIA',
        'FECHADESPLAZ',
        'PARAM_DECLAROANTERIORMENTE',
        'ID_MUNICIPIOANTERIOR',
        'ID_DEPARTAMENTOANTERIOR',
        'PARAM_ENTIDADATENDIO',
        'FECHADECLARACIONANTERIOR',
        'RAZONSITIO',
        'PARAM_DESEOHOGAR',
        'ID_MUNICIPIODESEADO',
        'ID_DEPARTAMENTODESEADO',
        'PARAM_ENTORNODESEADO',
        'FECHATERMINACION',
        'REALIZOJURAMENTO',
        'LEYODECLARACION',
        'DOCUMENTOSADICIONALES',
        'CUANTOSFOLIOS',
        'ORIENTACIONENMENDADURAS',
        'TIENEENMENDADURAS',
        'ID_USUARIO',
        'CODIGOANTIGUO',
        'PARAM_ESTADO',
        'FUNCIONARIO',
        'CARGO',
        'CAMPOPRUEBA',
        'ID_DETALLERADICACION',
        'ID_UTERRITORIAL',
        'PUNTAJE_HOGAR',
        'PARAM_PROCESO',
        'FECHAFINALIZACION',
        'FECHAREGISTRO',
        'PARAM_TIPOREPRESENTANTE',
        'CORREGIRDECLARACION',
        'QUECORRECCIONES',
        'TELEFONOGERESS',
        'OBSERVACIONES',
        'FECHA_PRIMERA_INCLUSION',
        'VECES_HOGAR_NO_INCLUIDO',
        'ID_DECLARACION_PADRE',
        'MENSAJE_CELULAR',
        'MENSAJE_CORREOE',
        'MENSAJE_FIJO',
        'OTRO',
        'CUANTOS_ANEXOS',
        'SABE_FIRMAR',
        'ID_ENCARGADO',
        'NUMEROFORMULARIO',
        'OTROHECHO',
        'IDENTIFICACIONFUNCIONARIO',
        'ID_PAISDECLARACION',
        'ID_USUARIO_ACTUAL',
        'ID_ENTIDADMUNICIPIODECLARACION',
        'USODATOSPERSONALES',
        'NUMEROSOPORTESOTROSDESC',
        'NUMEROSOPORTESOTROS',
    ];

    protected $useTimestamps = false;
    protected $DBGroup = 'bd_ruv';

    public function getFudByNumber($NUMBER)
    {
        
        $sql = "
        SELECT DISTINCT
            u2.ID ID_USUVAL,
            CONVERT(u2.NOMBRE, 'AL32UTF8') FUD_VALORADOR,
            u.ID ID_USUARIO,
            CONVERT(u.NOMBRE, 'AL32UTF8') FUD_USUARIO,
            DE.NUMEROFORMULARIO FUD_NUMBER,
            DE.ID ID_DECLARACION,
            DE.PARAM_ESTADO,
            CONVERT(p.NOMBRE, 'AL32UTF8') FUD_ESTADO,
            p.ID_TIPOPARAMETRO,
            DE.ID_USUARIO_ACTUAL,
            DE.FECHADECLARACION FUD_DATEDECLARACION,
            RA.FECHAREGISTRO FUD_DATEREGISTER
          FROM TBDECLARACIONES DE 
          LEFT JOIN TBPARAMETROS P on P.ID = DE.PARAM_ESTADO
          LEFT JOIN TBUSUARIOS U on U.ID = DE.ID_USUARIO_ACTUAL
          LEFT JOIN TBVALORACION V on V.ID_DECLARACION = DE.ID
          LEFT JOIN TBUSUARIOS U2 on U2.ID = V.ID_VALORADOR
          LEFT JOIN TBRADICACION RA on DE.ID=RA.ID_DECLARACION
          WHERE NUMEROFORMULARIO in ('".$NUMBER."')
        ";
        $query = $this->query($sql);
        return $query ?: false;
        
    }


    public function getFudAuditRuv($NUMBER) 
    {
        $sql = "
        select 
            d.numeroformulario,
            D.ID id_declaracion,
            dh.*, 
            CONVERT(u.nombre, 'AL32UTF8') RESPONSABLE,
            CONVERT(p.nombre , 'AL32UTF8') nombre
        from RUV.tbdeclaracion_historico dh
        LEFT join RUV.tbdeclaraciones d on d.id = dh.id_declaracion
        LEFT join RUV.tbparametros p on p.id = dh.param_estado
        LEFT join RUV.tbusuarios u on u.id = dh.id_usuario_responsable
        where d.numeroformulario in ('CH000484854') ORDER BY dh.fecha_asignacion
        ";
        //$sql = "select U.id,CONVERT(U.NOMBRE, 'AL32UTF8') AS NOMBRE from TBUSUARIOS U where U.IDENTIFICACION like '1022418865'";
        $query = $this->query($sql);
        return $query ?: false;
    }
}
