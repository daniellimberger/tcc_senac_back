<?php  header('Access-Control-Allow-Origin: *');  

require_once '../Model/database.php';
require_once '../Model/login.php';

$loginController = new LoginController();

$function = $_GET['function'];

switch ( $function ){
  case 'valida_acesso':
    $retorno = $loginController->valida_acesso();
    break;
}
echo $retorno;



class LoginController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new login();
    }


    public function valida_acesso(){

        $obj = json_decode(file_get_contents('php://input'));

        $login = $obj->login;
        $senha = $obj->senha;


       $dados = $this->model->ValidaAcesso($login, $senha);

       return  json_encode($dados);
    }    

}