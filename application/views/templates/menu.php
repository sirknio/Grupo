
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">L&iacute;deres</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?= $userdata['Nombre']?>
						<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil Usuario</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuración</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?=site_url('login/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesión</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?=site_url('dashboard')?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						<?php if ($userdata['TipoUsuario'] == 'Admin'): ?>
                        <li>
                            <a href="#"><i class="fa fa-desktop fa-fw"></i> Aplicación<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=site_url('usuario')?>">Usuarios</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('grupo')?>">Grupos</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<?php endif; ?>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Grupo<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=site_url('Grupo/index/'.$userdata['idGrupo'])?>">Grupo</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('Microcelula/index/'.$userdata['idGrupo'])?>">Microcélulas</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('Integrante/index/'.$userdata['idGrupo'])?>">Integrantes</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-calendar fa-fw"></i> Eventos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=site_url('evento')?>">Gestión Eventos</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('asistencia')?>">Tomar Asistencia</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reportes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Notificaciones</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('statistics')?>">Estadísticas</a>
                                </li>
                                <li>
                                    <a href="#">Reporte Asistencia Iglesia</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>



		<!-- !PAGE CONTENT! -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
