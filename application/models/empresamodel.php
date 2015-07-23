<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class EmpresaModel extends CI_Model {
    var $RAZON_SOCIAL;
    var $RAZON_COMERCIAL;
    var $RUC;
    var $DIRECCION;
    var $ESTABLECIMIENTO;
    var $PTOEMISION;
    var $CODIGO;

    var $_table="info_empresa";

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();        
    }
    
    function GetById($id){
        $empresa= new EmpresaModel();
        $result = $this->db->query("SELECT * FROM $this->_table WHERE CODIGO='$id'");
        $r=$result->row();
        if($r!=null){
            $empresa->RAZON_SOCIAL=$r->razonSocial;
            $empresa->RAZON_COMERCIAL=$r->razonComercial;
            $empresa->RUC=$r->ruc;
            $empresa->DIRECCION=$r->direccion;
            $empresa->ESTABLECIMIENTO=$r->establecimiento;
            $empresa->PTOEMISION=$r->ptoEmision;
            $empresa->CODIGO=$r->codigo;    
        }
        return $empresa;
    }

}
