<?php  header('Access-Control-Allow-Origin: *');  

$function = $_GET['function'];

$pedidoController = new PedidoController();

$retorno = $pedidoController->enviar_pedido();

class PedidoController{

  public function enviar_pedido(){

    $obj = json_decode(file_get_contents('php://input'));

    $html_pedido = $obj->html_pedido;   

    $headers = "MIME-Version: 1.1\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: greffdistribuidora@ligiano.info\r\n"; // remetente
    $headers .= "Return-Path: greffdistribuidora@ligiano.info\r\n"; // return-path
    $send = mail("greffdistribuidora@gmail.com", "SisDis - Pedido via sistema", $html_pedido, $headers);

    if ( $send ){

      $retorno = "Pedido fechado - Um email foi disparado ao setor de estoque.";

    }else{

      $retorno = "Falha na operação.";

    }

    echo  $retorno;

  }

}