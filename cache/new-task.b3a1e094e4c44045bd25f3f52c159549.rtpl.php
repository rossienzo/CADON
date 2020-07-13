<?php if(!class_exists('Rain\Tpl')){exit;}?>   <section id="app-main">
      <div class="container">
        <div class="row">

          <div class="col-md-3 menu">
            <ul class="list-group shadow-sm">
              <li class="list-group-item disabled"><?php echo htmlspecialchars( $user['desname'], ENT_COMPAT, 'UTF-8', FALSE ); ?></li>
              <li class="list-group-item"><a href="/application" class="">Tarefas pendentes</a></li>
              <li class="list-group-item active"><a href="/new-task">Nova tarefa</a></li>
              <li class="list-group-item"><a href="/all-tasks">Todas as tarefas</a></li>
              
            </ul>
          </div>

          <div class="col-md-9 shadow-sm text-justify list-itens">
            <?php if( $msg != '' && $msg == 'success' ){ ?>
            <div class="form-group bg-success text-white text-center pt-2 pb-2">
              <span>Tarefa salva com sucesso!</span>
            </div>
            <?php } ?>

            <?php if( $msg != '' && $msg == 'warning' ){ ?>
            <div class="form-group bg-warning text-white text-center pt-2 pb-2">
              <span>Digite alguma tarefa</span>
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
