<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Image;

class IndexController extends Controller
{
    const SESSION_ERROR = "AddressError";

    public function authentication($email, $password)
    {
        /**
         * utiliza a função userExist para verificar se o usuario existe e 
         * salva os dados referentes a id e name 
         */
        $user = new User();
        $user->__set('email', $email);
        $user->__set('password', $password);
        
        $results = $user->userExist($user->__get('email'), $user->__get('password'));
        $id = $results['iduser'];
        $name = $results['desname'];
        $lastname = $results['deslastname'];
        $status = $results['usstatus'];

        if ($results)
        {
            if ($results['iduser'] =! '' || $results['desname'] = '' || $results['deslastname'] = '')
            {
                $user->__set('id', $id);
                $user->__set('name', $name);
                $user->__set('lastname', $lastname);
                $user->__set('status', $status);
                
                if ($user->__get('id') != '' || $user->__get('desname') != '')
                {
                    session_start();

                    // Salva o usuario na sessão
                    $_SESSION['id'] = $user->__get('id');
                    $_SESSION['name'] = $user->__get('name');
                    $_SESSION['lastname'] = $user->__get('lastname');
                    $_SESSION['status'] = $user->__get('status');
                    
                    if ($status === '1')
                    {
                        
                        header("Location: /application");
                    }
                    else
                    {
                        header("Location: /admin");
                    }
                }
            }
        }
        else
        {
            header("Location: /login?msg=error");
        }
        
    }

    // registra o usuário no banco
    public function userRegister()
    {

        if( !isset($_POST['name']) || $_POST['name'] === '' || strlen($_POST['name']) < 3)
        {

        }

        if (!isset($_POST['lastname']) || $_POST['lastname'] === '' || strlen($_POST['lastname']) < 3)
        {
                
                    
        }

        if (!isset($_POST['email']) || $_POST['email'] === '' || filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {

        }

        if (!isset($_POST['password']) || !isset($_POST['password']) === '' || strlen($_POST['password']) > 6)
        {
                        
        }

        if (!isset($_POST['re-password']) || $_POST['re-password'] === '' ||  $_POST['re-password'] != $_POST['password'])
        {
                            
        }

        if (!isset($_POST['terms']) || $_POST['terms'] === "")
        {
        
        }

        try
        {
            $user = new User();

            $user->__set('name', strtolower($_POST['name']));
            $user->__set('lastname', strtolower($_POST['lastname']));
            $user->__set('phone', '');
            $user->__set('address', '');
            $user->__set('username', '');
            $user->__set('email', $_POST['email']);
            $user->__set('password', $_POST['password']);
            $user->__set('status', 1);
            $user->insert();

            header("Location: /login");
        }
        catch (\PDOException $e)
        {
            $e->getMessage();
        }
                        
    }

    public function forgotPassword()
    {
        $user = new User();

        $user->__set('email', $_POST['email']);
        //$user->userEmailRecovery($user->__get('email'), false);
        if ($user->userEmailRecovery($user->__get('email'), false))
        {
            
        }
        else
        {
            return FALSE;
        }
        
    }

     /**
     * Faz uso da função validForgotDecrypt para decodificar o que foi passado na url
     */
    public function validForgotDecrypt()
    {
        if (isset($_GET["code"]))
        {
            if ($_GET["code"] === '')
            {
                header("Location: /login");
            }
            else
            {
                $user = new User();
                $result = $user->validForgotDecrypt($_GET["code"]);
                
                return $result['idrecovery'];
            }
        }
        else
        {
            header("Location: /login");
        }
        
    }
    
    /**
     * Faz uso da função resetPassword para adicionar a nova senha de usuário
     */
    public function reset()
    {
        $user = new User();
        $result = $user->validForgotDecrypt($_POST["code"]);
        
        $password = $_POST["password"];
        $rePassword = $_POST["re-password"];

        if ($password === $rePassword)
        {
            $user->resetPassword($password, $result['iduser']);
        }
        
    }

}
