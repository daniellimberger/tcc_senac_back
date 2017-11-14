<?php
class login
{
	private $pdo;

    public $login;
    public $senha;

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

	public function ValidaAcesso($login, $senha)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare(
				"SELECT vend.id as vendedor_id, vend.login, vend.senha, vend.tipo as tipo_user, vend.nome, vend.sobrenome FROM vendedor vend
					WHERE login = ?
					AND senha = ?
				");
			$stm->execute(array($login, $senha));

			$count = $stm->rowCount();

			


			if($count > 0){
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}else{
				return "falha_ao_logar";
			}


			//$sql = "SELECT * FROM vendedor WHERE login = '$login' AND senha = '$senha'";
			//return $sql;		


		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}


}