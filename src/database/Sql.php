<?php 

namespace Src\Database;

class Sql {

	private $conn;

    /**
     * Faz a conexão com BD no momento da instância do objeto 
     * @param $name nome da configuração com o BD
     */
	public function __construct($name = 'config')
	{
        $this->conn = Connection::open($name);
	}

    /**
     * Faz a stagem do statement e em seguida vincula o parâmetro ao nome da variável
     */
	private function setParams($statement, $parameters = array())
	{
        foreach ($parameters as $key => $value) 
        {
			$this->bindParam($statement, $key, $value);
		}
	}

    /**
     * Vincula o parâmetro ao nome da variável pelo uso da função 
     * PDOStatement::bindParam(mixed $param, mixed $variable)
     */
	private function bindParam($statement, $key, $value)
	{
		$statement->bindParam($key, $value);
	}

    // Função que executa comandos como INSERT, UPDATE e DELETE 
	public function query($rawQuery, $params = array())
	{
		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		return $stmt->execute(); // retorna o estado BOOL
	}

    // Função que retorna dados do BD como SELECT
	public function select($rawQuery, $params = array()):array // define que o retorno será um array
	{
		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

}

 ?>