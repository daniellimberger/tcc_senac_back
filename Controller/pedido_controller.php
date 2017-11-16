<?php  header('Access-Control-Allow-Origin: *');  

require_once '../Model/database.php';
require_once '../Model/pedido.php';

$pedidoController = new PedidoController();

$function = $_GET['function'];

switch ( $function ){
  case 'listar_todos_pedido':


    $obj = json_decode(file_get_contents('php://input'));
    $idVendedor = $obj->idVendedor;
    $tipoUser = $obj->tipoUser;

    
    
    $retorno = $pedidoController->listar_todos_pedido($idVendedor, $tipoUser);
    break;

  case 'listar_todos_pedidoItem':

    $retorno = $pedidoController->listar_todos_pedidoItem();

    break;

  case 'deletar_pedido_item':
    $retorno = $pedidoController->deletar_pedido_item();
    break;



  case 'cadastrar':
    $retorno = $pedidoController->cadastrar();
    echo $retorno;
    break;

  case 'cadastrar_item':
    $retorno = $pedidoController->cadastrar_item();
    echo $retorno;
    break;
  case 'deletar':
    $retorno = $pedidoController->deletar();
    echo $retorno;  
    break;
  case 'listar_um':
    $id_listar = $_GET['id_listar'];
    $retorno = $pedidoController->listar_um($id_listar);
   //echo $retorno;  
   // echo $id_listar;
    break;
  case 'enviar_pedido':
    $retorno = $pedidoController->enviar_pedido();
    echo $retorno;  
    break;    




}

echo $retorno;

class PedidoController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new pedido();
    }


    public function cadastrar(){

        $obj = json_decode(file_get_contents('php://input'));

        $idCliente  = $obj->idCliente;
        $idVendedor = $obj->idVendedor;
        $dataPedido = $obj->dataPedido;
        $dataPrevisaoEntrega  = $obj->dataPrevisaoEntrega;
        $valorTotal = $obj->valorTotal;
  

        $pedido = new pedido();
        // instanciando classe da model

        // inserindo dados no atributo da classe da model
        $pedido->idCliente = $idCliente;
        $pedido->idVendedor = $idVendedor;
        $pedido->dataPedido = $dataPedido;
        $pedido->dataPrevisaoEntrega = $dataPrevisaoEntrega;
        $pedido->valorTotal = $valorTotal;

        $return = $pedido->Cadastrar();

        echo $return;

    }
    



    public function cadastrar_item(){

        $obj = json_decode(file_get_contents('php://input'));

        $nro_pedido     = $obj->nro_pedido;
        $idProduto      = $obj->idProduto;
        $qtdItem        = $obj->qtdItem;
        $valorUnit      = $obj->valorUnit;
        $valorUnitTotal = $obj->valorUnitTotal;
  

        $pedido = new pedido();
        // instanciando classe da model

        // inserindo dados no atributo da classe da model
        $pedido->item_nro_pedido = $nro_pedido;
        $pedido->item_idProduto = $idProduto;
        $pedido->item_qtdItem = $qtdItem;
        $pedido->item_valorUnit = $valorUnit;
        $pedido->item_valorUnitTotal = $valorUnitTotal;

        $return = $pedido->CadastrarItem();

        echo $return;

        

    }    

    public function deletar_pedido_item(){

        $obj = json_decode(file_get_contents('php://input'));

         $id_deletar          = $obj->id_deletar;      

       $dados = $this->model->DeletarPedidoItem($id_deletar);

       return  json_encode($id_deletar);
    }   

    
    public function listar_todos_pedido($idVendedor, $tipoUser){

       $dados = $this->model->ListarTodosPedido($idVendedor, $tipoUser);

       return  json_encode($dados);
    }    


    public function listar_todos_pedidoItem(){
      $obj = json_decode(file_get_contents('php://input'));

      $nro_pedido  = $obj->nro_pedido;

      $dados = $this->model->ListarTodos_PedidoItem($nro_pedido);

      return  json_encode($dados);
    }       


    public function deletar(){

        $obj = json_decode(file_get_contents('php://input'));

         $id_deletar          = $obj->id_deletar;      

       $dados = $this->model->Deletar($id_deletar);

       return  json_encode($dados);
    }

    public function listar_um($id_listar){


       $dados = $this->model->ListarUm($id_listar);

       return  json_encode($dados);

    }                


    public function enviar_pedido(){

        $obj = json_decode(file_get_contents('php://input'));

       // $html_pedido = $obj->html_pedido;   
       
         $html_pedido = "<b> oioi </b>";  

/*
$headers = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
$headers .= "From: ligiano@ligiano.info\r\n"; // remetente
$headers .= "Return-Path: ligiano@ligiano.info\r\n"; // return-path
$retorno = mail("ldaazzi@gmail.com", "Assunto", "Texto", $headers);
*/

$message = "Testando outros remetentes, para facilitar a resposta";
$headers = 'From: ligiano@ligiano.info';// <- O e-mail que está configurado no .htaccess
$headers = 'Date:'.date('r');

if ( mail('ldaazzi@gmail.com', 'Teste', $message, $headers) ){

   $retorno = "Funcionou";

}else{

$retorno = "nao Funcionou";

}
 

        return  json_encode($retorno);

    }


}