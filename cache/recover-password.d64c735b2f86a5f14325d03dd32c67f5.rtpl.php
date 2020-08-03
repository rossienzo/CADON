<?php if(!class_exists('Rain\Tpl')){exit;}?><?php if( $success != '' ){ ?>

  <meta http-equiv="refresh" content="3;url= /login">
<?php } ?>

  <body class="hold-transition login-page">
    <?php if( $success != '' ){ ?> <!-- Success if-->
    <div class="login-box">
      <div class="login-logo">
        <a href="/"><b>CADON</b></a>
      </div>
      <!-- /.login-logo -->
      <div class="text-center text-muted"><small>A pagina será atualizada em <b id="timer"></b></small></div>
      <div class="card">
        <div class="card-body login-card-body text-center">
          <h4 class="text-success"><?php echo htmlspecialchars( $success, ENT_COMPAT, 'UTF-8', FALSE ); ?></h4>
          <p class="mt-3 mb-1 ">
            <a href="/login">
            <button type="button" class="btn btn-outline-info">Fazer Login</button>
          </a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
  
<?php }else{ ?> <!-- Success else -->
  <div class="login-box">
    <div class="login-logo">
      <a href="/"><b>CADON</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <?php if( $error != '' ){ ?>

          <div class="alert alert-danger">
              <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>

          </div>
        <?php } ?> 
        <p class="login-box-msg">Você está a um passo da sua nova senha, recupere ela agora.</p>
        
        <form action="/forgot-password/reset" method="post">
          <input type="hidden" name="selector" value="<?php echo htmlspecialchars( $code, ENT_COMPAT, 'UTF-8', FALSE ); ?>" />
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Senha">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="re-password" placeholder="Confirmar Senha">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Atualizar Senha</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
<?php } ?> <!-- End Success if-->

