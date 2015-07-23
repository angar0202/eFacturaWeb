<div class="modal fade" id="frmCambiarPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Administrar Cuenta de Usuario</h3>
                </div>
                <div class="modal-body">
                    <div class="media">
                      <a class="pull-left" href="#">
                        <img class="dashboard-avatar" alt="Usman" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"></a>
                      </a>
                      <div class="media-body">
                        <h4 class="media-heading">Cambio de Contraseña</h4>
                        
                        <form id="frmPassword" method="post" role="form">

                    <div class="form-group has-feedback" id="fgCurrentPassword">
                        <label class="control-label" for="current_password">Contraseña Actual:</label>
                        <input type="password" class="form-control" id="current_password" placeholder="Ingrese su contraseña actual">
                        <span style="visibility:hidden" id="icoCurrentPassword" class="glyphicon glyphicon-ok form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" id="fgNewPassword">
                        <label class="control-label" for="new_password">Contraseña Nueva:</label>
                        <input type="password" class="form-control" id="new_password" placeholder="Ingrese su nueva contraseña">
                        <span style="visibility:hidden" id="icoNewPassword" class="glyphicon glyphicon-ok form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" id="fgConfirmPassword">
                        <label class="control-label" for="confirm_password">Confirmar Contraseña:</label>
                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirmar contraseña">
                        <span style="visibility:hidden" id="icoConfirmPassword" class="glyphicon glyphicon-ok form-control-feedback"></span>
                    </div>
                        </form>

                      </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                    <a href="#" class="btn btn-primary" id="btnGuardarPassword">Guardar Cambios</a>
                </div>
            </div>
        </div>
    </div>