<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ValidacionModel extends CI_Model {
    var $id_validacion;
    var $id_usuario;
    var $fecha_creacion;
    var $codigo_secreto;
    var $tipo;
    var $fecha_modificacion;
    var $estado;
    var $valores;
    var $_table="validacion";

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();        
        $this->load->model('UsuarioModel','Usuario');   
    }
    
    function GetById($id){
        $obj= new ValidacionModel();
        $result = $this->db->query("SELECT * FROM $this->_table WHERE id_validacion='$id'");
        $r=$result->row();
        
        $obj->id_validacion=$r->id_validacion;
        $obj->id_usuario=$r->id_usuario;
        $obj->fecha_creacion=$r->fecha_creacion;
        $obj->fecha_modificacion=$r->fecha_modificacion;
        $obj->codigo_secreto=$r->codigo_secreto;
        $obj->tipo=$r->tipo;
        $obj->estado=$r->estado;
        $obj->valores=$r->valores;
        
        return $obj;
    }

    function GetByCodigo($codigo){
        $obj= new ValidacionModel();
        $result = $this->db->query("SELECT * FROM $this->_table WHERE codigo_secreto='$codigo'");
        foreach ($result->result() as $r)
        {
        $obj->id_validacion=$r->id_validacion;
        $obj->id_usuario=$r->id_usuario;
        $obj->fecha_creacion=$r->fecha_creacion;
        $obj->fecha_modificacion=$r->fecha_modificacion;
        $obj->codigo_secreto=$r->codigo_secreto;
        $obj->tipo=$r->tipo;
        $obj->estado=$r->estado;
        $obj->valores=$r->valores;        
        return $obj;
        }
        return null;
    }

    function CrearActivacion($id_usuario,$codigo,$id_cliente,$tipo='ACTIVACION_CUENTA'){
        $data = array(
            'id_usuario' => $id_usuario ,            
            'fecha_modificacion' => date('Y-m-d H:i:s'),
            'codigo_secreto' => $codigo,
            'tipo' => $tipo,
            'valores' => $id_cliente,            
        );
        $this->db->insert($this->_table, $data);
    }

    function CrearRecordarPassword($id_usuario,$codigo,$tipo='RECORDAR_PASSWORD'){
        $data = array(
            'id_usuario' => $id_usuario ,            
            'fecha_modificacion' => date('Y-m-d H:i:s'),
            'codigo_secreto' => $codigo,
            'tipo' => $tipo,            
        );
        $this->db->insert($this->_table, $data);
    }

    function ActualizarRecordarPassword($codigo,$tipo='RECORDAR_PASSWORD')
    {
       $validacion= $this->GetByCodigo($codigo);
       if($validacion!==null){
            if($validacion->estado==1){
                $data = array(
                    'fecha_modificacion' =>  date('Y-m-d H:i:s'),
                    'estado' => 0,
                );
                $this->db->update($this->_table, $data, array('id_validacion' => $validacion->id_validacion));
                $u=$this->Usuario->GetById($validacion->id_usuario);
                return $u;
           }
       }
     return "-1";
    }

    function ActualizarActivacion($codigo,$tipo='ACTIVACION_CUENTA')
    {
       $validacion= $this->GetByCodigo($codigo);
       if($validacion->estado==1){
            $data = array(
                'fecha_modificacion' =>  date('Y-m-d H:i:s'),
                'estado' => 0,
            );
            $this->db->update($this->_table, $data, array('id_validacion' => $validacion->id_validacion));
       }
    }


}