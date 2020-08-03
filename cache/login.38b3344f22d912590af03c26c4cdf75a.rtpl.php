<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../res/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../res/admin/dist/css/adminlte.min.css">
  <!-- Main CSS -->
  <link rel="stylesheet" href="../../res/admin/dist/css/main.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <?php if( $error != '' ){ ?>

        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>

        </div>
      <?php } ?> 
      <p class="login-box-msg">Entre para iniciar a sua sessão</p>

      <form action="/admin/login" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="login" placeholder="Nome de Usuário" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Senha" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

 <!-- jQuery -->
 <script src="../../res/admin/plugins/jquery/jquery.min.js"></script>
 <!-- Bootstrap -->
 <script src="../../res/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- AdminLTE -->
 <script src="../../res/admin/dist/js/adminlte.js"></script>

 <!-- OPTIONAL SCRIPTS -->
 <script src="../../res/admin/plugins/chart.js/Chart.min.js"></script>
 <script src="../../res/admin/dist/js/demo.js"></script>
 <script src="../../res/admin/dist/js/pages/dashboard3.js"></script>
 <script src="../../res/admin/dist/js/main.js"></script>

</body>
</html>
