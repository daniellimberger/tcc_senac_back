<?php
class vendedor
{
	private $pdo;


      public $nome;
      public $sobrenome;
      public $rg;
      public $cpf;
      public $telefoneFixo;
      public $telefoneCelular;
      public $endereco;
      public $bairro;
      public $cidade;
      public $cep;
      public $uf;
      public $dataCadastro;
      public $observacao;


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

			$stm = $this->pdo->prepare("SELECT * FROM vendedor ORDER BY nome asc");
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
			$stm = $this->pdo->prepare("SELECT * FROM vendedor WHERE id = ?");
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Deletar($id_deletar)
	{
		try
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM vendedor WHERE id = ?");

			$stm->execute(array($id_deletar));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Editar($data)
	{
		try
		{
			$sql = "UPDATE vendedor SET
						nome = ?,
						sobrenome   = ?,
            			rg          = ?,
            			cpf = ?,
						telefone_fixo = ?,            			
						telefone_celular = ?,						
            			endereco      = ?,
            			bairro        = ?,
            			cidade        = ?,
            			cep           = ?,
            			uf            = ?,
            			data_cadastro = ?,
            			observacao    = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
					$this->nome,
                    $this->sobrenome,
                    $this->rg,
                    $this->cpf,
                    $this->telefoneFixo,
                    $this->telefoneCelular,                    
					$this->endereco,
                    $this->bairro,
                    $this->cidade,
					$this->cep,
                    $this->uf,
					$this->dataCadastro,
                    $this->observacao
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function Cadastrar()	
	{
		try
		{
		$sql = "INSERT INTO vendedor (nome, sobrenome, rg, cpf, telefone_fixo, telefone_celular, endereco, bairro, cidade, cep, uf, data_cadastro, observacao)
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
					$this->nome,
                    $this->sobrenome,
                    $this->rg,
                    $this->cpf,
                    $this->telefoneFixo,
                    $this->telefoneCelular,                    
					$this->endereco,
                    $this->bairro,
                    $this->cidade,
					$this->cep,
                    $this->uf,
					$this->dataCadastro,
                    $this->observacao
                )
			);
		} catch (Exception $e)
		{
			//die($e->getMessage());
			return $sql;
		}
	}
}