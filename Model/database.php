<?php
class Database
{

    public static function Conectar()
    {
        $pdo = new PDO('mysql:host=mysql02-farm70.uni5.net;dbname=tccdaniel;charset=utf8', 'tccdaniel', '301020ab');
        //Filtrando possiveis erros de conexao
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}

?>
