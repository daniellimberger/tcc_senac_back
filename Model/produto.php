<?php
class produto
{
	private $pdo;

    public $id;
    public $nome;
    public $marca;
    public $valor;

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

	public function SelectTodos()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT p.nome as nome_produto, pm.nome as nome_marca, p.valor as valor_produto FROM produto p
										INNER JOIN produto_marca pm ON pm.id = p.fk_marca
										");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListarUm($id)
	{
		try
		{
			$stm = $this->pdo->prepare("SELECT * FROM produto WHERE id = ?");
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Deletar($id)
	{
		try
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM produco WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Editar($data)
	{
		try
		{
			$sql = "UPDATE produto SET
						nome         = ?,
						marca        = ?,
            			valor        = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->nome,
                        $data->marca,
                        $data->valor
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Cadastrar(produto $data)
	{
		try
		{
		$sql = "INSERT INTO produto (nome, marca, valor)
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
					$data->nome,
                    $data->marca,
                    $data->valor
                )
			);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}