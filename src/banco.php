<?php 

// Parametros de acesso ao servidor de banco de dados

$servidor = '127.0.0.1';
$usuario = 'root';
$senha = 'Rossi123#';
$banco = "fly_by_night_estoque";

// Script de conexão

try { //tentar

    // Configurando o DNS (Data Source Name)
    $conexao = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8",$usuario, $senha);

    // Habilitando o lançamento de erros e exceções  
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
} catch (\Throwable $erro) { //captura os detalhes de erro
    die("Falha na conexão: ".$erro->getMessage());
}
