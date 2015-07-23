<!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">E-Tractomaq</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
            <img alt="Charisma Logo" src="img/logo20.png" class="hidden-xs"/>
                <span>E-Tractomaq</span></a>
            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?=$usuario?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#" id="perfil">Perfil</a></li>
                    <li class="divider"></li>
                    <li><a href="<?=site_url()?>usuario/logout">Cerra Sesion</a></li>
                </ul>
            </div>
             <div class="btn-group pull-right">
                
                <button class="btn btn-default" data-toggle="dropdown" id="Descargar">
                    <img src="img/excel-16.png"/><span class="hidden-sm hidden-xs"> Descargar</span>                    
                </button>                
            </div>
        </div>
    </div>
    <!-- topbar ends -->