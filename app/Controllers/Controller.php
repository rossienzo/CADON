<?php

namespace App\Controllers;

use Rain\Tpl;

class Controller
{
    private $tpl;

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
    


    public function userAuthValidation()
    {
        session_start();
        if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['name']) || $_SESSION['name'] == '') 
        {
			header('Location: /');
		}
    }

}