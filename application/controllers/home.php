<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('export');
        $this->load->model('DocumentoModel','Documento');  
        $this->load->model('UsuarioModel','Usuario');                   
    }

	public function index()
	{
		if($this->common->isLogin()){
			$u=$this->Usuario->getById($this->session->userdata('id_usuario'));
			$data['usuario']=$u->nombre_completo;
			$page["header"]=$this->load->view($this->views->HEADER, $data ,true);//header
			$usuario['usuario']=$u->usuario;
			$usuario['nombre_completo']=$u->nombre_completo;
			$usuario['cedula']=$u->cedula;
			$usuario['fecha_creacion']=$u->fecha_creacion;
			$usuario['email']=$u->email;
			$usuario['telefono']=$u->telefono;
			$info["dialog"]=$this->load->view($this->views->INFORMACION, $usuario ,true);//informacion
			$info["dialog"].=$this->load->view($this->views->PASSWORD, null ,true);//password
			$info["dialog"].=$this->load->view($this->views->EXPIRO, null ,true);//expiro
			$page["footer"]=$this->load->view($this->views->FOOTER, $info,true);//footer
			$key=$u->cedula;
			if($u->is_admin==1){
				$key="administrador";
			}
			$vars["cfactura"]=$this->Documento->GetCantidadPorTipoDocumento($key,"01");
			$vars["cnotas_credito"]=$this->Documento->GetCantidadPorTipoDocumento($key,"04");
			$vars["cretenciones"]=$this->Documento->GetCantidadPorTipoDocumento($key,"07");
			$vars["cnota_debito"]=$this->Documento->GetCantidadPorTipoDocumento($key,"05");
			$vars["cguia_remision"]=$this->Documento->GetCantidadPorTipoDocumento($key,"06");
			$sub["options"]=$this->load->view($this->views->OPTIONS, $vars,true);//opciones
			$page["filters"]=$this->load->view($this->views->CONTAINER_FILTERS, null,true);//header

			if($key=="administrador"){
				$filtros['tipo_documento']='';
				$filtros['fecha_inicial']=date('Y-m-d', strtotime("-60 days"));
				$filtros['fecha_final']=date("Y-m-d");
			}else{
				$filtros['tipo_documento']='';
				$filtros['fecha_inicial']='';
				$filtros['fecha_final']='';
			}
			$tabla['documentos']=$this->Documento->GetDocumentoByClienteId($key,$filtros);			
			$tabla['is_admin']=$u->is_admin;
			$sub['container_header']=$this->load->view($this->views->CONTAINER_HEADER, null,true);//header
			$sub['container_body']=$this->load->view($this->views->CONTAINER_BODY, $tabla,true);//header			
			$page["container"]=$this->load->view($this->views->CONTAINER,$sub,true);//content
			$this->load->view($this->views->MAIN,$page);//Main	
		}
		else
		{
			$this->logout();
		}
	}

	public function filtrar(){
		$u=$this->Usuario->getById($this->session->userdata('id_usuario'));	
		$data['ajax_req'] = TRUE;
		
		$filters['tipo_documento']='';
		$filters['fecha_inicial']='';
		$filters['fecha_final']='';
		$msg="0";
		if (isset($_POST['tipo_documento']))
	    {
	    	$filters['tipo_documento']=$this->input->post("tipo_documento");    
	    	$msg="1";
	    }
	    if (isset($_POST['fecha_inicial']))
	    {
	       $filters['fecha_inicial']=$this->input->post("fecha_inicial"); 
	       $msg.="2";
	    }
	    if (isset($_POST['fecha_final']))
	    {
	       $filters['fecha_final']=$this->input->post("fecha_final"); 
	       $msg.="3";
	    }
	    	$key=$u->cedula;
			if($u->is_admin==1){
				$key="administrador";
			}
		$data['documentos']=$this->Documento->GetDocumentoByClienteId($key,$filters);
		$data['is_admin']=$u->is_admin;
		$this->load->view($this->views->CONTAINER_BODY,$data);//content
	}

	public function logout(){
		$this->common->logout();
		redirect('/login/','refresh');
	}

	public function export_to_excel(){
		$u=$this->Usuario->getById($this->session->userdata('id_usuario'));	
		if($u!==null){
			$sql=$this->Documento->ReporteByClienteId($u);
			$this->export->to_excel($sql, 'ComprobantesElectronicos');	
		}	
	}
	/*
	  [DEBUG]
	  echo '<script language="javascript">';
      echo 'alert("'.$msg.'");';
      echo '</script>';*/
	
}