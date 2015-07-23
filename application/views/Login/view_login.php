<?php
        $url=site_url();        
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consulta Facturación Eléctronica</title>
    <!-- Bootstrap -->
    <link href="<?=$url?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$url?>css/styles.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <div class="container">
       <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <!--<h1 class="text-center login-title">Sign in to continue to Bootsnipp</h1>-->
                <div class="account-wall">
                    <img src="http://www.tractomaq.com/images/content/logo_tractomaq.jpg" style="height: 96px; margin-top: -38px;  margin-bottom: 39px;">                    <?php $attributes = array('class' => 'form-signin', 'id' => 'login');?>
                    <?php echo validation_errors(); ?>
                    <?php echo form_open('login',$attributes); ?>

                    <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" required autofocus>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">
                        Iniciar Sesión</button>                    
                    <a href="#" class="pull-right need-help">¿Necesitas ayuda? </a><span class="clearfix"></span>
                    </form>
                </div>
                <a href="#" id="recordar_password" class="text-center new-account">Recordar contraseña </a>
                
            </div>
        </div>
    </div>

    <?=$recordar?> 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?=$url?>js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?=$url?>js/bootstrap.min.js"></script>


    <script type="text/javascript">	
    $(document).ready(function(){
        $("#recordar_password").click(function (e){
           e.preventDefault();           
            $("#correo").val("");
            $('#RecordarPassword').modal('show');
        });       
    });

    $( "#correo" ).keypress(function( event ) {
      if ( event.which == 13 ) {
          event.preventDefault();
          RecordarPassword();
      }
      validate();
    });

        function RecordarPassword(){
            var base_url= window.location.href;  
            if(base_url.indexOf("login") == -1) {
              base_url+="/login"
            }
            var _correo=$("#correo").val();
            if(validate()){
               var request = $.ajax({
                async: false,
                url: base_url+"/recordar",
                data: ({ correo : _correo}),
                type:"POST",
                dataType:"html"
            });
               request.done(function( data ) {
                
                  var obj = $.parseJSON(data);
                  var mensaje=obj['text'];
                  $("#mensaje").html(mensaje);  
                  $("#RecordarPassword").modal('hide');
                  var ok=obj['status'];
                  if(ok=="TRUE"){
                    $("#img1").attr("src","img/success-64.png");
                  }else{
                    $("#img1").attr("src","img/error-64.png");
                  }
                  $('#RecordarNotificacion').modal('show');
                });
                 
                request.fail(function( jqXHR, textStatus ) {
                  alert( "Request failed: " + textStatus );
                }); 
            }
        }


        function validateEmail(email) { 
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
        function validate(){
          var email = $("#correo").val();          
          if (validateEmail(email)) {
            $("#correo").css("color", "green");
            return true;
          } else {
            $("#correo").css("color", "red");
          }
          return false;
        }
    </script>
  </body>
</html>