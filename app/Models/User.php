<?php

namespace App\Models;

use Src\Database\Connection;
use Src\Application\Mailer;

class User
{
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
    
    const SESSION = "User";
	const SECRET = "Secret_code";

    public function __set($attrib, $value)
    {
        return $this->$attrib = $value;
    }

    public function __get($attrib)
    {
        return $this->$attrib;
    }

    // Seleciona todos os usuários menos o usuário logado
    public function selectDifferenceOfLoggedUser($id)
    {
        $sql = "SELECT * FROM tb_users WHERE iduser != :IDUSER";
        
        $conn = Connection::open('config');
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':IDUSER', $id);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $results;
    }

    public function listAll($id)
    {
        $sql = "SELECT * FROM tb_users WHERE iduser = :ID";
        
        $conn = Connection::open('config');
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ID', $id);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $results[0];
    }

    public function insert()
    {
        $sql = 'INSERT INTO tb_users (desname, deslastname, usphone, usaddress, ususername, usemail, uspassword, usstatus)
                VALUES (:DESNAME, :DESLASTNAME, :USPHONE, :USADDRESS, :USUSERNAME, :USEMAIL, :USPASSWORD, :USSTATUS)';
        try
        {
            
            $name = $this->__get('name');
            $lastname = $this->__get('lastname');
            $phone = $this->__get('phone');
            $address = $this->__get('address');
            $username = $this->__get('username');
            $email = $this->__get('email');
            $password = $this->__get('password');
            $status = $this->__get('status');
            
            $conn = Connection::open('config');
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':DESNAME', $name);
            $stmt->bindParam(':DESLASTNAME', $lastname);
            $stmt->bindParam(':USPHONE', $phone);
            $stmt->bindParam(':USADDRESS', $address);
            $stmt->bindParam(':USUSERNAME', $username);
            $stmt->bindParam(':USEMAIL', $email);
            $stmt->bindParam(':USPASSWORD', $password);
            $stmt->bindParam(':USSTATUS', $status);

            $stmt->execute();
        }
        catch (\PDOException $e)
        {
            $e->getMessage();
        }

    }
    
    // Conta a quantidade de itens em uma determinada tabela
    // Classes que a utilizam
    // - Image
    public function countAll($tb_name, $id)
    {
        $sql = "SELECT count(*) as count FROM " . $tb_name . " WHERE iduser = :ID";
        
        $conn = Connection::open('config');
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ID', $id);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $results[0];
    }

    /**
     * Faz o update de um índice da coluna
     */
    public function updateIndex($id, $column, $index)
    {
        $sql = "UPDATE tb_users SET $column = :INDEX 
        WHERE iduser = :ID";
        
        $conn = Connection::open('config');
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':INDEX', $index);
        $stmt->bindParam(':ID', $id);        
        $stmt->execute();
    }

    

    /**
     * Verifica se o username e a senha está vinculado a um usuario real
     */
    public function userExist($email, $password)
    {
        $sql = "SELECT * FROM tb_users WHERE usemail = :USERNAME AND uspassword = :PASSWORD";

        $conn = Connection::open('config');
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':USERNAME', $email);
        $stmt->bindParam(':PASSWORD', $password);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result[0];

    }

    // verifica se o usuário está cadastrado e caso esteja envia para o email do usuário o link para atualizar a senha
    public function userEmailRecovery($email, $inadmin = true)
    {
        $conn = Connection::open('config');

        $sql = "SELECT *
                FROM tb_users a
                INNER JOIN tb_users b USING(iduser)
                WHERE a.usemail = :EMAIL";

		$stmt =$conn->prepare($sql);
        $stmt->bindParam(":EMAIL", $email);
        $stmt->execute();

        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		if (count($results) === 0)
		{
            //throw new \Exception("Não foi possível recuperar a senha.");
            return FALSE;
		}
		else
		{
			$data = $results[0];

            $sql = "CALL sp_userspasswordsrecoveries_create(:IDUSER, :DESIP)";

            $stmt =$conn->prepare($sql);
            $stmt->bindParam(":IDUSER", $data["iduser"]);
            $stmt->bindParam(":DESIP", $_SERVER["REMOTE_ADDR"]);
            $stmt->execute();

            $results2 = $stmt->fetchAll(\PDO::FETCH_ASSOC);

			if (count($results2) === 0)
			{
				throw new \Exception("Não foi possível recuperar a senha");
            }
            
			else
			{
				$dataRecovery = $results2[0];
                
                // cria um código em base64 com o valor de idrecovery
                $code = base64_encode($dataRecovery['idrecovery']);
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

				$mailer->send();

				return $data;
			}
		}
    }

    // faz um decriptografia na criptografia para capturar o valor relacionado ao idrecovery
	public static function validForgotDecrypt($code)
	{

		$idrecovery = base64_decode($code);
		$conn = Connection::open('config');
        $sql = "SELECT * 
                FROM tb_userspasswordsrecoveries a
                INNER JOIN tb_users b USING(iduser)
                WHERE 
                    a.idrecovery = :IDRECOVERY
                    AND
                    a.dtrecovery IS NULL
                    AND
                    DATE_ADD(a.dtregister, INTERVAL 1 HOUR) >= NOW();";

        $stmt =$conn->prepare($sql);
        $stmt->bindParam(":IDRECOVERY", $idrecovery);
        $stmt->execute();

        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		if (count($results) === 0)
		{
			throw new \Exception("Não foi possível recuperar a senha.");
		}
		else
		{
            
			return $results[0];
		}

    }
    
    // reseta a senha de usuario
    public function resetPassword($uspassword, $iduser)
    {
        $conn = Connection::open('config');
        $sql = "UPDATE tb_users 
                SET uspassword = :USPASSWORD
                WHERE iduser = :IDUSER";

        $stmt =$conn->prepare($sql);
        $stmt->bindParam(":USPASSWORD", $uspassword);
        $stmt->bindParam(":IDUSER", $iduser);
        $stmt->execute();
    }
    
}