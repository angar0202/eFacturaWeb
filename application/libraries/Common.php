<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Common {
	var $CI;

	function Common()
    {
        $CI =& get_instance();
        $CI->load->model('Usuariomodel','Usuario');        
        $CI->load->library('session');
    }

    public function Logout(){
    	$CI =& get_instance();
        $CI->load->library('session');
		$CI->session->sess_destroy();
	}

	public function isLogin(){
		$CI =& get_instance();
		$logged_in = $CI->session->userdata('logged_in');
		if($logged_in) {
		    return true;
		}
		return false; 
	}

	public function GenerarCodigo($length=48){
	$letras = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
	$codigo="";
		for ($i=0; $i < $length ; $i++) { 
				$tipo=mt_rand(1,3);
				$id=mt_rand(0,23); 
				if($tipo==1){
					$codigo.=$letras[$id];
				}else if($tipo==2){
					$codigo.=mt_rand(0,9);
				}else {
					$codigo.=strtoupper($letras[$id]);
				}
		}
		return $codigo;
	}	

	public function EnviarCorreo($to,$subject,$body){
			/**
			Configuracion de Correo para envio de enlace de cambio contraseña.
			*/
			$config['protocol']    = 'smtp';
		    $config['smtp_host']    = 'ssl://smtp.googlemail.com';
		    $config['smtp_port']    = '465';
		    $config['smtp_timeout'] = '7';
		    $config['smtp_user']    = 'mail.factura.2014@gmail.com';
		    $config['smtp_pass']    = 'factura2014';
		    $config['charset']    = 'utf8';
		    $config['newline']    = "\r\n";
		    $config['mailtype'] = 'html'; // or html
		    $config['validation'] = TRUE; // bool whether to validate email or not 
		    $CI =& get_instance();
			$CI->load->library('email', $config);	
		    $CI->email->from('mail.facturacion@einvoice.com', 'efactura@tractomaq.com');
		    $CI->email->to($to);
		    $CI->email->subject($subject);
		    $CI->email->message($body);
		    $CI->email->send();
		    return $CI->email->print_debugger();
	}

	public function PlantillaCambioPassword($cliente,$password)
	{		
			$CI =& get_instance();
			$CI->load->model('ConfiguracionModel');
		    $mensaje = $CI->ConfiguracionModel->getter("MensajeAEnviarCambio");
            $mensaje = str_replace("#TITULO#", $CI->ConfiguracionModel->getter("PruebaTituloCambio"),$mensaje);
            $mensaje = str_replace("#CONTENIDO#", $CI->ConfiguracionModel->getter("PruebaDescripcionCambio"),$mensaje);
            $mensaje = str_replace("#INFO_EMPRESA#", $CI->ConfiguracionModel->getter("PruebaInfoEmpresaCambio"),$mensaje);
            $mensaje = str_replace("#DIRECCION#", $CI->ConfiguracionModel->getter("PruebaDireccionCambio"),$mensaje);
            $mensaje = str_replace("#FECHA_HORA#", "",$mensaje);
            $mensaje = str_replace("#CLIENTE#", $cliente,$mensaje);
            $mensaje = str_replace("#PASSWORD#", $password,$mensaje);			
            return $mensaje;
	}
	public function PlantillaConfirmacionPassword($cliente,$url){
			$CI =& get_instance();
			$CI->load->model('ConfiguracionModel','Config',TRUE);
			$mensaje = $CI->ConfiguracionModel->getter("MensajeAEnviarCambio");
            $mensaje = str_replace("#TITULO#", $CI->ConfiguracionModel->getter("PruebaTituloCambio"),$mensaje);
            $mensaje = str_replace("#CONTENIDO#", $CI->ConfiguracionModel->getter("PruebaDescripcionCambioConfirmacion"),$mensaje);
            $mensaje = str_replace("#INFO_EMPRESA#", $CI->ConfiguracionModel->getter("PruebaInfoEmpresaCambio"),$mensaje);
            $mensaje = str_replace("#DIRECCION#", $CI->ConfiguracionModel->getter("PruebaDireccionCambio"),$mensaje);
            $mensaje = str_replace("#FECHA_HORA#", "",$mensaje);
            $mensaje = str_replace("#CLIENTE#", $cliente,$mensaje);
            $mensaje = str_replace("#URL#", $url,$mensaje);			
            return $mensaje;
	}


}