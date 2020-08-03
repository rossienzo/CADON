<?php

namespace App\Models;

use Exception;
use Src\Application\Mailer;
use Src\Application\Model;
use Src\Database\Sql;

class User extends Model
{
    const SESSION = "User";
    const ERROR = "UserError";
	const ERROR_REGISTER = "UserErrorRegister";
    const SUCCESS = "UserSucesss";
    const CODE = "CADONFORGOT";

    private $id;
    private $name;
    private $lastname;
    private $phone;
    private $address;
    private $username;
    private $email;
    private $password;
    private $dateRegister;
    private $status;
    private $perfilImage;

    public function selectUser()
    {
        $sql = "SELECT * FROM tb_users";

        $conn = new Sql();
        return $conn->select($sql);
    }
    
    public function insertUser()
    {
        $sql = 'INSERT INTO tb_users (desname, deslastname, usphone, usaddress, ususername, usemail, uspassword, usstatus)
                VALUES (:DESNAME, :DESLASTNAME, :USPHONE, :USADDRESS, :USUSERNAME, :USEMAIL, :USPASSWORD, :USSTATUS)';

        $conn = new Sql();
        $conn->query($sql, array(
            ':DESNAME'=> $this->__get('name'),
            ':DESLASTNAME'=> $this->__get('lastname'),
            ':USPHONE'=> $this->__get('phone'),
            ':USADDRESS'=> $this->__get('address'),
            ':USUSERNAME'=> $this->__get('username'),
            ':USEMAIL'=> $this->__get('email'),
            ':USPASSWORD'=> $this->__get('password'),
            ':USSTATUS'=> $this->__get('status')
        ));
    }

    public function listAllFromID($id)
    {
        $sql = "SELECT * FROM tb_users WHERE iduser = :IDUSER";

        $conn = new Sql();
        return $conn->select($sql, array(
            ':IDUSER' => $id
        ));
    }

    // Seleciona todos os usuários menos o usuário logado
    public function selectDifferenceOfLoggedUser($id)
    {
        $sql = "SELECT * FROM tb_users WHERE iduser != :IDUSER";

        $conn = new Sql();
        return $conn->select($sql, array(
            ':IDUSER' => $id
        ));
    }

    public function insert()
    {
        $sql = 'INSERT INTO tb_users (desname, deslastname, usphone, usaddress, ususername, usemail, uspassword, usstatus)
                VALUES (:DESNAME, :DESLASTNAME, :USPHONE, :USADDRESS, :USUSERNAME, :USEMAIL, :USPASSWORD, :USSTATUS)';
            
        $conn = new Sql();
        return $conn->query($sql, array(
            ':DESNAME'     => $this->__get('name'),
            ':DESLASTNAME' => $this->__get('lastname'),
            ':USPHONE'     => $this->__get('phone'),
            ':USADDRESS'   => $this->__get('address'),
            ':USUSERNAME'  => $this->__get('username'),
            ':USEMAIL'     => $this->__get('email'),
            ':USPASSWORD'  => $this->getPasswordHash($this->__get('password')),
            ':USSTATUS'    => $this->__get('status')
        ));
    }

    /**
     * Faz o update de um índice da coluna
     * @param $key recebe o nome da coluna na tabela do banco
     */
    public function updateIndex($iduser, $key, $index)
    {
        $sql = "UPDATE tb_users SET $key = :INDEX 
        WHERE iduser = :IDUSER";

        $conn = new Sql();
        
        // atualiza na sessão o dado
        $_SESSION[User::SESSION][$key] = $index;

        return $conn->query($sql, array(
            ':INDEX' => $index,
            ':IDUSER' => $iduser
        ));
        
    }

