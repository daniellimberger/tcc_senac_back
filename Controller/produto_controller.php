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
    $retorno = $produtoController->cadastrar();
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

        $empresa                        = $obj->empresa;
        $valor                          = $obj->valor;

        $prod = new producto();
        // instanciando classe da model

        // inserindo dados no atributo da classe da model $prod->empresa
        $prod->empresa = $empresa;
        $prod->valor = $valor;


        $this->model->Cadastrar($prod);

        return "alguma mensagem";
    }
    
    public function listar_todos(){

       $dados = $this->model->SelectTodos();

       return  json_encode($dados);
    }    

}