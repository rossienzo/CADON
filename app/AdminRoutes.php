<?php

use Src\Application\Route;
use App\Controllers\AdminController;

/*
 ******************
 * Route - Admin **
 ******************
 */

Route::add('/admin', function() {
 
  $admc = new AdminController();
  $admc->verifyLogin();
  $userData = $admc->getFromSession();

  $admc->assignValues('user', $userData);

  $admc->drawView("admin/header");
  $admc->drawView("admin/aside");
  $admc->drawView("admin/index3");
  $admc->drawView("admin/footer");
}, 'get');

Route::add('/admin/login', function() {
 
  $admc = new AdminController();

  $admc->assignValues('error', $admc->getError());
  $admc->drawView("admin/login");
}, 'get');

Route::add('/admin/login', function() {
 
  $admc = new AdminController();

  $admc->userLogin($_POST["login"], $_POST["password"]);

  header("Location: /admin");
}, 'post');

Route::add('/admin/perfil', function() {

  $admc = new AdminController();
  $admc->verifyLogin();
  $userData = $admc->getFromSession();
  
  $admc->assignValues('user', $userData);
  $admc->assignValues('error', $admc->getError());
  $admc->assignValues('success', $admc->getSuccess());

  $admc->drawView("admin/header");
  $admc->drawView("admin/aside");
  $admc->drawView("admin/perfil");
  $admc->drawView("admin/footer");
  
});

Route::add('/admin/perfil', function() {

  $admc = new AdminController();
  $admc->verifyLogin();

  $admc->imagePerfilUpdate();

  if($admc->perfilUpdate($_POST))
  {
    AdminController::setSuccess("Perfil atualizado com sucesso!");
  }

  /*
  try
  {
    foreach($post as $key => $value)
    {
      switch ($key) {
        case 'desname':
          $admc->perfilUpdate($key, $value);
          break;

        case 'deslastname':
          $admc->perfilUpdate($key, $value);
          break;

        case 'usphone':
          $admc->perfilUpdate($key, $value);
          break;

        case 'usaddress':
          $admc->perfilUpdate($key, $value);
          break;

        case 'usemail':
          $admc->perfilUpdate($key, $value);
          break; 
      }
    }
  }
  catch (\Exception $e)
  {
    AdminController::setError($e->getMessage());
  }
  
  */

  //header("Location: /admin/perfil");
}, 'post');

Route::add('/admin/extras/register', function() {

  $admc = new AdminController();
  $admc->verifyLogin();
  $userData = $admc->getFromSession();

  $admc->assignValues('user', $userData);
  $admc->assignValues('error', $admc->getError());
  $admc->assignValues('success', $admc->getSuccess());

  $admc->drawView("admin/header");
  $admc->drawView("admin/aside");
  $admc->drawView("admin/extras/register");
  $admc->drawView("admin/footer");
});

Route::add('/admin/extras/register', function() {
  
  $admc = new AdminController();
  $admc->verifyLogin();

  if ($admc->userRegister())
  {
    $admc->setSuccess("Cadastro realizado com sucesso!");
  }

  header("Location: /admin/extras/register");
}, 'post');

Route::add('/admin/extras/forgot-password', function() {

  $admc = new AdminController();
  $admc->verifyLogin();
  
  $userData = $admc->getFromSession();
  $admc->assignValues('user', $userData);
  
  $admc->drawView("admin/header");
  $admc->drawView("admin/aside");
  
  $admc->drawView("admin/footer");
  
});

Route::add('/pages/users', function() {

  $admc = new AdminController();
  $admc->verifyLogin();

  $userData = $admc->getFromSession();
  $admc->assignValues('user', $userData);

  $admc->assignValues('listUsers', $admc->listUsers());

  $admc->drawView("admin/header");
  $admc->drawView("admin/aside");
  $admc->drawView("admin/pages/users");
  $admc->drawView("admin/footer");
});


Route::add('/admin/logout', function() {
  
  AdminController::logout();

  header("Location: /admin/login");
});

?>