$(document).ready(function () {
	$('#perfil').click(function (e) {
	        e.preventDefault();
	        $('#frmInfoUsuario').modal('show');
	});

	$('#password').click(function (e) {
	        e.preventDefault();
	        LimpiarFormulario();
	        $('#frmCambiarPassword').modal('show');
	});

	$( "#btnFiltros" ).click(function() {		
	  	$( "#FiltrosAvanzados" ).toggle( "slow" );
	});

	$('#btnFiltrarFechas').click(function () {
    var base_url=window.location.pathname;
    var FechaInicial = $("#dtpFechaInicial :input").val();
    var FechaFinal = $("#dtpFechaFinal :input").val();
    var TipoDocumento=$("#TipoDocumentoSeleccionado").text();
		    $.ajax({
		      url: base_url+"/filtrar",
		      async: false,
		      type: "POST",
		      data: ({ tipo_documento : TipoDocumento, fecha_inicial : FechaInicial, fecha_final: FechaFinal }),
		      dataType: "html",
		      success: function(data) {
		      	$('#documentos').html(data);	        
		      }
		    })
	});


	/*Validar Cambio de Contraseña*/
	$("#btnGuardarPassword").click(function() {
	var base_url= window.location.href;
	base_url=base_url.replace('home','usuario');
	var current_password=$("#current_password").val();
	var new_password=$("#new_password").val();
	var confirm_password=$("#confirm_password").val();
	var continuar=true;
	
	if(current_password==''){
		StyleCurrentPassword(true);
		continuar=false;
	}else{
		StyleCurrentPassword(false);
	}
	if(new_password==''){
		StyleNewPassword(true);
		continuar=false;
	}else{
		StyleNewPassword(false);
	}
	if(confirm_password==''){
		StyleConfirmPassword(true);
		continuar=false;
	}else{
		StyleConfirmPassword(false);
	}
	if(new_password!=confirm_password || new_password=='' || confirm_password==''){
		StyleConfirmPassword(true);		
		continuar=false;
	}else{
		StyleConfirmPassword(false);
	}
	
	if(continuar){
		$.ajax({
			      url: base_url+"/password",
			      async: false,
			      type: "POST",
			      data: ({ current_password : current_password, new_password : new_password, confirm_password: confirm_password }),
			      dataType: "html",
			      success: function(data) {
			      	var obj = $.parseJSON(data);
			      	noty(obj);
			      	if(obj['status']=='TRUE'){
			      		$('#frmCambiarPassword').modal('hide');
			      	}
			      }
			    })
	}
	});

	$("#btnGuardarPerfil").click(function(e){
		var base_url= window.location.href;
		base_url=base_url.replace('home','usuario');
		//validaciones
		var continuar=true;
		var _cedula=$("#cedula").val();
		var _nombrecompleto=$("#nombrecompleto").val();
		var _email=$("#email").val();
		var _telefono=$("#telefono").val();
		var focus="";
		if(!ValidaCedula()){
			continuar=false;	
			focus="cedula";			
		}
		if(!ValidaNombreCompleto()){
			continuar=false;
			if(focus==''){
				focus="nombrecompleto";	
			}
		}
		if(continuar){
			$.ajax({
				url:base_url+"/guardar",
				async:false,
				type:"POST",
				data:({cedula:_cedula,nombrecompleto:_nombrecompleto,email:_email,telefono:_telefono}),
				dataType:"html",
				success: function(data){
					var obj = $.parseJSON(data);
			      	noty(obj);
			      	if(obj['status']=='TRUE'){
			      		base_url=base_url.replace('usuario','home');
			      		window.location.replace(base_url);
			      	}
				}
			});
		}else{

			$( "#"+focus).focus();
		}
	});

/*Sesion*/
var sesion=true;
setInterval(function () {
        var base_url= window.location.href;
		base_url=base_url.replace('home','usuario');
		$.ajax({
		type : 'POST',
		url  : base_url+"/islogin",
		dataType:"html",
		success : function(data){
		    if(data==1){
		       //session available
			   sesion=true; 
			   console.log("sesion iniciada");			       
		    }else{
		       // expired
		       console.log("sesion expirada");			       
		       if(sesion){
			       $('#ExpiroSesion').modal('show');
				   setInterval(function () {
				   		window.location.replace(base_url+'/logout');
					},10000);
			   	}		       
		       sesion=false;
		    }
		  } 
		});
    },5000);

/*Descargar documento como Excel*/
$("#Descargar").click(function(e){
	var base_url= window.location.href;
		base_url=base_url.replace('usuario','home');
		window.location=base_url+"/export_to_excel";
});

/*fin del document*/
});

function StyleTextBox(id,isError){
	if(isError){
		$("#fg"+id).addClass("has-error");
		$("#ico"+id).addClass("glyphicon-remove");
		$("#ico"+id).css('visibility','visible');  		
	}else{
		$("#fg"+id).removeClass("has-error");
		$("#ico"+id).removeClass("glyphicon-remove");
		$("#ico"+id).css('visibility','hidden');
	}
}

function ValidaCedula(){
	var cedula=$("#cedula").val();
	if(cedula==''){
		StyleTextBox("cedula",true);
		return false;
	}
	StyleTextBox("cedula",false);
	return true;
}

function ValidaNombreCompleto(){
	var cedula=$("#nombrecompleto").val();
	if(cedula==''){
		StyleTextBox("nombrecompleto",true);
		return false;
	}
		StyleTextBox("nombrecompleto",false);
	return true;
}

function StyleCurrentPassword(e){
if(e){
		$("#fgCurrentPassword").addClass("has-error");
		$("#icoCurrentPassword").addClass("glyphicon-remove");
    	$('#icoCurrentPassword').css('visibility','visible');  		
	}else{
		$("#fgCurrentPassword").removeClass("has-error");		
		$("#icoCurrentPassword").removeClass("glyphicon-remove");
		$('#icoCurrentPassword').css('visibility','hidden');
	}
}

function StyleNewPassword(e){
if(e){
		$("#fgNewPassword").addClass("has-error");
		$("#icoNewPassword").addClass("glyphicon-remove");
		$('#icoNewPassword').css('visibility','visible');  		
	}else{
		$("#fgNewPassword").removeClass("has-error");
		$("#icoNewPassword").removeClass("glyphicon-remove");
		$('#icoNewPassword').css('visibility','hidden');
	}
}

function StyleConfirmPassword(e){
if(e){
		$("#fgConfirmPassword").addClass("has-error");
		$("#icoConfirmPassword").addClass("glyphicon-remove");
		$('#icoConfirmPassword').css('visibility','visible');
	}else{
		$("#fgConfirmPassword").removeClass("has-error");
		$("#icoConfirmPassword").removeClass("glyphicon-remove");
		$('#icoConfirmPassword').css('visibility','hidden');
	}
}

function LimpiarFormulario(){
	StyleConfirmPassword(false);
	StyleNewPassword(false);
	StyleCurrentPassword(false);
	$("#current_password").val("");
	$("#new_password").val("");
	$("#confirm_password").val("");
}