<?php

use Src\Application\Route;
use App\Models\Image;
use App\Models\User;
use App\Controllers\AdminController;


/*
 ******************
 * Route - Admin **
 ******************
 */

Route::add('/admin', function() {
 
  $adminController = new AdminController();
  $image = new Image();
  $user = new User();
  $adminController->userAuthValidation();
  
  $id = $_SESSION['id'];
  $user_results = $user->listAll($id);
  $userphoto = $image->userPerfilImage($id);

  $adminController->assignValues('userphoto', $userphoto);
  $adminController->assignValues('user', $user_results);

  $adminController->drawView("admin/header");
  $adminController->drawView("admin/aside");
  $adminController->drawView("admin/index3");
  $adminController->drawView("admin/footer");
}, 'get');

Route::add('/admin/perfil', function() {

  $adminController = new AdminController();
  $image = new Image();
  $user = new User();
  $adminController->userAuthValidation();

  $id = $_SESSION['id'];
  $user_results = $user->listAll($id);
  $userphoto = $image->userPerfilImage($id);
  
  $adminController->assignValues('userphoto', $userphoto);
  $adminController->assignValues('user', $user_results);
  
  $adminController->drawView("admin/header");
  $adminController->drawView("admin/aside");
  $adminController->drawView("admin/perfil");
  $adminController->drawView("admin/footer");
  
});

Route::add('/admin/perfil/edit', function() {

  $adminController = new AdminController();
  $user = new User();
  $image = new Image();

  $adminController->userAuthValidation();
  $post = $_POST;
  $id = $_SESSION['id'];

  $files = isset($_FILES['image']) ? $files = $_FILES['image'] : $files = '';
  $image->updateImg($files);

  foreach($post as $key => $value)
  {
    switch ($key) {
      case 'desname':
        $user->updateIndex($id, 'desname', $value);
        header("Location: /admin/perfil");
        break;

      case 'deslastname':
        $user->updateIndex($id, 'deslastname', $value);
        header("Location: /admin/perfil");
        break;

      case 'usphone':
        $user->updateIndex($id, 'usphone', $value);
        header("Location: /admin/perfil");
        break;

      case 'usaddress':
        $user->updateIndex($id, 'usaddress', $value);
        header("Location: /admin/perfil");
        break;

      case 'usemail':
        $user->updateIndex($id, 'usemail', $value);
        header("Location: /admin/perfil");
        break; 

      default:
        header("Location: /admin/perfil");
        break;
    }
  }

  header("Location: /admin/perfil");

}, 'post');

Route::add('/admin/extras/register', function() {

  $adminController = new AdminController();
  $user = new User();
  $image = new Image();

  $adminController->userAuthValidation();

  $id = $_SESSION['id'];
  $user_results = $user->listAll($id);
  $userphoto = $image->userPerfilImage($id);
  
  $adminController->assignValues('userphoto', $userphoto);
  $adminController->assignValues('user', $user_results);

  $adminController->drawView("admin/header");
  $adminController->drawView("admin/aside");
  $adminController->drawView("admin/extras/register");
  $adminController->drawView("admin/footer");
});

Route::add('/admin/extras/register/insert', function() {
  
  $adminController = new AdminController();

  $adminController->userAuthValidation();
  
  $adminController->userInsert();

}, 'post');


Route::add('/admin/extras/forgot-password', function() {

  $adminController = new AdminController();
  $image = new Image();
  $user = new User();
  $adminController->userAuthValidation();

  $id = $_SESSION['id'];
  $user_results = $user->listAll($id);
  $userphoto = $image->userPerfilImage($id);
  
  $adminController->assignValues('userphoto', $userphoto);
  $adminController->assignValues('user', $user_results);
  
  $adminController->drawView("admin/header");
  $adminController->drawView("admin/aside");
  
  $adminController->drawView("admin/footer");
  
});

Route::add('/pages/users', function() {

  $adminController = new AdminController();
  $image = new Image();
  $user = new User();
  $adminController->userAuthValidation();

  $id = $_SESSION['id'];

  // Data from perfil of user admin 
  $user_results = $user->listAll($id);
  $userphoto = $image->userPerfilImage($id);
  $adminController->assignValues('userphoto', $userphoto);
  $adminController->assignValues('user', $user_results);
  
  isset($_GET['limit'])? $query = $_GET['limit'] : $query = '' ;

  var_dump($query);
  $adminController->assignValues('listUsers', $adminController->listUsers($id));


  $adminController->drawView("admin/header");
  $adminController->drawView("admin/aside");
  $adminController->drawView("admin/pages/users");
  $adminController->drawView("admin/footer");
  
});


Route::add('/admin/exit', function() {
  
  $adminController = new AdminController();
  $adminController->userAuthValidation();
  session_destroy();

  header("Location: /");
});

?>