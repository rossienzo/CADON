<?php

namespace Src\Application;

class Model {

	private $values = [];

	/**
     * Executado sempre que uma propriedade for atribuída.
     */
    public function __set($prop, $value)
    {
        // verifica se existe método set_<propriedade>
        if (method_exists($this, 'set_'.$prop))
        {
            // executa o método set_<propriedade>
            call_user_func(array($this, 'set_'.$prop), $value);
        }
        else
        {
            if ($value === NULL)
            {
                unset($this->values[$prop]);
            }
            else
            {
                // atribui o valor da propriedade
                $this->values[$prop] = $value;
            }
        }
    }
    
    /**
     * Executado sempre que uma propriedade for requerida
     */
    public function __get($prop)
    {
        // verifica se existe método get_<propriedade>
        if (method_exists($this, 'get_'.$prop))
        {
            // executa o método get_<propriedade>
            return call_user_func(array($this, 'get_'.$prop));
        }
        else
        {
            // retorna o valor da propriedade
            if (isset($this->values[$prop]))
            {
                return $this->values[$prop];
            }
        }
    }

    // faz um set de todos os dados contidos em um array
    //* sempre colocar dados que correspondam com os atributos da classe
	public function setData($data = array())
	{
		foreach ($data as $key => $value) {
			
			$this->{"__set"}($key, $value);
		}

	}

    // retorna todos os dados atribuidos no objeto
	public function getValues()
	{
		return $this->values;
    }


    
}
