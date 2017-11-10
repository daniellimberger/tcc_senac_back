<?php  header('Access-Control-Allow-Origin: *');  

require_once '../Model/database.php';
require_once '../Model/vendedor.php';

$vendedorController = new VendedorController();

$function = $_GET['function'];

// usar switch melhora a performance pois o sistema nao entra em todas as possibilidades, diferente do if
switch ( $function ){
  case 'listar_todos':
    $retorno = $vendedorController->listar_todos();
    break;
  case 'cadastrar':
    $retorno = $vendedorController->cadastrar();
    echo $retorno;
    break;
   case 'deletar':
    $retorno = $vendedorController->deletar();
    echo $retorno;   
  case 'editar':
    $retorno = $vendedorController->editar();
    return $retorno;  
    break;        
    case 'listar_um':
    $id_listar = $_GET['id_listar'];
    $retorno = $vendedorController->listar_um($id_listar);
    break;    
}

echo $retorno;

class VendedorController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new vendedor();
    }


    public function cadastrar(){

        $obj = json_decode(file_get_contents('php://input'));

        $nome             = $obj->nome;
        $sobrenome        = $obj->sobrenome;
        $rg               = $obj->rg;
        $cpf              = $obj->cpf;
        $telefoneFixo     = $obj->telefoneFixo;             
        $telefoneCelular  = $obj->telefoneCelular;
        $endereco         = $obj->endereco;
        $bairro           = $obj->bairro;
        $cidade           = $obj->cidade;
        $cep              = $obj->cep;
        $uf               = $obj->uf;
        $dataCadastro     = $obj->dataCadastro;
        $tipo             = $obj->tipo;
        $login            = $obj->login;
        $senha            = $obj->senha;
        $observacao       = $obj->observacao;


        $vend = new vendedor();
        // instanciando classe da model

        // inserindo dados no atributo da classe da model
        $vend->nome = $nome;
        $vend->sobrenome = $sobrenome;
        $vend->rg = $rg;
        $vend->cpf = $cpf;
        $vend->telefoneFixo = $telefoneFixo;
        $vend->telefoneCelular = $telefoneCelular;
        $vend->endereco = $endereco;
        $vend->bairro = $bairro;
        $vend->cidade = $cidade; 
        $vend->cep = $cep;
        $vend->uf = $uf;
        $vend->dataCadastro = $dataCadastro; 
        $vend->tipo = $tipo;
        $vend->login = $login;
        $vend->senha = $senha;
        $vend->observacao = $observacao;         



        $vend->Cadastrar();

        return $vend;

    }
    



    public function editar(){

        $obj = json_decode(file_get_contents('php://input'));



        $nome             = $obj->nome;
        $sobrenome        = $obj->sobrenome;
        $rg               = $obj->rg;
        $cpf              = $obj->cpf;
        $telefoneFixo     = $obj->telefoneFixo;             
        $telefoneCelular  = $obj->telefoneCelular;
        $endereco         = $obj->endereco;
        $bairro           = $obj->bairro;
        $cidade           = $obj->cidade;
        $cep              = $obj->cep;
        $uf               = $obj->uf;
        $dataCadastro     = $obj->dataCadastro;
        $tipo             = $obj->tipo;
        $login            = $obj->login;
        $senha            = $obj->senha;
        $observacao       = $obj->observacao;
        $id_editar        = $obj->id_editar;

        $vend = new vendedor();
        // instanciando classe da model

        // inserindo dados no atributo da classe da model
        $vend->nome = $nome;
        $vend->sobrenome = $sobrenome;
        $vend->rg = $rg;
        $vend->cpf = $cpf;
        $vend->telefoneFixo = $telefoneFixo;
        $vend->telefoneCelular = $telefoneCelular;
        $vend->endereco = $endereco;
        $vend->bairro = $bairro;
        $vend->cidade = $cidade; 
        $vend->cep = $cep;
        $vend->uf = $uf;
        $vend->dataCadastro = $dataCadastro; 
        $vend->tipo = $tipo;
        $vend->login = $login;
        $vend->senha = $senha;
        $vend->observacao = $observacao;     

        $vend->Editar($id_editar);

        return $vend;

    }



    public function listar_todos(){

       $dados = $this->model->ListarTodos();

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