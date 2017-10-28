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
  case 'editar':
    $retorno = $produtoController->editar();
    return $retorno;  
    break; 
  case 'listar_um':
    $id_listar = $_GET['id_listar'];
    $retorno = $produtoController->listar_um($id_listar);

    break;

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

    public function editar(){

        $obj = json_decode(file_get_contents('php://input'));

        $nome    = $obj->nome;
        $marca   = $obj->marca;
        $valor   = $obj->valor;
        $id_editar     = $obj->id_editar;
        

        $prod = new produto();
        // instanciando classe da model

        // inserindo dados no atributo da classe da model
        $prod->nome = $nome;
        $prod->marca = $marca;
        $prod->valor = $valor;
        $prod->id_editar = $id_editar;

        $prod->Editar($id_editar);

        return $prod;

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

    public function listar_um($id_listar){

       $dados = $this->model->ListarUm($id_listar);

       return  json_encode($dados);

    }          

}