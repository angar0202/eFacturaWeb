<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class DetalleDocumentoModel extends CI_Model {
    
    var $SECUENCIA_CAB;
    var $SECUENCIA; 
    var $CODIGO_ITEM; 
    var $DESCRIPCION_ITEM; 
    var $CANTIDAD; 
    var $PRECIO; 
    var $DESCUENTO; 
    var $BASE_IMP_IVA; 
    var $BASE_IMP_ICE; 
    var $VALOR_IVA; 
    var $VALOR_ICE; 
    var $BASE_SIN_IVA;

    var $_table="det_documento";

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function GetDetalleDocumento($count=10)
    {
        
        if ($count==-1){
        $query = $this->db->get($_table);    
        }else{
        $query = $this->db->get($_table, $count);
        }
        return $query->result();
    }

    function GetCount(){
        return $this->db->count_all($_table);
    }
    
    function GetByIdCabecera($id){
        $query = $this->db->query("SELECT * FROM $this->_table WHERE SECUENCIA_CAB=$id");        
        return $query->result();
    }

    function GetTotal($id){
        $query = $this->db->query("SELECT SUM(BASE_IMP_IVA)+SUM(VALOR_IVA)-SUM(DESCUENTO) AS TOTAL FROM $this->_table WHERE SECUENCIA_CAB=$id GROUP BY SECUENCIA_CAB");        
        $row = $query->row();
        if($row!=null){
        return $row->TOTAL;    
        }
        return 0;
    }

}
