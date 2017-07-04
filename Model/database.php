<?php
class Database
{

    public static function Conectar()
    {
        $pdo = new PDO('mysql:host=mysql.ligiano.info;dbname=ligiano05;charset=utf8', 'ligiano05', '301020ab');
        //Filtrando possiveis erros de conexao
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}

?>
