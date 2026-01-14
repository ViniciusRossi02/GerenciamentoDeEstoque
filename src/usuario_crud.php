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

function buscarUsuarioPorId(PDO $conexao, int $id): ?array
{
    $sql = "SELECT * FROM usuarios WHERE id = :id"; 
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":id", $id, PDO::PARAM_INT);
    $consulta->execute();
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    return $resultado ?: null; 
}

function atualizarUsuario(PDO $conexao, int $id, string $nome, string $email, string $senha): void
{
    $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha
            WHERE id = :id";

            $consulta = $conexao->prepare($sql);

            $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);
            $consulta->bindValue(":email", $email, PDO::PARAM_STR);
            $consulta->bindValue(":senha", $senha, PDO::PARAM_STR);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);

            $consulta -> execute();
}

function excluirUsuario(PDO $conexao, int $id):void
{
    $sql = "DELETE FROM usuarios WHERE id = :id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":id", $id, PDO::PARAM_INT);
    $consulta->execute();
}