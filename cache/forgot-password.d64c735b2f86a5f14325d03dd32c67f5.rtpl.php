<?php if(!class_exists('Rain\Tpl')){exit;}?>  <body class="hold-transition login-page">
    <?php if( $success != '' ){ ?> <!-- Success if-->
      <div class="login-box">
        <div class="login-logo">
          <a href="/"><b>CADON</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body text-center">
            <h4 class="text-success"><?php echo htmlspecialchars( $success, ENT_COMPAT, 'UTF-8', FALSE ); ?> <i class="fas fa-paper-plane"></i></h4>
            <p>Caso ainda não tenha recebido o email, clique para enviar novamente.</p>
            <p class="mt-3 mb-1 ">
              <a href="/forgot-password">
              <button type="button" class="btn btn-outline-info">Enviar novamente</button>
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
          
          <p class="login-box-msg">Você esquceu a sua senha? Aqui você pode recuperar a sua senha facilmente.</p>
          <form action="/forgot-password" method="post">
            <div class="input-group mb-3">
              <input type="email" class="form-control" name="email" placeholder="Email" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Requisitar nova senha</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <p class="mt-3 mb-1">
            <a href="/login">Fazer Login</a>
          </p>
          <p class="mb-0">
            <a href="/register" class="text-center">Não está cadastrado? Clique aqui.</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <?php } ?> <!-- End Success if-->
  <!-- /.login-box -->
