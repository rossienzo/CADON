<?php

use Src\Application\Route;
use App\Controllers\IndexController;

/*
 ******************
 * Route - Index **
 ******************
 */

Route::add('/', function() {

    $indexController = new IndexController();

    $indexController->drawView('index');
});
  
Route::add('/login', function() {

    $indexController = new IndexController();

    
    // verifica se existe algum dado passado na url
    isset($_GET['msg']) ? $msg = $_GET['msg'] : $msg = '';

    // envia a mensagem para o html
    $indexController->assignValues('msg', $msg);
    
    $indexController->drawView('login');

});

Route::add('/auth', function() {

    $indexController = new IndexController();
    $name = $_POST['name'];
    $password = $_POST['password'];

    if (!isset($name) OR $name == '' || !isset($password) OR $password == '')
    {
        header("Location: /login?msg=error");
    }
    else
    {
        $indexController->authentication($name, $password);
    }

}, 'post');

Route::add('/register', function() {

    $indexController = new IndexController();

    // verifica se existe algum dado passado na url
    isset($_GET['msg']) ? $msg = $_GET['msg'] : $msg = '';
    
    $indexController->assignValues('msg', $msg);
    $indexController->drawView('register');
});

Route::add('/register/user-insert', function() {

  $indexController = new IndexController();
  $indexController->userRegister();
  
}, 'post');

Route::add('/forgot-password', function() {

    $indexController = new IndexController();

    // verifica se existe algum dado passado na url
    isset($_GET['msg']) ? $msg = $_GET['msg'] : $msg = '';

    // envia a mensagem para o html
    $indexController->assignValues('msg', $msg);

    $indexController->drawView('forgot-password');
});

Route::add('/forgot-password/sent', function() {

    $indexController = new IndexController();
  var_dump($indexController->forgotPassword());
    if ($indexController->forgotPassword())
    {
      $indexController->drawView('sent-email');
    }
    else
    {
      header("Location: /forgot-password?msg=error");
    }

  
}, 'post');

Route::add('/forgot-password/reset', function(){

  $indexController = new IndexController();
  
  $indexController->validForgotDecrypt();

  $indexController->assignValues('code', $_GET["code"]);
  $indexController->drawView('recover-password');
});

Route::add('/forgot-password/reset', function(){

  $indexController = new IndexController();
  $indexController->reset();
}, 'post');