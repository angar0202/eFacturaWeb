<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	
	function Login()
    {
        parent::__construct();
        $this->load->model('UsuarioModel','Usuario');
        $this->load->model('ValidacionModel','Validacion');
    
    }
	
	public function index()
	{
		$this->load->helper('form','url'); 
		$this->load->library('form_validation');

		$this->form_validation->set_rules('usuario', 'Usuario', 'callback_username_check');
		$this->form_validation->set_rules('password', 'Password', 'required');		
		if ($this->form_validation->run() == TRUE || $this->common->isLogin())
		{
			redirect('home','refresh'); 
			
		}
		else
		{			
			$dialog["recordar"]=$this->load->view($this->views->RECORDAR_NOTIFICACION,null,true);
			$dialog["recordar"].=$this->load->view($this->views->RECORDAR_PASSWORD,null,true);
			$this->load->view($this->views->LOGIN,$dialog);
		}
	}

	public function username_check($str)
	{
		if ($this->Usuario->login($str,$this->input->post('password')))
		{
			$newdata = array(
				   'id_usuario' => $this->Usuario->id_usuario,
                   'username'  => $this->Usuario->usuario,
                   'password'  => $this->Usuario->password,
                   'fullname'  => $this->Usuario->nombre_completo,
                   'logged_in' => TRUE
               );
			$this->session->set_userdata($newdata);
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('username_check', 'Usuario o Contraseña incorrectos.');
			return FALSE;
		}
	}

	public function recordar(){

/**
1) Revisar si usuario existe
*/
    $usuario= $this->Usuario->GetUsuarioByUsername($this->input->post("correo"));
    if($usuario==""){
    	$usuario=$this->Usuario->GetUsuarioByEmail($this->input->post("correo"));
    }
    if($usuario!==""){
	    $debug=false;
		if(!$debug){
			$codigo=$this->common->GenerarCodigo();
			$this->Validacion->CrearRecordarPassword($usuario->id_usuario,$codigo);	
			$html="Ingrese al siguiente enlace para confirmar el reinicio de su contraseña:";
		    $html.= base_url()."validacion/password/".$codigo;
			$resultado=$this->common->EnviarCorreo($usuario->email,"Cambio de Contraseña",$html);
		}else{
			$resultado="Your message has been successfully sent";
		}
		$status["status"]="FALSE";
		if(strpos($resultado,"Your message has been successfully sent")!==false){
			$resultado="Se envio un correo electronico para continuar con el proceso de cambio de contraseña.";
			$status["status"]="TRUE";
		}	
		$status["text"]=$resultado;
		echo json_encode ($status);	
	}else{
		$status["status"]="FALSE";
		$status["text"]="El usuario no existe, ingrese correctamente el nombre de usuario.";
		echo json_encode ($status);	
	}
}

}