    public static function login($login, $password)
	{
		$sql = new Sql();

        // seleciona na tabela tudo os dados do usuário relacionado ao username
		$results = $sql->select("SELECT * FROM tb_users WHERE ususername = :LOGIN", array(
			":LOGIN"=>$login
		)); 

        // se não encontrar dados referentes ao username irá buscar relacionado ao email
		if (count($results) === 0)
		{
            // seleciona na tabela tudo os dados do usuário relacionado ao seu email
            $results = $sql->select("SELECT * FROM tb_users WHERE usemail = :LOGIN", array(
                ":LOGIN"=>$login
            )); 
            
            // se não houver dados retornados o usuário não existe
            if (count($results) === 0)
            {
                throw new \Exception("Usuário inexistente ou senha inválida");
            }
        } 
  
		$data = $results[0];
        
        // a função verifica se o parâmetro é igual ao do BD
		if (password_verify($password , $data["uspassword"]) === TRUE) // verifica se a senha digitada é igual ao hash salvo no BD
		{
            $user = new User();
            $image = new Image();

			$data["desname"] = utf8_encode($data["desname"]);

            $user->__set('perfilImage', $image->userPerfilImage($data["iduser"]));

            // faz o __set() automatico
            $user->setData($data);

            // salva todos os dados na sessão
            $_SESSION[User::SESSION] = $user->getValues();
            return $user;
        } 
        else 
        {
			throw new \Exception("Usuário inexistente ou senha inválida");
		}
    }
    
