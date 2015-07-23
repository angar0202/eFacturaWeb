<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuariomodel extends CI_Model {
    var $id_usuario   = '';
    var $usuario   = '';
    var $password = '';
    var $nombre_completo = '';
    var $is_admin = false;
    var $email='';
    var $telefono='';
    var $cedula='';
    var $fecha_creacion;
    var $id_cliente;
    
    var $CI;
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $CI =& get_instance();
        $CI->load->library('session');
    }
    
    function get_users($count=10)
    {
        $_table="usuario";
        if ($count==-1){
        $query = $this->db->get($_table);    
        }else{
        $query = $this->db->get($_table, $count);
        }
        return $query->result();
    }

    function get_count()
    {
        return $this->db->count_all('usuario');
    }

    function get_count_new_user()
    {
        $this->db->where("fecha_creacion >= ADDDATE(CURRENT_TIMESTAMP , -3 )");
        $this->db->from("usuario");
        return $this->db->count_all_results();
    }

    function insert_user()
    {
        $_table='usuario';

        $data = array(
            'usuario' => $this->input->post('usuario') ,
            'password' => $this->input->post('password') ,
            'nombre_completo' => $this->input->post('nombre_completo'),
            'is_admin' => $this->EBool($this->input->post('is_admin')),
            'telefono' => $this->input->post('telefono'),
            'email' => $this->EBool($this->input->post('email')),
            'cedula' => $this->$this->input->post('cedula'),
            'id_cliente' => $this->$this->input->post('id_cliente'),
        );

        $this->db->insert($_table, $data);
    }

    function EBool($value)
    {
        if ($value==null){return 0;}
        if($value=='' || $value==True || $value=='on'){return 1;}
        return 0;
    }

    function update_user()
    {
        $table='usuario';
        $data = array(
            'usuario' => $this->input->post('usuario') ,
            'password' => md5($this->input->post('password')) ,
            'nombre_completo' => $this->input->post('nombre_completo'),
            'is_admin' => $this->EBool($this->input->post('is_admin')),
            'email' => $this->input->post('email'),
            'cedula' =>  $this->input->post('cedula'),            
            'telefono' =>  $this->input->post('cedula'),
            'id_cliente' => $this->input->post('id_cliente'),
        );
        $this->db->update($table, $data, array('id_usuario' => $this->input->post('id_usuario')));
    }

    function update_perfil()
    {
        $table='usuario';       
        $CI =& get_instance();
        $id_usuario = $CI->session->userdata('id_usuario');
        $data = array(
            /*'usuario' => $this->input->post('usuario') ,*/
            'nombre_completo' => $this->input->post('nombrecompleto'),            
            'email' => $this->input->post('email'),
            'cedula' =>  $this->input->post('cedula'),            
            'telefono' =>  $this->input->post('telefono'),            
        );
        $this->db->update($table, $data, array('id_usuario' => $id_usuario));
    }

    function update_password($password,$id_usuario='')
    {
        $table='usuario';       
        
        $data = array(
            'password' => md5($password),            
        );
        if($id_usuario==""){
            $CI =& get_instance();
            $id_usuario = $CI->session->userdata('id_usuario');
        }
        $this->db->update($table, $data, array('id_usuario' => $id_usuario));
    }

    function delete_user()
    {
        $table='usuario';
        if ($this->input->post('id_usuario')!= null && $this->input->post('id_usuario')!=''){
            $this->db->delete($table,array('id_usuario' => $this->input->post('id_usuario')));    
            return true;
        }
        return true;
    }

    function login($user,$password)
    {
    $table='usuario';
    $sql="SELECT count(id_usuario) as cantidad FROM $table WHERE usuario='$user' and password=md5('$password')";
    $query = $this->db->query($sql);
    $row = $query->row();
        if ($row->cantidad>0){
            $result = $this->db->query("SELECT * FROM $table WHERE usuario='$user' and password='".md5($password)."'");
            $r=$result->row();
            $this->id_usuario=$r->id_usuario;
            $this->usuario=$r->usuario;
            $this->password=$r->password;
            $this->is_admin=$r->is_admin;
            $this->nombre_completo=$r->nombre_completo;
            $this->cedula=$r->cedula;
            $this->email=$r->email;        
            $this->telefono=$r->telefono;
            $this->id_cliente=$r->id_cliente;
            return true;
        }
    return false;
    }

    function GetById($id)
    {
        $query = $this->db->query("SELECT * FROM usuario WHERE id_usuario=$id");
        foreach ($query->result() as $r)
        {
           $this->id_usuario=$r->id_usuario;
                $this->usuario=$r->usuario;
                $this->password=$r->password;
                $this->is_admin=$r->is_admin;
                $this->nombre_completo=$r->nombre_completo;
                $this->telefono=$r->telefono;
                $this->email=$r->email;
                $this->cedula=$r->cedula;        
                $this->id_cliente=$r->id_cliente;
        }        
        return $r;
    }

    function GetUsuarioByUsername($username){
        $query = $this->db->query("SELECT * FROM usuario WHERE usuario='$username'");
        foreach ($query->result() as $r)
        {
                return $r;
        } 
        return "";  
    }
    function GetUsuarioByEmail($email){
        $query = $this->db->query("SELECT * FROM usuario WHERE email='$email'");
        foreach ($query->result() as $r)
        {
                return $r;
        } 
        return "";  
    }
    function IsAdmin($id_usuario){
        $query = $this->db->query("SELECT is_admin FROM usuario WHERE id_usuario='$id_usuario'");
        foreach ($query->result() as $r)
        {
                return $r;
        } 
        return "";  
    }
}
