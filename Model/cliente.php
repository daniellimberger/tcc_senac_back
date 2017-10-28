<?php
class cliente
{
	private $pdo;

	public $nomeFantasia;
	public $razaoSocial;
	public $cnpj;
	public $inscEstadual;
	public $endereco;
	public $bairro;
	public $cidade;
	public $cep;
	public $uf;
	public $telefoneFixo;             
	public $dataCadastro;
	public $dataCadastroExtendida;	
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

			$stm = $this->pdo->prepare("SELECT * FROM cliente ORDER BY nome_fantasia asc");
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
			$stm = $this->pdo->prepare("SELECT id as id_cliente, cliente.* FROM cliente WHERE id = ?");
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
			            ->prepare("DELETE FROM cliente WHERE id = ?");

			$stm->execute(array($id_deletar));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Editar($id_editar)
	{
		try
		{
			$sql = "UPDATE cliente SET
						nome_fantasia = ?,
						razao_social   = ?,
            			cnpj          = ?,
            			insc_estadual = ?,
            			endereco      = ?,
            			bairro        = ?,
            			cidade        = ?,
            			cep           = ?,
            			uf            = ?,
            			telefone_fixo = ?,
            			data_cadastro = ?,
            			data_cadastro_extendida = ?,            			
            			observacao    = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $this->nomeFantasia,
                        $this->razaoSocial,
                        $this->cnpj,
						$this->inscEstadual,
						$this->endereco,
						$this->bairro,
						$this->cidade,
						$this->cep,
						$this->uf,
						$this->telefoneFixo,
						$this->dataCadastro,
						$this->dataCadastroExtendida,
						$this->observacao,
						$id_editar
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
		$sql = "INSERT INTO cliente (nome_fantasia, razao_social, cnpj, insc_estadual, endereco, bairro, cidade, cep, uf, telefone_fixo, data_cadastro, data_cadastro_extendida, observacao)
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
					$this->nomeFantasia,
                    $this->razaoSocial,
                    $this->cnpj,
                    $this->inscEstadual,
					$this->endereco,
                    $this->bairro,
                    $this->cidade,
					$this->cep,
                    $this->uf,
                    $this->telefoneFixo,
					$this->dataCadastro,
					$this->dataCadastroExtendida,					
                    $this->observacao
                )
			);
		} catch (Exception $e)
		{
			return $sql;
		}
	}
}