
        
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Administración</li>
                        <li><a href="<?=site_url()?>home"><i class="glyphicon glyphicon-th"></i><span> Inicio</span></a></li>
                        <li class="nav-header">Comprabantes</li>
                        <li><a href="#" class="facturas"><span class="badge"><?=$cfactura?></span> Facturas </a> </li>
                        <li><a href="#" class="notas_credito"><span class="badge"><?=$cnotas_credito?></span> Notas de Crédito</a></li>
                        <li><a href="#" class="retenciones"><span class="badge"><?=$cretenciones?></span> Retenciones</a></li>
                        <li><a href="#" class="nota_debito"><span class="badge"><?=$cnota_debito?></span> Notas de Débito</a></li>
                        <li><a href="#" class="guia_remision"><span class="badge"><?=$cguia_remision?></span> Guías de Remisión</a></li>
                        <li class="nav-header">Parametros</li>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-user"></i><span> Usuario</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="<?=site_url()?>usuario">Perfil</a></li>
                                <li><a data-toggle="modal" href="#form-content" id="password">Cambio de Clave</a></li>                                
                            </ul>
                        </li> 
                        <li><a href="#" class="limpiar"><i class="glyphicon glyphicon-trash"></i><span> Limpiar Filtros</span></a></li>
                        <li><a href="#" id="btnFiltros"><i class="glyphicon glyphicon-tasks"></i><span> Búsquedas Avanzadas</span></a></li>
                    </ul>                    
                </div>
            </div>
        </div>
        <div id="TipoDocumentoSeleccionado" style="display:none">0</div>
        <!--/span-->
        <!-- left menu ends -->

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

