<?php if(!class_exists('Rain\Tpl')){exit;}?>   <section id="app-main">
      <div class="container">
        <div class="row">

          <div class="col-md-3 menu">
            <ul class="list-group shadow-sm">
              <li class="list-group-item disabled"><?php echo htmlspecialchars( $user['desname'], ENT_COMPAT, 'UTF-8', FALSE ); ?></li>
              <li class="list-group-item"><a href="/pending-tasks" class="">Tarefas pendentes</a></li>
              <li class="list-group-item active"><a href="/new-task">Nova tarefa</a></li>
              <li class="list-group-item"><a href="/all-tasks">Todas as tarefas</a></li>
              
            </ul>
          </div>

          <div class="col-md-9 shadow-sm text-justify list-itens">

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

            <h3>Nova Tarefa</h3>
            <hr />
            <form method="post" action="/new-task">
              <div class="form-group">
                <label>Descrição da tarefa:</label>
                <input type="text" class="form-control" name="task" placeholder="Exemplo: Lavar o carro">
              </div>
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="task-done" id="task-done">
                <label class="form-check-label" for="task-done">Tarefa já realizada</label>
              </div>
              <button class="btn btn-success">Cadastrar</button>
            </form>
          </div>
        </div>

      </div>
    </section>
