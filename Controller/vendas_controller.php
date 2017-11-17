<?php  header('Access-Control-Allow-Origin: *');  

require_once '../Model/database.php';
require_once '../Model/vendas.php';

$vendasController = new VendasController();

$function = $_GET['function'];

switch ( $function ){
  case 'listar_todos_pedido':

    $obj = json_decode(file_get_contents('php://input'));
    $idCliente     = $obj->idCliente;
    $periodoInicio = $obj->periodoInicio;
    $periodoFim    = $obj->periodoFim;

    
    
    $retorno = $vendasController->listar_todos_pedido($idCliente, $periodoInicio, $periodoFim);
    break;


}

echo $retorno;

class VendasController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new vendas();
    }


 
    

    
    public function listar_todos_pedido($idCliente, $periodoInicio, $periodoFim){

       $dados = $this->model->ListarTodosPedido($idCliente, $periodoInicio, $periodoFim);

       return  json_encode($dados);
    }

}