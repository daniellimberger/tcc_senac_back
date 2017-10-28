<?php  header('Access-Control-Allow-Origin: *');  

require_once '../Model/database.php';
require_once '../Model/cliente.php';

$clienteController = new ClienteController();

$function = $_GET['function'];

// usar switch melhora a performance pois o sistema nao entra em todas as possibilidades, diferente do if
switch ( $function ){
  case 'listar_todos':
    $retorno = $clienteController->listar_todos();
    break;
  case 'cadastrar':
    $retorno = $clienteController->cadastrar();
    echo $retorno;
    break;
  case 'deletar':
    $retorno = $clienteController->deletar();
    echo $retorno;  
    break;
  case 'editar':
    $retorno = $clienteController->editar();
    return $retorno;  
    break;    
  case 'listar_um':
    $id_listar = $_GET['id_listar'];
    $retorno = $clienteController->listar_um($id_listar);

    break;
}

echo $retorno;

class ClienteController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new cliente();
    }


    public function cadastrar(){

        $obj = json_decode(file_get_contents('php://input'));

        $nomeFantasia  = $obj->nomeFantasia;
        $razaoSocial   = $obj->razaoSocial;
        $cnpj          = $obj->cnpj;
        $inscEstadual  = $obj->inscEstadual;
        $endereco      = $obj->endereco;
        $bairro        = $obj->bairro;
        $cidade        = $obj->cidade;
        $cep           = $obj->cep;
        $uf            = $obj->uf;
        $telefoneFixo  = $obj->telefoneFixo;             
        $dataCadastro  = $obj->dataCadastro;
        $dataCadastroExtendida  = $obj->dataCadastroExtendida;
        $observacao    = $obj->observacao;


        $cli = new cliente();
        // instanciando classe da model

        // inserindo dados no atributo da classe da model
        $cli->nomeFantasia = $nomeFantasia;
        $cli->razaoSocial = $razaoSocial;
        $cli->cnpj = $cnpj;
        $cli->inscEstadual = $inscEstadual;
        $cli->endereco = $endereco;
        $cli->bairro = $bairro;
        $cli->cidade = $cidade; 
        $cli->cep = $cep;
        $cli->uf = $uf;
        $cli->telefoneFixo = $telefoneFixo;
        $cli->dataCadastro = $dataCadastro; 
        $cli->dataCadastroExtendida = $dataCadastroExtendida;
        $cli->observacao = $observacao;



        $cli->Cadastrar();

        return $cli;

    }



    public function editar(){

        $obj = json_decode(file_get_contents('php://input'));

        $nomeFantasia  = $obj->nomeFantasia;
        $razaoSocial   = $obj->razaoSocial;
        $cnpj          = $obj->cnpj;
        $inscEstadual  = $obj->inscEstadual;
        $endereco      = $obj->endereco;
        $bairro        = $obj->bairro;
        $cidade        = $obj->cidade;
        $cep           = $obj->cep;
        $uf            = $obj->uf;
        $telefoneFixo  = $obj->telefoneFixo;             
        $dataCadastro  = $obj->dataCadastro;
        $dataCadastroExtendida  = $obj->dataCadastroExtendida;
        $observacao    = $obj->observacao;
        $id_editar     = $obj->id_editar;



        $cli = new cliente();
        // instanciando classe da model

        // inserindo dados no atributo da classe da model
        $cli->nomeFantasia = $nomeFantasia;
        $cli->razaoSocial = $razaoSocial;
        $cli->cnpj = $cnpj;
        $cli->inscEstadual = $inscEstadual;
        $cli->endereco = $endereco;
        $cli->bairro = $bairro;
        $cli->cidade = $cidade; 
        $cli->cep = $cep;
        $cli->uf = $uf;
        $cli->telefoneFixo = $telefoneFixo;
        $cli->dataCadastro = $dataCadastro; 
        $cli->dataCadastroExtendida = $dataCadastroExtendida;
        $cli->observacao = $observacao;



        $cli->Editar($id_editar);

        return $cli;

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