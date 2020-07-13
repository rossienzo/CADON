<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADON</title>
    <link rel="stylesheet" href="../res/css/bootstrap.css">
    <link rel="stylesheet" href="../res/css/main.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        
</head>
<body id="index">
    <header class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">CADON</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/login">Login</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </header>

    <section id="app-main">
      <div class="container">
        <div class="row">

          <div class="col-md-3 menu">
            <ul class="list-group shadow-sm">
              <li class="list-group-item active"><a href="#" class="">Tarefas pendentes</a></li>
              <li class="list-group-item"><a href="#">Nova tarefa</a></li>
              <li class="list-group-item"><a href="#">Todas as tarefas</a></li>
              
            </ul>
          </div>

          <div class="col-md-9 shadow-sm text-justify list-itens">
            <h3>Tarefas pendentes</h3>
            <hr />
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li>
            </ul>
          </div>
        </div>

      </div>
    </section>

    <!-- 
      <footer class="bg-dark">      
      <div class="container">
        <div class="row pt-2 pb-4">
          <div class="col-md-6">
            <a href="/" class="branding-link">
              <div class="branding-fab">
                <i class="fab fa-cuttlefish text-light"></i>
              </div>
              <h3 class="text-center text-light">CADON</h3>
            </a>
          </div>

          <div class="col-md-6 bg-transparent">
            <address class="mt-4 text-light text-center">
              <p>Voce pode contatar o autor em <a href="http.localhost.com.br" class="text-primary">www.domain.com</a></p>
              <p>Se encontrar qualquer bug, por favor <a href="master.cadon@hotmail.com" class="text-primary">contate o administrador do site</a></p>
            </address>
          </div>
        </div>
      </div>
    </footer>
     -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <script src="../res/js/jquery-3.5.1.min.js"></script>

    <script src="../res/js/main.js" ></script>
    
</body>

</html>