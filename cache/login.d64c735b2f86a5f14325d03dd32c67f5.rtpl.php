<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADON - Login</title>
    <link rel="stylesheet" href="../res/css/bootstrap.css">
    <link rel="stylesheet" href="../res/css/main.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        
</head>
<body id="login">
  <div class="container form-container ">
    <div class="mx-auto form-center">

      <form class="border-0 rounded" method="POST" action="/auth">

          <a href="/" class="branding-link">
            <div class="branding-fab">
              <i class="fab fa-cuttlefish "></i>
            </div>
            <h3 class="mx-auto">CADON</h3>
          </a>
          
          
        <?php if( $msg != '' ){ ?>
        <div class="form-group bg-danger text-white text-center pt-2 pb-2">
          <span>Usuário ou Senha incorretos!</span>
        </div>
        <?php } ?>
        
        <div class="form-group">
          <label for="exampleInputEmail1">Usuário</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
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