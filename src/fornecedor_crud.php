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