<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ConfiguracionModel extends CI_Model {
    var $ID;
    var $CLAVE;
    var $VALOR;
    var $_table="configuraciones";

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();        
    }
    
    function getter($clave){      
		$result = $this->db->query("SELECT * FROM $this->_table WHERE clave='$clave'");
        $r=$result->row();
        if($r!=null){
        return $r->valor;
        }
        return "";
    }

}