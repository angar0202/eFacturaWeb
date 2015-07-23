<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class TipoDocumentoModel extends CI_Model {
    var $CODIGO;
    var $NOMBRE;
    var $_table="tipo_documento";

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();        
    }
    
    function GetById($id){
        $tipo= new TipoDocumentoModel();
        $result = $this->db->query("SELECT * FROM $this->_table WHERE CODIGO='$id'");
        $r=$result->row();
        $tipo->CODIGO=$r->CODIGO;
        $tipo->NOMBRE=$r->NOMBRE;
        return $tipo;
    }

}
