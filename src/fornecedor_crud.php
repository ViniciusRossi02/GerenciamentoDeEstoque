<?php

// SECTION 15 - 1° PASSO - CRIAR PASTA FORNECEDOR_CRUD.PHP E CRIAR FUNÇÃO PARA BUSCAR FORNECEDOR

function buscarFornecedores(PDO $conexao): array
{   
    // Coloquei * pq a tabela é pequena e so tem (id,nome)
    $sql = "SELECT * FROM  fornecedores ORDER BY nome";
    $consulta = $conexao->prepare($sql);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

// <!-- SECTION 15 - 9° PASSO - Criar função para pagina inserir  -->
function inserirFornecedor(PDO $conexao, string $nome):void
{
    $sql = "INSERT INTO fornecedores (nome)
    VALUE (:nome)";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);
    $consulta->execute();
}

// SECTION 16 - 1° passo - CRIAR UMA FUNÇÃO PARA BUSCAR O FORNECEDOR POR ID RECEBIDO PELA URL
// A funçõa pode retornar tanto um array de dados quanto nulo
function buscarFornecedorPorId(PDO $conexao, int $id): ?array
{
    $sql = "SELECT * FROM fornecedores WHERE id = :id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":id", $id, PDO::PARAM_INT);
    $consulta->execute();
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    return $resultado ?: null;

}

// SECTION 16 - 6° passo - CRIAR UMA FUNÇÃO PARA ATUALIZAR OS FORNECEDORES
function atualizarFornecedor(PDO $conexao, int $id, string $nome):void
{
    $sql = "UPDATE fornecedores SET nome = :nome WHERE id = :id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":id", $id, PDO::PARAM_INT);
    $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);
    $consulta->execute();
    
}

// SECTION 16 - 7° passo - CRIAR FUNÇÃO PARA EXCLUIR FORNECEDOR
function excluirFornecedor(PDO $conexao, int $id):void
{
    $sql = "DELETE FROM fornecedores WHERE id = :id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":id", $id, PDO::PARAM_INT);
    $consulta->execute();
}
