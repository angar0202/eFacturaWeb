<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Views {

	/*MAIN*/
	public $MAIN='Main/main';
	public $HEADER='Main/header';
	public $FOOTER='Main/footer';
	public $CONTAINER='Main/container';
	public $OPTIONS='Main/options';
	public $CONTAINER_FILTERS='Main/filters';
	public $CONTAINER_HEADER='Main/containerHeader';
	public $CONTAINER_BODY='Main/containerBody';
	
	/*LOGIN*/
	public $LOGIN='Login/view_login';
	public $RECORDAR_NOTIFICACION='Login/recordar_notificacion';
	public $RECORDAR_PASSWORD='Login/recordar_password';

	/*REPORTS*/
	public $REPORTS='Reports/pdfreport';
	public $FACTURA='Reports/factura';

	/*USUARIO*/
	public $PERFIL='Usuario/perfil';	
	public $INFORMACION='Usuario/informacion';
	public $PASSWORD='Usuario/password';
	public $EXPIRO='Usuario/expiro';
}