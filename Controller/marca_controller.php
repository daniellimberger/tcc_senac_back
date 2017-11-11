<?php  header('Access-Control-Allow-Origin: *');  

require_once '../Model/database.php';
require_once '../Model/marca.php';

$marcaController = new MarcaController();

$function = $_GET['function'];

switch ( $function ){
  case 'listar_todos':
    $retorno = $marcaController->listar_todos();
    break;
  case 'cadastrar_marca':
    $retorno = $marcaController->cadastrar();
    echo $retorno;
    break;    
}
echo $retorno;



class MarcaController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new marca();
    }


    public function listar_todos(){

       $dados = $this->model->ListarTodos();

       return  json_encode($dados);
    }    


    public function cadastrar(){

        $obj = json_decode(file_get_contents('php://input'));

        $nome = $obj->nome;

        $marca = new marca();
        // instanciando classe da model

        // inserindo dados no atributo da classe da model
        $marca->nome = $nome;

        $marca->Cadastrar();

    }


}