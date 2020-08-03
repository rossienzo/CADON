<?php if(!class_exists('Rain\Tpl')){exit;}?><body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="/"><b>CADON</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Registrar-se</p>

      <?php if( $error != '' ){ ?>

        <div class="alert alert-danger">
            <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>

        </div>
      <?php } ?>  
      
      <?php if( $success != '' ){ ?>

        <div class="alert alert-success">
            <?php echo htmlspecialchars( $success, ENT_COMPAT, 'UTF-8', FALSE ); ?>

        </div>
      <?php } ?>


      
      <form id="form-register" action="/register" method="post">
        <small class="text-muted float-right mr-2">
          (obrigatório)
        </small>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="Nome" required />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <small class="text-muted float-right mr-2">
          (opcional)
        </small>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="lastname" placeholder="Sobrenome" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <small class="text-muted float-right mr-2">
          (obrigatório)
        </small>
        <div class="input-group mb-3">
          <input type="phone" class="form-control" name="phone" placeholder="Telefone" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>

        <small class="text-muted float-right mr-2">
          (conter 6 ou mais digitos)
        </small>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Nome do usuário" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <small class="text-muted float-right mr-2">
          (exemplo123@hotmail.com)
        </small>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <small class="text-muted float-right mr-2">
          (conter 6 ou mais digitos)
        </small>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Senha" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" name="repassword" placeholder="Digite a senha novamente" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
              <label for="agreeTerms">
               Eu aceito os <a href="#">termos</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button id="btn-register" type="submit" class="btn btn-primary btn-block">Cadastrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OU -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Entrar usando o Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Entrar usando o Google+
        </a>
      </div>

      <a href="/login" class="text-center">Já sou membro</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->