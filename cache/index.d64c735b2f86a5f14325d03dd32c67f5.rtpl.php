<?php if(!class_exists('Rain\Tpl')){exit;}?><body id="index">
  <header class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="/">CADON</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/application">Home <span class="sr-only">(current)</span></a>
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
  
  <section>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../res/images/carousel/1.jpg"  class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../res/images/carousel/2.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../res/images/carousel/3.jpg" class="d-block w-100" alt="...">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
  </section>

  <section id="section-cards">
    <div class="container">
      <div class="row">

        <div class="col-md-4 ">
          <div class="card" >
            <img src="../res/images/card/card-photo-1.jpeg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Contratos Fechados</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary stretched-link text-light">Go somewhere</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 ">
          <div class="card" >
            <img src="../res/images/card/card-photo-2.jpeg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Negócios</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary stretched-link text-light">Go somewhere</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 ">
          <div class="card" >
            <img src="../res/images/card/card-photo-3.jpeg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Plano de Negócios</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary stretched-link text-light">Go somewhere</a>
            </div>
          </div>
        </div>

      </div>  
    </div>
  </section>

  <section id="section-comment">
    <div class="container">
      <div class="row no-gutters bg-light position-relative">
        <div class="col-md-6 mb-md-0 p-md-4 text-center">
          <img src="../res/images/row-comment-hand-laptop.jpg" class="w-100 border-0 rounded" alt="...">
        </div>
        <div class="col-md-6 position-static p-4 pl-md-0">
          <h5 class="mt-0">Columns with stretched link</h5>
          <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
          <a href="#" class="stretched-link">Go somewhere</a>
        </div>
      </div>
    </div>
  </section>

  <div id="nav-top" >
    <div class="container-fluid text-center pt-3 pb-3 text-light nav-top-link" >
      Voltar para o início
    </div>
  </div>

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
