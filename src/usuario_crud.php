<!-- Arquivo de gerenciamento CRUD do usuario -->

<?php
// usuario_crud.php

function buscarUsuarios(PDO $conexao): array
{
    $sql = "SELECT id, nome, email FROM usuarios ORDER BY nome";
    $consulta = $conexao->prepare($sql);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

function inserirUsuario(PDO $conexao, string $nome, string $email, string $senha): void 
{
    // montando o comando SQL com parametros nomeados para os valores
    $sql = "INSERT INTO usuarios(nome, email, senha)
            VALUES(:nome, :email, :senha)";

    // preparando para a execução
    $consulta = $conexao->prepare($sql);

    // Associando os valores aos seus respectivos parâmetros nomeados
    $consulta->bindValue(':nome', $nome, PDO::PARAM_STR);
    $consulta->bindValue(':email', $email, PDO::PARAM_STR);
    $consulta->bindValue(':senha', $senha, PDO::PARAM_STR);

    $consulta->execute();
}