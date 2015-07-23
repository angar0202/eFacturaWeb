<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2 style="font-size:12px"><i class="glyphicon glyphicon-edit"></i> Perfil de Usuario</h2>
            </div>
            <div class="box-content" style="font-size:12px">
                <form id="Usuario" method="post">
                    <div class="form-group has-feedback" id="fgcedula">
                        <label for="cedula">Cedula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" value="<?=$cedula?>" placeholder="Ingrese Cedula">
                        <span style="visibility:hidden" id="icocedula" class="glyphicon glyphicon-ok form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" id="fgnombrecompleto">
                        <label for="nombrecompleto">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombrecompleto" name="nombrecompleto" value="<?=$nombrecompleto?>" placeholder="Ingrese Nombre Completo"/>
                        <span style="visibility:hidden" id="iconombrecompleto" class="glyphicon glyphicon-ok form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" id="fgemail">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?=$email?>" placeholder="Ingrese Email">
                        <span style="visibility:hidden" id="icoemail" class="glyphicon glyphicon-ok form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" id="fgtelefono">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?=$telefono?>" placeholder="Ingrese Telefono">
                        <span style="visibility:hidden" id="icotelefono" class="glyphicon glyphicon-ok form-control-feedback"></span>
                    </div>                    
                </form>
                <button type="submit" class="btn btn-primary" id="btnGuardarPerfil">Guardar Cambios</button>
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->