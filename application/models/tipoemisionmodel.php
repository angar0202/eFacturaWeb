<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class TipoEmisionModel extends CI_Model {
    var $CODIGO;
    var $DESCRIPCION;
    var $_table="tipo_emision";

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();        
    }
    
    function GetById($id){
        $tipo= new TipoEmisionModel();
        $result = $this->db->query("SELECT * FROM $this->_table WHERE CODIGO='$id'");
        $r=$result->row();
        $tipo->CODIGO=$r->CODIGO;
        $tipo->DESCRIPCION=$r->DESCRIPCION;
        return $tipo;
    }

}
