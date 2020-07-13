<?php if(!class_exists('Rain\Tpl')){exit;}?>

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Perfil</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Perfil</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="text-center ">
            <div class="perfil-image">
              
                <img src="<?php echo htmlspecialchars( $userphoto, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="perfil-image mt-1">
              <form action="/admin/perfil/edit" enctype="multipart/form-data"  method="POST">
                <input type="file" name="image" />
                <button type="submit" class="btn btn-primary mb-2">Ok</button>
              </form>
            </div>
            <div class="perfil-info mt-3">
                <small >Nome</small>
                <a id="perfil-name" href="#" class=""><h3><?php echo htmlspecialchars( $user['desname'], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3></a>
                
                <form action="/admin/perfil/edit" method="POST" class="">
                  <div class="form-group mb-2">
                    <input class="" id="perfil-name-input" type="text" name="desname"  max-width="30px" value="<?php echo htmlspecialchars( $user['desname'], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                    <button type="submit" class="btn btn-primary mb-2">Ok</button>
                  </div>
                </form>
            </div>
            <hr />
            <div class="perfil-info mt-3">
                <small >Sobrenome</small>
                <a href="#" class=""><h3><?php echo htmlspecialchars( $user['deslastname'], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3></a>
            
                <form action="/admin/perfil/edit" method="POST" class="">
                  <div class="form-group mb-2">
                    <input id="perfil-lastname" type="text" name="deslastname" max-width="30px" value="<?php echo htmlspecialchars( $user['deslastname'], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                    <button type="submit" class="btn btn-primary mb-2">Ok</button>
                  </div>
                </form>
            </div>
            <hr />
            <div class="perfil-info mt-3">
                <small >Telefone</small>
                <a href="#" class=""><h3><?php echo htmlspecialchars( $user['usphone'], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3></a>

                <form action="/admin/perfil/edit" method="POST" class="">
                  <div class="form-group mb-2">
                    <input id="perfil-lastname" type="text" name="usphone" max-width="30px" value="<?php echo htmlspecialchars( $user['usphone'], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                    <button type="submit" class="btn btn-primary mb-2">Ok</button>
                  </div>
                </form>
            </div>
            <hr />
            <div class="perfil-info mt-3">
                <small >Endereço</small>
                <a href="#" class=""><h3><?php echo htmlspecialchars( $user['usaddress'], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3></a>

                <form action="/admin/perfil/edit" method="POST" class="">
                  <div class="form-group mb-2">
                    <input id="perfil-lastname" type="text" name="usaddress" max-width="30px" value="<?php echo htmlspecialchars( $user['usaddress'], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                    <button type="submit" class="btn btn-primary mb-2">Ok</button>
                  </div>
                </form>
            </div>
            <hr />
            <div class="perfil-info mt-3">
                <small >Email</small>
                <a href="#" class=""><h3><?php echo htmlspecialchars( $user['usemail'], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3></a>

                <form action="/admin/perfil/edit" method="POST" class="">
                  <div class="form-group mb-2">
                    <input id="perfil-lastname" type="text" name="usemail" max-width="30px" value="<?php echo htmlspecialchars( $user['usemail'], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                    <button type="submit" class="btn btn-primary mb-2">Ok</button>
                  </div>
                </form>
            </div>
            <hr />
            
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

