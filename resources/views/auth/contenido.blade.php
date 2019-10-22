<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Softfede</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/plantilla.css">  
    <link rel="stylesheet" href="admin/bower_components/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <body class="hold-transition login-page" style="background-image: url(admin/img/login.jpg);">
  
  <body class="app flex-row align-items-center">
  <div class="container">
    @yield('login')
  </div>
   


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
    <script src="admin/js/sweetalert.min.js"></script>  
    
  </body>
</html>
