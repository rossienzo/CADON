<?php

use Src\Application\Route;
use App\Controllers\AppController;

/*
 ************************
 * Route - Application **
 ************************
 */

Route::add('/pending-tasks', function(){

    $appc = new AppController();
    $appc->verifyLogin(false);
    $dataUser = $appc->getFromSession();
  
    $dataTasks = $appc->pendingTasks();
    
    $appc->assignValues('tasks', $dataTasks);
    $appc->assignValues('user', $dataUser);
  
    $appc->drawView('app/header');
    $appc->drawView('app/index');
    $appc->drawView('app/footer');
  });
  
  
  // Rota que recebe o que vier de atualização
  Route::add('/pending-tasks', function(){
  
    $appc = new AppController();
    $appc->verifyLogin(false);
    
    $appc->configurationTask();
    
    header("Location: /pending-tasks");
    
  }, 'post');
  
  Route::add('/new-task', function(){
  
    $appc = new AppController();
    $appc->verifyLogin(false);
    $dataUser = $appc->getFromSession();

    $appc->assignValues('error', $appc->getError());
    $appc->assignValues('success', $appc->getSuccess());
    $appc->assignValues('user', $dataUser);

    $appc->drawView('app/header');
    $appc->drawView('app/new-task');
    $appc->drawView('app/footer');
  });
  
  Route::add('/new-task', function(){
  
    $appc = new AppController();
    $appc->verifyLogin(false);
    
    $appc->newTask();
  
    header("Location: /new-task");
  }, 'post');
  
  Route::add('/all-tasks', function(){
  
    $appc = new AppController();
    $appc->verifyLogin(false);
    $dataUser = $appc->getFromSession();
  
    $dataTasks = $appc->allTasks();
    
    $appc->assignValues('tasks', $dataTasks);
    $appc->assignValues('user', $dataUser);
    $appc->drawView('app/header');
    $appc->drawView('app/all-tasks');
    $appc->drawView('app/footer');
  });
  
  Route::add('/all-tasks', function(){
  
    $appc = new AppController();
    $appc->verifyLogin(false);
  
    $appc->configurationTask();
    header("Location: /all-tasks");
    
  }, 'post');
  
  Route::add('/logout', function() {
    
    AppController::logout();
  
    header("Location: /login");
  });

