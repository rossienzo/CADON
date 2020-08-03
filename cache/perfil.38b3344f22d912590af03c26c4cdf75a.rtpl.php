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
        <div id="profile-group" class="text-center">
            <?php if( $error != '' ){ ?>
            <div class="alert alert-warning">
                <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </div>
            <?php } ?>

            <?php if( $success != '' ){ ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars( $success, ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </div>
            <?php } ?>
            <div class="perfil-image">
                <img src="<?php echo htmlspecialchars( $user['perfilImage'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="img-circle elevation-2" alt="User Image">
            </div>

            <div class="perfil-image mt-1">
              <form action="/admin/perfil" enctype="multipart/form-data"  method="POST">
                <input type="file" name="image" />
                <button id="btnUploadImage" type="submit" class="btn btn-primary mb-2">Enviar</button>
              </form>
            </div>

            <div class="perfil-info mt-3">
                <small >Nome</small>
                <a id="perfilDesname" class=""><h3><?php if( $user['desname'] == '' ){ ?> Nenhum dado informado <?php }else{ ?> <?php echo htmlspecialchars( $user['desname'], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php } ?></h3></a>
                
                <form id="formDesname" action="/admin/perfil" style="display: none;" method="POST" class="">
                  <div class="form-group mb-2">
                    <input class="input-text-size" id="perfil-name-input" type="text" name="desname"  max-width="30px" value="<?php echo htmlspecialchars( $user['desname'], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                    <button type="submit" class="btn btn-outline-secondary">Ok</button>
                  </div>
                </form>
            </div>
            <hr />
            <div class="perfil-info mt-3">
                <small >Sobrenome</small>
                <?php if( $user['deslastname'] == '' ){ ?>
                <a id="perfilDeslastname"  class="text-secondary">
                  <h3> Nenhum dado informado  </h3>
                </a>
                <?php }else{ ?>
                <a id="perfilDeslastname"  class="">
                  <h3> <?php echo htmlspecialchars( $user['deslastname'], ENT_COMPAT, 'UTF-8', FALSE ); ?>  </h3>
                </a> 
                <?php } ?>
            
                <form id="formDeslastname" action="/admin/perfil" style="display: none;" method="POST" class="">
                  <div class="form-group mb-2">
                    <input class="input-text-size" id="perfil-lastname" type="text" name="deslastname" max-width="30px" value="<?php echo htmlspecialchars( $user['deslastname'], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                    <button type="submit" class="btn btn-outline-secondary">Ok</button>
                  </div>
                </form>
            </div>
            <hr />
            <div class="perfil-info mt-3">
                <small >Telefone</small>
                <a id="perfilUsphone" class=""><h3><?php if( $user['usphone'] == '' ){ ?> Nenhum dado informado <?php }else{ ?> <?php echo htmlspecialchars( $user['usphone'], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php } ?></h3></a>

                <form id="formUsphone" action="/admin/perfil" style="display: none;" method="POST" class="">
                  <div class="form-group mb-2">
                    <input class="input-text-size" id="perfil-phone" type="phone" name="usphone" max-width="30px" value="<?php echo htmlspecialchars( $user['usphone'], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                    <button type="submit" class="btn btn-outline-secondary">Ok</button>
                  </div>
                </form>
            </div>
            <hr />
            <div class="perfil-info mt-3">
                <small >Endereço</small>
                <?php if( $user['usaddress'] == '' ){ ?>
                <a id="perfilUsaddress"  class="text-secondary">
                  <h3> Nenhum dado informado  </h3>
                </a>
                <?php }else{ ?>
                <a id="perfilUsaddress"  class="">
                  <h3> <?php echo htmlspecialchars( $user['usaddress'], ENT_COMPAT, 'UTF-8', FALSE ); ?>  </h3>
                </a> 
                <?php } ?>

                <form id="formUsaddress" action="/admin/perfil" style="display: none;" method="POST" class="">
                  <div class="form-group mb-2">
                    <input class="input-text-size" id="perfil-address" type="text" name="usaddress" max-width="30px" value="<?php echo htmlspecialchars( $user['usaddress'], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                    <button type="submit" class="btn btn-outline-secondary">Ok</button>
                  </div>
                </form>
            </div>
            <hr />
            <div class="perfil-info mt-3">
                <small >Email</small>
                <a id="perfilUsemail" class=""><h3><?php if( $user['usemail'] == '' ){ ?> Nenhum dado informado <?php }else{ ?> <?php echo htmlspecialchars( $user['usemail'], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php } ?></h3></a>

                <form id="formUsemail" action="/admin/perfil" style="display: none;" method="POST" class="">
                  <div class="form-group mb-2">
                    <input class="input-text-size" id="perfil-email" type="text" name="usemail" max-width="30px" value="<?php echo htmlspecialchars( $user['usemail'], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                    <button type="submit" class="btn btn-outline-secondary">Ok</button>
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

