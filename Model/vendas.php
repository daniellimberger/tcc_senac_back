<?php
class vendas
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





	public function ListarTodosPedido($idCliente, $periodoInicio, $periodoFim)
	{
		try
		{
			$result = array();

			if($idCliente){
				$where_cliente = "AND ped.fk_cliente = '$idCliente'";
			}else{
				$where_cliente = "";
			}

			if($periodoInicio and $periodoFim){
				$where_periodo = "AND ped.data_pedido BETWEEN '$periodoInicio' AND '$periodoFim'";
			}else{
				$where_periodo = "";
			}




			$stm = $this->pdo->prepare("SELECT prod.nome AS produto, SUM(pi.quantidade) AS qtd_vendido FROM pedido ped 
										INNER JOIN pedido_item pi on ped.id = pi.id_pedido 
										INNER JOIN produto prod on pi.id_produto = prod.id 
										WHERE 1 = 1 
										$where_cliente
										$where_periodo
										GROUP BY prod.id 
										ORDER BY qtd_vendido DESC
									   ");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

}	