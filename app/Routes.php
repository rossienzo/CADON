<?php

  use Src\Application\Route;
  use App\Models\Image;
  use App\Models\User;
  use App\Controllers\IndexController;
  use App\Controllers\AdminController;
  use App\Controllers\AppController;


  require_once('IndexRoutes.php');
  require_once('AppRoutes.php');
  require_once('AdminRoutes.php');

Route::run();