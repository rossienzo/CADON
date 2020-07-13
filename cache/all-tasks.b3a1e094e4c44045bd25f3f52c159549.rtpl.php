<?php if(!class_exists('Rain\Tpl')){exit;}?>    <section id="app-main">
      <div class="container">
        <div class="row">

          <div class="col-md-3 menu">
            <ul class="list-group shadow-sm">
              <li class="list-group-item disabled"><?php echo htmlspecialchars( $user['desname'], ENT_COMPAT, 'UTF-8', FALSE ); ?></li>
              <li class="list-group-item"><a href="/application" class="">Tarefas pendentes</a></li>
              <li class="list-group-item"><a href="/new-task">Nova tarefa</a></li>
              <li class="list-group-item active"><a href="/all-tasks">Todas as tarefas</a></li>
              
            </ul>
          </div>

          <div class="col-md-9 shadow-sm text-justify list-itens">
            <h3>Todas as Tarefas</h3>
            <hr />
            <?php if( $tasks === 'empty' ){ ?>
            <div class="form-group bg-warning text-white text-center pt-2 pb-2">
              <span>Não há nenhuma tarefa salva</span>
            </div>
            <?php } ?>
            
            <table class="table">
              <thead class="thead-white">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tarefa</th>
                  <th scope="col">Configurar</th>
                </tr>
              </thead>
              <tbody id="tasks-group">
                <?php $counter1=-1;  if( isset($tasks) && ( is_array($tasks) || $tasks instanceof Traversable ) && sizeof($tasks) ) foreach( $tasks as $key1 => $value1 ){ $counter1++; ?>
                <tr  class="list-itens">
                  <th scope="row"><?php echo htmlspecialchars( $key1 + 1, ENT_COMPAT, 'UTF-8', FALSE ); ?></th>

                  <td class="description">
                    <p id="task-<?php echo htmlspecialchars( $value1["idtask"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["destask"], ENT_COMPAT, 'UTF-8', FALSE ); ?>

                      <?php if( $value1["status"] == 'realizado' ){ ?>
                      <small class="text-success">(<?php echo htmlspecialchars( $value1["status"], ENT_COMPAT, 'UTF-8', FALSE ); ?>)</small>
                    </p>
                    <br />
                    <small class="text-success" style="display: none;" id="dt-task-<?php echo htmlspecialchars( $key1 + 1, ENT_COMPAT, 'UTF-8', FALSE ); ?>">Data da criação: <?php echo htmlspecialchars( $value1["dtregistertask"], ENT_COMPAT, 'UTF-8', FALSE ); ?></small>
                    
                    <?php }else{ ?>
                    <small>(<?php echo htmlspecialchars( $value1["status"], ENT_COMPAT, 'UTF-8', FALSE ); ?>)</small>
                    </p>
                    <br />
                    <small style="display: none;" id="dt-task-<?php echo htmlspecialchars( $key1 + 1, ENT_COMPAT, 'UTF-8', FALSE ); ?>">Data da criação: <?php echo htmlspecialchars( $value1["dtregistertask"], ENT_COMPAT, 'UTF-8', FALSE ); ?></small>
                    <?php } ?>
                   
                  </td>
                  
                  <td>

                    <form action="/all-tasks?id=<?php echo htmlspecialchars( $value1["idtask"], ENT_COMPAT, 'UTF-8', FALSE ); ?>?task=<?php echo htmlspecialchars( $value1["destask"], ENT_COMPAT, 'UTF-8', FALSE ); ?>?status=<?php echo htmlspecialchars( $value1["status"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="POST">
                      <?php if( $value1["status"] == 'realizado' ){ ?>
                      
                      <button type="submit" name="confirm" class="btn">
                        <i class="fas fa-check-square fa-lg text-success"></i>
                      </button>

                      <button type="submit" name="delete" class="btn">
                        <i class="fas fa-trash-alt fa-lg text-danger"></i>
                      </button>
                      <?php }else{ ?>
                      <button type="submit" name="confirm" class="btn">
                        <i class="fas fa-check-square fa-lg text-success"></i>
                      </button>

                      <button type="button" name="edit" onclick="editTask(<?php echo htmlspecialchars( $value1["idtask"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, '<?php echo htmlspecialchars( $value1["destask"], ENT_COMPAT, 'UTF-8', FALSE ); ?>')" class="btn">
                        <i class="fas fa-edit fa-lg text-info"></i>
                      </button>

                      <button type="submit" name="delete" class="btn">
                        <i class="fas fa-trash-alt fa-lg text-danger"></i>
                      </button>
                      <?php } ?>
                    </form>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

        </div>

      </div>
    </section>
