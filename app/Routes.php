<?php

use Src\Application\Route;
use App\Models\Image;
use App\Models\User;
use App\Controllers\IndexController;
use App\Controllers\AdminController;
use App\Controllers\AppController;

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

Route::add('/admin/exit', function() {
  
  $adminController = new AdminController();
  $adminController->userAuthValidation();
  session_destroy();

  header("Location: /");
});


Route::run();