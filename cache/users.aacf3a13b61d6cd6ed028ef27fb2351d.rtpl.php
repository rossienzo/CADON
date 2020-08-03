<?php if(!class_exists('Rain\Tpl')){exit;}?>


  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Usuários</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Usuários</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8 "></div>
          <div class="col-md-4 ">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Resultados</label>
              </div>
              <select class="custom-select" id="inputGroupSelect01">
                <option selected>10</option>
                <option value="1">20</option>
                <option value="2">30</option>
                <option value="3">50</option>
                <option value="4">100</option>
                <option value="5">300</option>
                <option value="6">500</option>
                <option value="7">1000</option>
                <option value="8">Tudo</option>
              </select>
            </div>
          </div>
        </div> <!-- /.row -->

        <div class="row">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Sobrenome</th>
                <th scope="col">Telefone</th>
                <th scope="col">Endereço</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Tipo de Usuário</th>
                <th scope="col">Data de Registro</th>
              </tr>
            </thead>
            <tbody>
              <?php $counter1=-1;  if( isset($listUsers) && ( is_array($listUsers) || $listUsers instanceof Traversable ) && sizeof($listUsers) ) foreach( $listUsers as $key1 => $value1 ){ $counter1++; ?>

              <tr>
                <th scope="row"><?php echo htmlspecialchars( $key1 + 1, ENT_COMPAT, 'UTF-8', FALSE ); ?></th>
                <td><?php echo htmlspecialchars( $value1["desname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["deslastname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["usphone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["usaddress"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["ususername"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["usemail"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
  
                <?php if( $value1["usstatus"] == 1 ){ ?>

                  <td>Cliente</td>
                <?php }else{ ?>

                  <td>Administrador</td>
                <?php } ?>

                <td><?php echo htmlspecialchars( $value1["dtregister"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              </tr>
              <?php } ?>

            </tbody>
          </table>
        </div>

      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


