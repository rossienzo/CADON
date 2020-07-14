<?php

use Src\Application\Route;
use App\Models\Image;
use App\Controllers\AppController;

/*
 ************************
 * Route - Application **
 ************************
 */

Route::add('/application', function(){

    $appController = new AppController();
    $appController->userAuthValidation();
    $dataUser = $appController->selectUser();
  
    if (count($appController->selectTasks('pendente')) === 0)
    {
      $dataTasks = 'empty';
    } 
    else
    {
      $dataTasks = $appController->selectTasks('pendente');
    }
    
    $appController->assignValues('tasks', $dataTasks);
    $appController->assignValues('user', $dataUser);
  
    $appController->drawView('app/header');
    $appController->drawView('app/index');
    $appController->drawView('app/footer');
  });
  
  
  // Rota que recebe o que vier de atualização
  Route::add('/application', function(){
  
    $appController = new AppController();
    $appController->userAuthValidation();
  
  
  
    if (isset($_POST['idtask']) && $_POST['idtask'] != '')
    {
      if (isset($_POST['destask']) && $_POST['destask'] != '')
      {
        $appController->updateTask($_POST['idtask'], $_POST['destask']);
        header("Location: /application");
      } 
      else
      {
        echo "Digite alguma tarefa";
      }
      
    } else
    {
      $appController->itemConfig(explode('?', $_SERVER["REQUEST_URI"]));
    }
  
  }, 'post');
  
  Route::add('/new-task', function(){
  
    $appController = new AppController();
    $appController->userAuthValidation();
    $dataUser = $appController->selectUser();
  
    isset($_GET['msg']) ? $msg = $_GET['msg'] : $msg = '';
  
    $appController->assignValues('user', $dataUser);
    $appController->assignValues('msg', $msg);
    $appController->drawView('app/header');
    $appController->drawView('app/new-task');
    $appController->drawView('app/footer');
  });
  
  Route::add('/new-task', function(){
  
    $appController = new AppController();
    $appController->userAuthValidation();
  
    $appController->insertTask();
  
  }, 'post');
  
  Route::add('/all-tasks', function(){
  
    $appController = new AppController();
    $appController->userAuthValidation();
    $dataUser = $appController->selectUser();
  
    if (count($appController->selectTasks()) === 0)
    {
      $dataTasks = 'empty';
    } else
    {
      $dataTasks = $appController->selectTasks();
      
    }
    
    
    $appController->assignValues('tasks', $dataTasks);
    $appController->assignValues('user', $dataUser);
    $appController->drawView('app/header');
    $appController->drawView('app/all-tasks');
    $appController->drawView('app/footer');
  });
  
  Route::add('/all-tasks', function(){
  
    $appController = new AppController();
    $appController->userAuthValidation();
  
    if (isset($_POST['idtask']) && $_POST['idtask'] != '')
    {
      if (isset($_POST['destask']) && $_POST['destask'] != '')
      {
        $appController->updateTask($_POST['idtask'], $_POST['destask']);
        header("Location: /all-tasks");
      } 
      else
      {
        echo "Digite alguma tarefa";
      }
      
    } else
    {
      $appController->itemConfig(explode('?', $_SERVER["REQUEST_URI"]));
    }
    
  }, 'post');
  
  Route::add('/logoff', function() {
    
    $appController = new AppController();
    $appController->userAuthValidation();
    session_destroy();
  
    header("Location: /");
  });

