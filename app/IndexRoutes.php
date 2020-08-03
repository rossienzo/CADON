<?php

use Src\Application\Route;
use App\Controllers\IndexController;

/*
 ******************
 * Route - Index **
 ******************
 */

Route::add('/', function() {

    $indexc = new IndexController();

    
    $indexc->assignValues('title', 'CADON'); // título
    $indexc->drawView('header');
    $indexc->drawView('index');
    $indexc->drawView('footer');
    
});
  
Route::add('/login', function() {

    $indexc = new IndexController();

    // verifica se existe algum dado passado na url
    isset($_GET['msg']) ? $msg = $_GET['msg'] : $msg = '';

    // envia a mensagem para o html
    
    
    $indexc->assignValues('msg', $msg);
    $indexc->assignValues('error', $indexc->getError());
    
    $indexc->assignValues('title', 'CADON - Entrar'); // título
    $indexc->drawView('header');
    $indexc->drawView('login');

});

Route::add('/login', function() {

    $indexc = new IndexController();
    $login = $_POST["login"];
    $password = $_POST["password"];

    if (!isset($login) OR $login == '' || !isset($password) OR $password == '')
    {
      $indexc->setError("Digite o usuário e a senha");
      header("Location: /login");
    }
    else
    {
      $indexc->userLogin($login, $password);
      header("Location: /pending-tasks");
    }

}, 'post');

Route::add('/register', function() {

    $indexc = new IndexController();
    
    $indexc->assignValues('error', $indexc->getError());
    $indexc->assignValues('success', $indexc->getSuccess());
    $indexc->assignValues('errorRegister', $indexc->getErrorRegister());

    $indexc->assignValues('title', 'CADON - Registrar'); // title of page
    $indexc->drawView('header');
    $indexc->drawView('register');
    $indexc->drawView('footer');
});

Route::add('/register', function() {

  $indexc = new IndexController();
  $indexc->register();
                  
  header("Location: /register");

}, 'post');

Route::add('/forgot-password', function() {

    $indexc = new IndexController();

    $indexc->assignValues('error', $indexc->getError());
    $indexc->assignValues('success', $indexc->getSuccess());

    $indexc->assignValues('title', 'CADON - Esqueci a senha'); // title of page
    $indexc->drawView('header');
    $indexc->drawView('forgot-password');
    $indexc->drawView('footer');
});

Route::add('/forgot-password', function() {

  $indexc = new IndexController();

    if ($indexc->forgotPassword())
    {
      $indexc->setSuccess("Email enviado!");
      header("Location: /forgot-password");
    }
    else
    {
      header("Location: /forgot-password");
    }

  $indexc->drawView('forgot-password');
}, 'post');

Route::add('/forgot-password/reset', function(){

  $indexc = new IndexController();

  $indexc->reset();
  $indexc->assignValues('error', $indexc->getError());
  $indexc->assignValues('success', $indexc->getSuccess());
  $indexc->assignValues('code', $_GET["selector"]);


  $indexc->assignValues('title', 'CADON - Recuperar a senha'); // title of page

  $indexc->drawView('header');
  $indexc->drawView('recover-password');
  $indexc->drawView('footer');
  
});

Route::add('/forgot-password/reset', function(){

  $indexc = new IndexController();

  if ($indexc->reset())
    {
      $indexc->setSuccess("Senha alterada com sucesso!");

      $indexc->assignValues('success', $indexc->getSuccess());
      $indexc->assignValues('title', 'CADON - Recuperar a senha'); // title of page
      $indexc->drawView('header');
      $indexc->drawView('recover-password');
      $indexc->drawView('footer');
    }

}, 'post');
