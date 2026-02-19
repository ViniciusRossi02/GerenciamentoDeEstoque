<?php

//src/relatorio_crud.php

// SECTION 27 - 1° PASSO -> CRIAR FUNÇÕES PARA PESQUISA DE DADOS
function buscarProdutosPorLoja(PDO $conexao, int $loja_id): array
{
    $sql = "SELECT 
                produtos.nome AS produto,
                produtos.preco,
                fornecedores.nome AS fornecedor,
                lojas_produtos.estoque,
                lojas_produtos.loja_id,
                lojas_produtos.produto_id
            FROM lojas_produtos
            JOIN produtos ON produtos.id = lojas_produtos.produto_id
            JOIN fornecedores ON fornecedores.id = produtos.fornecedor_id
            WHERE lojas_produtos.loja_id = :loja_id
            ORDER BY produtos.nome";

    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":loja_id", $loja_id, PDO::PARAM_INT);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

// SECTION 28 - 1° PASSO -> CRIAR FUNÇÕES PARA PESQUISA DE DADOS DOS FORNECEDORES
function buscarProdutosPorForncedor(PDO $conexao, int $fornecedor_id): array
{
    $sql = "SELECT 
    id, nome, descricao, 
    preco, quantidade, preco * quantidade AS total 
    FROM produtos
    WHERE fornecedor_id = :fornecedor_id
    ORDER BY nome";

    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":fornecedor_id", $fornecedor_id, PDO::PARAM_INT);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

// SECTION 29 - 1° PASSO -> CRIAR FUNÇÕES PARA BUSCAR ESTOQUE POR PRODUTO

function buscarEstoquePorProduto(PDO $conexao, int $produto_id): array
{
    $sql = "SELECT 
                lojas.nome AS loja,
                lojas_produtos.estoque, 
                lojas_produtos.produto_id,
                lojas_produtos.loja_id
            FROM lojas_produtos
            JOIN lojas ON lojas.id = lojas_produtos.loja_id 
            WHERE lojas_produtos.produto_id = :produto_id
            ORDER BY lojas.nome";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":produto_id", $produto_id, PDO::PARAM_INT);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

// SECTION 30 - 1° PASSO -> CRIAR FUNÇÃO PARA ESTOQUE BAIXO

function buscarProdutosComEstoqueBaixo(PDO $conexao, int $limite):array
{
    $sql = "SELECT
                produtos.nome AS produto,
                lojas.nome AS loja,
                lojas_produtos.estoque AS quantidade,
                lojas_produtos.produto_id,
                lojas_produtos.loja_id
            FROM lojas_produtos
            JOIN produtos ON produtos.id = lojas_produtos.produto_id
            JOIN lojas ON lojas.id = lojas_produtos.loja_id
            WHERE lojas_produtos.estoque < :limite
            ORDER BY lojas_produtos.estoque, produtos.nome";

    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":limite", $limite, PDO::PARAM_INT);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}