<div class="modal fade" id="frmInfoUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Información de Usuario</h3>
                </div>
                <div class="modal-body">
                    <div class="media">
                      <a class="pull-left" href="#">
                        <img class="dashboard-avatar" alt="Usman" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"></a>
                      </a>
                      <div class="media-body">
                        <h4 class="media-heading"><?=$nombre_completo?></h4>
                        <p>
                            <strong>Cédula/R.U.C:</strong> <?=$cedula?><br>
                            <strong>Usuario:</strong> <?=$usuario?><br>
                            <strong>E-mail:</strong> <?=$email?><br>
                            <strong>Teléfono:</strong> <?=$telefono?><br>
                            <strong>Fecha de Registro:</strong> <span class="label-success label label-default"> <?=$fecha_creacion?></span>
                        </p>
                      </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>
                </div>
            </div>
        </div>
    </div>