<?php

namespace App\Controllers;

use Src\Database\Connection;
use App\Models\User;
use App\Models\Image;
use PDOException;

class AdminController extends Controller
{

    public function userInsert()
    {
        if(isset($_POST['administrador']))
        {
            $status = 2;
        }
        else
        {
            $status = 1;
        }

            $user = new User();
            $user->__set('name', $_POST['name']);
            $user->__set('lastname', $_POST['lastname']);
            $user->__set('phone', $_POST['phone']);
            $user->__set('address', $_POST['address']);
            $user->__set('username', $_POST['username']);
            $user->__set('email', $_POST['email']);
            $user->__set('password', $_POST['password']);
            $user->__set('status', $status);

            $user->insert();
    }
}