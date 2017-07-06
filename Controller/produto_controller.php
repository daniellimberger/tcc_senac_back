<?php  header('Access-Control-Allow-Origin: *');  

require_once '../Model/database.php';
require_once '../Model/produto.php';

$produtoController = new ProdutoController();

$function = $_GET['function'];

switch ( $function ){
  case 'listar_todos':
    $retorno = $produtoController->listar_todos();
    break;
  case 'cadastrar':
   // $dados = $_GET['dados'];
    $retorno = $produtoController->cadastrar();
    echo $retorno;
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

        // inserindo dados no atributo da classe da model $prod->empresa
        $prod->nome = $nome;
        $prod->marca = $marca;
        $prod->valor = $valor;


        $prod->Cadastrar();

    }
    
    public function listar_todos(){

       $dados = $this->model->ListarTodos();

       return  json_encode($dados);
    }    

}