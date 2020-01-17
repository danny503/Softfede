<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Softfede | Inscripciones</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="css/plantilla.css">
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div id="app">
    <div class="wrapper">
   <!--         inverse navbar with notifications -->
   
 <nav class="main-header navbar navbar-expand navbar-primary border-bottom" style="background-color: #e3f2fd;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <div class="nav-item">
                    <span class="d-md-down-none">{{Auth::user()->usuario}} </span>
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-danger">Sign out</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    </div>     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> Cerrar sesión</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="admin/img/baloncesto.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Aplicacion</span>
            </a>

         
        @if(Auth::check())
            @if (Auth::user()->idrol == 1)
                @include('plantilla.sidebaradministrador')
            @elseif (Auth::user()->idrol == 2)
                @include('plantilla.sidebarjugador')
            @elseif (Auth::user()->idrol == 3)
                @include('plantilla.sidebartecnico')
             @elseif (Auth::user()->idrol == 4)
                @include('plantilla.sidebararbitro')
            @else
 
            @endif
            
        @endif
        </div>
        <!-- Contenido Principal -->
        @yield('contenido')
        </div>
        </aside>
    
    
      <!-- Content Wrapper. Contains page content -->
      
      <!-- /.content-wrapper -->
      
      <!-- <Contr></Contr>ol Sidebar -->
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="admin/js/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="admin/js/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    <!-- Bootstrap 4 -->
    <script src="admin/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="admin/js/adminlte.js"></script>
    <script src="admin/js/sweetalert2.all.js"></script>  
    <script src="js/app.js"></script>
    <script src="admin/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="admin/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="admin/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="admin/plugins/input-mask/jquery.inputmask.phone.extensions.js"></script>
    <script>
      $(function () {
        $("[data-mask]").inputmask();        
      });
    </script>
  </body>
</html>
