
    <?php if (isset($userdata['usuario'])): ?>

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=site_url('dashboard')?>">Klipsia</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <?php if ($userdata['idGrupo'] !== null): ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Grupo <b><?= $userdata['idGrupo']." - ".$userdata['NombreGrupo'] ?></b>
                    </a>
                </li>

                    <?php if (count($userdata['Novedades']) !== 0): ?>
                    <!-- Menu de reportes -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
                            <i class="fa fa-envelope fa-fw"></i> <span class="badge badge-light"><?php echo count($userdata['Novedades']); ?></span> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                        <?php foreach ($userdata['Novedades'] as $item): ?>
                            <li>
                                <a href="#"> <!-- Necesitamos llevar aqui al reporte de la novedad para dar como leido -->
                                    <div>
                                        <strong><?= $item['PersNombre'].' '.$item['PersApellido'] ?></strong>
                                        <span class="pull-right text-muted">
                                            <em><?= $item['Nombre'].' '.$item['Apellido'] ?></em>
                                        </span>
                                    </div>
                                    <div><?= $item['Novedad'] ?></div>
                                </a>
                            </li>
                            <li class="divider"></li>
                        <?php endforeach; ?>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>Read All Messages</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    <?php endif; ?>
                    </li>

                <?php endif; ?>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?= $userdata['Nombre']?> <?= $userdata['Apellido']?>
						<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?=site_url('Usuario/updateItem/'.$userdata['idUsuario'])?>"><i class="fa fa-user fa-fw"></i> Perfil Usuario</a>
                        </li>
                        <?php if ($userdata['TipoUsuario'] == 'Admin'): ?>
                        <li><a href="<?=site_url('aplicacion')?>"><i class="fa fa-gear fa-fw"></i> Configuración</a>
                        </li>
                        <?php endif; ?>
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
                                    <a href="<?=site_url('aplicacion')?>">Configuración General</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('usuario')?>">Usuarios</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('grupo')?>">Grupos</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('Aplicacion/logcambios')?>">Log Cambios</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php endif; ?>
                        <?php if ($userdata['idGrupo'] !== null): ?>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Grupo<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php if (($userdata['TipoUsuario'] == 'Lider') || ($userdata['TipoUsuario'] == 'Admin')): ?>
                                <li>
                                    <a href="<?=site_url('Grupo/updateItem/'.$userdata['idGrupo'])?>">Grupo</a>
                                </li>
                                <?php endif; ?>
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
                                    <a href="<?=site_url('evento/index/'.$userdata['idGrupo'])?>">Gestión Eventos</a>
                                </li>
                                <?php if ($userdata['AsistAbierta']): ?>
                                <li>
                                    <a href="<?=site_url('asistencia/index/'.$userdata['idGrupo'])?>">Tomar Asistencia</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('Integrante/insertQuickItem')?>">Crear Nuevo</a>
                                </li>
                                <!-- <li>
                                    <a href="<?=site_url('asistencia')?>">Tomar Lista</a>
                                </li> -->
						        <?php endif; ?>                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reportes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <!-- <li>
                                    <a href="#">Notificaciones</a>
                                </li> -->
                                <li>
                                    <a href="<?=site_url('statistics')?>">Estadísticas</a>
                                </li>
                                <!-- <li>
                                    <a href="#">Reporte Asistencia Iglesia</a>
                                </li> -->
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

    <?php endif; ?>

		<!-- !PAGE CONTENT! -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
