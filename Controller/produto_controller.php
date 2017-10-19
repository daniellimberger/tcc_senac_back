<?php  header('Access-Control-Allow-Origin: *');  

require_once '../Model/database.php';
require_once '../Model/produto.php';

$produtoController = new ProdutoController();

$function = $_GET['function'];

// usar switch melhora a performance pois o sistema nao entra em todas as possibilidades, diferente do if
switch ( $function ){
  case 'listar_todos_pedido':
    $retorno = $produtoController->listar_todos_pedido();
    break;
  case 'listar_todos':
    $retorno = $produtoController->listar_todos();
    break;
  case 'cadastrar':
    $retorno = $produtoController->cadastrar();
    echo $retorno;
    break;
   case 'deletar':
    $retorno = $produtoController->deletar();
    echo $retorno;   
}
echo $retorno;

class ProdutoController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new produto();
    }


    public function cadastrar(){

        $obj = json_decode(file_get_contents('php://input'));

         $nome                          = $obj->nome;
        $marca                          = $obj->marca;
        $valor                          = $obj->valor;

        $prod = new produto();
        // instanciando classe da model

        // inserindo dados no atributo da classe da model
        $prod->nome = $nome;
        $prod->marca = $marca;
        $prod->valor = $valor;


        $prod->Cadastrar();

    }
    
    public function listar_todos(){

       $dados = $this->model->ListarTodos();

       return  json_encode($dados);
    }    

    public function listar_todos_pedido(){

       $dados = $this->model->ListarTodosPedido();

       return  json_encode($dados);
    }        

    public function deletar(){

        $obj = json_decode(file_get_contents('php://input'));

         $id_deletar          = $obj->id_deletar;      

       $dados = $this->model->Deletar($id_deletar);

       return  json_encode($dados);
    }        

}