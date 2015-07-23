<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ArchivoDocumentoModel extends CI_Model {
    var $sec_cab_doc;
    var $tipo_doc;
    var $ruta_xml;
    var $ruta_autoriza;
    var $cliente; 
    var $num_autoriza;
    var $_table="documentos";

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();        
    }
    
    function GetById($id){
        $file= new ArchivoDocumentoModel();
        $result = $this->db->query("SELECT * FROM $this->_table WHERE sec_cab_doc=$id");
        foreach ($result->result() as $r)
        {
                $file->sec_cab_doc=$r->sec_cab_doc;
                $file->tipo_doc=$r->tipo_doc;
                $file->ruta_xml=$r->ruta_xml;
                $file->ruta_autoriza=$r->ruta_autoriza;
                $file->cliente=$r->cliente; 
                $file->num_autoriza=$r->num_autoriza;
        }
        return $file;
    }

}
