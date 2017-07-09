<?php  header('Access-Control-Allow-Origin: *');  

require_once '../Model/database.php';
require_once '../Model/marca.php';

$marcaController = new MarcaController();

$function = $_GET['function'];

switch ( $function ){
  case 'listar_todos':
    $retorno = $marcaController->listar_todos();
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

}