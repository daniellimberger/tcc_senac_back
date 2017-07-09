<?php
class marca
{
	private $pdo;

    public $id;
    public $nome;

	public function __CONSTRUCT()
	{
		try
		{	// do arquivo model/database.php
			// este arquivo está incluso no controller
			$this->pdo = Database::Conectar();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListarTodos()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT id as id_marca, nome as nome_marca FROM produto_marca");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}


}