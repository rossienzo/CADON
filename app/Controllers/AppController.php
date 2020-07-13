<?php

namespace App\Controllers;

use Src\Database\Connection;
use App\Models\User;
use App\Models\Image;
use App\Models\Task;
use PDOException;

class AppController extends Controller
{

    public function itemConfig($data)
    {
        
        $task = new Task();
        $idtask = $task->__set('idtask', str_replace('id=', '', $data[1]));
        $iduser = $task->__set('iduser', $_SESSION['id']);
        $destask = $task->__set('destask', str_replace('task=', '', $data[2]));
        $idstatus = $task->__set('idstatus', str_replace('status=', '', $data[3]));
        
        if ($data[0] == '/application')
        {
            if (isset($_POST["delete"]))
            {
                $task->delete();
                header("Location: /application");
            }
            else if(isset($_POST["confirm"]))
            {
                if ($idstatus == 'pendente')
                {
                    $task->updateIndex('idstatus', 2);
                }
                else
                {
                    $task->updateIndex('idstatus', 1);
                }

                header("Location: /application");
            }
            
        } 
        else if ($data[0] == '/all-tasks')
        {
            if (isset($_POST["delete"]))
            {
                $task->delete();
                header("Location: /all-tasks");
            }
            else if(isset($_POST["confirm"]))
            {
                if ($idstatus == 'pendente')
                {
                    $task->updateIndex('idstatus', 2);
                }
                else
                {
                    $task->updateIndex('idstatus', 1);
                }

                header("Location: /all-tasks");
            }
        }
        else
        {
            echo "Nenhum item selecionado";
        }
    }

    public function selectTasks($status = NULL)
    {
        $task = new Task();
        $task->__set('iduser', $_SESSION['id']);

        if ($_SERVER["REQUEST_URI"] === '/application')
        {
            return $task->selectStatus($status);
        }
        else if ($_SERVER["REQUEST_URI"] === '/all-tasks')
        {
            return $task->select();
        }
   
    }   

    public function updateTask($idtask, $destask)
    {
        $task = new Task();
        $task->__set('iduser', $_SESSION['id']);
        $task->__set('idtask', $idtask);
        $task->updateIndex('destask', $destask);
    }

    public function insertTask()
    {
        if (isset($_POST['task']) && $_POST['task'] === '')
        {
            header("Location: /new-task?msg=warning");
        }
        else
        {
            // inserir
            $task = new Task();

            $task->__set('iduser', $_SESSION['id']);       
            $task->__set('destask', $_POST['task']);

            if (isset($_POST['task-done']) && $_POST['task-done'] === 'on')
            {
                $task->__set('idstatus', 2);
            }
            else 
            {
                $task->__set('idstatus', 1);
            }
            
            $task->insert();
            header("Location: /new-task?msg=success");
        }
    }

    public function deleteTask()
    {
        if (isset($_POST['task']) && $_POST['task'] === '')
        {
            header("Location: /new-task?msg=warning");
        }
        else
        {
            // inserir
            $task = new Task();

            $task->__set('iduser', $_SESSION['id']);       
            $task->__set('destask', $_POST['task']);

            if (isset($_POST['task-done']) && $_POST['task-done'] === 'on')
            {
                $task->__set('idstatus', 2);
            }
            else 
            {
                $task->__set('idstatus', 1);
            }
            
            $task->insert();
            header("Location: /new-task?msg=success");
        }
    }

    public function selectUser()
    {
        $iduser = $_SESSION['id'];
        $user = new User();
        return $user->listAll($iduser);

    }
}