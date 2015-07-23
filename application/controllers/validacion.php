<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class validacion extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('ValidacionModel','Validacion');                    
        $this->load->model('UsuarioModel','Usuario');   
    }

	public function Index()
	{
		redirect('/login/','refresh');
	}

	public function Activar($codigo){
		if(!$this->common->isLogin()){
			$this->Validacion->ActualizarActivacion($codigo);
		}
	}

	public function password($codigo){
		if(!$this->common->isLogin()){
			$usuario=$this->Validacion->ActualizarRecordarPassword($codigo);
			if($usuario!=="-1"){
				$c=$this->common->GenerarCodigo(6);
				//$html="Su nueva contraseña es:".$c;
				$html=$this->common->PlantillaCambioPassword($usuario->nombre_completo,$c);
				$resultado=$this->common->EnviarCorreo($usuario->email,"Nueva Contraseña E-Envoice",$html);

				echo "Se ah enviado un correo con la nueva contraseña";	
				$this->Usuario->update_password($c,$usuario->id_usuario);
			}else{
				echo "Codigo no valido";
			}
		}else{
			echo "Ah iniciado sesion.";
		}
	}
}