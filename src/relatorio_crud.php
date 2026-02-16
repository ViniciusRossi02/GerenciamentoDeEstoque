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