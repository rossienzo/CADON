<?php if(!class_exists('Rain\Tpl')){exit;}?><body id="login">
  <div class="container form-container ">
    <div class="mx-auto form-center">

      <form class="border-0 rounded" method="POST" action="/login">

          <a href="/" class="branding-link">
            <div class="branding-fab">
              <i class="fab fa-cuttlefish "></i>
            </div>
            <h3 class="mx-auto">CADON</h3>
          </a>
          
        <?php if( $error != '' ){ ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </div>
        <?php } ?>  
        
        <div class="form-group">
          <label for="exampleInputEmail1">Usuário</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="login" aria-describedby="emailHelp">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Senha</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <div class="form-group form-group-btn">
          <button type="submit" class="btn btn-primary">Entrar</button>
        </div>
        <div >
          <p><a class="text-primary" href="/forgot-password">Esqueci a minha senha</a></p>
          <p><a class="text-primary" href="/register">Não está cadastrado? Clique aqui.</a></p>
        </div>
      </form>

    </div>
  </div>
</body>
</html>