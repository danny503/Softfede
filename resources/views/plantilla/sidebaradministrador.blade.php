  
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="admin/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Usuario</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                  <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li @click="menu=0" class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-th"></i>
                                <p>
                                    Inicio
                                    <span class="right badge badge-danger">Info</span>
                                </p>
                            </a>
                        </li>
                         <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-fw fa-users"></i>
                                <p>Usuarios
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li @click="menu=1" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Registrarse</p>
                                    </a>
                                </li>                            
                            </ul>
                        </li>
                         <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-fw fa-check-square-o"></i>
                                <p>
                                    Inscripciones
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li @click="menu=3" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Jugadores</p>
                                    </a>
                                </li>
                                <li @click="menu=4" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Cuerpo t&eacute;cnico</p>
                                    </a>
                                </li>
                                <li @click="menu=5" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Equipos</p>
                                    </a>
                                </li>
                                <li @click="menu=22" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Registro de equipo</p>
                                    </a>
                                </li>
                                <li @click="menu=6" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>&Aacute;rbitros</p>
                                    </a>
                                </li>
                                <li @click="menu=7" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Torneos</p>
                                    </a>
                                </li>                                
                            </ul>
                        </li>                    
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-edit"></i>
                                <p>
                                    Registros
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li @click="menu=8" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Categor&iacute;as</p>
                                    </a>
                                </li>
                                <li @click="menu=9" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Ramas</p>
                                    </a>
                                </li>
                                <li @click="menu=10" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Sede</p>
                                    </a>
                                </li>
                                <li @click="menu=11" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Tipos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-edit"></i>
                                <p>
                                    Inscribirse
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                             <ul class="nav nav-treeview">
                                <li @click="menu=12" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Inscribirse</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-table"></i>
                                <p>Tabla
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li @click="menu=13" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Tabla posiciones</p>
                                    </a>
                                </li>
                                <li @click="menu=14" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Jugador destacado</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-edit"></i>
                                <p>
                                    Planilla de juego
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li @click="menu=15" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Puntaje</p>
                                    </a>
                                </li>
                                <li @click="menu=17" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Puntaje Partido</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-edit"></i>
                                <p>
                                    Programaci&oacute;n
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li @click="menu=16" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Programaci&oacute;n de partidos</p>
                                    </a>
                                </li>
                                <li @click="menu=17" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Partidos programados</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">Administración</li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-plus-square-o"></i>
                                <p>
                                    Sistema
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li @click="menu=18" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                                <li @click="menu=19" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Respaldo de la base de datos.</p>
                                    </a>
                                </li>
                                <li @click="menu=20" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Restauración de la base de datos.</p>
                                    </a>
                                </li>
                                <li @click="menu=21" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Registro de auditorías</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">Acerca de</li>
                        <li class="nav-item">
                            <a href="https://adminlte.io/docs" class="nav-link">
                                <i class="nav-icon fa fa-file"></i>
                                <p>Manual</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://adminlte.io/docs" class="nav-link">
                                <i class="nav-icon fa fa-file"></i>
                                <p>Soporte</p>
                            </a>
                        </li>
                        <li class="nav-header">Opciones</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-primary"></i>
                                <p class="text">Contacto</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
        