    // Cria um hash da senha para salvar no BD
    public static function getPasswordHash($password)
	{
		return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);
    }



    public function phoneValidation($phone)
    {
        $phone= trim(str_replace('/', '', str_replace(' ', '', str_replace('-', '', str_replace(')', '', str_replace('(', '', $phone))))));
    
        //$phoneCode = "^[0-9]{11}$";
    
        //$phoneCode = '/[0-9]{2}[6789][0-9]{3,4}[0-9]{4}/'; // Regex para validar somente celular

        $regexCode = '/[0-9]{2}[6789][0-9]{3,4}[0-9]{4}/'; // Regex para validar somente celular

        if (preg_match($regexCode, $phone)) 
        {
            return $phone;
        }
        else
        {
            throw new \Exception("Telefone inválido");
            return false;
        }
    }

    public function userExist($clause, $userData)
    {
        $sql = "SELECT count(*) as total FROM tb_users WHERE ". $clause . " = :USERDATA";

        $conn = new Sql();
        $results = $conn->select($sql, array(
            ':USERDATA' => $userData
        ));
        

        if ($results[0]["total"] > 0)
        {
            return true; // nome de usuário ou email já existente
        }
        else
        {
            return false;
        }
        
    }

    public function emailValidation($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return true; // email válido
        }
        else
        {
            return false; // email inválido
        }
    }

    // verifica se o usuário está cadastrado e caso esteja envia para o email do usuário o link para atualizar a senha
    public function userEmailRecovery($email, $inadmin = true)
    {
        $sql = "SELECT *
                FROM tb_users a
                INNER JOIN tb_users b USING(iduser)
                WHERE a.usemail = :EMAIL";
        $conn = new Sql();
        $results = $conn->select($sql, array(
            ":EMAIL" => $email
        ));

		if (count($results) === 0)
		{
            throw new \Exception("Usuário não cadastrado");
            return FALSE;
		}
		else
		{
			$data = $results[0];

            $sql = "CALL sp_userspasswordsrecoveries_create(:IDUSER, :DESIP)";

            $results2 = $conn->select($sql, array(
                ":IDUSER"=> $data["iduser"],
                ":DESIP"=> $_SERVER["REMOTE_ADDR"]
            ));

			if (count($results2) === 0)
			{
				throw new \Exception("Não foi possível recuperar a senha");
            }
            
			else
			{
				$dataRecovery = $results2[0];
                var_dump($dataRecovery);
                // cria um código em base64 com o valor de idrecovery
                $iduser = base64_encode($data["iduser"]);
                $selector = base64_encode($dataRecovery['idrecovery']);
                $code = $this->generateCode($data["iduser"]);
				//$code = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, User::SECRET, $dataRecovery["idrecovery"], MCRYPT_MODE_ECB));

				if ($inadmin === true) {
					
					$link = "localhost:8888/admin/forgot-password/reset?code=$code&selector=$selector&iu=$iduser";

				} else {

					$link = "localhost:8888/forgot-password/reset?code=$code&selector=$selector&iu=$iduser";

                }

                // envia por email os dados de reset da senha
				$mailer = new Mailer($data["usemail"], $data["desname"], "Redefinir Senha da CADON", "forgot", array(
					"name"=>$data["desname"],
					"link"=>$link
				));

				return $mailer->send();

				
			}
		}
    }


    /*
    public function userEmailRecovery($email, $inadmin = true)
    {
        $sql = "SELECT *
                FROM tb_users a
                INNER JOIN tb_users b USING(iduser)
                WHERE a.usemail = :EMAIL";
        $conn = new Sql();
        $results = $conn->select($sql, array(
            ":EMAIL" => $email
        ));

		if (count($results) === 0)
		{
            throw new \Exception("Usuário não cadastrado");
            return FALSE;
		}
		else
		{
			$data = $results[0];

            $sql = "CALL sp_userspasswordsrecoveries_create(:IDUSER, :DESIP)";

            $results2 = $conn->select($sql, array(
                ":IDUSER"=> $data["iduser"],
                ":DESIP"=> $_SERVER["REMOTE_ADDR"]
            ));

			if (count($results2) === 0)
			{
				throw new \Exception("Não foi possível recuperar a senha");
            }
            
			else
			{
				$dataRecovery = $results2[0];
                var_dump($dataRecovery);
                // cria um código em base64 com o valor de idrecovery
                $code = base64_encode($dataRecovery['idrecovery'] . '?' . $dataRecovery['dtregister']);
				//$code = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, User::SECRET, $dataRecovery["idrecovery"], MCRYPT_MODE_ECB));

				if ($inadmin === true) {
					
					$link = "localhost:8888/admin/forgot-password/reset?code=$code";

				} else {

					$link = "localhost:8888/forgot-password/reset?code=$code";

                }

                // envia por email os dados de reset da senha
				$mailer = new Mailer($data["usemail"], $data["desname"], "Redefinir Senha da CADON", "forgot", array(
					"name"=>$data["desname"],
					"link"=>$link
				));

				return $mailer->send();

				
			}
		}
    }
    */



    // faz um decriptografia na criptografia para capturar o valor relacionado ao idrecovery
	public static function validForgotDecrypt($code)
	{
        $idrecovery = base64_decode($code);

        $sql = "SELECT * 
                FROM tb_userspasswordsrecoveries a
                INNER JOIN tb_users b USING(iduser)
                WHERE 
                    a.idrecovery = :IDRECOVERY
                    AND
                    a.dtrecovery IS NULL
                    AND
                    DATE_ADD(a.dtregister, INTERVAL 1 HOUR) >= NOW();
                ";

        $conn = new Sql();
        $results = $conn->select($sql, array(
            ":IDRECOVERY" => $idrecovery
        ));

		if (count($results) === 0)
		{
			throw new \Exception("Não foi possível recuperar a senha.");
		}
		else
		{
			return $results[0];
		}
    }

    public function generateCode($iduser)
    {
        $sql = "SELECT uspassword from tb_users
                WHERE iduser = :IDUSER";

        $conn = new Sql();
        $result = $conn->select($sql, array(
            ':IDUSER' => $iduser
        ));
        $result = $result[0]["uspassword"];
        $result .= User::CODE;
        return md5($result);
    }

    // reseta a senha de usuario
    public function resetPassword($uspassword, $iduser)
    {
        $sql = "UPDATE tb_users 
                SET uspassword = :USPASSWORD
                WHERE iduser = :IDUSER";

        $conn = new Sql();
        return $conn->query($sql, array(
            ":USPASSWORD" => $this->getPasswordHash($uspassword),
            ":IDUSER" => $iduser
        ));
    }
}
