<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Task;

class AppController extends Controller
{
    public function configurationTask()
    {
        $task = new Task();

        switch($_POST)
        {
            case isset($_POST["confirm"]):
                $postTask = explode('&', $_POST["confirm"]); // pega os dados contido no value do button
                
                $idtask = $postTask[0]; // id da tarefa
                $statusTask = $postTask[1]; // status da tarefa

                $task->__set('idtask', $idtask);
                $task->__set('iduser', $_SESSION[User::SESSION]["iduser"]);

                if ($statusTask === 'pendente')
                {
                    $task->updateIndex('idstatus', 2);
                }
                else
                {
                    $task->updateIndex('idstatus', 1);
                }
                
            break;

            case isset($_POST["delete"]):
                
                $idtask = $_POST["delete"]; // id da tarefa

                $task->__set('idtask', $idtask);
                $task->__set('iduser', $_SESSION[User::SESSION]["iduser"]);
                $task->delete();

            break;

            case isset($_POST["destask"]) && isset($_POST["idtask"]):

                // atualiza os dados da tarefa
                $task->__set('iduser', $_SESSION[User::SESSION]["iduser"]);
                $task->__set('idtask', $_POST['idtask']);
                $task->updateIndex('destask', $_POST['destask']);

            break;
        }
    }

    // controle da rota pending-tasks
    public function pendingTasks()
    {
        // seleciona todas as tarefas pendentes
        if (count($this->selectTasks('pendente')) === 0)
        {
            $dataTasks = 'empty';
        } 
        else
        {
            $dataTasks = $this->selectTasks('pendente');
        }

        return $dataTasks;
    }

    // controle da rota new-tasks
    public function newTask()
    {
        if (isset($_POST['task']) && $_POST['task'] === '')
        {
            Controller::setError("Digite alguma coisa");
        }
        else
        {
            // inserir
            $task = new Task();
            $task->__set('iduser', $_SESSION[User::SESSION]["iduser"]);       
            $task->__set('destask', $_POST['task']);

            if (isset($_POST['task-done']) && $_POST['task-done'] === 'on')
            {
                $task->__set('idstatus', 2);
            }
            else 
            {
                $task->__set('idstatus', 1);
            }

            if (!$task->insert())
            {
                Controller::setSuccess("Tarefa inserida com sucesso");
            }
            else
            {
                Controller::setError("Erro ao inserir tarefa");
            }
        }
    }

    // controle da rota all-tasks
    public function allTasks()
    {
        // seleciona todas as tarefas pendentes
        if (count($this->selectTasks()) === 0)
        {
            $dataTasks = 'empty';
        } 
        else
        {
            $dataTasks = $this->selectTasks();
        }

        return $dataTasks;
    }

    // seleciona as tarefas de acordo com o status passado
    public function selectTasks($status = 'all')
    {
        $task = new Task();
        $task->__set('iduser', $_SESSION[User::SESSION]['iduser']);

        // seleciona todas as tarefas pendentes
        return $task->selectStatus($status);
    }   

}