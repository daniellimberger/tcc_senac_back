<?php
class pedido
{
	private $pdo;

	public $idCliente;
	public $idVendedor;
	public $dataPedido;
	public $dataPrevisaoEntrega;
	public $valorTotal;
	

    public $item_nro_pedido;
	public $item_idProduto;
    public $item_qtdItem;
    public $item_valorUnit;
    public $item_valorUnitTotal;


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




	public function Cadastrar()	
	{
		try
		{
		$sql = "INSERT INTO pedido (fk_cliente, fk_vendedor, data_pedido, data_previsao_entrega, valor_total)
		        VALUES (?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $this->idCliente,
					$this->idVendedor,
                    $this->dataPedido,
                    $this->dataPrevisaoEntrega,                    
                    $this->valorTotal
                )
			);
		
			$last_id = $this->pdo->lastInsertId();
			//return $last_id;
			echo $last_id;


		} catch (Exception $e)		
		{
			die($e->getMessage());
		}
	}


	public function CadastrarItem()	
	{
		try
		{
		$sql = "INSERT INTO pedido_item (id_pedido, id_produto, quantidade, valor_unitario, valor_unitario_total)
		        VALUES (?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $this->item_nro_pedido,
					$this->item_idProduto,
                    $this->item_qtdItem,
                    $this->item_valorUnit,                    
                    $this->item_valorUnitTotal
                )
			);

	
			$last_id = $this->pdo->lastInsertId();
			echo $last_id;


		} catch (Exception $e)		
		{
			die($e->getMessage());
		}
	}







	public function ListarTodosPedido()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT p.id AS pedido_id, c.nome_fantasia AS cliente_nome, v.nome AS vendedor_nome, p.data_pedido AS pedido_datapedido, p.data_previsao_entrega AS pedido_dataprevisaoentrega, p.valor_total AS pedido_valortotal FROM pedido p
										INNER JOIN cliente c ON c.id = p.fk_cliente
										INNER JOIN vendedor v ON v.id = p.fk_vendedor");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}










	public function ListarTodos_PedidoItem($nro_pedido)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT pi.id as pi_id,
										p.nome as item_produto, 
										pi.quantidade as item_quantidade, 
										pi.valor_unitario as item_valor_unitario, 
										pi.valor_unitario_total as item_valor_unitario_total 
										FROM pedido_item pi
										INNER JOIN produto p ON pi.id_produto = p.id
										WHERE pi.id_pedido = '$nro_pedido'


				");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function DeletarPedidoItem($id_deletar)
	{
		try
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM pedido_item WHERE id = ?");

			$stm->execute(array($id_deletar));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}		
		

















}	