<?php

namespace App\Controllers;

use Rain\Tpl;
use App\Models\User;

class Controller
{
	private $tpl;
	private $view;

    /** RainTpl
     * @param mixed $view nome do arquivo template
     * @param mixed $toString retorna o template como string
     */

    public function __construct()
    {
        $this->tpl = new Tpl();
    }

    public function drawView($view, $toString = NULL)
    {
        // configuração do RainTPL
        $config = array(
        "tpl_dir"       => "../templates/Views/",
        "cache_dir"     => "../cache/",
        "debug"         => false, // Deixar falso acelera a velocidade
        );

        // aplica a configuração
        Tpl::configure($config);

        // faz o request do template e o exibe
        $this->tpl->draw($view, $toString);

    }

    // envia parâmetros para as views
    public function assignValues($variable, $value)
    {
        $this->tpl->assign($variable, $value);
    }

    /**
     * Verifica se existe algum usuario salvo na sessão
     */
	
	public function setView($data)
    {
        foreach ($data as $key => $value) {
			
			$this->{"__set"}($key, $value);
		}

    }
	 
    public function userLogin($login, $password)
    {
		try
		{
			$user = new User();
			$user->login($login, $password);
		}
		catch (\Exception $e)
		{
			Controller::setError($e->getMessage());
		}
    }

    public static function verifyLogin($usstatus = true)
	{
        if (!Controller::checkLogin($usstatus)) {

			if ($usstatus) {
				header("Location: /admin/login");
			} else {
				header("Location: /login");
			}
			exit;
		}
	}
	
	public function getFromSession()
	{
		return $_SESSION["User"];
	}
    
    public static function checkLogin($usstatus = true)
	{
        if (
			!isset($_SESSION[User::SESSION])
			||
			!$_SESSION[User::SESSION]
			||
			!(int)$_SESSION[User::SESSION]["iduser"] > 0
		) {
			//Não está logado
			return false;

		} else {

			if ($usstatus === true && $_SESSION[User::SESSION]['usstatus'] === '2') {

				return true;

			} else if ($usstatus === false) {

				return true;

			} else {
                        
				return false;

			}
		}

    }
    
    public static function logout()
	{
        $_SESSION[User::SESSION] = NULL;
        session_destroy();
	}
    

    public function userAuthValidation()
    {
        session_start();
        if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['name']) || $_SESSION['name'] == '') 
        {
			header('Location: /');
		}
    }


    /************************************************
     * ******* Início - Tratamento de erros *********
     * **********************************************
     */
    public static function setError($msg)
	{

		$_SESSION[User::ERROR] = $msg;

	}

	public static function getError()
	{

		$msg = (isset($_SESSION[User::ERROR]) && $_SESSION[User::ERROR]) ? $_SESSION[User::ERROR] : '';

		Controller::clearError();

		return $msg;

	}

	public static function clearError()
	{

		$_SESSION[User::ERROR] = NULL;

	}

	public static function setSuccess($msg)
	{

		$_SESSION[User::SUCCESS] = $msg;

	}

	public static function getSuccess()
	{

		$msg = (isset($_SESSION[User::SUCCESS]) && $_SESSION[User::SUCCESS]) ? $_SESSION[User::SUCCESS] : '';

		Controller::clearSuccess();

		return $msg;

	}

	public static function clearSuccess()
	{

		$_SESSION[User::SUCCESS] = NULL;

	}

	public static function setErrorRegister($msg)
	{

		$_SESSION[User::ERROR_REGISTER] = $msg;

	}

	public static function getErrorRegister()
	{

		$msg = (isset($_SESSION[User::ERROR_REGISTER]) && $_SESSION[User::ERROR_REGISTER]) ? $_SESSION[User::ERROR_REGISTER] : '';

		Controller::clearErrorRegister();

		return $msg;

	}

	public static function clearErrorRegister()
	{

		$_SESSION[User::ERROR_REGISTER] = NULL;

    }

    /************************************************
     * ******* Fim - Tratamento de erros *********
     * **********************************************
     */

}