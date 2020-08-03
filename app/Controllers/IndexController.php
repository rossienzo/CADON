<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Image;

class IndexController extends Controller
{
    const SESSION_ERROR = "AddressError";

    public function userLogin($login, $password)
    {
        $user = new User();

        try {

            $user->login($login, $password);
        
          } catch (\Exception $e) {
        
            Controller::setError($e->getMessage());
          }
        
    }

    // registra o usuário no banco
    public function register()
    {
        $user = new User();
        try
        {
            // Campo nome vazio
            if( !isset($_POST['name']) || $_POST['name'] === '')
            {
                throw new \Exception("Digite algum nome", 100);
            }

            // Campo nome com poucos caracteres
            else if (strlen($_POST["name"]) < 3)
            {
                throw new \Exception("Digite um nome maior", 101);
            }

            /* Atualmente o campo sobrenome está como opcional
            // Campo sobrenome vazio
            else if( !isset($_POST["lastname"]) || $_POST["lastname"] === '')
            {
                throw new \Exception("Digite algum sobrenome",102);
            }

            // Campo sobrenome com poucos caracteres
            else if (strlen($_POST["lastname"]) < 3)
            {
                throw new \Exception("Digite um sobrenome maior", 103);
            }
            */

            // Campo nome de usuário vazio ou com poucos caracteres
            else if( !isset($_POST["username"]) || $_POST["username"] === '' || strlen($_POST['username']) < 4)
            {
                throw new \Exception("Digite um nome de usuário com mais de 4 digitos", 104);
            }

            // Usuário já cadastrado
            else if ($user->userExist("ususername" , $_POST["username"]) )
            {
                throw new \Exception("Nome de usuário já cadastrado", 105);
            }

            // Email com caracteres indevidos
            else if (!$user->emailValidation($_POST["email"])) // ! negação se o email for verdadeiro
            {
                throw new \Exception("Email inválido", 106);
            }

            // Email já cadastrado
            else if ($user->userExist("usemail" , $_POST["email"]))
            {
                throw new \Exception("Email já cadastrado", 107);
            }

            // Campo senha Vazio ou com poucos caracteres
            else if( !isset($_POST["password"]) || $_POST["password"] === '' || strlen($_POST["password"]) < 6)
            {
                throw new \Exception("Digite uma senha com 6 ou mais digitos", 108);
            }

            // As senha não são iguais
            else if( !isset($_POST["repassword"]) || $_POST['repassword'] != $_POST['password'])
            {
                throw new \Exception("As senhas não são iguais", 109);
            }

            // Termos não aceito
            else if (!isset($_POST['terms']) || $_POST['terms'] === "")
            {
                throw new \Exception("Você precisa aceitar os termos para prosseguir", 110);
            }

            // Termos não aceito
            else if (!$user->phoneValidation($_POST["phone"]))
            {
                throw new \Exception("Você precisa aceitar os termos para prosseguir", 111);
            }

            $user->__set('name', strtolower($_POST["name"]));
            $user->__set('lastname', strtolower($_POST["lastname"]));
            $user->__set('phone', $user->phoneValidation($_POST["phone"]));
            $user->__set('address', '');
            $user->__set('username', $_POST["username"]);
            $user->__set('email', $_POST['email']);
            $user->__set('password', $_POST['password']);
            $user->__set('status', 1); // insere como usuário normal
            
            if ($user->insert())
            {
                Controller::setSuccess("Cadastro realizado com sucesso!");
            }

        }
        catch (\Exception $e)
        {
          Controller::setError($e->getMessage());
          Controller::setErrorRegister($e->getCode());
        }

    }

    public function forgotPassword()
    {
        $user = new User();
        $user->__set('email', $_POST['email']);
       
        try
        {
            return $user->userEmailRecovery($user->__get('email'), false); // retorna true or false
        }
        catch (\Exception $e)
        {
            Controller::setError($e->getMessage());
            return False;
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

        // verifica se o codigo enviado pela url é valido
        if (isset($_GET["code"]) && isset($_GET["selector"]) && isset($_GET["iu"]))
        {
            // gera o codigo md5 para verificar se o do email é válido
            $forgotMd5 = $user->generateCode(base64_decode($_GET["iu"]));
            
            if ($_GET["code"] === '' || $_GET["iu"] === '' || $_GET["selector"] === '')
            {
                header("Location: /login");
            }
            else if ($_GET["code"] != $forgotMd5)
            {
                header("Location: /login");
            }
        }
        // caso enviado a password e a re-password ele irá resetar a senha
        else if (isset($_POST["password"]) && isset($_POST["re-password"]))
        {
            try
            {
                $result = $user->validForgotDecrypt($_POST["selector"]);

                $password = $_POST["password"];
                $repassword = $_POST["re-password"];

                // Campo senha Vazio ou com poucos caracteres
                if( !isset($password) || $password === '' || strlen($password) < 6)
                {
                    throw new \Exception("Digite uma senha com 6 ou mais digitos", 108);
                }

                // As senha não são iguais
                else if( !isset($repassword) || $password != $repassword)
                {
                    throw new \Exception("As senhas não são iguais", 109);
                }

                // faz update da nova senha e retorna o boolean
                return $user->resetPassword($password, $result['iduser']);
                

            }
            catch (\Exception $e)
            {
                Controller::setError($e->getMessage());
            }
        }
        else
        {
            header("Location: /login");
        }
    }

}
