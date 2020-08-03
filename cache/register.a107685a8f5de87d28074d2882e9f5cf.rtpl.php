<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Cadastrar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Cadastrar</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid pl-5 pr-5">
        <?php if( $error != '' ){ ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </div>
        <?php } ?>  
      
        <?php if( $success != '' ){ ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars( $success, ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </div>
        <?php } ?>
        <form method="POST" 6 action="/admin/extras/register">

          <div class="form-group row">
            <label for="inuputName" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inuputName" name="name" />
            </div>
          </div>

          <div class="form-group row">
            <label for="inputLastname" class="col-sm-2 col-form-label">Sobrenome</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputLastname" name="lastname"  />
            </div>
          </div>

          <div class="form-group row">
            <label for="inputPhone" class="col-sm-2 col-form-label">Telefone</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputPhone" name="phone">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputAddress" class="col-sm-2 col-form-label">Endereço</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputAddress" name="address">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputUsername" class="col-sm-2 col-form-label">Nome de Usuário</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputUsername" name="username">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail" name="email">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Senha</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputPassword" name="password">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Digite novamente a senha</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputRePassword" name="repassword">
            </div>
          </div>

          <div class="form-group row ">
            <div class="col-md-2">Administrador</div>
            <div class="col-md-10">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="administrator" name='administrador'>
                <label class="form-check-label" for="administrator">
                  O usuário é administrador
                </label>
              </div>
            </div>
          </div>
          <div class="form-group row float-right ">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
          </div>
        </form>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


