<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('DocumentoModel','Documento');  
        $this->load->model('UsuarioModel','Usuario');                      
    }

	public function index()
	{
		if ($this->common->isLogin())
		{
				$u=$this->Usuario->getById($this->session->userdata('id_usuario'));
				$data['usuario']=$u->nombre_completo;
				$page["header"]=$this->load->view($this->views->HEADER, $data ,true);//header
				
				$usuario['usuario']=$u->usuario;
				$usuario['nombre_completo']=$u->nombre_completo;
				$usuario['cedula']=$u->cedula;
				$usuario['fecha_creacion']=$u->fecha_creacion;
				$usuario['email']=$u->email;
				$usuario['telefono']=$u->telefono;


				$info["dialog"]=$this->load->view($this->views->INFORMACION, $usuario ,true);//header
				$info["dialog"].=$this->load->view($this->views->PASSWORD, null ,true);//header
				$info["dialog"].=$this->load->view($this->views->EXPIRO, null ,true);//header
				$page["footer"]=$this->load->view($this->views->FOOTER, $info,true);//footer

				$vars["cfactura"]=$this->Documento->GetCantidadPorTipoDocumento($u->cedula,"01");
				$vars["cnotas_credito"]=$this->Documento->GetCantidadPorTipoDocumento($u->cedula,"04");
				$vars["cretenciones"]=$this->Documento->GetCantidadPorTipoDocumento($u->cedula,"07");
				$vars["cnota_debito"]=$this->Documento->GetCantidadPorTipoDocumento($u->cedula,"05");
				$vars["cguia_remision"]=$this->Documento->GetCantidadPorTipoDocumento($u->cedula,"06");
				$sub["options"]=$this->load->view($this->views->OPTIONS, $vars,true);//opciones

				$page["filters"]="";

				$sub['container_header']="";
				$u=$this->Usuario->getById($this->session->userdata('id_usuario'));					
					$_user['id_usuario']=$u->id_usuario;		
					$_user['usuario']=$u->usuario;
			        $_user['nombrecompleto']=$u->nombre_completo;
			        $_user['email']=$u->email;
			        $_user['telefono']=$u->telefono;
			        $_user['cedula']=$u->cedula;			        
				$sub['container_body']=$this->load->view($this->views->PERFIL, $_user,true);//header 

				$page["container"]=$this->load->view($this->views->CONTAINER,$sub,true);//content
				$this->load->view($this->views->MAIN,$page);//Main	
		}else{
			$this->logout();
		}
	}

	public function guardar()
	{
		if ($this->common->isLogin())
		{
					$this->session->set_userdata('nombre_completo', $this->input->post('nombrecompleto'));
					$this->session->set_userdata('telefono', $this->input->post('telefono'));
					$this->session->set_userdata('cedula', $this->input->post('cedula'));
					$this->session->set_userdata('email', $this->input->post('email'));
					$this->Usuario->update_perfil();
					$status["status"]="TRUE";	
					$status["text"]="Se actualizo correctamente el Perfil del Usuario";	
					$status["layout"]="bottomRight";	
					$status["type"]="success";
					$status["animateOpen"]=array('opacity' => 'show');
					echo json_encode ($status);
		}
		else
		{
			$this->logout();
		}
	}

	public function logout(){
		$this->common->logout();
		redirect('/login/','refresh');
	}

	public function password(){
		if ($this->common->isLogin())
		{
			if(md5($this->input->post("current_password"))!=$this->session->userdata('password')){
				$status["status"]="FALSE";	
				$status["text"]="No coincide la contraseña actual";	
				$status["layout"]="bottomRight";	
				$status["type"]="error";
				$status["animateOpen"]=array('opacity' => 'show');
			}else{
				$status["status"]="TRUE";	
				$status["text"]="Se cambio la contraseña correctamente";	
				$status["layout"]="bottomRight";	
				$status["type"]="success";
				$status["animateOpen"]=array('opacity' => 'show');
				$this->Usuario->update_password($this->input->post("new_password"));
				$this->session->set_userdata('password', md5($this->input->post('new_password')));

			}
		echo json_encode ($status) ;
		}else{
			$this->logout();
		}
	}
	
	function islogin(){
       if($this->common->isLogin()){
             echo 1;
       }else{
             echo 0;
       }
 }

}