<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Image;


class AdminController extends Controller
{
    /**
     * Registra o usuário no BD
     */
    public function userRegister()
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

        // valida o telefone 
        else if (!$user->phoneValidation($_POST["phone"]))
        {
            throw new \Exception("Telefone inválido", 111);
        }

        if (isset($_POST['administrador']))
        {
            $status = 2;
        }
        else
        {
            $status = 1;
        }

        $user->__set('name', strtolower($_POST["name"]));
        $user->__set('lastname', $_POST['lastname']);
        $user->__set('phone', $user->phoneValidation($_POST["phone"]));
        $user->__set('address', $_POST['address']);
        $user->__set('username', $_POST['username']);
        $user->__set('email', $_POST['email']);
        $user->__set('password', $_POST['password']);
        $user->__set('status', $status);

        return $user->insert();

       }
       catch (\Exception $e)
       {
            Controller::setError($e->getMessage());
            return false;
       }
       
    }

    /**
     * O arquivo enviado pelo usuário será inserido ou atualizado no BD e por fim será
     * enviado para a pasta de upload como perfil de usuário
     */
    public function imagePerfilUpdate()
    {
        $files = isset($_FILES['image']) ? $files = $_FILES['image'] : $files = '';
        
        if (isset($files) && $files != '')
        {
            $image = new Image();
            $iduser = $_SESSION[User::SESSION]["iduser"];
            
            $image->__set('iduser', $iduser);
            
            try
            {
            
               if ($image->insertOrUpdateImg($files))
               {
                   Controller::setSuccess("Imagem salva com sucesso");
               }
               else
               {
                   Controller::setError("Erro ao salvar a imagem");
               }
            } 
            catch (\Exception $e) 
            {
                Controller::setError($e->getMessage());
            }

            // carrega na sessão a imagem de perfil do usuário
            $_SESSION[User::SESSION]["perfilImage"] = $image->userPerfilImage($iduser);
        }
    }

    /**
     * Atualiza um índice na tabela juntamente com a variável na sessão do usuário
     */

     /*
    public function perfilUpdate($key, $value)
    {
        $user = new User();
        
        // pega o id do usuario na sessão
        $iduser = $_SESSION[User::SESSION]["iduser"];

        // atualiza na sessão o dado
        $_SESSION[User::SESSION][$key] = $_POST[$key];
        
        if ($user->updateIndex($iduser, $key, $value))
        {
            Controller::setSuccess("Perfil atualizado com sucesso!");
        }
        else
        {
            Controller::setError("Erro ao atualizar perfil");
        }
    }

    */

    public function perfilUpdate($post)
    {
        $user = new User();
        
        try
        {
            // pega o id do usuario na sessão
            $iduser = $_SESSION[User::SESSION]["iduser"];

            foreach($post as $key => $value)
            {
                switch ($key) 
                {
                    case 'desname':
                        // Campo nome com poucos caracteres
                        if( strlen($value) < 3 || str_replace(' ', '', $value) === '')
                        {
                            throw new \Exception("O nome precisa ter 3 ou mais caracteres", 100);
                        }

                        $user->updateIndex($iduser, $key, $value);
                    break;

                    case 'deslastname':
                        $user->updateIndex($iduser, $key, $value);
                    break;

                    case 'usphone':
                        // valida o telefone 
                        if (!$user->phoneValidation($value))
                        {
                            throw new \Exception("Telefone inválido", 111);
                        }

                        $user->updateIndex($iduser, $key, $user->phoneValidation($value));
                    break;

                    case 'usaddress':
                        $user->updateIndex($iduser, $key, $value);
                    break;

                    case 'usemail':
                        // Email com caracteres indevidos
                        if (!$user->emailValidation($value)) // ! negação se o email for verdadeiro
                        {
                            throw new \Exception("Email inválido", 106);
                        }

                        // Email já cadastrado
                        if ($user->userExist("usemail", $value))
                        {
                            throw new \Exception("Email já cadastrado", 107);
                        }

                        $user->updateIndex($iduser, $key, $value);
                    break; 
                }
            }
        }
        catch (\Exception $e)
        {
            AdminController::setError($e->getMessage());
        }
    }


    /**
     * Lista todos os usuários menos o próprio usuário
     */
    public function listUsers()
    {
        $user = new User();

        $iduser = $_SESSION[User::SESSION]["iduser"];

        return $user->selectDifferenceOfLoggedUser($iduser);
    }

}

