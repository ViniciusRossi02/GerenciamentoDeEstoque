<?php

function buscarLojas(PDO $conexao): array
{   
    // Coloquei * pq a tabela é pequena e so tem (id,nome)
    $sql = "SELECT * FROM  lojas ORDER BY nome";
    $consulta = $conexao->prepare($sql);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

function inserirLoja(PDO $conexao, string $nome):void
{
    $sql = "INSERT INTO lojas (nome)
    VALUE (:nome)";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);
    $consulta->execute();
}

function buscarLojaPorId(PDO $conexao, int $id): ?array
{
    $sql = "SELECT * FROM lojas WHERE id = :id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":id", $id, PDO::PARAM_INT);
    $consulta->execute();
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    return $resultado ?: null;
}


function atualizarLoja(PDO $conexao, int $id, string $nome):void
{
    $sql = "UPDATE lojas SET nome = :nome WHERE id = :id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":id", $id, PDO::PARAM_INT);
    $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);
    $consulta->execute();
    
}

// SECTION 16 - 7° passo - CRIAR FUNÇÃO PARA EXCLUIR FORNECEDOR
function excluirLoja(PDO $conexao, int $id):void
{
    $sql = "DELETE FROM lojas WHERE id = :id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":id", $id, PDO::PARAM_INT);
    $consulta->execute();
}

?>
